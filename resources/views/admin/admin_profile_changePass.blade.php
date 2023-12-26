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
                        <li class="breadcrumb-item active" aria-current="page">Change Password</li>
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
                    <h4 class="box-title">Change your password</h4>
                    {{-- <h6 class="box-subtitle">Bootstrap Form Validation check the <a class="text-warning" href="http://reactiveraven.github.io/jqBootstrapValidation/">official website </a></h6> --}}
                </div>
            </div>
        
            
       </div>
       <!-- /.box-header -->
       <div class="box-body">
         <div class="row">
           <div class="col">
              <form method="POST" action="{{ route('admin.profile.update_password') }}">
                @csrf
                <div class="row">
                  <div class="col-12">	
                        <div class="form-group">
                            <h5>Current Password <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <input type="password" name="oldPassword" class="form-control" id="current_password"> <div class="help-block"></div></div>
                            @error('oldPassword')
                            <div class="form-control-feedback"><small class="text-danger">{{ $message }}</small></div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <h5>New Password  <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <input type="password" name="password" id="password" class="form-control"> <div class="help-block"></div></div>
                            @error('password')
                            <div class="form-control-feedback"><small class="text-danger">{{ $message }}</small></div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <h5>Confirm Password  <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control"> <div class="help-block"></div></div>
                            @error('password_confirmation')
                            <div class="form-control-feedback"><small class="text-danger">{{ $message }}</small></div>
                            @enderror
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






@endsection