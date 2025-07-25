<div class="sidebar-header">
    <div>
        <img src="{{ asset('public/assets/images/logo-ftb.png') }}" class="logo-icon" alt="logo icon">
    </div>
    <div>
        <h4 class="logo-text">FTB2025</h4>
        <h6 class="logo-subtitle">Festival Tari Borneo 2025</h6>
    </div>
    <div class="toggle-icon ms-auto" id="toggle-icon"><i class='bx bx-arrow-to-left'></i></div>
</div>

<!--navigation-->
<ul class="metismenu" id="menu">
    <li class="{{ Request::routeIs('home') ? 'mm-active' : '' }}">
        <a href="{{ route('home') }}">
            <div class="parent-icon"><i class='bx bx-home-circle'></i></div>
            <div class="menu-title">Dashboard</div>
        </a>
    </li>

    @php
        $registration = \App\Models\Registration::where('user_id', auth()->id())->first();
    @endphp

    @role('Peserta')
        @if ($registration)
            <li class="{{ request()->routeIs('registration.view') ? 'mm-active' : '' }}">
                <a href="{{ route('registration.view', $registration->id) }}">
                    <div class="parent-icon"><i class='bx bx-file'></i></div>
                    <div class="menu-title">Penyertaan</div>
                </a>
            </li>
        @else
            <li class="{{ request()->routeIs('registration.create') ? 'mm-active' : '' }}">
                <a href="{{ route('registration.create') }}">
                    <div class="parent-icon"><i class='bx bx-plus-circle'></i></div>
                    <div class="menu-title">Daftar Penyertaan</div>
                </a>
            </li>
        @endif
    @endrole

    @hasanyrole('Superadmin|Admin')
        <li class="{{ Request::routeIs('registration*') ? 'mm-active' : '' }}">
            <a href="{{ route('registration') }}">
                <div class="parent-icon"><i class='bx bx-file'></i></div>
                <div class="menu-title">Penyertaan</div>
            </a>
        </li>
    @endhasanyrole

    <li>
        <a href="https://kenyalang.uitm.edu.my/ftb2025" target="_blank" rel="noopener">
            <div class="parent-icon"><i class='bx bx-link'></i></div>
            <div class="menu-title">FTB 2025</div>
        </a>
    </li>

    <li>
        <a href="{{ route('manual-pengguna') }}" target="_blank">
            <div class="parent-icon"><i class='bx bxs-bookmark'></i></div>
            <div class="menu-title">Manual Pengguna</div>
        </a>
    </li>

    @hasanyrole('Superadmin|Admin')
        <li class="menu-label">Pengurusan Pengguna</li>

        <li class="{{ Request::is('user*') && !Request::is('user-role*') ? 'mm-active' : '' }}">
            <a href="{{ route('user') }}">
                <div class="parent-icon"><i class='bx bx-user-circle'></i></div>
                <div class="menu-title">Pengguna</div>
            </a>
        </li>
    @endhasanyrole

    @role('Superadmin')
        <li class="{{ Request::is('user-role*') ? 'mm-active' : '' }}">
            <a href="{{ route('user-role') }}">
                <div class="parent-icon"><i class='bx bx-shield'></i></div>
                <div class="menu-title">Peranan Pengguna</div>
            </a>
        </li>

        {{-- 
    <li class="menu-label">Setting</li>

    <li class="{{ Request::is('campus*') ? 'mm-active' : '' }}">
        <a class="has-arrow" href="#">
            <div class="parent-icon"><i class='bx bx-location-plus'></i></div>
            <div class="menu-title">Data</div>
        </a>
        <ul>
            <li class="{{ Request::is('campus*') ? 'mm-active' : '' }}">
                <a href="{{ route('campus') }}"><i class="bx bx-right-arrow-alt"></i>Member Role</a>
            </li>
        </ul>
    </li>

    <li class="{{ Request::is('position*') ? 'mm-active' : '' }}">
        <a class="has-arrow" href="#">
            <div class="parent-icon"><i class="bx bx-cog"></i></div>
            <div class="menu-title">Tetapan Umum</div>
        </a>
        <ul>
            <li class="{{ Request::is('position*') ? 'mm-active' : '' }}">
                <a href="{{ route('position') }}"><i class="bx bx-right-arrow-alt"></i>Jawatan</a>
            </li>
        </ul>
    </li> --}}

        <li class="menu-label">Tetapan</li>
        <li class="{{ Request::routeIs('activity-log') ? 'mm-active' : '' }}">
            <a href="{{ route('activity-log') }}">
                <div class="parent-icon"><i class='bx bx-history'></i></div>
                <div class="menu-title">Aktiviti Log</div>
            </a>
        </li>

        <li class="{{ Request::routeIs('logs.debug') ? 'mm-active' : '' }}">
            <a href="{{ route('logs.debug') }}">
                <div class="parent-icon"><i class='bx bxs-bug'></i></div>
                <div class="menu-title">Debug Log</div>
            </a>
        </li>
    @endrole
</ul>
<!--end navigation-->
