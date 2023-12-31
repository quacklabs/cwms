<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
        <title>{{ $title }}</title>

        <!-- General CSS Files -->
    </head>
    <body>
        <style>
            {{ $bootstrap }}
        </style>

        <style>
            {{ $style }}
        </style>
        <style>
            {{ $components }}
        </style>
        <section class="section">
            <div class="section-body">
                <div class="invoice">
                <div class="invoice-print">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="invoice-title">
                                <h4>{{ $flag }} Returns Report</h4>
                                <div class="invoice-number">
                                    <img src="data:image/jpeg;base64,{{ $logo }}" style="max-height: 80px; max-width: 100px;">
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <address>
                                    <strong>Generated By:</strong><br>
                                        {{ $user->name }}<br>
                                        on: {{ date('d-m-Y') }} at {{ date('H:i') }}
                                    </address>
                                </div>
                                <div class="col-md-6 text-md-right">
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="section-title">Transactions Summary</div>
                            <div class="table-responsive">
                                <table class="table table-striped table-hover table-md">
                                    <tbody>
                                        <tr>
                                            <th data-width="40" style="width: 40px;">S.N</th>
                                            <th>Invoice</th>
                                            <th class="text-left">Date</th>
                                            <th class="text-left">{{ ($flag == 'purchase') ? 'Supplier' : 'Customer' }}</th>
                                            <th class="text-left">Warehouse</th>
                                            <th>{{ ($flag == 'sale') ? 'Payable' : 'Receivable' }}</th>
                                            <th>Due</th>
                                        </tr>

                                        @foreach($items as $transaction)
                                        <tr class="text-left">
                                            <td>
                                            {{ $loop->iteration}}.
                                            </td>
                                            <td>
                                                <strong>{{ $transaction->owner->invoice_no }}</strong>
                                            </td>
                                            <td>
                                                {{ $transaction->date }}
                                            </td>

                                            <td class="">
                                                {{ $transaction->partner->name }}
                                            </td>
                                            <td>
                                                {{ $transaction->owner->warehouse->name }}
                                            </td>
                                            
                                            <td class="">
                                                {{ number_format($transaction->payable(), 2) }}
                                            </td>

                                            <td>
                                               {{ number_format($transaction->due,2) }}
                                            </td>
                                        </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
                <hr>
            </div>

        </section>
        
    </body>
</html>



