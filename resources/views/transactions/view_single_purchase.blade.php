@extends('layout')
@section('title') {{ config('app.name') }} | {{ $title }} @endsection



@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ $title }}</h1>
            
            {{ Breadcrumbs::render() }}
        </div>

        <div class="section-body">
            <div class="invoice">
              <div class="invoice-print">
                <div class="row">
                  <div class="col-lg-12">
                    <div class="invoice-title">
                      <h2>Purchase Order</h2>
                      <div class="invoice-number">Order #{{ $transaction->invoice_no }}</div>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="col-md-6">
                        <!-- <address>
                          <strong>Billed To:</strong><br>
                            
                        </address> -->
                      </div>
                      <div class="col-md-6 text-md-right">
                        <address>
                          <strong>Supplied By:</strong><br>
                            {{ $transaction->owner->name }}<br>
                            {{ $transaction->owner->mobile_no }}<br>
                            {{ $transaction->owner->address }}
                        </address>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <!-- <address>
                          <strong>Payment Method:</strong><br>
                          Visa ending **** 4242<br>
                          ujang@maman.com
                        </address> -->
                      </div>
                      <div class="col-md-6 text-md-right">
                        <address>
                          <strong>Order Date:</strong><br>
                          {{ $transaction->formattedDate }}<br><br>
                        </address>
                      </div>
                    </div>
                  </div>
                </div>
                
                <div class="row mt-4">
                  <div class="col-md-12">
                    <div class="section-title">Order Summary</div>
                    <p class="section-lead">All items here cannot be deleted.</p>
                    <div class="table-responsive">
                      <table class="table table-striped table-hover table-md">
                        <tbody>
                          <tr>
                            <th data-width="40" style="width: 40px;">#</th>
                            <th>Item</th>
                            <th class="text-center">Price</th>
                            <th class="text-center">Quantity</th>
                            <th class="text-right">Totals</th>
                          </tr>

                          @foreach ($transaction->details as $detail)
                          <tr>
                            <th data-width="40" style="width: 40px;">{{ $loop->iteration }}</th>
                            <th>{{ $detail->product->name }}</th>
                            <th class="text-center">{{ number_format($detail->price, 2) }}</th>
                            <th class="text-center">{{ $detail->quantity }}</th>
                            <th class="text-right">{{ number_format($detail->total, 2) }}</th>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                    <div class="row mt-4">
                      <div class="col-lg-8">
                        <!-- <div class="section-title">Payment Method</div> -->
                        <!-- <p class="section-lead">The payment method that we provide is to make it easier for you to pay invoices.</p> -->
                        <!-- <div class="images">
                          <img src="http://localhost:8080/stisla-codeigniter/assets/img/visa.png" alt="visa">
                          <img src="http://localhost:8080/stisla-codeigniter/assets/img/jcb.png" alt="jcb">
                          <img src="http://localhost:8080/stisla-codeigniter/assets/img/mastercard.png" alt="mastercard">
                          <img src="http://localhost:8080/stisla-codeigniter/assets/img/paypal.png" alt="paypal">
                        </div> -->
                      </div>
                      <div class="col-lg-4 text-right">
                        <div class="invoice-detail-item">
                          <div class="invoice-detail-name">Subtotal</div>
                          <div class="invoice-detail-value">&#x20A6;{{ number_format($transaction->total_price, 2) }}</div>
                        </div>
                        <div class="invoice-detail-item">
                          <div class="invoice-detail-name">Discount</div>
                          <div class="invoice-detail-value">&#x20A6;{{ number_format($transaction->discount_amount, 2)}}</div>
                        </div>
                        <hr class="mt-2 mb-2">
                        <div class="invoice-detail-item">
                          <div class="invoice-detail-name">Total</div>
                          <div class="invoice-detail-value invoice-detail-value-lg">&#x20A6;{{ number_format($transaction->payable, 2) }}</div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <hr>
              <div class="text-md-right">
                <div class="float-lg-left mb-lg-0 mb-3">
                  <button class="btn btn-primary btn-icon icon-left"><i class="fas fa-credit-card"></i> Process Payment</button>
                  <button class="btn btn-danger btn-icon icon-left"><i class="fas fa-times"></i> Cancel</button>
                </div>
                <button class="btn btn-warning btn-icon icon-left"><i class="fas fa-print"></i> Print</button>
              </div>
            </div>
          </div>
    </section>
</div>
    
@endsection


@section('js')
    
@endsection