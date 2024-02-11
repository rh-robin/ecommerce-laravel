@extends('admin.admin_master')

@section('content')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="page-title">Product</h3>
            <div class="d-inline-block align-items-center">
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
                        <li class="breadcrumb-item" aria-current="page">Product</li>
                        <li class="breadcrumb-item active" aria-current="page">Add Product</li>
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
                 <h3 class="box-title">Edit Product Using This Form</h3>
               </div>
               <!-- /.box-header -->
               <div class="box-body">
                    <form method="POST" action="{{ route('product.dataUpdate') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{ $product->id }}">
                        <div class="row"> {{-- start 1st row --}}
                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5>Select Brand <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <select name="brand_id" id="select" class="form-control" aria-invalid="false">
                                            <option value="" selected disabled>Select Brand</option>
                                            @foreach ($brands as $brand)
                                            <option value="{{ $brand->id }}" {{ $brand->id == $product->brand_id ? 'selected': '' }} >{{ $brand->brand_name_en }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('category_id')
                                    <div class="form-control-feedback"><small class="text-danger">{{ $message }}</small></div>
                                    @enderror
                                </div> {{-- end form group --}}
                            </div>{{-- end col-md-4 --}}
                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5>Select Category <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <select name="category_id" id="select" class="form-control" aria-invalid="false">
                                            <option value="" selected disabled>Select Category</option>
                                            @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" {{ $category->id == $product->category_id ? 'selected': '' }} >{{ $category->category_name_en }}</option>	
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('category_id')
                                    <div class="form-control-feedback"><small class="text-danger">{{ $message }}</small></div>
                                    @enderror
                                </div> {{-- end form group --}}
                            </div>{{-- end col-md-4 --}}
                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5>Select Sub-Category <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <select name="subcategory_id" id="select" class="form-control" aria-invalid="false">
                                            <option value="" selected disabled>Select Sub-Category</option>

                                            @foreach($subcategories as $subcategory)
                                            <option value="{{ $subcategory->id }}" {{ $subcategory->id == $product->subcategory_id ? 'selected': '' }} >{{ $subcategory->subcategory_name_en }}</option>	
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('subcategory_id')
                                    <div class="form-control-feedback"><small class="text-danger">{{ $message }}</small></div>
                                    @enderror
                                </div> {{-- end form group --}}
                            </div>{{-- end col-md-4 --}}
                        </div> {{-- end 1st row --}}

                        <div class="row"> {{-- start 2nd row --}}
                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5>Select Sub Sub-Category <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <select name="subsubcategory_id" id="select" class="form-control" aria-invalid="false">
                                            <option value="" selected disabled>Select Sub Sub-Category</option>

                                            @foreach($subsubcategories as $subsub)
                                            <option value="{{ $subsub->id }}" {{ $subsub->id == $product->subsubcategory_id ? 'selected': '' }} >{{ $subsub->subsubcategory_name_en }}</option>	
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('subsubcategory_id')
                                    <div class="form-control-feedback"><small class="text-danger">{{ $message }}</small></div>
                                    @enderror
                                </div> {{-- end form group --}}
                            </div> {{-- end col-md-4 --}}
                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5>Product Name English <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="product_name_en" value="{{ $product->product_name_en }}" class="form-control"> <div class="help-block"></div></div>
                                    @error('product_name_en')
                                    <div class="form-control-feedback"><small class="text-danger">{{ $message }}</small></div>
                                    @enderror
                                </div> {{-- end form group --}}
                            </div>{{-- end col-md-4 --}}
                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5>Product Name Bangla <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="product_name_bn" value="{{ $product->product_name_bn }}" class="form-control"> <div class="help-block"></div></div>
                                    @error('product_name_bn')
                                    <div class="form-control-feedback"><small class="text-danger">{{ $message }}</small></div>
                                    @enderror
                                </div> {{-- end form group --}}
                            </div>{{-- end col-md-4 --}}
                        </div> {{-- end 2nd row --}}

                        <div class="row"> {{-- start 3rd row --}}
                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5>Product Code <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="product_code" value="{{ $product->product_code }}" class="form-control"> <div class="help-block"></div>
                                    </div>
                                    @error('product_code')
                                    <div class="form-control-feedback"><small class="text-danger">{{ $message }}</small></div>
                                    @enderror
                                </div> {{-- end form group --}}
                            </div> {{-- end col-md-4 --}}
                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5>Product Quantity <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input class="form-control" type="number" value="{{ $product->product_quantity }}" name="product_quantity"> <div class="help-block"></div>
                                    </div>
                                    @error('product_quantity')
                                    <div class="form-control-feedback"><small class="text-danger">{{ $message }}</small></div>
                                    @enderror
                                </div> {{-- end form group --}}
                            </div>{{-- end col-md-4 --}}
                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5>Product Tags English <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input name="product_tags_en" class="form-control" type="text" value="{{ $product->product_tags_en }}" data-role="tagsinput" placeholder="add tags" /> <div class="help-block"></div>
                                    </div>
                                    @error('product_tags_en')
                                    <div class="form-control-feedback"><small class="text-danger">{{ $message }}</small></div>
                                    @enderror
                                </div> {{-- end form group --}}
                            </div>{{-- end col-md-4 --}}
                        </div> {{-- end 3rd row --}}

                        <div class="row"> {{-- start 4th row --}}
                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5>Product Tags Bangla <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input name="product_tags_bn" class="form-control" type="text" value="{{ $product->product_tags_bn }}" data-role="tagsinput" placeholder="add tags" /> <div class="help-block"></div>
                                    </div>
                                    @error('product_tags_bn')
                                    <div class="form-control-feedback"><small class="text-danger">{{ $message }}</small></div>
                                    @enderror
                                </div> {{-- end form group --}}
                            </div> {{-- end col-md-4 --}}
                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5>Product Size English <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input name="product_size_en" class="form-control" type="text" value="{{ $product->product_size_en }}" data-role="tagsinput" placeholder="add sizes" /> <div class="help-block"></div>
                                    </div>
                                    @error('product_size_en')
                                    <div class="form-control-feedback"><small class="text-danger">{{ $message }}</small></div>
                                    @enderror
                                </div> {{-- end form group --}}
                            </div>{{-- end col-md-4 --}}
                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5>Product Size Bangla <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input name="product_size_bn" class="form-control" type="text" value="{{ $product->product_size_bn }}" data-role="tagsinput" placeholder="add sizes" /> <div class="help-block"></div>
                                    </div>
                                    @error('product_size_bn')
                                    <div class="form-control-feedback"><small class="text-danger">{{ $message }}</small></div>
                                    @enderror
                                </div> {{-- end form group --}}
                            </div>{{-- end col-md-4 --}}
                        </div> {{-- end 4th row --}}

                        <div class="row"> {{-- start 5th row --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h5>Product Color English <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input name="product_color_en" class="form-control" type="text" value="{{ $product->product_color_en }}" data-role="tagsinput" placeholder="add colors" /> <div class="help-block"></div>
                                    </div>
                                    @error('product_color_en')
                                    <div class="form-control-feedback"><small class="text-danger">{{ $message }}</small></div>
                                    @enderror
                                </div> {{-- end form group --}}
                            </div> {{-- end col-md-6 --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h5>Product Color Bangla <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input name="product_color_bn" class="form-control" type="text" value="{{ $product->product_color_bn }}" data-role="tagsinput" placeholder="add colors" /> <div class="help-block"></div>
                                    </div>
                                    @error('product_color_bn')
                                    <div class="form-control-feedback"><small class="text-danger">{{ $message }}</small></div>
                                    @enderror
                                </div> {{-- end form group --}}
                            </div>{{-- end col-md-6 --}}
                            
                        </div> {{-- end 5th row --}}

                        <div class="row"> {{-- start 6th row --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h5>Product Selling Price <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="selling_price" value="{{ $product->selling_price }}" class="form-control"> <div class="help-block"></div>
                                    </div>
                                    @error('selling_price')
                                    <div class="form-control-feedback"><small class="text-danger">{{ $message }}</small></div>
                                    @enderror
                                </div> {{-- end form group --}}
                            </div>{{-- end col-md-6 --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h5>Product Discount Price <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="discount_price" value="{{ $product->discount_price }}" class="form-control"> <div class="help-block"></div>
                                    </div>
                                    @error('discount_price')
                                    <div class="form-control-feedback"><small class="text-danger">{{ $message }}</small></div>
                                    @enderror
                                </div> {{-- end form group --}}
                            </div> {{-- end col-md-6 --}}
                            
                        </div> {{-- end 6th row --}}

                        <div class="row"> {{-- start 7th row --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h5>Short Description English <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <textarea name="short_desc_en" id="textarea" class="form-control">{{ $product->short_desc_en }}</textarea> <div class="help-block"></div>
                                    </div>
                                    @error('short_desc_en')
                                    <div class="form-control-feedback"><small class="text-danger">{{ $message }}</small></div>
                                    @enderror
                                </div> {{-- end form group --}}
                            </div> {{-- end col-md-6 --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h5>Short Description Bangla <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <textarea name="short_desc_bn" id="textarea" class="form-control">{{ $product->short_desc_bn }}</textarea> <div class="help-block"></div>
                                    </div>
                                    @error('short_desc_bn')
                                    <div class="form-control-feedback"><small class="text-danger">{{ $message }}</small></div>
                                    @enderror
                                </div> {{-- end form group --}}
                            </div>{{-- end col-md-6 --}}
                        </div> {{-- end 7th row --}}

                        <div class="row"> {{-- start 8th row --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h5>Long Description English <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <textarea id="editor1" name="long_desc_en" rows="10" cols="80">
                                            {{ $product->long_desc_en }}
                                        </textarea> <div class="help-block"></div>
                                    </div>
                                    @error('long_desc_en')
                                    <div class="form-control-feedback"><small class="text-danger">{{ $message }}</small></div>
                                    @enderror
                                </div> {{-- end form group --}}
                            </div> {{-- end col-md-6 --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h5>Long Description Bangla <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <textarea id="editor2" name="long_desc_bn" rows="10" cols="80">
                                            {{ $product->long_desc_bn }}
                                        </textarea> <div class="help-block"></div>
                                    </div>
                                    @error('long_desc_bn')
                                    <div class="form-control-feedback"><small class="text-danger">{{ $message }}</small></div>
                                    @enderror
                                </div> {{-- end form group --}}
                            </div>{{-- end col-md-6 --}}
                        </div> {{-- end 8th row --}}

                        <hr>

                        <div class="row"> {{-- start 9th row --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="controls">
                                        <fieldset>
											<input type="checkbox" id="checkbox_2" name="hot_deals" value="1" {{ $product->hot_deals == 1 ? 'checked': '' }}>
											<label for="checkbox_2">Hot Deals</label>
										</fieldset>
										<fieldset>
											<input type="checkbox" id="checkbox_3" value="1" name="featured" {{ $product->featured == 1 ? 'checked': '' }}>
											<label for="checkbox_3">Featured</label>
										</fieldset> <div class="help-block"></div>
                                    </div>
                                </div> {{-- end form group --}}
                            </div> {{-- end col-md-6 --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="controls">
                                        <fieldset>
											<input type="checkbox" id="checkbox_4" value="1" name="special_offer" {{ $product->special_offer == 1 ? 'checked': '' }}>
											<label for="checkbox_4">Special Offers</label>
										</fieldset>
										<fieldset>
											<input type="checkbox" id="checkbox_5" value="1" name="special_deals" {{ $product->special_deals == 1 ? 'checked': '' }}>
											<label for="checkbox_5">Special Deals</label>
										</fieldset> <div class="help-block"></div>
                                    </div>
                                </div> {{-- end form group --}}
                            </div>{{-- end col-md-6 --}}
                        </div> {{-- end 9th row --}}
                        <div class="form-group">
                            <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Update Data">
                        </div>
                    </form>
               </div>
               <!-- /.box-body -->
             </div>
             <!-- /.box -->

                      
        </div> {{-- end col-4 --}}
    </div> {{-- end row --}}

</section>

{{-- update multi image start --}}
<section class="content">
    <div class="row">

        <div class="col-md-12">
            <div class="box bt-3 border-info">
                <div class="box-header">
                    <h4 class="box-title">Product Multiple Image <strong>Update</strong></h4>
                </div>

                <div class="box-body">
                    <form method="post" action="{{ route('product.multiImgUpdate') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row row-sm">
                            @foreach($multiImgs as $img)
                            <div class="col-md-3">
    
                                <div class="card">
                                    <img src="{{ asset($img->image_name) }}" class="card-img-top" style="height: 130px; width: 280px;">
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            <a href="{{ route('product.multiImgDelete',$img->id) }}" class="btn btn-sm btn-danger" id="delete" title="Delete Data"><i class="fa fa-trash"></i> </a>
                                        </h5>
                                        <p class="card-text"> 
                                            <div class="form-group">
                                                <label class="form-control-label">Change Image <span class="tx-danger">*</span></label>
                                                <input class="form-control" type="file" name="multi_img[{{ $img->id }}]">
                                            </div> 
                                        </p>
                                    </div> <!--  end card-body	 -->
                                </div> <!--  end card	 -->
                            </div><!--  end col md 3		 -->	
                            @endforeach
    
                        </div> <!--  end row -->		
    
                        <div class="text-xs-right">
                            <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Update Image">
                        </div>
                        <br><br>
                    </form>
                </div>
            </div> <!-- // end box  -->
        </div> <!-- // end col-md-12  -->
    </div> <!-- // end row  -->
</section>
{{-- update multi image end --}}


{{-- update thumbnail start --}}
<section class="content">
    <div class="row">

        <div class="col-md-12">
            <div class="box bt-3 border-info">
                <div class="box-header">
                    <h4 class="box-title">Product Thumbnail <strong>Update</strong></h4>
                </div>

                <div class="box-body">
                    <form method="post" action="{{ route('product.thumbnailUpdate') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row row-sm">
                            <div class="col-md-3">

                                <input type="hidden" name="id" value="{{ $product->id }}">
                                <input type="hidden" name="old_img" value="{{ $product->product_thumbnail }}">

                                <div class="card">
                                    <img src="{{ asset($product->product_thumbnail) }}" class="card-img-top" style="height: 130px; width: 280px;">
                                    <div class="card-body">
                                        <p class="card-text"> 
                                            <div class="form-group">
                                                <label class="form-control-label">Change Image <span class="tx-danger">*</span></label>
                                                <input type="file" name="product_thumbnail" class="form-control" onChange="mainThumbUrl(this)"  >
                                                <img src="" id="mainThumb">
                                            </div> 
                                        </p>
                                    </div> <!--  end card-body	 -->
                                </div> <!--  end card	 -->
                            </div> <!--  end col md 3 -->	
    
                        </div> <!--  end row -->		
    
                        <div class="text-xs-right">
                            <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Update Image">
                        </div>
                        <br><br>
                    </form>
                </div>
            </div> <!-- // end box  -->
        </div> <!-- // end col-md-12  -->
    </div> <!-- // end row  -->
</section>
{{-- update thumbnail end --}}




<script type="text/javascript">
    $(document).ready(function(){
        /* scripts to get category wise subcategory */
        $('select[name="category_id"]').on('change', function(){
            var category_id = $(this).val();
            if(category_id){
                $.ajax({
                    url: "{{ url('/category/subcategory/ajax') }}/"+category_id,
                    type: "GET",
                    dataType: "json",
                    success: function(data){
                        $('select[name="subsubcategory_id"]').html('');
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

        /* scripts to get subcategory wise subsubcategory */
        $('select[name="subcategory_id"]').on('change', function(){
            var subcategory_id = $(this).val();
            if(subcategory_id){
                $.ajax({
                    url: "{{ url('/category/subsubcategory/ajax') }}/"+subcategory_id,
                    type: "GET",
                    dataType: "json",
                    success: function(data){
                        var d = $('select[name="subsubcategory_id"]').empty();
                        $.each(data, function(key, value){
                            $('select[name="subsubcategory_id"]').append('<option value="'+value.id+'">'+value.subsubcategory_name_en+'</option>');
                        });
                    }
                });
            }else{
                alert('danger');
            }
        });
    });
</script>


{{-- sripts to preview selected thumnail image --}}
<script type="text/javascript">
    function mainThumbUrl(input){
        if(input.files && input.files[0]){
            var reader =  new FileReader();
            reader.onload = function(e){
                $('#mainThumb').attr('src',e.target.result).width(80).height(80);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

{{-- scripts to preview selected multi image --}}
<script>
 
    $(document).ready(function(){
     $('#multi_img').on('change', function(){ //on file input change
        if (window.File && window.FileReader && window.FileList && window.Blob) //check File API supported browser
        {
            var data = $(this)[0].files; //this file data
             
            $.each(data, function(index, file){ //loop though each file
                if(/(\.|\/)(gif|jpe?g|png)$/i.test(file.type)){ //check supported file type
                    var fRead = new FileReader(); //new filereader
                    fRead.onload = (function(file){ //trigger function on successful read
                    return function(e) {
                        var img = $('<img/>').addClass('thumb').attr('src', e.target.result) .width(80)
                    .height(80); //create image element 
                        $('#preview_img').append(img); //append image to output element
                    };
                    })(file);
                    fRead.readAsDataURL(file); //URL representing the file's data.
                }
            });
             
        }else{
            alert("Your browser doesn't support File API!"); //if File API is absent
        }
     });
    });
     
</script>





@endsection