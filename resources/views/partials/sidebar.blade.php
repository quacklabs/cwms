<div class="main-sidebar sidebar-style-2 bg-dark">
    <aside id="sidebar-wrapper mb-5">
        <div class="sidebar-brand mb-4 mt-4">
            <a href="{{ route('dashboard') }}">
                <img src="{{ asset('img/logo.png') }}" style="max-height: 4em !important;">
            </a>
        </div>
        <ul class="sidebar-menu mb-5">
            <li class="menu-header">Dashboard</li>
            <li class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('dashboard') }}"><i class="fas fa-home"></i> <span>Overview</span></a>
            </li>
            
            @hasanyrole('manager|admin')
            <li class="menu-header">User Management</li>
            @endhasanyrole

            @role('admin')
            <li class="{{ request()->routeIs('staff.managers') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('staff.managers') }}">
                <i class="fas fa-briefcase"></i> <span>Managers</span>
                </a>
            </li>
            @endrole


            @hasanyrole('manager|admin')
            <li class="{{ request()->routeIs('staff.staff') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('staff.staff') }}">
                <i class="fas fa-people-carry"></i> <span>Staff</span>
                </a>
            </li> 
            @endhasanyrole

            @role('admin')
            <li class="{{ request()->routeIs('access.byRole') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('access.byRole') }}">
                <i class="fas fa-universal-access"></i> <span>Access Control</span>
                </a>
            </li>
            @endrole

            <li class="menu-header {{ (Str::startsWith(Route::currentRouteName(), 'partner')) ? 'active' : '' }}">Partners Management</li>
            <li class="{{ request()->routeIs('partner.customers') || request()->routeIs('partner.customer') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('partner.customers') }}">
                <i class="fas fa-user-tag"></i><span>Customers</span>
                </a>
            </li>
            <li class="{{ request()->routeIs('partner.suppliers') || request()->routeIs('partner.supplier') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('partner.suppliers') }}">
                <i class="fas fa-users"></i> <span>Suppliers</span>
                </a>
            </li>

            @hasanyrole('admin|manager')
            <li class="menu-header">WareHouse/Store Management</li>
            <li class="{{ (Str::startsWith(Route::currentRouteName(), 'warehouse')) ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('warehouse.all_warehouses') }}">
                    <i class="fas fa-warehouse"></i> <span>Warehouse</span>
                </a>
            </li>
            <li class="{{ (Str::startsWith(Route::currentRouteName(), 'store')) ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('store.stores') }}">
                    <i class="fas fa-store-alt"></i> <span>Stores</span>
                </a>
            </li>
            @endhasanyrole

            <li class="menu-header {{ (Str::startsWith(Route::currentRouteName(), 'product')) ? 'active' : '' }}">Product Management</li>
            <li class="{{ request()->routeIs('product.categories') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('product.categories') }}">
                <i class="far fa-layer-group"></i> <span>Categories</span>
                </a>
            </li>
            <li class="{{ request()->routeIs('product.brands') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('product.brands') }}">
                    <i class="far fa-copyright"></i> <span>Brands</span>
                </a>
            </li>

            <li class="{{ request()->routeIs('product.units') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('product.units') }}">
                    <i class="far fa-balance-scale"></i> <span>Units</span>
                </a>
            </li>

            <li class="{{ request()->routeIs('product.products') || request()->routeIs('product.product') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('product.products') }}">
                    <i class="fas fa-apple-crate"></i> <span>Products</span>
                </a>
            </li>

            

            <!-- <li class="menu-header">Locations</li> -->
            <!-- <li class="dropdown">
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
            </li> -->
        </ul>
    </aside>
</div>