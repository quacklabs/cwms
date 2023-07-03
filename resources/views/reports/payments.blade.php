@extends('layout')
@section('title') {{ config('app.name') }} | {{ $title }} @endsection

@section('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
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
        <h2 class="section-title">Manage {{ $flag }} payments</h2>
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
                        <h4>All Payments</h4>
                        <div class="card-header-form">
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
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>S.N</th>
                                        <th>Invoice No.</th>
                                        <th>Date</th>
                                        <th>{{ ucwords($flag) }}</th>
                                        <th>TRX</th>
                                        <th>Reason</th>
                                        <th>Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @empty('payments')
                                    <tr>
                                        <td colspan="7">No payments found</td>
                                    </tr>
                                    @else
                                        @foreach ($payments as $payment)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $payment->transaction->invoice_no }}</td>
                                                <td>{{ $payment->date }}</td>
                                                <td>{{ $payment->owner->name }}</td>
                                                <td>{{ $payment->trx }}</td>
                                                <td>{{ $payment->remarks }}</td>
                                                <td><strong>&#x20A6;{{ number_format($payment->amount, 2) }}</strong></td>
                                            </tr>
                                        @endforeach
                                    @endempty
                                    

                            
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
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
$(function() {
    flatpickr("#date-range", {
        mode: "range",
        dateFormat: "Y-m-d",
    });
});
</script>

@endsection