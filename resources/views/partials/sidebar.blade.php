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
            @hasrole('admin')
            <li class="{{ Str::startsWith(Route::currentRouteName(), 'product.create') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('purchase.in_transit') }}">
                    <i class="fa-solid fa-eye"></i>
                    <span>Goods In Transit</span>
                </a>
            </li>
            @endhasrole
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
                    <i class="fas">
                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M0 448V64h18v384H0zm26.857-.273V64H36v383.727h-9.143zm27.143 0V64h8.857v383.727H54zm44.857 0V64h8.857v383.727h-8.857zm36 0V64h17.714v383.727h-17.714zm44.857 0V64h8.857v383.727h-8.857zm18 0V64h8.857v383.727h-8.857zm18 0V64h8.857v383.727h-8.857zm35.715 0V64h18v383.727h-18zm44.857 0V64h18v383.727h-18zm35.999 0V64h18.001v383.727h-18.001zm36.001 0V64h18.001v383.727h-18.001zm26.857 0V64h18v383.727h-18zm45.143 0V64h26.857v383.727h-26.857zm35.714 0V64h9.143v383.727H476zm18 .273V64h18v384h-18z"/></svg>
                    </i> 
                    <span>Products</span>
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
                        <li class="{{ Str::contains(Route::currentRouteName(), 'purchase') ? 'active' : '' }}"><a class="nav-link" href="{{ route('purchase.view') }}">All Purchases</a></li>
                        <li class="{{ Str::contains(Route::currentRouteName(), 'create') ? 'active' : '' }}"><a class="nav-link" href="{{ route('purchase.create') }}">Add Purchase</a></li>
                        <li class="{{ Str::contains(Route::currentRouteName(), 'return_purchase') ? 'active' : '' }}"><a class="nav-link" href="{{ route('purchase.returned') }}">View Returned Purchases</a></li>

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
                        <li class="{{ Str::contains(Route::currentRouteName(), '/sale') ? 'active' : '' }}"><a class="nav-link" href="{{ route('sale.view') }}">All Sales</a></li>
                        <li class="{{ Str::contains(Route::currentRouteName(), 'return_sale') ? 'active' : '' }}"><a class="nav-link" href="{{ route('sale.returned') }}">Returned Sales</a></li>
                    </ul>
                </li>
                @endcanany
            
            @endrole

            @role(['admin','manager'])
                <li class="menu-header text-danger">Inventory Management</li>
                @can('adjust-stock')
                <li class="{{ Str::startsWith(Route::currentRouteName(), 'stock.adjustments') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('stock.adjustments') }}">
                        <i class="fas fa-apple-crate">
                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M8 256c0 136.966 111.033 248 248 248s248-111.034 248-248S392.966 8 256 8 8 119.033 8 256zm248 184V72c101.705 0 184 82.311 184 184 0 101.705-82.311 184-184 184z"/></svg>
                        </i> <span>Adjustment</span>
                    </a>
                </li>
                @endcan

                @can('transfer-product')
                <li class="dropdown">
                    <a class="nav-link has-dropdown {{ Str::startsWith(Route::currentRouteName(), 'transfer') ? 'active' : '' }}" href="#">
                        <i class="fas"> 
                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M0 168v-16c0-13.255 10.745-24 24-24h360V80c0-21.367 25.899-32.042 40.971-16.971l80 80c9.372 9.373 9.372 24.569 0 33.941l-80 80C409.956 271.982 384 261.456 384 240v-48H24c-13.255 0-24-10.745-24-24zm488 152H128v-48c0-21.314-25.862-32.08-40.971-16.971l-80 80c-9.372 9.373-9.372 24.569 0 33.941l80 80C102.057 463.997 128 453.437 128 432v-48h360c13.255 0 24-10.745 24-24v-16c0-13.255-10.745-24-24-24z"/></svg>
                        </i>
                        <span>Transfer</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class=""><a class="nav-link" href="{{ route('transfer.view', ['flag' => 'warehouse']) }}">Warehouse Transfers</a></li>
                        <li class=""><a class="nav-link" href="{{ route('transfer.view', ['flag' => 'store']) }}">Store Transfers</a></li>
                    </ul>
                </li>
               
                @endcan
            @endrole

            <li class="menu-header text-danger">Expenses Management</li>
            @can('create-expense-type')
            <li class="{{ Str::startsWith(Route::currentRouteName(), 'expense.ty') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('expense.types') }}">
                    <i class="fas">
                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M256 32C114.62 32 0 125.12 0 240c0 49.56 21.41 95.01 57.02 130.74C44.46 421.05 2.7 465.97 2.2 466.5A7.995 7.995 0 0 0 8 480c66.26 0 115.99-31.75 140.6-51.38C181.29 440.93 217.59 448 256 448c141.38 0 256-93.12 256-208S397.38 32 256 32zm24 302.44V352c0 8.84-7.16 16-16 16h-16c-8.84 0-16-7.16-16-16v-17.73c-11.42-1.35-22.28-5.19-31.78-11.46-6.22-4.11-6.82-13.11-1.55-18.38l17.52-17.52c3.74-3.74 9.31-4.24 14.11-2.03 3.18 1.46 6.66 2.22 10.26 2.22h32.78c4.66 0 8.44-3.78 8.44-8.42 0-3.75-2.52-7.08-6.12-8.11l-50.07-14.3c-22.25-6.35-40.01-24.71-42.91-47.67-4.05-32.07 19.03-59.43 49.32-63.05V128c0-8.84 7.16-16 16-16h16c8.84 0 16 7.16 16 16v17.73c11.42 1.35 22.28 5.19 31.78 11.46 6.22 4.11 6.82 13.11 1.55 18.38l-17.52 17.52c-3.74 3.74-9.31 4.24-14.11 2.03a24.516 24.516 0 0 0-10.26-2.22h-32.78c-4.66 0-8.44 3.78-8.44 8.42 0 3.75 2.52 7.08 6.12 8.11l50.07 14.3c22.25 6.36 40.01 24.71 42.91 47.67 4.05 32.06-19.03 59.42-49.32 63.04z"/></svg>
                    </i> 
                    <span>Expense Type</span>
                </a>
            </li>
            @endcan
            <li class="{{ Str::startsWith(Route::currentRouteName(), 'expense.expense') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('expense.expenses') }}">
                    <i class="fas">
                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M400 0H48C22.4 0 0 22.4 0 48v416c0 25.6 22.4 48 48 48h352c25.6 0 48-22.4 48-48V48c0-25.6-22.4-48-48-48zM128 435.2c0 6.4-6.4 12.8-12.8 12.8H76.8c-6.4 0-12.8-6.4-12.8-12.8v-38.4c0-6.4 6.4-12.8 12.8-12.8h38.4c6.4 0 12.8 6.4 12.8 12.8v38.4zm0-128c0 6.4-6.4 12.8-12.8 12.8H76.8c-6.4 0-12.8-6.4-12.8-12.8v-38.4c0-6.4 6.4-12.8 12.8-12.8h38.4c6.4 0 12.8 6.4 12.8 12.8v38.4zm128 128c0 6.4-6.4 12.8-12.8 12.8h-38.4c-6.4 0-12.8-6.4-12.8-12.8v-38.4c0-6.4 6.4-12.8 12.8-12.8h38.4c6.4 0 12.8 6.4 12.8 12.8v38.4zm0-128c0 6.4-6.4 12.8-12.8 12.8h-38.4c-6.4 0-12.8-6.4-12.8-12.8v-38.4c0-6.4 6.4-12.8 12.8-12.8h38.4c6.4 0 12.8 6.4 12.8 12.8v38.4zm128 128c0 6.4-6.4 12.8-12.8 12.8h-38.4c-6.4 0-12.8-6.4-12.8-12.8V268.8c0-6.4 6.4-12.8 12.8-12.8h38.4c6.4 0 12.8 6.4 12.8 12.8v166.4zm0-256c0 6.4-6.4 12.8-12.8 12.8H76.8c-6.4 0-12.8-6.4-12.8-12.8V76.8C64 70.4 70.4 64 76.8 64h294.4c6.4 0 12.8 6.4 12.8 12.8v102.4z"/></svg>
                    </i> 
                    <span>Expenses</span>
                </a>
            </li>

            @can('view-reports')
            <li class="menu-header text-danger">Reports</li>
                @can('view-payment-report')
                <li class="dropdown">
                    <a class="nav-link has-dropdown" href="#">
                        <i class="fas fa-file-chart-line"></i> <span>Payment Reports</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="{{ Str::contains(Route::currentRouteName(), 'report.supplier_payment') ? 'active' : '' }}"><a class="nav-link" href="{{ route('report.supplier_payment') }}">Supplier Payments</a></li>
                        <li class="{{ Str::contains(Route::currentRouteName(), 'report.customer_payment') ? 'active' : '' }}"><a class="nav-link" href="{{ route('report.customer_payment') }}">Customer Payments</a></li>
                    </ul>
                </li>
                @endcan

                @can('view-stock-report')
                <li class="{{ Str::startsWith(Route::currentRouteName(), 'report.stock') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('report.stock') }}">
                        <i class="fas fa-file-chart-pie"></i> <span>Stock Report</span>
                    </a>
                </li>
                    
                @endcan

                @can('view-entry-report')
                <li class="dropdown">
                    <a class="nav-link has-dropdown" href="#">
                        <i class="fas fa-scanner-keyboard"></i><span>Data Entry Reports</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="{{ Str::contains(Route::currentRouteName(), 'report.product_entry') ? 'active' : '' }}"><a class="nav-link" href="{{ route('report.product_entry') }}">Product</a></li>
                        <li class="{{ Str::contains(Route::currentRouteName(), 'report.customer_entry') ? 'active' : '' }}"><a class="nav-link" href="{{ route('report.customer_entry') }}">Customer</a></li>
                        <li class="{{ Str::contains(Route::currentRouteName(), 'report.supplier_entry') ? 'active' : '' }}"><a class="nav-link" href="{{ route('report.supplier_entry') }}">Supplier</a></li>
                        <li class="{{ Str::contains(Route::currentRouteName(), 'report.purchase_entry') ? 'active' : '' }}"><a class="nav-link" href="{{ route('report.purchase_entry') }}">Purchase</a></li>
                        <li class="{{ Str::contains(Route::currentRouteName(), 'report.purchase_return_entry') ? 'active' : '' }}"><a class="nav-link" href="{{ route('report.purchase_return_entry') }}">Purchase Return</a></li>
                        <li class="{{ Str::contains(Route::currentRouteName(), 'report.sale_entry') ? 'active' : '' }}"><a class="nav-link" href="{{ route('report.sale_entry') }}">Sale</a></li>
                        <li class="{{ Str::contains(Route::currentRouteName(), 'report.sale_return_entry') ? 'active' : '' }}"><a class="nav-link" href="{{ route('report.sale_return_entry') }}">Sale Return</a></li>
                        <li class="{{ Str::contains(Route::currentRouteName(), 'report.adjustment') ? 'active' : '' }}"><a class="nav-link" href="{{ route('report.adjustment') }}">Adjustment</a></li>
                        <li class="{{ Str::contains(Route::currentRouteName(), 'report.transfer') ? 'active' : '' }}"><a class="nav-link" href="{{ route('report.transfer') }}">Transfer</a></li>
                        <li class="{{ Str::contains(Route::currentRouteName(), 'report.expense') ? 'active' : '' }}"><a class="nav-link" href="{{ route('report.expense') }}">Expense</a></li>
                        <li class="{{ Str::contains(Route::currentRouteName(), 'report.supplier_payment_entry') ? 'active' : '' }}"><a class="nav-link" href="{{ route('report.supplier_payment_entry') }}">Supplier Payment</a></li>
                        <li class="{{ Str::contains(Route::currentRouteName(), 'report.customer_payment_entry') ? 'active' : '' }}"><a class="nav-link" href="{{ route('report.customer_payment_entry') }}">Customer Payment</a></li>

                    </ul>


                </li>
                @endcan
                
            @endcan

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

<style>
    .dropdown-menu > li.active {
        color: white !important;
        background-color: transparent !important!
    }
</style>