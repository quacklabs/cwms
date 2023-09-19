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

            {{ Breadcrumbs::render() }}
            </div>
        <div class="section-body">
            <h2 class="section-title">New Transfer</h2>
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
                    
                    <div class="card-body">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active show" id="home-tab4" data-toggle="tab" href="#home4" role="tab" aria-controls="home" aria-selected="true">Transfer To Store</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="profile-tab4" data-toggle="tab" href="#profile4" role="tab" aria-controls="profile" aria-selected="false">Transfer To Warehouse</a>
                            </li>
                        </ul>

                        <div class="row mt-3">
                            <div class="col-12">
                                <div class="tab-content no-padding" id="myTab2Content">
                                    <div class="tab-pane fade active show" id="home4" role="tabpanel" aria-labelledby="home-tab4">
                                        <form id="storeOrderForm" action="{{ route('transit.makeTransfer', ['destination' => 'store']) }}" method="POST">
                                            @csrf
                                            <input id="store_order_note" type="hidden" name="notes">
                                            <input type="hidden" name="items" id="store_order">
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="inputEmail4">Date</label>
                                                    <input id="date" name="transfer_date" type="text" class="form-control" value="{{ old('date') ?? date('d-m-Y') }}" required>
                                                </div>
                                                

                                                <div class="form-group col-md-6">
                                                    <label for="inputPassword4">To Store</label>
                                                    <div class="form-control p-0">
                                                        <select id="to_store" data-name="Warehouse" name="to" class="store_select p-0 mb-0 selector" required>
                                                            <option value=""></option>
                                                            @empty($to_store)
                                                            <option value="">No Store to select</option>
                                                            @else
                                                                @foreach ($to_store as $store)
                                                                    <option value="{{ $store->id }}">{{ $store->name }}</option>
                                                                @endforeach
                                                            @endempty
                                                        </select>
                                                    </div>
                                                </div>

                                                
                                            </div>
                                        
                                            
                                        </form>
                                        <div class="form-row mb-4">
                                            <select class="col-12 store_product_select" id="product_select" placeholder="Product Name or SKU">

                                            </select>
                                        </div>

                                        <div class="table-responsive">
                                            <table class="table table-striped">
                                                <thead>
                                                    <th class="text-right">Name</th>
                                                    <th class="text-right">In Stock</th>
                                                    <th class="text-right">Quantity</th>
                                                    <th class="text-right">Action</th>
                                                </thead>
                                                
                                                <tbody id="store_items">
                                                    <!-- this is where we display rows for each product added -->
                                                </tbody>

                                                
                                            </table>
                                        </div>

                                        <div class="form-row mb-4">
                                            <label class="input-label">Notes</label>
                                            <textarea id="store_note" class="col-12 form-control">

                                            </textarea>
                                        </div>

                                        <div class="float-right">
                                            <button id="submit_store" class="btn btn-primary btn-round">Submit</button>
                                        </div>
                                    </div>
                                        
                                    <div class="tab-pane fade" id="profile4" role="tabpanel" aria-labelledby="home-tab4">
                                        <form id="warehouseOrderForm" action="{{ route('transit.makeTransfer', ['destination' => 'warehouse']) }}" method="POST">
                                            @csrf
                                            <input id="warehouse_order_note" type="hidden" name="notes">
                                            <input type="hidden" name="items" id="warehouse_order">
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="inputEmail4">Date</label>
                                                    <input id="date" name="transfer_date" type="text" class="form-control" value="{{ old('date') ?? date('d-m-Y') }}" required>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="inputPassword4">To Warehouse</label>
                                                    <div class="form-control p-0">
                                                        <select id="to_warehouse" data-name="Warehouse" name="to" class="warehouse_select p-0 mb-0 selector" required>
                                                            <option value=""></option>
                                                            @empty($to_warehouse)
                                                            <option value="">No Warehouse to select</option>
                                                            @else
                                                                @foreach ($to_warehouse as $warehouse)
                                                                    <option value="{{ $warehouse->id }}">{{ $warehouse->name }}</option>
                                                                @endforeach
                                                            @endempty
                                                        </select>
                                                    </div>
                                                    
                                                </div>

                                                
                                            </div>
                                        
                                            
                                        </form>
                                        <div class="form-row mb-4">
                                            <select class="col-12 warehouse_product_select" id="store_product_select" placeholder="Product Name or SKU">

                                            </select>
                                        </div>

                                        <div class="table-responsive">
                                            <table class="table table-striped">
                                                <thead>
                                                    <th class="text-right">Name</th>
                                                    <th class="text-right">In Stock</th>
                                                    <th class="text-right">Quantity</th>
                                                    <th class="text-right">Action</th>
                                                </thead>
                                                
                                                <tbody id="warehouse_items">
                                                    <!-- this is where we display rows for each product added -->
                                                </tbody>

                                                
                                            </table>
                                        </div>

                                        <div class="form-row mb-4">
                                            <label class="input-label">Notes</label>
                                            <textarea id="warehouse_note" class="col-12 form-control">

                                            </textarea>
                                        </div>

                                        <div class="float-right">
                                            <button id="submit_warehouse" class="btn btn-primary btn-round">Submit</button>
                                        </div>
                                    </div>

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

    function createStoreOrder(grand_total) {
        const item_rows = $("#store_items")
        const rows = item_rows.find('tr')
        var order = []
        var validity = true;
        rows.each(function(index, element) {
            const current_stock = $(element).find('input').filter(function() {
                return $(this).data('name') === 'current_stock';
            }).first().val();

            const quantity = $(element).find('input').filter(function() {
                return $(this).data('name') === 'quantity';
            }).first().val();

            const serials = $(element).find('input').filter(function() {
                return $(this).data('name') === 'serials';
            }).first()

            if(isNaN(quantity) || quantity <= 0) {
                validity = false;
                swal({
                    title: "Quantity Required",
                    text: "Please specify a quantity to continue",
                    icon: 'error'
                })
                return
            }

            if(parseInt(quantity) > parseInt(current_stock)) {
                validity = false;
                swal({
                    title: 'Invalid Quantity',
                    text: 'Please ensure all quantities do not exceed the product stock',
                    icon: 'error'
                })
                return
            }

            const current = {
                product_id: $(element).data('id'),
                quantity: parseInt(quantity),
            }
            if(serials != undefined) {
                if(serials.val() != '' && serials.val() != undefined && serials.val() != null) {
                    current.serials = serials.val()
                }
            }
            order.push(current)
        })
        if(validity == true && order.length > 0) {
            const arg = JSON.stringify(order)
            $("#store_order").val(arg)
            const note = $("#store_note").val()
            $("#store_order_note").val(note)
            $("#storeOrderForm").submit()
        } else {
            swal({
                title: 'Empty Transfer Order',
                text: 'Please select some items to transfer',
                icon: 'error'
            })
        }
    }

    function createWarehouseOrder(grand_total) {
        const item_rows = $("#warehouse_items")
        const rows = item_rows.find('tr')
        var order = []
        var validity = true;
        rows.each(function(index, element) {
            const current_stock = $(element).find('input').filter(function() {
                return $(this).data('name') === 'current_stock';
            }).first().val();

            const quantity = $(element).find('input').filter(function() {
                return $(this).data('name') === 'quantity';
            }).first().val();

            const serials = $(element).find('input').filter(function() {
                return $(this).data('name') === 'serials';
            }).first()

            if(isNaN(quantity) || quantity <= 0) {
                validity = false;
                swal({
                    title: "Quantity Required",
                    text: "Please specify a quantity to continue",
                    icon: 'error'
                })
                return
            }

            if(parseInt(quantity) > parseInt(current_stock)) {
                validity = false;
                swal({
                    title: 'Invalid Quantity',
                    text: 'Please ensure all quantities do not exceed the product stock',
                    icon: 'error'
                })
                return
            }

            // const total_amount = price.val() * quantity.val()
            const current = {
                product_id: $(element).data('id'),
                quantity: parseInt(quantity),
            }
            if(serials != undefined) {
                if(serials.val() != '' && serials.val() != undefined && serials.val() != null) {
                    current.serials = serials.val()
                }
            }
            order.push(current)
            console.log(current);

        })
        if(validity == true && order.length > 0) {
            const arg = JSON.stringify(order)
            $("#warehouse_order").val(arg)
            const note = $("#warehouse_note").val()
            $("#warehouse_order_note").val(note)
            $("#warehouseOrderForm").submit()
        } else {
            console.log('wahala')
            swal({
                title: 'Empty Transfer Order',
                text: 'Please select some items to transfer',
                icon: 'error'
            })
        }
    }

    $(function() {

        $("#submit_warehouse").click(function(e) {
            
            const to_warehouse_id = $("#to_warehouse").val()

            if(to_warehouse_id == '' || to_warehouse_id == null || to_warehouse_id == undefined) {
                swal({
                    title: "Warehouse Required",
                    text: "Please select a warehouse to continue",
                    icon: 'error'
                })
                return
            } else {
                createWarehouseOrder()
            }
        });

        $("#submit_store").click(function(e) {
            const to_warehouse_id = $("#to_store").val()
            if(to_warehouse_id == '' || to_warehouse_id == null || to_warehouse_id == undefined) {
                swal({
                    title: "Warehouse Required",
                    text: "Please select a store to continue",
                    icon: 'error'
                })
                return
            } else {
                createStoreOrder()
            }
        });

        $('#date').datepicker({
            format: 'dd-mm-yyyy',
            autoclose: true
        });

        const warehouse_product_options = {
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
                const url = "{{ route('api.findProductInTransit') }}"
                search(url, query, callback)
            },
            onChange: function(value) {
                if(value == '') { return }
                var selectedOption = this.getOption(value);
                var name = selectedOption.data('name');
                var id = selectedOption.data('value');
                var stock = selectedOption.data('stock');
                insertItem('warehouse', name, id, stock)
                this.clearOptions()
            }
        }

        const store_product_options = {
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
                const url = "{{ route('api.findProductInTransit') }}"
                search(url, query, callback)
            },
            onChange: function(value) {
                if(value == '') { return }
                var selectedOption = this.getOption(value);
                var name = selectedOption.data('name');
                var id = selectedOption.data('value');
                var stock = selectedOption.data('stock');
                insertItem('store', name, id, stock)
                this.clearOptions()
            }
        }

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

        const store_options = {
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
                search("{{ route('api.findStore') }}", query, callback)
            }
        
        }
        $('.store_select').selectize(store_options)
        $('.warehouse_select').selectize(warehouse_options)
        $(".warehouse_product_select").selectize(warehouse_product_options)
        $(".store_product_select").selectize(store_product_options)
        $('input').prop('autocomplete', 'off');
    })

    function insertItem(flag, name, id, stock = undefined) {
        const item_rows = flag == 'warehouse' ? $("#warehouse_items") : $("#store_items")
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
            '<td>'+name+'</td>' +
            '<td><input class="value-input form-control text-right" data-row="'+id+'" data-name="current_stock" type="text" value="'+stock+'" readonly></td>'+
            '<td>'+
            '<input data-row="'+id+'" data-name="serials" type="text" style="display: none;" value="">'+
            '<input class="value-input form-control text-right" data-row="'+id+'" data-name="quantity" type="number" value="0"></td>' +

            '<td>'+
                '<div class="buttons">'+
                '<input data-row="'+id+'" data-name="file" class="file-input" type="file" style="display: none;" accept=".csv, .xls, .xlsx">'+
                '<input data-row="'+id+'" data-name="serials" type="text" style="display: none;" value="">'+
                '<button type="button" data-row="'+id+'" class="delete-btn btn btn-icon btn-danger"><i class="fas fa-trash"></i> Remove</button>'+
                '<button type="button" data-row="'+id+'" class="upload-btn btn btn-icon btn-dark"><i class="fas fa-upload"> Upload Serial Numbers</i></button>'+
                '</div>'+
            '</td>'+
            '</tr>';
            item_rows.append(newRow);
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
                console.log(res);
                const transformedData = Object.values(res.data).map(item => ({
                    id: item.id,
                    name: item.name,
                    stock: item.stock
                }));
                callback(transformedData);
            }
        });
    }


    $(document).on('click', '.delete-btn', function(e) {
        // Event handler code
        const row_id = $(this).data('row')
        e.preventDefault()
        const row = $("#row"+row_id)
        row.remove();
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