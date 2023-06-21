@extends('layout')
@section('title') {{ config('app.name') }} | {{ $title }} @endsection

@section('content')
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
        <h1>{{$title }}</h1>
        @can('create-store')
        <div class="section-header-button">
            <button class="btn btn-primary" data-toggle="modal" data-target="#myModal">Add New</button>
            <!-- <a href="#" class="btn btn-primary">Add New</a> -->
        </div>
        @endcan
        
        {{ Breadcrumbs::render('store.stores') }}
        </div>
        <div class="section-body">
        <h2 class="section-title">Manage Stores</h2>
        <!-- <p class="section-lead">
            Each staff must be assigned to a store
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
                        <h4>All Stores</h4>
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
                                        <th></th>
                                        <th>Name</th>
                                        <th>Location</th>
                                        <th>Warehouse</th>
                                        <th>Actions</th>
                                    </tr>

                                    @empty($stores)

                                    @else
                                        @foreach($stores as $store)
                                        
                                        <tr>
                                            <td class="pricing-item">
                                                @if($store->status == true)
                                                <div class="pricing-details">
                                                    <div class="pricing-item">
                                                        <div class="pricing-item-icon bg-success text-white px-1" style="border-radius: 50%; height: 20px; width: 20px;">
                                                            <i class="fas fa-check"></i>
                                                        </div>
                                                    </div>
                                                </div>

                                                @else
                                                <div class="pricing-item-icon bg-danger text-white px-1" style="border-radius: 50%; height: 20px; width: 20px;">
                                                    <i class="fas fa-times"></i>
                                                </div>
                                                @endif
                                            </td>
                                            <td>{{ $store->name }}</td>
                                            <td>{{ $store->address }}</td>
                                            <td>{{ $store->warehouse->name ?? 'Unassigned' }}</td>
                                            <td>
                                                <div class="buttons">
                                                    <!-- <a href="{{ route('store.view', ['id' => $store->id]) }}" class="btn btn-icon btn-primary" data-toggle="tooltip" data-placement="top" title="" data-original-title="View store">
                                                        <i class="fas fa-eye"></i>
                                                    </a> -->
                                                    @can('suspend-store')
                                                        @if($store->status == true)
                                                        <a href="{{ route('store.toggle', ['id' => $store->id, 'action' => 'suspend']) }}" class="btn btn-icon btn-warning" data-toggle="tooltip" data-placement="top" title="" data-original-title="Deactivate store">
                                                            <i class="fas fa-times"></i>
                                                        </a>
                                                        @else
                                                        <a href="{{ route('store.toggle', ['id' => $store->id, 'action' => 'activate']) }}" class="btn btn-icon btn-success" data-toggle="tooltip" data-placement="top" title="" data-original-title="Activate store">
                                                            <i class="fas fa-check"></i>
                                                        </a>
                                                        @endif
                                                    @endcan

                                                    @can('modify-store')
                                                        <a href="{{ route('store.edit', ['id' => $store->id]) }}" class="btn btn-icon btn-info" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit store">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                    @endcan

                                                    @can('delete-store')
                                                        <a href="{{ route('store.delete', ['id' => $store->id]) }}" class="btn btn-icon btn-danger" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete store">
                                                            <i class="fas fa-trash"></i>
                                                        </a>
                                                    @endcan
                                                    <!-- <a href="#" class="btn btn-icon btn-secondary" data-toggle="tooltip" data-placement="top" title="" data-original-title="Vivamus sagittis lacus vel augue laoreet rutrum faucibus."><i class="far fa-user"></i></a>
                                                    <a href="#" class="btn btn-icon btn-info" data-toggle="tooltip" data-placement="top" title="" data-original-title="Vivamus sagittis lacus vel augue laoreet rutrum faucibus."><i class="fas fa-info-circle"></i></a>
                                                    <a href="#" class="btn btn-icon btn-warning" data-toggle="tooltip" data-placement="top" title="" data-original-title="Vivamus sagittis lacus vel augue laoreet rutrum faucibus."><i class="fas fa-exclamation-triangle"></i></a>
                                                    <a href="#" class="btn btn-icon btn-danger" data-toggle="tooltip" data-placement="top" title="" data-original-title="Vivamus sagittis lacus vel augue laoreet rutrum faucibus."><i class="fas fa-times"></i></a>
                                                    <a href="#" class="btn btn-icon btn-success" data-toggle="tooltip" data-placement="top" title="" data-original-title="Vivamus sagittis lacus vel augue laoreet rutrum faucibus."><i class="fas fa-check"></i></a>
                                                    <a href="#" class="btn btn-icon btn-light" data-toggle="tooltip" data-placement="top" title="" data-original-title="Vivamus sagittis lacus vel augue laoreet rutrum faucibus."><i class="fas fa-star"></i></a>
                                                    <a href="#" class="btn btn-icon btn-dark" data-toggle="tooltip" data-placement="top" title="" data-original-title="Vivamus sagittis lacus vel augue laoreet rutrum faucibus."><i class="far fa-file"></i></a> -->
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach

                                    @endempty

                                   

                                    
                            
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="card-footer">
                        <div class="float-right">
                            @empty($stores)

                            @else
                                {{ $stores->links() }}
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
                <h5 class="modal-title" id="myModalLabel">Add Store</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <hr>
            

            <div class="modal-body">
                <form id="productForm" method="post" action="{{ route('store.stores') }}">
                    @csrf
                    <div class="card-body">
                        <div class="form-row">
                            <div class="form-group col-12">
                                <label for="inputEmail4">Store Name</label>
                                <input id="productName" name="name" type="text" class="form-control" autocomplete="off" required>
                            </div>

                            
                        </div>
                        <div class="form-row">
                            <div class="form-group col-12">
                                <label for="inputEmail4">Address</label>
                                <input id="sku" name="address" type="text" class="form-control" autocomplete="off" required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-12">
                                <label for="site-description">Warehouse</label>
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