<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AccountSettingsController extends Controller
{
    //main page settings
    public function main_page(Request $request)
    {
        if($request->isMethod('post')){
            $this->validate($request, [
                'account_page_title' => 'nullable|string|max:100',
                'account_page_skip_title' => 'nullable|string|max:100',
                'account_page_back_button_title' => 'nullable|string|max:100',
            ]);

            $all_fields = [
                'account_page_title',
                'account_page_skip_title',
                'account_page_back_button_title',
            ];
            foreach ($all_fields as $field) {
                update_static_option($field, $request->$field);
            }
            toastr_success(__('Main Page Settings Updated Successfully.'));
            return back();
        }
        return view('backend.pages.account-settings.main-page');
    }

    //introduction settings
    public function introduction(Request $request)
    {
        if($request->isMethod('post')){
            $this->validate($request, [
                'introduction_menu_title' => 'nullable|string|max:100',
                'introduction_menu_sub_title' => 'nullable|string|max:300',
                'professional_title' => 'nullable|string|max:100',
                'intro_title' => 'nullable|string|max:100',
            ]);

            $all_fields = [
                'introduction_menu_title',
                'introduction_menu_sub_title',
                'professional_title',
                'intro_title',
            ];
            foreach ($all_fields as $field) {
                update_static_option($field, $request->$field);
            }
            toastr_success(__('Introduction Settings Updated Successfully.'));
            return back();
        }
        return view('backend.pages.account-settings.introduction');
    }

    //experience settings
    public function social_settings(Request $request)
    {
        if($request->isMethod('post')){
            $this->validate($request, [
                'social_menu_title' => 'nullable|string|max:100',
                'social_menu_sub_title' => 'nullable|string|max:300',
                'social_title' => 'nullable|string|max:100',
                'social_inner_title' => 'nullable|string|max:100',
                'social_modal_title' => 'nullable|string|max:100',
                'social_edit_modal_title' => 'nullable|string|max:100',
            ]);

            $all_fields = [
                'social_menu_title',
                'social_menu_sub_title',
                'social_title',
                'social_inner_title',
                'social_modal_title',
                'social_edit_modal_title',
            ];
            foreach ($all_fields as $field) {
                update_static_option($field, $request->$field);
            }
            return back()->with(toastr_success(__('Social Settings Updated Successfully.')));
        }
        return view('backend.pages.account-settings.social');
    }

    //work settings
    public function work(Request $request)
    {
        if($request->isMethod('post')){
            $this->validate($request, [
                'work_menu_title' => 'nullable|string|max:100',
                'work_menu_sub_title' => 'nullable|string|max:300',
                'work_title' => 'nullable|string|max:100',
                'work_inner_title' => 'nullable|string|max:100',
                'work_modal_title' => 'nullable|string|max:100',
            ]);

            $all_fields = [
                'work_menu_title',
                'work_menu_sub_title',
                'work_title',
                'work_inner_title',
                'work_modal_title',
            ];
            foreach ($all_fields as $field) {
                update_static_option($field, $request->$field);
            }
            toastr_success(__('Category Settings Updated Successfully.'));
            return back();
        }
        return view('backend.pages.account-settings.work');
    }

    //skill settings
    public function skill(Request $request)
    {
        if($request->isMethod('post')){
            $this->validate($request, [
                'skill_menu_title' => 'nullable|string|max:100',
                'skill_menu_sub_title' => 'nullable|string|max:300',
                'skill_title' => 'nullable|string|max:100',
            ]);

            $all_fields = [
                'skill_menu_title',
                'skill_menu_sub_title',
                'skill_title',
            ];
            foreach ($all_fields as $field) {
                update_static_option($field, $request->$field);
            }
            toastr_success(__('Skill Settings Updated Successfully.'));
            return back();
        }
        return view('backend.pages.account-settings.skill');
    }

    //language settings
    public function language(Request $request)
    {
        if($request->isMethod('post')){
            $this->validate($request, [
                'language_menu_title' => 'nullable|string|max:100',
                'language_menu_sub_title' => 'nullable|string|max:300',
                'language_title' => 'nullable|string|max:100',
            ]);

            $all_fields = [
                'language_menu_title',
                'language_menu_sub_title',
                'language_title',
            ];
            foreach ($all_fields as $field) {
                update_static_option($field, $request->$field);
            }
            toastr_success(__('language Settings Updated Successfully.'));
            return back();
        }
        return view('backend.pages.account-settings.language');
    }

    //education settings
    public function location(Request $request)
    {
        if($request->isMethod('post')){
            $this->validate($request, [
                'location_menu_title' => 'nullable|string|max:100',
                'location_menu_sub_title' => 'nullable|string|max:300',
                'location_title' => 'nullable|string|max:100',
                'location_inner_title' => 'nullable|string|max:100',
                'location_modal_title' => 'nullable|string|max:100',
                'location_edit_modal_title' => 'nullable|string|max:100',
            ]);

            $all_fields = [
                'location_menu_title',
                'location_menu_sub_title',
                'location_country_title',
                'location_state_title',
                'location_city_title',
            ];
            foreach ($all_fields as $field) {
                update_static_option($field, $request->$field);
            };
            return back()->with(toastr_success(__('Location Settings Updated Successfully.')));
        }
        return view('backend.pages.account-settings.location');
    }

    //rate and profile photo settings
    public function rate_and_photo(Request $request)
    {
        if($request->isMethod('post')){
            $this->validate($request, [
                'hourly_rate_menu_title' => 'nullable|string|max:100',
                'hourly_rate_menu_sub_title' => 'nullable|string|max:300',
                'profile_photo_title' => 'nullable|string|max:100',
            ]);

            $all_fields = [
                'hourly_rate_menu_title',
                'hourly_rate_menu_sub_title',
                'profile_photo_title',
            ];
            foreach ($all_fields as $field) {
                update_static_option($field, $request->$field);
            }
            return back()->with(toastr_success(__('Profile Photo Settings Updated Successfully.')));
        }
        return view('backend.pages.account-settings.rate-photo');
    }
}
