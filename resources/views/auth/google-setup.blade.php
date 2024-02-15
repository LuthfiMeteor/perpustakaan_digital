<!DOCTYPE html>

<html lang="en" class="light-style layout-navbar-fixed layout-menu-fixed layout-compact" dir="ltr"
    data-theme="theme-default" data-template="vertical-menu-template-no-customizer">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Perpustakaan - Google Setup</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('asset-template/img/favicon/favicon.ico') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&ampdisplay=swap"
        rel="stylesheet" />

    <!-- Icons -->
    <link rel="stylesheet" href="{{ asset('asset-template/vendor/fonts/fontawesome.css') }}" />
    <link rel="stylesheet" href="{{ asset('asset-template/vendor/fonts/tabler-icons.css') }}" />
    <link rel="stylesheet" href="{{ asset('asset-template/vendor/fonts/flag-icons.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('asset-template/vendor/css/rtl/core.css') }}" />
    <link rel="stylesheet" href="{{ asset('asset-template/vendor/css/rtl/theme-default.css') }}" />
    <link rel="stylesheet" href="{{ asset('asset-template/css/demo.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('asset-template/vendor/libs/node-waves/node-waves.css') }}" />
    <link rel="stylesheet" href="{{ asset('asset-template/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('asset-template/vendor/libs/typeahead-js/typeahead.css') }}" />
    <link rel="stylesheet" href="{{ asset('asset-template/vendor/libs/bs-stepper/bs-stepper.css') }}" />
    <link rel="stylesheet" href="{{ asset('asset-template/vendor/libs/bootstrap-select/bootstrap-select.css') }}" />
    <link rel="stylesheet" href="{{ asset('asset-template/vendor/libs/select2/select2.css') }}" />
    <link rel="stylesheet"
        href="{{ asset('asset-template/vendor/libs/@form-validation/umd/styles/index.min.css') }}" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="{{ asset('asset-template/vendor/js/helpers.js') }}"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('asset-template/js/config.js') }}"></script>
</head>

<body style="overflow-y: hidden; overflow-x:hidden">
    <div class="position-absolute top-50 start-50 translate-middle">
        <div class="container-xxl">
            <!-- Default -->
            <div class="row">

                <!-- Default Wizard -->
                <div class="col-12 mb-4">
                    <div class="bs-stepper wizard-numbered mt-2">
                        <div class="bs-stepper-header">
                            <div class="step" data-target="#account-details">
                                <button disabled type="button" id="step1" class="step-trigger">
                                    <span class="bs-stepper-circle">1</span>
                                    <span class="bs-stepper-label">
                                        <span class="bs-stepper-title">Account Details</span>
                                        <span class="bs-stepper-subtitle">Setup Account Details</span>
                                    </span>
                                </button>
                            </div>
                            <div class="line">
                                <i class="ti ti-chevron-right"></i>
                            </div>
                            <div class="step" data-target="#personal-info">
                                <button type="button" class="step-trigger">
                                    <span class="bs-stepper-circle">2</span>
                                    <span class="bs-stepper-label">
                                        <span class="bs-stepper-title">Set A Password</span>
                                        <span class="bs-stepper-subtitle">Set Password Info.</span>
                                    </span>
                                </button>
                            </div>
                        </div>
                        <div class="bs-stepper-content">
                            <form method="POST" action="{{ route('google.setup-store') }}">
                                @csrf
                                <div id="personal-info" class="content">
                                    <div class="content-header mb-3">
                                        <h6 class="mb-0">Set A Password</h6>
                                        <small>Set Password Info.</small>
                                    </div>
                                    <div class="row g-3">
                                        <div class="col-6 mb-3 form-password-toggle">
                                            <label class="form-label" for="password">Password</label>
                                            <div class="input-group input-group-merge">
                                                <input type="password" id="password"
                                                    class="form-control @error('password') is-invalid @enderror"
                                                    name="password"
                                                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                                    aria-describedby="password" />
                                                <span class="input-group-text cursor-pointer"><i
                                                        class="ti ti-eye-off"></i></span>
                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-6 mb-3 form-password-toggle">
                                            <label class="form-label" for="password">Confirm Password</label>
                                            <div class="input-group input-group-merge">
                                                <input type="password" id="" class="form-control" required
                                                    name="password_confirmation" required autocomplete="new-password"
                                                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                                    aria-describedby="password" />
                                                <span class="input-group-text cursor-pointer"><i
                                                        class="ti ti-eye-off"></i></span>
                                            </div>
                                        </div>
                                        @if ($errors->any())
                                            <div class="alert alert-danger">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                        <div class="mb-4">
                                            <h6>Password Requirements:</h6>
                                            <ul class="ps-3 mb-0">
                                                <li class="mb-1">Minimum 8 characters long - the more, the better
                                                </li>
                                                <li class="mb-1">At least one lowercase character</li>
                                                <li>At least one number, symbol, or whitespace character</li>
                                            </ul>
                                        </div>
                                        <div class="col-12 d-flex justify-content-between">
                                            <button class="btn btn-label-secondary btn-prev" disabled>
                                                <i class="ti ti-arrow-left me-sm-1 me-0"></i>
                                                <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                            </button>
                                            <button class="btn btn-success">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
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

    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="{{ asset('asset-template/vendor/libs/bs-stepper/bs-stepper.js') }}"></script>
    <script src="{{ asset('asset-template/vendor/libs/bootstrap-select/bootstrap-select.js') }}"></script>
    <script src="{{ asset('asset-template/vendor/libs/select2/select2.js') }}"></script>
    <script src="{{ asset('asset-template/vendor/libs/@form-validation/umd/bundle/popular.min.js') }}"></script>
    <script src="{{ asset('asset-template/vendor/libs/@form-validation/umd/plugin-bootstrap5/index.min.js') }}"></script>
    <script src="{{ asset('asset-template/vendor/libs/@form-validation/umd/plugin-auto-focus/index.min.js') }}"></script>

    <!-- Main JS -->
    <script src="{{ asset('asset-template/js/main.js') }}"></script>

    <!-- Page JS -->

    <script src="{{ asset('asset-template/js/form-wizard-numbered.js') }}"></script>
    <script src="{{ asset('asset-template/js/form-wizard-validation.js') }}"></script>
    <script>
        $(document).ready(function() {
            // Add the 'active' class to the step you want to skip to
            $('.step[data-target="#personal-info"]').addClass('active');

            // Add the 'completed' class to the step you're skipping from
            $('.step[data-target="#account-details"]').addClass('crossed');
            $('.step[data-target="#account-details"]').removeClass('active');
            $('#personal-info').addClass('active dstepper-block');
            $('#account-details').removeClass('active dstepper-block');
            $('#step1').attr('aria-selected', 'false');
        });
    </script>
</body>

</html>
