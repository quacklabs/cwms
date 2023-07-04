@extends('layout')
@section('title') {{ config('app.name') }} | {{ $title }} @endsection

@section('css')
<link rel="stylesheet" href="{{ asset('css/iziToast.css') }}">

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

        
        <div class="row mt-4">
            <div class="col-12">
            <div class="card">
                <div class="card-header">
                <h4>All Managers</h4>
                </div>
                <div class="card-body">
                <div class="clearfix mb-3"></div>

                <div class="table-responsive">
                      <table class="table table-striped" id="table-1">
                        <thead>                                 
                          <tr>
                            <th></th>
                            <th>Name</th>
                            <th>Username</th>
                            <th>E-mail</th>
                            <th>Assigned to</th>
                          </tr>
                        </thead>
                        <tbody>   
                            <tr>
                                <td class="pricing-item">
                                    @if($manager->status == true)
                                    <div class="pricing-details">
                                        <div class="pricing-item">
                                            <div class="pricing-item-icon bg-success text-white">
                                                <i class="fas fa-check"></i>
                                            </div>
                                        </div>
                                    </div>

                                    @else
                                    <div class="pricing-item-icon bg-danger text-white">
                                        <i class="fas fa-times"></i>
                                    </div>
                                    @endif
                                </td>
                                <td>{{ $manager->name }}</td>
                                <td>{{ $manager->username }}</td>
                                <td>{{ $manager->email }}</td>
                                <td>
                                    {{ $manager->warehouse->name ?? 'None' }}
                                </td>
                            </tr>
                        </tbody>
                      </table>
                    </div>
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
  margin: 1.75rem auto;
}
</style>


<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content card">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Edit Account</h5>
                <a href="{{ route('staff.managers') }}" type="button" class="button">
                    <span aria-hidden="true">&times;</span>
                </a>
            </div>
            <hr>

            <div class="modal-body">
                <form method="post" action="{{ route('staff.edit_user', ['id' => $manager->id, 'action' => '']) }}">
                    @csrf
                    <div class="card-body">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Full Name</label>
                                <input value="{{ $manager->name }}" name="name" type="text" class="form-control" autocomplete="off" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputPassword4">Username</label>
                                <input value="{{ $manager->username }}" name="username" type="text" class="form-control" autocomplete="off" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Email</label>
                                <input name="email" value="{{ $manager->email }}" type="email" class="form-control" autocomplete="off" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputPassword4">Password</label>
                                <input name="password" type="password" class="form-control"  autocomplete="off">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Mobile No</label>
                                <input value="{{ $manager->mobile }}" name="mobile"type="text" class="form-control" autocomplete="off" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputState">Asigned To Warehouse</label>
                                <select id="inputState" class="form-control">
                                    @if($manager->warehouse != null)
                                    <option value="{{ $manager->warehouse->first()->id }}">{{ $manager->warehouse->first()->name }}</option>
                                    @endif
                                    <option>Choose...</option>
                                    @empty($warehouses)

                                    @else
                                        @foreach($warehouses as $warehouse)
                                        <option value="{{ $warehouse->id }}">{{ $warehouse->name }}</option>



                                        @endforeach
                                    @endempty
                                </select>
                                <!-- <input type="password" class="form-control" id="inputPassword4" placeholder="Password"> -->
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')

<script>
$(function() {
    $("#myModal").modal('show');
});
</script>
@endsection