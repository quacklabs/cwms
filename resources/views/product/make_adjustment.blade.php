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
        <h2 class="section-title">Make Stock Adjustment</h2>
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
                        <form id="orderForm" action="{{ route('stock.make_adjustment') }}" method="POST">
                            @csrf
                            <input id="note" type="hidden" name="notes">
                            <input type="hidden" name="items" id="order">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputPassword4">Warehouse</label>
                                    <div class="form-control p-0">
                                        <select data-name="Warehouse" id="warehouse_select" name="warehouse_id" class="p-0 mb-0 selector" required>
                                            <option value=""></option>
                                            @empty($warehouses)
                                            <option value="">No Warehouse to select</option>
                                            @else
                                                @foreach ($warehouses as $warehouse)
                                                    <option value="{{ $warehouse->id }}">{{ $warehouse->name }}</option>
                                                @endforeach
                                            @endempty
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">Date</label>
                                    <input id="date" name="adjust_date" type="text" class="form-control" value="{{ old('date') ?? date('d-m-Y') }}" required>
                                </div>
                            </div>
                        
                            
                        </form>

                        <div class="form-row mb-4">
                            <select class="col-12" id="product_select" placeholder="Product Name or SKU">

                            </select>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <th>Name</th>
                                    <th class="text-right">Current Stock</th>
                                    <th class="text-right">Stock - After Adjust</th>
                                    <th class="text-right">Adjust Quantity</th>
                                    <th class="text-right">Type</th>
                                    <th class="text-right">Action</th>
                                </thead>
                                
                                <tbody id="items">
                                    <!-- this is where we display rows for each product added -->
                                </tbody>

                                
                            </table>
                        </div>
                    </div>

                    <div class="card-footer">
                        <div class="form-row mb-4">
                            <label class="input-label">Notes</label>
                            <textarea id="collect_note" class="col-12 form-control">

                            </textarea>
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

    function createOrder(grand_total) {
        const item_rows = $("#items")
        const rows = item_rows.find('tr')
        var order = []
        var validity = true;
        rows.each(function(index, element) {
            const current_stock = $(element).find('input').filter(function() {
                return $(this).data('name') === 'current_stock';
            }).first().val();

            const adjusted_stock = $(element).find('input').filter(function() {
                return $(this).data('name') === 'stock';
            }).first().val();

            const quantity = $(element).find('input').filter(function() {
                return $(this).data('name') === 'quantity';
            }).first().val();

            const type_val = $(element).find('select').filter(function() {
                return $(this).data('id') === 'adjust_type';
            }).first().val();

            const type = parseInt(type_val)
            console.log("type: "+type)

            if(isNaN(quantity)) {
                validity = false;
                console.log('failed at quantity isNaN')
                return
            }

            if(quantity <= 0) {
                validity = false;
                swal({
                    title: 'Empty Adjustment',
                    text: 'Please delete products not being adjusted',
                    icon: 'error'
                })
                return
            }

            if(quantity > current_stock && type == 1) {
                console.log('cannot subtract more than current stock')
                validity = false;
                return
            }

            // const total_amount = price.val() * quantity.val()
            const current = {
                product_id: $(element).data('id'),
                quantity: quantity,
                adjust_type: type
            }
            order.push(current)
        })
        if(validity == true && order.length > 0) {
            const arg = JSON.stringify(order)
            $("#order").val(arg)
            const note = $("#collect_note").val()
            $("#note").val(note)
            $("#orderForm").submit()
        } else {
            swal({
                title: 'Empty Order',
                text: 'Please select some items to adjust',
                icon: 'error'
            })
        }
    }

    $(function() {

        $("#submit_transaction").click(function(e) {
            const warehouse_id = $("#warehouse_select").val()

            if(warehouse_id == null || warehouse_id == '' || warehouse_id == undefined)  {
                swal({
                    title: "Warehouse Required",
                    text: "Please select a warehouse to continue",
                    icon: 'error'
                })
                return
            } else {
                createOrder()
            }
        });

        $('#date').datepicker({
            format: 'dd-mm-yyyy',
            autoclose: true
        });

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

        @role('admin')
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
            $("#warehouse_select").selectize(warehouse_options)
        @else
        $("#warehouse_select").selectize({
            create: false, 
            closeAfterSelect: true,
        })
        @endrole
        
        $("#product_select").selectize(product_options)
        $('input').prop('autocomplete', 'off');
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
            '<td>'+name+'</td>' +
            '<td><input class="value-input form-control text-right" data-row="'+id+'" data-name="current_stock" type="text" value="'+stock+'" readonly></td>'+
            '<td><input class="value-input form-control text-right" data-row="'+id+'" data-name="stock" type="text" value="'+stock+'" readonly></td>' +
            '<td><input class="value-input form-control text-right" data-row="'+id+'" data-name="quantity" type="number" value="0"></td>' +
            '<td><select data-id="adjust_type" class="form-control" name="adjust_type"><option value="1">Subtract</option><option value="2">Add</option></select></td>' +
            '<td><button data-row="'+id+'" class="delete-btn btn btn-icon btn-danger"><i class="fas fa-trash"></i></button></td>' +
            '</tr>';
            item_rows.append(newRow);
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

    
    $(document).on('input keyup', '.value-input', function() {
        // Event handler code
        // var value = $(this).val();
        const row_id = $(this).data('row')
        const row = $("#row"+row_id)

        const current_stock = row.find('input').filter(function() {
            return $(this).data('name') === 'current_stock';
        }).first();

        const adjusted_stock = row.find('input').filter(function() {
            return $(this).data('name') === 'stock';
        }).first();

        const quantity = row.find('input').filter(function() {
            return $(this).data('name') === 'quantity';
        }).first();

        const type = row.find('select').filter(function() {
            return $(this).data('id') === 'adjust_type';
        }).first().val();

        if(quantity.val() == 0 || isNaN(quantity.val())) {
            quantity.val(0)
        }
        console.log('type: '+type)
        switch (type) {
            case '1':
                var adjustedValue = current_stock.val() - quantity.val()
                adjusted_stock.val(adjustedValue)
                console.log(adjustedValue)
                break
            case '2':
                var adjusted_value = current_stock.val() + quantity.val()
                adjusted_stock.val(adjusted_value)
                console.log(adjusted_value)
                break
            default:
                console.log('failed oh')
                break
        }
    });


    $(document).on('click', '.delete-btn', function(e) {
        // Event handler code
        const row_id = $(this).data('row')
        e.preventDefault()
        const row = $("#row"+row_id)
        row.remove();
    });


    
</script>


@endsection