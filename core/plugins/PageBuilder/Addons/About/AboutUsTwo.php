<?php

namespace plugins\PageBuilder\Addons\About;

use plugins\PageBuilder\Fields\Text;
use plugins\PageBuilder\Fields\Image;
use plugins\FormBuilder\SanitizeInput;
use plugins\PageBuilder\Fields\Slider;
use plugins\PageBuilder\Fields\Repeater;
use plugins\PageBuilder\PageBuilderBase;
use plugins\PageBuilder\Fields\Summernote;
use plugins\PageBuilder\Fields\ColorPicker;
use plugins\PageBuilder\Helpers\RepeaterField;
use plugins\PageBuilder\Traits\LanguageFallbackForPageBuilder;

class AboutUsTwo extends PageBuilderBase
{
    use LanguageFallbackForPageBuilder;

    public function preview_image()
    {
        return 'about/about-us-1.png';
    }

    public function admin_render()
    {
        $output = $this->admin_form_before();
        $output .= $this->admin_form_start();
        $output .= $this->default_fields();
        $widget_saved_values = $this->get_settings();

        $output .= Text::get([
            'name' => 'section_title',
            'label' => __('Title'),
            'value' => $widget_saved_values['section_title'] ?? null,
            'placeholder' => __('Enter title'),
        ]);
        $output .= Summernote::get([
            'name' => 'description',
            'label' => __('Short Description'),
            'value' => $widget_saved_values['description'] ?? null,
            'placeholder' => __('enter short description'),
        ]);

        $output .= Image::get([
            'name' => 'image',
            'value' => $widget_saved_values['image'] ?? null,
        ]);

        $output .= Slider::get([
            'name' => 'padding_top',
            'label' => __('Padding Top'),
            'value' => $widget_saved_values['padding_top'] ?? 260,
            'max' => 500,
        ]);
        $output .= Slider::get([
            'name' => 'padding_bottom',
            'label' => __('Padding Bottom'),
            'value' => $widget_saved_values['padding_bottom'] ?? 190,
            'max' => 500,
        ]);
        $output .= ColorPicker::get([
            'name' => 'section_bg',
            'label' => __('Background Color'),
            'value' => $widget_saved_values['section_bg'] ?? null,
            'info' => __('select color you want to show in frontend'),
        ]);

        $output .= Text::get([
            'name' => 'success_title',
            'label' => __('Success Title'),
            'value' => $widget_saved_values['success_title'] ?? null,
            'placeholder' => __('Enter success section title'),
        ]);

        $output .= Text::get([
            'name' => 'success_sub_title',
            'label' => __('Success Sub Title'),
            'value' => $widget_saved_values['success_sub_title'] ?? null,
            'placeholder' => __('Enter success section sub title'),
        ]);

        $output .= Summernote::get([
            'name' => 'success_description',
            'label' => __('Success Description'),
            'value' => $widget_saved_values['success_description'] ?? null,
            'placeholder' => __('Enter success short description'),
        ]);

        $output .= Image::get([
            'name' => 'success_image',
            'label' => __('Success Image'),
            'value' => $widget_saved_values['success_image'] ?? null,
        ]);

        //repeater
        $output .= Repeater::get([
            'settings' => $widget_saved_values,
            'id' => 'success_points',
            'fields' => [
                [
                    'type' => RepeaterField::TEXT,
                    'name' => 'success_points',
                    'label' => __('Success List')
                ]
            ]
        ]);

        $output .= $this->admin_form_submit_button();
        $output .= $this->admin_form_end();
        $output .= $this->admin_form_after();

        return $output;
    }

    public function frontend_render()
    {
        $settings = $this->get_settings();
        $title = SanitizeInput::esc_html($settings['section_title']);
        $description = SanitizeInput::kses_basic($settings['description']);
        $image = $settings['image'] ?? '';

        $padding_top = $settings['padding_top'];
        $padding_bottom = $settings['padding_bottom'];
        $section_bg = $settings['section_bg'];
        $success_title = SanitizeInput::esc_html($settings['success_title']);
        $success_sub_title = SanitizeInput::esc_html($settings['success_sub_title']);
        $success_description = SanitizeInput::kses_basic($settings['success_description']);
        $success_image = $settings['success_image'] ?? '';
        $repeater_data = $settings['success_points'] ?? '';

        return $this->renderBlade('about.about-us-two', compact(['title', 'description', 'image', 'padding_top', 'padding_bottom', 'section_bg', 'success_title', 'success_sub_title', 'success_description', 'success_image', 'repeater_data']));
    }

    public function addon_title()
    {
        return __('About- Us: 02');
    }
}
