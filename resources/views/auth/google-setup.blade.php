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

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">

            <!-- Layout container -->
            <div class="layout-page">
                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->

                    <div class="container-xxl flex-grow-1 container-p-y">
                        <!-- Default -->
                        <div class="row">

                            <!-- Default Wizard -->
                            <div class="col-12 mb-4">
                                <div class="bs-stepper wizard-numbered mt-2">
                                    <div class="bs-stepper-header">
                                        <div class="step" data-target="#account-details">
                                            <button type="button" class="step-trigger">
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
                                                    <span class="bs-stepper-title">Personal Info</span>
                                                    <span class="bs-stepper-subtitle">Add personal info</span>
                                                </span>
                                            </button>
                                        </div>
                                        <div class="line">
                                            <i class="ti ti-chevron-right"></i>
                                        </div>
                                        <div class="step" data-target="#social-links">
                                            <button type="button" class="step-trigger">
                                                <span class="bs-stepper-circle">3</span>
                                                <span class="bs-stepper-label">
                                                    <span class="bs-stepper-title">Social Links</span>
                                                    <span class="bs-stepper-subtitle">Add social links</span>
                                                </span>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="bs-stepper-content">
                                        <form onSubmit="return false">
                                            <!-- Account Details -->
                                            <div id="account-details" class="content">
                                                <div class="content-header mb-3">
                                                    <h6 class="mb-0">Account Details</h6>
                                                    <small>Enter Your Account Details.</small>
                                                </div>
                                                <div class="row g-3">
                                                    <div class="col-sm-6">
                                                        <label class="form-label" for="username">Username</label>
                                                        <input type="text" id="username" class="form-control"
                                                            placeholder="johndoe" />
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label class="form-label" for="email">Email</label>
                                                        <input type="email" id="email" class="form-control"
                                                            placeholder="john.doe@email.com" aria-label="john.doe" />
                                                    </div>
                                                    <div class="col-sm-6 form-password-toggle">
                                                        <label class="form-label" for="password">Password</label>
                                                        <div class="input-group input-group-merge">
                                                            <input type="password" id="password"
                                                                class="form-control"
                                                                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                                                aria-describedby="password2" />
                                                            <span class="input-group-text cursor-pointer"
                                                                id="password2"><i class="ti ti-eye-off"></i></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6 form-password-toggle">
                                                        <label class="form-label" for="confirm-password">Confirm
                                                            Password</label>
                                                        <div class="input-group input-group-merge">
                                                            <input type="password" id="confirm-password"
                                                                class="form-control"
                                                                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                                                aria-describedby="confirm-password2" />
                                                            <span class="input-group-text cursor-pointer"
                                                                id="confirm-password2"><i
                                                                    class="ti ti-eye-off"></i></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 d-flex justify-content-between">
                                                        <button class="btn btn-label-secondary btn-prev" disabled>
                                                            <i class="ti ti-arrow-left me-sm-1 me-0"></i>
                                                            <span
                                                                class="align-middle d-sm-inline-block d-none">Previous</span>
                                                        </button>
                                                        <button class="btn btn-primary btn-next">
                                                            <span
                                                                class="align-middle d-sm-inline-block d-none me-sm-1">Next</span>
                                                            <i class="ti ti-arrow-right"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Personal Info -->
                                            <div id="personal-info" class="content">
                                                <div class="content-header mb-3">
                                                    <h6 class="mb-0">Personal Info</h6>
                                                    <small>Enter Your Personal Info.</small>
                                                </div>
                                                <div class="row g-3">
                                                    <div class="col-sm-6">
                                                        <label class="form-label" for="first-name">First
                                                            Name</label>
                                                        <input type="text" id="first-name" class="form-control"
                                                            placeholder="John" />
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label class="form-label" for="last-name">Last Name</label>
                                                        <input type="text" id="last-name" class="form-control"
                                                            placeholder="Doe" />
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label class="form-label" for="country">Country</label>
                                                        <select class="select2" id="country">
                                                            <option label=" "></option>
                                                            <option>UK</option>
                                                            <option>USA</option>
                                                            <option>Spain</option>
                                                            <option>France</option>
                                                            <option>Italy</option>
                                                            <option>Australia</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label class="form-label" for="language">Language</label>
                                                        <select class="selectpicker w-auto" id="language"
                                                            data-style="btn-transparent" data-icon-base="ti"
                                                            data-tick-icon="ti-check text-white" multiple>
                                                            <option>English</option>
                                                            <option>French</option>
                                                            <option>Spanish</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-12 d-flex justify-content-between">
                                                        <button class="btn btn-label-secondary btn-prev">
                                                            <i class="ti ti-arrow-left me-sm-1 me-0"></i>
                                                            <span
                                                                class="align-middle d-sm-inline-block d-none">Previous</span>
                                                        </button>
                                                        <button class="btn btn-primary btn-next">
                                                            <span
                                                                class="align-middle d-sm-inline-block d-none me-sm-1">Next</span>
                                                            <i class="ti ti-arrow-right"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Social Links -->
                                            <div id="social-links" class="content">
                                                <div class="content-header mb-3">
                                                    <h6 class="mb-0">Social Links</h6>
                                                    <small>Enter Your Social Links.</small>
                                                </div>
                                                <div class="row g-3">
                                                    <div class="col-sm-6">
                                                        <label class="form-label" for="twitter">Twitter</label>
                                                        <input type="text" id="twitter" class="form-control"
                                                            placeholder="https://twitter.com/abc" />
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label class="form-label" for="facebook">Facebook</label>
                                                        <input type="text" id="facebook" class="form-control"
                                                            placeholder="https://facebook.com/abc" />
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label class="form-label" for="google">Google+</label>
                                                        <input type="text" id="google" class="form-control"
                                                            placeholder="https://plus.google.com/abc" />
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label class="form-label" for="linkedin">LinkedIn</label>
                                                        <input type="text" id="linkedin" class="form-control"
                                                            placeholder="https://linkedin.com/abc" />
                                                    </div>
                                                    <div class="col-12 d-flex justify-content-between">
                                                        <button class="btn btn-label-secondary btn-prev">
                                                            <i class="ti ti-arrow-left me-sm-1 me-0"></i>
                                                            <span
                                                                class="align-middle d-sm-inline-block d-none">Previous</span>
                                                        </button>
                                                        <button class="btn btn-success btn-submit">Submit</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- / Footer -->

                        <div class="content-backdrop fade"></div>
                    </div>
                    <!-- Content wrapper -->
                </div>
                <!-- / Layout page -->
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
</body>

</html>
