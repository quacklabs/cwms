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
                            <form action="{{ route('transaction.create', ['flag' => $flag]) }}" method="POST">
                                @csrf
                                <input type="hidden" name="purchaseOrder" id="jsonObjectInput">
                                <div class="input-group float-right">
                                    <button id="submit_transaction" class="btn rounded btn-primary"><i class="fas fa-plus"></i> Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="inputEmail4">Invoice No</label>
                                <input type="email" class="form-control" id="inputEmail4" placeholder="Email" value="{{ $invoice_no }}" readonly>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="inputPassword4">{{ ($flag == 'purchase' ? 'Supplier' : 'Customer') }}</label>
                                <div class="form-control p-0">
                                    <select id="partner_select" name="partner_id" class="p-0 mb-0 selector">
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
                                <input id="date" name="purchase_date" type="text" class="form-control" value="{{ date('d-m-Y') }}" required>
                            </div>

                            <div class="form-group col-md-3">
                                <label for="inputPassword4">Warehouse</label>
                                <div class="form-control p-0">
                                    <select id="warehouse_select" name="warehouse_id" class="p-0 mb-0 selector">
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

                        <div class="form-row mb-4">
                            <select class="col-12" id="product_select" placeholder="Product Name or SKU">

                            </select>
                            
                            <!-- <div class="input-group col-12">
                                <input name="product id="product_select" type="text" class="form-control" placeholder="Product name or SKU" autocomplete="off">
                            </div> -->
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
                                    <tr id="grand_total" style="display: none;">
                                        <td colspan="4" class="text-right font-weight-bold">Total</td>
                                        <td id="total_amount" class="text-right font-weight-bold">&#8358;0.00</td>
                                        
                                    </tr>

                                    @empty($transactions)

                                    @else
                                        @foreach($transactions as $transaction)
                                        
                                        <tr>
                                            <td class="pricing-transaction">
                                                @if($transaction->status == true)
                                                <div class="pricing-details">
                                                    <div class="pricing-transaction">
                                                        <div class="pricing-transaction-icon bg-success text-white px-1" style="border-radius: 50%; height: 20px; width: 20px;">
                                                            <i class="fas fa-check"></i>
                                                        </div>
                                                    </div>
                                                </div>

                                                @else
                                                <div class="pricing-transaction-icon bg-danger text-white px-1" style="border-radius: 50%; height: 20px; width: 20px;">
                                                    <i class="fas fa-times"></i>
                                                </div>
                                                @endif
                                            </td>
                                            <td>{{ $transaction->name }}</td>
                                            <td>{{ $transaction->address }}</td>
                                            <td>{{ $transaction->warehouse->name ?? 'Unassigned' }}</td>
                                            <td>
                                                <div class="buttons">
                                                    <!-- <a href="{{ route('transaction.view', ['id' => $transaction->id]) }}" class="btn btn-icon btn-primary" data-toggle="tooltip" data-placement="top" title="" data-original-title="View transaction">
                                                        <i class="fas fa-eye"></i>
                                                    </a> -->
                                                    @can('suspend-transaction')
                                                        @if($transaction->status == true)
                                                        <a href="{{ route('transaction.toggle', ['id' => $transaction->id, 'action' => 'suspend']) }}" class="btn btn-icon btn-warning" data-toggle="tooltip" data-placement="top" title="" data-original-title="Deactivate transaction">
                                                            <i class="fas fa-times"></i>
                                                        </a>
                                                        @else
                                                        <a href="{{ route('transaction.toggle', ['id' => $transaction->id, 'action' => 'activate']) }}" class="btn btn-icon btn-success" data-toggle="tooltip" data-placement="top" title="" data-original-title="Activate transaction">
                                                            <i class="fas fa-check"></i>
                                                        </a>
                                                        @endif
                                                    @endcan

                                                    @can('modify-'.$flag)
                                                        <a href="{{ route('transaction.edit', ['id' => $transaction->id]) }}" class="btn btn-icon btn-info" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit transaction">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                    @endcan

                                                    @can('delete-'.$flag)
                                                        <a href="{{ route('transaction.delete', ['id' => $transaction->id]) }}" class="btn btn-icon btn-danger" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete transaction">
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
                            @empty($transactions)

                            @else
                                {{ $transactions->links() }}
                            @endempty
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
        const item_rows = $("#items")
        const rows = item_rows.find('tr').not(':last')
        var grand = 0
        rows.each(function(index, element) {
            const total = $(element).find('input').filter(function() {
                return $(this).data('name') === 'total';
            }).first()
            grand = parseFloat(grand) + parseFloat(total.val())
        })
        $("#total_amount").html('&#8358;'+grand)
    }

    function validateOrder() {

    }

    $(function() {

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
                    return '<div class="option" data-selectable="" data-name="'+item.name+'" data-value="' + escape(item.id) + '">'+ escape(item.name) +'</div>'
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
                insertItem(name, id)
                this.clearOptions()
            }
        }

        $("#partner_select").selectize(partner_options)
        $("#warehouse_select").selectize(warehouse_options)
        $("#product_select").selectize(product_options)
        
    })

    function insertItem(name, id) {
        const item_rows = $("#items")
        var newRow = '<tr id="row'+id+'">' +
        '<td><button data-row="'+id+'" class="delete-btn btn btn-icon btn-danger"><i class="fas fa-trash"></i></button></td>' +
        '<td>'+name+'</td>' +
        '<td><input class="value-input form-control text-right" data-row="'+id+'" data-name="price" type="text" value="0"></td>' +
        '<td><input class="value-input form-control text-right" data-row="'+id+'" data-name="quantity" type="number" value="1"></td>' +
        '<td><input class="form-control text-right" data-name="total" type="text" value="0" readonly></td>' +
        '</tr>';

        item_rows.find('tr:last').before(newRow);
        $("#grand_total").show();
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
</script>


@endsection