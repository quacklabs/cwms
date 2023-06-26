<?php // routes/breadcrumbs.php

// Note: Laravel will automatically resolve `Breadcrumbs::` without
// this import. This is nice for IDE syntax and refactoring.
use Diglactic\Breadcrumbs\Breadcrumbs;

// This import is also not required, and you could replace `BreadcrumbTrail $trail`
//  with `$trail`. This is nice for IDE type checking and completion.
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Home
Breadcrumbs::for('dashboard', function (BreadcrumbTrail $trail) {
    $trail->push('Dashboard', route('dashboard'));
});

// Dashboard > Staff
Breadcrumbs::for('staff.managers', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Managers');
});

Breadcrumbs::for('staff.staff', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Staff Management');
});

// Dashboard > Access Control
Breadcrumbs::for('access.byRole', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Access Control');
});

Breadcrumbs::for('access.byUser', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('User Access Control');
});


//Dashboard Warehouses
Breadcrumbs::for('warehouse.warehouse', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Warehouses');
});


//Products
Breadcrumbs::for('product.categories', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Categories');
});

Breadcrumbs::for('product.brands', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Brands');
});

Breadcrumbs::for('product.products', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('products');
});

Breadcrumbs::for('product.units', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Units');
});


// Dashboard > Stores
Breadcrumbs::for('store.stores', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Stores');
});

Breadcrumbs::for('store.edit', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Edit Store');
});

// Dashboard > Partners
Breadcrumbs::for('partners.customer', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('View Customers');
});

// Dashboard > Partners
Breadcrumbs::for('partners.supplier', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('View Suppliers');
});

Breadcrumbs::for('partners.edit_customer', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Edit Customer');
});

Breadcrumbs::for('partners.edit_supplier', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Edit Supplier');
});

// Transactions > Purchases
Breadcrumbs::for('transactions.purchase', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Purchases');
});

Breadcrumbs::for('transactions.sale', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Sales');
});

Breadcrumbs::for('transactions.add_sale', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Sales', route('transaction.view', ['flag', 'sale']));
    $trail->push('Add Sale');
});

Breadcrumbs::for('transactions.add_purchase', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Purchases', route('transaction.view', ['flag', 'purchase']));
    $trail->push('Add Purchase');
});


Breadcrumbs::for('transactions.enter_purchase_ledger', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Purchases', route('transaction.view', ['flag', 'purchase']));
    $trail->push('Add Purchase');
});

Breadcrumbs::for('transactions.enter_sale_ledger', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Sales', route('transaction.view', ['flag', 'sale']));
    $trail->push('Add Purchase');
});

// Dashboard > Stock
Breadcrumbs::for('stock.adjustment', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Products', route('product.products'));
    $trail->push('Adjustments');
});

Breadcrumbs::for('stock.make_adjustment', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Products', route('product.products'));
    $trail->push('Adjust Stock');
});

// Dashboard > Transfer
Breadcrumbs::for('transfer.transfers', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Transfers');
});

Breadcrumbs::for('transfer.create', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Transfers', route('transfer.transfers'));
    $trail->push('Make Transfer');
});