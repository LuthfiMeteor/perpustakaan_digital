@extends('dashboard.layouts.app')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light">Account Settings /</span> Account</h4>

        <div class="row">
            <div class="col-md-12">
                <ul class="nav nav-pills flex-column flex-md-row mb-4">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('profile') }}"><i class="ti-xs ti ti-users me-1"></i>
                            Account</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('profile.security') }}"><i
                                class="ti-xs ti ti-lock me-1"></i> Security</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="pages-account-settings-billing.html"><i
                                class="ti-xs ti ti-file-description me-1"></i> Billing & Plans</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="pages-account-settings-notifications.html"><i
                                class="ti-xs ti ti-bell me-1"></i> Notifications</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="pages-account-settings-connections.html"><i
                                class="ti-xs ti ti-link me-1"></i> Connections</a>
                    </li>
                </ul>
                <div class="card mb-4">
                    <h5 class="card-header">Profile Details</h5>
                    <!-- Account -->
                    <form id="" method="POST" action="{{ route('profile.account') }}" enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="d-flex align-items-start align-items-sm-center gap-4">
                                @if (Auth::user()->avatar)
                                    <img src="{{ asset('storage/profiles/' . Auth::user()->avatar) }}"
                                        class="rounded-circle" width="100" height="100" alt="User"
                                        id="uploadedAvatar" />
                                    <input type="hidden" name="" id="fotocek" value="{{ Auth::user()->avatar }}">
                                @else
                                    <img src="{{ asset('asset-template/img/avatars/14.png') }}" alt="user-avatar"
                                        class="d-block w-px-100 h-px-100 rounded" id="uploadedAvatar" />
                                @endif
                                <div class="button-wrapper">
                                    <label for="upload" class="btn btn-primary me-2 mb-3" tabindex="0">
                                        <span class="d-none d-sm-block">Upload new photo</span>
                                        <i class="ti ti-upload d-block d-sm-none"></i>
                                        <input type="file" name="uploadphoto" id="upload" class="account-file-input" hidden
                                            accept="image/png, image/jpeg" />
                                    </label>
                                    <button type="button" class="btn btn-label-secondary account-image-reset mb-3">
                                        <i class="ti ti-refresh-dot d-block d-sm-none"></i>
                                        <span class="d-none d-sm-block">Reset</span>
                                    </button>

                                    <div class="text-muted">Allowed JPG, GIF or PNG. Max size of 800K</div>
                                </div>
                            </div>
                        </div>
                        <hr class="my-0" />
                        <div class="card-body">
                            @csrf
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label for="firstName" class="form-label">Name</label>
                                    <input class="form-control" type="text" id="firstName" name="name"
                                        value="{{ Auth::user()->name }}" autofocus />
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="email" class="form-label">E-mail</label>
                                    <input class="form-control" type="text" id="email" name="email"
                                        value="{{ Auth::user()->email }}" placeholder="contoh@example.com" />
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="phoneNumber">Phone Number</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text">ID (+62)</span>
                                        <input type="text" id="phoneNumber" name="phoneNumber" class="form-control"
                                            placeholder="0123456" value="{{ Auth::user()->phone }}" />
                                    </div>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="address" class="form-label">Address</label>
                                    <input type="text" class="form-control" id="address" name="address"
                                        placeholder="Address" value="{{ Auth::user()->address }}" />
                                </div>
                            </div>
                            <div class="mt-2">
                                <button type="submit" class="btn btn-primary me-2">Save changes</button>
                                <button type="reset" class="btn btn-label-secondary">Cancel</button>
                            </div>
                        </div>
                        <!-- /Account -->
                    </form>
                </div>
                <div class="card">
                    <h5 class="card-header">Delete Account</h5>
                    <div class="card-body">
                        <div class="mb-3 col-12 mb-0">
                            <div class="alert alert-warning">
                                <h5 class="alert-heading mb-1">Are you sure you want to delete your account?</h5>
                                <p class="mb-0">Once you delete your account, there is no going back. Please be certain.
                                </p>
                            </div>
                        </div>
                        <form id="formAccountDeactivation" onsubmit="return false">
                            <div class="form-check mb-4">
                                <input class="form-check-input" type="checkbox" name="accountActivation"
                                    id="accountActivation" />
                                <label class="form-check-label" for="accountActivation">I confirm my account
                                    deactivation</label>
                            </div>
                            <button type="submit" class="btn btn-danger deactivate-account">Deactivate Account</button>
                        </form>
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
    <script src="{{ asset('asset-template/js/pages-account-settings-account.js') }}"></script>
@endpush
