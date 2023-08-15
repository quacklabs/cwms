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
            {{ Breadcrumbs::render('access.byRole') }}
            </div>
            <div class="section-body">
            <h2 class="section-title">Manager Role Authorization</h2>
            <p class="section-lead">
                Modify access control based on user role
            </p>
        </div>

        <div class="section-content">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                    <div class="card-header">
                        <h4>Roles And Access</h4>
                    </div>
                    <div class="card-body">
                        <ul class="nav nav-tabs" id="myTab2" role="tablist">
                            @role('admin')
                            <li class="nav-item">
                                <a class="nav-link active" id="home-tab2" data-toggle="tab" href="#home2" role="tab" aria-controls="home" aria-selected="true">Manager</a>
                            </li>
                            @endrole
                            <li class="nav-item">
                                <a class="nav-link" id="profile-tab2" data-toggle="tab" href="#profile2" role="tab" aria-controls="profile" aria-selected="false">Staff</a>
                            </li>
                        </ul>
                        <div class="tab-content tab-bordered" id="myTab3Content">
                            @role('admin')
                            <div class="tab-pane fade show active" id="home2" role="tabpanel" aria-labelledby="home-tab2">
                                @include('access.manager')
                            </div>
                            @endrole
                            <div class="tab-pane fade {{ ($user->hasRole('manager')) ? 'show active' : '' }}" id="profile2" role="tabpanel" aria-labelledby="profile-tab2">
                                @include('access.staff')
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
                
        </div>
    </section>
</div>


@endsection

@section('js')
<script src="{{ asset('js/iziToast.js') }}"></script>

@if(session('success'))
<script>
$(function() {
    iziToast.success({
        title: 'Action Successful',
        message: "{{ session('success') }}",
        position: 'topRight'
    });
})
</script>
@endif


@if(session('error'))
<script>
$(function() {
    iziToast.error({
        title: 'Action failed',
        message: "{{ session('error') }}",
        position: 'topRight'
    });
})
</script>
@endif

@endsection