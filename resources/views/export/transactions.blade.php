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
                                <h4>All {{ $flag }}</h4>
                                <div class="invoice-number">
                                    <img src="data:image/jpeg;base64,{{ $logo }}" style="max-height: 80px; max-width: 100px;">
                                </div>
                            </div>
                            <hr>
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
                                            <th class="text-left">{{ ($flag == 'Purchase') ? 'Supplier' : 'Customer' }}</th>
                                            <th class="text-right">Warehouse</th>
                                            <th>Payable</th>
                                            <th>Due</th>
                                        </tr>

                                        @foreach($items as $transaction)
                                        <tr class="text-left">
                                            <td>
                                            {{ $loop->iteration}}.
                                            </td>
                                            <td>
                                                <strong>{{ $transaction->invoice_no }}</strong>
                                            </td>
                                            <td>
                                                {{ $transaction->date }}
                                            </td>

                                            <td class="">
                                                {{ $transaction->owner->name }}
                                            </td>
                                            
                                            <td class="">
                                                {{ number_format($transaction->total_price, 2) }}
                                                
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



