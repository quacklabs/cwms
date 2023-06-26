<div class="main-sidebar sidebar-style-1">
    <aside id="sidebar-wrapper mb-5">
        <div class="sidebar-brand mb-4 mt-4">
            <a href="{{ route('dashboard') }}">
                <img src="{{ asset('img/logo.png') }}" style="max-height: 4em !important;">
            </a>
        </div>
        <ul class="sidebar-menu mb-5">
            <li class="menu-header text-danger">Dashboard</li>
            <li class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('dashboard') }}"><i class="fas fa-home"></i> <span>Overview</span></a>
            </li>
            
            @hasanyrole('manager|admin')
            <li class="menu-header text-danger">User Management</li>
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

            <li class="menu-header">Partners Management</li>
            <li class="{{ (Str::contains(Route::currentRouteName(), 'customer') == true) ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('partner.all', ['flag' => 'customer']) }}">
                <i class="fas fa-user-tag"></i><span>Customers</span>
                </a>
            </li>
            <li class="{{ Str::contains(Route::currentRouteName(), 'supplier') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('partner.all', ['flag' => 'supplier']) }}">
                <i class="fas fa-users"></i> <span>Suppliers</span>
                </a>
            </li>

            @hasanyrole('admin|manager')
            <li class="menu-header text-danger">WareHouse/Store Management</li>
            <li class="{{ Str::startsWith(Route::currentRouteName(), 'warehouse') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('warehouse.all_warehouses') }}">
                    <i class="fas fa-warehouse"></i> <span>Warehouse</span>
                </a>
            </li>
            <li class="{{ Str::startsWith(Route::currentRouteName(), 'store') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('store.stores') }}">
                    <i class="fas fa-store-alt"></i> <span>Stores</span>
                </a>
            </li>
            @endhasanyrole

            <li class="menu-header">Product Management</li>
            <li class="{{ Str::startsWith(Route::currentRouteName(), 'product.categories') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('product.categories') }}">
                <i class="far fa-layer-group"></i> <span>Categories</span>
                </a>
            </li>
            <li class="{{ Str::startsWith(Route::currentRouteName(), 'product.brands') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('product.brands') }}">
                    <i class="far fa-copyright"></i> <span>Brands</span>
                </a>
            </li>

            <li class="{{ Str::startsWith(Route::currentRouteName(), 'product.units') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('product.units') }}">
                    <i class="far fa-balance-scale"></i> <span>Units</span>
                </a>
            </li>

            <li class="{{ Str::startsWith(Route::currentRouteName(), 'product.product') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('product.products') }}">
                    <i class="fas fa-apple-crate"></i> <span>Products</span>
                </a>
            </li>


            @role(['admin','manager','staff'])
            <li class="menu-header text-danger">Transactions Management</li>
                @canany(['view-purchase','view-purchase-return'])
                <li class="dropdown">
                    <a class="nav-link has-dropdown" href="#">
                        <i class="fas fa-shopping-cart"></i> <span>Purchases</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="{{ Str::contains(Route::currentRouteName(), '/purchase') ? 'active' : '' }}"><a class="nav-link" href="{{ route('transaction.view', ['flag' => 'purchase']) }}">All Purchases</a></li>
                        <li class="{{ Str::contains(Route::currentRouteName(), 'return_purchase') ? 'active' : '' }}"><a class="nav-link" href="{{ route('transaction.view', ['flag' => 'return_purchase']) }}">Returned Purchases</a></li>
                    </ul>
                </li>
                @endcanany


                @canany(['view-sale', 'view-sale-return'])
                <li class="dropdown">
                    <a class="nav-link has-dropdown" href="#">
                        <i class="fas"> 
                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M511.1 378.8l-26.7-160c-2.6-15.4-15.9-26.7-31.6-26.7H208v-64h96c8.8 0 16-7.2 16-16V16c0-8.8-7.2-16-16-16H48c-8.8 0-16 7.2-16 16v96c0 8.8 7.2 16 16 16h96v64H59.1c-15.6 0-29 11.3-31.6 26.7L.8 378.7c-.6 3.5-.9 7-.9 10.5V480c0 17.7 14.3 32 32 32h448c17.7 0 32-14.3 32-32v-90.7c.1-3.5-.2-7-.8-10.5zM280 248c0-8.8 7.2-16 16-16h16c8.8 0 16 7.2 16 16v16c0 8.8-7.2 16-16 16h-16c-8.8 0-16-7.2-16-16v-16zm-32 64h16c8.8 0 16 7.2 16 16v16c0 8.8-7.2 16-16 16h-16c-8.8 0-16-7.2-16-16v-16c0-8.8 7.2-16 16-16zm-32-80c8.8 0 16 7.2 16 16v16c0 8.8-7.2 16-16 16h-16c-8.8 0-16-7.2-16-16v-16c0-8.8 7.2-16 16-16h16zM80 80V48h192v32H80zm40 200h-16c-8.8 0-16-7.2-16-16v-16c0-8.8 7.2-16 16-16h16c8.8 0 16 7.2 16 16v16c0 8.8-7.2 16-16 16zm16 64v-16c0-8.8 7.2-16 16-16h16c8.8 0 16 7.2 16 16v16c0 8.8-7.2 16-16 16h-16c-8.8 0-16-7.2-16-16zm216 112c0 4.4-3.6 8-8 8H168c-4.4 0-8-3.6-8-8v-16c0-4.4 3.6-8 8-8h176c4.4 0 8 3.6 8 8v16zm24-112c0 8.8-7.2 16-16 16h-16c-8.8 0-16-7.2-16-16v-16c0-8.8 7.2-16 16-16h16c8.8 0 16 7.2 16 16v16zm48-80c0 8.8-7.2 16-16 16h-16c-8.8 0-16-7.2-16-16v-16c0-8.8 7.2-16 16-16h16c8.8 0 16 7.2 16 16v16z"/></svg>    
                        </i>
                        <span>Sales</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="{{ Str::contains(Route::currentRouteName(), '/sale') ? 'active' : '' }}"><a class="nav-link" href="{{ route('transaction.view', ['flag' => 'sale']) }}">All Sales</a></li>
                        <li class="{{ Str::contains(Route::currentRouteName(), 'return_sale') ? 'active' : '' }}"><a class="nav-link" href="{{ route('transaction.view', ['flag' => 'return_purchase']) }}">Returned Sales</a></li>
                    </ul>
                </li>
                @endcanany
            
            @endrole

            @role(['admin','manager'])
                <li class="menu-header text-danger">Inventory Management</li>
                @can('adjust-stock')
                <li class="{{ Str::startsWith(Route::currentRouteName(), 'stock.adjustments') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('stock.adjustments') }}">
                        <i class="fas fa-apple-crate"></i> <span>Adjustment</span>
                    </a>
                </li>
                @endcan

                @can('transfer-product')
                <li class="{{ Str::startsWith(Route::currentRouteName(), 'transfer') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('transfer.transfers') }}">
                        <i class="fas fa-apple-crate"></i> <span>Transfer</span>
                    </a>
                </li>
                @endcan
            @endrole

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