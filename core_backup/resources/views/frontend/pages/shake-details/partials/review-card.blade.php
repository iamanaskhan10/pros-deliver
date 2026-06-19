<div class="client-review-card">
    <div class="reviewer-part">
        <div class="reviewer-image">
            @if ($rating->client->image)
                <img src="{{ asset('assets/uploads/profile/' . $rating->client->image) }}"
                    alt="{{ $rating->client->first_name }}">
            @else
                <img src="{{ asset('assets/static/img/author/author.jpg') }}" alt="{{ __('profile img') }}">
            @endif
        </div>
        <div class="reviewer-info">
            <div class="reviewer-name-location">
                <div class="reviewer-name">{{ $rating->client->full_name ?? __('Anonymous') }}</div>
                <div class="reviewer-location mt-1">
                    <span class="flag">
                        @if($rating->client?->user_country?->flag_url)
                            <img src="{{ $rating->client->user_country->flag_url }}" alt="flag">
                        @endif
                    </span>
                    <span class="sm-font">{{ $rating->client->user_country->country ?? __('Unknown') }}</span>
                </div>
            </div>
            <div class="posted-time sm-font">
                {{ $rating->created_at->diffForHumans() }}
            </div>
        </div>
    </div>
    <div class="review-descripton-wraper">
        <div class="review-star">
            @for ($i = 1; $i <= 5; $i++)
                <i class="fas fa-star{{ $i <= floor($rating->rating) ? '' : '-o' }}"></i>
            @endfor
        </div>
        <div class="des">
            {!! $rating->review_feedback !!}
        </div>
    </div>
</div>
