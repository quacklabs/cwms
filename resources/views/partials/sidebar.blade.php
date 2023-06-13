<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand sidebar-gone-show mb-4">
            <a href="{{ route('dashboard') }}">
                <img src="{{ asset('img/logo.png') }}" style="max-height: 4em !important;">
            </a>
        </div>
        <ul class="sidebar-menu">
            <!-- <li class="menu-header">Dashboard</li> -->
            <li class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('dashboard') }}"><i class="fas fa-home"></i> <span>Overview</span></a>
            </li>
            
            <!-- <li class="menu-header">User Management</li> -->
            @role('admin')
            <li class="{{ request()->routeIs('managers') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('managers') }}">
                <i class="fas fa-briefcase"></i> <span>Managers</span>
                </a>
            </li>
            @endrole

            @can('create-user', auth()->user())
            <li class="{{ request()->routeIs('staff') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('staff') }}">
                <i class="fas fa-people-carry"></i> <span>Staff</span>
                </a>
            </li> 
            @endcan

            @canany(['permission:grant-user-permission', 'permission:grant-product-permission'])
            <li class="{{ request()->routeIs('access') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('control') }}">
                <i class="fas fa-universal-access"></i> <span>Access Control</span>
                </a>
            </li>
            @endcanany

            <!-- <li class="menu-header">Locations</li> -->
            <li class="dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-th-large"></i> <span>Components</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="dist/components_article">Article</a></li>
                    <li><a class="nav-link beep beep-sidebar"
                            href="dist/components_avatar">Avatar</a></li>
                    <li><a class="nav-link" href="dist/components_chat_box">Chat Box</a></li>
                    <li><a class="nav-link beep beep-sidebar"
                            href="dist/components_empty_state">Empty State</a></li>
                    <li><a class="nav-link" href="dist/components_gallery">Gallery</a></li>
                    <li><a class="nav-link beep beep-sidebar"
                            href="dist/components_hero">Hero</a></li>
                    <li><a class="nav-link" href="dist/components_multiple_upload">Multiple
                            Upload</a></li>
                    <li><a class="nav-link beep beep-sidebar"
                            href="dist/components_pricing">Pricing</a></li>
                    <li><a class="nav-link" href="dist/components_statistic">Statistic</a></li>
                    <li><a class="nav-link" href="dist/components_tab">Tab</a></li>
                    <li><a class="nav-link" href="dist/components_table">Table</a></li>
                    <li><a class="nav-link" href="dist/components_user">User</a></li>
                    <li><a class="nav-link beep beep-sidebar"
                            href="dist/components_wizard">Wizard</a></li>
                </ul>
            </li>
            
            
            
        </ul>
    </aside>
</div>