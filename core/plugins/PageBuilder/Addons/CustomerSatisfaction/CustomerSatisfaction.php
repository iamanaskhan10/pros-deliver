<?php

namespace plugins\PageBuilder\Addons\CustomerSatisfaction;

use plugins\PageBuilder\Fields\ColorPicker;
use plugins\PageBuilder\Fields\Repeater;
use plugins\PageBuilder\Fields\Slider;
use plugins\PageBuilder\Fields\Text;
use plugins\PageBuilder\Helpers\RepeaterField;
use plugins\PageBuilder\PageBuilderBase;
use plugins\PageBuilder\Traits\LanguageFallbackForPageBuilder;

class CustomerSatisfaction extends PageBuilderBase
{
    use LanguageFallbackForPageBuilder;

    public function preview_image()
    {
        return 'home-page/customer-satisfaction.png';
    }

    public function admin_render()
    {
        $output = $this->admin_form_before();
        $output .= $this->admin_form_start();
        $output .= $this->default_fields();
        $widget_saved_values = $this->get_settings();

        $output .= Text::get([
            'name' => 'title',
            'label' => __('Title'),
            'value' => $widget_saved_values['title'] ?? null,
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

        // repeater
        $output .= Repeater::get([
            'settings' => $widget_saved_values,
            'id' => 'customer_satisfaction_repeater',
            'fields' => [
                [
                    'type' => RepeaterField::IMAGE,
                    'name' => 'image',
                    'label' => __('Select Image'),
                ],
                [
                    'type' => RepeaterField::TEXT,
                    'name' => 'number',
                    'label' => __('Number Count'),
                ],
                [
                    'type' => RepeaterField::TEXT,
                    'name' => 'title',
                    'label' => __('Subtitle'),
                ],
                [
                    'type' => RepeaterField::COLOR_PICKER,
                    'name' => 'bg_color',
                    'label' => __('Background Color'),
                    'info' => __('select color you want to show in frontend'),
                ],

            ],
        ]);

        $output .= $this->admin_form_submit_button();
        $output .= $this->admin_form_end();
        $output .= $this->admin_form_after();

        return $output;
    }

    public function frontend_render()
    {
        $settings = $this->get_settings();
        $title = $settings['title'];
        $padding_top = $settings['padding_top'];
        $padding_bottom = $settings['padding_bottom'];
        $section_bg = $settings['section_bg'] ?? '';
        $repeater_data = $settings['customer_satisfaction_repeater'];

        return $this->renderBlade('customer-satisfaction.customer-satisfaction', compact(['title', 'padding_top', 'padding_bottom', 'section_bg', 'repeater_data']));
    }

    public function addon_title()
    {
        return __('Customer Satisfaction');
    }
}
