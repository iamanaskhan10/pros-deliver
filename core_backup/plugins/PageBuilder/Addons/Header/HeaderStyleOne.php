<?php

namespace plugins\PageBuilder\Addons\Header;

use App\Models\User;
use plugins\PageBuilder\Fields\Image;
use plugins\PageBuilder\Fields\Slider;
use plugins\PageBuilder\Fields\Text;
use plugins\PageBuilder\PageBuilderBase;
use plugins\PageBuilder\Traits\LanguageFallbackForPageBuilder;

class HeaderStyleOne extends PageBuilderBase
{
    use LanguageFallbackForPageBuilder;

    public function preview_image()
    {
        return 'home-page/header-1.png';
    }

    public function admin_render()
    {
        $output = $this->admin_form_before();
        $output .= $this->admin_form_start();
        $output .= $this->default_fields();
        $widget_saved_values = $this->get_settings();

        $influencers = User::where('user_type', 2)
            ->select(['id', 'first_name', 'last_name'])
            ->get()
            ->mapWithKeys(function ($user) {
                return [$user->id => $user->first_name.' '.$user->last_name];
            })
            ->toArray();

        $output .= Text::get([
            'name' => 'title',
            'label' => __('Title'),
            'value' => $widget_saved_values['title'] ?? null,
        ]);
        $output .= Text::get([
            'name' => 'subtitle',
            'label' => __('Subtitle'),
            'value' => $widget_saved_values['subtitle'] ?? null,
        ]);
        $output .= Text::get([
            'name' => 'find_work_button_text',
            'label' => __('Join Now Button Text'),
            'value' => $widget_saved_values['find_work_button_text'] ?? null,
        ]);
        $output .= Text::get([
            'name' => 'find_work_button_link',
            'label' => __('Join Now Button Link'),
            'value' => $widget_saved_values['find_work_button_link'] ?? null,
        ]);
        $output .= Text::get([
            'name' => 'find_project_button_text',
            'label' => __('Hire Influencer Button Text'),
            'value' => $widget_saved_values['find_project_button_text'] ?? null,
        ]);
        $output .= Text::get([
            'name' => 'find_project_button_link',
            'label' => __('Hire Influencer Button Link'),
            'value' => $widget_saved_values['find_project_button_link'] ?? null,
        ]);

        $output .= Image::get([
            'name' => 'banner_bg_1',
            'label' => __('Select Banner Background Image'),
            'value' => $widget_saved_values['banner_bg_1'] ?? null,
            'info' => __('Select a background image for the header section.'),
        ]);

        $output .= Image::get([
            'name' => 'banner_image',
            'label' => __('Select Banner Image'),
            'value' => $widget_saved_values['banner_image'] ?? null,
            'info' => __('recommended size: 800x750px'),
        ]);

        $output .= Slider::get([
            'name' => 'padding_top',
            'label' => __('Padding Top'),
            'value' => $widget_saved_values['padding_top'] ?? 120,
            'max' => 500,
        ]);

        $output .= Slider::get([
            'name' => 'padding_bottom',
            'label' => __('Padding Bottom'),
            'value' => $widget_saved_values['padding_bottom'] ?? 120,
            'max' => 500,
        ]);

        $output .= $this->admin_form_submit_button();
        $output .= $this->admin_form_end();
        $output .= $this->admin_form_after();

        return $output;
    }

    public function frontend_render(): string
    {
        $settings = $this->get_settings();

        $title = $settings['title'] ?? null;
        $subtitle = $settings['subtitle'] ?? null;
        $find_work_button_text = $settings['find_work_button_text'] ?? null;
        $find_work_button_link = $settings['find_work_button_link'] ?? null;
        $find_project_button_text = $settings['find_project_button_text'] ?? null;
        $find_project_button_link = $settings['find_project_button_link'] ?? null;
        $padding_top = $settings['padding_top'] ?? null;
        $padding_bottom = $settings['padding_bottom'] ?? null;
        $banner_bg_1 = $settings['banner_bg_1'] ?? null;
        $banner_image = $settings['banner_image'] ?? null;

        return $this->renderBlade('header.header-one', compact([
            'title',
            'subtitle',
            'find_work_button_text',
            'find_work_button_link',
            'find_project_button_link',
            'find_project_button_text',
            'padding_bottom',
            'padding_top',
            'banner_bg_1',
            'banner_image',
        ]));

    }

    public function addon_title()
    {
        return __('Header: 01');
    }
}
