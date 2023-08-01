@extends('layout')
@section('title') {{ config('app.name') }} | {{ $title }} @endsection

@section('content')
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
        <h1>{{ ucwords($flag) }} {{$title }}</h1>
        @can('transfer-product')
        <div class="section-header-button">
            <a class="btn btn-primary" href="{{ route('transfer.add', ['flag' => $flag]) }}">Add New</a>
            <!-- <a href="#" class="btn btn-primary">Add New</a> -->
        </div>
        @endcan
        
        {{ Breadcrumbs::render() }}
        </div>
        <div class="section-body">
        <h2 class="section-title">Manage Transfers</h2>
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
                        <h4>All Transfers</h4>
                        <div class="card-header-form">
                            <!-- <div class="buttons row mb-2 ml-1">
                                <a href="#" id="btn-modal" class="btn btn-dark btn-icon btn-flat" data-toggle="tooltip" data-placement="top" title="" data-original-title="Print"  data-transaction="#" >
                                    <i class="fas fa-money-check-alt" ></i>
                                </a>
                            </div> -->
                            <div class="buttons row">
                                <div class="input-group col-6">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <div class="input-group-btn">
                                        <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                    </div>
                                </div>
                                <div class="input-group col-6">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <div class="input-group-btn">
                                        <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                    </div>
                                </div>
                            </div>

                            <!-- <div class="row">

                            </div> -->
                            <!-- <form>
                                
                            </form>

                            <form>
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <div class="input-group-btn">
                                        <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                    </div>
                                </div>
                            </form> -->
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-striped ">
                                <thead class="bg-dark text-white">
                                    <tr class="text-left">
                                        <th class="text-white">S.N</th>
                                        <th class="text-white">Tracking No</th>
                                        <th class="text-white">From</th>
                                        <th class="text-white">To </th>
                                        <th class="text-white">Products</th>
                                        <th class="text-white">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="mt-4">
                                    @empty($transfers)
                                    <tr>
                                        <td colspan="6">No transfers found</td>
                                    </tr>

                                    @else
                                        @foreach($transfers as $transfer)
                                        <tr class="text-left">
                                            <td>
                                                <strong>#{{ $loop->iteration }}</strong>
                                            </td>
                                            <td>
                                                {{ $transfer->tracking_no }}
                                            </td>

                                            <td>
                                                {{ $transfer->source_warehouse->name }}
                                            </td>
                                            <td>
                                                {{ $transfer->destination_warehouse->name }}
                                            </td>
                                            <td>
                                                {{ $transfer->totalProducts }}
                                            </td>
                                            <td>
                                                <a href="#" id="btn-modal" class="btn btn-dark btn-icon" data-toggle="tooltip" data-placement="top" title="" data-original-title="Download Invoice"  data-transaction="Download Invoice">
                                                    <i class="fas fa-download" ></i>
                                                </a>
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
                            @empty($transfers)

                            @else
                                {{ $transfers->links() }}
                            @endempty
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection


@section('js')
<script>
    $(function() {

        $("#btn-modal").on('click', function() {
            const details = $(this).data('transaction')
            $("#due").val(details.due.toLocaleString())
            $("#moneyForm").prop('action', details.url)
            $("#myModal").modal('show');
        })
        
    })
</script>

@empty($edit_product)

@else

@endempty

@endsection