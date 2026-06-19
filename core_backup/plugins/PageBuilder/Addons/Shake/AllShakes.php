<?php

namespace plugins\PageBuilder\Addons\Shake;

use App\Models\Project;
use plugins\PageBuilder\Fields\ColorPicker;
use plugins\PageBuilder\Fields\Number;
use plugins\PageBuilder\Fields\Slider;
use plugins\PageBuilder\Fields\Text;
use plugins\PageBuilder\PageBuilderBase;
use plugins\PageBuilder\Traits\LanguageFallbackForPageBuilder;

class AllShakes extends PageBuilderBase
{
    use LanguageFallbackForPageBuilder;

    public function preview_image()
    {
        return 'home-page/latest-pro-1.png';
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

        $output .= Number::get([
            'name' => 'items',
            'label' => __('Items'),
            'value' => $widget_saved_values['items'] ?? null,
            'info' => __('enter how many item you want to show in frontend'),
        ]);

        if (moduleExists('PromoteInfluencer')) {
            $output .= Number::get([
                'name' => 'pro_count',
                'label' => __('Pro Items'),
                'value' => $widget_saved_values['pro_count'] ?? null,
                'info' => __('enter how many promoted item you want to show in frontend'),
            ]);
        }

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
        $title = $settings['title'];
        $items = $settings['items'] ?? 6;
        $proCount = $settings['pro_count'] ?? 4;
        $padding_top = $settings['padding_top'];
        $padding_bottom = $settings['padding_bottom'];
        $section_bg = $settings['section_bg'] ?? null;

        $baseQuery = Project::select([
            'id',
            'title',
            'slug',
            'user_id',
            'basic_regular_charge',
            'basic_delivery',
            'description',
            'image',
            'video',
            'is_pro',
            'pro_expire_date'
        ])
            ->where('status', '1')
            ->whereHas('project_creator')
            ->withCount([
                'orders' => function ($query) {
                    $query->where('status', 3)->where('is_project_job', 'project');
                },
                'ratings as ratings_count' => function ($query) {
                    $query->where('is_project_job', 'project')->where('sender_type', 1);
                },
            ])
            ->withAvg([
                'ratings as average_rating' => function ($query) {
                    $query->where('is_project_job', 'project')->where('sender_type', 1);
                },
            ], 'rating');

        if (moduleExists('PromoteInfluencer')) {
            $proProjects = (clone $baseQuery)
                ->where('is_pro', 'yes')
                ->where('pro_expire_date', '>', now())
                ->inRandomOrder()
                ->take($proCount)
                ->get();

            $remaining = $items - $proProjects->count();

            $normalProjects = collect();
            if ($remaining > 0) {
                $normalProjects = (clone $baseQuery)
                    ->where(function ($q) {
                        $q->whereNull('is_pro')
                            ->orWhere('is_pro', '!=', 'yes')
                            ->orWhere('pro_expire_date', '<', now());
                    })
                    ->orderBy('orders_count', 'desc')
                    ->take($remaining)
                    ->get();
            }

            $all_shakes = $proProjects->merge($normalProjects)->shuffle();
        } else {
            $all_shakes = $baseQuery
                ->inRandomOrder()
                ->take($items)
                ->get();
        }

        return $this->renderBlade('shake.all-shakes', compact([
            'title',
            'items',
            'padding_top',
            'padding_bottom',
            'all_shakes',
            'section_bg'
        ]));
    }

    public function addon_title()
    {
        return __('Latest Projects');
    }
}
