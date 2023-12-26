@extends('admin.admin_master')

@section('content')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="page-title">Edit Profile</h3>
            <div class="d-inline-block align-items-center">
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
                        <li class="breadcrumb-item" aria-current="page">Profile</li>
                        <li class="breadcrumb-item active" aria-current="page">Edit</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<section class="content">

    <!-- Basic Forms -->
     <div class="box">
        
       <div class="box-header with-border">
            <div class="flexbox">
                <div class="">
                    <h4 class="box-title">Edit your profile</h4>
                    {{-- <h6 class="box-subtitle">Bootstrap Form Validation check the <a class="text-warning" href="http://reactiveraven.github.io/jqBootstrapValidation/">official website </a></h6> --}}
                </div>
                <div class="">
                    <a href="{{ route('admin.profile.change_password') }}" class="btn btn-rounded btn-info mb-5">Change Password</a>
                </div>
            </div>
        
            
       </div>
       <!-- /.box-header -->
       <div class="box-body">
         <div class="row">
           <div class="col">
              <form method="POST" action="{{ route('admin.profile.update') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                  <div class="col-12">						
                        <div class="form-group">
                            <h5>Name <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <input type="text" name="name" class="form-control" value="{{ $adminData->name }}"> <div class="help-block"></div></div>
                            <div class="form-control-feedback"><small class="text-danger">error.</small></div>
                        </div>
                        <div class="form-group">
                            <h5>Email <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <input type="email" name="email" class="form-control" value="{{ $adminData->email }}"> <div class="help-block"></div></div>
                        </div>
                        {{-- <div class="form-group">
                            <h5>Password <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <input type="password" name="password" class="form-control" required="" data-validation-required-message="This field is required"> <div class="help-block"></div></div>
                        </div>
                        <div class="form-group">
                            <h5>Confirm Password  <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <input type="password" name="password2" data-validation-match-match="password" class="form-control" required=""> <div class="help-block"></div></div>
                        </div> --}}

                        <div class="form-group">
                            <h5>Profile Image <span class="text-danger">*</span></h5>
                            <img id="showImage" class="avatar-bordered" style="width: 200px; height:auto" src="{{ !empty($adminData->profile_photo_path) ? url('upload/admin_images/'.$adminData->profile_photo_path) : url('upload/noimage.jpg') }}" alt="">
                            <div class="controls" style="margin-top:15px">
                                <input id="image" type="file" name="profile_photo_path" class="form-control"> <div class="help-block">ghdfgh</div></div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-rounded btn-info">Update</button>
                        </div>
                  </div>
                  
                  
              </form>

            </div>
            <!-- /.col -->
            </div>
        <!-- /.row -->
    </div>
    <!-- /.box-body -->
    </div>
    <!-- /.box -->

</section>



{{-- show selected image with jquery --}}
<script type="text/javascript">
    $(document).ready(function(){
        $('#image').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#showImage').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });
</script>


@endsection