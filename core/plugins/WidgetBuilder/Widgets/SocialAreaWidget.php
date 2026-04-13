<?php

namespace plugins\WidgetBuilder\Widgets;

use plugins\FormBuilder\SanitizeInput;
use plugins\PageBuilder\Fields\Image;
use plugins\PageBuilder\Fields\Repeater;
use plugins\PageBuilder\Fields\Textarea;
use plugins\PageBuilder\Helpers\RepeaterField;
use plugins\PageBuilder\Traits\LanguageFallbackForPageBuilder;
use plugins\WidgetBuilder\WidgetBase;

class SocialAreaWidget extends WidgetBase
{
    use LanguageFallbackForPageBuilder;

    public function admin_render()
    {
        $output = $this->admin_form_before();
        $output .= $this->admin_form_start();
        $output .= $this->default_fields();
        $widget_saved_values = $this->get_settings();

        $output .= Image::get([
            'name' => 'image',
            'label' => __('Site Logo'),
            'value' => $widget_saved_values['image'] ?? null,
            'dimensions' => '173x41'
        ]);

        $output .= Textarea::get([
            'name' => 'description',
            'label' => __('Description'),
            'value' => $widget_saved_values['description'] ?? null,
        ]);

        $output .= Repeater::get([
            'settings' => $widget_saved_values,
            'id' => 'social_icon',
            'fields' => [
                [
                    'type' => RepeaterField::ICON_PICKER,
                    'name' => 'icon',
                    'label' => __('Icon')
                ],
                [
                    'type' => RepeaterField::TEXT,
                    'name' => 'url',
                    'label' => __('Url')
                ],
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
        $logo = render_image_markup_by_attachment_id($settings['image']);
        $description = purify_html($settings['description']);
        $route = route('homepage');
        $repeater_data = $settings['social_icon'];
        $social_icon_markup = '';

        foreach ($repeater_data['icon_'] as $key => $icon) {
            $icon = SanitizeInput::esc_html($icon);
            $url = SanitizeInput::esc_html($repeater_data['url_'][$key]);
            $social_icon_markup.= <<<SOCIALICON
                <a href="{$url}"> <i class="{$icon}"></i> </a>

SOCIALICON;
        }

        return <<<HTML
           <div class="col-lg-6">
                    <div class="footer-widget widget footer_content_1st">
                        <div class="footer_logo">
                            <a href="{$route}" class="mb-3 d-block">
                                {$logo}
                            </a>
                            <p class="footer_paragraph">
                                {$description}
                            </p>
                        </div>
                        <div class="social_links">
                            {$social_icon_markup}
                        </div>
                    </div>
                </div>
        HTML;
    }

    public function widget_title()
    {
        return __('Social Area');
    }

}
