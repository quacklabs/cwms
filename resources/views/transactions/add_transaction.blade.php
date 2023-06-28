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
        <h1>{{$title }}</h1>

        {{ Breadcrumbs::render('transactions.add_'.$flag) }}
        </div>
        <div class="section-body">
        <h2 class="section-title">Create {{ ucwords($flag) }}</h2>
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
                        <form id="orderForm" action="{{ route('transaction.create', ['flag' => $flag]) }}" method="POST">
                            @csrf
                            <div class="form-row">
                                <input type="hidden" name="order" id="order" value="{{ old('order') }}">
                                <input type="hidden" name="discount_amount" id="discount" value="{{ old('discount_amount') }}">
                                <input type="hidden" name="total_price" id="order_amount" value="{{ old('total_price') }}">
                                <div class="form-group col-md-3">
                                    <label for="inputEmail4">Invoice No</label>
                                    <input name="invoice_no" type="text" class="form-control" value="{{ old('invoice_no') ?? $invoice_no }}" readonly required>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="inputPassword4">{{ ($flag == 'purchase' ? 'Supplier' : 'Customer') }}</label>
                                    <div class="form-control p-0">
                                        <select data-name="{{ ($flag == 'purchase' ? 'Supplier' : 'Customer') }}" id="partner_select" name="partner_id" class="p-0 mb-0 selector" required>
                                            <option value=""></option>
                                            @empty($partners)
                                            
                                            @else
                                                @foreach ($partners as $partner)
                                                    <option value="{{ $partner->id }}">{{ $partner->name }}</option>
                                                @endforeach
                                            @endempty
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
                                        <select data-name="Warehouse" id="warehouse_select" name="warehouse_id" class="p-0 mb-0 selector" required>
                                            <option value=""></option>
                                            @empty($warehouses)
                                            
                                            @else
                                                @foreach ($warehouses as $warehouse)
                                                    <option value="{{ $warehouse->id }}">{{ $warehouse->name }}</option>
                                                @endforeach
                                            @endempty
                                        </select>

                                    </div>
                                    
                                </div>
                            </div> 
                        </form>

                        <div class="form-row mb-4">
                            <select class="col-12" id="product_select" placeholder="Product Name or SKU">

                            </select>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-striped">
                                @if ($flag == 'purchase')
                                <thead>
                                    <th></th>
                                    <th>Name</th>
                                    <th class="text-right">Price</th>
                                    <th class="text-right">Quantity</th>
                                    <th class="text-right">Amount</th>
                                </thead>
                                    
                                @else
                                <thead>
                                    <th></th>
                                    <th>Name</th>
                                    <th>In Stock</th>
                                    <th class="text-right">Price</th>
                                    <th class="text-right">Quantity</th>
                                    <th class="text-right">Amount</th>
                                </thead>
                                @endif
                                
                                <tbody id="items">
                                    <!-- this is where we display rows for each product added -->
                                </tbody>

                                <tfoot id="grand_total" style="display: none;">
                                    <tr>
                                        <th colspan="{{ ($flag == 'purchase') ? 4 : 5 }}" class="text-right font-weight-bold">Discount Amount</td>
                                        <th  class="text-right font-weight-bold">
                                            <input id="discount_amount" class="value-input form-control text-right" type="text" value="0">
                                        </th>
                                    </tr>
                                    <tr>
                                        <th colspan="{{ ($flag == 'purchase') ? 4 : 5 }}" class="text-right font-weight-bold">Total</td>
                                        <th id="total_amount" class="text-right font-weight-bold">&#8358;0.00</th>
                                    </tr>
                                </tfoot>
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

<style>
.custom-file-label::after {
  content: "Browse";
}

.custom-file-input {
  display: none;
}
</style>

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
            const total = $(element).find('input').filter(function() {
                return $(this).data('name') === 'total';
            }).first()
            grand = parseFloat(grand) + parseFloat(total.val())
        })
        const discount = $("#discount_amount").val()
        grand = parseFloat(grand) - parseFloat(discount)
        $("#total_amount").html('&#8358;'+grand)
        return grand
    }

    function createOrder(grand_total) {
        const item_rows = $("#items")
        const rows = item_rows.find('tr')
        var order = []
        var validity = true;
        rows.each(function(index, element) {
            const total = $(element).find('input').filter(function() {
                return $(this).data('name') === 'total';
            }).first()

            const quantity = $(element).find('input').filter(function() {
                return $(this).data('name') === 'quantity';
            }).first()

            const price = $(element).find('input').filter(function() {
                return $(this).data('name') === 'price';
            }).first()

            const serials = $(element).find('input').filter(function() {
                return $(this).data('name') === 'serials';
            }).first()

            

            if(quantity.val() === 0 || isNaN(quantity.val())) {
                validity = false
                swal({
                    title: 'Empty Order',
                    text: 'Please ensure all products have at least one item',
                    icon: 'error'
                })
                return
            } else if (price.val() === 0 || isNaN(price.val())) {
                validity = false
                swal({
                    title: 'Empty Price',
                    text: 'Please ensure all products have a price set',
                    icon: 'error'
                })
                return
            } else {
                const total_amount = price.val() * quantity.val()
                const current = {
                    id: $(element).data('id'),
                    quantity: quantity.val(),
                    price: price.val(),
                    total_price: total_amount
                }

                if(serials != undefined) {
                    if(serials.val() != '' && serials.val() != undefined && serials.val() != null) {
                        current.serials = serials.val()
                    }
                }
                order.push(current)
            }
        })
        if(validity == true && order.length > 0) {
            const arg = JSON.stringify(order)
            const discount = $("#discount_amount").val()
            $("#order").val(arg)
            $("#discount").val(discount)
            $("#order_amount").val(grand_total)
            $("#orderForm").submit()
        } else {
            swal({
                title: 'Empty Order',
                text: 'Please select some items to purchase',
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

        const product_options = {
            valueField: 'id', // Specify the key for option value
            labelField: 'name', // Specify the key for option innerHTML
            searchField: 'name', // Specify the key for search field
            create: false,
            closeAfterSelect: true,
            render: {
                option: function(item, escape) {
                    // return null
                    return '<div class="option" data-stock="'+escape(item.stock)+'" data-selectable="" data-name="'+item.name+'" data-value="' + escape(item.id) + '">'+ escape(item.name) +'</div>'
                }
            },
            load: function(query, callback) {
                if (!query.length) return callback();
                search("{{ route('api.findProduct') }}", query, callback)
            },
            onChange: function(value) {
                if(value == '') { return }
                var selectedOption = this.getOption(value);
                var name = selectedOption.data('name');
                var id = selectedOption.data('value');
                var stock = selectedOption.data('stock');
                console.log(selectedOption)
                insertItem(name, id, stock)
                this.clearOptions()
            }
        }

        $("#partner_select").selectize(partner_options)
        $("#warehouse_select").selectize(warehouse_options)
        $("#product_select").selectize(product_options)
        
        
    })

    function insertItem(name, id, stock = undefined) {
        const item_rows = $("#items")
        const rows = item_rows.find('tr')
        var exists = false;
        rows.each(function(index, element) {
            // console.log()
            const this_id = $(element).data('id')
            const existing = id
            // console.log("row: "+this_id)
            if(this_id === existing) {
                exists = true
                console.log(exists)
                return;
            }
            
        })
        if(exists == false) {
            @if($flag == 'sale')
                if(stock != undefined) {
                    if(stock === 0) {
                        swal({
                            title: 'Out Of stock',
                            text: 'Item is out of stock',
                            icon: 'error'
                        })
                        return;
                    }
                }
                var newRow = '<tr id="row'+id+'" data-id="'+id+'">' +
                '<td><button data-row="'+id+'" class="delete-btn btn btn-icon btn-danger"><i class="fas fa-trash"></i></button></td>' +
                '<td>'+name+'</td>' +
                '<td id="stock">'+stock+'</td>'+
                '<td><input class="value-input form-control text-right" data-row="'+id+'" data-name="price" type="text" value="0"></td>' +
                '<td><input class="value-input form-control text-right" data-row="'+id+'" data-name="quantity" type="number" value="1"></td>' +
                '<td><input class="form-control text-right" data-name="total" type="text" value="0" readonly></td>' +
                '</tr>';
            @else
                var newRow = '<tr id="row'+id+'" data-id="'+id+'">' +
                '<td>'+
                    '<div class="buttons">'+
                    '<input data-row="'+id+'" data-name="file" class="file-input" type="file" style="display: none;" accept=".csv, .xls, .xlsx">'+
                    '<input data-row="'+id+'" data-name="serials" type="text" style="display: none;" value="">'+
                    '<button type="button" data-row="'+id+'" class="delete-btn btn btn-icon btn-danger"><i class="fas fa-trash"></i> Remove</button>'+
                    '<button type="button" data-row="'+id+'" class="upload-btn btn btn-icon btn-dark"><i class="fas fa-upload"> Upload Serial Numbers</i></button>'+
                    '</div>'+
                '</td>' +
                '<td>'+name+'</td>' +
                '<td><input class="value-input form-control text-right" data-row="'+id+'" data-name="price" type="text" value="0"></td>' +
                '<td><input class="value-input form-control text-right" data-row="'+id+'" data-name="quantity" type="number" value="1"></td>' +
                '<td><input class="form-control text-right" data-name="total" type="text" value="0" readonly></td>' +
                '</tr>';
            @endif
            item_rows.append(newRow);
            $("#grand_total").show();
        } else {
            return
        }
        
    }

    function search(url, query, callback) {
        $.ajax({
            url: url,
            type: 'POST',
            dataType: 'JSON',
            contentType: 'application/json',
            headers: {
                'Authorization': "Bearer {{ $api_token }}",
                'X-XSRF-TOKEN': "{{ $x_token }}"
            },
            data: JSON.stringify({ query: query }),
            error: function() {
                console.log('failed');
                callback();
            },
            success: function(res) {
                callback(res.data);
            }
        });
    }

    $(document).on('click', '.delete-btn', function(e) {
        // Event handler code
        const row_id = $(this).data('row')
        e.preventDefault()
        const row = $("#row"+row_id)
        const total = row.find('input').filter(function() {
            return $(this).data('name') === 'total';
        }).first();
        const sub = parseFloat(total.val())
        const grand_total = $("#total_amount")
        const totalAmount = grand_total.val() - parseFloat(total.val())
        row.remove();
        updateGrandTotal()
        // console.log(row)
    });

    $(document).on('input', '.value-input', function() {
        // Event handler code
        // var value = $(this).val();
        const row_id = $(this).data('row')
        const row = $("#row"+row_id)

        const amount = row.find('input').filter(function() {
            return $(this).data('name') === 'price';
        }).first();

        const quantity = row.find('input').filter(function() {
            return $(this).data('name') === 'quantity';
        }).first();

        const total = row.find('input').filter(function() {
            return $(this).data('name') === 'total';
        }).first();

        const totalAmount = amount.val() * quantity.val()
        total.val(totalAmount)
        updateGrandTotal()
    });

    $(document).on('click', '.upload-btn', function(e) {
        const row_id = $(this).data('row')
        const row = $("#row"+row_id)
        const total = row.find('input').filter(function() {
            return $(this).data('name') === 'file';
        }).first();
        total.click(); // Trigger the file input click event
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