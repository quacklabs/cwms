@extends('layout')
@section('title') {{ config('app.name') }} | {{ $title }} @endsection

@section('css')
<link rel="stylesheet" href="{{ asset('css/selector.css') }}">
<link rel="stylesheet" href="{{ asset('css/datepicker.css') }}">
    
@endsection

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ $title }}</h1>
            
            {{ Breadcrumbs::render() }}
        </div>

        <div class="section-body">
            <h2 class="section-title">Manage GIT Goods</h2>
            <p class="section-lead">
                
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
                            <h4> </h4>
                            <div class="card-header-form buttons">
                                @empty($product_stock)


                                @else
                                    @if(count($product_stock) > 0)
                                        <a target="_blank" href="#" class="btn btn-sm btn-primary rounded"><i class="fas fa-download"></i> PDF</a>
                                        <a target="_blank" href="#" class="btn btn-sm btn-primary rounded"><i class="fas fa-download"></i> XLS</a>
                                        <a href="#" class="btn btn-sm btn-primary rounded"><i class="fas fa-print"></i> Print</a>
                                    @endif


                                @endempty
                                
                            </div> 
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-striped ">
                                    <thead>
                                        <tr>
                                            <th>Image</th>
                                            <th>Name|SKU</th>
                                            <th>Brand</th>
                                            <th>Category</th>
                                            <th>Stock</th>
                                            
                                            <th>Unit</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="mt-4">

                                    @empty($product_stock)
                                    
                                    @else
                                        @foreach ($product_stock as $stock)
                                        <tr>
                                            <td class="p-0 text-center">
                                                <img src="{{ $product->image_url ?? asset('img/avatar.png') }}" style="height: 80px; width: 80px;">
                                            </td>
                                            <td>
                                                {{ $stock->product->name }}
                                                <span class="text-muted">
                                                    <p>{{ $stock->product->sku }}</p>
                                                </span>
                                            </td>
                                            <td class="p-3">
                                                {{ $stock->product->brands->name }}
                                            </td>
                                            <td class="p-3">
                                            {{ $stock->product->categories->name }}
                                            </td>
                                            <td>{{ $stock->product->totalInStock($user) }}</td>
                                             
                                            <td>{{ $stock->product->unit->name }}</td>
                                            <td><a href="#" class="btn btn-secondary">Detail</a></td>
                                        </tr>
                                            
                                        @endforeach
                                    @endempty

                                    </tbody>


                                </table>
                            </div>
                        </div>

                        <div class="card-footer">
                            <div class="float-right">
                                @empty($product_stock)

                                @else
                                    {{ $product_stock->links() }}
                                @endempty
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
    
@endsection