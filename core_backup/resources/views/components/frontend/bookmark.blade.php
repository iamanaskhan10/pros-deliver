@props(['identity', 'type', 'style2' => true])

@php
    $user = Auth::guard('web')->user();
    $isLoggedIn = Auth::guard('web')->check();
    $bookmark_exists = false;
    if ($isLoggedIn) {
        $bookmark_exists = \App\Models\Bookmark::where('user_id', $user->id)->where('identity', $identity)->exists();
    }
    $classes = 'add-fvt-icon click_to_bookmark';
    $classes .= $style2 ? ' style-2' : '';
    $classes .= $bookmark_exists ? ' fvt' : '';
@endphp

<button href="#/" class="{{ $classes }}" data-identity="{{ $identity }}" data-type="{{ $type }}"
    @if ($isLoggedIn) data-route="{{ route($user->user_type == 1 ? 'client.bookmark' : 'influencer.bookmark') }}"
    @else
        data-login="login-please" @endif>
    <i class="fas fa-heart"></i>
</button>
