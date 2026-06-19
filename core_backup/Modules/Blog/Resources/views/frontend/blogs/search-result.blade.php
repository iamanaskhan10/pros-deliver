<div class="recent-job-wraper">
    <div class="row g-4">
        @if ($blogs->count() > 0)
            @foreach ($blogs as $blog)
                <div class="col-lg-4 col-md-6">
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
                                <a href="{{ route('blog.details', $blog->slug) }}"> {{ $blog->title }} </a>
                            </h4>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="col-12">
                <h4 class="text-danger text-center">
                    <x-frontend.not-found />
                </h4>
            </div>
        @endif
    </div>
</div>
<x-pagination.laravel-paginate :allData="$blogs" />
