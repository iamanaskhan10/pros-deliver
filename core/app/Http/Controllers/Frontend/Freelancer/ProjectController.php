<?php

namespace App\Http\Controllers\Frontend\Freelancer;

use App\Helper\LogActivity;
use App\Http\Controllers\Controller;
use App\Mail\BasicMail;
use App\Models\AdminNotification;
use App\Models\MediaUpload;
use App\Models\Project;
use App\Models\ProjectAttribute;
use App\Models\ProjectHistory;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Modules\Service\Entities\SubCategory;

class ProjectController extends Controller
{
    // project create
    public function create_project(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'category' => 'required',
                'project_title' => 'required|min:20|max:100',
                'project_description' => 'required|min:50',
                'slug' => 'required|max:191|unique:projects,slug',
                'basic_title' => 'required|max:191',
                'basic_regular_charge' => 'required|numeric|integer',
                'checkbox_or_numeric_title' => 'required|array|max:191',
                'meta_title' => 'nullable|max:255',
                'meta_description' => 'nullable|max:500',
                'gallery_images' => 'required',
            ]);

            if (!empty($request->gallery_images)) {
                $gallery_ids = explode('|', $request->gallery_images);
                $gallery_items = MediaUpload::whereIn('id', $gallery_ids)->get();

                $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

                foreach ($gallery_items as $item) {
                    $extension = strtolower(pathinfo($item->path, PATHINFO_EXTENSION));

                    if (!in_array($extension, $allowed_extensions)) {
                        return back()->with(toastr_warning(__('Image format must be jpg, jpeg, png, gif and webp')));
                    }
                }
            }

            if (!empty($request->video)) {
                $get_video = MediaUpload::where('id', $request->video)->first();
                $extension = pathinfo($get_video->path, PATHINFO_EXTENSION);

                if (strtolower($extension) !== 'mp4') {
                    return back()->with(toastr_warning(__('Video format is not supported, only MP4 files are allowed.')));
                }
            }


            if (get_static_option('project_auto_approval') == 'yes') {
                $project_auto_approval = 1;
                $project_approve_request = 1;
            } else {
                $project_auto_approval = 0;
                $project_approve_request = 0;
            }


            $standard_title = null;
            $premium_title = null;
            $standard_regular_charge = null;
            $standard_discount_charge = null;
            $premium_regular_charge = null;
            $premium_discount_charge = null;

            if ($request->offer_packages_available_or_not == 1) {
                $standard_title = $request->standard_title;
                $premium_title = $request->premium_title;
                $standard_regular_charge = $request->standard_regular_charge;
                $standard_discount_charge = $request->standard_discount_charge;
                $premium_regular_charge = $request->premium_regular_charge;
                $premium_discount_charge = $request->premium_discount_charge;
            }

            $user_id  = Auth::guard('web')->user()->id;
            $slug = !empty($request->slug) ? $request->slug : $request->project_title;

            DB::beginTransaction();
            try {
                $storage_driver = Storage::getDefaultDriver();
                $project = Project::create([
                    'user_id' => $user_id,
                    'category_id' => $request->category,
                    'title' => $request->project_title,
                    'slug' => Str::slug(purify_html($slug), '-', null),
                    'description' => $request->project_description,
                    'image' => $request->gallery_images,
                    'video' => $request->video ?? null,
                    'basic_title' => $request->basic_title,
                    'standard_title' => $standard_title,
                    'premium_title' => $premium_title,
                    'basic_revision' => $request->basic_revision,
                    'standard_revision' => $request->standard_revision,
                    'premium_revision' => $request->premium_revision,
                    'basic_delivery' => $request->basic_delivery,
                    'standard_delivery' => $request->standard_delivery,
                    'premium_delivery' => $request->premium_delivery,
                    'basic_regular_charge' => $request->basic_regular_charge,
                    'basic_discount_charge' => $request->basic_discount_charge,
                    'standard_regular_charge' => $standard_regular_charge,
                    'standard_discount_charge' => $standard_discount_charge,
                    'premium_regular_charge' => $premium_regular_charge,
                    'premium_discount_charge' => $premium_discount_charge,
                    'project_on_off' => 1,
                    'status' => $project_auto_approval,
                    'project_approve_request' => $project_approve_request,
                    'offer_packages_available_or_not' => $request->offer_packages_available_or_not,
                    'meta_title' => $request->meta_title,
                    'meta_description' => $request->meta_description,
                    'load_from' => in_array($storage_driver, ['CustomUploader']) ? 0 : 1, //added for cloud storage 0=local 1=cloud
                ]);
                $project->project_sub_categories()->attach($request->subcategory);

                $arr = [];
                foreach ($request->checkbox_or_numeric_title as $key => $attr):

                    $attr_value = preg_replace('/[^a-z0-9_]/', '_', strtolower($attr));
                    $field_type = $request->checkbox_or_numeric_select[$key] ?? 'checkbox';

                    switch ($field_type) {
                        case 'checkbox':
                            $fallback_value = "off";
                            break;
                        case 'numeric':
                            $fallback_value = 0;
                            break;
                        case 'text':
                            $fallback_value = "";
                            break;
                        default:
                            $fallback_value = "off";
                    }

                    $arr[] = [
                        'user_id' => $user_id,
                        'create_project_id' => $project->id,
                        'check_numeric_title' => $attr,
                        'basic_check_numeric' => $request->$attr_value["basic"] ?? $fallback_value,
                        'standard_check_numeric' => $request->$attr_value["standard"] ?? $fallback_value,
                        'premium_check_numeric' => $request->$attr_value["premium"] ?? $fallback_value,
                        'type' => $request->checkbox_or_numeric_select[$key] ?? null,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s'),
                    ];
                endforeach;

                $data = Validator::make($arr, ["*.basic_check_numeric" => "nullable"]);
                $data->validated();

                ProjectAttribute::insert($arr);

                $metaData = $this->generateProjectMetaData($request);
                $project->metaData()->create($metaData);

                //security manage
                if (moduleExists('SecurityManage')) {
                    LogActivity::addToLog('Project create', 'Freelancer');
                }

                DB::commit();
            } catch (Exception $e) {

                DB::rollBack();
                toastr_error(__('Basic check field is required'));
                return back();
            }
            try {
                $message = get_static_option('project_create_email_message') ?? __('A new project is just created.');
                $message = str_replace(["@project_id"], [$project->id], $message);
                Mail::to(get_static_option('site_global_email'))->send(new BasicMail([
                    'subject' => get_static_option('project_create_email_subject') ?? __('Project Create Email'),
                    'message' => $message
                ]));
            } catch (\Exception $e) {
            }

            //create project notification to admin
            AdminNotification::create([
                'identity' => $project->id,
                'user_id' => $user_id,
                'type' => 'Create Project',
                'message' => __('A new project has been created'),
            ]);
            toastr_success(__('Project Successfully Created'));
            return redirect()->route('influencer.profile.details', Auth::guard('web')->user()->username);
        }

        return view('frontend.user.influencer.project.create.create-project');
    }

    // project edit
    public function edit_project(Request $request, $id)
    {
        $project_details = Project::with('project_attributes')
            ->where('user_id', Auth::guard('web')->user()->id)
            ->where('id', $id)->first();

        $get_sub_categories_from_project_category = SubCategory::where('category_id', $project_details->category_id)->get() ?? '';

        if ($request->isMethod('post')) {

            $request->validate([
                'project_title' => 'required|min:20|max:100|unique:projects,title,' . $id,
                'project_description' => 'required|min:50',
                'slug' => 'required|max:191|unique:projects,slug,' . $id,
                'basic_title' => 'required|max:191',
                'basic_regular_charge' => 'required|numeric|integer',
                'checkbox_or_numeric_title' => 'required|array|max:191',
                'meta_title' => 'nullable|max:255',
                'meta_description' => 'nullable|max:500',
                'gallery_images' => 'required',
                'video' => 'nullable|max:10240',
            ]);

            if (!empty($request->gallery_images)) {
                $gallery_ids = explode('|', $request->gallery_images);
                $gallery_items = MediaUpload::whereIn('id', $gallery_ids)->get();

                $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

                foreach ($gallery_items as $item) {
                    $extension = strtolower(pathinfo($item->path, PATHINFO_EXTENSION));

                    if (!in_array($extension, $allowed_extensions)) {
                        return back()->with(toastr_warning(__('Image format must be jpg, jpeg, png, gif and webp')));
                    }
                }
            }

            if (!empty($request->video)) {
                $get_video = MediaUpload::where('id', $request->video)->first();
                $extension = pathinfo($get_video->path, PATHINFO_EXTENSION);

                if (strtolower($extension) !== 'mp4') {
                    return back()->with(toastr_warning(__('Video format is not supported, only MP4 files are allowed.')));
                }
            }


            $standard_title = null;
            $premium_title = null;
            $standard_regular_charge = null;
            $standard_discount_charge = null;
            $premium_regular_charge = null;
            $premium_discount_charge = null;

            if ($request->offer_packages_available_or_not == 1) {
                $standard_title = $request->standard_title;
                $premium_title = $request->premium_title;
                $standard_regular_charge = $request->standard_regular_charge;
                $standard_discount_charge = $request->standard_discount_charge;
                $premium_regular_charge = $request->premium_regular_charge;
                $premium_discount_charge = $request->premium_discount_charge;
            }

            $user_id  = Auth::guard('web')->user()->id;
            $slug = !empty($request->slug) ? $request->slug : $request->project_title;
            DB::beginTransaction();
            try {
                Project::where('id', $id)->update([
                    'user_id' => $user_id,
                    'category_id' => $request->category,
                    'title' => $request->project_title,
                    'slug' => Str::slug(purify_html($slug), '-', null),
                    'description' => $request->project_description,
                    'image' => $request->gallery_images,
                    'video' => $request->video ?? null,
                    'basic_title' => $request->basic_title,
                    'standard_title' => $standard_title,
                    'premium_title' => $premium_title,
                    'basic_revision' => $request->basic_revision,
                    'standard_revision' => $request->standard_revision,
                    'premium_revision' => $request->premium_revision,
                    'basic_delivery' => $request->basic_delivery,
                    'standard_delivery' => $request->standard_delivery,
                    'premium_delivery' => $request->premium_delivery,
                    'basic_regular_charge' => $request->basic_regular_charge,
                    'basic_discount_charge' => $request->basic_discount_charge,
                    'standard_regular_charge' => $standard_regular_charge,
                    'standard_discount_charge' => $standard_discount_charge,
                    'premium_regular_charge' => $premium_regular_charge,
                    'premium_discount_charge' => $premium_discount_charge,
                    'project_on_off' => 1,
                    'project_approve_request' => $project_details->project_approve_request == 1 ? 1 : 0,
                    'offer_packages_available_or_not' => $request->offer_packages_available_or_not ?? 0,
                    'meta_title' => $request->meta_title,
                    'meta_description' => $request->meta_description,
                ]);

                //update project pivot table data
                $project = Project::find($id);
                $project->project_sub_categories()->sync($request->subcategory);

                ProjectAttribute::where('create_project_id', $id)->delete();

                $arr = [];
                foreach ($request->checkbox_or_numeric_title as $key => $attr):
                    $attr_value = preg_replace('/[^a-z0-9_]/', '_', strtolower($attr));

                    $field_type = $request->checkbox_or_numeric_select[$key] ?? 'checkbox';

                    switch ($field_type) {
                        case 'checkbox':
                            $fallback_value = "off";
                            break;
                        case 'numeric':
                            $fallback_value = 0;
                            break;
                        case 'text':
                            $fallback_value = "";
                            break;
                        default:
                            $fallback_value = "off";
                    }

                    $arr[] = [
                        'user_id' => $user_id,
                        'create_project_id' => $id,
                        'check_numeric_title' => $attr,
                        'basic_check_numeric' => $request->$attr_value["basic"] ?? $fallback_value,
                        'standard_check_numeric' => $request->$attr_value["standard"] ?? $fallback_value,
                        'premium_check_numeric' => $request->$attr_value["premium"] ?? $fallback_value,
                        'type' => $request->checkbox_or_numeric_select[$key] ?? null,
                        'updated_at' => date('Y-m-d H:i:s'),
                    ];

                endforeach;

                $data = Validator::make($arr, ["*.basic_check_numeric" => "nullable"]);
                $data->validated();

                ProjectAttribute::insert($arr);

                $metaData = $this->generateProjectMetaData($request);
                $project->metaData()->updateOrCreate([], $metaData);

                $project_id_from_project_history_table = ProjectHistory::where('project_id', $id)->first();

                if (empty($project_id_from_project_history_table)) {
                    ProjectHistory::Create([
                        'project_id' => $project->id,
                        'user_id' => $project->user_id,
                        'reject_count' => 0,
                        'edit_count' => 1,
                    ]);
                } else {
                    ProjectHistory::where('project_id', $id)->update([
                        'reject_count' => $project_id_from_project_history_table->edit_count + 1
                    ]);
                }

                DB::commit();
            } catch (Exception $e) {
                DB::rollBack();

                toastr_error(__('Basic check numeric field is required'));
                return back();
            }

            try {
                $message = get_static_option('project_edit_email_message') ?? __('A new project is just edited.');
                $message = str_replace(["@project_id"], [$id], $message);
                Mail::to(get_static_option('site_global_email'))->send(new BasicMail([
                    'subject' => get_static_option('project_edit_email_subject') ?? __('Project Edit Email'),
                    'message' => $message
                ]));
            } catch (\Exception $e) {
            }

            //edit project notification to admin
            AdminNotification::create([
                'identity' => $id,
                'user_id' => $user_id,
                'type' => 'Edit Project',
                'message' => __('A Project has been edited.'),
            ]);

            toastr_success(__('Project Successfully Updated'));
            return redirect()->route('influencer.profile.details', Auth::guard('web')->user()->username);
        }

        return view('frontend.user.influencer.project.edit.edit-project', compact('project_details', 'get_sub_categories_from_project_category'));
    }

    // project preview
    public function project_preview()
    {
        $all_projects = Project::with('project_attributes')->where('user_id', Auth::guard('web')->user()->id)->latest()->get();
        return view('frontend.user.influencer.project.preview.all-projects', compact('all_projects'));
    }

    // project description

    public function project_description(Request $request)
    {
        if ($request->ajax()) {
            $project_title_and_description = Project::select(['title', 'description'])->where('id', $request->project_id)->first();
            return view('frontend.user.influencer.project.preview.project-description', compact('project_title_and_description'))->render();
        }
    }

    // project delete
    public function delete_project($id)
    {
        $project = Project::findOrFail($id);
        ProjectAttribute::where('create_project_id', $project->id)->delete();
        ProjectHistory::where('project_id', $project->id)->delete();
        $project->delete();
        return back()->with(toastr_success(__('Project Successfully Deleted.')));
    }

    /**
     * Generate meta data
     */
    private function generateProjectMetaData(Request $request): array
    {
        // Meta title
        $meta_title = $request->meta_title ?? $request->project_title;
        $meta_title = strlen($meta_title) > 60 ? substr($meta_title, 0, 57) . '...' : $meta_title;

        // Meta description
        $meta_description = $request->meta_description ?? $request->project_description;
        $meta_description = strlen($meta_description) > 160
            ? substr(strip_tags($meta_description), 0, 157) . '...'
            : strip_tags($meta_description);

        // Keywords from title
        $title_words = explode(' ', strtolower($request->project_title));
        $keywords = collect($title_words)
            ->filter(function ($word) {
                $stopWords = ['a', 'an', 'and', 'are', 'as', 'at', 'be', 'by', 'for', 'from', 'has', 'he', 'in', 'is', 'it', 'its', 'of', 'on', 'that', 'the', 'to', 'was', 'will', 'with'];
                return strlen(trim($word)) > 2 && !in_array(trim($word), $stopWords);
            })
            ->map(fn($word) => trim($word))
            ->unique()
            ->take(10)
            ->implode(', ');

        // Determine first gallery image
        $galleryImages = $request->gallery_images;

        if (is_string($galleryImages)) {
            $galleryArray = array_filter(array_map('trim', explode(',', $galleryImages)));
        } elseif (is_array($galleryImages)) {
            $galleryArray = $galleryImages;
        } else {
            $galleryArray = [];
        }

        $firstImage = $galleryArray[0] ?? null;

        $image_url = $firstImage
            ? asset('assets/uploads/project/' . $firstImage)
            : null;

        return [
            'meta_title' => purify_html($meta_title),
            'meta_description' => purify_html($meta_description),
            'meta_tags' => purify_html($keywords),

            'facebook_meta_tags' => purify_html($keywords),
            'facebook_meta_description' => purify_html($meta_description),
            'facebook_meta_image' => $image_url,

            'twitter_meta_tags' => purify_html($keywords),
            'twitter_meta_description' => purify_html($meta_description),
            'twitter_meta_image' => $image_url,
        ];
    }
}
