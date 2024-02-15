@extends('dashboard.layouts.app')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light">Account Settings /</span> Account</h4>

        <div class="row">
            <div class="col-md-12">
                @include('dashboard.profiles.components.navbar-profile')
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
                                        <input type="file" name="uploadphoto" id="upload" class="account-file-input"
                                            hidden accept="image/png, image/jpeg" />
                                    </label>
                                    <button type="button" class="btn btn-label-secondary account-image-reset mb-3">
                                        <i class="ti ti-refresh-dot d-block d-sm-none"></i>
                                        <span class="d-none d-sm-block">Reset</span>
                                    </button>

                                    <div class="text-muted">Allowed JPG, GIF or PNG. Max size of 2MB (1 : 1)</div>
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
                                    <input class="form-control @error('email') is-invalid @enderror" type="text"
                                        id="email" name="email" value="{{ Auth::user()->email }}"
                                        placeholder="contoh@example.com" />
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
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

    <style>
        .otp-field {
            flex-direction: row;
            column-gap: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .otp-field input {
            height: 45px;
            width: 42px;
            border-radius: 6px;
            outline: none;
            font-size: 1.125rem;
            text-align: center;
            border: 1px solid #ddd;
        }

        .otp-field input:focus {
            box-shadow: 0 1px 0 rgba(0, 0, 0, 0.1);
        }

        .otp-field input::-webkit-inner-spin-button,
        .otp-field input::-webkit-outer-spin-button {
            display: none;
        }

        .resend {
            font-size: 12px;
        }
    </style>
    <div class="modal fade" id="emailverifmodal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-md modal-simple modal-pricing">
            <div class="modal-content p-2 p-md-5">
                <div class="modal-body">
                    <section class="container-fluid bg-body-tertiary d-block">
                        <div class="row justify-content-center">
                            <div class="col-12 col-md-6 col-lg-4" style="min-width: 500px;">
                                <div class="card bg-white mb-5 mt-5 border-0"
                                    style="box-shadow: 0 12px 15px rgba(0, 0, 0, 0.02);">
                                    <div class="card-body p-5 text-center">
                                        <h4>Verify</h4>
                                        <p>Your code was sent to you via email</p>

                                        <form id="otpForm" method="post">
                                            @csrf
                                            <div class="otp-field mb-4">
                                                <input type="number" name="otp[]" />
                                                <input type="number" name="otp[]" disabled />
                                                <input type="number" name="otp[]" disabled />
                                                <input type="number" name="otp[]" disabled />
                                                <input type="number" name="otp[]" disabled />
                                                <input type="number" name="otp[]" disabled />
                                            </div>

                                            <button type="submit" class="btn btn-primary mb-3">
                                                Verify
                                            </button>
                                        </form>

                                        <p class="resend text-muted mb-0">
                                            Didn't receive code? <a href="#" id="requestAgainLink">Request again</a>
                                            <span id="cooldownTimer" style="display:none;"></span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
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
    <script src="{{ asset('vendor/sweetalert/sweetalert.all.js') }}"></script>
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
    <script>
        const inputs = document.querySelectorAll(".otp-field > input");
        const button = document.querySelector(".btn");

        window.addEventListener("load", () => inputs[0].focus());
        button.setAttribute("disabled", "disabled");

        inputs[0].addEventListener("paste", function(event) {
            event.preventDefault();

            const pastedValue = (event.clipboardData || window.clipboardData).getData(
                "text"
            );
            const otpLength = inputs.length;

            for (let i = 0; i < otpLength; i++) {
                if (i < pastedValue.length) {
                    inputs[i].value = pastedValue[i];
                    inputs[i].removeAttribute("disabled");
                    inputs[i].focus;
                } else {
                    inputs[i].value = ""; // Clear any remaining inputs
                    inputs[i].focus;
                }
            }
        });

        inputs.forEach((input, index1) => {
            input.addEventListener("keyup", (e) => {
                const currentInput = input;
                const nextInput = input.nextElementSibling;
                const prevInput = input.previousElementSibling;

                if (currentInput.value.length > 1) {
                    currentInput.value = "";
                    return;
                }

                if (
                    nextInput &&
                    nextInput.hasAttribute("disabled") &&
                    currentInput.value !== ""
                ) {
                    nextInput.removeAttribute("disabled");
                    nextInput.focus();
                }

                if (e.key === "Backspace") {
                    inputs.forEach((input, index2) => {
                        if (index1 <= index2 && prevInput) {
                            input.setAttribute("disabled", true);
                            input.value = "";
                            prevInput.focus();
                        }
                    });
                }

                button.classList.remove("active");
                button.setAttribute("disabled", "disabled");

                const inputsNo = inputs.length;
                if (!inputs[inputsNo - 1].disabled && inputs[inputsNo - 1].value !== "") {
                    button.classList.add("active");
                    button.removeAttribute("disabled");

                    return;
                }
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function(e) {
            (function() {
                const formAccSettings = document.querySelector('#formAccountSettings'),
                    deactivateAcc = document.querySelector('#formAccountDeactivation'),
                    deactivateButton = deactivateAcc.querySelector('.deactivate-account');
                if (formAccSettings) {
                    const fv = FormValidation.formValidation(formAccSettings, {
                        fields: {
                            firstName: {
                                validators: {
                                    notEmpty: {
                                        message: 'Please enter first name'
                                    }
                                }
                            },
                            lastName: {
                                validators: {
                                    notEmpty: {
                                        message: 'Please enter last name'
                                    }
                                }
                            }
                        },
                        plugins: {
                            trigger: new FormValidation.plugins.Trigger(),
                            bootstrap5: new FormValidation.plugins.Bootstrap5({
                                eleValidClass: '',
                                rowSelector: '.col-md-6'
                            }),
                            submitButton: new FormValidation.plugins.SubmitButton(),
                            // Submit the form when all fields are valid
                            // defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
                            autoFocus: new FormValidation.plugins.AutoFocus()
                        },
                        init: instance => {
                            instance.on('plugins.message.placed', function(e) {
                                if (e.element.parentElement.classList.contains(
                                        'input-group')) {
                                    e.element.parentElement.insertAdjacentElement(
                                        'afterend', e.messageElement);
                                }
                            });
                        }
                    });
                }

                if (deactivateAcc) {
                    const fv = FormValidation.formValidation(deactivateAcc, {
                        fields: {
                            accountActivation: {
                                validators: {
                                    notEmpty: {
                                        message: 'Please confirm you want to delete account'
                                    }
                                }
                            }
                        },
                        plugins: {
                            trigger: new FormValidation.plugins.Trigger(),
                            bootstrap5: new FormValidation.plugins.Bootstrap5({
                                eleValidClass: ''
                            }),
                            submitButton: new FormValidation.plugins.SubmitButton(),
                            fieldStatus: new FormValidation.plugins.FieldStatus({
                                onStatusChanged: function(areFieldsValid) {
                                    areFieldsValid
                                        ? // Enable the submit button
                                        // so user has a chance to submit the form again
                                        deactivateButton.removeAttribute(
                                            'disabled') : // Disable the submit button
                                        deactivateButton.setAttribute('disabled',
                                            'disabled');
                                }
                            }),
                            // Submit the form when all fields are valid
                            // defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
                            autoFocus: new FormValidation.plugins.AutoFocus()
                        },
                        init: instance => {
                            instance.on('plugins.message.placed', function(e) {
                                if (e.element.parentElement.classList.contains(
                                        'input-group')) {
                                    e.element.parentElement.insertAdjacentElement(
                                        'afterend', e.messageElement);
                                }
                            });
                        }
                    });
                }

                // Deactivate account alert
                const accountActivation = document.querySelector('#accountActivation');

                // Alert With Functional Confirm Button
                if (deactivateButton) {
                    deactivateButton.onclick = function() {
                        if (accountActivation.checked == true) {
                            Swal.fire({
                                text: 'Are you sure you would like to deactivate your account?',
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonText: 'Yes',
                                customClass: {
                                    confirmButton: 'btn btn-primary me-2',
                                    cancelButton: 'btn btn-label-secondary'
                                },
                                buttonsStyling: false
                            }).then(function(result) {
                                if (result.value) {
                                    // Perform AJAX request to send email
                                    $('#emailverifmodal').modal('show');
                                    $.ajax({
                                        url: '{{ route('profile.email-otp') }}', // Change this to your route URL
                                        method: 'POST',
                                        data: {
                                            _token: '{{ csrf_token() }}'
                                        }, // Add any additional data if required
                                        success: function(response) {

                                        },
                                        error: function(xhr, status, error) {
                                            console.error(xhr.responseText);
                                            Swal.fire({
                                                title: 'Error',
                                                text: 'Failed to send email.',
                                                icon: 'error',
                                                customClass: {
                                                    confirmButton: 'btn btn-success'
                                                }
                                            });
                                        }
                                    });
                                } else if (result.dismiss === Swal.DismissReason.cancel) {
                                    Swal.fire({
                                        title: 'Cancelled',
                                        text: 'Deactivation Cancelled!!',
                                        icon: 'error',
                                        customClass: {
                                            confirmButton: 'btn btn-success'
                                        }
                                    });
                                }
                            });
                        }
                    };
                }
            })();
        });
    </script>
    <script>
        // Function to start the cooldown timer
        function startCooldownTimer(duration) {
            let timer = duration;
            const cooldownTimer = $('#cooldownTimer');
            cooldownTimer.show();

            const interval = setInterval(function() {
                const minutes = Math.floor(timer / 60);
                const seconds = timer % 60;

                cooldownTimer.text(minutes + "m " + seconds + "s");

                timer--;

                if (timer < 0) {
                    cooldownTimer.hide();
                    $('#requestAgainLink').removeClass('d-none');
                    clearInterval(interval);
                }
            }, 1000);
        }

        function requestAgain() {
            // Disable the link
            $('#requestAgainLink').addClass('d-none');

            // Send AJAX request to the controller to request another OTP
            $.ajax({
                url: '{{ route('profile.email-otp') }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    status: 'ulang',
                },
                success: function(response) {
                    // $('#emailverifmodal').modal('show');

                    // Start the cooldown timer for 60 seconds (60 * 60 seconds)
                    startCooldownTimer(60);
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);

                    // Hide loading spinner upon error
                    $('#loadingSpinner').hide();

                    Swal.fire({
                        title: 'Error',
                        text: 'Failed to send email.',
                        icon: 'error',
                        customClass: {
                            confirmButton: 'btn btn-success'
                        }
                    });

                    // Re-enable the link
                    $('#requestAgainLink').removeClass('d-none');
                }
            });
        }

        $('#requestAgainLink').click(function(event) {
            event.preventDefault();
            requestAgain();
        });
    </script>
    <script>
        $('#otpForm').submit(function(event) {
            // Prevent default form submission
            event.preventDefault();

            // Check if any of the input fields are empty
            $('input[type="number"]').each(function() {
                if (!this.value) {
                    // If the input field is empty, add the is-invalid class
                    $(this).addClass('form-control is-invalid');
                } else {
                    // If the input field is filled, remove the is-invalid class (if present)
                    $(this).removeClass('form-control is-invalid');
                }
            });

            // Check if any input field is empty
            if ($('input[type="number"]').filter(function() {
                    return !this.value;
                }).length) {
                // If any input field is empty, show an alert
                return;
            }

            // If all OTP fields are filled, serialize the form data and send it via AJAX
            $.ajax({
                url: '{{ route('profile.deactive-account-process') }}',
                method: $('#otpForm').attr('method'),
                data: $('#otpForm').serialize(),
                success: function(response) {
                    // Handle successful response
                    console.log(response.success);
                    if (response.success === false) {
                        // If OTP verification failed
                        $('input[type="number"]').each(function() {
                            $(this).addClass('form-control is-invalid');
                        });
                    } else {
                        window.location.href = '{{ route('login') }}'
                    }
                },
                error: function(xhr, status, error) {
                    // Handle error
                    console.error(xhr.responseText);
                }
            });
        });
    </script>
@endpush
