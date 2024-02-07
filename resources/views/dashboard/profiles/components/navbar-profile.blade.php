<ul class="nav nav-pills flex-column flex-md-row mb-4">
    <li class="nav-item">
        <a class="nav-link {{ Request::route()->getName() == 'profile' ? 'active' : '' }}" href="{{ route('profile') }}">
            <i class="ti-xs ti ti-users me-1"></i> Account
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ Request::route()->getName() == 'profile.security' ? 'active' : '' }}"
            href="{{ route('profile.security') }}"><i class="ti-xs ti ti-lock me-1"></i>
            Security</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="pages-account-settings-billing.html"><i class="ti-xs ti ti-file-description me-1"></i>
            Billing & Plans</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ Request::route()->getName() == 'profile.connections' ? 'active' : '' }}"
            href="{{ route('profile.connections') }}"><i class="ti-xs ti ti-link me-1"></i>
            Connections</a>
    </li>
</ul>
