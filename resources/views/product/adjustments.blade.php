@extends('layout')
@section('title') {{ config('app.name') }} | {{ $title }} @endsection

@section('content')
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
        <h1>{{$title }}</h1>
        @can('adjust-stock')
        <div class="section-header-button">
            <a href="{{ route('stock.make_adjustment') }}" class="btn btn-primary">Add New</a>
            <!-- <a href="#" class="btn btn-primary">Add New</a> -->
        </div>
        @endcan
        
        {{ Breadcrumbs::render('stock.adjustment') }}
        </div>
        <div class="section-body">
        <h2 class="section-title">Adjust Products Stock</h2>
        <!-- <p class="section-lead">
            Each staff must be assigned to a warehouse
        </p> -->

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
                        <h4>All Products</h4>
                        <div class="card-header-form">
                            <form>
                                <div class="row">
                                    <div class="col-5">
                                        <input type="text" class="form-control" placeholder="Start Date">
                                    </div>
                                    <div class="col-5">
                                        <input type="text" class="form-control" placeholder="End Date">
                                    </div>
                                    <div class="col-2">
                                        <button class="btn btn-primary"><i class="fas fa-search"></i> Filter</button>
                                    </div>


                                </div>
                                
                            </form>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>S.N</th>
                                        <th>Tracking No</th>
                                        <th>Date</th>
                                        <th>Warehouse</th>
                                        <th>Products</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @empty($adjustments)


                                    @else
                                        @foreach ($adjustments as $adjustment)
                                            <tr>
                                                <td>$adjustments->firstItem() + $loop->index</td>
                                            </tr>
                                        @endforeach
                                        
                                    @endempty
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="card-footer">
                        <div class="float-right">
                            
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


@empty($edit_product)

@else
<script>
   
</script>
@endempty

@endsection