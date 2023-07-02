@extends('layout')
@section('title') {{ config('app.name') }} | {{ $title }} @endsection

@section('css')
<link rel="stylesheet" href="{{ asset('css/selector.css') }}">
<link rel="stylesheet" href="{{ asset('css/datepicker.css') }}">
    
@endsection

@section('content')

<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
        <h1>{{ $title }}</h1>

        {{ Breadcrumbs::render() }}
        </div>
        <div class="section-body">
        <h2 class="section-title">Return {{ ucwords($flag) }}</h2>
        <!-- <p class="section-lead">
            Each staff must be assigned to a transaction
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
                        <h4> </h4>
                        <div class="card-header-form ">
                            <div class="input-group float-right">
                                <button type="button" id="submit_transaction" class="btn rounded btn-primary"><i class="fas fa-plus"></i> Save</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form id="orderForm" action="{{ $action }}" method="POST">
                            @csrf
                            <div class="form-row">
                               <div class="form-group col-md-3">
                                    <label for="inputEmail4">Invoice No</label>
                                    <input type="hidden" name="order" id="order">
                                    <input type="hidden" name="discount_amount" id="discount">
                                    <input type="hidden" name="notes" id="notes">
                                    <input type="hidden" name="total_price" id="order_amount" value="{{ old('total_price') }}">

                                    <input name="invoice_no" type="text" class="form-control" value="{{  $transaction->invoice_no }}" readonly required>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="inputPassword4">{{ ($flag == 'purchase' ? 'Supplier' : 'Customer') }}</label>
                                    <div class="form-control p-0">
                                        <select data-name="{{ ($flag == 'purchase' ? 'Supplier' : 'Customer') }}" id="partner_select" name="partner_id" class="p-0 mb-0 form-control" readonly required>
                                            <option value="{{ ($flag == 'purchase') ? $transaction->supplier_id : $transaction->customer_id }}">{{ $transaction->owner->name }}</option>
                                        </select>

                                    </div>
                                    
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="inputEmail4">Date</label>
                                    <input id="date" name="date" type="text" class="form-control" value="{{ old('date') ?? date('d-m-Y') }}" required>
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="inputPassword4">Warehouse</label>
                                    <div class="form-control p-0">
                                        <select data-name="Warehouse" id="warehouse_select" name="warehouse_id" class="p-0 mb-0 selector form-control" required readonly>
                                            <option value="{{ $transaction->warehouse->id }}">{{ $transaction->warehouse->name }}</option>
                                        </select>
                                    </div>
                                    
                                </div>
                            </div> 
                        </form>

                        <hr>

                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <th></th>
                                    <th>Name</th>
                                    <th class="text-right">{{ ucwords($flag) }} Qty</th>
                                    <th class="text-right">In Stock</th>
                                    <th class="text-right">Return Qty</th>
                                    <th class="text-right">Price</th>
                                    <th class="text-right">Total</th>
                                </thead>
                                
                                <tbody id="items">
                                @foreach ($transaction->details as $detail)
                                        <tr id="row{{$detail->id}}" data-id="{{$detail->id}}">
                                            <td>
                                                <div class="btn-group mb-3" role="group">
                                                    <button class="mr-1" type="button" data-row="{{ $detail->id }}" class="delete-btn btn btn-icon btn-danger"><i class="fas fa-trash" data-toggle="tooltip" data-original-title="Remove"></i></button>
                                                    <!-- <button class="mr-1" type="button" data-row="{{ $detail->id }}" class="upload-btn btn btn-icon btn-danger" data-toggle="tooltip" data-original-title="Add Serial Numbers"><i class="fas fa-upload"></i></button> -->
                                                </div>
                                                
                                            </td>
                                            <td>{{ $detail->product->name }}</td>
                                            <td class="text-right">{{ $detail->quantity }}</td>
                                            <td class="text-right">{{ $detail->product->totalInStock() }}</td>
                                            <td>
                                                <input data-quantity="{{ $detail->quantity }}" data-price="{{ $detail->price }}" data-row="{{ $detail->id }}" class="value-input form-control text-right" type="number" value="0">
                                            </td>
                                            <td>&#8358;{{ number_format($detail->price, 2) }}</td>
                                            <td data-name="total">&#8358;0</td>
                                        </tr>
                                    @endforeach
                                    <!-- this is where we display rows for each product added -->
                                </tbody>
                                <!-- <hr> -->

                                <tfoot>
                                    <tr>
                                        
                                        <!-- <th colspan="{{ ($flag == 'purchase') ? 4 : 5 }}" class="text-right font-weight-bold">Discount Amount</td>
                                        <th  class="text-right font-weight-bold">
                                            
                                        </th> -->
                                    </tr>
                                    <!-- <tr>
                                        <th colspan="{{ ($flag == 'purchase') ? 4 : 5 }}" class="text-right font-weight-bold">Total</td>
                                        <th id="total_amount" class="text-right font-weight-bold">&#8358;0.00</th>
                                    </tr> -->
                                </tfoot>
                            </table>
                        </div>
                    </div>

                    <div class="card-footer">
                        <hr>
                        <div class="row">
                            <div class="col-md-8">
                                <label>Notes</label>
                                <textarea class="form-control" name="notes" id="user_notes"></textarea>

                            </div>
                            <div class="col-md-4">
                                <div class="form-row mb-3">
                                    <label>Discount Amount</label>
                                    <input id="discount_amount" class="value-input form-control text-right col-12" type="text" value="0">
                                </div>

                                <div class="form-row">
                                    <label>Receivable Amount</label>
                                    <input id="total_amount" class="value-input form-control text-right col-12" type="text" value="0" readonly>
                                </div>
                                

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<style>
.custom-file-label::after {
  content: "Browse";
}

.custom-file-input {
  display: none;
}
</style>


<!-- to be used later for adding serial numbers -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content card">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">{{ ($flag == 'sale') ? 'Receive Payment' : 'Give Payment'}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <hr>
            

            <div class="modal-body">
                <!-- <form id="moneyForm" method="POST" action="#"> -->
                    <div class="form-group row align-items-center">
                        <label for="site-title" class="form-control-label col-sm-3 text-md-right">Amount</label>
                        <div class="col-sm-6 col-md-9">
                        <input id="amount" name="amount" type="text" class="form-control" id="decimalInput" required>
                        </div>
                    </div>
                    <div class="form-group row align-items-center">
                        <label for="site-description" class="form-control-label col-sm-3 text-md-right">Choose file (xls, csv)</label>
                        <div class="col-sm-6 col-md-9">
                            <input id="due" name="due" type="file" class="form-control"  value="">
                        </div>
                    </div>

                    <div class="form-group row align-items-center">
                        <label for="site-description" class="form-control-label col-sm-3 text-md-right">Signature</label>
                        <div class="col-sm-6 col-md-9">
                            <input id="myCheckbox" name="status" type="checkbox" class="form-control" checked required>
                            <span class="text-muted">I affirm that I have {{ ($flag == 'sale') ? 'received' : 'given' }} the sum stated above</span>
                        </div>
                    </div>

                    <div class="form-group row align-items-center">
                        <!-- <label for="site-description" class="form-control-label col-sm-3 text-md-right">Active</label> -->
                        <div class="col-sm-6 col-md-9">
                            <button type="submit" class="btn btn-large btn-primary">Accept</button>
                        </div>
                    </div>
                <!-- </form> -->
            </div>
        </div>
    </div>
</div>

@endsection


@section('js')
<script src="{{ asset('js/selector.js') }}"></script>
<script src="{{ asset('js/datepicker.js') }}"></script>

<script>
   

    function updateGrandTotal() {
        if(isNaN($("#discount_amount").val())) {
            $("#discount_amount").val('0')
        }
        const item_rows = $("#items")
        const rows = item_rows.find('tr')
        var grand = 0
        rows.each(function(index, element) {
            const quantity = $(element).find('input').first()
            const price = quantity.data('price')
            const total = parseFloat(quantity.val() * price)
            grand = parseFloat(grand) + parseFloat(total)
        })
        const discount = $("#discount_amount").val()
        grand = parseFloat(grand) - parseFloat(discount)
        $("#total_amount").val(grand.toFixed(2).toLocaleString('en-US'))
        return grand
    }

    function createOrder(grand_total) {
        const item_rows = $("#items")
        const rows = item_rows.find('tr')
        var order = []
        var validity = true;
        const total = updateGrandTotal()
        const discount = $("#discount_amount").val()

        rows.each(function(index, element) {
            const input = $(element).find('input').first()
            const id = input.data('row')
            const price = input.data('price')
            const quantity = input.val()

            const current = {
                id: id,
                quantity: quantity,
                price: price
            }
            order.push(current)
        })

        if(validity == true && order.length > 0) {
            const arg = JSON.stringify(order)
            const discount = $("#discount_amount").val()
            $("#order").val(arg)
            $("#discount").val(discount)
            $("#order_amount").val(total)
            const notes = $("#user_notes").val()
            $("#notes").val(notes)
            $("#orderForm").submit()
        } else {
            swal({
                title: 'Empty Order',
                text: 'Please select some items to return',
                icon: 'error'
            })
        }
    }

    function validateOrder() {
        const grand_total = updateGrandTotal()
        if(grand_total === 0 || isNaN(grand_total)) {
            swal({
                title: 'Empty Order',
                text: 'Please select some items to purchase',
                icon: 'error'
            })
            return false
        }

        createOrder(grand_total)
    }

    $(function() {

        $("#submit_transaction").click(function(e) {
            const partner_id = $("#partner_select").val()
            const warehouse_id = $("#warehouse_select").val()

            if (partner_id == null || partner_id == '' || partner_id == undefined) {
                swal({
                    title: "{{ ($flag == 'sale') ? 'Customer' : 'Supplier' }} Required",
                    text: "Please select a {{ ($flag == 'sale') ? 'customer' : 'supplier' }} to continue",
                    icon: 'error'
                }) 
                return
            } else if(warehouse_id == null || warehouse_id == '' || warehouse_id == undefined)  {
                swal({
                    title: "Warehouse Required",
                    text: "Please select a warehouse to continue",
                    icon: 'error'
                })
                return
            } else {
                validateOrder()
            }
        });

        $("#discount_amount").on('input', function(e) {
            updateGrandTotal()
        })

        $('#date').datepicker({
            format: 'dd-mm-yyyy',
            autoclose: true
        });

        const warehouse_options = {
            valueField: 'id', // Specify the key for option value
            labelField: 'name', // Specify the key for option innerHTML
            searchField: 'name', // Specify the key for search field
            closeAfterSelect: true,
            create: false,
            render: {
                option: function(item, escape) {
                    return '<div class="option" data-selectable="" data-value="' + escape(item.id) + '">'+ escape(item.name) +'</div>'
                }
            },
            load: function(query, callback) {
                if (!query.length) return callback();
                search("{{ route('api.findWarehouse') }}", query, callback)
            }
        }

        const partner_options = {
            valueField: 'id', // Specify the key for option value
            labelField: 'name', // Specify the key for option innerHTML
            searchField: 'name', // Specify the key for search field
            create: false,
            closeAfterSelect: true,
            render: {
                option: function(item, escape) {
                    return '<div data-name="'+escape(item.name)+'" class="option" data-selectable="" data-value="' + escape(item.id) + '">'+ escape(item.name) +'</div>'
                }
            },
            load: function(query, callback) {
                if (!query.length) return callback();
                search("{{ route('api.findPartner', ['flag' => $flag]) }}", query, callback)
            }
        }

       

        $("#partner_select").selectize(partner_options)
        $("#warehouse_select").selectize(warehouse_options)
        
    })

    $(document).on('click', '.delete-btn', function(e) {
        // Event handler code
        const row_id = $(this).data('row')
        e.preventDefault()
        const row = $("#row"+row_id)
        row.remove();
        updateGrandTotal()
    });

    $(document).on('input', '.value-input', function() {
        // Event handler code
        // var value = $(this).val();
        const row_id = $(this).data('row')
        const price = $(this).data('price')
        const quantity = $(this).data('quantity')
        const row = $("#row"+row_id)

        const value = $(this).val()

        if(value > quantity) {
            $(this).val(quantity)
        }

        const total = row.find('td').filter(function() {
            return $(this).data('name') === 'total';
        }).first();

        const totalAmount = parseFloat($(this).val() * price)

        total.html('&#8358;'+totalAmount.toFixed(2).toLocaleString('en-US'))
        updateGrandTotal()
    });

    $("#discount_amount").on('input', function(e) {
        updateGrandTotal()
    })

    $(document).on('click', '.upload-btn', function(e) {
        const row_id = $(this).data('row')
        const row = $("#row"+row_id)
        // const total = row.find('input').filter(function() {
        //     return $(this).data('name') === 'file';
        // }).first();
        // total.click(); // Trigger the file input click event
    });

    $(document).on('input', '.file-input', function() {
        var file = this.files[0]; // Get the selected file
        const row_id = $(this).data('row')
        const row = $("#row"+row_id)
        const serials = row.find('input').filter(function() {
            return $(this).data('name') === 'serials';
        }).first();

        const quantity = row.find('input').filter(function() {
            return $(this).data('name') === 'quantity';
        }).first();

        // Create a FormData object
        var formData = new FormData();
        // formData
        formData.append('file', file);

        // Make an AJAX request to upload the file
        $.ajax({
        url: "{{ route('api.uploadSerials') }}",
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
            // Handle the success response
            console.log('File uploaded successfully.');
            const values = [];
            const data = response.data

            // Iterate over the outer object keys
            for (const key in data) {
                // Access the inner object
                const innerObject = data[key];
            
                // Iterate over the inner object values
                for (const innerValue in innerObject) {
                    // Push the inner value to the array
                    values.push(innerObject[innerValue]);
                }
            }
            serials.val(JSON.stringify(values))
            quantity.val(values.length)
            quantity.prop('readonly', true)
        },
        error: function(xhr, status, error) {
            // Handle the error response
            console.error('Error uploading file:', error);
        }
        });
    });
</script>


@endsection