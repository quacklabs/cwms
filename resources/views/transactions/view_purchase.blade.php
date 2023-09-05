@extends('layout')
@section('title') {{ config('app.name') }} | {{ $title }} @endsection

@section('css')
<link href="{{ asset('css/flatpickr.css') }}" rel="stylesheet">
    
@endsection

@section('content')
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
        <h1>{{$title }}</h1>
        @can('create-purchase')
        <div class="section-header-button">
            <a class="btn btn-primary" href="{{ route('purchase.create') }}">Add New</a>
            <!-- <a href="#" class="btn btn-primary">Add New</a> -->
        </div>
        @endcan
        
        {{ Breadcrumbs::render() }}
        </div>
        <div class="section-body">
            <h2 class="section-title">Manage {{ ucwords($flag) }}</h2>
            <p class="section-lead">
                Unsettled payments are displayed in red.
            </p>

            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            
                            <div class="row mr-0 ml-0">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Filter By Date Range</label>
                                        <form action="{{ ($flag == 'sale') ? route('sale.view') : route('purchase.view') }}" method="get">
                                            <div class="input-group">
                                            
                                                @csrf
                                                <input class="form-control" type="text" name="dateRange" id="start_date" placeholder="Start Date -> End Date" value="{{ old('dateRange') ?? '' }}">
                                                <div class="input-group-append">
                                                    <button type="submit" class="btn btn-primary" type="button"><i class="fas fa-search"></i></button>
                                                </div>
                                        
                                            </div>
                                        </form>
                                       
                                    </div>
                                </div>
                                    
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Invoice Search</label>
                                        <form action="{{ ($flag == 'sale') ? route('sale.view') : route('purchase.view') }}" method="get">
                                            @csrf
                                            <div class="input-group">
                                                <input type="text" name="invoice" class="form-control" placeholder="Invoice No">
                                                
                                                <div class="input-group-append">
                                                    <button type="submit" class="btn btn-primary" type="button"><i class="fas fa-search"></i></button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

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
                            <h4>All {{ $flag }}s</h4>
                            <div class="card-header-form buttons">
                                @empty($items)


                                @else
                                    @if(count($items) > 0)
                                        <a target="_blank" href="{{ route('export.export_details', ['flag' => $flag, 'start' => $items->last()->id, 'end' => $items->first()->id, 'format' => 'pdf']) }}" class="btn btn-sm btn-primary rounded"><i class="fas fa-download"></i> PDF</a>
                                        <a target="_blank" href="{{ route('export.export_details', ['flag' => $flag, 'start' => $items->last()->id, 'end' => $items->first()->id, 'format' => 'xls']) }}" class="btn btn-sm btn-primary rounded"><i class="fas fa-download"></i> XLS</a>
                                        <a href="#" class="btn btn-sm btn-primary rounded"><i class="fas fa-print"></i> Print</a>
                                    @endif


                                @endempty
                                
                            </div> 
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-striped ">
                                    <thead class="bg-dark text-white">
                                        <tr class="text-left">
                                            <th></th>
                                            <th class="text-white">Invoice | Date</th>
                                            <th class="text-white">{{ ($flag == 'purchase') ? 'Supplier' : 'Customer' }} | Mobile</th>
                                            <th class="text-white">Amount | Warehouse</th>
                                            <th class="text-white">Payable | Discount </th>
                                            <th class="text-white">Due | Paid</th>
                                            <th class="text-white">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="mt-4">
                                        @empty($items)
                                        <tr>No {{ $flag }} found</tr>

                                        @else
                                            @foreach($items as $transaction)
                                            <tr class="text-left">
                                                <td>
                                                    @if(count($transaction->returns->get()) > 0)
                                                        <span class="badge badge-warning badge-pill beep" data-toggle="tooltip" data-placement="top" title="" data-original-title="Returned">
                                                            {{ $loop->iteration}}
                                                        </span>
                                                    @else
                                                        <span class="badge badge-primary badge-pill">
                                                            {{ $loop->iteration}}
                                                        </span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <strong>#{{ $transaction->invoice_no }}</strong>
                                                    <span class="text-muted">
                                                        <p>{{ $transaction->date }}</p>
                                                    </span>
                                                </td>

                                                <td class="p-2">
                                                    <strong>{{ $transaction->owner->name }}</strong>
                                                    <span class="text-muted">
                                                        <p>{{ $transaction->owner->mobile_no }}</p>
                                                    </span>
                                                </td>
                                                
                                                <td class="p-3">
                                                    <strong>&#8358;{{ number_format($transaction->total_price, 2) }}</strong>
                                                    <span class="text-muted">
                                                        <p>{{ $transaction->warehouse->name }}</p>
                                                    </span>
                                                </td>

                                                <td class="p-3">
                                                    <strong>&#8358;{{ number_format($transaction->payable(), 2) }}</strong>
                                                    <span class="text-muted">
                                                        <p>&#8358;{{ number_format($transaction->discount_amount, 2) }}</p>
                                                    </span>
                                                </td>

                                                <td>
                                                    <strong class="{{ ($transaction->due() == 0.00) ? '' : 'text-danger' }}">&#8358;{{ number_format($transaction->due,2) }} </strong>
                                                    <span class="text-muted">
                                                        <p>&#8358;{{ number_format($transaction->received, 2) }}</p>
                                                    </span>
                                                </td>
                                                <td>
                                                    <div class="buttons">
                                                        @can('approve-'.$flag)
                                                            @if($transaction->returns != null)
                                                                @if (floatval($transaction->due) > floatval(0.00) )
                                                                <a href="#" id="btn-modal" class="btn btn-dark btn-icon" data-toggle="tooltip" data-placement="top" title="" data-original-title="{{ ($flag == 'purchase') ? 'Give Payment' : 'Receive Payment' }}"  data-transaction="{{ json_encode($transaction) }}" >
                                                                    <i class="fas fa-money-check-alt" ></i>
                                                                </a>
                                                                @endif

                                                            @else
                                                                @if (floatval($transaction->due) > floatval(0.00) )
                                                                <a href="#" id="btn-modal" class="btn btn-dark btn-icon" data-toggle="tooltip" data-placement="top" title="" data-original-title="{{ ($flag == 'purchase') ? 'Give Payment' : 'Receive Payment' }}"  data-transaction="{{ json_encode($transaction) }}" >
                                                                    <i class="fas fa-money-check-alt" ></i>
                                                                </a>
                                                                @endif
                                                                <!-- <a href="#" class="btn btn-dark" data-toggle="" > -->
                                                                    
                                                                <!-- </a> -->
                                                            @endif
                                                        @endcan

                                                        @if(count($transaction->returns->get()) == 0)
                                                            @if(floatval($transaction->due) != 0.00)
                                                                @can('create-'.$flag.'-return')
                                                                    <a href="{{ route($flag.'.return', ['id' => $transaction->id]) }}" class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="" data-original-title="{{ ($flag == 'purchase') ? 'Return Purchase' : 'Return Sale' }}">
                                                                        <i class="fas fa-reply"></i>
                                                                    </a>
                                                                @endcan
                                                            @endif
                                                        @endif

                                                        @can('delete-purchase')
                                                            <a href="" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="" data-original-title="{{ ($flag == 'purchase') ? 'Delete Purchase' : 'Delete Sale' }}">
                                                                <i class="fas fa-trash"></i>
                                                            </a>
                                                        @endcan
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
                                    {{ $items->links() }}
                                @endempty
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
.modal-dialog {
  max-width: 50%;
  margin: auto;
}
</style>


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
                <form id="moneyForm" method="POST" action="#">
                    @csrf
                    <div class="form-group row align-items-center">
                        <label for="site-title" class="form-control-label col-sm-3 text-md-right">Amount</label>
                        <div class="col-sm-6 col-md-9">
                        <input id="amount" name="amount" type="text" class="form-control" id="decimalInput" required>
                        </div>
                    </div>
                    <div class="form-group row align-items-center">
                        <label for="site-description" class="form-control-label col-sm-3 text-md-right">Due Now</label>
                        <div class="col-sm-6 col-md-9">
                            <input id="due" name="due" type="text" class="form-control"  value="" readonly>
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
                </form>
            </div>
        </div>
    </div>
</div>

@endsection


@section('js')
<script src="{{ asset('js/flatpickr.js') }}"></script>
<script>
    $(function() {

        $("#btn-modal").on('click', function() {
            const details = $(this).data('transaction')
            // console.log(details)
            $("#due").val(details.due.toLocaleString())

            $("#moneyForm").prop('action', details.url)
            $("#myModal").modal('show');
        })
    });

    flatpickr("#start_date", {
        mode: "range",
        dateFormat: "d-m-Y",
    })
</script>

@empty($edit_product)

@else

@endempty

@endsection