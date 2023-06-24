@extends('layout')
@section('title') {{ config('app.name') }} | {{ $title }} @endsection


@section('content')

<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{$title }}</h1>
            
            {{ Breadcrumbs::render('transactions.enter_'.$flag.'_ledger') }}
        </div>
        <div class="section-body">
            <h2 class="section-title">Invoice #{{ $transaction->invoice_no }}</h2>
            <p class="section-lead">
                generate a new payment receipt
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
                <div class="col-lg-9 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                        <h4>{{ $title }}</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('transaction.enter_ledger', ['flag' => $flag, 'id' => $transaction->id]) }}">
                                @csrf
                                <div class="form-group row align-items-center">
                                    <label for="site-title" class="form-control-label col-sm-3 text-md-right">Amount</label>
                                    <div class="col-sm-6 col-md-9">
                                    <input name="amount" type="text" class="form-control" id="decimalInput" required>
                                    </div>
                                </div>
                                <div class="form-group row align-items-center">
                                    <label for="site-description" class="form-control-label col-sm-3 text-md-right">Due Now</label>
                                    <div class="col-sm-6 col-md-9">
                                        <input name="due" type="text" class="form-control"  value="{{ number_format($transaction->due(),2) }}" readonly>
                                    </div>
                                </div>

                                <div class="form-group row align-items-center">
                                    <label for="site-description" class="form-control-label col-sm-3 text-md-right">Signature</label>
                                    <div class="col-sm-6 col-md-9">
                                        <input id="myCheckbox" name="status" type="checkbox" class="form-control" checked required>
                                        <span class="text-muted">I affirm that I have {{ $action }} said sum above</span>
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
        </div>
    </section>
</div>


@endsection


@section('js')

<script>
    $(function() {

        $('form').on('submit', function(event) {
            if (!$('#myCheckbox').is(':checked')) {
                event.preventDefault();
                swal({
                    title: 'Signature Required',
                    text: "Please check affirmation box",
                    icon: 'warning'
                })
            }
        });

        $('#decimalInput').on('input', function() {
            var inputValue = $(this).val();
            var cursorPosition = $(this).prop('selectionStart');
            var key = event.originalEvent.data;

            if (key === '.' && inputValue.includes('.')) {
                // Prevent entering multiple decimal points
                event.preventDefault();
            } else {
            // Remove non-digit characters
                var numericValue = inputValue.replace(/[^0-9.]/g, '');
                var formattedValue = parseFloat(numericValue).toFixed(2);

                // Update the input value with the formatted value
                $(this).val(formattedValue);

                // Adjust the cursor position
                var newPosition = cursorPosition;

                if (key === '.' && cursorPosition <= inputValue.indexOf('.')) {
                    // Move the cursor after the decimal point
                    newPosition += 1;
                } else if (cursorPosition > inputValue.indexOf('.')) {
                    // Adjust cursor position when input length changes
                    newPosition += (formattedValue.length - inputValue.length);
                }

                $(this).prop('selectionStart', newPosition);
                $(this).prop('selectionEnd', newPosition);
            }
        });
    })
</script>
    
@endsection