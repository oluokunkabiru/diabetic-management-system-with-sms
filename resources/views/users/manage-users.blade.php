{{--  @if (Spatie\Permission\Models\Role::findByName(Auth::user()->getRoleNames()[0])->hasPermissionTo("view users"))  --}}
@extends('users.layout.app')
@section('title', 'Manage users')
@section('content')


    <section class="section">
        <div class="section-header">
            <h1 class="text-center font-weight-bold"> Manage users</h1>
        </div>
        <div class="container">

            <div class="card">
                @if(session('success'))
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>Success! </strong> {{ session('success') }}
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
                    {{--  @if ($authrole->hasPermissionTo("add user"))  --}}
                    <a href="{{ route('user-management.create') }}"  class="btn btn-success text-uppercase ">Add new users</a>
                    {{--  @endif  --}}
                    <div class="table-responsive">
                        <table class="table table-striped v_center" id="userslist">

                            <thead>
                                <tr>
                                    <th class="text-center">
                                        ID
                                    </th>
                                    <th>Name</th>
                                    <th>Phone number</th>
                                    <th>Address</th>
                                    <th>Role</th>
                                    <th>Register date</th>
                                    <th>Avatar</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 0;
                                @endphp
                                @forelse ($users as $user)
                                 <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ ucwords($user->name) }}</td>
                                    <td>{{  ucwords($user->phone) }} </td>
                                    <td>{{  ucwords($user->address) }}</td>
                                    <td>{{  ucwords($user->getRoleNames()[0]) }} </td>
                                    <td>{{ $user->created_at }}</td>
                                    <td> <img src="{{ $user->getMedia('avatar')->first()?$user->getMedia('avatar')->first()->getFullUrl():asset('assets/users/assets/img/avatar/avatar-1.png')}}" class="card-img rounded w-50"> </td>
                                <td>
                                    <div class="row">
                                        {{-- view motorcycle details --}}
                                        {{--  @if ($authrole->hasPermissionTo("view users"))  --}}


                                        <a href="#viewuser" data-toggle="modal" name="{{ ucwords($user->name) }}" username="{{  ucwords($user->username) }}" phone="{{ ucwords($user->phone) }}"
                                            imgurl="{{ $user->getMedia('avatar')->first()?$user->getMedia('avatar')->first()->getFullUrl():asset('assets/users/assets/img/avatar/avatar-1.png')}}" role="{{ ucwords($user->getRoleNames()[0]) }}" deurl="{{ route('user-management.destroy', $user->id) }}" email="{{ $user->email }}" title="Delete motorcycle details"
                                            status="{{ ucwords($user->status) }}" class="badge badge-pill badge-primary mx-1"><span
                                                class="fa fa-eye p-1 text-white"></span></a>
                                               {{--  @endif  --}}

                                               @if ($user->status =="active")

                                               <a href="#disableduser" status="{{ ucwords($user->status) }}" role="{{ ucwords($user->getRoleNames()[0]) }}" durl="{{ route('disabled-user', $user->id) }}" data-toggle="modal" name="{{ $user->name }}" email="{{ $user->email }}" phone="{{ $user->phone }}" img="{{ $user->getMedia('avatar')->first()?$user->getMedia('avatar')->first()->getFullUrl():asset('assets/users/assets/img/avatar/avatar-1.png') }}">
                                                <span class="badge badge-pill badge-info"><i
                                                        class="fa fa-flag-checkered" data-toggle="tooltip" title="Disable user"></i></span>
                                            </a>
                                            @else
                                            <a href="#enableduser" status="{{ ucwords($user->status) }}"  role="{{ ucwords($user->getRoleNames()[0]) }}" eurl="{{ route('enable-user', $user->id) }}" data-toggle="modal" name="{{ $user->name }}" email="{{ $user->email }}" phone="{{ $user->phone }}" img="{{ $user->getMedia('avatar')->first()?$user->getMedia('avatar')->first()->getFullUrl():asset('assets/users/assets/img/avatar/avatar-1.png') }}" >
                                                <span class="badge badge-pill badge-warning"><i
                                                        class="fa fa-frown" data-toggle="tooltip" title="Enable user"></i></span>
                                            </a>
                                            @endif


                                        {{-- end of view motorcycle details --}}
                                        {{-- Edit motorcycle --}}
                                        {{-- <a href="" class="badge badge-pill badge-warning mx-1"><span
                                                class="fa fa-edit p-1 text-white"></span></a> --}}

                                        {{-- delete motorcycle --}}
                                        <a href="#addroleuser" status="{{ ucwords($user->status) }}"  role="{{ ucwords($user->getRoleNames()[0]) }}" eurl="{{ route('addrole-user', $user->id) }}" data-toggle="modal" name="{{ $user->name }}" email="{{ $user->email }}" phone="{{ $user->phone }}" img="{{ $user->getMedia('avatar')->first()?$user->getMedia('avatar')->first()->getFullUrl():asset('assets/users/assets/img/avatar/avatar-1.png') }}" >
                                            <span class="badge badge-pill badge-info"><i
                                                    class="fa fa-copyright" data-toggle="tooltip" title="Assign a role to user"></i></span>
                                        </a>

                                    </div>
                                </td>
                                </tr>

                                @empty
                                    <h3 class="text-danger"> No user available at moment</h3>
                                @endforelse



                            </tbody>
                        </table>

                    </div>

                </div>

            </div>


        </div>




    </section>


{{-- delete user details --}}
{{--  @if ($authrole->hasPermissionTo("delete user"))  --}}

<div class="modal" id="deleteuser">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title text-uppercase">are you sure you want delete <span id="na"></span>
                    ?</h4>
                <button type="button" class="btn btn-danger" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form id="deleteform" action="" method="POST">

                    @method('DELETE')

                    {{ csrf_field() }}


                    <!-- Modal footer -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <img src="{{ asset('asset/img/about-img.jpg') }}" class="card-img" id="deleteimg" alt="">
                            </div>
                            <div class="col">
                                <div class="row">
                                    <div class="col">
                                        <p class="text-muted">Full name</p>
                                    </div>
                                    <div class="col">
                                        <p class="font-weight-bold" id="name"></p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <p class="text-muted">Username</p>
                                    </div>
                                    <div class="col">
                                        <p class="font-weight-bold" id="username"></p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <p class="text-muted">Phone number</p>
                                    </div>
                                    <div class="col">
                                        <p class="font-weight-bold" id="phone"></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <p class="text-muted">Role</p>
                                    </div>
                                    <div class="col">
                                        <p class="font-weight-bold" id="role"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-success float-left mx-2" data-dismiss="modal">Cancel</button>
                        <button id="addcategorybtn" type="submit" class="btn btn-danger text-uppercase">delete
                            user</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
{{--  @endif  --}}

{{-- end of users deletion --}}
{{-- delete user details --}}
{{--  @if ($authrole->hasPermissionTo("view users"))  --}}

<div class="modal" id="viewuser">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title text-uppercase"><span id="vna"></span></h4>
                <button type="button" class="btn btn-danger" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                    <!-- Modal footer -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <img src="{{ asset('asset/img/about-img.jpg') }}" class="card-img" id="viewimg" alt="">
                            </div>
                            <div class="col">
                                <div class="row">
                                    <div class="col">
                                        <p class="text-muted">Full name</p>
                                    </div>
                                    <div class="col">
                                        <p class="font-weight-bold" id="vname"></p>
                                    </div>
                                </div>
                                <hr>

                                <div class="row">
                                    <div class="col">
                                        <p class="text-muted">Email</p>
                                    </div>
                                    <div class="col">
                                        <p class="font-weight-bold" id="vemail"></p>
                                    </div>
                                </div>
                                <hr>

                                <div class="row">
                                    <div class="col">
                                        <p class="text-muted">Phone number</p>
                                    </div>
                                    <div class="col">
                                        <p class="font-weight-bold" id="vphone"></p>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col">
                                        <p class="text-muted">Role</p>
                                    </div>
                                    <div class="col">
                                        <p class="font-weight-bold" id="vrole"></p>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col">
                                        <p class="text-muted">Status</p>
                                    </div>
                                    <div class="col">
                                        <p class="font-weight-bold" id="vstatus"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-success float-left mx-2" data-dismiss="modal">Cancel</button>

                    </div>
            </div>
        </div>
    </div>
</div>



{{--  @endif  --}}



       {{-- edit --}}
       <div class="modal" id="disableduser">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h5 class="modal-title text-uppercase font-weight-bold">disabled user</h5>
                    {{-- <h2 class="text-center display-1 "> <span class="mdi mdi-bank"></span></h2> --}}

                    <button type="button" class="btn btn-danger" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <img src=""class="card-img" id="davatarpreview" alt="">
                            </div>
                            <div class="col">
                                <div class="row">
                                    <div class="col">
                                        <p class="text-muted">Full name</p>
                                    </div>
                                    <div class="col">
                                        <p class="font-weight-bold" id="dname"></p>
                                    </div>
                                </div>
                                <hr>

                                <div class="row">
                                    <div class="col">
                                        <p class="text-muted">Email</p>
                                    </div>
                                    <div class="col">
                                        <p class="font-weight-bold" id="demail"></p>
                                    </div>
                                </div>
                                <hr>

                                <div class="row">
                                    <div class="col">
                                        <p class="text-muted">Phone number</p>
                                    </div>
                                    <div class="col">
                                        <p class="font-weight-bold" id="dphone"></p>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col">
                                        <p class="text-muted">Role</p>
                                    </div>
                                    <div class="col">
                                        <p class="font-weight-bold" id="drole"></p>
                                    </div>
                                </div>

                                <hr>
                                <div class="row">
                                    <div class="col">
                                        <p class="text-muted">Status</p>
                                    </div>
                                    <div class="col">
                                        <p class="font-weight-bold" id="dstatus"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <a href="" id="durl" class="btn btn-block btn-warning" >Disabled user</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- End edit --}}

      {{-- edit --}}
      <div class="modal" id="addroleuser">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h5 class="modal-title text-uppercase font-weight-bold">disabled user</h5>
                    {{-- <h2 class="text-center display-1 "> <span class="mdi mdi-bank"></span></h2> --}}

                    <button type="button" class="btn btn-danger" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <img src=""class="card-img" id="ravatarpreview" alt="">
                            </div>
                            <div class="col">
                                <div class="row">
                                    <div class="col">
                                        <p class="text-muted">Full name</p>
                                    </div>
                                    <div class="col">
                                        <p class="font-weight-bold" id="rname"></p>
                                    </div>
                                </div>
                                <hr>

                                <div class="row">
                                    <div class="col">
                                        <p class="text-muted">Email</p>
                                    </div>
                                    <div class="col">
                                        <p class="font-weight-bold" id="remail"></p>
                                    </div>
                                </div>
                                <form action="" id="addroles" method="post">
                                    @method('PUT')
                                    @csrf
                                <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Select role') }}</label>

                                <div class="col-md-6">
                                    <select name="role" class="form-control select2" id="selectrole">
                                       <option value="{{ Auth::user()->getRoleNames()[0]}}">{{ Auth::user()->getRoleNames()[0]}}</option>
                                        @forelse ($roles as $role)
                                        <option value="{{ $role->name }}">{{ ucwords($role->name) }}</option>
                                        @empty
                                        <option value="">No roles available</option>
                                        @endforelse

                                    </select>

                                    @error('role')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            </div>
                        </div>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-bl btn-success" >Assign Role</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- End edit --}}


     {{-- edit --}}
     <div class="modal" id="enableduser">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h5 class="modal-title text-uppercase font-weight-bold">Enabled user</h5>
                    {{-- <h2 class="text-center display-1 "> <span class="mdi mdi-bank"></span></h2> --}}

                    <button type="button" class="close bg-danger text-white" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <img src=""class="card-img" id="eavatarpreview" alt="">
                        </div>
                        <div class="col">
                            <div class="row">
                                <div class="col">
                                    <p class="text-muted">Full name</p>
                                </div>
                                <div class="col">
                                    <p class="font-weight-bold" id="ename"></p>
                                </div>
                            </div>
                            <hr>

                            <div class="row">
                                <div class="col">
                                    <p class="text-muted">Email</p>
                                </div>
                                <div class="col">
                                    <p class="font-weight-bold" id="eemail"></p>
                                </div>
                            </div>
                            <hr>

                            <div class="row">
                                <div class="col">
                                    <p class="text-muted">Phone number</p>
                                </div>
                                <div class="col">
                                    <p class="font-weight-bold" id="ephone"></p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col">
                                    <p class="text-muted">Role</p>
                                </div>
                                <div class="col">
                                    <p class="font-weight-bold" id="erole"></p>
                                </div>
                            </div>

                            <hr>
                            <div class="row">
                                <div class="col">
                                    <p class="text-muted">Status</p>
                                </div>
                                <div class="col">
                                    <p class="font-weight-bold" id="estatus"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <a href="" id="eurl" class="btn btn-block btn-warning" >Enabled user</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- End edit --}}
{{-- end of users deletion --}}

@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $("#userslist").dataTable({
                "columnDefs": [{
                    "sortable": false,
                    "targets": [2, 3]
                }]
            });



$('#deleteuser').on('show.bs.modal', function(e) {
    var name = $(e.relatedTarget).attr('name');
    var imgurl = $(e.relatedTarget).attr('imgurl');
    var username = $(e.relatedTarget).attr('username');
    var phone = $(e.relatedTarget).attr('phone');
    var role = $(e.relatedTarget).attr('role');
    //   alert(facultyname)
    var urlink = $(e.relatedTarget).attr('deurl');
    $("#name").text(name);
    $("#username").text(username);
    $("#phone").text(phone);
    $("#role").text(role);
    $("#deleteform").attr("action", urlink);
    $("#deleteimg").attr("src",  imgurl);
        })



    $('#viewuser').on('show.bs.modal', function(e) {
    var name = $(e.relatedTarget).attr('name');
    var imgurl = $(e.relatedTarget).attr('imgurl');
    var email = $(e.relatedTarget).attr('email');
    var phone = $(e.relatedTarget).attr('phone');
    var role = $(e.relatedTarget).attr('role');
    var status = $(e.relatedTarget).attr('status');
    //   alert(facultyname)
    $("#vna").text(name);
    $("#vname").text(name);
    $("#vemail").text(email);
    $("#vphone").text(phone);
    $("#vrole").text(role);
    $("#vstatus").text(status);
    $("#viewimg").attr("src",  imgurl);
        })

        $('#disableduser').on('show.bs.modal', function(e) {
            var role = $(e.relatedTarget).attr('role');

                var img = $(e.relatedTarget).attr('img');
                var name = $(e.relatedTarget).attr('name');
                var status = $(e.relatedTarget).attr('status');
                var email = $(e.relatedTarget).attr('email');
                var phone = $(e.relatedTarget).attr('phone');
                var editurl = $(e.relatedTarget).attr('durl');

                $("#drole").text(role);

                //   alert(facultyname)
                $("#demail").text(email);
                $("#dname").text(name);
                $("#dstatus").text(status);
                $("#dphone").text(phone);
                $("#davatarpreview").attr("src", img);
                $("#durl").attr("href", editurl);

            })

            $('#enableduser').on('show.bs.modal', function(e) {
                var role = $(e.relatedTarget).attr('role');

                var img = $(e.relatedTarget).attr('img');
                var name = $(e.relatedTarget).attr('name');
                var status = $(e.relatedTarget).attr('status');
                var email = $(e.relatedTarget).attr('email');
                var phone = $(e.relatedTarget).attr('phone');
                var editurl = $(e.relatedTarget).attr('eurl');

                //   alert(facultyname)
                $("#eemail").text(email);
                $("#ename").text(name);
                $("#estatus").text(status);
                $("#ephone").text(phone);
                $("#eavatarpreview").attr("src", img);
                $("#eurl").attr("href", editurl);
                $("#erole").text(role);


            })

            $('#addroleuser').on('show.bs.modal', function(e) {
                var role = $(e.relatedTarget).attr('role');

                var img = $(e.relatedTarget).attr('img');
                var name = $(e.relatedTarget).attr('name');
                var email = $(e.relatedTarget).attr('email');
                var editurl = $(e.relatedTarget).attr('eurl');

                //   alert(facultyname)
                $("#remail").text(email);
                $("#rname").text(name);
                $("#ravatarpreview").attr("src", img);
                $("#addroles").attr("action", editurl);


            })

        })
    </script>
@endsection

{{--
@else
<script>window.location = "{{ route('authorisation-denied') }}";</script>

@endif  --}}
