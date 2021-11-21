@extends('users.layout.app')
@section('title', 'Manage roles')
@section('content')


    <section class="section">
        <div class="section-header">
            <h1 class="text-center font-weight-bold"> Configurations <span class="fa fa-cog"></span></h1>
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
                    <div class="card-deck">
                        <div class="card">
                            <div class="card-body">
                                <form enctype="multipart/form-data"
                                    action="{{ route('settings.update', appSettings()->id) }}" method="post">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <label for="usr">Name:</label>
                                        <input id="username" type="text"
                                            class="form-control @error('name') is-invalid @enderror" name="name"
                                            value="{{ appSettings()->name, old('name') }}" required autocomplete="role">
                                        @if ($errors->has('name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="usr">Contact email:</label>
                                        <input id="username" type="text"
                                            class="form-control @error('name') is-invalid @enderror" name="email"
                                            value="{{ implode(',', json_decode(appSettings()->email, true)) }}"
                                            placeholder="admin@koadit.com, info@koadit.com" required autocomplete="role">
                                        @if ($errors->has('email'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="usr">Contact Phone (More than 1, separate by comma):</label>
                                        <input id="username" type="text"
                                            class="form-control @error('phone') is-invalid @enderror" name="phone"
                                            value="{{ implode(',', json_decode(appSettings()->phone, true)) }}"
                                            placeholder="08130584550, 08101162321" required autocomplete="role">
                                        @if ($errors->has('phone'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('phone') }}</strong>
                                            </span>
                                        @endif
                                    </div>


                                    <div class="form-group">
                                        <label for="usr">Contact address:</label>
                                        <textarea name="address" id=""
                                            class="form-control @error('address') is-invalid @enderror">{{ appSettings()->address, old('address') }}</textarea>
                                        @if ($errors->has('address'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('address') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="usr">Logo:</label>
                                        <input id="avatar" type="file"
                                            class="form-control @error('avatar') is-invalid @enderror" name="logo">

                                        @error('avatar')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <hr>
                                    <h4>Social Media</h4>
                                    <hr>
                                    <div class="form-group">
                                        <label for="usr">Facebook:</label>
                                        <input id="username" type="text"
                                            class="form-control @error('name') is-invalid @enderror" name="social[facebook]"
                                            value="{{ json_decode(appSettings()->social, true)['facebook'] }}" required
                                            autocomplete="role">
                                        @if ($errors->has('name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="usr">WhatsApp:</label>
                                        <input id="username" type="text"
                                            class="form-control @error('name') is-invalid @enderror" name="social[whatsapp]"
                                            value="{{ json_decode(appSettings()->social, true)['whatsapp'] }}" required
                                            autocomplete="role">
                                        @if ($errors->has('name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="usr">Twitter:</label>
                                        <input id="username" type="text"
                                            class="form-control @error('name') is-invalid @enderror" name="social[twitter]"
                                            value="{{ json_decode(appSettings()->social, true)['twitter'] }}" required
                                            autocomplete="role">
                                        @if ($errors->has('name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="usr">Instagram:</label>
                                        <input id="username" type="text"
                                            class="form-control @error('name') is-invalid @enderror"
                                            name="social[instagram]"
                                            value="{{ json_decode(appSettings()->social, true)['instagram'] }}" required
                                            autocomplete="role">
                                        @if ($errors->has('name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="usr">Linkedin:</label>
                                        <input id="username" type="text"
                                            class="form-control @error('name') is-invalid @enderror" name="social[linkedin]"
                                            value="{{ json_decode(appSettings()->social, true)['linkedin'] }}" required
                                            autocomplete="role">
                                        @if ($errors->has('name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="usr">Telegram:</label>
                                        <input id="username" type="text"
                                            class="form-control @error('name') is-invalid @enderror" name="social[telegram]"
                                            value="{{ json_decode(appSettings()->social, true)['telegram'] }}" required
                                            autocomplete="role">
                                        @if ($errors->has('name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                    </div>


                            </div>
                        </div>


                        <div class="card">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="content">About Us</label>
                                    <textarea class="form-control blogarea {{ $errors->has('about') ? ' is-invalid' : '' }}"
                                        rows="3" name="about">
                                     {!! appsettings()->about !!}
                                     </textarea>
                                </div>

                                <div class="form-group">
                                    <label for="content">Our Vision</label>
                                    <textarea class="form-control blogarea {{ $errors->has('vision') ? ' is-invalid' : '' }}"
                                        rows="3" name="vision">
                                     {!! appsettings()->vision !!}
                                     </textarea>
                                </div>

                                <div class="form-group">
                                    <label for="content">Our Mission</label>
                                    <textarea class="form-control blogarea {{ $errors->has('mission') ? ' is-invalid' : '' }}"
                                        rows="3" name="mission">
                                     {!! appsettings()->mission !!}
                                     </textarea>
                                </div>
                                <button type="submit"
                                class="btn btn-primary btn-rounded float-right mr-2">Update</button>
                             </form>

                                <div class="text-center" id="uppreviewimage">
                                    <img src="{{ appSettings()->getMedia('logo')->first()
                                        ? appSettings()->getMedia('logo')->first()->getFullUrl()
                                        : asset('assets/users/assets/img/avatar/avatar-1.png') }}"
                                        class="card-img" alt="">
                                </div>
                                <hr>
                                <h4>{{ appSettings()->name }}</h4>
                                <hr>
                                <h4>{{ implode(',', json_decode(appSettings()->phone, true)) }}</h4>
                                <hr>
                                <h4>{{ implode(',', json_decode(appSettings()->email, true)) }}</h4>
                                <hr>
                                <h6>{{ appSettings()->address }}</h6>
                                <hr>
                                <p>Last update <span class="font-weight-bold">{{ appSettings()->updated_at }}</span></p>
                            </div>
                        </div>


                    </div>
                </div>

            </div>


        </div>




    </section>



@endsection
@section('script')
    <script>
        $(document).ready(function() {
            function previewpassport(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#uppreviewimage + img').remove();
                        $('#uppreviewimage').html('<img src="' + e.target.result +
                            '" class="card-img rounded"/>');
                    };
                    reader.readAsDataURL(input.files[0]);
                }
            }

            $("#avatar").change(function() {
                previewpassport(this);
            });


            $('textarea').summernote({
                    height: 100,
                    toolbar: [
                        ['font', ['bold', 'italic', 'underline']],

                    ]

                })

        })
    </script>
@endsection
