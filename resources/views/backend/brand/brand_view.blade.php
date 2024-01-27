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
                        <li class="breadcrumb-item active" aria-current="page">All Brands</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="row">
        <div class="col-8">

            <div class="box">
               <div class="box-header with-border">
                 <h3 class="box-title">Brand List</h3>
               </div>
               <!-- /.box-header -->
               <div class="box-body">
                   <div class="table-responsive">
                     <table id="example1" class="table table-bordered table-striped">
                       <thead>
                           <tr>
                               <th width="25%" style="padding: 5px">Brand Name English</th>
                               <th width="25%" style="padding: 5px">Brand Name Bangla</th>
                               <th width="25%" style="padding: 5px">Brand Image</th>
                               <th width="25%" style="padding: 5px">Action</th>
                           </tr>
                       </thead>
                       <tbody>
                        @forelse ($brands as $brand)
                        <tr>
                            <td width="25%" style="padding: 5px">{{ $brand->brand_name_en }}</td>
                            <td width="25%" style="padding: 5px">{{ $brand->brand_name_bn }}</td>
                            <td width="25%" style="padding: 5px"><img src="{{ asset($brand->brand_image) }}" alt=""></td>
                            <td width="25%" style="padding: 5px" class="text-center">
                             <a href="{{ route('brand.edit',$brand->id) }}" class="btn btn-sm mx-1 btn-info" title="Edit Data"><i class="fa fa-pencil "></i></a>
                             <a href="{{ route('brand.delete',$brand->id) }}" id="delete" class="btn btn-sm mx-1 btn-danger" title="Delete Data"><i class="fa fa-trash "></i></a>
                            </td>
                        </tr>
                        @empty
                        @endforelse

                       </tbody>
                     </table>
                   </div>
               </div>
               <!-- /.box-body -->
             </div>
             <!-- /.box -->

                      
        </div> {{-- end col-8 --}}
        <div class="col-4">

            <div class="box">
               <div class="box-header with-border">
                 <h3 class="box-title">Add Brand</h3>
               </div>
               <!-- /.box-header -->
               <div class="box-body">
                   <form method="POST" action="{{ route('brand.store') }}" enctype="multipart/form-data">
                    @csrf
                        <div class="form-group">
                            <h5>Brand Name English <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <input type="text" name="brand_name_en" value="{{ old('brand_name_en') }}" class="form-control"> <div class="help-block"></div></div>
                            @error('brand_name_en')
                            <div class="form-control-feedback"><small class="text-danger">{{ $message }}</small></div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <h5>Brand Name Bangla <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <input type="text" name="brand_name_bn" value="{{ old('brand_name_bn') }}" class="form-control"> <div class="help-block"></div></div>
                            @error('brand_name_bn')
                            <div class="form-control-feedback"><small class="text-danger">{{ $message }}</small></div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <h5>Brand Image <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <input type="file" name="brand_image" class="form-control"> <div class="help-block"></div></div>
                            @error('brand_image')
                            <div class="form-control-feedback"><small class="text-danger">{{ $message }}</small></div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Add New">
                        </div>
                   </form>
               </div>
               <!-- /.box-body -->
             </div>
             <!-- /.box -->

                      
        </div> {{-- end col-4 --}}
    </div> {{-- end row --}}

</section>






@endsection