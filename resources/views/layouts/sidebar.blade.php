<div id="layoutSidenav_nav">
    <nav class="sidenav shadow-right sidenav-light">
        <div class="sidenav-menu">
            <div class="nav accordion" id="accordionSidenav">
                <!-- Sidenav Menu Heading (Account)-->
                <!-- * * Note: * * Visible only on and above the sm breakpoint-->
                <div class="sidenav-menu-heading d-sm-none">Account</div>
                <!-- Sidenav Link (Alerts)-->
                <!-- * * Note: * * Visible only on and above the sm breakpoint-->
                <a class="nav-link d-sm-none" href="#!">
                    <div class="nav-link-icon"><i data-feather="bell"></i></div>
                    Alerts
                    <span class="badge bg-warning-soft text-warning ms-auto">4 New!</span>
                </a>
                <!-- Sidenav Link (Messages)-->
                <!-- * * Note: * * Visible only on and above the sm breakpoint-->
                <a class="nav-link d-sm-none" href="#!">
                    <div class="nav-link-icon"><i data-feather="mail"></i></div>
                    Messages
                    <span class="badge bg-success-soft text-success ms-auto">2 New!</span>
                </a>
                @can('is_admin')
                    {{-- menu admin --}}
                    <div class="sidenav-menu-heading">menu admin</div>
                    <a class="nav-link {{ Request::is('admin*') ? 'active' : '' }} {{ Request::is('admin*') ? '' : 'collapsed' }}"
                        href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#collapAdmin"
                        aria-expanded="false" aria-controls="collapAdmin">
                        <div class="nav-link-icon"><i class="fas fa-user-shield"></i></div>
                        <i class="fa-light fa-router"></i>
                        Dashboards Admin
                        <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse {{ Request::is('admin*') ? 'show' : '' }}" id="collapAdmin"
                        data-bs-parent="#accordionSidenav">
                        <nav class="sidenav-menu-nested nav">
                            <a class="nav-link {{ Request::is('admin/dashboard') ? 'active' : '' }}"
                                href={{ route('admin.dashboard') }}>Dashboard</a>
                            <a class="nav-link {{ Request::is('#') ? 'active' : '' }}" href="#">List
                                Tunnel</a>

                        </nav>
                    </div>
                    {{-- menu admin --}}
                @endcan
                <!-- Sidenav Menu Heading (Core)-->
                <div class="sidenav-menu-heading">Menu</div>
                <!-- Sidenav Accordion (Dashboard)-->
                <a class="nav-link {{ Request::is('dashboard*') ? 'active' : '' }}" href={{ route('dashboard') }}>
                    <div class="nav-link-icon"><i data-feather="activity"></i></div>
                    Dashboards
                </a>

                <!-- Sidenav Heading (Custom)-->
                <div class="sidenav-menu-heading">Layanan</div>
                <a class="nav-link {{ Request::is('tunnel*') ? 'active' : '' }} {{ Request::is('tunnel*') ? '' : 'collapsed' }}"
                    href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#collapTunnel"
                    aria-expanded="false" aria-controls="collapTunnel">
                    <div class="nav-link-icon"><i data-feather="repeat"></i></div><i class="fa-light fa-router"></i>
                    Layanan Tunnel VPN
                    <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse {{ Request::is('tunnels*') ? 'show' : '' }}" id="collapTunnel"
                    data-bs-parent="#accordionSidenav">
                    <nav class="sidenav-menu-nested nav">
                        <a class="nav-link {{ Request::is('tunnels/create') ? 'active' : '' }}"
                            href={{ route('tunnels.create') }}>Buat
                            Tunnel</a>
                        <a class="nav-link {{ Request::is('tunnels') ? 'active' : '' }}"
                            href={{ route('tunnels.index') }}>List
                            Tunnel</a>

                    </nav>
                </div>
                {{-- <a class="nav-link collapsed" href="javascript:void(0);" data-bs-toggle="collapse"
                    data-bs-target="#collapseComponents" aria-expanded="false" aria-controls="collapseComponents">
                    <div class="nav-link-icon"><i data-feather="package"></i></div>
                    Mikhmon Online
                    <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseComponents" data-bs-parent="#accordionSidenav">
                    <nav class="sidenav-menu-nested nav">
                        <a class="nav-link" href="#">Lis Mikhmon Online</a>
                        <a class="nav-link" href="#">Buat Mikhmon Online <span
                                class="badge bg-danger-soft text-danger ms-auto">Server Full</span>
                        </a>
                    </nav>
                </div>
                <!-- Sidenav Accordion (Mikbotam)-->
                <a class="nav-link collapsed" href="javascript:void(0);" data-bs-toggle="collapse"
                    data-bs-target="#collapseMikbotam" aria-expanded="false" aria-controls="collapseMikbotam">
                    <div class="nav-link-icon"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round" class="feather feather-message-circle">
                            <path
                                d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z">
                            </path>
                        </svg></i></div>
                    Mikbotam Online
                    <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseMikbotam" data-bs-parent="#accordionSidenav">
                    <nav class="sidenav-menu-nested nav">
                        <a class="nav-link" href="#">List Mikbotam Online</a>
                        <a class="nav-link" href="#">Order Mikbotam Online</a>
                    </nav>
                </div> --}}
                <!-- Sidenav Heading (Profile)-->
                <div class="sidenav-menu-heading">Profile & Saldo</div>
                <a class="nav-link {{ Request::is('profile*') ? 'active' : '' }} {{ Request::is('profile*') ? '' : 'collapsed' }}"
                    href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#collapseProfile"
                    aria-expanded="false" aria-controls="collapseProfile">
                    <div class="nav-link-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-sliders">
                            <line x1="4" y1="21" x2="4" y2="14"></line>
                            <line x1="4" y1="10" x2="4" y2="3"></line>
                            <line x1="12" y1="21" x2="12" y2="12"></line>
                            <line x1="12" y1="8" x2="12" y2="3"></line>
                            <line x1="20" y1="21" x2="20" y2="16"></line>
                            <line x1="20" y1="12" x2="20" y2="3"></line>
                            <line x1="1" y1="14" x2="7" y2="14"></line>
                            <line x1="9" y1="8" x2="15" y2="8"></line>
                            <line x1="17" y1="16" x2="23" y2="16"></line>
                        </svg>
                    </div>
                    Account
                    <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse {{ Request::is('profile*') ? 'show' : '' }}" id="collapseProfile"
                    data-bs-parent="#accordionSidenav">
                    <nav class="sidenav-menu-nested nav">
                        <a class="nav-link {{ Request::is('profile*') ? 'active' : '' }}"
                            href={{ route('profile.edit', auth()->user()->phone) }}>Profile & Password</a>
                    </nav>
                </div>

                <a class="nav-link {{ Request::is('topup*') ? 'active' : '' }}" href={{ route('topup.create') }}>
                    <div class="nav-link-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-dollar-sign">
                            <line x1="12" y1="1" x2="12" y2="23"></line>
                            <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                        </svg>
                    </div>
                    Saldo
                </a>
            </div>
        </div>
        <!-- Sidenav Footer-->
        <div class="sidenav-footer">
            <div class="sidenav-footer-content">
                <div class="sidenav-footer-subtitle">Logged in as:</div>
                <div class="sidenav-footer-title">{{ auth()->user()->name }}</div>
            </div>
        </div>
    </nav>
</div>
