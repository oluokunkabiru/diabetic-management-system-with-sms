@extends('users.layout.app')
@section('title', 'Manage roles')
@section('content')


    <section class="section">
        <div class="section-header">
            <h1 class="text-center font-weight-bold"> Manage roles</h1>
        </div>
        <div class="container">

            <div class="card">
                @if(session('success'))
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>Success! </strong> {{ session('success') }}
                </div>
                @endif

                @if(session('delete'))
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>Success! </strong> {{ session('delete') }}
                </div>
                @endif

                @if ($errors->any())

                <div class="alert alert-danger alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong style="font-size:20px;">Oops!
                        {{ 'Kindly rectify below errors' }}</strong><br />
                    @foreach ($errors->all() as $error)
                        {{ $error }} <br />
                    @endforeach
                </div>
            @endif
                <div class="card-body">
                    <a href="#addrole" data-toggle="modal" class="btn btn-success text-uppercase ">Add role</a>
                    <div class="table-responsive">
                        <table class="table table-striped v_center" id="table-1">

                            <thead>
                                <tr>
                                    <th class="text-center">
                                        ID
                                    </th>
                                    <th>Role</th>
                                    <th>Expiring date</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 0;
                                @endphp
                                @forelse ($roles as $role)
 <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ ucwords($role->name) }}</td>
                                    <td>{{ $role->created_at }}</td>
                                <td>
                                    <div class="row">
                                        <a href="#editrole" rolename="{{ ucwords($role->name) }}" editurl="{{ route('role.update', $role->id) }}" data-toggle="modal" class="badge badge-pill badge-warning mx-1"><span
                                                class="fa fa-edit p-1 text-white"></span></a>
                                        <a href="#deleterole" data-toggle="modal" rolename="{{ ucwords($role->name) }}" deurl="{{ route('role.destroy', $role->id) }}"
                                            class="badge badge-pill badge-danger mx-1"><span
                                                class="fa fa-trash p-1 text-white"></span></a>
                                    </div>
                                </td>
                                </tr>

                                @empty
                                    <h3 class="text-danger"> No roles available at moment</h3>
                                @endforelse



                            </tbody>
                        </table>

                    </div>

                </div>

            </div>


        </div>




    </section>
    {{--  add role  --}}

 <div class="modal" id="addrole">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title text-uppercase">Add role</h4>
                <button type="button" class="btn btn-danger" data-dismiss="modal">&times;</button>
            </div>
        <form action="" action="{{ route('role.store') }}" method="POST">

            <!-- Modal body -->
            <div class="modal-body">


                    {{ csrf_field() }}


                    <!-- Modal footer -->
                    <div class="form-group">
                        <label for="usr">Role name:</label>
                        <input id="username" type="text"
                        class="form-control @error('role') is-invalid @enderror" name="role"
                        value="{{ old('role') }}" required autocomplete="role">
                    @if ($errors->has('role'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('role') }}</strong>
                        </span>
                    @endif
                </div>

            </div>
            <div class="modal-footer">
                <button class="btn btn-danger float-left mx-2" data-dismiss="modal">Cancel</button>
                <button id="addcategorybtn" type="submit" class="btn  btn-success text-uppercase">Add role</button>
            </div>

        </form>
        </div>
    </div>
</div>

{{--  end of add role  --}}



{{--  edit role  --}}

<div class="modal" id="editrole">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title text-uppercase">edit role</h4>
                <button type="button" class="btn btn-danger" data-dismiss="modal">&times;</button>
            </div>
        <form id="editroleform" action="" method="POST">

            <!-- Modal body -->
            <div class="modal-body">


                    {{ csrf_field() }}
                    @method('PUT')


                    <!-- Modal footer -->
                    <div class="form-group">
                        <label for="usr">Role name:</label>
                        <input type="text"
                        class="form-control @error('role') is-invalid @enderror" id="rolename" name="role"
                        value="{{ old('role') }}" required autocomplete="role">
                    @if ($errors->has('role'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('role') }}</strong>
                        </span>
                    @endif
                </div>

            </div>
            <div class="modal-footer">
                <button class="btn btn-danger float-left mx-2" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn  btn-success text-uppercase">Update role</button>
            </div>

        </form>
        </div>
    </div>
</div>

{{--  end of edit role  --}}

{{--  add role  --}}

<div class="modal" id="deleterole">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title text-uppercase">Delete role : <span id="deleterolename"></span></h4>
                <button type="button" class="btn btn-danger" data-dismiss="modal">&times;</button>
            </div>
        <form id="deleteroleform" action="" method="POST">

            <!-- Modal body -->
            <div class="modal-body">
                    {{ csrf_field() }}
                    @method('DELETE')
            </div>
            <div class="modal-footer">
                <button class="btn btn-success float-left mx-2" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-danger text-uppercase">Delete role</button>
            </div>

        </form>
        </div>
    </div>
</div>

{{--  end of edit role  --}}
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $('#editrole').on('show.bs.modal', function(e) {
            var rolename = $(e.relatedTarget).attr('rolename');
            var editurl = $(e.relatedTarget).attr('editurl');
            $("#rolename").val(rolename);
            $("#editroleform").attr("action", editurl);
        })



        $('#deleterole').on('show.bs.modal', function(e) {
            var rolename = $(e.relatedTarget).attr('rolename');
            var deleteurl = $(e.relatedTarget).attr('deurl');
            $("#deleterolename").text(rolename);
            $("#deleteroleform").attr("action", deleteurl);
        })

        })
    </script>
@endsection
