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
            <h2 class="section-title">New Transfer From Store</h2>
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
                                        <form id="storeOrderForm" action="{{ route('transfer.makeTransfer', ['flag' => 'store', 'destination' => 'store']) }}" method="POST">
                                            @csrf
                                            <input id="store_note" type="hidden" name="notes">
                                            <input type="hidden" name="items" id="store_order">
                                            <div class="form-row">
                                                <div class="form-group col-md-4">
                                                    <label for="inputEmail4">Date</label>
                                                    <input id="store_transfer_date" name="transfer_date" type="text" class="form-control" value="{{ old('date') ?? date('d-m-Y') }}" required>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="inputPassword4">From {{ ucwords($flag) }}</label>
                                                    <div class="form-control p-0">
                                                        <select id="w2s_from" data-name="Warehouse" name="from" class="warehouse_select p-0 mb-0 selector" required>
                                                            <option value=""></option>
                                                            @empty($my_warehouse)
                                                            <option value="">No warehouse to select</option>
                                                            @else

                                                                @foreach($my_warehouse as $house)
                                                                    <option value="{{ $house->id }}">{{ $house->name }}</option>
                                                                @endforeach
                                                                
                                                            @endempty
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group col-md-4">
                                                    <label for="inputPassword4">To Store</label>
                                                    <div class="form-control p-0">
                                                        <select id="w2s_to" data-name="Warehouse" name="to" class="warehouse_select p-0 mb-0 selector" required>
                                                            <option value=""></option>
                                                            @empty($stores)
                                                            <option value="">No store to select</option>
                                                            @else
                                                                @foreach ($stores as $store)
                                                                    <option value="{{ $store->id }}">{{ $store->name }}</option>
                                                                @endforeach
                                                            @endempty
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                        <div class="form-row mb-4">
                                            <select class="col-12" id="w2s_product_select" placeholder="Product Name or SKU">

                                            </select>
                                        </div>

                                        <div class="table-responsive">
                                            <table class="table table-striped">
                                                <thead>
                                                    <th></th>
                                                    <th>Name</th>
                                                    <th>In Stock</th>
                                                    <th class="text-right">Quantity</th>
                                                </thead>
                                                
                                                <tbody id="w2s_items">
                                                    <!-- this is where we display rows for each product added -->
                                                </tbody>

                                                
                                            </table>
                                        </div>

                                        <div id="w2s_grand_total" class="form-row mb-4" style="display: none;">
                                            <div class="col-md-12">
                                                <label>Notes</label>
                                                <textarea class="form-control" name="notes" id="store_notes"></textarea>

                                            </div>

                                            
                                        </div>

                                        <hr>

                                        <div class="float-right">
                                            <button id="store_submit" class="btn btn-primary btn-round">Submit</button>
                                        </div>
                                    </div>
                                        
                                    <div class="tab-pane fade" id="profile4" role="tabpanel" aria-labelledby="home-tab4">
                                        <form id="warehouseOrderForm" action="{{ route('transfer.makeTransfer', ['flag' => 'store', 'destination' => 'warehouse']) }}" method="POST">
                                            @csrf
                                            <input id="warehouse_note" type="hidden" name="notes">
                                            <input type="hidden" name="items" id="warehouse_order">
                                            <div class="form-row">
                                                <div class="form-group col-md-4">
                                                    <label for="inputEmail4">Date</label>
                                                    <input id="warehouse_transfer_date" name="transfer_date" type="text" class="form-control" value="{{ old('date') ?? date('d-m-Y') }}" required>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="inputPassword4">From {{ ucwords($flag) }}</label>
                                                    <div class="form-control p-0">
                                                        <select id="w2w_from" data-name="Warehouse" name="from" class="warehouse_select p-0 mb-0 selector" required>
                                                            <option value=""></option>
                                                            @empty($my_warehouse)
                                                            <option value="">No warehouse to select</option>
                                                            @else

                                                                @foreach($my_warehouse as $house)
                                                                    <option value="{{ $house->id }}">{{ $house->name }}</option>
                                                                @endforeach
                                                                
                                                            @endempty
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group col-md-4">
                                                    <label for="inputPassword4">To Warehouse</label>
                                                    <div class="form-control p-0">
                                                        <select id="w2w_to" data-name="Warehouse" name="to" class="warehouse_select p-0 mb-0 selector" required>
                                                            <option value=""></option>
                                                            @empty($warehouses)
                                                            <option value="">No warehouse to select</option>
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
                                            <select class="col-12" id="w2w_product_select" placeholder="Product Name or SKU">

                                            </select>
                                        </div>

                                        <div class="table-responsive">
                                            <table class="table table-striped">
                                                <thead>
                                                    <th></th>
                                                    <th>Name</th>
                                                    <th>In Stock</th>
                                                    <th class="text-right">Price</th>
                                                    <th class="text-right">Quantity</th>
                                                    <th class="text-right">Amount</th>
                                                </thead>
                                                
                                                <tbody id="w2w_items">
                                                    <!-- this is where we display rows for each product added -->
                                                </tbody>

                                                
                                            </table>
                                        </div>

                                        <div id="w2w_grand_total" class="form-row mb-4" style="display: none;">
                                            <div class="col-12">
                                                <label>Notes</label>
                                                <textarea class="form-control" name="notes" id="warehouse_notes"></textarea>
                                            </div>

                                           
                                        </div>

                                        <hr>

                                        <div class="float-right">
                                            <button id="warehouse_submit" class="btn btn-primary btn-round">Submit</button>
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
    $(function()  {

        $("#store_submit").click(function(e) {
            e.preventDefault()
            
            const item_rows = $("#w2s_items");
            const rows = item_rows.find('tr')
            var order = []
            var validity = true;

            rows.each(function(index, element) {
            
                const quantity = $(element).find('input').filter(function() {
                    return $(this).data('name') === 'quantity';
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
                } else {
                    const current = {
                        product_id: $(element).data('id'),
                        quantity: quantity.val(),
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
                $("#store_order").val(arg)
                const notes = $("#store_notes").val()
                $("#store_note").val(notes)
                $("#storeOrderForm").submit()
            } else {
                swal({
                    title: 'Empty Order',
                    text: 'Please select some items to purchase',
                    icon: 'error'
                })
            }
        });

        $("#warehouse_submit").click(function(e) {
            e.preventDefault()

            const item_rows = $("#w2w_items");
            const rows = item_rows.find('tr')
            var order = []
            var validity = true;

            rows.each(function(index, element) {
            
                const quantity = $(element).find('input').filter(function() {
                    return $(this).data('name') === 'quantity';
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
                } else {
                    const current = {
                        product_id: $(element).data('id'),
                        quantity: quantity.val(),
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
                $("#warehouse_order").val(arg)
                const notes = $("#warehouse_notes").val()
                $("#warehouse_note").val(notes)
                $("#warehouseOrderForm").submit()
            } else {
                swal({
                    title: 'Empty Order',
                    text: 'Please select some items to purchase',
                    icon: 'error'
                })
            }
        })
    // store to store
    const store_from_options = {
        valueField: 'id', // Specify the key for option value
        labelField: 'name', // Specify the key for option innerHTML
        searchField: 'name', // Specify the key for search field
        closeAfterSelect: true,
        autocomplete: false,
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
    $('#w2s_from').selectize(store_from_options)

    const store_to_options = {
        valueField: 'id', // Specify the key for option value
        labelField: 'name', // Specify the key for option innerHTML
        searchField: 'name', // Specify the key for search field
        closeAfterSelect: true,
        autocomplete: false,
        create: false,
        render: {
            option: function(item, escape) {
                return '<div class="option" data-selectable="" data-value="' + escape(item.id) + '">'+ escape(item.name) +'</div>'
            }
        },
        load: function(query, callback) {
            if (!query.length) return callback();
            search("{{ route('api.findStore') }}", query, function(result) {
                console.log(result)
                const transformedData = Object.values(res.data).map(item => ({
                    id: item.id,
                    name: item.name,
                    address: item.address
                }));
            })
        }
    }
    $('#w2s_to').selectize(store_to_options)

    const w2s_product_options = {
        create: false,
        autocomplete: false,
        valueField: 'id', // Specify the key for option value
        labelField: 'name', // Specify the key for option innerHTML
        searchField: 'name', // Specify the key for search field
        closeAfterSelect: true,
        onInitialize: function () {
            this.$control_input.attr('autocomplete', 'off');
            this.$control_input.attr('name', 'product');
            this.$control_input.attr('autofill', 'disabled');
        },
        render: {
            option: function(item, escape) {
                return '<div class="option" data-unit="'+escape(item.unit)+'" data-stock="'+escape(item.stock)+'" data-selectable="" data-name="'+item.name+'" data-value="' + escape(item.id) + '">'+ escape(item.name) +'</div>'
            }
        },
        load: function(query, callback) {
            if (!query.length || query.length < 3) return callback();
            const warehouse = $("#w2s_from")
            if(warehouse.val() == '' || warehouse.val() == undefined) {
                swal({
                    title: "Source Warehouse Required",
                    text: "Please select a warehouse to transfer from",
                    icon: 'error'
                })
                return false;
            }
            const url = "{{ route('api.findProductInWarehouse') }}"
            const params = { 
                query: query, 
                warehouse_id: warehouse.val() 
            }
            $("input").attr("autocomplete", "off")
            search(url, params, function(result) {
                const transformedData = Object.values(result).map(item => ({
                    id: item.id,
                    name: item.name,
                    stock: item.stock,
                    unit: item.unit
                }));
                console.log(transformedData)
                callback(transformedData)
            })
        },
        onChange: function(value) {
            if(value == '') { return }
            var selectedOption = this.getOption(value);

            const params = {
                id: selectedOption.data('value'),
                name: selectedOption.data('name'),
                stock: selectedOption.data('stock'),
                unit: selectedOption.data('unit')
            }
            console.log(selectedOption)
            var route = "w2s"
            insertItem(route, params)
            this.clearOptions()
        }
    }
    $("#w2s_product_select").selectize(w2s_product_options)

    $("#w2w_from").selectize(store_from_options)

    const warehouse_to_options = {
        valueField: 'id', // Specify the key for option value
        labelField: 'name', // Specify the key for option innerHTML
        searchField: 'name', // Specify the key for search field
        closeAfterSelect: true,
        autocomplete: false,
        create: false,
        render: {
            option: function(item, escape) {
                return '<div class="option" data-selectable="" data-value="' + escape(item.id) + '">'+ escape(item.name) +'</div>'
            }
        },
        load: function(query, callback) {
            if (!query.length) return callback();
            search("{{ route('api.findWarehouse') }}", query, function(result) {
                // console.log(result)
                // const transformedData = Object.values(res.data).map(item => ({
                //     id: item.id,
                //     name: item.name,
                //     address: item.address
                // }));
                callback(result)
            })
        }
    }

    $("#w2w_to").selectize(warehouse_to_options)

    const w2w_product_options = {
        create: false,
        autocomplete: false,
        valueField: 'id', // Specify the key for option value
        labelField: 'name', // Specify the key for option innerHTML
        searchField: 'name', // Specify the key for search field
        closeAfterSelect: true,
        onInitialize: function () {
            this.$control_input.attr('autocomplete', 'off');
            this.$control_input.attr('name', 'product');
            this.$control_input.attr('autofill', 'disabled');
        },
        render: {
            option: function(item, escape) {
                return '<div class="option" data-unit="'+escape(item.unit)+'" data-stock="'+escape(item.stock)+'" data-selectable="" data-name="'+item.name+'" data-value="' + escape(item.id) + '">'+ escape(item.name) +'</div>'
            }
        },
        load: function(query, callback) {
            if (!query.length || query.length < 3) return callback();
            const warehouse = $("#w2w_from")
            if(warehouse.val() == '' || warehouse.val() == undefined) {
                swal({
                    title: "Source Warehouse Required",
                    text: "Please select a warehouse to transfer from",
                    icon: 'error'
                })
                return false;
            }
            const url = "{{ route('api.findProductInWarehouse') }}"
            const params = { 
                query: query, 
                warehouse_id: warehouse.val() 
            }
            $("input").attr("autocomplete", "off")
            search(url, params, function(result) {
                const transformedData = Object.values(result).map(item => ({
                    id: item.id,
                    name: item.name,
                    stock: item.stock,
                    unit: item.unit
                }));
                console.log(transformedData)
                callback(transformedData)
            })
        },
        onChange: function(value) {
            if(value == '') { return }
            var selectedOption = this.getOption(value);

            const params = {
                id: selectedOption.data('value'),
                name: selectedOption.data('name'),
                stock: selectedOption.data('stock'),
                unit: selectedOption.data('unit')
            }
            var route = "w2w"
            insertItem(route, params)
            this.clearOptions()
        }
    }
    $("#w2w_product_select").selectize(w2w_product_options)



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
            data: JSON.stringify(query),
            error: function() {
                console.log('failed');
                callback();
            },
            success: function(res) {
                console.log(res.data)
                callback(res.data);
            }
        });
    }

    function insertItem(route, params) {
        const item_rows = $("#"+route+"_items");
        const rows = item_rows.find('tr')
        var exists = false;
        rows.each(function(index, element) {
            // console.log()
            const this_id = $(element).data('id')
            const existing = id
            // console.log("row: "+this_id)
            if(this_id == existing) {
                exists = true
                console.log(exists)
                return;
            }
            
        })
        if(exists == false) {
            if(params.stock != undefined) {
                    if(params.stock === 0) {
                        swal({
                            title: 'Out Of stock',
                            text: 'Item is out of stock',
                            icon: 'error'
                        })
                        return;
                    }
            }
            var newRow = '<tr id="row'+params.id+'" data-id="'+params.id+'">' +
                '<td>'+
                    '<div class="buttons" style="display: inline">'+
                    '<input data-row="'+params.id+'" data-name="file" class="file-input" type="file" style="display: none;" accept=".csv, .xls, .xlsx">'+
                    '<input data-row="'+params.id+'" data-name="serials" type="text" style="display: none;" value="">'+
                    '<button type="button" data-row="'+params.id+'" class="delete-btn btn btn-icon btn-danger" data-toggle="tooltip" data-placement="top" title="Remove" data-original-title="Remove"><i class="fas fa-trash"></i></button>'+
                    '<button type="button" data-row="'+params.id+'" class="delete-btn btn btn-icon btn-dark" data-toggle="tooltip" data-placement="top" title="Upload Serials" data-original-title="Upload Serials"><i class="fas fa-upload"></i></button>'+
                    '</div>'+
                '</td>' +
                '<td>'+params.name+'</td>' +
                '<td>' +params.stock+' '+params.unit+'</td>' +
                '<td><input class="value-input form-control text-right" data-row="'+params.id+'" data-name="quantity" type="number" value="1"></td>' +
                '</tr>';

            item_rows.append(newRow);
            $("#"+route+"_grand_total").show();
        } else {
            return
        }
        
    }

})

</script>
@endsection