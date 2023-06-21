@extends('layout')
@section('title') {{ config('app.name') }} | {{ $title }} @endsection

@section('content')
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
        <h1>{{$title }}</h1>
        @can('create-partner')
        <div class="section-header-button">
            <button class="btn btn-primary" data-toggle="modal" data-target="#myModal">Add New</button>
            <!-- <a href="#" class="btn btn-primary">Add New</a> -->
        </div>
        @endcan
        
        {{ Breadcrumbs::render('partners.'.$flag) }}
        </div>
        <div class="section-body">
        <h2 class="section-title">Manage {{ ucwords($flag) }}</h2>
        <!-- <p class="section-lead">
            Each staff must be assigned to a partner
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
                        <h4>All partners</h4>
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
                                        <th>Email</th>
                                        <th>Address</th>
                                        <th>Mobile Number</th>
                                        <th>Actions</th>
                                    </tr>

                                    @empty($partners)

                                    @else
                                        @foreach($partners as $partner)
                                        
                                        <tr>
                                            <td class="pricing-item">
                                                @if($partner->status == true)
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
                                            <td>{{ $partner->name }}</td>
                                            <td>{{ $partner->email }}</td>
                                            <td>{{ $partner->address }}</td>
                                            <td>{{ $partner->mobile_no }}</td>
                                            <td>
                                                <div class="buttons">
                                                    <!-- <a href="{{ route('partner.view', ['id' => $partner->id, 'flag' => $flag]) }}" class="btn btn-icon btn-primary" data-toggle="tooltip" data-placement="top" title="" data-original-title="View partner">
                                                        <i class="fas fa-eye"></i>
                                                    </a> -->
                                                    @can('suspend-partner')
                                                        @if($partner->status == true)
                                                        <a href="{{ route('partner.toggle', ['id' => $partner->id, 'action' => 'suspend', 'flag' => $flag]) }}" class="btn btn-icon btn-warning" data-toggle="tooltip" data-placement="top" title="" data-original-title="Deactivate partner">
                                                            <i class="fas fa-times"></i>
                                                        </a>
                                                        @else
                                                        <a href="{{ route('partner.toggle', ['id' => $partner->id, 'action' => 'activate', 'flag' => $flag]) }}" class="btn btn-icon btn-success" data-toggle="tooltip" data-placement="top" title="" data-original-title="Activate partner">
                                                            <i class="fas fa-check"></i>
                                                        </a>
                                                        @endif
                                                    @endcan

                                                    @can('modify-partner')
                                                        <a href="{{ route('partner.edit', ['flag' => $flag, 'id' => $partner->id]) }}" class="btn btn-icon btn-info" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit partner">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                    @endcan

                                                    @can('delete-partner')
                                                        <a href="{{ route('partner.delete', ['id' => $partner->id,'flag' => $flag]) }}" class="btn btn-icon btn-danger" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete partner">
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
                            @empty($partners)

                            @else
                                {{ $partners->links() }}
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
                <h5 class="modal-title" id="myModalLabel">Add {{ ucwords($flag) }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <hr>
            

            <div class="modal-body">
                <form id="productForm" method="post" action="{{ route('partner.all', ['flag' => $flag]) }}">
                    @csrf
                    <div class="card-body">
                            
                        <div class="form-group row">
                            <label for="site-title" class="form-control-label text-md-right col-sm-3">Name</label>
                            <div class="col-sm-6 col-md-9">
                            <input name="name" type="text" name="site_title" class="form-control" id="site-title" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="site-description" class="form-control-label text-md-right col-sm-3">Address</label>
                            <div class="col-sm-6 col-md-9">
                                <input name="address" type="text" class="form-control" id="site-title">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="site-description" class="form-control-label text-md-right col-sm-3">Mobile No:</label>
                            <div class="col-sm-6 col-md-9">
                                <input name="mobile_no" type="text"  class="form-control" id="site-title" required>
                            </div>   
                        </div>
                        <div class="form-group row">                        
                            <label for="site-description" class="form-control-label text-md-right col-sm-3">Email</label>
                            <div class="col-sm-6 col-md-9">
                                <input name="email" type="text" class="form-control" id="site-title" required>
                            </div>
                        </div>

                        <div class="form-group row align-items-center">
                            <label for="site-description" class="form-control-label col-sm-3 text-md-right">Active</label>
                            <div class="col-sm-6 col-md-9">
                                <input name="status" type="checkbox" name="site_title" class="form-control" id="site-title" checked>
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