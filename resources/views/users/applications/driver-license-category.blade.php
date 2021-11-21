@extends('users.layout.app')
@section('title', 'Driver License type')

@section('content')
<section class="section">
    <div class="section-header">
        <h1 class="text-center font-weight-bold"> Manage driver license</h1>
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
                <a href="#addpickup" data-toggle="modal" class="btn btn-success text-uppercase ">Add driver license</a>
                <div class="table-responsive">
                    <table class="table table-striped v_center" id="userslist">

                        <thead>
                            <tr>
                                <th class="text-center">
                                    ID
                                </th>
                                <th>Driver Licence</th>
                                <th>Price</th>
                                <th>Description</th>
                                <th>Accredit date</th>
                                <th>Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 0;
                            @endphp
                            @forelse ($category as $pick)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ ucwords($pick->name) }}</td>
                                <td><span class="fa">&#8358; </span>{{ number_format($pick->price,2,".",",")}}</td>
                                <td>{!! $pick->description !!}</td>
                                <td>{{ $pick->created_at }}</td>
                            <td>
                                <div class="row">
                                    <a href="#editcenter" centername="{{ ucwords($pick->name) }}" price="{{ $pick->price }}" desc="{{ $pick->description }}" editurl="{{ route('driver-licence-category-up', $pick->id) }}" data-toggle="modal" class="badge badge-pill badge-warning mx-1"><span
                                            class="fa fa-edit p-1 text-white"></span></a>
                                    <a href="#deletecenter" data-toggle="modal" centername="{{ ucwords($pick->name) }}" deurl="{{ route('driver-lincense-process.destroy', $pick->id) }}"
                                        class="badge badge-pill badge-danger mx-1"><span
                                            class="fa fa-trash p-1 text-white"></span></a>
                                </div>
                            </td>
                            </tr>

                            @empty
                                <h3 class="text-danger"> No driver license category available at moment</h3>
                            @endforelse



                        </tbody>
                    </table>

                </div>

            </div>

        </div>


    </div>




</section>
{{--  add center  --}}

<div class="modal" id="addpickup">
<div class="modal-dialog">
    <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
            <h4 class="modal-title text-uppercase">Add driver license </h4>
            <button type="button" class="btn btn-danger" data-dismiss="modal">&times;</button>
        </div>
    <form action="{{ route('driver-licence-category') }}" method="POST">

        <!-- Modal body -->
        <div class="modal-body">


                {{ csrf_field() }}


                <!-- Modal footer -->
                <div class="form-group">
                    <label for="usr">Driver license name:</label>
                    <input id="username" type="text"
                    class="form-control @error('name') is-invalid @enderror" name="name"
                    value="{{ old('name') }}" required autocomplete="name">
                @if ($errors->has('name'))
                    <span class="invalid-feedback" center="alert">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group">
            <label for="usr">Driver license price:</label>
                    <input id="username" type="number"
                    class="form-control @error('price') is-invalid @enderror" name="price"
                    value="{{ old('price') }}" required autocomplete="price">
                @if ($errors->has('price'))
                    <span class="invalid-feedback" center="alert">
                        <strong>{{ $errors->first('price') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group">
            <label for="usr">Driver license description:</label>
            <textarea name="desc" id=""class="form-control @error('desc') is-invalid @enderror">
                {{ old('desc') }}
            </textarea>

        @if ($errors->has('desc'))
            <span class="invalid-feedback" center="alert">
                <strong>{{ $errors->first('desc') }}</strong>
            </span>
        @endif
    </div>

        </div>
        <div class="modal-footer">
            <button class="btn btn-danger float-left mx-2" data-dismiss="modal">Cancel</button>
            <button id="addcategorybtn" type="submit" class="btn  btn-success text-uppercase">Add driver license</button>
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
            <h4 class="modal-title text-uppercase">edit driver license</h4>
            <button type="button" class="btn btn-danger" data-dismiss="modal">&times;</button>
        </div>
    <form id="editcenterform" action="" method="POST">

        <!-- Modal body -->
        <div class="modal-body">


                {{ csrf_field() }}
                @method('PUT')


                <div class="form-group">
                    <label for="usr">Driver license name:</label>
                    <input id="name" type="text"
                    class="form-control @error('name') is-invalid @enderror" name="name"
                    value="{{ old('name') }}" required autocomplete="name">
                @if ($errors->has('name'))
                    <span class="invalid-feedback" center="alert">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group">
            <label for="usr">Driver license price:</label>
                    <input id="price" type="number"
                    class="form-control @error('price') is-invalid @enderror" name="price"
                    value="{{ old('price') }}" required autocomplete="price">
                @if ($errors->has('price'))
                    <span class="invalid-feedback" center="alert">
                        <strong>{{ $errors->first('price') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group">
            <label for="usr">Driver license description:</label>
            <textarea name="desc" id="desc"class="form-control @error('desc') is-invalid @enderror">
                {{ old('desc') }}
            </textarea>

        @if ($errors->has('desc'))
            <span class="invalid-feedback" center="alert">
                <strong>{{ $errors->first('desc') }}</strong>
            </span>
        @endif
    </div>

        </div>
        <div class="modal-footer">
            <button class="btn btn-danger float-left mx-2" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn  btn-success text-uppercase">Update driver license</button>
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
            <h4 class="modal-title text-uppercase">Delete driver license: <span id="deletecentername"></span></h4>
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
        $("#userslist").dataTable({
                "columnDefs": [{
                    "sortable": false,
                    "targets": [2, 3]
                }]
            });

            $('textarea').summernote({
                    height: 100,
                    toolbar: [
                        ['font', ['bold', 'italic', 'underline']],

                    ]

                })
                
        $('#editcenter').on('show.bs.modal', function(e) {
            var centername = $(e.relatedTarget).attr('centername');
            var price = $(e.relatedTarget).attr('price');
            var desc = $(e.relatedTarget).attr('desc');
        var editurl = $(e.relatedTarget).attr('editurl');
        $("#name").val(centername);
        $("#price").val(price);
        $("#desc").text(desc);
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


