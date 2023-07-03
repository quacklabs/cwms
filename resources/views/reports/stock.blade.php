@extends('layout')
@section('title') {{ config('app.name') }} | {{ $title }} @endsection

@section('css')
<link rel="stylesheet" href="{{ asset('css/selector.css') }}">
    
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
        <h2 class="section-title">View Stock Reports</h2>
        <!-- <p class="section-lead">
            Each staff must be assigned to a warehouse
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
                        <h4>Filter Stock</h4>
                    </div>
                    <div class="card-body">
                        
                        <div class="row mr-0 ml-0">
                            <div class="col-md-6">
                                <form method="GET" class="col-12" action="{{ route('report.stock') }}">
                                    @csrf
                                    <div class="form-group">
                                        <label>Filter By Warehouse</label>
                                        <div class="input-group">
                                            <div class="form-control p-0">
                                                <select name="warehouse" class="p-0 mb-0 selector" id="warehouse">
                                                    
                                                </select>
                                            </div>
                                            
                                            <div class="input-group-append">
                                                <button type="submit" class="btn btn-primary" type="button"><i class="fas fa-search"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </form>
                            </div>
                                
                                
                            <div class="col-md-6">
                                <form class="col-12" action="{{ route('report.stock') }}" method="GET">
                                    @csrf
                                    <div class="form-group">
                                        <label>Filter By Product</label>
                                        <div class="input-group">
                                            <div class="form-control p-0">
                                                <select name="product" class="p-0 mb-0 selector" id="product">
                                                    <option></option>
                                                    
                                                </select>
                                            </div>
                                            
                                            <div class="input-group-append">
                                                <button type="submit" class="btn btn-primary" type="button"><i class="fas fa-search"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </form>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>

        
        <div class="row mt-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Product Stock</h4>
                        <!-- <div class="card-header-form">
                            <form>
                                <div class="row">
                                    <div class="input-group col-6">
                                        <input id="date-range" type="text" class="form-control" placeholder="Start Date - End Date">
                                        <div class="input-group-btn">
                                            <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                        </div>
                                    </div>
                                    <div class="input-group col-6">
                                        <input type="text" class="form-control" placeholder="TRX Search">
                                        <div class="input-group-btn">
                                            <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                        </div>
                                    </div>

                                </div>
                                
                                
                            </form>
                        </div> -->
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>S.N</th>
                                        <th>Name.</th>
                                        <th>SKU</th>
                                        <th>Category</th>
                                        <th>Brand</th>
                                        <th>Stock</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @empty('stock')


                                    @else
                                        @foreach ($stock as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->sku }}</td>
                                            <td>{{ ucwords($item->categories->name) }}</td>
                                            <td>{{ ucwords($item->brands->name) }}</td>
                                            <td>{{ ucwords($item->totalInStock() ) }}</td>
                                        </tr>
                                            
                                        @endforeach
                                        
                                    @endempty
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="card-footer">
                        <div class="float-right">
                        @empty('stock')

                        @else
                            @if($stock->links() != null)
                                {{ $stock->links() }}
                            @endif
                        @endempty
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<style>
.modal-dialog {
  max-width: 70%;
  margin: auto;
}
</style>

@endsection


@section('js')
<script src="{{ asset('js/selector.js') }}"></script>
<script src="{{ asset('js/datepicker.js') }}"></script>
<script>
$(function() {
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
        }
    }
    $("#warehouse").selectize(warehouse_options)
    $("#product").selectize(product_options)

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
});
</script>

@endsection