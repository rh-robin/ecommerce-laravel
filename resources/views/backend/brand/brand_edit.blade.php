@extends('admin.admin_master')

@section('content')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="page-title">Brand</h3>
            <div class="d-inline-block align-items-center">
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
                        <li class="breadcrumb-item" aria-current="page">Brand</li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Brand</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="row">
        
        <div class="col-12">

            <div class="box">
               <div class="box-header with-border">
                 <h3 class="box-title">Edit Brand</h3>
               </div>
               <!-- /.box-header -->
               <div class="box-body">
                   <form method="POST" action="{{ route('brand.update') }}" enctype="multipart/form-data">
                    @csrf
                        <input type="hidden" name="id" value="{{ $brand->id }}">
                        <input type="hidden" name="old_image" value="{{ $brand->brand_image }}">
                        <div class="form-group">
                            <h5>Brand Name English <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <input type="text" name="brand_name_en" value="{{ old('brand_name_en') ?? $brand->brand_name_en }}" class="form-control"> <div class="help-block"></div></div>
                            @error('brand_name_en')
                            <div class="form-control-feedback"><small class="text-danger">{{ $message }}</small></div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <h5>Brand Name Bangla <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <input type="text" name="brand_name_bn" value="{{ old('brand_name_bn') ?? $brand->brand_name_bn }}" class="form-control"> <div class="help-block"></div></div>
                            @error('brand_name_bn')
                            <div class="form-control-feedback"><small class="text-danger">{{ $message }}</small></div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <h5>Brand Image <span class="text-danger">*</span></h5>
                            <img id="showImage" class="avatar-bordered mb-3" style="width: 200px; height:auto" src="{{ !empty($brand->brand_image) ? url($brand->brand_image) : url('upload/noimage.jpg') }}" alt="">
                            <div class="controls">
                                <input type="file" id="brand_image" name="brand_image" class="form-control"> <div class="help-block"></div></div>
                            @error('brand_image')
                            <div class="form-control-feedback"><small class="text-danger">{{ $message }}</small></div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Update">
                        </div>
                   </form>
               </div>
               <!-- /.box-body -->
             </div>
             <!-- /.box -->

                      
        </div> {{-- end col-4 --}}
    </div> {{-- end row --}}

</section>



{{-- show selected image with jquery --}}
<script type="text/javascript">
    $(document).ready(function(){
        $('#brand_image').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#showImage').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });
</script>




@endsection