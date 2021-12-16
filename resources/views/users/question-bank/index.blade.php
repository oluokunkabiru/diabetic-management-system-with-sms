{{--  @if (Spatie\Permission\Models\Role::findByName(Auth::user()->getRoleNames()[0])->hasPermissionTo("view crimes list"))  --}}

@extends('users.layout.app')
@section('title', "Questions Bank")

@section('content')

<section class="section">
    <div class="section-header">
        <h1 class="text-center font-weight-bold"> Question Bank </h1>
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
                <a href="#addquestion" data-toggle="modal" class="btn btn-success text-uppercase ">Add question</a>

                <div class="table-responsive">
                    <table class="table table-striped v_center" id="crimeslist">

                        <thead>
                            <tr>
                                <th class="text-center">
                                    ID
                                </th>
                                <th>Category</th>
                                <th>Questions</th>
                                <th>Types</th>
                                <th>Added Date</th>
                                <th>Added By</th>
                                <th>Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 0;
                            @endphp
                            @forelse ($questions as $question)
                             <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ ucwords($question->category->name) }}</td>
                                <td>{{ ucfirst($question->question) }}</td>
                                <td>{{ ucfirst($question->type) }}</td>
                                <td>{{ ucfirst($question->user->name) }}</td>

                                <td>{{ $question->created_at }}</td>
                            <td>
                                <div class="row">
                                    {{-- edit offendermis details --}}
                                    {{--  @if ($authrole->hasPermissionTo("view crimes list details"))  --}}
                                    <a href="#editquestion" data-toggle="modal" type="{{ ucfirst($question->type) }}" catname="{{ ucwords($question->category->name) }}" catid="{{ ucwords($question->category->id) }}"  question="{{ ucfirst($question->question) }}" editurl="{{ route('question-bank.update', $question->id) }}" class="badge badge-pill badge-primary mx-1"><span
                                            class="fa fa-edit my-2 p-1 text-white"></span>
                                        </a>
                                           {{--  @endif  --}}
                                           {{--  @if ($authrole->hasPermissionTo("print crimes receipt"))  --}}
                                           <a href="#deletequestion" data-toggle="modal" question="{{ ucfirst($question->question) }}" deurl="{{ route('question-bank.destroy', $question->id) }}" class="badge badge-pill badge-danger mx-1"><span
                                            class="fa fa-trash my-2 p-1 text-white"></span>
                                        </a>
                                            {{--  @endif  --}}

                                    {{-- end of edit offendermis details --}}

                                    {{-- delete motorcycle --}}
                                    {{-- @if ($authrole->hasPermissionTo("delete offendermis")) --}}



                                </div>
                            </td>
                            </tr>

                            @empty
                                <h3 class="text-danger"> No question is available at moment</h3>
                            @endforelse



                        </tbody>
                    </table>

                </div>

            </div>

        </div>


    </div>




</section>


<div class="modal" id="addquestion">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title text-uppercase">Add question</h4>
                <button type="button" class="btn btn-danger" data-dismiss="modal">&times;</button>
            </div>
            <form action="" action="{{ route('question-bank.store') }}" method="POST">

                <!-- Modal body -->
                <div class="modal-body">


                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="sel1">Select Causes:</label>
                        <select class="form-control" id="sel1" name="category">
                            @forelse ($category as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>

                            @empty

                            @endforelse

                        </select>
                      </div>

                      <div class="form-group">
                        <label for="sel1">Question type:</label>
                        <select class="form-control" id="sel1" name="type">
                            <option value="text">Text</option>
                            <option value="number">Number</option>
                            <option value="email">Email</option>
                            <option value="date">Date</option>
                        </select>
                      </div>

                    <div class="form-group">
                        <label for="usr">Question:</label>
                        <input id="username" type="text" name="question" class="form-control" required>

                    </div>

                    <!-- Modal footer -->
                      {{--  </div>  --}}


                    {{--  </div>  --}}

                    {{-- <span class="badge badge-pill badge-primary" id="addmorecourse"><span class="fa fa-plus"></span></span> --}}
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger float-left mx-2" data-dismiss="modal">Cancel</button>
                    <button id="addcategorybtn" type="submit" class="btn  btn-success text-uppercase">Add
                        question</button>
                </div>

            </form>
        </div>
    </div>
</div>


<div class="modal" id="editquestion">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title text-uppercase">Edit question</h4>
                <button type="button" class="btn btn-danger" data-dismiss="modal">&times;</button>
            </div>
            <form id="editquestionform"  method="POST">

                <!-- Modal body -->
                <div class="modal-body">


                    {{ csrf_field() }}
                    @method('PUT')
                    <div class="form-group">
                        <label for="sel1">Select Causes:</label>
                        <select class="form-control" id="sel1" name="category">
                            <option value="" id="selectedcause" selected></option>
                            @forelse ($category as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>

                            @empty

                            @endforelse

                        </select>
                      </div>

                      <div class="form-group">
                        <label for="sel1">Question type:</label>
                        <select class="form-control" id="sel1" name="type">
                            <option value="" id="selectedtype" selected></option>
                            <option value="text">Text</option>
                            <option value="number">Number</option>
                            <option value="email">Email</option>
                            <option value="date">Date</option>
                        </select>
                      </div>

                    <div class="form-group">
                        <label for="usr">Question:</label>
                        <input id="prequestion" type="text" name="question" class="form-control" required>

                    </div>

                    <!-- Modal footer -->
                      {{--  </div>  --}}


                    {{--  </div>  --}}

                    {{-- <span class="badge badge-pill badge-primary" id="addmorecourse"><span class="fa fa-plus"></span></span> --}}
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger float-left mx-2" data-dismiss="modal">Cancel</button>
                    <button id="addcategorybtn" type="submit" class="btn  btn-success text-uppercase">Update question</button>
                </div>

            </form>
        </div>
    </div>
</div>


<div class="modal" id="deletequestion">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title text-uppercase">Delete question: <span id="deletecentername"></span></h4>
                <button type="button" class="btn btn-danger" data-dismiss="modal">&times;</button>
            </div>
        <form id="deletecenterform" action="" method="POST">

            <!-- Modal body -->
            <div class="modal-body">
                    {{ csrf_field() }}
                    @method('DELETE')
            </div>
            <div class="modal-footer">
                <button class="btn btn-success float-left mx-2" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-danger text-uppercase">Delete center</button>
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



            $('#editquestion').on('show.bs.modal', function(e) {
                var type = $(e.relatedTarget).attr('type');
                var catname = $(e.relatedTarget).attr('catname');
                var catid = $(e.relatedTarget).attr('catid');
                var question = $(e.relatedTarget).attr('question');

            var editurl = $(e.relatedTarget).attr('editurl');
            $("#selectedcause").val(catid);
            $("#selectedcause").text(catname);
            $("#selectedtype").val(type);
            $("#selectedtype").text(type);
            $("#prequestion").val(question);
            $("#editquestionform").attr("action", editurl);
    })

        $('#deletequestion').on('show.bs.modal', function(e) {
                var centername = $(e.relatedTarget).attr('question');
                var deleteurl = $(e.relatedTarget).attr('deurl');
                $("#deletecentername").text(centername);
                $("#deletecenterform").attr("action", deleteurl);
            })


    })


</script>

@endsection

{{--  @else
<script>window.location = "{{ route('authorisation-denied') }}";</script>

@endif  --}}
