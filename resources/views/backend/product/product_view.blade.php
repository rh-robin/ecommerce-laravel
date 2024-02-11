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
                        <li class="breadcrumb-item" aria-current="page">Product</li>
                        <li class="breadcrumb-item active" aria-current="page">All Products</li>
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
                 <h3 class="box-title">Product List</h3>
               </div>
               <!-- /.box-header -->
               <div class="box-body">
                   <div class="table-responsive">
                     <table id="example1" class="table table-bordered table-striped">
                       <thead>
                           <tr>
                               <th style="padding: 5px">Image</th>
                               <th style="padding: 5px">Product Name English</th>
                               <th style="padding: 5px">Product Name Bangla</th>
                               <th style="padding: 5px">Quantity</th>
                               <th style="padding: 5px">Discount</th>
                               <th style="padding: 5px">Status</th>
                               <th style="padding: 5px">Action</th>
                           </tr>
                       </thead>
                       <tbody>
                        @forelse ($products as $product)
                        <tr>
                            <td style="padding: 5px"><img src="{{ asset($product->product_thumbnail) }}" style="width: 60px; height: 50px;"></td>
                            <td style="padding: 5px">{{ $product->product_name_en }}</td>
                            <td style="padding: 5px">{{ $product->product_name_bn }}</td>
                            <td style="padding: 5px">{{ $product->product_quantity }}</td>
                            <td style="padding: 5px">
                                @if($product->discount_price == NULL)
                                <span class="badge badge-pill badge-danger">No Discount</span>
                                @else
                                @php
                                $amount = $product->selling_price - $product->discount_price;
                                $discount = ($amount/$product->selling_price) * 100;
                                @endphp
                                <span class="badge badge-pill badge-danger">{{ round($discount)  }} %</span>
                   
                                @endif
                            </td>
                            <td style="padding: 5px">
                                @if($product->status == 1)
                                <span class="badge badge-pill badge-success"> Active </span>
                                @else
                                <span class="badge badge-pill badge-danger"> InActive </span>
                                @endif
                            </td>
                            <td style="padding: 5px" class="text-center">
                             <a href="{{ route('product.edit',$product->id) }}" class="btn btn-sm mx-1 btn-info" title="Edit Data"><i class="fa fa-pencil "></i></a>
                             <a href="{{ route('product.delete',$product->id) }}" id="delete" class="btn btn-sm mx-1 btn-danger" title="Delete Data"><i class="fa fa-trash "></i></a>
                             @if($product->status == 1)
                             <a href="{{ route('product.inactive',$product->id) }}" class="btn btn-sm mx-1 btn-danger" title="Inactive Now"><i class="fa fa-arrow-down"></i> </a>
                                @else
                             <a href="{{ route('product.active',$product->id) }}" class="btn btn-sm mx-1 btn-success" title="Active Now"><i class="fa fa-arrow-up"></i> </a>
                             @endif
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

                      
        </div> {{-- end col-12 --}}
    </div> {{-- end row --}}

</section>






@endsection