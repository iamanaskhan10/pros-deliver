<?php

namespace App\Http\Controllers\Backend;

use App\Events\UserNotificationEvent;
use App\Http\Controllers\Controller;
use App\Mail\BasicMail;
use App\Models\AdminNotification;
use App\Models\Bookmark;
use App\Models\Job;
use App\Models\JobHistory;
use App\Models\JobPost;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class JobController extends Controller
{
    public function all_job()
    {
        $all_jobs = JobPost::whereHas('job_creator')->latest()->paginate(10);
        return view('backend.pages.job.all-job',compact('all_jobs'));
    }

    public function search_job(Request $request)
    {
        $all_jobs= JobPost::whereHas('job_creator')->where('type','fixed')->where('title', 'LIKE', "%". strip_tags($request->string_search) ."%")->paginate(10);
        return $all_jobs->total() >= 1 ? view('backend.pages.job.search-result', compact('all_jobs'))->render() : response()->json(['status'=>__('nothing')]);
    }

    // pagination
    function pagination(Request $request)
    {
        if($request->ajax()){
            if(!empty($request->string_search)){
                $all_jobs= JobPost::whereHas('job_creator')->where('type','fixed')->where('title', 'LIKE', "%". strip_tags($request->string_search) ."%")->paginate(10);
            }else{
                $all_jobs = JobPost::whereHas('job_creator')->latest()->paginate(10);
            }
            return view('backend.pages.job.search-result', compact('all_jobs'))->render();
        }
    }

    //  campaign details
    public function job_details($id=null)
    {
        JobPost::findOrFail($id);
        $job = JobPost::with(['job_category','job_history'])->whereHas('job_creator')->where('id',$id)->first();

        if($job){
            $user = User::with(['user_introduction','user_country','user_state','user_city'])->where('id',$job->user_id)->first();
            $complete_jobs_count = Order::where('is_project_job','job')->where('status',3)->where('user_id',$job->user_id)->get();
            AdminNotification::where('identity',$id)->update(['is_read'=>1]);
            return isset($job) ? view('backend.pages.job.job-details',compact(['job','user','complete_jobs_count'])) : back();
        }else{
            return back();
        }

    }

    //  campaign status change active-to-inactive-to-active
    public function change_status($id=null)
    {
        $job = JobPost::where('id',$id)->first();
        $user = User::where('id',$job->user_id)->first();

        $status = $job->status == 1 ? 0 : 1;
        JobPost::where('id',$id)->update(['status'=>$status]);
        if($job->status == 0){

            try {
                $message = get_static_option('job_approve_email_message') ?? __('Your campaign has been activate.');
                $message = str_replace(["@name","@campaign_id"],[$user->first_name.' '.$user->last_name, $id], $message);
                Mail::to($user->email)->send(new BasicMail([
                    'subject' => get_static_option('job_approve_email_subject') ?? __('Campaign Activate Email'),
                    'message' => $message
                ]));
            }
            catch (\Exception $e) {}
            client_notification($id, $job->user_id, 'Job', __('Your campaign has been activate'));
            event(new UserNotificationEvent(__('Your campaign has been activate'), $job->user_id));
            return back()->with(toastr_success(__('Campaign Status Successfully Changed')));
        }else{
            try {
                $message = get_static_option('job_decline_email_message') ?? __('Your campaign has been rejected.');
                $message = str_replace(["@name","@campaign_id"],[$user->first_name.' '.$user->last_name, $id], $message);
                Mail::to($user->email)->send(new BasicMail([
                    'subject' => get_static_option('job_decline_email_subject') ?? __('Campaign Reject Email'),
                    'message' => $message
                ]));
            }
            catch (\Exception $e) {}
            client_notification($id, $job->user_id, 'Job', __('Your campaign has been rejected'));
            event(new UserNotificationEvent(__('Your campaign has been activate'), $job->user_id));
            return back()->with(toastr_success(__('Campaign Successfully Rejected')));
        }
    }

    //  campaign status change active-to-inactive-to-active
    public function reject_job($id=null)
    {
        $job = JobPost::where('id',$id)->first();
        $user = User::where('id',$job->user_id)->first();
        // job_approve_request=2 means user must have edit the job and resubmit for activate.
        JobPost::where('id',$id)->update(['status'=>2,'job_approve_request'=>2]);
        $job_id_from_job_history_table = JobHistory::where('job_id', $id)->first();

        if(empty($job_id_from_job_history_table)){
            JobHistory::Create([
                'job_id'=>$job->id,
                'user_id'=>$job->user_id,
                'reject_count'=>1,
                'edit_count'=>0,
            ]);
        }else{
            JobHistory::where('job_id',$id)->update([
                'reject_count'=>$job_id_from_job_history_table->reject_count + 1
            ]);
        }

        try {
            $message = get_static_option('job_decline_email_message') ?? __('Your campaign has been rejected.');
            $message = str_replace(["@name","@campaign_id"],[$user->first_name.' '.$user->last_name, $id], $message);
            Mail::to($user->email)->send(new BasicMail([
                'subject' => get_static_option('job_decline_email_subject') ?? __('Campaign Reject Email'),
                'message' => $message
            ]));
        }catch (\Exception $e) {}

        return back()->with(toastr_success(__('Campaign Successfully Rejected')));
    }

    // delete single campaign
    public function delete_job($id)
    {
        JobHistory::where('job_id',$id)->delete();
        AdminNotification::where('identity',$id)->delete();
        Bookmark::where('identity',$id)->where('is_project_job','job')->delete();
        JobPost::find($id)->delete();
        return redirect()->back()->with(toastr_error(__('Campaign Successfully Deleted.')));
    }

    //auto approval settings
    public function auto_approval_settings(Request $request)
    {
        if($request->isMethod('post')){
            $request->validate(['job_auto_approval' => 'required']);
            $all_fields = ['job_auto_approval'];

            foreach ($all_fields as $field) {
                update_static_option($field, $request->$field);
            }
            toastr_success(__('Auto Approval Settings Updated Successfully.'));
            return back();
        }
        return view('backend.pages.job.job-auto-approval-settings');
    }
}
