@extends('admin.admin_master')

@section('content')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="page-title">Category</h3>
            <div class="d-inline-block align-items-center">
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
                        <li class="breadcrumb-item" aria-current="page">Category</li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Sub Sub-Categories</li>
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
                 <h3 class="box-title">Update Sub Sub-Category</h3>
               </div>
               <!-- /.box-header -->
               <div class="box-body">
                   <form method="POST" action="{{ route('subsubcategory.update') }}">
                    @csrf
                        <input type="hidden" name="id" value="{{ $subsubcategory->id }}">
                        <div class="form-group">
                            <h5>Sub Sub-Category Name English <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <input type="text" name="subsubcategory_name_en" value="{{ old('subsubcategory_name_en') ?? $subsubcategory->subsubcategory_name_en }}" class="form-control"> <div class="help-block"></div></div>
                            @error('subsubcategory_name_en')
                            <div class="form-control-feedback"><small class="text-danger">{{ $message }}</small></div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <h5>Sub Sub-Category Name Bangla <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <input type="text" name="subsubcategory_name_bn" value="{{ old('subsubcategory_name_bn') ?? $subsubcategory->subsubcategory_name_bn }}" class="form-control"> <div class="help-block"></div></div>
                            @error('subsubcategory_name_bn')
                            <div class="form-control-feedback"><small class="text-danger">{{ $message }}</small></div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <h5>Select Category <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <select name="category_id" id="select" class="form-control" aria-invalid="false">
                                    <option value="" selected disabled>Select Category</option>
                                    @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"  {{ $subsubcategory->category_id == $category->id ? 'selected' : '' }}>{{ $category->category_name_en }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('category_id')
                            <div class="form-control-feedback"><small class="text-danger">{{ $message }}</small></div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <h5>Select Sub-Category <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <select name="subcategory_id" id="select" class="form-control" aria-invalid="false">
                                    <option value="" selected disabled>Select Sub-Category</option>
                                    @foreach ($subcategories as $subcategory)
                                    <option value="{{ $subcategory->id }}"  {{ $subsubcategory->subcategory_id == $subcategory->id ? 'selected' : '' }}>{{ $subcategory->subcategory_name_en }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('subcategory_id')
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


<script type="text/javascript">
    $(document).ready(function(){
        $('select[name="category_id"]').on('change', function(){
            var category_id = $(this).val();
            if(category_id){
                $.ajax({
                    url: "{{ url('/category/subcategory/ajax') }}/"+category_id,
                    type: "GET",
                    dataType: "json",
                    success: function(data){
                        var d = $('select[name="subcategory_id"]').empty();
                        $.each(data, function(key, value){
                            $('select[name="subcategory_id"]').append('<option value="'+value.id+'">'+value.subcategory_name_en+'</option>');
                        });
                    }
                });
            }else{
                alert('danger');
            }
        });
    });
</script>





@endsection