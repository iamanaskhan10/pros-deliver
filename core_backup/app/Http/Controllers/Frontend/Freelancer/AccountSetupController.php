<?php

namespace App\Http\Controllers\Frontend\Freelancer;

use App\Http\Controllers\Controller;
use App\Models\CategoryUser;
use App\Models\Skill;
use App\Models\SocialProfile;
use App\Models\User;
use App\Models\UserEducation;
use App\Models\UserIntroduction;
use App\Models\UserLang;
use App\Models\UserSkill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Modules\Service\Entities\Category;

class AccountSetupController extends Controller
{
    // account setup main page
    public function account_setup()
    {
        $user_id = Auth::guard('web')->user()->id;
        $user_introduction = UserIntroduction::where('user_id', $user_id)->first();
        $social_profiles = SocialProfile::where('user_id', $user_id)->latest()->get();
        $educations = UserEducation::where('user_id', $user_id)->latest()->get();
        $categories = Category::where('status', 1)->take(5)->get();
        $categoriesIds = $categories->pluck('id');
        $count = Category::count();
        $skip = 5;
        $limit = $count - $skip; // the limit
        $more_categories = $limit > 0 ? Category::select(['id', 'category', 'slug', 'image'])->where('status', 1)->whereNotIn('id', $categoriesIds)->get() : collect();
        $user = User::with('categories')->find($user_id);
        $user_work_categories = $user->categories->pluck('id')->toArray();
        if ($user_work_categories) {
            $skills_according_to_category = Skill::select(['id', 'skill'])->whereIn('category_id', $user_work_categories)->get();
        } else {
            $skills_according_to_category = '';
        }

        return view('frontend.user.influencer.account.account-setup', compact([
            'user_introduction',
            'social_profiles',
            'educations',
            'categories',
            'more_categories',
            'user_work_categories',
            'skills_according_to_category',
        ]));
    }

    // add introduction
    public function add_introduction(Request $request)
    {
        $request->validate([
            'gender' => 'required|max:250',
            'description' => 'required|max:250',
        ]);

        if ($request->ajax()) {

            // Prevent restricted words for introduction
            if(moduleExists('SecurityManage')) {
                $description = $request->description;
                $combinedText = strtolower($description);
                
                $restrictedWords = \Modules\SecurityManage\Entities\Word::where('status', 'active')->pluck('word')->toArray();

                $matchedWords = array_filter($restrictedWords, function($word) use ($combinedText) {
                    return strpos($combinedText, strtolower($word)) !== false;
                });

                if (count($matchedWords) > 0) {
                    return response()->json([
                        'status' => 'error',
                        'message' => __('You cannot use restricted words: ') . implode(', ', $matchedWords)
                    ]);
                }
            }

            $user_id = Auth::guard('web')->user()->id;
            UserIntroduction::updateOrCreate(['user_id' => $user_id],
                [
                    'user_id' => $user_id,
                    'description' => $request->description,
                ]);

            User::where('id', $user_id)->update([
                'gender' => $request->gender,
            ]);

            return response()->json([
                'status' => 'ok',
            ]);
        }
    }

    // add social profile
    public function add_social_link(Request $request)
    {
        $request->validate([
            'profile_link' => 'required',
            'followers' => 'required',
            'platform_icon' => 'required',
        ]);
        if ($request->ajax()) {
            $user_id = Auth::user()->id;
            SocialProfile::create(
                [
                    'user_id' => $user_id,
                    'profile_link' => $request->profile_link,
                    'followers' => $request->followers,
                    'platform_icon' => $request->platform_icon,
                ]);

            return response()->json([
                'status' => 'ok',
            ]);
        }
    }

    // edit social link
    public function update_social_link(Request $request)
    {
        $request->validate([
            'profile_link' => 'required',
            'followers' => 'required',
            'platform_icon' => 'required',
        ]);
        if ($request->ajax()) {
            $user_id = Auth::user()->id;
            SocialProfile::where('id', $request->id)->update(
                [
                    'user_id' => $user_id,
                    'profile_link' => $request->profile_link,
                    'followers' => $request->followers,
                    'platform_icon' => $request->platform_icon,
                ]);

            return response()->json([
                'status' => 'ok',
            ]);
        }
    }

    // delete social link
    public function delete_social_link(Request $request)
    {
        $request->validate([
            'id' => 'required',
        ]);
        if ($request->ajax()) {
            $user_id = Auth::user()->id;
            SocialProfile::where('id', $request->id)->where('user_id', $user_id)->delete();

            return response()->json([
                'status' => 'ok',
            ]);
        }
    }

    // add category
    public function add_work(Request $request)
    {
        $request->validate([
            'category' => 'required',
        ]);

        if ($request->ajax()) {
            $user_id = Auth::user()->id;
            $categories = is_string($request->category) ? explode(',', $request->category) : $request->category;
            // delete old categories
            CategoryUser::where('user_id', $user_id)->delete();
            foreach ($categories as $category) {
                CategoryUser::create([
                    'user_id' => $user_id,
                    'category_id' => $category,
                ]);
            }

            return response()->json([
                'status' => 'ok',
            ]);
        }
    }

    // add skill
    public function add_skill(Request $request)
    {
        $request->validate([
            'skill' => 'required|max:1000',
        ]);

        if ($request->ajax()) {
            $user_id = Auth::user()->id;
            UserSkill::updateOrCreate(['user_id' => $user_id],
                [
                    'user_id' => $user_id,
                    'skill' => $request->skill,
                ]);

            return response()->json([
                'status' => 'ok',
            ]);
        }
    }

    // add language
    public function add_lang(Request $request)
    {
        $request->validate([
            'lang' => 'required|max:1000',
        ]);

        if ($request->ajax()) {
            $user_id = Auth::user()->id;
            UserLang::updateOrCreate(['user_id' => $user_id],
                [
                    'user_id' => $user_id,
                    'lang' => $request->lang,
                ]);

            return response()->json([
                'status' => 'ok',
            ]);
        }
    }

    // add location
    public function location(Request $request)
    {
        $request->validate([
            'country_id' => 'required',
            'state_id' => 'required',
            'city_id' => 'required',
        ]);

        if ($request->ajax()) {
            $user_id = Auth::guard('web')->user()->id;
            User::where('id', $user_id)->update([
                'country_id' => $request->country_id,
                'state_id' => $request->state_id,
                'city_id' => $request->city_id,
            ]);

            return response()->json([
                'status' => 'ok',
            ]);
        }
    }

    // add hourly rate
    public function add_hourly_rate(Request $request)
    {
        $request->validate([
            'hourly_rate' => 'required|numeric|max:1000',
        ]);

        if ($request->ajax()) {
            $user_id = Auth::user()->id;
            User::where('id', $user_id)->update([
                'hourly_rate' => $request->hourly_rate,
            ]);
            if (! moduleExists('HourlyJob')) {
                User::where('id', $user_id)->update([
                    'hourly_rate' => 0,
                ]);
            }

            return response()->json([
                'status' => 'ok',
            ]);
        }
    }

    // upload profile photo
    public function upload_profile_photo(Request $request)
    {
        $user_id = Auth::guard('web')->user()->id;
        $user_image = User::where('id', $user_id)->first();
        $delete_old_img = 'assets/uploads/profile/'.$user_image->image;

        $upload_folder = 'profile';
        $storage_driver = Storage::getDefaultDriver();

        if ($image = $request->file('profile_image')) {
            if (file_exists($delete_old_img)) {
                File::delete($delete_old_img);
            }
            $imageName = time().'-'.uniqid().'.'.$image->getClientOriginalExtension();
            $resize_full_image = Image::make($request->profile_image)
                ->fit(300, 300);

            if (cloudStorageExist() && in_array(Storage::getDefaultDriver(), ['s3', 'cloudFlareR2', 'wasabi'])) {
                if (! empty($user_image)) {
                    // Get the current image path from the database
                    $currentImagePath = $user_image->image;
                    // Delete the old image if it exists
                    if ($currentImagePath) {
                        delete_frontend_cloud_image_if_module_exists('profile/'.$currentImagePath);
                    }
                }
                add_frontend_cloud_image_if_module_exists($upload_folder, $image, $imageName, 'public');
            } else {
                $resize_full_image->save('assets/uploads/profile'.'/'.$imageName);
            }

        } else {
            $imageName = $user_image->image;
        }

        User::where('id', $user_id)->update([
            'image' => $imageName,
            'load_from' => in_array($storage_driver, ['CustomUploader']) ? 0 : 1, // added for cloud storage 0=local 1=cloud
        ]);

        return response()->json([
            'status' => 'uploaded',
        ]);
    }

    // congrats
    public function congrats()
    {
        return view('frontend.user.influencer.account.congrats');
    }
}
