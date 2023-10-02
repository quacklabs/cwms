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
                            <div class="card-stats-item-count">0</div>
                            <div class="card-stats-item-label">Pending</div>
                            </div>
                            <div class="card-stats-item">
                            <div class="card-stats-item-count">0</div>
                            <div class="card-stats-item-label">Completed</div>
                            </div>
                            <div class="card-stats-item">
                            <div class="card-stats-item-count">0</div>
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
                            0
                            <span class="text-right ml-auto inline float-right text-primary">
                            &#x20A6;0
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
                        <div class="card-stats-item-count">0</div>
                        <div class="card-stats-item-label">Pending</div>
                        </div>
                        <div class="card-stats-item">
                        <div class="card-stats-item-count">0</div>
                        <div class="card-stats-item-label">Completed</div>
                        </div>
                        <div class="card-stats-item">
                        <div class="card-stats-item-count">0</div>
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
                        0
                        <span class="text-right ml-auto inline float-right text-primary">
                        &#x20A6;0
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
                <div class="card-icon shadow-primary bg-dark">
                  <i class="fas">&#x20A6;</i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Total Sales - {{ date('Y') }}</h4>
                  </div>
                  <div class="card-body">
                  0
                  </div>
                </div>
              </div>
            </div>


            <div class="col-lg-6 col-md-6 col-sm-12">
              <div class="card card-statistic-2">
                <div class="card-chart"><div class="chartjs-size-monitor" style="position: absolute; inset: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
                  <canvas id="sales-chart" height="77" width="327" class="chartjs-render-monitor" style="display: block; width: 327px; height: 77px;"></canvas>
                </div>
                <div class="card-icon shadow-primary bg-dark">
                  <i class="fas">&#x20A6;</i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Total Purchase - {{ date('Y') }}</h4>
                  </div>
                  <div class="card-body">
                  0
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
                        0
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
                        0
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
                            0
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
                        0
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
                    <a href="#" data-toggle="dropdown" class="btn btn-danger dropdown-toggle">This Month</a>
                    <ul class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                      <!-- <li class="dropdown-title">Select Period</li>
                      <li><a href="#" class="dropdown-item">Today</a></li>
                      <li><a href="#" class="dropdown-item">Week</a></li> -->
                      <li><a href="#" class="dropdown-item active">Month</a></li>
                      <!-- <li><a href="#" class="dropdown-item">This Year</a></li> -->
                    </ul>
                  </div>
                </div>
                <div class="card-body" id="top-5-scroll" tabindex="2" style="height: 315px; overflow: hidden; outline: none;">
                    <ul class="list-unstyled list-unstyled-border">

                       
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
                  <h4>0</h4>
                  <div class="card-description">Products are low on stock</div>
                </div>
                <div class="card-body p-0">
                  <div class="tickets-list">
                    
                    
                    
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