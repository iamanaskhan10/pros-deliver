<?php

namespace plugins\PageBuilder\Addons\About;

use plugins\FormBuilder\SanitizeInput;
use plugins\PageBuilder\Fields\ColorPicker;
use plugins\PageBuilder\Fields\Repeater;
use plugins\PageBuilder\Fields\Slider;
use plugins\PageBuilder\Fields\Text;
use plugins\PageBuilder\Helpers\RepeaterField;
use plugins\PageBuilder\PageBuilderBase;
use plugins\PageBuilder\Traits\LanguageFallbackForPageBuilder;

class MissionVision extends PageBuilderBase
{
    use LanguageFallbackForPageBuilder;

    public function preview_image()
    {
        return 'about/mission-vission.png';
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

        // repeater
        $output .= Repeater::get([
            'settings' => $widget_saved_values,
            'id' => 'mission_vision',
            'fields' => [
                [
                    'type' => RepeaterField::TEXT,
                    'name' => 'title',
                    'label' => __('Title'),
                ],
                [
                    'type' => RepeaterField::SUMMERNOTE,
                    'name' => 'description',
                    'label' => __('Short Description'),
                ],
                [
                    'type' => RepeaterField::IMAGE,
                    'name' => 'image',
                    'label' => __('Image'),
                    'value' => $widget_saved_values['image'] ?? null,
                    'info' => __('Upload image for this section'),
                    'placeholder' => __('Upload image'),
                    'dimensions' => __('Recommended size: 636x427px'),
                ],

            ],
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

        $output .= $this->admin_form_submit_button();
        $output .= $this->admin_form_end();
        $output .= $this->admin_form_after();

        return $output;
    }

    public function frontend_render()
    {
        $settings = $this->get_settings();
        $title = SanitizeInput::esc_html($settings['section_title']);

        $padding_top = $settings['padding_top'];
        $padding_bottom = $settings['padding_bottom'];
        $section_bg = $settings['section_bg'] ?? '';

        $repeater_data = $settings['mission_vision'] ?? [];

        return $this->renderBlade('about.mission-vision', compact(['title', 'padding_top', 'padding_bottom', 'section_bg', 'repeater_data']));
    }

    public function addon_title()
    {
        return __('Mission & Vision: About Us Section');
    }
}
