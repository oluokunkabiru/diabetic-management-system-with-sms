 <!-- partial -->
 @extends('users.layout.app')
 @section('title', 'Super admin Dashboard')
 @section('content')
 <section class="section">
     <div class="section-header">
         <h1>Dashboard</h1>
     </div>
     @if(session('success'))
     <div class="alert alert-success alert-dismissible">
         <button type="button" class="close" data-dismiss="alert">&times;</button>
         <strong>Success! </strong> {{ session('success') }}
     </div>
     @endif

     @if(session('fail'))
     <div class="alert alert-danger alert-dismissible">
         <button type="button" class="close" data-dismiss="alert">&times;</button>
         <strong>OOPS ! </strong> {{ session('fail') }}
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

{{--  @if ( $authrole->hasPermissionTo("total counts") )  --}}


     <div class="row">
         <div class="col-lg-3 col-md-6 col-sm-6 col-12">
             <div class="card card-statistic-1">
                 <div class="card-icon bg-primary">
                     <i class="fa fa-users text-white display-4" ></i>
                 </div>
                 <a href="">
                 <div class="card-wrap">
                     <div class="card-header">
                         <h4>Users</h4>
                     </div>
                     <div class="card-body">
                         {{ count($users) }}
                     </div>
                 </div>
                 </a>
             </div>
         </div>
         <div class="col-lg-3 col-md-6 col-sm-6 col-12">
             <div class="card card-statistic-1">
                 <div class="card-icon bg-danger">
                     <i class="fa fa-book text-white display-4"></i>
                 </div>
                 <a href="">
                 <div class="card-wrap">
                     <div class="card-header">
                         <h4><small>Application</small> </h4>
                     </div>
                     <div class="card-body">
                        {{-- {{ count($application) }} --}}
                     </div>
                 </div>
             </a>
             </div>
         </div>
         <div class="col-lg-3 col-md-6 col-sm-6 col-12">
             <div class="card card-statistic-1">
                 <div class="card-icon bg-warning">
                     <i class="fa fa-map-marker display-4"></i>
                 </div>
             <a href="">
                 <div class="card-wrap">
                     <div class="card-header">
                         <h4><small>Training center</small></h4>
                     </div>

                     <div class="card-body" >
                       {{-- {{ count($centers) }} --}}
                     </div>

                 </div>
             </a>
             </div>
         </div>

         <div class="col-lg-3 col-md-6 col-sm-6 col-12">
             <div class="card card-statistic-1">
                 <div class="card-icon bg-success">
                     <i class="fa fa-handshake display-4"></i>
                 </div>
                 <a href="">
                 <div class="card-wrap">
                     <div class="card-header">
                         <h4>Partners</h4>
                     </div>
                     <div class="card-body">
                         0
                         {{-- 23 --}}
                     </div>
                 </div>
             </a>
             </div>
         </div>
     </div>
{{--  @endif  --}}
     <div class="section-body">
         <h2 class="section-title">{{ ucwords(Auth::user()->name) }}</h2>
         {{--  <p class="section-lead">Change information about yourself on this page.</p>  --}}

         <div class="row mt-sm-4">
             <div class="col-12 col-md-12 col-lg-5">
                 <div class="card profile-widget">
                     <div class="profile-widget-header">
                         <img alt="image" src="{{ Auth::user()->getMedia('avatar')->first()?Auth::user()->getMedia('avatar')->first()->getFullUrl():asset('assets/users/assets/img/avatar/avatar-1.png') }}" class="rounded-circle profile-widget-picture">
                         <div class="profile-widget-items">
                             <div class="profile-widget-item">
                                 <div class="profile-widget-item-label">Total offences</div>
                                 <div class="profile-widget-item-value">2</div>
                             </div>
                             <div class="profile-widget-item">
                                 <div class="profile-widget-item-label">Total paid</div>
                                 <div class="profile-widget-item-value">0</div>
                             </div>
                             <div class="profile-widget-item">
                                 <div class="profile-widget-item-label">Todays offences</div>
                                 <div class="profile-widget-item-value">0</div>
                             </div>
                         </div>
                     </div>


                 </div>
                 <div id="change" class=" card collapse">
                     <div class="card-header">
                         <h4>{{ Auth::user()->name }} profile settings</h4>
                     </div>
                     <div class="card-body">
                         {{--  <form action="{{ route('users.update', Auth::user()->id) }}" enctype="multipart/form-data" method="post">  --}}
                            @csrf
                            @method('PUT')
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ Auth::user()->name, old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Username') }}</label>

                                <div class="col-md-6">
                                    <input id="username" type="email" class="form-control @error('email') is-invalid @enderror" name="email" disabled value="{{ Auth::user()->email, old('email') }}" required autocomplete="email">

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
                                    <input id="phone" type="phone" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{Auth::user()->phone,  old('phone') }}" required autocomplete="email">

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
                                    <input id="upimage" type="file" accept="image/*" class="form-control @error('image') is-invalid @enderror" name="image" value="{{ old('image') }}" autocomplete="email">

                                    @error('image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>



                            </div>
                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Contact Address') }}</label>

                                <div class="col-md-6">
                                    <textarea class="form-control @error('email') is-invalid @enderror" name="address" rows="5" id="comment">
                                        {{ Auth::user()->address, old('address') }}
                                    </textarea>
                                    @error('address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="oldpassword" class="col-md-4 col-form-label text-md-right">{{ __('Old password') }}</label>

                                <div class="col-md-6">
                                    <input id="oldpassword" type="password" class="form-control @error('oldpassword') is-invalid @enderror" name="oldpassword" >

                                    @error('oldpassword')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }} <small class="text-danger text-left">Leave password empty if not change</small></label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>



                            <div class="form-group row">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" >
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Update') }}
                                    </button>
                                </div>
                            </div>
                         </form>
                     </div>
                    </div>
             </div>
             <div class="col-12 col-md-12 col-lg-7">
                 <div class="card">
                         <div class="card-header">
                             <h4>Profile Details</h4>
                         </div>
                         <div class="card-body">
                             <div class="row">
                                 <div class="form-group col-md-6 col-12">
                                     <label class="fa fa-user"></label>
                                    <h6>{{ ucwords(Auth::user()->name) }}</h6>
                                 </div>

                                 <div class="form-group col-md-4 col-12">
                                     <label class="fa fa-phone"></label>
                                    <h6>{{ Auth::user()->phone }}</h6>
                                 </div>
                                 <div class="form-group col-md-4 col-12">
                                    <label class="fas fa-envelope"></label>
                                   <h6>{{ Auth::user()->email }}</h6>
                                </div>
                                <div class="form-group col-md-4 col-12">
                                    <label class="fa fa-phoe">Role</label>
                                   <h6>{{ Auth::user()->getRoleNames()[0]}}</h6>
                                </div>
                                 <div class="form-group col-md-4 col-12">
                                    <label class="fa fa-home"></label>
                                   <h6>{{ Auth::user()->address }}</h6>
                                </div>

                             </div>



                         </div>
                         <div class="card-footer text-right">
                             <a href="#change" data-toggle="collapse" class="btn btn-primary">Changes</a>
                         </div>
                     </form>
                 </div>
                 <div id="uppreviewimage"></div>

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
                reader.onload = function (e) {
                    $('#uppreviewimage + img').remove();
                    $('#uppreviewimage').html('<img src="'+e.target.result+'" class="card-img rounded"/>');
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#upimage").change(function () {
            // alert("hffhgfhg")
            previewpassport(this);
        });
 })
 </script>
 @endsection
