@forelse ($ratings as $rating)
    @include('frontend.pages.shake-details.partials.review-card', [
        'rating' => $rating,
    ])
@empty
    <p>{{ __('No reviews.') }}</p>
@endforelse
