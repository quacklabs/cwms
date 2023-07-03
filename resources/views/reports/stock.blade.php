@extends('layout')
@section('title') {{ config('app.name') }} | {{ $title }} @endsection

@section('content')
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
        <h1>{{$title }}</h1>
        
        {{ Breadcrumbs::render() }}
        </div>
        <div class="section-body">
        <h2 class="section-title">View Stock Reports</h2>
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
                        <h4>Filter Stock</h4>
                        <div class="card-header-form">
                            <form>
                                <div class="row">
                                    <div class="input-group col-md-6">
                                        <label>Filter By Warehouse</label>
                                        <input id="date-range" type="text" class="form-control" placeholder="Start Date - End Date">
                                        <div class="input-group-btn">
                                            <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                        </div>
                                    </div>
                                    <div class="input-group col-md-6">
                                        <label>Filter By Product</label>
                                        <input type="text" class="form-control" placeholder="TRX Search">
                                        <div class="input-group-btn">
                                            <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                        </div>
                                    </div>

                                </div>
                                
                                
                            </form>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>

        
        <div class="row mt-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Product Stock</h4>
                        <!-- <div class="card-header-form">
                            <form>
                                <div class="row">
                                    <div class="input-group col-6">
                                        <input id="date-range" type="text" class="form-control" placeholder="Start Date - End Date">
                                        <div class="input-group-btn">
                                            <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                        </div>
                                    </div>
                                    <div class="input-group col-6">
                                        <input type="text" class="form-control" placeholder="TRX Search">
                                        <div class="input-group-btn">
                                            <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                        </div>
                                    </div>

                                </div>
                                
                                
                            </form>
                        </div> -->
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>S.N</th>
                                        <th>Name.</th>
                                        <th>SKU</th>
                                        <th>Category</th>
                                        <th>Brand</th>
                                        <th>Stock</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @empty('stock')


                                    @else
                                        @foreach ($stock as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->sku }}</td>
                                            <td>{{ ucwords($item->categories->name) }}</td>
                                            <td>{{ ucwords($item->brands->name) }}</td>
                                            <td>{{ ucwords($item->productStock->first()->stock_count ) }}</td>
                                        </tr>
                                            
                                        @endforeach
                                        
                                    @endempty
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="card-footer">
                        <div class="float-right">
                        @empty('stock')

                        @else

                            {{ $stock->links() }}
                            
                        @endempty
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<style>
.modal-dialog {
  max-width: 70%;
  margin: auto;
}
</style>

@endsection


@section('js')

@endsection