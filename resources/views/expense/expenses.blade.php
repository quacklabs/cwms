@extends('layout')
@section('title') {{ config('app.name') }} | {{ $title }} @endsection

@section('content')
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
        <h1>{{$title }}</h1>
        @can('create-expense')
        <div class="section-header-button">
            <button class="btn btn-primary" data-toggle="modal" data-target="#myModal">Add New</button>
            <!-- <a href="#" class="btn btn-primary">Add New</a> -->
        </div>
        @endcan
        
        {{ Breadcrumbs::render() }}
        </div>
        <div class="section-body">
        <h2 class="section-title">Manage Expenses</h2>
        <!-- <p class="section-lead">
            Each staff must be assigned to a partner
        </p> -->

        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        
        <div class="row mt-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>All Expenses</h4>
                        <div class="card-header-form">
                            <form>
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <div class="input-group-btn">
                                        <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <tbody>
                                    <tr>
                                        <th>S.N</th>
                                        <th>Date</th>
                                        <th>Type</th>
                                        <th>Amount</th>
                                        <th>Created By</th>
                                        <th>Actions</th>
                                    </tr>

                                    @empty($types)

                                    @else
                                        @foreach($expenses as $expense)
                                        
                                        <tr>
                                            <td>
                                                {{ $loop->iteration }}
                                            </td>
                                            <td>{{ $expense->date }}</td>
                                            <td>
                                                {{ ucwords($expense->type->name) }}
                                            </td>

                                            <td>
                                                {{ number_format($expense->amount,2) }}
                                            </td>

                                            <td>
                                                {{ $expense->staff->name }}
                                            </td>
                                            
                                            <td>
                                                <div class="buttons">
                                                    @can('delete-expense')
                                                        <a href="{{ route('expense.delete_type', ['id' => $expense->type->id]) }}" class="btn btn-icon btn-danger" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete Expense Type">
                                                            <i class="fas fa-trash"></i>
                                                        </a>
                                                    @endcan
                                                    <a href="{{ route('expense.download', ['id' => $expense->id]) }}" class="btn btn-icon btn-dark" data-toggle="tooltip" data-placement="top" title="" data-original-title="Download Invoice">
                                                        <i class="fas fa-download"></i>
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
                    </div>

                    <div class="card-footer">
                        <div class="float-right">
                            @empty($expenses)

                            @else
                                {{ $expenses->links() }}
                            @endempty
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<style>
.modal-dialog {
  max-width: 50%;
  margin: auto;
}
</style>


<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content card">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Add Expense Type</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <hr>
            

            <div class="modal-body">
                <form id="productForm" method="post" action="{{ route('expense.expenses') }}">
                    @csrf
                    <div class="card-body">
                            
                        <div class="form-group row">
                            <label for="site-title" class="form-control-label text-md-right col-sm-3">Date</label>
                            <div class="col-sm-6 col-md-9">
                            <input name="date" type="text" name="site_title" class="form-control" id="site-title" value="{{ date('d-m-Y') }}" required>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                            
                        <div class="form-group row">
                            <label for="site-title" class="form-control-label text-md-right col-sm-3">Amount</label>
                            <div class="col-sm-6 col-md-9">
                            <input name="amount" type="text" name="site_title" class="form-control" id="site-title" required>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                            
                        <div class="form-group row">
                            <label for="site-title" class="form-control-label text-md-right col-sm-3">Expense Type</label>
                            <div class="col-sm-6 col-md-9">
                            <select class="form-control" name="type_id">
                                @empty($types)
                                
                                @else
                                    @foreach ($types as $type)
                                    <option value="{{$type->id}}"> {{ $type->name }}</option>
                                        
                                    @endforeach
                                @endempty
                            </select>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary btn-lg">Save</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

@endsection


@section('js')

@endsection