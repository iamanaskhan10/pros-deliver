<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class FreelancerListController extends Controller
{
    private $current_date;

    public function __construct()
    {
        $this->current_date = now()->toDateTimeString();
    }

    // All talents
    public function talents(Request $request)
    {
        $talents = $this->getMixedFreelancers($request);
        return view('frontend.pages.talent.talents', compact('talents'));
    }

    // Talents pagination
    public function pagination(Request $request)
    {
        if ($request->ajax()) {
            $talents = $this->getMixedFreelancers($request);
            $this->trackProFreelancerImpressions($talents);

            return $talents->total() >= 1
                ? view('frontend.pages.talent.search-talent-result', compact('talents'))->render()
                : response()->json(['status' => __('nothing')]);
        }
    }

    // Talents filter
    public function talents_filter(Request $request)
    {
        if ($request->ajax()) {
            $talents = $this->getMixedFreelancers($request);
            $this->trackProFreelancerImpressions($talents);

            return $talents->total() >= 1
                ? view('frontend.pages.talent.search-talent-result', compact('talents'))->render()
                : response()->json(['status' => __('nothing')]);
        }
    }

    // Reset filter
    public function reset(Request $request)
    {
        $talents = $this->getMixedFreelancers($request);
        return $talents->total() >= 1
            ? view('frontend.pages.talent.search-talent-result', compact('talents'))->render()
            : response()->json(['status' => __('nothing')]);
    }

    // Get mixed pro/non-pro freelancers
    private function getMixedFreelancers($request)
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
            return $this->getFreelancersWithoutPromotion($request, $perPage);
        }

        $baseQuery = $this->filter_query($request);

        $currentProIds = User::where('is_pro', 'yes')
            ->where('pro_expire_date', '>=', $this->current_date)
            ->pluck('id')
            ->toArray();

        if ($proFirst && !empty($currentProIds)) {
            return $this->getProFreelancersFirstOptimized($baseQuery, $currentProIds, $page, $perPage, $request);
        }

        return $this->getMixedFreelancersOptimized($baseQuery, $currentProIds, $page, $perPage, $proCount, $nonProCount, $request);
    }

    // Freelancers without promotion module
    private function getFreelancersWithoutPromotion($request, $perPage)
    {
        $query = $this->filter_query($request);
        return $query->orderBy('freelancer_orders_count', 'desc')->paginate($perPage);
    }

    // Pro freelancers first (OPTIMIZED)
    private function getProFreelancersFirstOptimized($baseQuery, $proIds, $page, $perPage, $request)
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
            $proFreelancers = (clone $baseQuery)
                ->whereIn('id', $proIds)
                ->orderByRaw('RAND(' . $this->getConsistentSeed($request) . ')')
                ->offset($offset)
                ->limit($proTake)
                ->get();

            $result = $result->concat($proFreelancers);
        }

        // If we need non-pro to fill the page
        if ($result->count() < $perPage && $offset + $result->count() >= $totalPro) {
            $nonProOffset = max(0, $offset - $totalPro);
            $nonProTake = $perPage - $result->count();

            $nonProFreelancers = (clone $baseQuery)
                ->whereNotIn('id', $proIds)
                ->orderBy('freelancer_orders_count', 'desc')
                ->offset($nonProOffset)
                ->limit($nonProTake)
                ->get();

            $result = $result->concat($nonProFreelancers);
        }

        return new LengthAwarePaginator(
            $result,
            $totalItems,
            $perPage,
            $page,
            ['path' => request()->url(), 'query' => request()->query()]
        );
    }

    // Mixed freelancers with ratio
    private function getMixedFreelancersOptimized($baseQuery, $proIds, $page, $perPage, $proCount, $nonProCount, $request)
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

        // Get pro freelancers for current page with consistent ordering
        if ($pageData['proTake'] > 0) {
            $proFreelancers = (clone $baseQuery)
                ->whereIn('id', $proIds)
                ->orderByRaw('RAND(' . $this->getConsistentSeed($request) . ')')
                ->offset($pageData['proOffset'])
                ->limit($pageData['proTake'])
                ->get();
            $result = $result->concat($proFreelancers->keyBy('id'));
        }

        // Get non-pro freelancers for current page
        if ($pageData['nonProTake'] > 0) {
            $nonProFreelancers = (clone $baseQuery)
                ->whereNotIn('id', $proIds)
                ->orderBy('freelancer_orders_count', 'desc')
                ->offset($pageData['nonProOffset'])
                ->limit($pageData['nonProTake'])
                ->get();
            $result = $result->concat($nonProFreelancers->keyBy('id'));
        }

        // Interleave the results
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

    // Track pro freelancer impressions
    private function trackProFreelancerImpressions($freelancers)
    {
        if (!moduleExists('PromoteInfluencer')) return;

        $authId = auth('web')->id();

        $proFreelancerIds = collect();

        foreach ($freelancers as $freelancer) {
            if (!empty($freelancer->is_pro_freelancer) && $freelancer->id !== $authId) {
                $proFreelancerIds->push($freelancer->id);
            }
        }

        if ($proFreelancerIds->isNotEmpty()) {
            // Bulk update impressions for better performance
            \Modules\PromoteInfluencer\Entities\PromotionProjectList::whereIn('identity', $proFreelancerIds)
                ->where('type', 'profile')
                ->where('expire_date', '>=', $this->current_date)
                ->increment('impression');
        }
    }

    // Common query builder
    private function common_query($request)
    {
        return User::query()
            ->select([
                'id',
                'username',
                'first_name',
                'last_name',
                'image',
                'country_id',
                'state_id',
                'is_pro',
                'pro_expire_date',
                'load_from',
                'github_id'
            ])
            ->with('user_introduction', 'freelancer_category')
            ->where('user_type', '2')
            ->where('is_email_verified', 1)
            ->where('is_suspend', 0)
            ->withCount(['freelancer_orders' => function ($q) {
                $q->where('status', 3);
            }])
            ->withSum(['freelancer_orders' => function ($q) {
                $q->where('status', 3);
            }], 'payable_amount')
            ->withAvg(['freelancer_ratings' => function ($q) {
                $q->where('sender_type', 1);
            }], 'rating');
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
            $request->level ?? '',
            $request->category ?? '',
            $request->skill ?? '',
            $request->min_count ?? '',
            $request->max_count ?? '',
            session()->getId(),
            date('H')
        ];

        return crc32(implode('|', $seedData));
    }

    // filter query
    private function filter_query($request)
    {
        $query = $this->common_query($request);

        if (filled($request->job_search_string)) {
            $searchString = strip_tags($request->job_search_string);
            $query->where(function ($q) use ($searchString) {
                $q->where('username', 'LIKE', '%' . $searchString . '%')
                    ->orWhere('first_name', 'LIKE', '%' . $searchString . '%')
                    ->orWhere('last_name', 'LIKE', '%' . $searchString . '%');
            });
        }

        if (!empty($request->gender)) $query->where('gender', $request->gender);
        if (!empty($request->country)) $query->where('country_id', $request->country);
        if (!empty($request->category)) {
            $query->whereHas('categories', fn($q) => $q->where('category_id', $request->category));
        }
        if (!empty($request->skill)) {
            $query->whereHas('freelancer_skill', fn($q) => $q->where('skill', 'LIKE', '%' . $request->skill . '%'));
        }

        if (!empty($request->min_count) || !empty($request->max_count)) {
            $query->whereIn('id', function ($q) use ($request) {
                $q->select('user_id')->from('social_profiles')->whereRaw('CAST(followers AS UNSIGNED) > 0');
                if ($request->min_count) $q->whereRaw('CAST(followers AS UNSIGNED) >= ?', [$request->min_count]);
                if ($request->max_count) $q->whereRaw('CAST(followers AS UNSIGNED) <= ?', [$request->max_count]);
            });
        }

        return $query;
    }
}
