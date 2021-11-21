@extends('users.layout.app')
@section('title', 'Manage roles')
@section('content')


    <section class="section">
        <div class="section-header">
            <h1 class="text-center font-weight-bold"> Manage permission</h1>
        </div>
        <div class="container">

            <div class="card" id="roledisplay">

            <div class="card-footer">
                <div class="alert alert-success alert-dismissible  fade" id="alermessage">
                    <div class="alert-body">

                        <span class="alertme"></span>
                        <button class="close" data-dismiss="alert"><span>&times;</span></button>

                    </div>
                </div>
                <div class="float-right mr-2">
                    <select name="role" class="custom-select-sm select2" id="selectrole">
                        <option value="{{ Auth::user()->getRoleNames()[0] }}" id="{{ Auth::user()->roles->first()->id }}" selected>{{ Auth::user()->getRoleNames()[0] }}</option>
                        @forelse ($roles as $role)
                        <option value="{{ $role->name }}" id="{{ $role->id }}">{{ ucwords($role->name) }}</option>
                        @empty
                        <option value="">No roles available</option>
                        @endforelse

                    </select>
                </div>

            </div>
                <div class="card-body">
                    <div id="accordion">
                        @forelse ($roles as $role)

                        <div  data-parent="#accordion" class="activerole collapse {{ Auth::user()->getRoleNames()[0]==$role->name?"show": "" }}" id="therole{{ $role->id }}">
                            <h3 class="text-danger text-center" id="rolename">{{ $role->name }}</h3>
                            <div class="row" >
                                @forelse ($permisions as $permission)
                                {{--  {{ $role->hasPermissionTo($permission->name) }}  --}}
                                <div class="col-sm-4 col-md-3  col-lg-2">
                                    <div class="form-check mt-2">
                                        <label class="form-check-label">
                                        <input type="checkbox" {{ $role->hasPermissionTo($permission->name)?"checked":"" }} class="form-check-input permission" value="{{  $permission->name  }}">{{ $permission->name }}
                                        </label>
                                    </div>
                                </div>
                                @empty
                                    <h3 class="text-danger text-center">No permission available at moment</h3>
                                @endforelse
                            </div>
                        </div>

                        @empty
                        <h1 class="text-danger text-center"> No available role at moment</h1>
                        @endforelse
                    </div>

                </div>

            </div>


        </div>




    </section>

@endsection
@section('script')
    <script>
        $(document).ready(function() {
            setInterval(() => {
                $("#numbersOfAttendee").load(" #numbersOfAttendee");

            }, 6000);


            // Select2
            if(jQuery().select2) {
                $(".select2").select2();
            }

            $('#selectrole').on('change', function(){
                var role = $(this).find('option:selected').attr('id');//;.children(":selected").attr("id");
                $("#therole"+role).collapse('show');
            })




            $(document).on('change', '.permission', function(){
                var selectrole = $('#selectrole').val();

               if($(this).is(":checked")){
                var permission = $(this).val();
                var status = "add";

                $.ajax({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                type: 'POST',
                url: '{{ route('permission.store') }}',
                data: 'role='+selectrole+"&permission="+permission,
                success: function(data) {
                    $("#alermessage").attr('class', 'alert alert-success show alert-dismissible  fade');
                    $("#alermessage .alert-body .alertme").text(data);
                }
              })

               }else{
                var permission = $(this).val();
                var status = "remove";
                $.ajax({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                type: 'POST',
                url: '{{ route('remove-permission') }}',
                data: 'role='+selectrole+"&permission="+permission,
                success: function(data) {
                    $("#alermessage").attr('class', 'alert alert-danger show alert-dismissible  fade');
                    $("#alermessage .alert-body .alertme").text(data);
                }
              })
               };

            })
        })
    </script>
@endsection
