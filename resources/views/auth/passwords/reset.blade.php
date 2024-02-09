{{-- @extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Reset Password') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('password.update') }}">
                            @csrf

                            <input type="hidden" name="token" value="{{ $token }}">

                            <div class="row mb-3">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password-confirm"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Reset Password') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection --}}
<!DOCTYPE html>

<html lang="en" class="light-style layout-wide customizer-hide" dir="ltr" data-theme="theme-bsi"
    data-assets-path="{{ asset('asset-template') }}/" data-template="vertical-menu-template">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>Pramuka</title>

    <meta name="description" content="" />
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests" />
    <link rel="icon" type="image/x-icon" href="{{ asset('asset-template/img/favicon/favicon.ico') }}" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&ampdisplay=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('asset-template/vendor/fonts/fontawesome.css') }}" />
    <link rel="stylesheet" href="{{ asset('asset-template/vendor/fonts/tabler-icons.css') }}" />
    <link rel="stylesheet" href="{{ asset('asset-template/vendor/fonts/flag-icons.css') }}" />
    <link rel="stylesheet" href="{{ asset('asset-template/vendor/css/rtl/core.css') }}"
        class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('asset-template/vendor/css/rtl/theme-bsi.css') }}"
        class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('asset-template/css/demo.css') }}" />
    <link rel="stylesheet" href="{{ asset('asset-template/vendor/libs/node-waves/node-waves.css') }}" />
    <link rel="stylesheet" href="{{ asset('asset-template/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('asset-template/vendor/libs/typeahead-js/typeahead.css') }}" />
    <link rel="stylesheet"
        href="{{ asset('asset-template/vendor/libs/@form-validation/umd/styles/index.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('asset-template/vendor/css/pages/page-auth.css') }}" />
    <script src="{{ asset('asset-template/vendor/js/helpers.js') }}"></script>
    <script src="{{ asset('asset-template/js/config.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <style>
        .btn-pramuka {
            color: #fff;
            background-color: #663996;
            border-color: #663996;
        }
    </style>

</head>

<body>
    <div class="authentication-wrapper authentication-cover authentication-bg">
        <div class="authentication-inner row">
            <!-- /Left Text -->
            <div class="d-none d-lg-flex col-lg-7 p-0">
                <div class="auth-cover-bg auth-cover-bg-color d-flex justify-content-center align-items-center">
                    <img src="{{ asset('asset-template/img/illustrations/auth-reset-password-illustration-light.png') }}"
                        alt="auth-reset-password-cover" class="img-fluid my-5 auth-illustration"
                        data-app-light-img="illustrations/auth-reset-password-illustration-light.png"
                        data-app-dark-img="illustrations/auth-reset-password-illustration-dark.png" />

                    <img src="{{ asset('asset-template/img/illustrations/bg-shape-image-light.png" alt="auth-reset-password-cover') }}"
                        class="platform-bg" data-app-light-img="illustrations/bg-shape-image-light.png"
                        data-app-dark-img="illustrations/bg-shape-image-dark.png" />
                </div>
            </div>
            <!-- /Left Text -->

            <!-- Reset Password -->
            <div class="d-flex col-12 col-lg-5 align-items-center p-4 p-sm-5">
                <div class="w-px-400 mx-auto">
                    <!-- Logo -->
                    <div class="app-brand mb-4">
                        <a href="index.html" class="app-brand-link gap-2">
                            <span class="app-brand-logo demo">
                                <svg width="32" height="22" viewBox="0 0 32 22" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M0.00172773 0V6.85398C0.00172773 6.85398 -0.133178 9.01207 1.98092 10.8388L13.6912 21.9964L19.7809 21.9181L18.8042 9.88248L16.4951 7.17289L9.23799 0H0.00172773Z"
                                        fill="#7367F0" />
                                    <path opacity="0.06" fill-rule="evenodd" clip-rule="evenodd"
                                        d="M7.69824 16.4364L12.5199 3.23696L16.5541 7.25596L7.69824 16.4364Z"
                                        fill="#161616" />
                                    <path opacity="0.06" fill-rule="evenodd" clip-rule="evenodd"
                                        d="M8.07751 15.9175L13.9419 4.63989L16.5849 7.28475L8.07751 15.9175Z"
                                        fill="#161616" />
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M7.77295 16.3566L23.6563 0H32V6.88383C32 6.88383 31.8262 9.17836 30.6591 10.4057L19.7824 22H13.6938L7.77295 16.3566Z"
                                        fill="#7367F0" />
                                </svg>
                            </span>
                        </a>
                    </div>
                    <!-- /Logo -->
                    <h4 class="mb-1">Reset Password 🔒</h4>
                    <p class="mb-4">for <span class="fw-medium">{{ $email }}</span></p>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert"> {{ session('status') }} </div>
                    @endif
                    <form id="formAuthentication" class="mb-3" method="POST"
                        action="{{ route('password.update') }}">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">
                        <input id="email" type="hidden" class="form-control @error('email') is-invalid @enderror"
                            name="email" value="{{ $email ?? old('email') }}" required autocomplete="email"
                            autofocus>
                        <div class="mb-3 form-password-toggle">
                            <label class="form-label" for="password">New Password</label>
                            <div class="input-group input-group-merge">
                                <input id="password" type="password"
                                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    required autocomplete="new-password">
                                <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 form-password-toggle">
                            <label class="form-label" for="confirm-password">Confirm Password</label>
                            <div class="input-group input-group-merge">
                                <input id="password-confirm" type="password" class="form-control"
                                    name="password_confirmation" required
                                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                    autocomplete="new-password">
                                <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                            </div>
                        </div>
                        <button class="btn btn-primary d-grid w-100 mb-3" type="submit">Set new password</button>
                        <div class="text-center">
                            <a href="{{ route('login') }}">
                                <i class="ti ti-chevron-left scaleX-n1-rtl"></i>
                                Back to login
                            </a>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /Reset Password -->
        </div>
    </div>

    <script src="{{ asset('asset-template/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('asset-template/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('asset-template/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('asset-template/vendor/libs/node-waves/node-waves.js') }}"></script>
    <script src="{{ asset('asset-template/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('asset-template/vendor/libs/hammer/hammer.js') }}"></script>
    <script src="{{ asset('asset-template/vendor/libs/i18n/i18n.js') }}"></script>
    <script src="{{ asset('asset-template/vendor/libs/typeahead-js/typeahead.js') }}"></script>
    <script src="{{ asset('asset-template/vendor/js/menu.js') }}"></script>
    <script src="{{ asset('asset-template/vendor/libs/@form-validation/umd/bundle/popular.min.js') }}"></script>
    <script src="{{ asset('asset-template/vendor/libs/@form-validation/umd/plugin-bootstrap5/index.min.js') }}"></script>
    <script src="{{ asset('asset-template/vendor/libs/@form-validation/umd/plugin-auto-focus/index.min.js') }}"></script>
    <script src="{{ asset('asset-template/js/main.js') }}"></script>
    <script src="{{ asset('asset-template/js/pages-auth.js') }}"></script>

</html>
