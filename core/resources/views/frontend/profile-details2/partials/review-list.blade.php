@foreach ($freelancer_reviews as $review)
    @include('frontend.profile-details2.partials.review-card', ['review' => $review])
@endforeach

@if ($freelancer_reviews->hasMorePages())
    <div class="load-more-flag" data-next-page="{{ $freelancer_reviews->currentPage() + 1 }}"></div>
@endif