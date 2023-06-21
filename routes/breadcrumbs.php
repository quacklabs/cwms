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