@extends('admin.admin_master')

@section('content')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="page-title">Category </h3>
            <div class="d-inline-block align-items-center">
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
                        <li class="breadcrumb-item" aria-current="page">Category</li>
                        <li class="breadcrumb-item active" aria-current="page">All Sub Categories</li>
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
                  <h3 class="box-title">Add Sub Category</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <form method="POST" action="{{ route('subcategory.update') }}">
                     @csrf
                     <input name="id" type="hidden" value="{{$subcategory->id}}">
                         <div class="form-group">
                             <h5>Sub Category Name English <span class="text-danger">*</span></h5>
                             <div class="controls">
                                 <input type="text" name="subcategory_name_en" value="{{ old('subcategory_name_en') ?? $subcategory->subcategory_name_en }}" class="form-control"> <div class="help-block"></div></div>
                             @error('subcategory_name_en')
                             <div class="form-control-feedback"><small class="text-danger">{{ $message }}</small></div>
                             @enderror
                         </div>
                         <div class="form-group">
                             <h5>Sub Category Name Bangla <span class="text-danger">*</span></h5>
                             <div class="controls">
                                 <input type="text" name="subcategory_name_bn" value="{{ old('subcategory_name_bn') ?? $subcategory->subcategory_name_bn }}" class="form-control"> <div class="help-block"></div></div>
                             @error('subcategory_name_bn')
                             <div class="form-control-feedback"><small class="text-danger">{{ $message }}</small></div>
                             @enderror
                         </div>
                         <div class="form-group">
                             <h5>Select Category <span class="text-danger">*</span></h5>
                             <div class="controls">
                                 <select name="category_id" id="select" class="form-control" aria-invalid="false">
                                     <option value="" selected disabled>Select Parent Category</option>
                                     @foreach ($categories as $category)
                                     <option value="{{ $category->id }}" {{ $category->id== $subcategory->category_id ? 'selected' : '' }}>{{ $category->category_name_en }}</option>
                                     @endforeach
                                 </select>
                             </div>
                             @error('category_id')
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
            

                      
        </div> {{-- end col-12 --}}
    </div> {{-- end row --}}

</section>



{{-- show selected image with jquery --}}
<script type="text/javascript">
    $(document).ready(function(){
        $('#category_image').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#showImage').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });
</script>




@endsection