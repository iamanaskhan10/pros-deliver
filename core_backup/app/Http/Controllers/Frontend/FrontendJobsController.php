<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\JobPost;
use Illuminate\Http\Request;

class FrontendJobsController extends Controller
{
    public function jobs()
    {
        $jobs = JobPost::with('job_creator', 'job_skills')
            ->whereHas('job_creator')
            ->where('on_off', '1')
            ->withCount('job_proposals')
            ->where('status', '1')
            ->where('job_approve_request', '1')
            ->latest()
            ->paginate(12);

        return view('frontend.pages.jobs.jobs', compact('jobs'));
    }

    public function jobs_filter(Request $request)
    {
        if ($request->ajax()) {
            $jobs = JobPost::with('job_creator', 'job_skills')
                ->whereHas('job_creator')
                ->where('on_off', '1')
                ->withCount('job_proposals')
                ->where('status', '1')
                ->where('job_approve_request', '1');

            if (filled($request->job_search_string)) {
                $jobs = $jobs->WhereHas('job_creator')->where('title', 'LIKE', '%'.strip_tags($request->job_search_string).'%');
            }

            if (isset($request->country) && ! empty($request->country)) {
                $jobs = $jobs->WhereHas('job_creator', function ($q) use ($request) {
                    $q->where('country_id', $request->country);
                });
            }

            if (isset($request->category) && ! empty($request->category)) {
                $jobs = $jobs->where('category', $request->category);
            }

            if (isset($request->type) && ! empty($request->type)) {
                $jobs = $jobs->where('type', $request->type);
            }

            if (isset($request->level) && ! empty($request->level)) {
                $jobs = $jobs->WhereHas('job_creator', function ($q) use ($request) {
                    $q->where('level', $request->level);
                });
            }
            
            if (is_numeric($request->min_price) && is_numeric($request->max_price)) {
                $jobs = $jobs->whereBetween('budget', [$request->min_price, $request->max_price]);
            }

            if (isset($request->duration) && ! empty($request->duration)) {
                $jobs = $jobs->where('duration', $request->duration);
            }

            if (!empty($request->sorting)) {
                switch ($request->sorting) {
                    case 'old_to_new':
                        $jobs = $jobs->orderBy('created_at', 'asc');
                        break;

                    case 'new_to_old':
                        $jobs = $jobs->orderBy('created_at', 'desc');
                        break;

                    case 'low_to_high_price':
                        $jobs = $jobs->orderBy('budget', 'asc');
                        break;

                    case 'high_to_low_price':
                        $jobs = $jobs->orderBy('budget', 'desc');
                        break;

                    default:
                        $jobs = $jobs->orderBy('created_at', 'desc'); // fallback
                        break;
                }
            } else {
                $jobs = $jobs->orderBy('created_at', 'desc'); // default
            }

            $jobs = $jobs->paginate(12);

            return $jobs->total() >= 1 ? view('frontend.pages.jobs.search-job-result', compact('jobs'))->render() : response()->json(['status' => __('nothing')]);
        }
    }

    public function pagination(Request $request)
    {
        if ($request->ajax()) {
            $jobs = JobPost::with('job_creator', 'job_skills')
                ->whereHas('job_creator')
                ->where('on_off', '1')
                ->withCount('job_proposals')
                ->where('status', '1')
                ->where('job_approve_request', '1');

            if ($request->country === '' && $request->type === '' && $request->level === '' && $request->min_price === '' && $request->max_price === '' && $request->duration === '' && $request->job_search_string === '') {
                $jobs = $jobs;
            } else {
                if (filled($request->job_search_string)) {
                    $jobs = $jobs->WhereHas('job_creator')->where('title', 'LIKE', '%'.strip_tags($request->job_search_string).'%');
                }

                if (isset($request->country) && ! empty($request->country)) {
                    $jobs = $jobs->WhereHas('job_creator', function ($q) use ($request) {
                        $q->where('country_id', $request->country);
                    });
                }

                if (isset($request->type) && ! empty($request->type)) {
                    $jobs = $jobs->where('type', $request->type);
                }

                if (isset($request->level) && ! empty($request->level)) {
                    $jobs = $jobs->WhereHas('job_creator', function ($q) use ($request) {
                        $q->where('level', $request->level);
                    });
                }

                if (isset($request->min_price) && isset($request->max_price) && ! empty($request->min_price) && ! empty($request->max_price)) {
                    $jobs = $jobs->whereBetween('budget', [$request->min_price, $request->max_price]);
                }

                if (isset($request->duration) && ! empty($request->duration)) {
                    $jobs = $jobs->where('duration', $request->duration);
                }
                if (!empty($request->sorting)) {
                    switch ($request->sorting) {
                        case 'old_to_new':
                            $jobs = $jobs->orderBy('created_at', 'asc');
                            break;

                        case 'new_to_old':
                            $jobs = $jobs->orderBy('created_at', 'desc');
                            break;

                        case 'low_to_high_price':
                            $jobs = $jobs->orderBy('budget', 'asc');
                            break;

                        case 'high_to_low_price':
                            $jobs = $jobs->orderBy('budget', 'desc');
                            break;

                        default:
                            $jobs = $jobs->orderBy('created_at', 'desc'); // fallback
                            break;
                    }
                } else {
                    $jobs = $jobs->orderBy('created_at', 'desc'); // default
                }
            }
            $jobs = $jobs->paginate(12);

            return $jobs->total() >= 1 ? view('frontend.pages.jobs.search-job-result', compact('jobs'))->render() : response()->json(['status' => __('nothing')]);
        }

    }

    public function reset()
    {
        $jobs = JobPost::with('job_creator', 'job_skills')
            ->whereHas('job_creator')
            ->where('on_off', '1')
            ->withCount('job_proposals')
            ->where('status', '1')
            ->where('job_approve_request', '1')
            ->latest()
            ->paginate(12);

        return $jobs->total() >= 1
            ? view('frontend.pages.jobs.search-job-result', compact('jobs'))->render()
            : response()->json(['status' => __('nothing')]);
    }
}
