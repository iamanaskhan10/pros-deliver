<?php

namespace Modules\Credit\App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\AdminNotification;
use Illuminate\Http\Request;
use Modules\Credit\App\Models\Credit;
use Modules\Credit\App\Models\UserCredit;

class AdminCreditController extends Controller
{
    // display credit history
    public function credit_history()
    {
        $all_histories = Credit::with('user')->latest()->paginate(10);
        return view('credit::backend.credit.credit-history', compact('all_histories'));
    }

    public function credit_history_details($id)
    {
        $history_details = Credit::with('user')->where('id', $id)->first();
        if (empty($history_details)) {
            return back();
        }

        AdminNotification::where('identity', $id)->where('type', 'credit_deposit')->update(['is_read' => 1]);

        return view('credit::backend.credit.history-details', compact('history_details'));
    }

    // pagination
    public function pagination(Request $request)
    {
        if ($request->ajax()) {
            $all_histories = Credit::with('user')->latest()->paginate(10);
            return view('credit::backend.credit.search-result', compact('all_histories'))->render();
        }
    }

    // search credit history
    public function credit_search_history(Request $request)
    {
        $all_histories = Credit::with('user')
            ->where('created_at', 'LIKE', "%" . strip_tags($request->string_search) . "%")
            ->latest()
            ->paginate(10);

        if ($all_histories->total() >= 1) {
            return view('credit::backend.credit.search-result', compact('all_histories'))->render();
        } else {
            return response()->json([
                'status' => __('nothing')
            ]);
        }
    }

    // change history status
    public function credit_change_status($id)
    {
        $credit = Credit::where('id', $id)->first();

        if ($credit && $credit->payment_status == 'pending') {
            $credit->payment_status = 'complete';
            $credit->save();

            $user_credit = UserCredit::firstOrCreate(
                ['user_id' => $credit->user_id],
                ['credit_balance' => 0]
            );
            $user_credit->addCredits($credit->credits);

            toastr_success(__('Status Successfully Changed'));
            return redirect()->back();
        }

        return back();
    }
}
