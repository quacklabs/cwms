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
                            <input type="hidden" name="notes" type="text">
                            <div class="form-row">
                                <div class="form-group col-md-6">
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

                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">Date</label>
                                    <input id="date" name="date" type="text" class="form-control" value="{{ old('date') ?? date('d-m-Y') }}" required>
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
                        <div class="float-right">
                           
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
   

    // function updateGrandTotal() {
    //     if(isNaN($("#discount_amount").val())) {
    //         $("#discount_amount").val('0')
    //     }
    //     const item_rows = $("#items")
    //     const rows = item_rows.find('tr')
    //     var grand = 0
    //     rows.each(function(index, element) {
    //         const total = $(element).find('input').filter(function() {
    //             return $(this).data('name') === 'total';
    //         }).first()
    //         grand = parseFloat(grand) + parseFloat(total.val())
    //     })
    //     const discount = $("#discount_amount").val()
    //     grand = parseFloat(grand) - parseFloat(discount)
    //     $("#total_amount").html('&#8358;'+grand)
    //     return grand
    // }

    // function createOrder(grand_total) {
    //     const item_rows = $("#items")
    //     const rows = item_rows.find('tr')
    //     var order = []
    //     var validity = true;
    //     rows.each(function(index, element) {
    //         const total = $(element).find('input').filter(function() {
    //             return $(this).data('name') === 'total';
    //         }).first()

    //         const quantity = $(element).find('input').filter(function() {
    //             return $(this).data('name') === 'quantity';
    //         }).first()

    //         const price = $(element).find('input').filter(function() {
    //             return $(this).data('name') === 'price';
    //         }).first()

            

    //         if(quantity.val() === 0 || isNaN(quantity.val())) {
    //             validity = false
    //             swal({
    //                 title: 'Empty Order',
    //                 text: 'Please ensure all products have at least one item',
    //                 icon: 'error'
    //             })
    //             return
    //         } else if (price.val() === 0 || isNaN(price.val())) {
    //             validity = false
    //             swal({
    //                 title: 'Empty Price',
    //                 text: 'Please ensure all products have a price set',
    //                 icon: 'error'
    //             })
    //             return
    //         } else {
    //             const total_amount = price.val() * quantity.val()
    //             const current = {
    //                 id: $(element).data('id'),
    //                 quantity: quantity.val(),
    //                 price: price.val(),
    //                 total_price: total_amount
    //             }
    //             order.push(current)
    //         }
    //     })
    //     if(validity == true && order.length > 0) {
    //         const arg = JSON.stringify(order)
    //         const discount = $("#discount_amount").val()
    //         $("#order").val(arg)
    //         $("#discount").val(discount)
    //         $("#order_amount").val(grand_total)
    //         $("#orderForm").submit()
    //     } else {
    //         swal({
    //             title: 'Empty Order',
    //             text: 'Please select some items to purchase',
    //             icon: 'error'
    //         })
    //     }
    // }

    // function validateOrder() {
    //     const grand_total = updateGrandTotal()
    //     if(grand_total === 0 || isNaN(grand_total)) {
    //         swal({
    //             title: 'Empty Order',
    //             text: 'Please select some items to purchase',
    //             icon: 'error'
    //         })
    //         return false
    //     }

    //     createOrder(grand_total)
    // }

    $(function() {

        // $("#submit_transaction").click(function(e) {
        //     const partner_id = $("#partner_select").val()
        //     const warehouse_id = $("#warehouse_select").val()

        //     if (partner_id == null || partner_id == '' || partner_id == undefined) {
        //         swal({
        //             title: "",
        //             text: "Please select a  to continue",
        //             icon: 'error'
        //         }) 
        //         return
        //     } else if(warehouse_id == null || warehouse_id == '' || warehouse_id == undefined)  {
        //         swal({
        //             title: "Warehouse Required",
        //             text: "Please select a warehouse to continue",
        //             icon: 'error'
        //         })
        //         return
        //     } else {
        //         validateOrder()
        //     }
        // });

        // $("#discount_amount").on('input', function(e) {
        //     updateGrandTotal()
        // })

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
        $("#warehouse_select").selectize(warehouse_options)
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
            // <th>Name</th>
            // <th class="text-right">Current Stock</th>
            // <th class="text-right">Stock - After Adjust</th>
            // <th class="text-right">Adjust Quantity</th>
            // <th class="text-right">Type</th>
            // <th class="text-right">Action</th>
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
        // updateGrandTotal()
        // console.log(row)
    });


    
</script>


@endsection