@extends('users.layout.app')
@section('title', 'Add new User')

@section('content')
<section class="section">
    <div class="section-header">
        <h1 class="text-center font-weight-bold"> Add new user</h1>
    </div>
    <div class="container">

        <div class="card">
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
            <div class="row">
                <div class="col-md-2">
                    <img src="" id="desc_img" class="card-img" style="width: 200px"  alt="">

                </div>

                <div class="col-md-8">
                    <form action="{{ route('user-management.store') }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}

                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{  old('name') }}" required autocomplete="name" autofocus>

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>

                        <div class="col-md-6">
                            <input id="username" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{  old('email') }}" required autocomplete="email">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Phone') }}</label>

                        <div class="col-md-6">
                            <input id="phone" type="phone" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="email">

                            @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Role') }}</label>

                        <div class="col-md-6">
                            <select class="form-control" id="sel1" name="role">
                                <option disabled selected>--Select role --</option>

                                @forelse ($roles as $item)
                                <option value="{{ $item->name }}">{{ ucwords($item->name) }}</option>
                                @empty

                                @endforelse

                            </select>
                            @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="image" class="col-md-4 col-form-label text-md-right">{{ __('Profile picture') }}</label>

                        <div class="col-md-6">
                            <input id="upimage" type="file" accept="image/*" class="form-control @error('image') is-invalid @enderror" name="image" autocomplete="email">

                            @error('image')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>



                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('About') }}</label>

                        <div class="col-md-6">
                            <textarea class="form-control @error('about') is-invalid @enderror" name="about" rows="5" id="comment">
                                {{  old('about') }}
                            </textarea>
                            @error('about')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-rounded text-uppercase float-right">Add new user</button>


                    </form>
                </div>
                <div class="col-md-2">

                </div>
            </div>

        </div>
    </div>
</section>
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


        $("#upimage").change(function () {
            previewpassport(this);
        });

                $(".select2").select2();
            })

</script>
@endsection

