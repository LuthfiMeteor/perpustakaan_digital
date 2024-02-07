@extends('dashboard/layouts/app')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light">Account Settings /</span> Security</h4>

        <div class="row">
            <div class="col-md-12">
                @include('dashboard.profiles.components.navbar-profile')
                <!-- Change Password -->
                <div class="card mb-4">
                    <h5 class="card-header">Change Password</h5>
                    <div class="card-body">
                        <form id="" method="POST" action="{{ route('profile.update-password') }}">
                            @csrf
                            <div class="row">
                                <div class="mb-3 col-md-6 form-password-toggle">
                                    <label class="form-label" for="currentPassword">Current Password</label>
                                    <div class="input-group input-group-merge">
                                        <input class="form-control @error('currentPassword') is-invalid @enderror"
                                            type="password" name="currentPassword" id="currentPassword" required
                                            placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
                                        <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                                        @error('currentPassword')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col-md-6 form-password-toggle">
                                    <label class="form-label" for="newPassword">New Password</label>
                                    <div class="input-group input-group-merge">
                                        <input class="form-control @error('newPassword') is-invalid @enderror"
                                            type="password" id="newPassword" name="newPassword"
                                            placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                            required />
                                        <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                                        @error('newPassword')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-3 col-md-6 form-password-toggle">
                                    <label class="form-label" for="confirmPassword">Confirm New Password</label>
                                    <div class="input-group input-group-merge">
                                        <input class="form-control @error('confirmPassword') is-invalid @enderror"
                                            type="password" name="confirmPassword" id="confirmPassword" required
                                            placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
                                        <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                                        @error('confirmPassword')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 mb-4">
                                    <h6>Password Requirements:</h6>
                                    <ul class="ps-3 mb-0">
                                        <li class="mb-1">Minimum 8 characters long - the more, the better</li>
                                        <li class="mb-1">At least one lowercase character</li>
                                        <li>At least one number, symbol, or whitespace character</li>
                                    </ul>
                                </div>
                                <div>
                                    <button type="submit" class="btn btn-primary me-2">Save changes</button>
                                    <button type="reset" class="btn btn-label-secondary">Cancel</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!--/ Change Password -->

                <!-- Recent Devices -->
                <div class="card mb-4">
                    <h5 class="card-header">Login History</h5>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">IP Address</th>
                                    <th scope="col">Device</th>                                    
                                    <th scope="col">Location</th>
                                    <th scope="col">Login at</th>
                                    <th scope="col">Login Successfully</th>
                                    <th scope="col">Logout at</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($logs as $key => $item)
                                    <tr>
                                        <th scope="row">{{ ++$key }}</th>
                                        <td>{{ $item['ip_address'] }}</td>
                                        <th>{{ $item['user_agent'] }}</th>
                                        <td>{{ $item->location ? $item->location['city'] : '-' }}</td>
                                        <td>{{ Carbon\Carbon::parse($item['login_at'])->isoFormat('D MMMM YYYY h:mm A') }}
                                        </td>
                                        <td>{{ $item['login_successful'] ? 'Yes' : 'No' }}</td>
                                        <td>{{ $item['logout_at'] ? Carbon\Carbon::parse($item->logout_at)->isoFormat('D MMMM YYYY h:mm A') : '-' }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!--/ Recent Devices -->
            </div>
        </div>
    </div>
@endsection
