{{--  @if (Spatie\Permission\Models\Role::findByName(Auth::user()->getRoleNames()[0])->hasPermissionTo("view offence"))  --}}
@extends('users.layout.app')
@section('title', 'Manage active application')
@section('content')


    <section class="section">
        <div class="section-header">
            <h1 class="text-center font-weight-bold"> Manage active application</h1>
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

                    <div class="table-responsive">
                        <table class="table table-striped v_center" id="userslist">

                            <thead>
                                <tr>
                                    <th class="text-center">
                                        ID
                                    </th>
                                    <th>Name</th>
                                    <th>Course</th>
                                    <th>Schedule</th>
                                    <th>Payment</th>
                                    <th>Application date</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 0;
                                @endphp
                                @forelse ($applications as $application)
                                 <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>
                                        <h6 class="font-weight-bold">{{ ucwords($application->name) }}</h6>
                                        <p>{{ strtoupper($application->phone) }}</p>
                                        <p>{{ strtolower($application->email) }}</p>
                                    </td>
                                    <td>
                                        <h6>{{  ucwords($application->course->name) }}</h6>
                                        @if ($application->status=="pending")
                                        <span class="btn btn-danger btn-rounded text-uppercase">{{ $application->status }}</span>

                                        @elseif ($application->status=="active")
                                        <span class="btn btn-success btn-rounded text-uppercase">{{ $application->status }}</span>
                                        @elseif ($application->status=="processing")

                                        <span class="btn btn-info btn-rounded text-uppercase">{{ $application->status }}</span>
                                        @else
                                        <span class="btn btn-warning btn-rounded text-uppercase">{{ $application->status }}</span>

                                        @endif
                                    </td>

                                    <td>
                                        <h6 class="font-weight-bold">{{ $application->schedule->name }}</h6>
                                        <p>Available days</p>
                                        <small> {{ strtoupper(implode(",",json_decode($application->day, true))) }}</small>
                                        <p>Pick up point : <span class="font-weight-bold">{{ strtoupper($application->pickup->name) }}</span></p>
                                        <p>Training center : <span class="font-weight-bold">{{ strtoupper($application->center->name) }}</span></p>
                                    </td>
                                    <td>
                                        <p>Driver License : <span class="font-weight-bold">{{ strtoupper($application->license) }}</span></p>
                                        <p>Payment ref : <span class="font-weight-bold">{{ strtoupper(json_decode($application->payment, true)['ref']) }}</span></p>
                                        <p><span class="fa">&#8358; </span>{{ number_format(json_decode($application->payment, true)['amount'],2,".",",")}}</p>
                                    </td>
                                    {{--  <td>{{  ucwords($application->user->name) }}</td>  --}}
                                    <td>{{ $application->created_at }}</td>
                                <td>
                                    <div class="row">
                                        {{-- edit offence details --}}
                                        {{--  @if ($authrole->hasPermissionTo("edit offence"))  --}}
                                        <a href="#process_application" data-toggle="modal" editurl="{{ route('process-application', $application->id) }}" name="{{ ucwords($application->name) }}" class="badge badge-pill badge-primary mx-1"><span
                                                class="fa fa-sync p-1 text-white"></span></a>
                                               {{--  @endif  --}}




                                        {{-- end of edit offence details --}}

                                        {{-- delete motorcycle --}}
                                        {{--  @if ($authrole->hasPermissionTo("delete offence"))  --}}


                                    </div>
                                </td>
                                </tr>

                                @empty
                                    <h3 class="text-danger"> No application available at moment</h3>
                                @endforelse



                            </tbody>
                        </table>

                    </div>

                </div>

            </div>


        </div>




    </section>
 {{--  add offence  --}}


{{--  edit offence  --}}
{{--  @if ($authrole->hasPermissionTo("edit offence"))  --}}

<div class="modal" id="process_application">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title text-uppercase">process <span id="uname"></span> application</h4>
                <button type="button" class="btn btn-danger" data-dismiss="modal">&times;</button>
            </div>
        <form id="editform" action="" method="POST">

            <!-- Modal body -->
            <div class="modal-body">
                <div class="form-group">
                    <label for="sel1">Select processing action:</label>
                    <select class="form-control" id="sel1" name="process">
                        <option value="pending">Pending</option>
                        <option value="processing">Processing</option>
                        <option value="active">Active</option>
                        <option value="reject">Reject</option>
                        <option value="graduate">Graduate</option>


                    </select>
                  </div>

                    {{ csrf_field() }}
                    @method('PUT')

                    <!-- Modal footer -->





            </div>
            <div class="modal-footer">
                <button class="btn btn-danger float-left mx-2" data-dismiss="modal">Cancel</button>
                <button id="addcategorybtn" type="submit" class="btn  btn-success text-uppercase">Update application</button>
            </div>

        </form>
        </div>
    </div>
</div>
{{--  @endif  --}}
{{--  end of edit offence  --}}


{{-- delete user details --}}


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



$('#deleteoffence').on('show.bs.modal', function(e) {
    var name = $(e.relatedTarget).attr('name');
    var urlink = $(e.relatedTarget).attr('deurl');
    $("#name").text(name);

    $("#deleteform").attr("action", urlink);
        })



    $('#process_application').on('show.bs.modal', function(e) {
        var name = $(e.relatedTarget).attr('name');
        var code = $(e.relatedTarget).attr('code');
        var price = $(e.relatedTarget).attr('price');
        var editurl = $(e.relatedTarget).attr('editurl');

        //   alert(facultyname)
        $("#uname").val(name);
        $("#ucode").val(code);
        $("#uprice").val(price);
        $("#editform").attr("action", editurl);

    })



})
    </script>
@endsection

{{--
@else
<script>window.location = "{{ route('authorisation-denied') }}";</script>

@endif  --}}
