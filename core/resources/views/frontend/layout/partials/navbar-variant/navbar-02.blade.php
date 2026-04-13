<header class="influencer header bg_white influencer-header ">
    <nav class="navbar navbar-area navbar-expand-lg {{ request()->routeIs('homepage') ? '' : 'header-shadow' }}">
        <div class="container nav-container">
            <div class="logo-wrapper">
                <a href="{{ route('homepage') }}" class="navbar-brand">
                    @if (!empty(get_static_option('site_logo')))
                        {!! render_image_markup_by_attachment_id(get_static_option('site_logo')) !!}
                    @else
                        <img src="{{ asset('assets/static/img/logo/logo.png') }}" alt="site-logo">
                    @endif
                </a>
            </div>
            <div class="responsive-mobile-menu d-lg-none">
                <a href="javascript:void(0)" class="click-nav-right-icon">
                    <i class="fas fa-ellipsis-v"></i>
                </a>
                <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarNavs">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
            <div class="collapse navbar-collapse justify-content-end gap-4" id="navbarNavs">
                <ul class="navbar-nav gap-4">
                    {!! render_frontend_menu($primary_menu) !!}
                </ul>
            </div>
            <x-frontend.user-menu />
        </div>
    </nav>
</header>
