{{-- @if ($authrole->hasPermissionTo('view course')) --}}
    @extends('users.layout.app')
    @section('title', 'Manage Courses')
    @section('content')


        <section class="section">
            <div class="section-header">
                <h1 class="text-center font-weight-bold"> Manage Courses</h1>
            </div>
            <div class="container">

                <div class="card">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <strong>Success! </strong> {{ session('success') }}
                        </div>
                    @endif

                    @if (session('delete'))
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
                        {{-- @if ($authrole->hasPermissionTo('add course')) --}}

                            <a href="#addcourse" data-toggle="modal" class="btn btn-success text-uppercase ">Add course</a>
                        {{-- @endif --}}
                        <div class="table-responsive">
                            <table class="table table-striped v_center" id="zonallist">

                                <thead>
                                    <tr>
                                        <th class="text-center">
                                            ID
                                        </th>
                                        <th>Course name</th>
                                        <th>Weekday</th>
                                        <th>Weekend</th>
                                        <th>Publish date</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i = 0;
                                    @endphp
                                    @forelse ($courses as $course)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>{{ ucwords($course->name) }}</td>
                                            <td>{{ ucwords(json_decode($course->day, TRUE)['weekday']) }}</td>
                                            <td>{{ ucwords(json_decode($course->day, TRUE)['weekend']) }}</td>
                                            <td>{{ $course->created_at }}</td>
                                            <td>
                                                <div class="row">
                                                    {{-- @if ($authrole->hasPermissionTo('edit course')) --}}

                                                        <a href="#editcourse" coursename="{{ ucwords($course->name) }}"
                                                            editurl="{{ route('courses.update', $course->id) }}"
                                                            day="{{ $course->day }}" description="{{ $course->description }}"
                                                            avatar="{{$course->getMedia('course')->first()?$course->getMedia('course')->first()->getFullUrl():asset('light-bootstrap/assets/images/4.jpg') }}" data-toggle="modal"
                                                            class="badge badge-pill badge-warning mx-1"><span
                                                                class="fa fa-edit p-1 text-white"></span></a>
                                                    {{-- @endif --}}
                                                    {{-- @if ($authrole->hasPermissionTo('delete course')) --}}

                                                    @if ($course->checkSchedule($course->id) > 0)
                                                    <a href="#deletecoursedisabled" data-toggle="modal"
                                                    coursename="{{ ucwords($course->name) }}"
                                                    deurl="{{ route('courses.destroy', $course->id) }}"
                                                    class="badge badge-pill badge-danger mx-1"><span
                                                        class="fa fa-trash p-1 text-white"></span></a>
                                            {{-- @endif --}}
                                                    @else
                                                    <a href="#deletecourse" data-toggle="modal"
                                                    coursename="{{ ucwords($course->name) }}"
                                                    deurl="{{ route('courses.destroy', $course->id) }}"
                                                    class="badge badge-pill badge-danger mx-1"><span
                                                        class="fa fa-trash p-1 text-white"></span></a>
                                            {{-- @endif --}}
                                                    @endif

                                                </div>
                                            </td>
                                        </tr>

                                    @empty
                                        <h3 class="text-danger"> No Courses available at moment</h3>
                                    @endforelse



                                </tbody>
                            </table>

                        </div>

                    </div>

                </div>


            </div>




        </section>
        {{-- add course --}}
        {{-- @if ($authrole->hasPermissionTo('add course')) --}}

            <div class="modal" id="addcourse">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title text-uppercase">Add courses</h4>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">&times;</button>
                        </div>
                        <form action="{{ route('courses.store') }}" method="POST" enctype="multipart/form-data" >

                            <!-- Modal body -->
                            <div class="modal-body">


                                {{ csrf_field() }}


                                <!-- Modal footer -->
                                    <div class="form-group">
                                        <label for="usr">Course Name:</label>
                                        <input id="username" type="text" name="name" class="form-control" required>

                                    </div>
                                {{--  </div>  --}}
                                    <label for="">Training availability</label>
                                    <br>
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                          <input type="checkbox" name="day[weekday]" class="form-check-input" value="weekday">Weekday
                                        </label>
                                      </div>
                                      <div class="form-check-inline">
                                        <label class="form-check-label">
                                          <input type="checkbox" name="day[weekend]" class="form-check-input" value="weekend">Weekend
                                        </label>
                                      </div>
                                      <div class="form-group">
                                        <label for="comment">Description:</label>
                                        <textarea class="form-control" rows="5" id="comment" name="desc"></textarea>
                                      </div>

                                      <div class="input-group mb-3">
                                        <input type="file" class="form-control" id="descri" name="file" accept=".jpg, .png" placeholder="Your Email">
                                        <div class="input-group-append">
                                          <span class="input-group-text">Description image</span>
                                        </div>
                                      </div>
                                      <img src="" id="desc_img" class="card-img" style="width: 200px" alt="">



                                {{-- <span class="badge badge-pill badge-primary" id="addmorecourse"><span class="fa fa-plus"></span></span> --}}
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-danger float-left mx-2" data-dismiss="modal">Cancel</button>
                                <button id="addcategorybtn" type="submit" class="btn  btn-success text-uppercase">Add
                                    course</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        {{-- @endif --}}
        {{-- end of add course --}}



        {{-- edit course --}}
        {{-- @if ($authrole->hasPermissionTo('edit course')) --}}

            <div class="modal" id="editcourse">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title text-uppercase">edit course</h4>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">&times;</button>
                        </div>
                        <form id="editcourseform" action="" method="POST" enctype="multipart/form-data">

                            <!-- Modal body -->
                            <div class="modal-body">


                                {{ csrf_field() }}
                                @method('PUT')

                                <!-- Modal footer -->
                                    <div class="form-group">
                                        <label for="usr">Course Name:</label>
                                        <input id="ucoursename" type="text" name="name"  class="form-control"  required>

                                    </div>
                                {{--  </div>  --}}
                                    <label for="">Training availability</label>
                                    <br>
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                          <input type="checkbox" name="day[weekday]" checked class="form-check-input" value="weekday">Weekday
                                        </label>
                                      </div>
                                      <div class="form-check-inline">
                                        <label class="form-check-label">
                                          <input type="checkbox" name="day[weekend]" checked class="form-check-input" value="weekend">Weekend
                                        </label>
                                      </div>
                                      <div class="form-group">
                                        <label for="comment">Description:</label>
                                        <textarea class="form-control" rows="5" id="edescr" name="desc"></textarea>
                                      </div>

                                      <div class="input-group mb-3">
                                        <input type="file" class="form-control" id="descri" name="file" accept=".jpg, .png" placeholder="Your Email">
                                        <div class="input-group-append">
                                          <span class="input-group-text">Description image</span>
                                        </div>
                                      </div>
                                      <img src="" id="edesc_img" class="card-img" style="width: 200px" alt="">



                                {{-- <span class="badge badge-pill badge-primary" id="addmorecourse"><span class="fa fa-plus"></span></span> --}}
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-danger float-left mx-2" data-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn  btn-success text-uppercase">Update course</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        {{-- @endif --}}
        {{-- end of edit course --}}

        {{-- add course --}}
        {{-- @if ($authrole->hasPermissionTo('delete course')) --}}

            <div class="modal" id="deletecourse">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title text-uppercase">Delete course : <span id="deletecoursename"></span></h4>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">&times;</button>
                        </div>
                        <form id="deletecourseform" action="" method="POST">

                            <!-- Modal body -->
                            <div class="modal-body">
                                {{ csrf_field() }}
                                @method('DELETE')
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-success float-left mx-2" data-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-danger text-uppercase">Delete course</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>


            <div class="modal" id="deletecoursedisabled">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title text-uppercase">Delete course : <span id="deletecoursenamedisabled"></span></h4>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">&times;</button>
                        </div>
                        {{-- <form id="deletecourseform" action="" method="POST"> --}}

                            <!-- Modal body -->
                            <div class="modal-body">
                                <h3 class="text-danger text-uppercase"> You are not allowed to delete this, please try to delete all class schedule that associate with this course</h3>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-success float-left mx-2" data-dismiss="modal">Cancel</button>
                                {{-- <button type="submit" class="btn btn-danger text-uppercase">Delete course</button> --}}
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        {{-- @endif --}}
        {{-- end of edit course --}}


    @endsection
    @section('script')
        <script>
     function previewpassport(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    // alert(e.target.result)
                    $('#desc_img').attr('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

            $(document).ready(function() {


        $("#descri").change(function () {
            previewpassport(this);
        });

                $(".select2").select2();

                $("#zonallist").dataTable({
                    "columnDefs": [{
                        "sortable": false,
                        // "targets": [2, 3]
                    }]
                });




                $("#addmorecourse").on('click', function() {

                    $(this).before($("#loadmore").removeClass('invisible').html());
                })
                $('#editcourse').on('show.bs.modal', function(e) {
                    var coursename = $(e.relatedTarget).attr('coursename');
                    var description = $(e.relatedTarget).attr('description');
                    var avatar = $(e.relatedTarget).attr('avatar');
                    var editurl = $(e.relatedTarget).attr('editurl');
                    $("#ucoursename").val(coursename);
                    $("#edescr").text(description);
                    $("#edesc_img").attr('src', avatar);
                    $("#editcourseform").attr("action", editurl);
                })

                $('#deletecourse').on('show.bs.modal', function(e) {
                    var coursename = $(e.relatedTarget).attr('coursename');
                    var stateid = $(e.relatedTarget).attr('stateid');
                    var deleteurl = $(e.relatedTarget).attr('deurl');
                    $("#deletecoursename").text(coursename);
                    $("#deletecourseform").attr("action", deleteurl);
                })

                $('#deletecoursedisabled').on('show.bs.modal', function(e) {
                    var coursename = $(e.relatedTarget).attr('coursename');
                    var stateid = $(e.relatedTarget).attr('stateid');
                    var deleteurl = $(e.relatedTarget).attr('deurl');
                    $("#deletecoursenamedisabled").text(coursename);
                    $("#deletecourseform").attr("action", deleteurl);
                })

            })
        </script>
    @endsection
{{-- @else
    <script>
        window.location = "{{ route('authorisation-denied') }}";
    </script>

@endif --}}
