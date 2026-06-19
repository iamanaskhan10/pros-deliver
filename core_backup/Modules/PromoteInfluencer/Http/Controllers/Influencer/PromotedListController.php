<?php

namespace Modules\PromoteInfluencer\Http\Controllers\Influencer;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\PromoteInfluencer\Entities\PromotionProjectList;

class PromotedListController extends Controller
{
    public function promoted_list()
    {
        $promoted_lists = PromotionProjectList::with('project')
            ->where('user_id', auth()->user()->id)
            ->where('is_valid_payment', 'yes')
            ->latest()
            ->paginate(10);
        return view('PromoteInfluencer::frontend.influencer.promoted-list', compact('promoted_lists'));
    }
}
