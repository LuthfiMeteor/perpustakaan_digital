@extends('dashboard.layouts.app')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light">Account Settings / </span> Connections</h4>

        <div class="row">
            <div class="col-md-12">
                @include('dashboard.profiles.components.navbar-profile')
                <div class="row">
                    <div class="col-md-12 col-12 mb-md-0 mb-4">
                        <div class="card">
                            <h5 class="card-header pb-1">Connected Accounts</h5>
                            <div class="card-body">
                                <p class="mb-4">Display content from your connected accounts on your site</p>
                                <!-- Connections -->
                                <div class="d-flex mb-3">
                                    <div class="flex-shrink-0">
                                        <img src="{{ asset('asset-template/img/icons/brands/google.png') }}" alt="google"
                                            class="me-3" height="30" />
                                    </div>
                                    <div class="flex-grow-1 row">
                                        <div class="col-9">
                                            <h6 class="mb-0">Google</h6>
                                            <small class="text-muted">Make Easy With Google</small>
                                        </div>
                                        <div class="col-3 d-flex align-items-center justify-content-end mt-sm-0 mt-2">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input float-end" id="google-auth-checkbox"
                                                    type="checkbox" {{ Auth::user()->google_id == '' ? '' : 'checked' }} />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if ($errors->has('googlenotsame'))
                                    <div class="alert alert-danger">
                                        {{ $errors->first('googlenotsame') }}
                                    </div>
                                @endif
                                <!-- /Connections -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script src="{{ asset('asset-template/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('asset-template/vendor/libs/popper/popper.js') }}"></script>
    {{-- <script src="{{ asset('asset-template/vendor/js/bootstrap.js') }}"></script> --}}
    <script src="{{ asset('asset-template/vendor/libs/node-waves/node-waves.js') }}"></script>
    <script src="{{ asset('asset-template/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('asset-template/vendor/libs/hammer/hammer.js') }}"></script>
    <script src="{{ asset('asset-template/vendor/libs/i18n/i18n.js') }}"></script>
    <script src="{{ asset('asset-template/vendor/libs/typeahead-js/typeahead.js') }}"></script>
    <script src="{{ asset('asset-template/vendor/js/menu.js') }}"></script>
    <script src="{{ asset('asset-template/vendor/libs/@form-validation/umd/bundle/popular.min.js') }}"></script>
    <script src="{{ asset('asset-template/vendor/libs/@form-validation/umd/plugin-bootstrap5/index.min.js') }}"></script>
    <script src="{{ asset('asset-template/vendor/libs/@form-validation/umd/plugin-auto-focus/index.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#google-auth-checkbox').on('click', function() {
                window.location.href = "{{ route('connect.google') }}";
            });
        });
    </script>
@endpush
