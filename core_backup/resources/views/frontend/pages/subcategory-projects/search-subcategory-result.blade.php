@if ($projects->count() > 0)
    <div class="d-flex flex-wrap gap-3 mx-auto">
        @foreach ($projects as $shake)
            <div class="blog-grid-item">
                <div class="single-blog">
                    <div class="single-blog-thumb-wrapper">
                        <div class="single-blog-thumb single-blog-video-poster">
                            <a
                                href="{{ route('shake.details', ['username' => $shake->project_creator?->username, 'slug' => $shake->slug]) }}">
                                @php
                                    $image_ids = explode('|', $shake->image);
                                    $first_image_id = $image_ids[0];
                                @endphp
                                @if (!empty($shake->video))
                                    <video class="background-video" loop muted data-poster="assets/img/blog/blog1.jpg">
                                        <source src="{!! render_background_video_markup_by_attachment_id($shake->video) !!}" type="video/mp4">
                                    </video>
                                @else
                                    <div class="blog-details-head-single-thumb">
                                        {!! render_image_markup_by_attachment_id($first_image_id) !!}
                                    </div>
                                @endif
                            </a>
                            @if (!Auth::guard('web')->check() || Auth::guard('web')->user()->user_type == 1)
                                <x-frontend.bookmark :identity="$shake->id" :type="'project'" />
                            @endif
                        </div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center pt-3 px-3">
                        {!! project_rating($shake->id) !!}
                    </div>
                    <div class="single-blog-contents mt-2 px-3 pb-3">

                        <div class="single-blog-contents-flex">
                            <div class="project-catalogue-bottom flex-between">
                                <div class="single-project-delivery">
                                    <span class="single-project-delivery-icon">
                                        <i class="fa-regular fa-clock"></i> {{ __('Delivery') }}
                                    </span>
                                    <span class="single-project-delivery-days"> {{ __($shake->basic_delivery) ?? 0 }}
                                    </span>
                                </div>
                            </div>
                            <div class="single-blog-contents-right">
                                <span class="single-project-content-price">
                                    {{ amount_with_currency_symbol($shake->basic_regular_charge) ?? '' }}</span>
                            </div>
                        </div>
                        <h3 class="single-blog-contents-title"> <a
                                href="{{ route('shake.details', ['username' => $shake->project_creator?->username, 'slug' => $shake->slug]) }}">
                                {{ $shake->title }} </a> </h3>
                        <div class="single-blog-contents-left mt-2">
                            <a href="{{ route('shake.details', ['username' => $shake->project_creator?->username, 'slug' => $shake->slug]) }}"
                                class="btn btn_primary"> {{ __('Project Details') }} </a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

    </div>
@else
    <div class="col-12">
        <div class="notFoundParent project-category-item radius-10 text-center">
            <div class="notFound-wrapper">
                <div class="notFoundThumb">
                    <img src="{{ asset('assets/static/img/no-jobs-projects/no-project.svg') }}" alt="">
                </div>
                <div class="notFound-contents mt-3">
                    <h4 class="notFoundTitle">{{ __('No Projects') }}</h4>
                    <p class="notFoundPara mt-3">
                        {{ __("Sorry, We couldn't find any projects in this category try checking on other categories") }}
                    </p>
                </div>
            </div>
        </div>
    </div>
@endif
<x-pagination.laravel-paginate :allData="$projects" />
