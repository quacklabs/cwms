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
                                        <th>TRX NO.</th>
                                        <th>{{ ucwords($flag) }}</th>
                                        <th>Amount</th>
                                        <th>Type</th>
                                        <th>Action By</th>
                                        <th>Time</th>
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
                                                <td>{{ $payment->model->first()->trx }}</td>
                                                <td>{{ $payment->model->first()->owner->name }}</td>
                                                <td><strong>&#x20A6;{{ number_format($payment->model->first()->amount, 2) }}</strong></td>
                                                <td>{{ $payment->action }}</td>
                                                <td>{{ $payment->user->first()->username }}</td>
                                                <td>{{ $payment->created_at }}</td>
                                            </tr>
                                        @endforeach
                                    @endempty
                                    

                            
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="card-footer">
                        <div class="float-right">
                            @empty('payments')

                            @else
                            
                            {{ $payments->links() }}
                                
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