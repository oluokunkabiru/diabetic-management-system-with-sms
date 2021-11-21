@extends('users.layout.app')
@section('title', 'Manage training center')
@section('content')


    <section class="section">
        <div class="section-header">
            <h1 class="text-center font-weight-bold"> Manage training center</h1>
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
                    <a href="#addcenter" data-toggle="modal" class="btn btn-success text-uppercase ">Add center</a>
                    <div class="table-responsive">
                        <table class="table table-striped v_center" id="table-1">

                            <thead>
                                <tr>
                                    <th class="text-center">
                                        ID
                                    </th>
                                    <th>Training center</th>
                                    <th>Accredit date</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 0;
                                @endphp
                                @forelse ($centers as $center)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ ucwords($center->name) }}</td>
                                    <td>{{ $center->created_at }}</td>
                                <td>
                                    <div class="row">
                                        <a href="#editcenter" centername="{{ ucwords($center->name) }}" editurl="{{ route('training-center.update', $center->id) }}" data-toggle="modal" class="badge badge-pill badge-warning mx-1"><span
                                                class="fa fa-edit p-1 text-white"></span></a>
                                        <a href="#deletecenter" data-toggle="modal" centername="{{ ucwords($center->name) }}" deurl="{{ route('training-center.destroy', $center->id) }}"
                                            class="badge badge-pill badge-danger mx-1"><span
                                                class="fa fa-trash p-1 text-white"></span></a>
                                    </div>
                                </td>
                                </tr>

                                @empty
                                    <h3 class="text-danger"> No centers available at moment</h3>
                                @endforelse



                            </tbody>
                        </table>

                    </div>

                </div>

            </div>


        </div>




    </section>
    {{--  add center  --}}

 <div class="modal" id="addcenter">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title text-uppercase">Add center</h4>
                <button type="button" class="btn btn-danger" data-dismiss="modal">&times;</button>
            </div>
        <form action="" action="{{ route('training-center.store') }}" method="POST">

            <!-- Modal body -->
            <div class="modal-body">


                    {{ csrf_field() }}


                    <!-- Modal footer -->
                    <div class="form-group">
                        <label for="usr">center name:</label>
                        <input id="username" type="text"
                        class="form-control @error('center') is-invalid @enderror" name="center"
                        value="{{ old('center') }}" required autocomplete="center">
                    @if ($errors->has('center'))
                        <span class="invalid-feedback" center="alert">
                            <strong>{{ $errors->first('center') }}</strong>
                        </span>
                    @endif
                </div>

            </div>
            <div class="modal-footer">
                <button class="btn btn-danger float-left mx-2" data-dismiss="modal">Cancel</button>
                <button id="addcategorybtn" type="submit" class="btn  btn-success text-uppercase">Add center</button>
            </div>

        </form>
        </div>
    </div>
</div>

{{--  end of add center  --}}



{{--  edit center  --}}

<div class="modal" id="editcenter">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title text-uppercase">edit center</h4>
                <button type="button" class="btn btn-danger" data-dismiss="modal">&times;</button>
            </div>
        <form id="editcenterform" action="" method="POST">

            <!-- Modal body -->
            <div class="modal-body">


                    {{ csrf_field() }}
                    @method('PUT')


                    <!-- Modal footer -->
                    <div class="form-group">
                        <label for="usr">center name:</label>
                        <input type="text"
                        class="form-control @error('center') is-invalid @enderror" id="centername" name="center"
                        value="{{ old('center') }}" required autocomplete="center">
                    @if ($errors->has('center'))
                        <span class="invalid-feedback" center="alert">
                            <strong>{{ $errors->first('center') }}</strong>
                        </span>
                    @endif
                </div>

            </div>
            <div class="modal-footer">
                <button class="btn btn-danger float-left mx-2" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn  btn-success text-uppercase">Update center</button>
            </div>

        </form>
        </div>
    </div>
</div>

{{--  end of edit center  --}}

{{--  add center  --}}

<div class="modal" id="deletecenter">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title text-uppercase">Delete center : <span id="deletecentername"></span></h4>
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

{{--  end of edit center  --}}
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $('#editcenter').on('show.bs.modal', function(e) {
            var centername = $(e.relatedTarget).attr('centername');
            var editurl = $(e.relatedTarget).attr('editurl');
            $("#centername").val(centername);
            $("#editcenterform").attr("action", editurl);
        })



        $('#deletecenter').on('show.bs.modal', function(e) {
            var centername = $(e.relatedTarget).attr('centername');
            var deleteurl = $(e.relatedTarget).attr('deurl');
            $("#deletecentername").text(centername);
            $("#deletecenterform").attr("action", deleteurl);
        })

        })
    </script>
@endsection
