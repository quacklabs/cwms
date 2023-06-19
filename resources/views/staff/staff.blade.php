@extends('layout')
@section('title') {{ config('app.name') }} | {{ $title }} @endsection

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
        {{ Breadcrumbs::render('staff.staff') }}
        </div>
        <div class="section-body">
        <h2 class="section-title">Authorize staff</h2>
        <p class="section-lead">
            Each staff must be assigned to a warehouse
        </p>

        
        <div class="row mt-4">
            <div class="col-12">
            <div class="card">
                <div class="card-header">
                <h4>All staffs</h4>
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
                            <th>Actions</th>
                          </tr>
                        </thead>
                        <tbody>   
                            @empty($staffs)

                            @else
                                @foreach($staffs as $staff)
                                
                                <tr>
                                    <td class="pricing-item">
                                        @if($staff->status == true)
                                        <div class="pricing-details">
                                            <div class="pricing-item">
                                                <div class="pricing-item-icon bg-success text-white px-1" style="border-radius: 50%; height: 20px; width: 20px;">
                                                    <i class="fas fa-check"></i>
                                                </div>
                                            </div>
                                        </div>

                                        @else
                                        <div class="pricing-item-icon bg-danger text-white px-1" style="border-radius: 50%; height: 20px; width: 20px;">
                                            <i class="fas fa-times"></i>
                                        </div>
                                        @endif
                                    </td>
                                    <td>{{ $staff->name }}</td>
                                    <td>{{ $staff->username }}</td>
                                    <td>{{ $staff->email }}</td>
                                    <td>
                                        {{ $staff->warehouse->first()->name ?? 'None' }}
                                    </td>
                                    <td>
                                    <div class="buttons">
                                        @if($staff->status == true)
                                        <a href="{{ route('staff.toggle', ['id' => $staff->id, 'action' => 'suspend']) }}" class="btn btn-icon btn-warning" data-toggle="tooltip" data-placement="top" title="" data-original-title="Deactivate Account">
                                            <i class="fas fa-times"></i>
                                        </a>
                                        @else
                                        <a href="{{ route('staff.toggle', ['id' => $staff->id, 'action' => 'activate']) }}" class="btn btn-icon btn-success" data-toggle="tooltip" data-placement="top" title="" data-original-title="Activate Account">
                                            <i class="fas fa-check"></i>
                                        </a>
                                        @endif

                                        <a href="{{ route('staff.edit_user', ['id' => $staff->id]) }}" class="btn btn-icon btn-primary" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit Account">
                                            <i class="far fa-edit"></i>
                                        </a>

                                        <a href="{{ route('access.byUser', ['id' => $staff->id]) }}" class="btn btn-icon btn-info" data-toggle="tooltip" data-placement="top" title="" data-original-title="Modify Permissions">
                                            <i class="fas fa-lock"></i>
                                        </a>
                                        @can('delete-staff')
                                        <a href="{{ route('staff.delete_user', ['id' => $staff->id]) }}" class="btn btn-icon btn-danger" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete Account">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                        @endrole
                                        


                                        <!-- <a href="#" class="btn btn-icon btn-secondary" data-toggle="tooltip" data-placement="top" title="" data-original-title="Vivamus sagittis lacus vel augue laoreet rutrum faucibus."><i class="far fa-user"></i></a>
                                        <a href="#" class="btn btn-icon btn-info" data-toggle="tooltip" data-placement="top" title="" data-original-title="Vivamus sagittis lacus vel augue laoreet rutrum faucibus."><i class="fas fa-info-circle"></i></a>
                                        <a href="#" class="btn btn-icon btn-warning" data-toggle="tooltip" data-placement="top" title="" data-original-title="Vivamus sagittis lacus vel augue laoreet rutrum faucibus."><i class="fas fa-exclamation-triangle"></i></a>
                                        <a href="#" class="btn btn-icon btn-danger" data-toggle="tooltip" data-placement="top" title="" data-original-title="Vivamus sagittis lacus vel augue laoreet rutrum faucibus."><i class="fas fa-times"></i></a>
                                        <a href="#" class="btn btn-icon btn-success" data-toggle="tooltip" data-placement="top" title="" data-original-title="Vivamus sagittis lacus vel augue laoreet rutrum faucibus."><i class="fas fa-check"></i></a>
                                        <a href="#" class="btn btn-icon btn-light" data-toggle="tooltip" data-placement="top" title="" data-original-title="Vivamus sagittis lacus vel augue laoreet rutrum faucibus."><i class="fas fa-star"></i></a>
                                        <a href="#" class="btn btn-icon btn-dark" data-toggle="tooltip" data-placement="top" title="" data-original-title="Vivamus sagittis lacus vel augue laoreet rutrum faucibus."><i class="far fa-file"></i></a> -->
                                    </div>

                                    </td>
                                </tr>
                                @endforeach

                            @endempty
                        </tbody>
                      </table>
                    </div>
                <div class="float-right">
                    {{ $staffs->links() }}
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
                <h5 class="modal-title" id="myModalLabel">Add staff</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <hr>

            <div class="modal-body">
                <form method="post" action="{{ route('staff.staff') }}">
                    @csrf
                    <div class="card-body">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Full Name</label>
                                <input name="name" type="text" class="form-control" autocomplete="off" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputPassword4">Username</label>
                                <input name="username" type="text" class="form-control" autocomplete="off" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Email</label>
                                <input name="email" type="email" class="form-control" autocomplete="off" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputPassword4">Password</label>
                                <input name="password" type="password" class="form-control"  autocomplete="off" required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Mobile No</label>
                                <input name="mobile"type="text" class="form-control" autocomplete="off" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputState">Asigned To Warehouse</label>
                                <select id="inputState" class="form-control">
                                    <option>Choose...</option>
                                    @empty($warehouses)

                                    @else
                                        @foreach($warehouses as $warehouse)



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