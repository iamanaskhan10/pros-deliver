<?php


namespace plugins\PageBuilder\Addons\FeaturedInfluencer;

use App\Models\Project;
use App\Models\User;
use plugins\PageBuilder\Fields\ColorPicker;
use plugins\PageBuilder\Fields\Number;
use plugins\PageBuilder\Fields\Slider;
use plugins\PageBuilder\Fields\Text;
use plugins\PageBuilder\PageBuilderBase;
use plugins\PageBuilder\Traits\LanguageFallbackForPageBuilder;


class FeaturedInfluencer extends PageBuilderBase
{
    use LanguageFallbackForPageBuilder;

    public function preview_image()
    {
        return 'home-page/featured-influ.png';
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

        $output .= Text::get([
            'name' => 'find_more_button_text',
            'label' => __('Find more button text'),
            'value' => $widget_saved_values['find_more_button_text'] ?? null,
        ]);

        $output .= Text::get([
            'name' => 'find_more_button_link',
            'label' => __('Find more button link'),
            'value' => $widget_saved_values['find_more_button_link'] ?? null,
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
        $title = $settings['title'];
        $items = $settings['items'] ?? 8;
        $proCount = $settings['pro_count'] ?? 4;
        $find_more_button_text = $settings['find_more_button_text'];
        $find_more_button_link = $settings['find_more_button_link'];
        $padding_top = $settings['padding_top'];
        $padding_bottom = $settings['padding_bottom'];
        $section_bg = $settings['section_bg'] ?? '';

        $baseQuery = User::select([
            'id',
            'username',
            'first_name',
            'last_name',
            'image',
            'user_verified_status',
            'github_id',
            'apple_id',
            'is_pro',
            'pro_expire_date'
        ])
            ->with('user_introduction', 'freelancer_category')
            ->where('user_type', 2)
            ->where('is_email_verified', 1)
            ->where('is_suspend', 0)
            ->withCount(['freelancer_orders' => function ($query) {
                $query->where('status', 3);
            }]);

        if (moduleExists('PromoteInfluencer')) {
            $proUsers = (clone $baseQuery)
                ->where('is_pro', 'yes')
                ->where('pro_expire_date', '>', now())
                ->inRandomOrder()
                ->take($proCount)
                ->get();

            $remaining = $items - $proUsers->count();

            $normalUsers = collect();
            if ($remaining > 0) {
                $normalUsers = (clone $baseQuery)
                    ->where(function ($q) {
                        $q->whereNull('is_pro')
                            ->orWhere('is_pro', '!=', 'Yes')
                            ->orWhere('pro_expire_date', '<', now());
                    })
                    ->orderBy('freelancer_orders_count', 'desc')
                    ->take($remaining)
                    ->get();
            }
            $talents = $proUsers->merge($normalUsers)->shuffle();
        } else {
            $talents = $baseQuery
                ->inRandomOrder()
                ->take($items)
                ->get();
        }

        return $this->renderBlade(
            'featured-influencer.featured-influencer',
            compact([
                'title',
                'items',
                'find_more_button_text',
                'find_more_button_link',
                'padding_top',
                'padding_bottom',
                'section_bg',
                'talents'
            ])
        );
    }

    public function addon_title()
    {
        return __('Featured Influencer: 01');
    }
}
