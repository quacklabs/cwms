@extends('layout')
@section('title') {{ config('app.name') }} | {{ $title }} @endsection

@section('content')
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
        <h1>{{$title }}</h1>
        
        
        {{ Breadcrumbs::render() }}
        </div>
        <div class="section-body">
        <h2 class="section-title">Manage Returns</h2>
        <p class="section-lead">
            Please confirm quantities &amp; serial numbers.
        </p>

        <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            
                            <div class="row mr-0 ml-0">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Start Date</label>
                                        <input class="form-control" type="text" name="start_date" id="start_date">
                                    </div>
                                </div>
                                    
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>End Date</label>
                                        <div class="input-group">
                                            <input type="text" name="end_date" class="form-control">
                                            
                                            <div class="input-group-append">
                                                <button type="submit" class="btn btn-primary" type="button"><i class="fas fa-search"></i></button>
                                            </div>
                                        </div>
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
                        <h4>All returned {{ $flag }}s</h4>
                        <div class="card-header-form buttons">
                            @empty($transactions)


                            @else
                                @if(count($transactions) > 0)
                                    <a target="_blank" href="{{ route('export.export_returns', ['flag' => $flag, 'start' => $transactions->last()->id, 'end' => $transactions->first()->id, 'format' => 'pdf']) }}" class="btn btn-sm btn-primary rounded"><i class="fas fa-download"></i> PDF</a>
                                    <a target="_blank" href="{{ route('export.export_returns', ['flag' => $flag, 'start' => $transactions->last()->id, 'end' => $transactions->first()->id, 'format' => 'xls']) }}" class="btn btn-sm btn-primary rounded"><i class="fas fa-download"></i> XLS</a>
                                    <a href="#" class="btn btn-sm btn-primary rounded"><i class="fas fa-print"></i> Print</a>
                                @endif


                            @endempty
                                
                        </div> 
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-striped ">
                                <thead class="bg-dark text-white">
                                    <tr class="text-left sm-text">
                                        <th class="text-white text-sm">Invoice | Date</th>
                                        <th class="text-white">{{ ($flag == 'purchase') ? 'Supplier' : 'Customer' }} | Mobile</th>
                                        <th class="text-white text-sm">Amount | Warehouse</th>
                                        <th class="text-white text-sm">Lessed | Receivable </th>
                                        <th class="text-white text-sm">Received | Due</th>
                                        <th class="text-white text-sm">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="mt-4">
                                    @empty($transactions)
                                    <tr>No {{ $flag }} found</tr>

                                    @else
                                        @foreach($transactions as $transaction)
                                        <tr class="text-left">
                                            <td>
                                                <strong>#{{ $transaction->invoice_no }}</strong>
                                                <span class="text-muted">
                                                    <p>{{ $transaction->date }}</p>
                                                </span>
                                            </td>

                                            <td class="p-2">
                                                <strong>{{ $transaction->partner->name }}</strong>
                                                <span class="text-muted">
                                                    <p>{{ $transaction->partner->mobile_no }}</p>
                                                </span>
                                            </td>
                                            
                                            <td class="p-3">
                                                <strong>&#8358;{{ number_format($transaction->total_price, 2) }}</strong>
                                                <span class="text-muted">
                                                    <p>{{ $transaction->owner->warehouse->name }}</p>
                                                </span>
                                            </td>

                                            <td class="p-3">
                                                <strong>&#8358;{{ number_format($transaction->receivable, 2) }}</strong>
                                                <span class="text-muted">
                                                    <p>&#8358;{{ number_format($transaction->discount_amount, 2) }}</p>
                                                </span>
                                            </td>

                                            <td>
                                                <strong class="{{ ($transaction->due() == 0.00) ? '' : 'text-danger' }}"> &#8358;{{ number_format($transaction->received, 2) }}</strong>
                                                <span class="text-muted">
                                                    <p>&#8358;{{ number_format($transaction->due(),2) }} </p>
                                                </span>
                                            </td>
                                            <td>
                                                <div class="buttons">
                                                    @can('approve-'.$flag)
                                                        @if (floatval($transaction->due()) > floatval(0.00))
                                                            <a href="#" id="btn-modal" class="btn btn-dark btn-icon" data-toggle="tooltip" data-placement="top" title="" data-original-title="{{ ($flag == 'purchase') ? 'Receive Payment' : 'Give Payment' }}"  data-transaction="{{ json_encode($transaction) }}" >
                                                                <i class="fas fa-money-check-alt" ></i>
                                                            </a>
                                                            <!-- <a href="#" class="btn btn-dark" data-toggle="" > -->
                                                                
                                                            <!-- </a> -->
                                                        @endif
                                                    @endcan


                                                    @can('delete-purchase')
                                                        <a href="" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="" data-original-title="{{ ($flag == 'purchase') ? 'Delete Purchase' : 'Delete Sale Return' }}">
                                                            <i class="fas fa-trash"></i>
                                                        </a>
                                                    @endcan

                                                    <a href="#" class="btn btn-icon btn-primary" data-toggle="tooltip" data-placement="top" title="" data-original-title="{{ ($flag == 'purchase') ? 'Delete Purchase' : 'Download Details' }}">
                                                        <i class="fas fa-download"></i>
                                                    </a>
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
                    <div class="form-group row align-transactions-center">
                        <label for="site-title" class="form-control-label col-sm-3 text-md-right">Amount</label>
                        <div class="col-sm-6 col-md-9">
                        <input id="amount" name="amount" type="text" class="form-control" id="decimalInput" required>
                        </div>
                    </div>
                    <div class="form-group row align-transactions-center">
                        <label for="site-description" class="form-control-label col-sm-3 text-md-right">Due Now</label>
                        <div class="col-sm-6 col-md-9">
                            <input id="due" name="due" type="text" class="form-control"  value="" readonly>
                        </div>
                    </div>

                    <div class="form-group row align-transactions-center">
                        <label for="site-description" class="form-control-label col-sm-3 text-md-right">Signature</label>
                        <div class="col-sm-6 col-md-9">
                            <input id="myCheckbox" name="status" type="checkbox" class="form-control" checked required>
                            <span class="text-muted">I affirm that I have {{ ($flag == 'sale') ? 'received' : 'given' }} the sum stated above</span>
                        </div>
                    </div>

                    <div class="form-group row align-transactions-center">
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
<script>
    $(function() {

        $("#btn-modal").on('click', function() {
            const details = $(this).data('transaction')
            // console.log(details)
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