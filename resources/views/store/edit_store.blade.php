@extends('layout')
@section('title') {{ config('app.name') }} | {{ $title }} @endsection


@section('content')

<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{$title }}</h1>
            
            {{ Breadcrumbs::render('store.edit') }}
        </div>
        <div class="section-body">
            <h2 class="section-title">{{ $store->name }}</h2>
            <p class="section-lead">
                View store details
            </p>

        
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                        <h4>Edit store</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{route('store.edit', ['id' => $store->id]) }}">
                                @csrf
                                <div class="form-group row align-items-center">
                                    <label for="site-title" class="form-control-label col-sm-3 text-md-right">Name</label>
                                    <div class="col-sm-6 col-md-9">
                                    <input name="name" type="text" name="site_title" class="form-control" id="site-title" value="{{ $store->name }} " required>
                                    </div>
                                </div>
                                <div class="form-group row align-items-center">
                                    <label for="site-description" class="form-control-label col-sm-3 text-md-right">Address</label>
                                    <div class="col-sm-6 col-md-9">
                                        <input name="address" type="text" name="site_title" class="form-control" id="site-title" value="{{ $store->address }}">
                                    </div>
                                </div>

                                <div class="form-group row align-items-center">
                                    <label for="site-description" class="form-control-label col-sm-3 text-md-right">Warehouse</label>
                                    <div class="col-sm-6 col-md-9">
                                        <select class="form-control" name="warehouse_id">
                                            @empty($warehouses)
                                            
                                            @else
                                                @foreach ($warehouses as $warehouse)
                                                <option value="{{$warehouse->id}}">{{ $warehouse->name }}</option>
                                                @endforeach
                                            @endempty
                                        </select>
                                        
                                    </div>
                                </div>

                                <div class="form-group row align-items-center">
                                    <label for="site-description" class="form-control-label col-sm-3 text-md-right">Active</label>
                                    <div class="col-sm-6 col-md-9">
                                        <input name="status" type="checkbox" name="site_title" class="form-control" id="site-title" {{ ($store->status == true) ? 'checked' : ''}}>
                                    </div>
                                </div>

                                <div class="form-group row align-items-center">
                                    <!-- <label for="site-description" class="form-control-label col-sm-3 text-md-right">Active</label> -->
                                    <div class="col-sm-6 col-md-9">
                                        <button type="submit" class="btn btn-large btn-primary">Save</button>
                                    </div>
                                </div>
                            </form>
                             
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>


@endsection