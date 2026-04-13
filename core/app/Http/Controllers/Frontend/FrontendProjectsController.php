<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class FrontendProjectsController extends Controller
{
    private $current_date;

    public function __construct()
    {
        $this->current_date = \Carbon\Carbon::now()->toDateTimeString();
    }

    //all projects
    public function projects(Request $request)
    {
        $projects = $this->getMixedProjects($request);
        return view('frontend.pages.projects.projects', compact('projects'));
    }

    //projects pagination
    public function pagination(Request $request)
    {
        if ($request->ajax()) {
            $projects = $this->getMixedProjects($request);
            $this->trackProProjectImpressions($projects);

            return $projects->total() >= 1
                ? view('frontend.pages.projects.search-result', compact('projects'))->render()
                : response()->json(['status' => __('nothing')]);
        }
    }

    //reset projects filter
    public function reset(Request $request)
    {
        $projects = $this->getMixedProjects($request);
        return $projects->total() >= 1
            ? view('frontend.pages.projects.search-result', compact('projects'))->render()
            : response()->json(['status' => __('nothing')]);
    }

    // Get mixed pro/non-pro projects (OPTIMIZED)
    private function getMixedProjects($request)
    {
        $perPage = get_static_option("projects_per_page") ?? 12;
        $proCount = get_static_option("pro_projects_count") ?? 6;
        $nonProCount = get_static_option("non_pro_projects_count") ?? 6;
        $proFirst = get_static_option("pro_projects_default_first") == 0;
        $page = $request->get('page', 1);
        $hasPromo = moduleExists('PromoteInfluencer');

        // Ensure pro + non-pro counts equal per page
        $totalConfigured = $proCount + $nonProCount;
        if ($totalConfigured !== $perPage) {
            // Adjust proportionally
            $proCount = (int) round(($proCount / $totalConfigured) * $perPage);
            $nonProCount = $perPage - $proCount;
        }

        if (!$hasPromo) {
            return $this->getProjectsWithoutPromotion($request, $perPage);
        }

        $baseQuery = $this->filter_query($request);

        $currentProIds = Project::where('is_pro', 'yes')
            ->where('pro_expire_date', '>=', $this->current_date)
            ->pluck('id')
            ->toArray();

        if ($proFirst && !empty($currentProIds)) {
            return $this->getProProjectsFirstOptimized($baseQuery, $currentProIds, $page, $perPage, $request);
        }

        return $this->getMixedProjectsOptimized($baseQuery, $currentProIds, $page, $perPage, $proCount, $nonProCount, $request);
    }

    // Projects without promotion module
    private function getProjectsWithoutPromotion($request, $perPage)
    {
        $query = $this->filter_query($request);
        return $query->orderBy('orders_count', 'desc')->paginate($perPage);
    }

    // Pro projects first (OPTIMIZED)
    private function getProProjectsFirstOptimized($baseQuery, $proIds, $page, $perPage, $request)
    {
        // Get total counts first
        $totalPro = (clone $baseQuery)->whereIn('id', $proIds)->count();
        $totalNonPro = (clone $baseQuery)->whereNotIn('id', $proIds)->count();
        $totalItems = $totalPro + $totalNonPro;

        if ($totalItems == 0) {
            return new LengthAwarePaginator(
                collect([]),
                0,
                $perPage,
                $page,
                ['path' => request()->url(), 'query' => request()->query()]
            );
        }

        $offset = ($page - 1) * $perPage;
        $result = collect();

        // If we're still in pro range
        if ($offset < $totalPro) {
            $proTake = min($perPage, $totalPro - $offset);
            $proProjects = (clone $baseQuery)
                ->whereIn('id', $proIds)
                ->orderByRaw('RAND(' . $this->getConsistentSeed($request) . ')')
                ->offset($offset)
                ->limit($proTake)
                ->get();

            $result = $result->concat($proProjects);
        }

        // If we need non-pro to fill the page
        if ($result->count() < $perPage && $offset + $result->count() >= $totalPro) {
            $nonProOffset = max(0, $offset - $totalPro);
            $nonProTake = $perPage - $result->count();

            $nonProProjects = (clone $baseQuery)
                ->whereNotIn('id', $proIds)
                ->orderBy('orders_count', 'desc')
                ->offset($nonProOffset)
                ->limit($nonProTake)
                ->get();

            $result = $result->concat($nonProProjects);
        }

        return new LengthAwarePaginator(
            $result,
            $totalItems,
            $perPage,
            $page,
            ['path' => request()->url(), 'query' => request()->query()]
        );
    }

    // Mixed projects with ratio (OPTIMIZED)
    private function getMixedProjectsOptimized($baseQuery, $proIds, $page, $perPage, $proCount, $nonProCount, $request)
    {
        // Get total counts
        $totalPro = (clone $baseQuery)->whereIn('id', $proIds)->count();
        $totalNonPro = (clone $baseQuery)->whereNotIn('id', $proIds)->count();
        $totalItems = $totalPro + $totalNonPro;

        if ($totalItems == 0) {
            return new LengthAwarePaginator(
                collect([]),
                0,
                $perPage,
                $page,
                ['path' => request()->url(), 'query' => request()->query()]
            );
        }

        // Calculate what we need for current page
        $pageData = $this->calculatePageAllocation($page, $perPage, $proCount, $nonProCount, $totalPro, $totalNonPro);

        $result = collect();

        // Get pro projects for current page with consistent ordering
        if ($pageData['proTake'] > 0) {
            $proProjects = (clone $baseQuery)
                ->whereIn('id', $proIds)
                ->orderByRaw('RAND(' . $this->getConsistentSeed($request) . ')')
                ->offset($pageData['proOffset'])
                ->limit($pageData['proTake'])
                ->get();
            $result = $result->concat($proProjects->keyBy('id'));
        }

        // Get non-pro projects for current page
        if ($pageData['nonProTake'] > 0) {
            $nonProProjects = (clone $baseQuery)
                ->whereNotIn('id', $proIds)
                ->orderBy('orders_count', 'desc')
                ->offset($pageData['nonProOffset'])
                ->limit($pageData['nonProTake'])
                ->get();
            $result = $result->concat($nonProProjects->keyBy('id'));
        }

        // Interleave the results with scattered distribution
        $mixed = $this->interleaveResults($result, $proIds, $proCount, $nonProCount);

        return new LengthAwarePaginator(
            $mixed,
            $totalItems,
            $perPage,
            $page,
            ['path' => request()->url(), 'query' => request()->query()]
        );
    }

    // Calculate page allocation for mixed results
    private function calculatePageAllocation($page, $perPage, $proCount, $nonProCount, $totalPro, $totalNonPro)
    {
        $proUsed = 0;
        $nonProUsed = 0;

        // Calculate allocation for previous pages
        for ($p = 1; $p < $page; $p++) {
            $pagePro = min($proCount, $totalPro - $proUsed);
            $pageNonPro = min($nonProCount, $totalNonPro - $nonProUsed);
            $pageTotal = $pagePro + $pageNonPro;

            // Fill remaining slots
            if ($pageTotal < $perPage) {
                $remaining = $perPage - $pageTotal;

                // Try to add more non-pro first
                $extraNonPro = min($remaining, $totalNonPro - $nonProUsed - $pageNonPro);
                $pageNonPro += $extraNonPro;
                $remaining -= $extraNonPro;

                // Then add more pro if needed
                if ($remaining > 0) {
                    $extraPro = min($remaining, $totalPro - $proUsed - $pagePro);
                    $pagePro += $extraPro;
                }
            }

            $proUsed += $pagePro;
            $nonProUsed += $pageNonPro;
        }

        // Calculate for current page
        $currentPagePro = min($proCount, $totalPro - $proUsed);
        $currentPageNonPro = min($nonProCount, $totalNonPro - $nonProUsed);
        $currentPageTotal = $currentPagePro + $currentPageNonPro;

        // Fill remaining slots for current page
        if ($currentPageTotal < $perPage) {
            $remaining = $perPage - $currentPageTotal;

            // Try to add more non-pro first
            $extraNonPro = min($remaining, $totalNonPro - $nonProUsed - $currentPageNonPro);
            $currentPageNonPro += $extraNonPro;
            $remaining -= $extraNonPro;

            // Then add more pro if needed
            if ($remaining > 0) {
                $extraPro = min($remaining, $totalPro - $proUsed - $currentPagePro);
                $currentPagePro += $extraPro;
            }
        }

        return [
            'proOffset' => $proUsed,
            'proTake' => $currentPagePro,
            'nonProOffset' => $nonProUsed,
            'nonProTake' => $currentPageNonPro
        ];
    }

    // Interleave results with scattered distribution (most effective)
    private function interleaveResults($allResults, $proIds, $proCount, $nonProCount)
    {
        $proResults = $allResults->whereIn('id', $proIds)->values();
        $nonProResults = $allResults->whereNotIn('id', $proIds)->values();

        $totalItems = $proResults->count() + $nonProResults->count();
        if ($totalItems === 0) return collect();

        // Handle edge cases
        if ($proResults->count() === 0) return $nonProResults;
        if ($nonProResults->count() === 0) return $proResults;

        // Use scattered distribution for maximum effectiveness
        $mixed = collect(array_fill(0, $totalItems, null));
        $proCount = $proResults->count();

        // Calculate evenly distributed positions for pro items
        $proPositions = [];
        if ($proCount > 0) {
            $interval = $totalItems / $proCount;

            for ($i = 0; $i < $proCount; $i++) {
                $position = (int) round($i * $interval);

                // Ensure position is within bounds and not duplicate
                while ($position >= $totalItems || in_array($position, $proPositions)) {
                    $position = ($position + 1) % $totalItems;
                }
                $proPositions[] = $position;
            }
        }

        // Place pro items at calculated positions
        foreach ($proPositions as $index => $position) {
            if (isset($proResults[$index])) {
                $mixed[$position] = $proResults[$index];
            }
        }

        // Fill remaining positions with non-pro items
        $nonProIndex = 0;
        for ($i = 0; $i < $totalItems; $i++) {
            if ($mixed[$i] === null && $nonProIndex < $nonProResults->count()) {
                $mixed[$i] = $nonProResults[$nonProIndex];
                $nonProIndex++;
            }
        }

        return $mixed->filter()->values();
    }

    /**
     * Generate consistent seed for randomization across pagination
     * Create seed based on search filters + session to maintain consistency within session
     * but allow variation between different sessions/users 
     * 
     */
    private function getConsistentSeed($request)
    {
        $seedData = [
            $request->job_search_string ?? '',
            $request->gender ?? '',
            $request->country ?? '',
            $request->category ?? '',
            $request->level ?? '',
            $request->min_price ?? '',
            $request->max_price ?? '',
            $request->delivery_day ?? '',
            $request->rating ?? '',
            session()->getId(),
            date('H')
        ];

        return crc32(implode('|', $seedData));
    }

    // Track pro project impressions (OPTIMIZED)
    private function trackProProjectImpressions($projects)
    {
        if (!moduleExists('PromoteInfluencer')) return;

        $authId = auth('web')->id();

        $proProjectIds = collect();

        foreach ($projects as $project) {
            if (!empty($project->is_pro_project) && $project->user_id !== $authId) {
                $proProjectIds->push($project->id);
            }
        }

        if ($proProjectIds->isNotEmpty()) {
            // Bulk update impressions for better performance
            \Modules\PromoteInfluencer\Entities\PromotionProjectList::whereIn('identity', $proProjectIds)
                ->where('type', 'project')
                ->where('expire_date', '>=', $this->current_date)
                ->increment('impression');
        }
    }

    // Common query builder
    private function common_query($request)
    {
        return Project::query()->with('project_creator')
            ->whereHas('project_creator')
            ->select([
                'id',
                'title',
                'slug',
                'user_id',
                'basic_regular_charge',
                'basic_discount_charge',
                'basic_delivery',
                'description',
                'image',
                'video',
                'is_pro',
                'pro_expire_date'
            ])
            ->where('project_on_off', '1')
            ->where('status', '1')
            ->withCount([
                'orders' => function ($query) {
                    $query->where('status', 3)->where('is_project_job', 'project');
                },
                'ratings as ratings_count' => function ($query) {
                    $query->where('is_project_job', 'project')->where('sender_type', 1);
                },
            ])
            ->withAvg([
                'ratings as average_rating' => function ($query) {
                    $query->where('is_project_job', 'project')->where('sender_type', 1);
                },
            ], 'rating');
    }

    // Filter query with all search criteria
    private function filter_query($request)
    {
        $query = $this->common_query($request);

        if (filled($request->job_search_string)) {
            $searchString = strip_tags($request->job_search_string);
            $query->whereHas('project_creator')
                ->where('title', 'LIKE', '%' . $searchString . '%');
        }

        if (!empty($request->gender)) {
            $query->whereHas('project_creator', function ($q) use ($request) {
                $q->where('gender', $request->gender);
            });
        }

        if (!empty($request->country)) {
            $query->whereHas('project_creator', function ($q) use ($request) {
                $q->where('country_id', $request->country);
            });
        }

        if (isset($request->category) && !empty($request->category)) {
            $query->where('category_id', $request->category);
        }

        if (is_numeric($request->min_price) && is_numeric($request->max_price)) {
            $query->whereBetween('basic_regular_charge', [$request->min_price, $request->max_price]);
        }

        if (!empty($request->delivery_day)) {
            $query->where('basic_delivery', $request->delivery_day);
        }

        if (!empty($request->rating)) {
            $query->withAvg(['ratings' => function ($q) {
                $q->where('sender_type', 1);
            }], 'rating')
                ->having('ratings_avg_rating', '>', $request->rating - 1)
                ->having('ratings_avg_rating', '<=', $request->rating);
        }

        return $query;
    }
}
