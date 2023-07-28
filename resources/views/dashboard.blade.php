@extends('layout')
@section('title') {{ config('app.name') }} | {{ $title }} @endsection


@section('content')
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="card card-statistic-2">
                    <div class="card-stats">
                        <div class="card-stats-title">
                            Sales Statistics - {{ date('M Y') }}
                            <!-- <div class="dropdown d-inline">
                            <a class="font-weight-600 dropdown-toggle" data-toggle="dropdown" href="#" id="orders-month">August</a>
                            <ul class="dropdown-menu dropdown-menu-sm">
                                <li class="dropdown-title">Select Month</li>
                                <li><a href="#" class="dropdown-item">January</a></li>
                                <li><a href="#" class="dropdown-item">February</a></li>
                                <li><a href="#" class="dropdown-item">March</a></li>
                                <li><a href="#" class="dropdown-item">April</a></li>
                                <li><a href="#" class="dropdown-item">May</a></li>
                                <li><a href="#" class="dropdown-item">June</a></li>
                                <li><a href="#" class="dropdown-item">July</a></li>
                                <li><a href="#" class="dropdown-item active">August</a></li>
                                <li><a href="#" class="dropdown-item">September</a></li>
                                <li><a href="#" class="dropdown-item">October</a></li>
                                <li><a href="#" class="dropdown-item">November</a></li>
                                <li><a href="#" class="dropdown-item">December</a></li>
                            </ul>
                            </div> -->
                        </div>
                        <div class="card-stats-items">
                            <div class="card-stats-item">
                            <div class="card-stats-item-count">{{ $analytics->sales_statistics()->pending }}</div>
                            <div class="card-stats-item-label">Pending</div>
                            </div>
                            <div class="card-stats-item">
                            <div class="card-stats-item-count">{{ $analytics->sales_statistics()->completed }}</div>
                            <div class="card-stats-item-label">Completed</div>
                            </div>
                            <div class="card-stats-item">
                            <div class="card-stats-item-count">{{ $analytics->sales_statistics()->products }}</div>
                            <div class="card-stats-item-label">Products</div>
                            </div>
                        </div>
                    </div>
                    <div class="card-icon shadow-primary bg-primary">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Orders</h4>
                        </div>
                        <div class="card-body">
                            {{ $analytics->sales_statistics()->total }}
                            <span class="text-right ml-auto inline float-right text-primary">
                            &#x20A6;{{ $analytics->sales_statistics()->amount }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="card card-statistic-2">
                    <div class="card-stats">
                    <div class="card-stats-title">
                        Purchase Statistics - {{ date('M Y') }}
                        <!-- <div class="dropdown d-inline">
                        <a class="font-weight-600 dropdown-toggle" data-toggle="dropdown" href="#" id="orders-month">August</a>
                        <ul class="dropdown-menu dropdown-menu-sm">
                            <li class="dropdown-title">Select Month</li>
                            <li><a href="#" class="dropdown-item">January</a></li>
                            <li><a href="#" class="dropdown-item">February</a></li>
                            <li><a href="#" class="dropdown-item">March</a></li>
                            <li><a href="#" class="dropdown-item">April</a></li>
                            <li><a href="#" class="dropdown-item">May</a></li>
                            <li><a href="#" class="dropdown-item">June</a></li>
                            <li><a href="#" class="dropdown-item">July</a></li>
                            <li><a href="#" class="dropdown-item active">August</a></li>
                            <li><a href="#" class="dropdown-item">September</a></li>
                            <li><a href="#" class="dropdown-item">October</a></li>
                            <li><a href="#" class="dropdown-item">November</a></li>
                            <li><a href="#" class="dropdown-item">December</a></li>
                        </ul>
                        </div> -->
                    </div>
                    <div class="card-stats-items">
                        <div class="card-stats-item">
                        <div class="card-stats-item-count">{{ $analytics->purchase_statistics()->pending }}</div>
                        <div class="card-stats-item-label">Pending</div>
                        </div>
                        <div class="card-stats-item">
                        <div class="card-stats-item-count">{{ $analytics->purchase_statistics()->completed }}</div>
                        <div class="card-stats-item-label">Completed</div>
                        </div>
                        <div class="card-stats-item">
                        <div class="card-stats-item-count">{{ $analytics->purchase_statistics()->products }}</div>
                        <div class="card-stats-item-label">Products</div>
                        </div>
                    </div>
                    </div>
                    <div class="card-icon shadow-primary bg-primary">
                        <i class="fas fa-shopping-bag"></i>
                    </div>
                    <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Orders</h4>
                    </div>
                    <div class="card-body">
                        {{ $analytics->purchase_statistics()->total }}
                        <span class="text-right ml-auto inline float-right text-primary">
                        &#x20A6;{{ $analytics->purchase_statistics()->amount }}
                        </span>
                    </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            
            <div class="col-lg-6 col-md-6 col-sm-12">
              <div class="card card-statistic-2">
                <div class="card-chart"><div class="chartjs-size-monitor" style="position: absolute; inset: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
                  <canvas id="balance-chart" height="77" width="327" class="chartjs-render-monitor" style="display: block; width: 327px; height: 77px;"></canvas>
                </div>
                <div class="card-icon shadow-primary bg-primary">
                  <i class="fas fa-dollar-sign"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Balance</h4>
                  </div>
                  <div class="card-body">
                    $187,13
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
              <div class="card card-statistic-2">
                <div class="card-chart"><div class="chartjs-size-monitor" style="position: absolute; inset: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
                  <canvas id="sales-chart" height="77" width="327" class="chartjs-render-monitor" style="display: block; width: 327px; height: 77px;"></canvas>
                </div>
                <div class="card-icon shadow-primary bg-primary">
                  <i class="fas fa-shopping-bag"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Sales</h4>
                  </div>
                  <div class="card-body">
                    4,732
                  </div>
                </div>
              </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                    <i class="far fa-shopping-bag"></i>
                    </div>
                    <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Purchases</h4>
                    </div>
                    <div class="card-body">
                        {{ $analytics->totalPurchase() }}
                    </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-danger">
                    <i class="far fa-shopping-cart"></i>
                    </div>
                    <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Sales</h4>
                    </div>
                    <div class="card-body">
                        {{ $analytics->totalSale() }}
                    </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-warning">
                        <i class="far fa-file"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Returned Purchases</h4>
                        </div>
                        <div class="card-body">
                            {{ $analytics->totalPurchaseReturn() }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-success">
                    <i class="fas fa-circle"></i>
                    </div>
                    <div class="card-wrap">
                    <div class="card-header">
                        <h4>Returned Sale</h4>
                    </div>
                    <div class="card-body">
                        {{ $analytics->totalSaleReturn() }}
                    </div>
                    </div>
                </div>
            </div>                  
        </div>

        <div class="row">
            <div class="col-lg-8 col-md-12 col-12 col-sm-12">
              <div class="card">
                <div class="card-header">
                  <h4>Trends</h4>
                  <div class="card-header-action">
                    <div class="btn-group">
                      <a href="#" class="btn btn-primary chart-toggle" data-filter="week">This Week</a>
                      <a href="#" class="btn chart-toggle" data-filter="month">Monthly</a>
                    </div>
                  </div>
                </div>
                <div class="card-body"><div class="chartjs-size-monitor" style="position: absolute; inset: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
                    <canvas id="myChart" height="400" width="829" class="chartjs-render-monitor" style="display: block; width: 829px; height: 502px;"></canvas>
                    <div class="statistic-details mt-sm-4">
                        <div class="statistic-details-item">
                            <!-- <span class="text-muted"><span class="text-primary"><i class="fas fa-caret-up"></i></span> 7%</span>
                            <div class="detail-value">$243</div>
                            <div class="detail-name">Today's Sales</div>
                            </div>
                            <div class="statistic-details-item">
                            <span class="text-muted"><span class="text-danger"><i class="fas fa-caret-down"></i></span> 23%</span>
                            <div class="detail-value">$2,902</div>
                            <div class="detail-name">This Week's Sales</div>
                            </div>
                            <div class="statistic-details-item">
                            <span class="text-muted"><span class="text-primary"><i class="fas fa-caret-up"></i></span>9%</span>
                            <div class="detail-value">$12,821</div>
                            <div class="detail-name">This Month's Sales</div>
                            </div>
                            <div class="statistic-details-item">
                            <span class="text-muted"><span class="text-primary"><i class="fas fa-caret-up"></i></span> 19%</span>
                            <div class="detail-value">$92,142</div>
                            <div class="detail-name">This Year's Sales</div> -->
                        </div>
                    </div>
                </div>
              </div>
            </div>

            <div class="col-lg-4">
              <div class="card gradient-bottom">
                <div class="card-header">
                  <h4>Top 5 Products</h4>
                  <div class="card-header-action dropdown">
                    <!-- <a href="#" data-toggle="dropdown" class="btn btn-danger dropdown-toggle">Month</a>
                    <ul class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                      <li class="dropdown-title">Select Period</li>
                      <li><a href="#" class="dropdown-item">Today</a></li>
                      <li><a href="#" class="dropdown-item">Week</a></li>
                      <li><a href="#" class="dropdown-item active">Month</a></li>
                      <li><a href="#" class="dropdown-item">This Year</a></li>
                    </ul> -->
                  </div>
                </div>
                <div class="card-body" id="top-5-scroll" tabindex="2" style="height: 315px; overflow: hidden; outline: none;">
                    <ul class="list-unstyled list-unstyled-border">

                        @foreach ($analytics->topProducts() as $product)
                        
                        <li class="media">
                            <img class="mr-3 rounded" width="55" src="{{ $product->product->image_url ?? asset('img/avatar.png') }}" alt="product">
                            <div class="media-body">
                                <div class="float-right">
                                    <div class="font-weight-600 text-muted text-small">{{ number_format($product->total_quantity) }} Units Sold</div>
                                </div>
                                <div class="media-title">{{ $product->product->name }}</div>
                                <div class="mt-1">
                                    <div class="budget-price">
                                        <div class="budget-price-square bg-primary" data-width="5%" style="width: 5%;"></div>
                                        <div class="budget-price-label">&#x20A6;{{ $analytics->shortenMoney($product->total_value) }}</div>
                                    </div>
                                </div>
                            </div>
                        </li>

                        @endforeach
                    </ul>
                </div>
                <div class="card-footer pt-3 d-flex justify-content-center">
                  <div class="budget-price justify-content-center">
                    <div class="budget-price-square bg-danger" data-width="20" style="width: 20px;"></div>
                    <div class="budget-price-label"><small>Figures does not include discounts</small></div>
                  </div>
                </div>
              </div>
            </div>
            
        </div>


        <div class="row">
            <div class="col-md-8">
              <div class="card">
                <div class="card-header">
                  <h4>Latest Sales Returns</h4>
                  <div class="card-header-action">
                    <a href="{{ route('sale.returned')}}" class="btn btn-danger">View All<i class="fas fa-chevron-right"></i></a>
                  </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive table-invoice">
                        <table class="table table-striped">
                            <tbody>
                                <tr>
                                    <th>Date</th>
                                    <th>Invoice ID</th>
                                    <th>Customer</th>
                                    <th>Amount</th>
                                </tr>

                                @foreach ($analytics->recentSaleReturns() as $return)
                                <tr>
                                    <td>{{ $return->date }}</td>
                                    <td>{{ $return->owner->invoice_no }}</td>
                                    <td>{{ $return->partner->name }}</td>
                                    <td>&#x20A6;{{ number_format($return->payable, 2) }}</td>
                                </tr>
                                    
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
              </div>
            </div>

            <div class="col-md-4">
              <div class="card card-hero">
                <div class="card-header">
                  <div class="card-icon">
                  <i class="fas fa-battery-quarter"></i>
                  </div>
                  <h4>{{ $analytics->productLow()->count() }}</h4>
                  <div class="card-description">Products are low on stock</div>
                </div>
                <div class="card-body p-0">
                  <div class="tickets-list">
                    @foreach ($analytics->productLow() as $product)
                    <a href="#" class="ticket-item">
                      <div class="ticket-title">
                        <h4>{{ $product->name }}</h4>
                      </div>
                      <div class="ticket-info">
                        <div>In Stock</div>
                        <div class="bullet"></div>
                        <div class="text-primary">{{ $product->totalInStock() }}</div>
                      </div>
                    </a>
                        
                    @endforeach
                    
                    
                    <a href="{{ route('product.products') }}" class="ticket-item ticket-more">
                      View All <i class="fas fa-chevron-right"></i>
                    </a>
                  </div>
                </div>
              </div>
            </div>
        </div>



       
    </section>
</div>


@endsection

@section('js')
<script src="{{ asset('js/chart.min.js') }}"></script>
<script>
var statistics_chart = document.getElementById("myChart").getContext('2d');

var dataSetMonths = JSON.parse('{!! $analytics->monthlyTrend() !!}').map( item => {
    return {
        label: item.label,
        data: item.data,
        backgroundColor: item.color,
        borderColor: 'transparent',
        borderWidth: 3
    }
})
const dataSetWeeks = JSON.parse('{!! $analytics->weeklyTrend() !!}').map( item => {
    return {
        label: item.label,
        data: item.data,
        backgroundColor: item.color,
        borderColor: 'transparent',
        borderWidth: 3
    }
})
var all = []
const allData = dataSetWeeks.forEach(element => {
    all = [...all, ...element.data]
})
const max = Math.max.apply(null, all) * 1.4
var chart = new Chart(statistics_chart, {
    type: 'bar',
    data: {
        labels: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
        datasets: dataSetWeeks
    },
    options: {
        legend: {
            display: true,
            position: 'bottom'
        },
        scales: {
            yAxes: [
                {
                    gridLines: {
                        display: false,
                        drawBorder: true,
                    },
                    ticks: {
                        stepSize: max
                    }
                }
            ],
            xAxes: [
                {
                    gridLines: {
                        color: '#fbfbfb',
                        lineWidth: 2
                    }
                }
            ]
        },
    }
})

$(".chart-toggle").on('click', function(e) {
    e.preventDefault()
    const filter = $(this).data('filter');
    const buttons = $(".chart-toggle")
    buttons.each(function(index, element) {
        $(element).removeClass("btn-primary")
    })
    $(this).addClass('btn-primary')
    if(filter == "week") {
        // chart.labels = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"]
        chart.data = {
            labels: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
            datasets: dataSetWeeks
        }
        var all = []
        const allData = dataSetWeeks.forEach(element => {
            all = [...all, ...element.data]
        })
        const max = Math.max.apply(null, all)
        chart.options.scales.yAxes[0].ticks.stepSize = max * 1.6
        chart.update()
    } else {
        chart.data = {
            labels: ["JAN", "FEB", "MAR", "APR", "MAY", "JUN", "JUL", "AUG", "SEP", "OCT", "NOV", "DEC"],
            datasets: dataSetMonths
        }
        var all = []
        const allData = dataSetWeeks.forEach(element => {
            all = [...all, ...element.data]
        })
        const max = Math.max.apply(null, all)
        chart.options.scales.yAxes[0].ticks.stepSize = max * 1.6
        chart.update()
    }
});
</script>

<!-- 
,
                {
                    label: 'Sales Returns',
                    data: [640, 387, 530, 302, 430, 270, 488],
                    borderWidth: 3,
                    borderColor: 'transparent',
                    backgroundColor: '#fc544b',
                    
                },
                {
                    label: 'Puchase',
                    data: [640, 387, 530, 302, 430, 270, 488],
                    borderWidth: 4,
                    borderColor: 'transparent',
                    backgroundColor: '#6777ef',
                    pointRadius: 4
                },
                {
                    label: 'Puchase Returns',
                    data: [640, 387, 530, 302, 430, 270, 488],
                    borderWidth: 3,
                    borderColor: 'transparent',
                    backgroundColor: '#ffa426',
                    pointRadius: 4
                } -->
@endsection