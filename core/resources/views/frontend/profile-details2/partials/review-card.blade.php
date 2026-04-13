<div class="client-review-card">
    <div class="reviewer-part">
        <div class="reviewer-image">
            @if ($review->sender->image)
                <img src="{{ asset('assets/uploads/profile/' . $review->sender->image) }}"
                    alt="{{ $review->sender->first_name }}">
            @else
                <img src="{{ asset('assets/static/img/author/author.jpg') }}" alt="{{ __('profile img') }}">
            @endif
        </div>
        <div class="reviewer-info">
            <div class="reviewer-name-location">
                <div class="reviewer-name">{{ $review->sender->full_name ?? 'Anonymous' }}
                </div>
                <div class="reviewer-location mt-1">
                    <span class="flag">
                        @if($review->sender?->user_country?->flag_url)
                            <img src="{{ $review->sender->user_country->flag_url }}" alt="flag">
                        @endif
                    </span>
                    <span class="sm-font">{{ $review->sender->user_country?->country ?? 'Unknown' }}</span>
                </div>
            </div>
            <div class="posted-time sm-font">{{ $review->created_at->diffForHumans() }}
            </div>
        </div>
    </div>
    <div class="review-descripton-wraper">
        <div class="review-star">
            @for ($i = 1; $i <= 5; $i++)
                <i class="fas fa-star {{ $i <= $review->rating ? 'text-warning' : '' }}"></i>
            @endfor
        </div>
        <div class="des">
            {{ $review->review_feedback }}
        </div>
    </div>
</div>
