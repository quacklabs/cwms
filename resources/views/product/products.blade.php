@extends('layout')
@section('title') {{ config('app.name') }} | {{ $title }} @endsection

@section('content')
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
        <h1>{{$title }}</h1>
        @can('create-product')
        <div class="section-header-button">
            <button class="btn btn-primary" data-toggle="modal" data-target="#myModal">Add New</button>
            <!-- <a href="#" class="btn btn-primary">Add New</a> -->
        </div>
        @endcan
        
        {{ Breadcrumbs::render('product.products') }}
        </div>
        <div class="section-body">
        <h2 class="section-title">Manage Products</h2>
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
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <div class="input-group-btn">
                                        <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <tbody>
                                    <tr>
                                        <th>Image</th>
                                        <th>Name|SKU</th>
                                        <th>Brand</th>
                                        <th>Category</th>
                                        <th>Stock</th>
                                        <th>Total Sale | Alert Qty</th>
                                        <th>Unit</th>
                                        <th>Actions</th>
                                    </tr>

                                    @empty(@products)
                                    
                                    @else
                                        @foreach ($products as $product)
                                        <tr>
                                            <td class="p-0 text-center">
                                                <img src="image;base64,{{ $product->image }}" style="height: 80px; width: 80px;">
                                            </td>
                                            <td>
                                                {{ $product->name }}
                                                <span class="text-muted">
                                                    <p>{{ $product->sku }}</p>
                                                </span>
                                            </td>
                                            <td class="p-3">
                                                {{ $product->brands->name }}
                                            </td>
                                            <td class="p-3">
                                            {{ $product->categories->name }}
                                            </td>
                                            <td>{{ $product->totalInStock() }}</td>
                                            <td class="p-3">
                                                {{ $product->totalSale() }}
                                                <span class="text-muted">
                                                    <p>{{ $product->alert }} {{ $product->unit->name }}</p>
                                                </span>
                                            </td>
                                            <td>{{ $product->unit->name }}</td>
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
                            @empty($products)

                            @else
                                {{ $products->links() }}
                            @endempty
                        </div>
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


<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content card">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Add product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <hr>
            

            <div class="modal-body">
                <form id="productForm" method="post" action="{{ route('product.products') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="form-row">
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="inputEmail4">Product Name</label>
                                <input id="productName" name="name" type="text" class="form-control" autocomplete="off" required>
                            </div>

                            <div class="form-group col-md-6 col-sm-12">
                                <label for="inputEmail4">SKU</label>
                                <input id="sku" name="sku" type="text" class="form-control" autocomplete="off" required>
                            </div>
                        </div>

                        <div class="form-row">
                            <!-- <div class="form-group col-6 col-sm-12">
                                <label for="inputEmail4"></label>
                                <input id="productName" name="name" type="text" class="form-control" autocomplete="off" required>
                            </div> -->

                            <div class="form-group col-md-6 col-sm-12">
                                <label for="inputEmail4">Category</label>
                                <select class="form-control" name="category_id">
                                    @empty(@categories)
                                    <option>No Categories</option>
                                    @else
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ ucwords($category->name) }}</option>
                                        @endforeach
                                    @endempty
                                </select>
                            </div>

                            <div class="form-group col-md-6 col-sm-12">
                                <label for="inputEmail4">Unit</label>
                                <select class="form-control" name="unit_id">
                                    @empty(@units)
                                    <option>No Units</option>
                                    @else
                                        @foreach ($units as $unit)
                                            <option value="{{ $unit->id }}">{{ strtoupper($unit->name) }}</option>
                                        @endforeach
                                    @endempty
                                </select>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="inputEmail4">Brand Name</label>
                                <select class="form-control" name="brand_id">
                                    @empty(@brands)
                                    <option>No Brands</option>
                                    @else
                                        @foreach ($brands as $brand)
                                            <option value="{{ $brand->id }}">{{ ucwords($brand->name) }}</option>
                                        @endforeach
                                    @endempty
                                </select>
                            </div>

                            <div class="form-group col-md-6 col-sm-12">
                                <label for="inputEmail4">Alert Amount</label>
                                <input id="productName" name="alert" type="number" class="form-control" autocomplete="off" required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="inputEmail4">Image</label>
                                <input name="image" type="file" class="form-control">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12 col-sm-12">
                                <label for="inputEmail4">Notes</label>
                                <textarea class="form-control" name="notes">

                                </textarea>
                            </div>
                        </div>
                        
                        
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary btn-lg">Save</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

@endsection


@section('js')


@empty($edit_product)

@else
<script>
    // $(function() {
    //     $("#myModalLabel").html('Edit product')
    //     const form = $("#productForm")
    //     $("#productName").val("{{ $edit_product->name }}")

    //     var newAction = "{{ route('product.edit', ['type' => 'edit_product', 'id' => $product->id]) }}" 
    //     console.log(newAction); // Verify the newAction value in the console
    //     form.attr('action', newAction);
        
    //     $(".close").click(function(e) {
    //         e.preventDefault()
    //         window.location.href = "{{ route('product.products') }}"
    //     });

    //     $("#myModal").modal('show')
    // })
</script>
@endempty

@endsection