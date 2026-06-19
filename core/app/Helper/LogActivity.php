<?php

namespace App\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use \Modules\SecurityManage\Entities\LogActivity as LogActivityModel;


class LogActivity

{
    public static function addToLog($subject=null,$type=null)
    {
        $log = [];
        $log['subject'] = $subject;
        $log['url'] = request()->fullUrl() ?? '';
        $log['method'] = request()->method() ?? '';
        $log['ip'] = request()->ip() ?? '';
        $log['agent'] = request()->header('user-agent') ?? '';
        $log['type'] = $type ?? '';
        $log['user_id'] = Auth::guard('web')->check() ? Auth::guard('web')->id() : (Auth::guard('admin')->check() ? Auth::guard('admin')->id() : null);
        LogActivityModel::create($log);
    }
}