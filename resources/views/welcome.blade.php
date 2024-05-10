@extends('landing-page.layouts.app')
@section('content')
    <section id="hero-animation">
        <div id="landingHero" class="section-py landing-hero position-relative">
            <div class="container">
                <div class="hero-text-box text-center">
                    <h1 class="text-primary hero-title display-6 fw-bold">Digital Library</h1>
                    <h2 class="hero-sub-title h6 mb-4 pb-1">
                        Unlock a world of knowledge!<br class="d-none d-lg-block" />
                        Sign up to explore our library.
                    </h2>
                    <div class="landing-hero-btn d-inline-block position-relative">
                        <span class="hero-btn-item position-absolute d-none d-md-flex text-heading">Let's Join
                            <img src="{{ asset('asset-template/img/front-pages/icons/Join-community-arrow.png') }}"
                                alt="Join community arrow" class="scaleX-n1-rtl" /></span>
                        <a href="{{ route('register') }}" class="btn btn-primary btn-lg">Let's Sign up</a>
                    </div>
                </div>
                <div id="heroDashboardAnimation" class="hero-animation-img">
                    <a href="../vertical-menu-template/app-ecommerce-dashboard.html" target="_blank">
                        <div id="heroAnimationImg" class="position-relative hero-dashboard-img">
                            <img src="{{ asset('asset-template/img/front-pages/landing-page/hero-dashboard-light.png') }}"
                                alt="hero dashboard" class="animation-img"
                                data-app-light-img="front-pages/landing-page/hero-dashboard-light.png"
                                data-app-dark-img="front-pages/landing-page/hero-dashboard-dark.png" />
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="landing-hero-blank"></div>
    </section>
@endsection
