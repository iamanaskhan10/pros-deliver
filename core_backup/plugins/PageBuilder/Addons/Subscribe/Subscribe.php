<?php


namespace plugins\PageBuilder\Addons\Subscribe;

use plugins\PageBuilder\Fields\ColorPicker;
use plugins\PageBuilder\Fields\Slider;
use plugins\PageBuilder\Fields\Text;
use plugins\PageBuilder\PageBuilderBase;
use plugins\PageBuilder\Traits\LanguageFallbackForPageBuilder;
use plugins\PageBuilder\Fields\Repeater;
use plugins\PageBuilder\Helpers\RepeaterField;


class Subscribe extends PageBuilderBase
{
    use LanguageFallbackForPageBuilder;

    public function preview_image()
    {
        return 'home-page/subscribe.png';
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
        $output .= Text::get([
            'name' => 'input_title',
            'label' => __('Subscribe Input Title'),
            'value' => $widget_saved_values['input_title'] ?? null,
        ]);
        $output .= Text::get([
            'name' => 'button_title',
            'label' => __('Subscribe Button Title'),
            'value' => $widget_saved_values['button_title'] ?? null,
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
        $title =$settings['title'];
        $input_title =$settings['input_title'];
        $button_title =$settings['button_title'];
        $padding_top = $settings['padding_top'];
        $padding_bottom = $settings['padding_bottom'];
        $section_bg = $settings['section_bg'] ?? '';

        return $this->renderBlade('subscribe.subscribe',compact(['title','input_title','button_title','padding_top','padding_bottom','section_bg']));
}

    public function addon_title()
    {
        return __('Subscribe');
    }
}
