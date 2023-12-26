@extends('admin.admin_master')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="page-title">Profile</h3>
            <div class="d-inline-block align-items-center">
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
                        <li class="breadcrumb-item" aria-current="page">Extra</li>
                        <li class="breadcrumb-item active" aria-current="page">Profile</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="row">
        <div class="col-12">
            
            <div class="box box-inverse bg-img" data-overlay="2">
                <div class="flexbox px-20 pt-20">
                  <label class="toggler toggler-danger text-white">
                    {{-- <input type="checkbox">
                    <i class="fa fa-heart"></i> --}}
                  </label>
                  <div class="">
                    <a href="{{ route('admin.profile.edit') }}" class="btn btn-rounded btn-info mb-5">Edit Profile</a>
                  </div>
                </div>

                <div class="box-body text-center pb-50">
                  <a href="#">
                    <img class="avatar avatar-xxl avatar-bordered" src="{{ !empty($adminData->profile_photo_path) ? url('upload/admin_images/'.$adminData->profile_photo_path) : url('upload/noimage.jpg') }}" alt="">
                  </a>
                  <h4 class="mt-2 mb-0">Admin Name:<a class="hover-primary text-white" href="#"> {{ $adminData->name }}</a></h4>
                  <span><i class="fa fa-envelope w-20"></i>Admin Email: {{ $adminData->email }}</span>
                </div>

                <ul class="box-body flexbox flex-justified text-center" data-overlay="4">
                  <li>
                    <span id="test" class="opacity-60 test">Followers</span><br>
                    <span class="font-size-20">8.6K</span>
                  </li>
                  <li>
                    <span class="opacity-60">Following</span><br>
                    <span class="font-size-20">8457</span>
                  </li>
                  <li>
                    <span class="opacity-60">Tweets</span><br>
                    <span class="font-size-20">2154</span>
                  </li>
                </ul>
            </div>





        </div>
    </div>
</section>
@endsection