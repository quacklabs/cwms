@extends('layout')
@section('title') {{ config('app.name') }} | {{ $title }} @endsection

@section('css')
<link rel="stylesheet" href="{{ asset('css/selector.css') }}">
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ajax-bootstrap-select/1.4.5/css/ajax-bootstrap-select.min.css" integrity="sha512-k9D6Fzp2d9BxewMk+gYYmlGYxv7DLVC46DiCRv3DrAwBkbjSBZCnhBhWCugLuhkTS36QgQ3h7BwkkkfkJk7cXQ==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->

@endsection

@section('content')
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{$title }}</h1>
            <div class="section-header-button">
                <button class="btn btn-primary" data-toggle="modal" data-target="#myModal">Add New</button>
                <!-- <a href="#" class="btn btn-primary">Add New</a> -->
            </div>
            {{ Breadcrumbs::render('staff.managers') }}
            </div>
            <div class="section-body">
            <h2 class="section-title">Authorize Managers</h2>
            <p class="section-lead">
                Each manager must be assigned to a warehouse
            </p>
        </div>
    </section>
</div>

<style>
.modal-dialog {
  max-width: 70%;
  margin: 1.75rem auto;
}
</style>


<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content card">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Reassign Manager</h5>
                <a href="{{ route('warehouse.all_warehouses') }}" type="button" class="button">
                    <span aria-hidden="true">&times;</span>
                </a>
            </div>
            <hr>

            <div class="modal-body">
                <form method="post" action="{{ route('warehouse.reassign', ['id' => $warehouse->id]) }}">
                    @csrf
                    <div class="card-body">
                        <div class="form-row">
                            <div class="input-group row">
                                <select name="manager_id" class="selectpicker col-lg-8 col-md-8 col-8" data-live-search="true" data-live-search-id="searchInput">
                                @empty($managers)

                                    <option>No Managers Found</option>
                                @else

                                    @foreach ($managers as $manager)
                                    <option value="{{ $manager->id }}">{{ $manager->name }}
                                        
                                    @endforeach
                                    
                                @endempty
                                </select>
                                <div class="input-group-append col-4">
                                    <button type="submit" class="btn btn-primary" type="button">Save</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
<script src="{{ asset('js/selector.js') }}"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/ajax-bootstrap-select/1.4.5/js/ajax-bootstrap-select.min.js" integrity="sha512-HExUHcDgB9r00YwaaDe5z9lTFmTChuW9lDkPEnz+6/I26/mGtwg58OHI324cfqcnejphCl48MHR3SFQzIGXmOA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->
<script>
$(function() {
    $("#myModal").modal('show');
    
    $('.selectpicker').selectpicker({
        liveSearch: true,
    })

    $('input').on('input', function() {
    var searchQuery = $(this).val();
    alert

    // Perform AJAX request
    $.ajax({
      url: 'your_api_endpoint',
      method: 'GET',
      data: { search: searchQuery },
      success: function(response) {
        console.log(response)
        // Clear the previous options
        // $('#mySelect').find('option').remove();

        // // Add the retrieved options
        // $.each(response, function(index, option) {
        //   $('#mySelect').append('<option value="' + option.value + '">' + option.label + '</option>');
        // });

        // // Refresh Bootstrap Select
        // $('.selectpicker').selectpicker('refresh');
      },
      error: function(xhr, status, error) {
        // Handle error response
      }
    });
  });
    
    // .
    // 
    // ajaxSelectPicker({
    //     ajax: {
    //         url: "{{ route('api.managers') }}",
    //         data: function () {
    //             var params = {
    //                 q: ''
    //             };
    //             if(gModel.selectedGroup().hasOwnProperty('ContactGroupID')){
    //                 params.GroupID = gModel.selectedGroup().ContactGroupID;
    //             }
    //             return params;
    //         },
    //         locale: {
    //             emptyTitle: 'Search for manager...'
    //         },
    //     },
    // })


    // $('.selectpicker').on('input', function() {
    //   var searchQuery = $(this).val();

    //   // Make an API request to fetch the search results
    //   $.ajax({
    //     url: "{{ route('api.managers') }}",
    //     method: 'POST',
        
    //     headers: {
    //         'Authorization': 'Bearer ' + "{{ session('api_token') }}",
    //     },
    //     contentType: 'application/json',
    //     dataType: 'json',
    //     data: JSON.stringify({ search: searchQuery }),
    //     success: function(response) {
    //       // Clear the select options
    //     //   $('.selectepicker').empty();
    //       console.log(response)

    //       // Loop through the response data and append options to the select
    //     //   $.each(response.results, function(index, option) {
    //     //     $('.selectepicker').append('<option value="' + option.value + '">' + option.text + '</option>');
    //     //   });

    //       // Refresh the Bootstrap Selectpicker to reflect the updated options
    //     //   $('.selectpicker').selectpicker('refresh');
    //     },
    //     error: function(xhr, status, error) {
    //       console.error(error);
    //     }
    //   });
    // });
});
</script>
@endsection

