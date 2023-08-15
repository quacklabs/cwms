@extends('layout')
@section('title') {{ config('app.name') }} | {{ $title }} @endsection

@section('css')
<link rel="stylesheet" href="{{ asset('css/iziToast.css') }}">

@endsection


@section('content')
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{$title }}</h1>
            <!-- <div class="section-header-button">
                <button class="btn btn-primary" data-toggle="modal" data-target="#myModal">Add New</button>
            </div> -->
            {{ Breadcrumbs::render('access.byUser') }}
            </div>
            <div class="section-body">
            <h2 class="section-title">Staff Access Authorization</h2>
            <p class="section-lead">
                Modify access control based on user
            </p>
        </div>

        <div class="section-content">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                    <div class="card-header">
                        <h4>All Permissions</h4>
                    </div>
                    @include('access.user')
                </div>
            </div>
        </div>
    </section>
</div>
@endsection