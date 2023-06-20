@extends('layout')
@section('title') {{ config('app.name') }} | {{ $title }} @endsection

@section('content')
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
        <h1>{{$title }}</h1>
        <div class="section-header-button">
            <button class="btn btn-primary" data-toggle="modal" data-target="#myModal">Add New</button>
            <!-- <a href="#" class="btn btn-primary">Add New</a> -->
        </div>
        {{ Breadcrumbs::render('product.products') }}
        </div>
        <div class="section-body">
        <h2 class="section-title">Manage Products</h2>
        <!-- <p class="section-lead">
            Each staff must be assigned to a warehouse
        </p> -->

        
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

                                <tr>
                                    <td class="p-0 text-center">
                                        <div class="custom-checkbox custom-control">
                                        <input type="checkbox" data-checkboxes="mygroup" class="custom-control-input" id="checkbox-1">
                                        <label for="checkbox-1" class="custom-control-label">&nbsp;</label>
                                        </div>
                                    </td>
                                    <td>Create a mobile app</td>
                                    <td class="align-middle">
                                        <div class="progress" data-height="4" data-toggle="tooltip" title="" data-original-title="100%" style="height: 4px;">
                                        <div class="progress-bar bg-success" data-width="100" style="width: 100px;"></div>
                                        </div>
                                    </td>
                                    <td>
                                        <img alt="image" src="http://localhost:8080/stisla-codeigniter/assets/img/avatar/avatar-5.png" class="rounded-circle" width="35" data-toggle="tooltip" title="" data-original-title="Wildan Ahdian">
                                    </td>
                                    <td>2018-01-20</td>
                                    <td><div class="badge badge-success">Completed</div></td>
                                    <td><a href="#" class="btn btn-secondary">Detail</a></td>
                                </tr>
                        
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
  max-width: 50%;
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
                <form id="productForm" method="post" action="{{ route('product.products') }}">
                    @csrf
                    <div class="card-body">
                        <div class="form-row">
                            <div class="form-group col-12">
                                <label for="inputEmail4">product Name</label>
                                <input id="productName" name="name" type="text" class="form-control" autocomplete="off" required>
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

@empty($product)

@else
<script>
    $(function() {
        $("#myModalLabel").html('Edit product')
        const form = $("#productForm")
        $("#productName").val("{{ $product->name }}")

        var newAction = "{{ route('product.edit', ['type' => 'edit_product', 'id' => $product->id]) }}" 
        console.log(newAction); // Verify the newAction value in the console
        form.attr('action', newAction);
        
        $(".close").click(function(e) {
            e.preventDefault()
            window.location.href = "{{ route('product.products') }}"
        });

        $("#myModal").modal('show')
    })
</script>
@endempty

@endsection