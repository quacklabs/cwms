@extends('layout')
@section('title') {{ config('app.name') }} | {{ $title }} @endsection


@section('content')

<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{$title }}</h1>
            
            {{ Breadcrumbs::render('partners.edit_'.$flag) }}
        </div>
        <div class="section-body">
            <h2 class="section-title">Information for {{ $partner->name }}</h2>
            <p class="section-lead">
                Edit {{ $flag }} details
            </p>

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

        
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                        <h4>Edit {{ $flag }}</h4>
                        </div>
                        <form method="POST" action="{{route('partner.edit', ['id' => $partner->id, 'flag' => $flag]) }}">
                            @csrf
                            <div class="card-body">
                            
                                <div class="form-group row">
                                    <label for="site-title" class="form-control-label text-md-right col-sm-3">Name</label>
                                    <div class="col-sm-6 col-md-9">
                                    <input name="name" type="text" class="form-control" id="site-title" value="{{ $partner->name }} " required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="site-description" class="form-control-label text-md-right col-sm-3">Address</label>
                                    <div class="col-sm-6 col-md-9">
                                        <input name="address" type="text" class="form-control" id="site-title" value="{{ $partner->address }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="site-description" class="form-control-label text-md-right col-sm-3">Mobile No:</label>
                                    <div class="col-sm-6 col-md-9">
                                        <input name="mobile_no" type="text" class="form-control" id="site-title" value="{{ $partner->mobile_no }}">
                                    </div>   
                                </div>
                                <div class="form-group row">                        
                                    <label for="site-description" class="form-control-label text-md-right col-sm-3">Email</label>
                                    <div class="col-sm-6 col-md-9">
                                        <input name="email" type="text" class="form-control" id="site-title" value="{{ $partner->email }}">
                                    </div>
                                </div>

                                <div class="form-group row align-items-center">
                                    <label for="site-description" class="form-control-label col-sm-3 text-md-right">Active</label>
                                    <div class="col-sm-6 col-md-9">
                                        <input name="status" type="checkbox" name="site_title" class="form-control" id="site-title" {{ ($partner->status == true) ? 'checked' : ''}}>
                                    </div>
                                </div>

                            </div>
                            <div class="card-footer float-right">
                                <button type="submit" class="btn btn-lg btn-primary">Save</button>
                                <!-- <label for="site-descrip
                                tion" class="form-control-label col-sm-3 text-md-right">Active</label> -->
                                
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>


@endsection