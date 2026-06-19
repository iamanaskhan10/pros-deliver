@extends('frontend.layout.master')
@section('site_title')
    {{ $blog_details->title ?? __('Blog Details') }}
@endsection

@if (isset($blog_details?->meta_data->meta_title) && !empty($blog_details?->meta_data->meta_title))
    @section('meta_title', $blog_details->meta_data->meta_title)
@endif

@if (isset($blog_details?->meta_data->meta_description) && !empty($blog_details?->meta_data->meta_description))
    @section('meta_description', $blog_details->meta_data->meta_description)
@endif

@section('content')
    <main>
        <!-- Project preview area Starts -->
        <div class="influencer page-wraper pat-80 pab-120">
            <div class="container">
                <div class="blog-details-page-wraper">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="blog-detais-title-part-wraper">
                                <h3 class="inf-titile title2 fw_semibold black_text mb-30">
                                    {{ $blog_details->title }}
                                </h3>
                                <div class="blog-writer-details d-flex align-items-center">
                                    <div class="top">
                                        <div class="bloger-image">
                                            {!! render_image_markup_by_attachment_id($blog_details->author->image) !!}
                                        </div>
                                        <div class="bloger-name">
                                            <h5 class="name black_text fw_semibold">
                                                {{ $blog_details->author->name ?? 'Unknown Author' }}
                                            </h5>
                                        </div>
                                    </div>
                                    <div class="bottom fw_medium d-flex align-items-center">
                                        <i class="fa-regular fa-clock"></i>
                                        <span>
                                            {{ $blog_details->created_at->toFormattedDateString() }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="blog-details-body">
                        <div class="row gy-5">
                            <div class="col-md-8">
                                <div class="blog-details-inner mb-40">
                                    <div class="main-blog-image">
                                        {!! render_image_markup_by_attachment_id($blog_details->image) !!}
                                    </div>
                                    <div class="blog-content-wraper">
                                        {!! $blog_details->content !!}
                                    </div>
                                </div>
                                <div class="blog-comment-wraper mb-40">
                                    <div class="blog-comment-title">
                                        <h4 class="inf-title title6 black_text fw_semibold">{{ __('Comments') }}
                                            ({{ $blog_details->approved_comments_count }})
                                        </h4>
                                    </div>
                                    <div class="blog-comment-list">
                                        @forelse ($blog_details->comments as $comment)
                                            <div class="blog-comment-item">
                                                <div class="blog-comment-image">
                                                    @if ($comment->user)
                                                        <img src="{{ asset('assets/uploads/profile/' . $comment->user->image) }}"
                                                            alt="{{ __('profile img') }}">
                                                    @else
                                                        <img src="{{ asset('assets/static/img/author/author.jpg') }}"
                                                            alt="{{ __('profile img') }}">
                                                    @endif
                                                </div>
                                                <div class="blog-comment-content">
                                                    <div class="blog-comment-top">
                                                        <div class="blog-comment-name">
                                                            <div class="name black_text fw_semibold">
                                                                {{ $comment->user->full_name ?? $comment->name }}
                                                            </div>
                                                        </div>
                                                        <div class="blog-comment-date">
                                                            <span>
                                                                {{ $comment->created_at->toFormattedDateString() }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="blog-comment-bottom">
                                                        <p class="blog-comment-text">
                                                            {{ $comment->comment }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        @empty
                                            <p>{{ __('No comments yet. Be the first to comment!') }}</p>
                                        @endforelse
                                    </div>
                                </div>
                                @if (auth()->check())
                                    <div class="leave-a-comment">
                                        <div class="leave-a-comment-title">
                                            <h4 class="inf-title title6 black_text fw_semibold">{{ __('Leave a comment') }}
                                            </h4>
                                        </div>
                                        <div class="leave-a-comment-form">

                                            <form action="{{ route('blog.comment.store') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="blog_post_id" value="{{ $blog_details->id }}">
                                                <div class="row gy-4">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <input type="text" name="name"
                                                                class="inf-custom-input lg-input"
                                                                placeholder="{{ __('Name') }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <input type="email" name="email"
                                                                class="inf-custom-input lg-input"
                                                                placeholder="{{ __('Email') }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <textarea name="comment" class="inf-custom-input lg-input" placeholder="{{ __('Message') }}" id="message"
                                                                cols="30" rows="5"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <button type="submit"
                                                                class="inf-cmn-btn style3 inf-primary-btn">{{ __('Submit') }}</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="col-md-4">
                                <div class="blog-sidebar-wraper sticky-top">
                                    <div class="blog-sidebar">
                                        <div class="blog-search-wraper">
                                            <div class="icon"><i class="fa fa-search"></i></div>
                                            <input type="text" class="inf-custom-input lg-input" id="blog_search_input"
                                                placeholder="{{ __('Search blog') }}">
                                        </div>
                                        <div class="blog-sidebar-title d-flex justify-content-between open">
                                            <h4 class="inf-title title6 fw_bold black_text">{{ __('Categories') }}</h4>
                                            <div class="icon"><i class="fas fa-angle-down"></i></div>
                                        </div>
                                        <div class="blog-sidebar-content">
                                            <ul>
                                                @foreach ($categories as $category)
                                                    <li>
                                                        <a href="" class="sidebar-category-filter"
                                                            data-id="{{ $category->id }}">
                                                            <span class="blog-name">{{ $category->category }}</span>
                                                            <span class="blog-number">({{ $category->blogs_count }})</span>
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="recen-blog-wraper">
                                        <div class="recent-blog-title">
                                            <h4 class="inf-title title6 fw_bold black_text">{{ __('Related Blogs') }}</h4>
                                        </div>
                                        <div class="recent-blog-list d-flex flex-column gap-3">
                                            @foreach ($related_blogs as $blog)
                                                <div class="blog-card">
                                                    <div class="blog-card-image">
                                                        <a href="{{ route('blog.details', $blog->slug) }}">
                                                            {!! render_image_markup_by_attachment_id($blog->image) !!}
                                                        </a>
                                                    </div>
                                                    <div class="blog-card-content">
                                                        <div class="blog-date">
                                                            {{ $blog->created_at->toFormattedDateString() }}
                                                        </div>
                                                        <h4 class="blog-title">
                                                            <a href="{{ route('blog.details', $blog->slug) }}">
                                                                {{ $blog->title }} </a>
                                                        </h4>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="blog-sidebar blog-tags-wraper">
                                        <h4 class="inf-title title6 fw_bold black_text">{{ __('Related Tags') }}</h4>
                                        <div class="blog-tags">
                                            @php
                                                $tags = explode(',', $blog->tag_name ?? '');
                                            @endphp
                                            @foreach ($tags as $tag)
                                                @if (!empty(trim($tag)))
                                                    <a href="javascript:void(0)"
                                                        class="inf-tag">{{ ucwords(trim($tag)) }}</a>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Project preview area end -->
    </main>

@endsection

@section('script')
    @include('blog::frontend.blogs.blog-js')
@endsection
