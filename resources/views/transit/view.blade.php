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
                                            <td>{{ $stock->stock }}</td>
                                             
                                            <td>{{ $stock->product->unit->name }}</td>
                                            <td>
                                                @hasrole('admin')
                                                <a href="{{ route('transit.transfer', ['product' => $stock->product->id]) }}" class="btn btn-primary">Transfer</a>
                                                @endhasrole

                                                @hasrole('manager')
                                                <a id="receive_stock" data-transaction="{{ json_encode($stock) }}" href="#" class="btn btn-primary">Receive</a>
                                                @endhasrole
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
    

<div class="modal fade" id="updateStatus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content card">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Receive Goods In Transit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <hr>
            

            <div class="modal-body">
                <form id="statusForm" method="POST" action="{{ route('transit.receive', ['flag' => 'warehouse', 'id' => $user->warehouse()->id ?? 0]) }}">
                    @csrf
                    <input type="hidden" name="order_details" id="received_q" value="">
                    <div class="form-group row align-items-center">
                        <!-- <label for="site-title" class="form-control-label text-md-right">Quantity Received</label> -->
                        
                        <div class="col-12">
                            <div class="row">
                                <div class="col-4">
                                    <label>Product Name</label>
                                    <p id="product_name"></p>
                                    
                                </div>
                                <div class="col-4">
                                    <label>Qty Sent</label>
                                    <input type="text" id="sent" name="sent" class="form-control" readonly>
                                </div>

                                <div class="col-4">
                                    <label>Qty Received</label>
                                    <input type="text" id="received" name="received" class="form-control" value="" required>
                                </div>
                                
                            </div>
                        </div>

                        <hr>
                        <!-- <div class="col-12">
                            
                            
                        </div> -->
                    </div>
                    <hr>
                    
                    <div class="form-group row align-items-center">
                        <div class="col-sm-6 col-md-9">
                            <button id="update_button" type="button" class="btn btn-large btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection


@section('js')


<script>
    // $(function() {

    //     $("").on('click', function(e) {
    //         e.preventDefault();
    //         $(this).prop('disabled', true)
    //         const data = $(this).data('obj')
    //         console.log(data)

    //         const transaction = JSON.parse(data)
    //         console.log(transaction)
    //         $(this).prop('disabled', false)
    //     })

    //     // $("#updateStatus").modal('show');
    // })

    $(document).on('click', '#receive_stock', function(e) {
        const data = $(this).data('transaction')
        e.preventDefault()
        $("#sent").val(data.stock)
        $("#product_name").html(data.product.name)
        $("#received_q").val(data.product.id)
        $("#updateStatus").modal('show');
        $("#received").focus('fast');
        
    });

    $(document).on('click', '#update_button', function(e) {
        e.preventDefault()
        const received = $("#received").val()
        if(isNaN(received)) {
            swal({
                title: 'Invalid Quantity',
                text: 'Please ensure all quantities do not exceed the product stock and are valid numbers',
                icon: 'error'
            })
        } else {
            $("#statusForm").submit()
        }
    })
</script>
    
@endsection