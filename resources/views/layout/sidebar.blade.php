<div id="sidebar" class="active">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header">
            <div class="d-flex justify-content-between">
                <div class="logo">
                    <a href="/">
                        <img src="{{ asset('mazer/images/logo/logo2.png') }}" alt="Logo" srcset="">CANNA</a>
                </div>
                <div class="toggler">
                    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                </div>
            </div>
        </div>
        <div class="sidebar-menu">
            <ul class="menu">
                    {{-- <li class="sidebar-item {{ $title == 'Home' ? 'active' : '' }} ">
                        <a href="/" class='sidebar-link'>
                            <i class="bi bi-house-door-fill"></i>
                            <span>Home</span>
                        </a>
                    </li> --}}
                    <li class="sidebar-item {{ $title == 'Dashboard' ? 'active' : '' }} ">
                        <a href="/admin" class='sidebar-link'>
                            <i class="bi bi-grid-fill"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>

                    <li
                        class="sidebar-item {{ $title == 'Training'  ? 'active' : '' }} ">
                        <a href="/training" class='sidebar-link'>
                            <i class="bi bi-pencil-square"></i>
                            <span>Data Training</span>
                        </a>
                    </li>

                    <li
                        class="sidebar-item {{ $title == 'Perhitungan' || $title == 'Decision Tree' || $title == 'Rules Klasifikasi' ? 'active' : '' }} has-sub">
                        <a href="#" class='sidebar-link'>
                            <i class="bi bi-bar-chart-steps"></i>
                            <span>Algoritma C4.5</span>
                        </a>
                        <ul class="submenu ">
                            <li class="submenu-item {{ $title == 'Perhitungan' ? 'active' : '' }} ">
                                <a href="#">Perhitungan</a>
                            </li>
                            <li class="submenu-item {{ $title == 'Decision Tree' ? 'active' : '' }} ">
                                <a href="#">Decision Tree</a>
                            </li>
                            <li class="submenu-item {{ $title == 'Rules Klasifikasi' ? 'active' : '' }} ">
                                <a href="#">Rules Klasifikasi</a>
                            </li>
                            
                        </ul>
                    </li>

                    <li class="sidebar-title">
                        <hr>
                    </li>

                    <li class="sidebar-item {{ $title == 'Setting' || $title == 'Users' ? 'active' : '' }} has-sub">
                        <a href="#" class='sidebar-link'>
                            <i class="bi bi-gear"></i>
                            <span>Pengaturan</span>
                        </a>
                        <ul class="submenu ">
                            <li class="submenu-item {{ $title == 'Setting' ? 'active' : '' }}">
                                <a href="#">Admin</a>
                            </li>
                                <li class="submenu-item {{ $title == 'User' ? 'active' : '' }}">
                                    <a href="#">Ganti Password</a>
                                </li>
                        </ul>
                    </li>
                    <li class="sidebar-title">
                        <hr>
                    </li>                   
                    <li
                        class="sidebar-item {{ $title == 'Training'  ? 'active' : '' }} ">
                        <a href="/login" class='sidebar-link'>
                            <i class="bi bi-box-arrow-left"></i>
                            <span>Logout</span>
                        </a>
                    </li>

                <!-- <li class="sidebar-title">Setting</li> -->

            </ul>
        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
</div>
