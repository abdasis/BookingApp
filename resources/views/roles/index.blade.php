@extends('layouts.app')


@section('content')

<div class="row">
    <div class="col-lg-12 margin-tb">
        {{-- <div class="pull-left">
            <h2>Role Management</h2>
        </div> --}}
        {{-- <div class="pull-right">
        @can('role-create')
            <a class="btn btn-success" href="{{ route('roles.create') }}"> Create New Role</a>
            @endcan
        </div> --}}
    </div>
</div>
<div class="nk-block nk-block-lg">
    <div class="nk-block-head">
        <div class="nk-block-head-content">

            <div class="nk-block-des">

            </div>
             <div class="text-right">
<button type="button" class="btn btn-primary" style="background-color:#6b6ef5;" data-bs-toggle="modal" data-bs-target="#modalForm">Create New Role</button>
</div>
        </div>
    </div>

    <div class="card card-bordered card-preview">

        <div class="card-inner">

                <thead>

                    @if ($message = Session::get('success'))
                    <script>
                      Swal.fire({
                        icon: 'success',
                        title: 'success',
                        text: '{{ $message }}',
                      });
                    </script>
                    @endif

                    <table class="datatable-init-export nowrap table" data-export-title="Export">
                        <thead>
  <tr>
     <th>No</th>
     <th>Name</th>
     <th width="280px">Action</th>
  </tr>
</thead>
<tbody>
    @foreach ($roles as $key => $role)
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $role->name }}</td>
        <td>
            <a class="btn btn-info" href="{{ route('roles.show',$role->id) }}">Show</a>
            @can('role-edit')
                <a class="btn btn-primary" style="background-color:#6b6ef5;" href="{{ route('roles.edit',$role->id) }}">Edit</a>
            @endcan
            @can('role-delete')
                {!! Form::open(['method' => 'DELETE','route' => ['roles.destroy', $role->id],'style'=>'display:inline']) !!}
                    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                {!! Form::close() !!}
            @endcan
        </td>
    </tr>
   @endforeach
                                                      </tbody>
                                                  </table>
                                              </div>
                                          </div><!-- .card-preview -->
                                      </div> <!-- nk-block -->


{!! $roles->render() !!}
<div class="modal fade" id="modalForm">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create New Role</h5>
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
               {!! Form::open(array('route' => 'roles.store','method'=>'POST')) !!}
               <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Name:</strong>
                        {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Permission:</strong>
                        <br/>
                        @foreach($permission as $value)
                            <label>{{ Form::checkbox('permission[]', $value->name, false, array('class' => 'name')) }}
                            {{ $value->name }}</label>
                        <br/>
                        @endforeach
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn-primary" style="background-color:#6b6ef5;">Submit</button>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
        <div class="modal-footer bg-light">
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">

</div>
        </div>
    </div>
</div>
</div>
@endsection



{{-- <p class="text-center text-primary"><small>..</small></p>
@endsection --}}
