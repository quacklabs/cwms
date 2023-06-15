@extends('layout')
@section('title') {{ config('app.name') }} | {{ $title }} @endsection


@section('content')
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
        <h1>{{$title }}</h1>
        <div class="section-header-button">
            <button class="btn btn-primary" id="modal-5">Add New</button>
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
                            <th>Actions</th>
                          </tr>
                        </thead>
                        <tbody>   
                            @empty($managers)

                            @else
                                @foreach($managers as $manager)
                                
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
                                        {{ $manager->warehouse->first()->name }}
                                    </td>
                                    <td>
                                    <div class="buttons">
                                        @if($manager->status == true)
                                        <a href="#" class="btn btn-icon btn-danger" data-toggle="tooltip" data-placement="top" title="" data-original-title="Deactivate Account">
                                            <i class="fas fa-times"></i>
                                        </a>
                                        @else
                                        <a href="#" class="btn btn-icon btn-success" data-toggle="tooltip" data-placement="top" title="" data-original-title="Activate Account">
                                            <i class="fas fa-check"></i>
                                        </a>
                                        @endif

                                        <a href="#" class="btn btn-icon btn-primary" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit Account">
                                            <i class="far fa-edit"></i>
                                        </a>

                                        <a href="#" class="btn btn-icon btn-info" data-toggle="tooltip" data-placement="top" title="" data-original-title="Modify Permissions">
                                            <i class="fas fa-lock"></i>
                                        </a>

                                        <a href="#" class="btn btn-icon btn-info" data-toggle="tooltip" data-placement="top" title="" data-original-title="Reset Password">
                                            <i class="fas fa-key"></i>
                                        </a>
                                        


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
                    {{ $managers->links() }}
                </div>
                </div>
            </div>
            </div>
        </div>
        </div>
    </section>
</div>

<style>
.custom-modal {
  width: 70%;
}
</style>


<form class="modal-part" id="modal-login-part" action="{{ route('staff.managers') }}" method="post">
          <p></p>
    <div class="form-group">
    <label>Username</label>
    <div class="input-group">
        <div class="input-group-prepend">
        <div class="input-group-text">
            <i class="fas fa-at"></i>
        </div>
        </div>
        <input type="text" class="form-control" placeholder="username" name="username">
    </div>
    </div>
    <div class="form-group">
    <label>Password</label>
    <div class="input-group">
        <div class="input-group-prepend">
        <div class="input-group-text">
            <i class="fas fa-lock"></i>
        </div>
        </div>
        <input type="password" class="form-control" placeholder="Password" name="password">
    </div>
    </div>
    
</form>

@endsection

@section('js')
<script>
    $(function() {

        $("#modal-5").fireModal({
            title: 'Create Manager',
            body: $("#modal-login-part"),
            footerClass: 'bg-whitesmoke',
            autoFocus: false,
            onFormSubmit: function(modal, e, form) {
                return true
            },
            shown: function(modal, form) {
                console.log(form)
            },
            buttons: [
                {
                text: 'Save',
                submit: true,
                class: 'btn btn-primary btn-shadow',
                handler: function(modal) {
                    $("#modal-login-part").submit();
                }
                }
            ]
        });
    })
</script>

@endsection