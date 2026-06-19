<?php

namespace plugins\PageBuilder\Addons\PricePlan;

use Modules\Subscription\Entities\Subscription;
use plugins\PageBuilder\Fields\Slider;
use plugins\PageBuilder\Fields\Text;
use plugins\PageBuilder\PageBuilderBase;
use plugins\PageBuilder\Traits\LanguageFallbackForPageBuilder;

class PricePlanOne extends PageBuilderBase
{
    use LanguageFallbackForPageBuilder;

    public function preview_image()
    {
        return 'home-page/price-plan.png';
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
            'name' => 'subtitle',
            'label' => __('Subtitle'),
            'value' => $widget_saved_values['subtitle'] ?? null,
        ]);
        $output .= Text::get([
            'name' => 'view_all_button_text',
            'label' => __('View All Button Text'),
            'value' => $widget_saved_values['view_all_button_text'] ?? null,
        ]);
        $output .= Text::get([
            'name' => 'view_all_button_link',
            'label' => __('View All Button Link'),
            'value' => $widget_saved_values['view_all_button_link'] ?? null,
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

        $output .= $this->admin_form_submit_button();
        $output .= $this->admin_form_end();
        $output .= $this->admin_form_after();

        return $output;
    }

    public function frontend_render()
    {
        $settings = $this->get_settings();

        $title = $settings['title'] ?? null;
        $subtitle = $settings['subtitle'] ?? null;
        $view_all_button_text = $settings['view_all_button_text'] ?? null;
        $view_all_button_link = $settings['view_all_button_link'] ?? null;
        $padding_top = $settings['padding_top'] ?? null;
        $padding_bottom = $settings['padding_bottom'] ?? null;

        $monthlySubscriptions = Subscription::with(['features', 'subscription_type'])
            ->where('status', 1)
            ->whereHas('subscription_type', function ($q) {
                $q->where('type', 'monthly');
            })
            ->select(['id', 'subscription_type_id', 'title', 'logo', 'price', 'limit', 'subscription_highlight_color'])
            ->latest()
            ->take(3)
            ->get();

        $yearlySubscriptions = Subscription::with(['features', 'subscription_type'])
            ->where('status', 1)
            ->whereHas('subscription_type', function ($q) {
                $q->where('type', 'yearly');
            })
            ->select(['id', 'subscription_type_id', 'title', 'logo', 'price', 'limit', 'subscription_highlight_color'])
            ->latest()
            ->take(3)
            ->get();

        return $this->renderBlade('price-plan.price-plan-one', compact(
            'title',
            'subtitle',
            'view_all_button_text',
            'view_all_button_link',
            'padding_top',
            'padding_bottom',
            'monthlySubscriptions',
            'yearlySubscriptions'
        ));
    }

    public function addon_title()
    {
        return __('Price Plan: 01');
    }
}
