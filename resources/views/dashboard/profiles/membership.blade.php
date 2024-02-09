@extends('dashboard.layouts.app')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light">Account Settings / </span> Connections</h4>

        @include('dashboard.profiles.components.navbar-profile')
        <div class="row">
            @if (Auth::user()->check_membership)
                {{-- @dd(Auth::user()->check_membership->membership_type) --}}
                <div class="col-md-12">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start">
                                <span class="badge bg-label-warning">
                                    @if (Auth::user()->check_membership->membership_type == '1')
                                        1 Month Premium
                                    @elseif (Auth::user()->check_membership->membership_type == '2')
                                        3 Month remium
                                    @elseif (Auth::user()->check_membership->membership_type == '3')
                                        1 Year Premium
                                    @endif
                                </span>
                                <div class="d-flex justify-content-center">
                                    <sup class="h6 pricing-currency mt-3 mb-0 me-1 text-primary fw-normal">Rp.</sup>
                                    <h1 class="mb-0 text-primary">
                                        {{ number_format(Auth::user()->check_membership->harga, 0, ',', '.') }}</h1>
                                    <sub class="h6 pricing-duration mt-auto mb-2 text-muted fw-normal">/@if (Auth::user()->check_membership->membership_type == '2')
                                            3 Month
                                        @elseif (Auth::user()->check_membership->membership_type == '3')
                                            Year
                                        @elseif (Auth::user()->check_membership->membership_type == '1')
                                            Month
                                        @endif
                                    </sub>
                                </div>
                            </div>
                            <ul class="ps-3 g-2 my-3">
                                {{-- <li class="mb-2">10 Users</li> --}}
                                {{-- <li class="mb-2"></li> --}}
                                <li>
                                    @if (Auth::user()->check_membership->membership_type == '1')
                                        read premium books for 1 months
                                    @elseif (Auth::user()->check_membership->membership_type == '2')
                                        read premium books for 3 months
                                    @elseif (Auth::user()->check_membership->membership_type == '3')
                                        read premium books for a year
                                    @endif
                                </li>
                            </ul>
                            <div class="d-flex justify-content-between align-items-center mb-1 fw-medium text-heading">
                                <span>Days</span>
                                <span>{{ Auth::user()->check_membership->getPercentageDaysRemainingAttribute() }}%
                                    Completed</span>
                            </div>
                            <div class="progress mb-1" style="height: 8px">
                                <div class="progress-bar" role="progressbar"
                                    style="width: {{ Auth::user()->check_membership->getPercentageDaysRemainingAttribute() }}%"
                                    aria-valuenow="{{ Auth::user()->check_membership->getPercentageDaysRemainingAttribute() }}"
                                    aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <span>{{ Auth::user()->check_membership->getDaysRemainingFormattedAttribute() }} days
                                remaining</span>
                            <div class="d-grid w-100 mt-4">
                                {{-- <button class="btn btn-primary" data-bs-target="#pricingModal" data-bs-toggle="modal">
                                Buy Membership
                            </button> --}}
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="col-md-12">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start">
                                <span class="badge bg-label-primary">Standard</span>
                                <div class="d-flex justify-content-center">
                                    <sup class="h6 pricing-currency mt-3 mb-0 me-1 text-primary fw-normal">Rp.</sup>
                                    <h1 class="mb-0 text-primary">0</h1>
                                    <sub class="h6 pricing-duration mt-auto mb-2 text-muted fw-normal">/month</sub>
                                </div>
                            </div>
                            <ul class="ps-3 g-2 my-3">
                                {{-- <li class="mb-2">10 Users</li> --}}
                                {{-- <li class="mb-2"></li> --}}
                                <li>Baca Buku Standard</li>
                            </ul>
                            {{-- <div class="d-flex justify-content-between align-items-center mb-1 fw-medium text-heading">
                                <span>Days</span>
                                <span>65% Completed</span>
                            </div>
                            <div class="progress mb-1" style="height: 8px">
                                <div class="progress-bar" role="progressbar" style="width: 65%" aria-valuenow="65"
                                    aria-valuemin="0" aria-valuemax="100"></div>
                            </div> --}}
                            {{-- <span>4 days remaining</span> --}}
                            <div class="d-grid w-100 mt-4">
                                <button class="btn btn-primary" data-bs-target="#pricingModal" data-bs-toggle="modal">
                                    Purchase Membership
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
        <div class="card">
            <!-- Billing History -->
            <h5 class="card-header">Billing History</h5>
            <div class="card-datatable table-responsive">
                <table class="invoice-list-table table border-top">
                    <thead>
                        <tr>
                            <th>#ID</th>
                            <th class="text-truncate">Issued Date</th>
                            <th>Invoice Status</th>
                            <th>Start Membership</th>
                            <th>End Membership</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                </table>
            </div>
            <!--/ Billing History -->
        </div>
    </div>

    <div class="modal fade" id="pricingModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-simple modal-pricing">
            <div class="modal-content p-2 p-md-5">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <!-- Pricing Plans -->
                    <div class="py-0 rounded-top">
                        <h2 class="text-center mb-2">Premium Membership</h2>
                        <p class="text-center">
                            Read More Book And Open The World
                        </p>
                        {{-- <div class="d-flex align-items-center justify-content-center flex-wrap gap-2 pt-3 mb-4">
                            <label class="switch switch-primary ms-3 ms-sm-0 mt-2">
                                <span class="switch-label">Monthly</span>
                                <input type="checkbox" class="switch-input price-duration-toggler" checked />
                                <span class="switch-toggle-slider">
                                    <span class="switch-on"></span>
                                    <span class="switch-off"></span>
                                </span>
                                <span class="switch-label">Annual</span>
                            </label>
                            <div class="mt-n5 ms-n5 d-none d-sm-block">
                                <i class="ti ti-corner-left-down ti-sm text-muted me-1 scaleX-n1-rtl"></i>
                                <span class="badge badge-sm bg-label-primary">Save up to 10%</span>
                            </div>
                        </div> --}}
                        <div class="row mx-0 gy-3">
                            <!-- Basic -->
                            <div class="col-xl mb-md-0 mb-4">
                                <div class="card border rounded shadow-none">
                                    <div class="card-body">
                                        <div class="my-3 pt-2 text-center">
                                            <img src="{{ asset('asset-template/img/illustrations/page-pricing-basic.png') }}"
                                                alt="Basic Image" height="140" />
                                        </div>
                                        <h3 class="card-title text-center text-capitalize mb-1">1 Month</h3>
                                        <p class="text-center">A simple start for everyone</p>
                                        <div class="text-center h-px-100 mb-2">
                                            <div class="d-flex justify-content-center">
                                                <sup class="h6 pricing-currency mt-3 mb-0 me-1 text-primary">Rp.</sup>
                                                <h1 class="display-4 mb-0 text-primary">12.000</h1>
                                                <sub
                                                    class="h6 pricing-duration mt-auto mb-2 text-muted fw-normal">/month</sub>
                                            </div>
                                            <small class="price-yearly price-yearly-toggle text-muted">Rp. 120.000 /
                                                year</small>
                                        </div>

                                        <ul class="list-group ps-3 my-4">
                                            <li class="mb-2">100 responses a month</li>
                                            <li class="mb-2">Unlimited forms and surveys</li>
                                            <li class="mb-2">Unlimited fields</li>
                                            <li class="mb-2">Basic form creation tools</li>
                                            <li class="mb-0">Up to 2 subdomains</li>
                                        </ul>

                                        <button type="button" class="btn btn-primary buymembership d-grid w-100 mt-3"
                                            data-id="1">
                                            Purchase
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Pro -->
                            <div class="col-xl mb-md-0 mb-4">
                                <div class="card border-primary border shadow-none">
                                    <div class="card-body position-relative">
                                        <div class="position-absolute end-0 me-4 top-0 mt-4">
                                            <span class="badge bg-label-primary">Popular</span>
                                        </div>
                                        <div class="my-3 pt-2 text-center">
                                            <img src="{{ asset('asset-template/img/illustrations/page-pricing-standard.png') }}"
                                                alt="Standard Image" height="140" />
                                        </div>
                                        <h3 class="card-title text-center text-capitalize mb-1">3 Month</h3>
                                        <p class="text-center">For small to medium businesses</p>
                                        <div class="text-center h-px-100 mb-2">
                                            <div class="d-flex justify-content-center">
                                                <sup class="h6 pricing-currency mt-3 mb-0 me-1 text-primary">Rp.</sup>
                                                <h1 class="price-toggle price-yearly display-4 text-primary mb-0">30.000
                                                </h1>
                                                <h1 class="price-toggle price-monthly display-4 text-primary mb-0 d-none">9
                                                </h1>
                                                <sub
                                                    class="h6 text-muted pricing-duration mt-auto mb-2 fw-normal">/month</sub>
                                            </div>
                                            {{-- <small class="price-yearly price-yearly-toggle text-muted">$ 90 / year</small> --}}
                                        </div>

                                        <ul class="list-group ps-3 my-4">
                                            <li class="mb-2">Up to 5 users</li>
                                            <li class="mb-2">120+ components</li>
                                            <li class="mb-2">Basic support on Github</li>
                                            <li class="mb-2">Monthly updates</li>
                                            <li class="mb-0">Integrations</li>
                                        </ul>

                                        <button type="button" class="btn btn-primary buymembership d-grid w-100 mt-3"
                                            data-id="2">
                                            Upgrade
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Enterprise -->
                            <div class="col-xl">
                                <div class="card border rounded shadow-none">
                                    <div class="card-body">
                                        <div class="my-3 pt-2 text-center">
                                            <img src="{{ asset('asset-template/img/illustrations/page-pricing-enterprise.png') }}"
                                                alt="Enterprise Image" height="140" />
                                        </div>
                                        <h3 class="card-title text-center text-capitalize mb-1">1 Year</h3>
                                        <p class="text-center">Solution for big organizations</p>

                                        <div class="text-center h-px-100 mb-2">
                                            <div class="d-flex justify-content-center">
                                                <sup class="h6 text-primary pricing-currency mt-3 mb-0 me-1">Rp.</sup>
                                                <h1 class="price-toggle price-yearly display-4 text-primary mb-0">100.000
                                                </h1>
                                                <h1 class="price-toggle price-monthly display-4 text-primary mb-0 d-none">
                                                    19</h1>
                                                <sub
                                                    class="h6 pricing-duration mt-auto mb-2 fw-normal text-muted">/Year</sub>
                                            </div>
                                            {{-- <small class="price-yearly price-yearly-toggle text-muted">$ 190 / year</small> --}}
                                        </div>

                                        <ul class="list-group ps-3 my-4">
                                            <li class="mb-2">Up to 10 users</li>
                                            <li class="mb-2">150+ components</li>
                                            <li class="mb-2">Basic support on Github</li>
                                            <li class="mb-2">Monthly updates</li>
                                            <li class="mb-0">Speedy build tooling</li>
                                        </ul>

                                        <button type="button" class="btn btn-primary buymembership d-grid w-100 mt-3"
                                            data-id="3">
                                            Upgrade
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/ Pricing Plans -->
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="fullscreenModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <style>
                        .success-animation {
                            margin: 150px auto;
                        }

                        .checkmark {
                            width: 300px;
                            height: 300px;
                            border-radius: 50%;
                            display: block;
                            stroke-width: 2;
                            stroke: #4bb71b;
                            stroke-miterlimit: 10;
                            box-shadow: inset 0px 0px 0px #4bb71b;
                            animation: fill .4s ease-in-out .4s forwards, scale .3s ease-in-out .9s both;
                            position: relative;
                            top: 5px;
                            right: 5px;
                            margin: 0 auto;
                        }

                        .checkmark__circle {
                            stroke-dasharray: 166;
                            stroke-dashoffset: 166;
                            stroke-width: 2;
                            stroke-miterlimit: 10;
                            stroke: #4bb71b;
                            fill: #fff;
                            animation: stroke 0.6s cubic-bezier(0.65, 0, 0.45, 1) forwards;

                        }

                        .checkmark__check {
                            transform-origin: 50% 50%;
                            stroke-dasharray: 48;
                            stroke-dashoffset: 48;
                            animation: stroke 0.3s cubic-bezier(0.65, 0, 0.45, 1) 0.8s forwards;
                        }

                        @keyframes stroke {
                            100% {
                                stroke-dashoffset: 0;
                            }
                        }

                        @keyframes scale {

                            0%,
                            100% {
                                transform: none;
                            }

                            50% {
                                transform: scale3d(1.1, 1.1, 1);
                            }
                        }

                        @keyframes fill {
                            100% {
                                box-shadow: inset 0px 0px 0px 30px #4bb71b;
                            }
                        }
                    </style>
                    <div class="success-animation">
                        <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
                            <circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none" />
                            <path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script src="{{ asset('asset-template/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script>
    <script src="{{ asset('asset-template/vendor/libs/popper/popper.js') }}"></script>
    {{-- <script src="{{ asset('asset-template/vendor/js/bootstrap.js') }}"></script> --}}
    <script src="{{ asset('asset-template/vendor/libs/node-waves/node-waves.js') }}"></script>
    <script src="{{ asset('asset-template/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('asset-template/vendor/libs/hammer/hammer.js') }}"></script>
    <script src="{{ asset('asset-template/vendor/libs/i18n/i18n.js') }}"></script>
    <script src="{{ asset('asset-template/vendor/libs/typeahead-js/typeahead.js') }}"></script>
    <script src="{{ asset('asset-template/vendor/js/menu.js') }}"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="{{ asset('asset-template/vendor/libs/@form-validation/umd/bundle/popular.min.js') }}"></script>
    <script src="{{ asset('asset-template/vendor/libs/@form-validation/umd/plugin-bootstrap5/index.min.js') }}"></script>
    <script src="{{ asset('asset-template/vendor/libs/@form-validation/umd/plugin-auto-focus/index.min.js') }}"></script>
    <script src="{{ asset('asset-template/vendor/libs/cleavejs/cleave.js') }}"></script>
    <script src="{{ asset('asset-template/vendor/libs/cleavejs/cleave-phone.js') }}"></script>
    <script src="{{ asset('asset-template/vendor/libs/sweetalert2/sweetalert2.js') }}"></script>

    <!-- Page JS -->
    {{-- <script src="{{ asset('asset-template/js/app-invoice-list.js')}}"></script> --}}
    <script src="{{ asset('asset-template/js/pages-account-settings-account.js') }}"></script>
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('midtrans.client_key') }}"></script>
    <script>
        $(document).ready(function() {
            $('.buymembership').click(function() {
                var membership_type = $(this).data('id');
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'POST',
                    url: "{{ route('profile.buymembership') }}",
                    data: {
                        membership_type: membership_type
                    },
                    success: function(e) {
                        window.snap.pay(e.snaptoken, {
                            onSuccess: function(result) {
                                $('#fullscreenModal').modal('show');
                                setTimeout(function() {
                                    $('#fullscreenModal').modal('hide');
                                    setTimeout(function() {
                                            window.location.href =
                                                '{{ route('profile.membership') }}';
                                        },
                                        1000);
                                }, 3000);
                            },
                            onPending: function(result) {
                                alert("wating your payment!");
                                console.log(result);
                            },
                            onError: function(result) {
                                alert("payment failed!");
                                console.log(result);
                            },
                            onClose: function() {}
                        })
                    },
                    error: function(data) {
                        Swal.fire(
                            'Oops...',
                            'Terjadi kesalahan.',
                            'error'
                        );
                        console.log(data);
                    }
                });
            });
        });
    </script>

    <script>
        $(function() {
            // Variable declaration for table
            var dt_invoice_table = $('.invoice-list-table');

            // Invoice datatable
            if (dt_invoice_table.length) {
                var dt_invoice = dt_invoice_table.DataTable({
                    ajax: "{{ route('profile.membership-history') }}", // JSON file to add data
                    columns: [{
                            data: 'id'
                        },
                        {
                            data: 'created_at'
                        },
                        {
                            data: 'status'
                        },
                        {
                            data: 'start_membership'
                        },
                        {
                            data: 'end_membership'
                        },
                        {
                            data: 'total'
                        },
                    ],
                });
            }
        });
    </script>
@endpush
