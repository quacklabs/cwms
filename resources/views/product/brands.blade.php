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
        {{ Breadcrumbs::render('product.brands') }}
        </div>
        <div class="section-body">
        <h2 class="section-title">Manage Product brands</h2>
        <!-- <p class="section-lead">
            Each staff must be assigned to a warehouse
        </p> -->

        
        <div class="row mt-4">
            <div class="col-12">
            <div class="card">
                <div class="card-header">
                <h4>All brands</h4>
                </div>
                <div class="card-body">
                <div class="clearfix mb-3"></div>

                <div class="table-responsive">
                      <table class="table table-striped" id="table-1">
                        <thead>                                 
                          <tr>
                            <th></th>
                            <th>Name</th>
                            <th>Products</th>
                            <th>Actions</th>
                          </tr>
                        </thead>
                        <tbody>   
                            @empty($brands)

                            @else
                                @foreach($brands as $brand_item)
                                
                                <tr>
                                    <td class="pricing-item">
                                        @if($brand_item->status == true)
                                        <div class="pricing-details">
                                            <div class="pricing-item">
                                                <div class="pricing-item-icon bg-success text-white px-1" style="border-radius: 50%; height: 20px; width: 20px;">
                                                    <i class="fas fa-check"></i>
                                                </div>
                                            </div>
                                        </div>
                                        @else
                                        <div class="pricing-details">
                                            <div class="pricing-item">
                                                <div class="pricing-item-icon bg-warning text-white px-1" style="border-radius: 50%; height: 20px; width: 20px;">
                                                    <i class="fas fa-times"></i>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                    </td>

                                    <td class="pricing-item">
                                        {{ $brand_item->name }}
                                    </td>

                                    <td class="pricing-item">
                                        {{ $brand_item->product_count }}
                                    </td>
                        
                                    <td>
                                    <div class="buttons">
                                        @can('suspend-brand')
                                            @if($brand_item->status == true)
                                            <a href="{{ route('product.toggle', ['type' => 'toggle_brand', 'id' => $brand_item->id, 'action' => 'suspend']) }}" class="btn btn-icon btn-warning" data-toggle="tooltip" data-placement="top" title="" data-original-title="Deactivate brand">
                                                <i class="fas fa-times"></i>
                                            </a>
                                            @else
                                            <a href="{{ route('product.toggle', ['type' => 'toggle_brand', 'id' => $brand_item->id, 'action' => 'activate']) }}" class="btn btn-icon btn-success" data-toggle="tooltip" data-placement="top" title="" data-original-title="Activate brand">
                                                <i class="fas fa-check"></i>
                                            </a>
                                            @endif

                                        @endcan

                                        @can('modify-brand')
                                        <a href="{{ route('product.edit', ['type' => 'edit_brand', 'id' => $brand_item->id]) }}" class="btn btn-icon btn-primary" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit brand">
                                            <i class="far fa-edit"></i>
                                        </a>
                                        @endcan

                                        @can('delete-brand')
                                        <a href="{{ route('product.delete', ['type' => 'delete_brand', 'id' => $brand_item->id]) }}" class="btn btn-icon btn-danger" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete brand">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                        @endrole
                                        


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
                <div class="float-right">
                @empty($brands)

                @else
                    {{ $brands->links() }}
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
                <h5 class="modal-title" id="myModalLabel">Add brand</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <hr>

            <div class="modal-body">
                <form id="brandForm" method="post" action="{{ route('product.brands') }}">
                    @csrf
                    <div class="card-body">
                        <div class="form-row">
                            <div class="form-group col-12">
                                <label for="inputEmail4">Brand Name</label>
                                <input id="brandName" name="name" type="text" class="form-control" autocomplete="off" required>
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

@empty($brand)

@else
<script>
    $(function() {
        $("#myModalLabel").html('Edit brand')
        const form = $("#brandForm")
        $("#brandName").val("{{ $brand->name }}")

        var newAction = "{{ route('product.edit', ['type' => 'edit_brand', 'id' => $brand->id]) }}" 
        console.log(newAction); // Verify the newAction value in the console
        form.attr('action', newAction);
        
        $(".close").click(function(e) {
            e.preventDefault()
            window.location.href = "{{ route('product.brands') }}"
        });

        $("#myModal").modal('show')
    })
</script>
@endempty

@endsection