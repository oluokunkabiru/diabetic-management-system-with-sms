{{--  @if (Spatie\Permission\Models\Role::findByName(Auth::user()->getRoleNames()[0])->hasPermissionTo("view crimes list"))  --}}

@extends('users.layout.app')
@section('title', "Classes schedule")

@section('content')

<section class="section">
    <div class="section-header">
        <h1 class="text-center font-weight-bold"> Classes schedule </h1>
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
                <a href="#addclass" data-toggle="modal" class="btn btn-success text-uppercase ">Add classes</a>

                <div class="table-responsive">
                    <table class="table table-striped v_center" id="crimeslist">

                        <thead>
                            <tr>
                                <th class="text-center">
                                    ID
                                </th>
                                <th>Course</th>
                                <th>Name</th>
                                <th>Weekday</th>
                                <th>Weekday Price</th>
                                <th>Weekend</th>
                                <th>Weekend price</th>
                                <th>Date</th>
                                <th>Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 0;
                            @endphp
                            @forelse ($classes as $class)
                             <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ ucwords($class->course->name) }}</td>
                                <td>{{ ucwords($class->name) }}</td>
                                <td>{{ strtoupper(implode(", ",json_decode($class->weekday, true)['day'])) }}</td>
                                <th><span class="fa">&#8358; </span>{{ number_format(json_decode($class->weekday, true)['price'],2,".",",")  }} </th>

                                <td>{{ strtoupper(implode(", ",json_decode($class->weekend, true)['day'])) }}</td>
                                <th><span class="fa">&#8358; </span>{{ number_format(json_decode($class->weekend, true)['price'],2,".",",")  }} </th>


                                <td>{{ $class->created_at }}</td>
                            <td>
                                <div class="row">
                                    {{-- edit offendermis details --}}
                                    {{--  @if ($authrole->hasPermissionTo("view crimes list details"))  --}}
                                    <a href="{{ route('classes-schedule.update', $class->id) }}" class="badge badge-pill badge-primary mx-1"><span
                                            class="fa fa-eye my-2 p-1 text-white"></span>
                                        </a>
                                           {{--  @endif  --}}
                                           {{--  @if ($authrole->hasPermissionTo("print crimes receipt"))  --}}
                                           <a href="{{ route('classes-schedule.destroy', $class->id) }}" class="badge badge-pill badge-warning mx-1"><span
                                            class="fa fa-print my-2 p-1 text-white"></span>
                                        </a>
                                            {{--  @endif  --}}

                                    {{-- end of edit offendermis details --}}

                                    {{-- delete motorcycle --}}
                                    {{-- @if ($authrole->hasPermissionTo("delete offendermis")) --}}



                                </div>
                            </td>
                            </tr>

                            @empty
                                <h3 class="text-danger"> No class schedule is available at moment</h3>
                            @endforelse



                        </tbody>
                    </table>

                </div>

            </div>

        </div>


    </div>




</section>


<div class="modal" id="addclass">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title text-uppercase">Add class schedule</h4>
                <button type="button" class="btn btn-danger" data-dismiss="modal">&times;</button>
            </div>
            <form action="" action="{{ route('classes-schedule.store') }}" method="POST">

                <!-- Modal body -->
                <div class="modal-body">


                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="usr">Course Schedule Name:</label>
                        <input id="username" type="text" name="name" class="form-control" name="courses[]" required>

                    </div>
                    <div class="form-group">
                        <label for="sel1">Select Course:</label>
                        <select class="form-control" id="sel1" name="course">
                            @forelse ($courses as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>

                            @empty

                            @endforelse

                        </select>
                      </div>
                    <!-- Modal footer -->
                      <label for="">Week Day class</label> <br>
                    <div class="form-check-inline">
                        <label class="form-check-label">
                          <input type="checkbox" class="form-check-input" value="mon" name="weekday[day][mon]"> Mon
                        </label>
                      </div>
                      <div class="form-check-inline">
                        <label class="form-check-label">
                          <input type="checkbox" class="form-check-input" value="tue" name="weekday[day][tue]">Tue
                        </label>
                      </div>
                      <div class="form-check-inline">
                        <label class="form-check-label">
                          <input type="checkbox" class="form-check-input" value="wed" name="weekday[day][wed]">Wed
                        </label>
                      </div>
                      <div class="form-check-inline">
                        <label class="form-check-label">
                          <input type="checkbox" class="form-check-input" value="thu" name="weekday[day][thu]">Thu
                        </label>
                      </div>
                      <div class="form-check-inline">
                        <label class="form-check-label">
                          <input type="checkbox" class="form-check-input" value="fri" name="weekday[day][fri]">Fri
                        </label>
                      </div>
                      <div class="row">
                        <div class="form-group col-md-4">
                            <label for="usr">Week Day price:</label>
                            <input id="username" type="number" name="weekday[price]" class="form-control" name="courses[]" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="usr">Numbers of practical:</label>
                            <input id="username" type="number" name="weekday[practical]" class="form-control" name="courses[]" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="usr">Duration in Minute per class:</label>
                            <input id="username" type="number" name="weekday[duration]" class="form-control" name="courses[]" required>
                        </div>
                      </div>

                      {{--  <br>  --}}
                      <label for="">Weekend class</label> <br>
                      <div class="form-check-inline">
                        <label class="form-check-label">
                          <input type="checkbox" class="form-check-input" value="sat" name="weekend[day][sat]">Sat
                        </label>
                      </div>
                      <div class="form-check-inline">
                        <label class="form-check-label">
                          <input type="checkbox" class="form-check-input" value="sun" name="weekend[day][sun]">Sun
                        </label>
                      </div>
                      <div class="row">
                        <div class="form-group col-md-4">
                            <label for="usr">Weekend price:</label>
                            <input id="username" type="number" name="weekend[price]" class="form-control" name="courses[]" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="usr">Numbers of practical:</label>
                            <input id="username" type="number" name="weekend[practical]" class="form-control" name="courses[]" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="usr">Duration in Minute per class:</label>
                            <input id="username" type="number" name="weekend[duration]" class="form-control" name="courses[]" required>
                        </div>
                      </div>


                    {{--  </div>  --}}

                    {{-- <span class="badge badge-pill badge-primary" id="addmorecourse"><span class="fa fa-plus"></span></span> --}}
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger float-left mx-2" data-dismiss="modal">Cancel</button>
                    <button id="addcategorybtn" type="submit" class="btn  btn-success text-uppercase">Add
                        class</button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection


@section('script')
<script>
    $(document).ready(function(){
        $("#crimeslist").dataTable({
                "columnDefs": [{
                    "sortable": true,
                    // "targets": [2, 3]
                }]
            });
    })
</script>

@endsection

{{--  @else
<script>window.location = "{{ route('authorisation-denied') }}";</script>

@endif  --}}
