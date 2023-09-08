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
        <h2 class="section-title">Create Purchase</h2>
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
                                <input type="hidden" name="order" id="order" value="{{ old('order') }}">
                                <input type="hidden" name="discount_amount" id="discount" value="{{ old('discount_amount') }}">
                                <input type="hidden" name="total_price" id="order_amount" value="{{ old('total_price') }}">
                                <input type="hidden" name="notes" id="notes">
                                <div class="form-group col-md-3">
                                    <label for="inputEmail4">Invoice No</label>
                                    <input name="invoice_no" type="text" class="form-control" value="{{ old('invoice_no') ?? $invoice_no }}" required>
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
                                    <label for="inputPassword4">Order Status</label>
                                    <div class="form-control p-0">
                                        <select name="order_status" class="p-0 mb-0 form-control" required>
                                            <option value="ordered">Ordered</option>
                                            <option value="pending">Pending</option>
                                            <option value="pending">Received</option>
                                        </select>

                                    </div>
                                    
                                </div>
                            </div> 
                        </form>

                        <div class="form-row mb-4">
                            <label for="inputPassword4">Search Product</label>
                            <select class="col-12" id="product_select" placeholder="Product Name or SKU">

                            </select>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <th></th>
                                    <th>Name</th>
                                    <th class="text-right">Price</th>
                                    <th class="text-right">Quantity</th>
                                    <th class="text-right">Amount</th>
                                </thead>
                                
                                <tbody id="items">
                                    <!-- this is where we display rows for each product added -->
                                </tbody>

                            </table>
                        </div>
                    </div>

                    <div class="card-footer">
                        <hr>
                        <div class="row" id="grand_total" style="display: none;">
                            <div class="col-md-8">
                                <label>Notes</label>
                                <textarea class="form-control" name="notes" id="user_notes"></textarea>

                            </div>
                            <div class="col-md-4">
                                <div class="form-row mb-3">
                                    <label>Discount Amount  (&#8358;)</label>
                                    <input id="discount_amount" class="value-input form-control text-right col-12" type="text" value="0">
                                </div>

                                <div class="form-row">
                                    <label>Receivable Amount (&#8358;)</label>
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
        $("#total_amount").val(grand)
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
            const amount = parseFloat(grand_total) + parseFloat(discount)
            $("#order_amount").val(amount)
            const notes = $("#user_notes").val()
            $("#notes").val(notes)
            $("#orderForm").submit()
        } else {
            swal({
                title: 'Empty Order',
                text: 'Please select some items to purchase',
                icon: 'error'
            })
        }
    }

    $(function() {

        $("#submit_transaction").click(function(e) {
            const partner_id = $("#partner_select").val()

            if (partner_id == null || partner_id == '' || partner_id == undefined) {
                swal({
                    title: "Supplier Required",
                    text: "Please select a supplier to continue",
                    icon: 'error'
                }) 
                return
            } else {
                validateOrder()
            }
        });

        const partner_options = {
            autocomplete: false,
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
            create: true,
            autocomplete: false,
            valueField: 'id', // Specify the key for option value
            labelField: 'name', // Specify the key for option innerHTML
            searchField: 'name', // Specify the key for search field
            create: false,
            closeAfterSelect: true,
            onInitialize: function () {
                this.$control_input.attr('autocomplete', 'off');
                this.$control_input.attr('name', 'product');
                this.$control_input.attr('autofill', 'disabled');
            },
            render: {
                option: function(item, escape) {
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
                insertItem(name, id, stock)
                this.clearOptions()
            }
        }


        $("#partner_select").selectize(partner_options)
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
            var newRow = '<tr id="row'+id+'" data-id="'+id+'">' +
            '<td>'+
                '<div class="buttons">'+
                '<input data-row="'+id+'" data-name="file" class="file-input" type="file" style="display: none;" accept=".csv, .xls, .xlsx">'+
                '<input data-row="'+id+'" data-name="serials" type="text" style="display: none;" value="">'+
                '<button type="button" data-row="'+id+'" class="delete-btn btn btn-icon btn-danger" data-toggle="tooltip" data-placement="top" title="Remove" data-original-title="Remove"><i class="fas fa-trash"></i></button>'+
                '<button type="button" data-row="'+id+'" class="upload-btn btn btn-icon btn-dark" data-toggle="tooltip" data-placement="top" title="Upload Serial Numbers" data-original-title="Upload Serial Numbers"><i class="fas fa-upload"></i></button>'+
                '</div>'+
            '</td>' +
            '<td>'+name+'</td>' +
            '<td><input class="value-input form-control text-right" data-row="'+id+'" data-name="price" type="text" value="0"></td>' +
            '<td><input class="value-input form-control text-right" data-row="'+id+'" data-name="quantity" type="number" value="1"></td>' +
            '<td><input class="form-control text-right" data-name="total" type="text" value="0" readonly></td>' +
            '</tr>';
            item_rows.append(newRow);
            $("#grand_total").show();
        } else {
            return
        }
        
    }

    function search(url, query, callback) {
        const user = "{{ auth()->user()->id }}"
        $.ajax({
            url: url,
            type: 'POST',
            dataType: 'JSON',
            contentType: 'application/json',
            headers: {
                'Authorization': "Bearer {{ $api_token }}",
                'X-XSRF-TOKEN': "{{ $x_token }}"
            },
            data: JSON.stringify({ query: query, user: user }),
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
</script>
    
@endsection