<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use App\Models\User;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    public function all_portfolio()
    {
        $all_portfolios = Portfolio::latest()->paginate(10);
        return view('backend.pages.portfolio.all-portfolio', compact('all_portfolios'));
    }

    public function search_portfolio(Request $request)
    {
        $all_portfolios = Portfolio::where('title', 'LIKE', "%" . strip_tags($request->string_search) . "%")
            ->latest()
            ->paginate(10);
            
        return $all_portfolios->total() >= 1 
            ? view('backend.pages.portfolio.search-result', compact('all_portfolios'))->render() 
            : response()->json(['status' => __('nothing')]);
    }

    public function pagination(Request $request)
    {
        if ($request->ajax()) {
            if (!empty($request->string_search)) {
                $all_portfolios = Portfolio::where('title', 'LIKE', "%" . strip_tags($request->string_search) . "%")
                    ->latest()
                    ->paginate(10);
            } else {
                $all_portfolios = Portfolio::latest()->paginate(10);
            }
            return view('backend.pages.portfolio.search-result', compact('all_portfolios'))->render();
        }
    }

    public function change_status($id = null)
    {
        $portfolio = Portfolio::findOrFail($id);
        $status = $portfolio->status == 1 ? 0 : 1;
        $portfolio->update(['status' => $status]);
        
        $msg = $status == 1 ? __('Portfolio Approved') : __('Portfolio Set to Pending');
        return back()->with(toastr_success($msg));
    }

    public function reject_portfolio($id = null)
    {
        $portfolio = Portfolio::findOrFail($id);
        // Status 2 is rejected
        $portfolio->update(['status' => 2]);
        
        return back()->with(toastr_success(__('Portfolio Successfully Rejected')));
    }

    public function delete_portfolio($id)
    {
        $portfolio = Portfolio::findOrFail($id);
        
        // Handle image deletion if necessary
        $image_path = 'assets/uploads/portfolio/' . $portfolio->image;
        if (file_exists($image_path) && !is_dir($image_path)) {
            unlink($image_path);
        }
        
        $portfolio->delete();
        return redirect()->back()->with(toastr_error(__('Portfolio Successfully Deleted.')));
    }

    public function portfolio_auto_approval_settings(Request $request)
    {
        if($request->isMethod('post')){
            $request->validate(['portfolio_auto_approval' => 'required']);
            $all_fields = ['portfolio_auto_approval'];

            foreach ($all_fields as $field) {
                update_static_option($field, $request->$field);
            }
            toastr_success(__('Auto Approval Settings Updated Successfully.'));
            return back();
        }
        return view('backend.pages.portfolio.portfolio-auto-approval-settings');
    }
}
