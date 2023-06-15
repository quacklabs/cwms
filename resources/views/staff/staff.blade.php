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
        {{ Breadcrumbs::render('staff.staff') }}
        </div>
        <div class="section-body">
        <h2 class="section-title">Manage Warehouse Staff</h2>
        <p class="section-lead">
            Each staff are assigned to a warehouse
        </p>

        
        <div class="row mt-4">
            <div class="col-12">
            <div class="card">
                <div class="card-header">
                <h4>All Staff</h4>
                </div>
                <div class="card-body">
                <div class="clearfix mb-3"></div>

                <div class="table-responsive">
                      <table class="table table-striped" id="table-1">
                        <thead>                                 
                          <tr>
                            <th>Name</th>
                            <th>Username</th>
                            <th>E-mail</th>
                            <th>Assigned to</th>
                            <th>Status</th>
                            <th>Actions</th>
                          </tr>
                        </thead>
                        <tbody>   
                            @empty($managers)

                            @else
                                @foreach($managers as $manager)
                                <tr>
                                    <td>{{ $manager->name }}</td>
                                    <td>{{ $manager->username }}</td>
                                    <td>{{ $manager->email }}</td>
                                    <td>
                                        {{ $manager->warehouse->first()->name }}
                                    </td>
                                    <td>
                                        @if($manager->status == true)
                                        <div class="badge badge-success">Active</div>
                                        @else
                                        <div class="badge badge-warning">Inactive</div>
                                        @endif
                                    </td>

                                    <td>

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


<form class="modal-part" id="modal-login-part">
    <p>This login form is taken from elements with <code>#modal-login-part</code> id.</p>
    <div class="form-group">
    <label>Username</label>
    <div class="input-group">
        <div class="input-group-prepend">
        <div class="input-group-text">
            <i class="fas fa-envelope"></i>
        </div>
        </div>
        <input type="text" class="form-control" placeholder="Email" name="email">
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
    <div class="form-group mb-0">
    <div class="custom-control custom-checkbox">
        <input type="checkbox" name="remember" class="custom-control-input" id="remember-me">
        <label class="custom-control-label" for="remember-me">Remember Me</label>
    </div>
    </div>
</form>

@endsection

@section('css')

@endsection

@section('js')
<script src="{{ asset('js/prism.js') }}"></script>


<script>
    $(function() {
        $("#modal-5").fireModal({
            title: 'Login',
            body: $("#modal-login-part"),
            footerClass: 'bg-whitesmoke',
            autoFocus: false,
            onFormSubmit: function(modal, e, form) {
                // Form Data
                let form_data = $(e.target).serialize();
                console.log(form_data)

                // DO AJAX HERE
                let fake_ajax = setTimeout(function() {
                form.stopProgress();
                modal.find('.modal-body').prepend('<div class="alert alert-info">Please check your browser console</div>')

                clearInterval(fake_ajax);
                }, 1500);

                e.preventDefault();
            },
            shown: function(modal, form) {
                console.log(form)
            },
            buttons: [
                {
                text: 'Login',
                submit: true,
                class: 'btn btn-primary btn-shadow',
                handler: function(modal) {
                }
                }
            ]
        });
    })
</script>

@endsection