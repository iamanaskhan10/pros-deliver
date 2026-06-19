<?php

namespace App\Http\Controllers\Frontend\Freelancer;

use App\Helper\LogActivity;
use App\Http\Controllers\Controller;
use App\Mail\BasicMail;
use App\Models\Feedback;
use App\Models\IdentityVerification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use PragmaRX\Google2FALaravel\Support\Authenticator;
use Twilio\Rest\Client;
use Exception;

class InfluencerController extends Controller
{
    // freelancer profile settings page
    public function profile()
    {
        return view('frontend.user.influencer.profile.profile-settings');
    }

    // edit freelancer profile
    public function edit_profile(Request $request)
    {
        $request->validate(
            [
                'first_name'=>'required|min:1|max:50',
                'last_name'=>'required|min:1|max:50',
                'email'=>'required|email|unique:users,email,'.Auth::guard('web')->user()->id,
                'country'=>'required',
                'github_id'=>'required|max:50',
            ],
            [
                'first_name.required'=>'First name is required',
                'last_name.required'=>'Last name is required',
                'country_id.required'=>'Country is required',
                'github_id.required'=>'Professional title is required',
                'github_id.max'=>'Professional title max 50 characters',
            ]);

//        if((get_static_option('phone_otp_verify') == 'on')){
//            $request->validate([
//                'phone_number' => 'required|phone:AUTO,INTERNATIONAL',
//            ],
//                [
//                    'phone_number.phone' => __('Please enter a valid phone number'),
//                    'phone_number.required' => __('Phone number is required'),
//                ]);
//        }

        if($request->ajax()){
            $user = User::find(Auth::guard('web')->user()->id);
            $old_phone = $user->phone;
            $new_phone = $request->phone_number;
            $phone_otp_verify_on = get_static_option('phone_otp_verify') == 'on';

            // If phone changed and verification is on
            if ($phone_otp_verify_on && $new_phone != $old_phone) {
                // If OTP not provided yet, send it and ask for verification
                if (empty($request->phone_otp_code)) {
                    $otpCode = rand(100000, 999999);
                    $otpExpire = now()->addMinutes(6);

                    $user->update([
                        'phone_otp_code' => $otpCode,
                        'phone_otp_expiration' => $otpExpire,
                        'phone_otp_verify' => 0,
                    ]);

                    $message = __('Your verification code is: ') . $otpCode;

                    try {
                        $client = new Client(get_static_option('twilio_sid'), get_static_option('twilio_auth_token'));
                        $client->messages->create($new_phone, [
                            'from' => get_static_option('twilio_from_number'),
                            'body' => $message
                        ]);
                        
                        return response()->json([
                            'status' => 'needs_otp',
                            'msg' => __('Please verify the OTP sent to your new phone number'),
                        ]);
                    } catch (Exception $e) {
                        return response()->json([
                            'status' => 'error',
                            'msg' => __('Failed to send OTP: ') . $e->getMessage(),
                        ], 500);
                    }
                } else {
                    // OTP provided, verify it
                    if ($user->phone_otp_code != $request->phone_otp_code) {
                        return response()->json([
                            'status' => 'error',
                            'msg' => __('Invalid OTP code'),
                        ], 400);
                    }

                    if (now()->gt($user->phone_otp_expiration)) {
                        return response()->json([
                            'status' => 'error',
                            'msg' => __('OTP has expired'),
                        ], 400);
                    }

                    // OTP valid, proceed with update
                    $user->update([
                        'phone_otp_verify' => 1,
                        'phone_otp_code' => null,
                        'phone_otp_expiration' => null,
                    ]);
                }
            }

            $user->update([
                'first_name'=>$request->first_name,
                'last_name'=>$request->last_name,
                'email'=>$request->email,
                'country_id'=>$request->country,
                'state_id'=>$request->state,
                'city_id'=>$request->city,
                'github_id'=>$request->github_id,
                'phone' => $new_phone ?? '',
            ]);
            return response()->json([
                'status'=>'ok',
            ]);
        }
    }

    // edit influencer profile photo
    public function edit_profile_photo(Request $request)
    {
        $user_id = Auth::guard('web')->user()->id;
        $user_image = User::where('id',$user_id)->first();
        $delete_old_img =  'assets/uploads/profile/'.$user_image->image;

        $upload_folder = 'profile';

        if (cloudStorageExist() && in_array(Storage::getDefaultDriver(), ['s3', 'cloudFlareR2', 'wasabi'])) {
            if ($image = $request->file('image')) {
                $request->validate(
                    ['image'=>'required|mimes:jpg,jpeg,png,gif,svg,mp4,webm,avi,mov|max:2048'],
                    ['image.required'=>'Image is required']
                );
                $imageName = time().'-'.uniqid().'.'.$image->getClientOriginalExtension();

                // Get the current image path from the database
                $currentImagePath = $user_image->image;
                // Delete the old image if it exists
                if ($currentImagePath) {
                    delete_frontend_cloud_image_if_module_exists('profile/'.$currentImagePath);
                }
                add_frontend_cloud_image_if_module_exists($upload_folder, $image, $imageName,'public');
            }else{
                $imageName = $user_image->image;
            }
        }else{
            if ($image = $request->file('image')) {
                $request->validate(
                    ['image'=>'required|mimes:jpg,jpeg,png,gif,svg,mp4,webm,avi,mov|max:2048'],
                    ['image.required'=>'Image is required']
                );

                $imageName = time().'-'.uniqid().'.'.$image->getClientOriginalExtension();

                // Delete old file
                if(file_exists($delete_old_img)){
                    File::delete($delete_old_img);
                }

                $extension = $image->getClientOriginalExtension();

                // Check if it's an image or video
                if (in_array(strtolower($extension), ['jpg','jpeg','png','gif','svg','webp'])) {
                    // Resize only for images
                    $resize_full_image = Image::make($image)
                        ->fit(300, 300);
                    $resize_full_image->save('assets/uploads/profile' .'/'. $imageName);
                } else {
                    // Just store videos without resizing
                    $image->move('assets/uploads/profile', $imageName);
                }
            }else{
                $imageName = $user_image->image;
            }
        }

        if($request->ajax()){
            User::where('id',$user_id)->update(['image'=>$imageName]);
            if (cloudStorageExist() && in_array(Storage::getDefaultDriver(), ['s3', 'cloudFlareR2', 'wasabi'])) {
                $storage_driver = Storage::getDefaultDriver();
                User::where('id',$user_id)->update(['load_from'=>in_array($storage_driver,['CustomUploader']) ? 0 : 1,]);
            }
            return response()->json(['status'=>'ok']);
        }
    }

    // freelancer identity verification
    public function identity_verification(Request $request)
    {
        $user_id = Auth::guard('web')->user()->id;
        if($request->isMethod('post')){

            $request->validate([
                'country'=>'required',
                'address'=>'required|max:191',
                'national_id_number'=>'required|max:255',
                'front_image'=>'required|image|mimes:jpeg,png,jpg|max:5120',
                'back_image'=>'required|image|mimes:jpeg,png,jpg|max:5120',
            ]);

            if(moduleExists('CoinPaymentGateway')){
            }else{
                $request->validate([
                    'state'=>'required',
                    'zipcode'=>'required|max:191',
                ]);
            }

            $verification_image = IdentityVerification::where('user_id',$user_id)->first();
            $delete_front_img = '';
            $delete_back_img = '';
            $upload_folder = 'verification';
            $storage_driver = Storage::getDefaultDriver();

            if(!empty($verification_image)){
                $delete_front_img =  'assets/uploads/verification/'.$verification_image->front_image;
                $delete_back_img =  'assets/uploads/verification/'.$verification_image->back_image;
            }

            if (cloudStorageExist() && in_array(Storage::getDefaultDriver(), ['s3', 'cloudFlareR2', 'wasabi'])) {
                if ($image = $request->file('front_image')) {
                    $front_image_name = time().'-'.uniqid().'.'.$image->getClientOriginalExtension();

                    if(!empty($verification_image)) {
                        // Get the current image path from the database
                        $currentImagePath = $verification_image->front_image;
                        // Delete the old image if it exists
                        if ($currentImagePath) {
                            delete_frontend_cloud_image_if_module_exists('verification/' . $currentImagePath);
                        }
                    }
                    add_frontend_cloud_image_if_module_exists($upload_folder, $image, $front_image_name,'public');
                }else{
                    $front_image_name = $verification_image->front_image;
                }
            }else{
                if ($image = $request->file('front_image')) {
                    if(file_exists($delete_front_img)){
                        File::delete($delete_front_img);
                    }
                    $front_image_name = time().'-'.uniqid().'.'.$image->getClientOriginalExtension();
                    $resize_full_image = Image::make($request->front_image)
                        ->resize(500, 300);
                    $resize_full_image->save('assets/uploads/verification' .'/'. $front_image_name);
                }else{
                    $front_image_name = $verification_image->front_image;
                }
            }


            if (cloudStorageExist() && in_array(Storage::getDefaultDriver(), ['s3', 'cloudFlareR2', 'wasabi'])) {
                if ($image = $request->file('back_image')) {
                    $back_image_name = time().'-'.uniqid().'.'.$image->getClientOriginalExtension();

                    if(!empty($verification_image)) {
                        // Get the current image path from the database
                        $currentImagePath = $verification_image->back_image;
                        // Delete the old image if it exists
                        if ($currentImagePath) {
                            delete_frontend_cloud_image_if_module_exists('verification/' . $currentImagePath);
                        }
                    }
                    add_frontend_cloud_image_if_module_exists($upload_folder, $image, $back_image_name,'public');
                }else{
                    $back_image_name = $verification_image->back_image;
                }
            }else{
                if ($image = $request->file('back_image')) {
                    if(file_exists($delete_back_img)){
                        File::delete($delete_back_img);
                    }
                    $back_image_name= time().'-'.uniqid().'.'.$image->getClientOriginalExtension();
                    $resize_full_image = Image::make($request->back_image)
                        ->resize(500, 300);
                    $resize_full_image->save('assets/uploads/verification' .'/'. $back_image_name);
                }else{
                    $back_image_name = $verification_image->back_image;
                }
            }


            IdentityVerification::updateOrCreate(
                ['user_id'=> $user_id],
                [
                    'user_id'=>$user_id,
                    'verify_by'=>$request->verify_by,
                    'country_id'=>$request->country,
                    'state_id'=>$request->state ?? 0,
                    'city_id'=>$request->city ?? 0,
                    'address'=>$request->address,
                    'zipcode'=>$request->zipcode ?? 0,
                    'national_id_number'=>$request->national_id_number,
                    'front_image'=>$front_image_name,
                    'back_image'=>$back_image_name,
                    'status'=>null,
                    'load_from' => in_array($storage_driver,['CustomUploader']) ? 0 : 1, // 0=local 1=cloud
                ]
            );
            try {
                $message = get_static_option('user_identity_verify_message') ?? "<p>{{ __('Hello')}},</p></p>{{ __('You have a new request for user identity verification')}}</p>";
                Mail::to(get_static_option('site_global_email'))->send(new BasicMail([
                    'subject' => get_static_option('user_identity_verify_subject') ?? __('User Identity Verify Email'),
                    'message' => $message
                ]));
            }
            catch (\Exception $e) {}
            return response()->json(['status'=>'success']);
        }
        $user_identity = IdentityVerification::where('user_id',$user_id)->first();
        return view('frontend.user.influencer.identity.verification',compact('user_identity'));
    }

    // check password
    public function check_password(Request $request)
    {
        if ($request->isMethod('post')) {
            $current_password = User::select('password')->where('id',Auth::user()->id)->first();
            if (Hash::check($request->current_password, $current_password->password)) {
                return response()->json([
                    'status'=>'match',
                    'msg'=>__('Current password match'),
                ]);
            }else{
                return response()->json([
                    'msg'=>__('Current password is wrong'),
                ]);
            }
        }
    }

    // password change
    public function change_password(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'current_password' => 'required|min:6|max:191',
                'new_password' => 'required|min:6|max:191',
                'confirm_new_password' => 'required|min:6|max:191',
            ]);
            $user = User::select(['id','password'])->where('id',Auth::user()->id)->first();

            if (Hash::check($request->current_password, $user->password)) {
                if ($request->new_password == $request->confirm_new_password) {
                    //security manage
                    if(moduleExists('SecurityManage')){
                        LogActivity::addToLog('Password change','Freelancer');
                    }
                    User::where('id', $user->id)->update(['password' => Hash::make($request->new_password)]);
                    return response()->json(['status'=>'success']);
                }
                return response()->json(['status'=>'not_match']);
            }
            return response()->json(['status'=>'current_pass_wrong']);
        }
        return view('frontend.user.influencer.password.password');
    }

    // submit feedback
    public function submit_feedback(Request $request)
    {
        $request->validate([
            'title' => 'required|min:6|max:191',
            'description' => 'required|min:10|max:500',
            'rating' => 'required|integer|min:1|max:5',
        ]);

       $feedback = Feedback::updateOrCreate(
           [
               'user_id'=> Auth::guard('web')->user()->id
           ],
            [
            'user_id' =>Auth::guard('web')->user()->id,
            'title' =>$request->title,
            'description' =>$request->description,
            'rating' =>$request->rating,
            'status' =>0,
        ]);

        return !empty($feedback) ? response()->json(['status'=>'success']) : response()->json(['status'=>'failed','msg' => __('Something Went wrong')]);

    }

    //account delete
    public function account_delete(Request $request)
    {
        if ($request->isMethod('post')) {
            //security manage
            if(moduleExists('SecurityManage')){
                LogActivity::addToLog('Account delete','Freelancer');
            }
            User::find(Auth::user()->id)->delete();
            Auth::guard('web')->logout();
            return redirect()->route('homepage');
        }
        return view('frontend.user.influencer.profile.account-delete');
    }

    // freelancer logout
    public function logout()
    {
        //security manage
        if(moduleExists('SecurityManage')){
            LogActivity::addToLog('User logout','Freelancer');
        }
        if(Session::has('user_role')){Session::forget('user_role');}
        Auth::guard('web')->logout();
        (new Authenticator(request()))->logout();
        return redirect()->route('homepage');
    }

    // Send OTP for a NEW phone number (before saving it to profile)
    public function sendNewPhoneOtp(Request $request)
    {
        if (get_static_option('phone_otp_verify') !== 'on') {
            return response()->json(['status' => 'error', 'message' => __('Phone OTP verification is not enabled')], 400);
        }

        $request->validate([
            'phone_number' => 'required'
        ]);

        $user = Auth::guard('web')->user();
        $new_phone = $request->phone_number;

        // Generate OTP
        $otpCode = rand(100000, 999999);
        $otpExpire = now()->addMinutes(6);

        // Store pending verification in Cache
        Cache::put('phone_verify_pending_' . $user->id, [
            'phone' => $new_phone,
            'otp' => $otpCode,
            'expires_at' => $otpExpire
        ], 600); // 10 minutes TTL

        // Also update user record just in case we need fallback, but mainly for the OTP column compatibility
        $user->update([
            'phone_otp_code' => $otpCode,
            'phone_otp_expiration' => $otpExpire,
            'phone_otp_verify' => 0,
        ]);

        $message = __('Your verification code is: ') . $otpCode;

        try {
            $client = new Client(get_static_option('twilio_sid'), get_static_option('twilio_auth_token'));
            $client->messages->create($new_phone, [
                'from' => get_static_option('twilio_from_number'),
                'body' => $message
            ]);

            return response()->json([
                'status' => 'success',
                'message' => __('OTP sent to ') . $new_phone
            ]);

        } catch (Exception $e) {
            info("Twilio OTP send failed: " . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => __('Failed to send OTP: ') . $e->getMessage()
            ], 500);
        }
    }

    // Verify OTP and Update Phone Number
    public function verifyNewPhoneOtp(Request $request)
    {
        $request->validate([
            'otp_code' => 'required',
            'phone_number' => 'required'
        ]);

        $user = Auth::guard('web')->user();
        $cachedData = Cache::get('phone_verify_pending_' . $user->id);

        if (!$cachedData) {
             // Fallback to database check if cache missing (e.g. redis cleared)
             if ($user->phone_otp_code == $request->otp_code && now()->lt($user->phone_otp_expiration)) {
                 // But we need to be carefully about WHICH phone number.
                 // If we strictly require cache for new phone, it's safer.
                 // Let's rely on cache primarily.
                 return response()->json(['status' => 'error', 'message' => __('Session expired. Please click Send OTP again.')], 400);
             }
             return response()->json(['status' => 'error', 'message' => __('Session expired. Please click Send OTP again.')], 400);
        }

        if ($cachedData['phone'] !== $request->phone_number) {
            return response()->json(['status' => 'error', 'message' => __('Phone number mismatch. Please retry.')], 400);
        }
        
        if ($cachedData['otp'] != $request->otp_code) {
             return response()->json(['status' => 'error', 'message' => __('Invalid OTP code')], 400);
        }

        // OTP Valid! Update User Phone
        $user->update([
            'phone' => $cachedData['phone'],
            'phone_otp_verify' => 1,
            'phone_otp_code' => null,
            'phone_otp_expiration' => null,
        ]);

        // Clear cache
        Cache::forget('phone_verify_pending_' . $user->id);

        return response()->json([
            'status' => 'success',
            'message' => __('Phone number verified and updated successfully!')
        ]);
    }
}
