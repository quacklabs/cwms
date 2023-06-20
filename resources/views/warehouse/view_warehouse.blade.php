@extends('layout')
@section('title') {{ config('app.name') }} | {{ $title }} @endsection

@section('css')
<link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap4.css') }}">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.bootstrap5.min.css">
<link rel="stylesheet" href="{{ asset('css/dataTables.buttons.css') }}">



@endsection

@section('content')

<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{$title }}</h1>
            
            {{ Breadcrumbs::render('warehouse.warehouse') }}
        </div>
        <div class="section-body">
            <h2 class="section-title">{{ $warehouse->name }}</h2>
            <p class="section-lead">
                View warehouse details
            </p>

        
            <div class="row mt-4">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h4>Jump To</h4>
                        </div>

                        <div class="col-12 card-body">
                            <ul class="nav nav-pills flex-column" id="myTab4" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="home-tab4" data-toggle="tab" href="#home4" role="tab" aria-controls="home" aria-selected="true">Details</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="profile-tab4" data-toggle="tab" href="#profile4" role="tab" aria-controls="profile" aria-selected="false">Staff</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="contact-tab4" data-toggle="tab" href="#contact4" role="tab" aria-controls="contact" aria-selected="false">Manager</a>
                            </li>
                            </ul>
                        </div>
                    </div>
                </div>

        

                <div class="col-md-8">
                    <div class="tab-content no-padding" id="myTab2Content">
                        <div class="tab-pane fade show active" id="home4" role="tabpanel" aria-labelledby="home-tab4">
                            <div class="card profile-widget">
                                <div class="profile-widget-header">                     
                                    <div class="rounded-circle profile-widget-picture">
                                    <svg  xmlns="http://www.w3.org/2000/svg" height="5em" viewBox="0 0 640 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M504 352H136.4c-4.4 0-8 3.6-8 8l-.1 48c0 4.4 3.6 8 8 8H504c4.4 0 8-3.6 8-8v-48c0-4.4-3.6-8-8-8zm0 96H136.1c-4.4 0-8 3.6-8 8l-.1 48c0 4.4 3.6 8 8 8h368c4.4 0 8-3.6 8-8v-48c0-4.4-3.6-8-8-8zm0-192H136.6c-4.4 0-8 3.6-8 8l-.1 48c0 4.4 3.6 8 8 8H504c4.4 0 8-3.6 8-8v-48c0-4.4-3.6-8-8-8zm106.5-139L338.4 3.7a48.15 48.15 0 0 0-36.9 0L29.5 117C11.7 124.5 0 141.9 0 161.3V504c0 4.4 3.6 8 8 8h80c4.4 0 8-3.6 8-8V256c0-17.6 14.6-32 32.6-32h382.8c18 0 32.6 14.4 32.6 32v248c0 4.4 3.6 8 8 8h80c4.4 0 8-3.6 8-8V161.3c0-19.4-11.7-36.8-29.5-44.3z"/></svg>
                                    </div>
                                    <div class="profile-widget-items">
                                        <div class="profile-widget-item">
                                            <div class="profile-widget-item-label">Products</div>
                                            <div class="profile-widget-item-value">0</div>
                                        </div>
                                        <div class="profile-widget-item">
                                            <div class="profile-widget-item-label">Staff</div>
                                            <div class="profile-widget-item-value">{{ count($warehouse->staff) }}</div>
                                        </div>
                                        <div class="profile-widget-item">
                                            <div class="profile-widget-item-label">Inventory</div>
                                            <div class="profile-widget-item-value">&#x20A6; 0.00</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="profile-widget-description pb-0 mb-5">
                                    <div class="profile-widget-name">{{ ucwords($warehouse->name) }}</div>
                                    <p><strong>Address: </strong>{{ $warehouse->address }}</p>
                                </div>
                                
                            </div>
                        </div>


                        <div class="tab-pane fade" id="profile4" role="tabpanel" aria-labelledby="profile-tab4">
                        @empty($warehouse->staff)
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Warehouse Staff</h4>
                                </div>
                                <div class="card-body">
                                    <div class="empty-state" data-height="400" style="height: 400px;">
                                        <div class="empty-state-icon">
                                            <i class="fas fa-question"></i>
                                        </div>
                                        <h2>We couldn't find any staff assigned</h2>
                                        <p class="lead">
                                            Sorry we can't find any data, to get rid of this message, assign at least one staff to this warehouse.
                                        </p>
                                        <a href="{{ route('staff.staff') }}" class="btn btn-primary mt-4">Create new One</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @else
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Warehouse Staff</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="dataTables_length col-6" id="myTable_length">
                                            <div class="row" style="display:inline-block;">
                                                <label>Show
                                                    <select name="myTable_length" aria-controls="myTable" class="custom-select custom-select-sm">
                                                        <option value="10">10</option>
                                                        <option value="25">25</option>
                                                        <option value="50">50</option>
                                                        <option value="100">100</option>
                                                    </select>
                                                </label>
                                            </div>
                                            
                                        </div>

                                        <div class="dataTables_filter col-6">
                                            <label>Search:
                                                <input type="search" class="form-control" placeholder="Enter keyword" aria-controls="myTable">
                                            </label>
                                        </div>
                                    </div>

                                    <div class="table-responsive">
                                        <table id="table-1" class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($warehouse->staff()->paginate(2) as $staff)
                                                <tr>
                                                    <td>{{ $staff->name }}</td>
                                                    <td>{{ ($staff->status == true) ? 'Active' : 'Inactive' }}</td>
                                                </tr>
                                                
                                                @endforeach

                                                
                                                <!-- Table body content -->
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="card-footer">
                                    <div class="float-right">
                                        {{ $warehouse->staff()->paginate(2)->links() }}
                                    </div>
                                </div>
            
                            </div>
                        </div>
                        @endempty
                        </div>
                        <div class="tab-pane fade" id="contact4" role="tabpanel" aria-labelledby="contact-tab4">
                            <div class="card profile-widget">
                                <div class="profile-widget-header">                     
                                    <img alt="image" src="http://localhost:8080/stisla-codeigniter/assets/img/avatar/avatar-1.png" class="rounded-circle profile-widget-picture">
                                    <div class="profile-widget-items">
                                        <!-- <div class="profile-widget-item">
                                            <div class="profile-widget-item-label">Products</div>
                                            <div class="profile-widget-item-value">0</div>
                                        </div>
                                        <div class="profile-widget-item">
                                            <div class="profile-widget-item-label">Staff</div>
                                            <div class="profile-widget-item-value">{{ count($warehouse->staff) }}</div>
                                        </div>
                                        <div class="profile-widget-item">
                                            <div class="profile-widget-item-label">Inventory</div>
                                            <div class="profile-widget-item-value">&#x20A6; 0.00</div>
                                        </div> -->
                                    </div>
                                </div>
                                <div class="profile-widget-description pb-0 mb-5">
                                    <div class="profile-widget-name">{{ ucwords($warehouse->manager->name) }}</div>
                                    <p><strong>Date Created: </strong>{{ $warehouse->manager->created_at }}</p>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                        
                    </div>
            </div>
        </div>
    </section>
</div>


@endsection

@section('js')
<script src="{{ asset('js/jquery.dataTables.js') }}"></script>
<script src="{{ asset('js/dataTables.bootstrap4.js') }}"></script>
<script src="{{ asset('js/bootstrap.buttons.js') }}"></script>
<script src="{{ asset('js/dataTables.buttons.js') }}"></script>
<script>
    $("[data-checkboxes]").each(function() {
  var me = $(this),
    group = me.data('checkboxes'),
    role = me.data('checkbox-role');

  me.change(function() {
    var all = $('[data-checkboxes="' + group + '"]:not([data-checkbox-role="dad"])'),
      checked = $('[data-checkboxes="' + group + '"]:not([data-checkbox-role="dad"]):checked'),
      dad = $('[data-checkboxes="' + group + '"][data-checkbox-role="dad"]'),
      total = all.length,
      checked_length = checked.length;

    if(role == 'dad') {
      if(me.is(':checked')) {
        all.prop('checked', true);
      }else{
        all.prop('checked', false);
      }
    }else{
      if(checked_length >= total) {
        dad.prop('checked', true);
      }else{
        dad.prop('checked', false);
      }
    }
  });
});
    $(function() {
        $("#table-1").DataTable({
            paging: true,
            searching: true,
            dom: 'Bfrtip',
            // Add more options as needed
        });
    })
    
</script>
@endsection