<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\SubSubCategory;
use App\Models\Brand;

use App\Models\MultiImg;
use Carbon\Carbon;

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\File;


class ProductController extends Controller
{
    public function add(){
		$categories = Category::latest()->get();
		$brands = Brand::latest()->get();
		return view('backend.product.product_add',compact('categories','brands'));

	}


	public function store(Request $request){
		// Validate the request
		$validatedData = $request->validate([
			'product_thumbnail' => 'image|mimes:jpeg,png,jpg,gif',
			'multi_img.*' => 'image|mimes:jpeg,png,jpg,gif',
		]);

		// Initialize variables
		$save_url = "";
		$save_url_multi = "";

		// Create a new product instance
		$product = new Product();

		// Process the product thumbnail
		if ($request->hasFile('product_thumbnail')) {
			$manager = new ImageManager(new Driver());
			$fileName = hexdec(uniqid()) . '.' . $request->file('product_thumbnail')->getClientOriginalExtension();

			$image = $manager->read($request->file('product_thumbnail'));
			$image = $image->resize(917, 1000);

			$thumbnailDirectory = public_path('upload/products/thumbnail');
			File::makeDirectory($thumbnailDirectory, $mode = 0777, true, true);
			$image->toJpeg(80)->save($thumbnailDirectory . '/' . $fileName);

			$save_url = 'upload/products/thumbnail/' . $fileName;
		}

		$product->brand_id = $request->brand_id;
		$product->category_id = $request->category_id;
		$product->subcategory_id = $request->subcategory_id;
		$product->subsubcategory_id = $request->subsubcategory_id;
		$product->product_name_en = $request->product_name_en;
		$product->product_name_bn = $request->product_name_bn;
		$product->product_slug_en = strtolower(str_replace(' ', '-', $request->product_name_en));
		$product->product_slug_bn = str_replace(' ', '-', $request->product_name_bn);
		$product->product_code = $request->product_code;
		
		$product->product_quantity = $request->product_quantity;
		$product->product_tags_en = $request->product_tags_en;
		$product->product_tags_bn = $request->product_tags_bn;
		$product->product_size_en = $request->product_size_en;
		$product->product_size_bn = $request->product_size_bn;
		$product->product_color_en = $request->product_color_en;
		$product->product_color_bn = $request->product_color_bn;
		
		$product->selling_price = $request->selling_price;
		$product->discount_price = $request->discount_price;
		$product->short_desc_en = $request->short_desc_en;
		$product->short_desc_bn = $request->short_desc_bn;
		$product->long_desc_en = $request->long_desc_en;
		$product->long_desc_bn = $request->long_desc_bn;
		
		$product->hot_deals = $request->hot_deals;
		$product->featured = $request->featured;
		$product->special_offer = $request->special_offer;
		$product->special_deals = $request->special_deals;
		$product->product_thumbnail = $save_url;
		$product->status = 1;

		$product->save();

		$product_id = $product->id;

		// Process multiple images
		if ($request->hasFile('multi_img')) {
			$images = $request->file('multi_img');
			foreach ($images as $img) {
				$manager = new ImageManager(new Driver());
				$fileName = hexdec(uniqid()) . '.' . $img->getClientOriginalExtension();

				$image = $manager->read($img);
				$image = $image->resize(917, 1000);

				$multiImgDirectory = public_path('upload/products/multi-img');
				File::makeDirectory($multiImgDirectory, $mode = 0777, true, true);
				$image->toJpeg(80)->save($multiImgDirectory . '/' . $fileName);

				$save_url_multi = 'upload/products/multi-img/' . $fileName;

				$multiImg = new MultiImg();
				$multiImg->product_id = $product_id;
				$multiImg->image_name = $save_url_multi;
				$multiImg->save();
			}
		}

		// Redirect back with a success message
		$notification = array(
			'message' => 'Product Inserted Successfully',
			'alert-type' => 'success'
		);

		return redirect()->back()->with($notification);
	}

	public function view(){

		$products = Product::latest()->get();
		return view('backend.product.product_view',compact('products'));
	}

	
	public function edit($id){

		$multiImgs = MultiImg::where('product_id',$id)->get();

		$categories = Category::latest()->get();
		$brands = Brand::latest()->get();
		$subcategories = SubCategory::latest()->get();
		$subsubcategories = SubSubCategory::latest()->get();
		$product = Product::findOrFail($id);
		return view('backend.product.product_edit',compact('categories','brands','subcategories','subsubcategories','product','multiImgs'));

	}

	public function dataUpdate(Request $request){
		$id = $request->id;

		$product = Product::findOrFail($id);
		$product->brand_id = $request->brand_id;
		$product->category_id = $request->category_id;
		$product->subcategory_id = $request->subcategory_id;
		$product->subsubcategory_id = $request->subsubcategory_id;
		$product->product_name_en = $request->product_name_en;
		$product->product_name_bn = $request->product_name_bn;
		$product->product_slug_en = strtolower(str_replace(' ', '-', $request->product_name_en));
		$product->product_slug_bn = str_replace(' ', '-', $request->product_name_bn);
		$product->product_code = $request->product_code;
		
		$product->product_quantity = $request->product_quantity;
		$product->product_tags_en = $request->product_tags_en;
		$product->product_tags_bn = $request->product_tags_bn;
		$product->product_size_en = $request->product_size_en;
		$product->product_size_bn = $request->product_size_bn;
		$product->product_color_en = $request->product_color_en;
		$product->product_color_bn = $request->product_color_bn;
		
		$product->selling_price = $request->selling_price;
		$product->discount_price = $request->discount_price;
		$product->short_desc_en = $request->short_desc_en;
		$product->short_desc_bn = $request->short_desc_bn;
		$product->long_desc_en = $request->long_desc_en;
		$product->long_desc_bn = $request->long_desc_bn;
		
		$product->hot_deals = $request->hot_deals;
		$product->featured = $request->featured;
		$product->special_offer = $request->special_offer;
		$product->special_deals = $request->special_deals;
		$product->status = 1;

		$product->save();

		// Redirect back with a success message
		$notification = array(
			'message' => 'Product Updated Without Image Successfully',
			'alert-type' => 'success'
		);

		return redirect()->back()->with($notification);
	}


	/// Multiple Image Update
	public function multiImgUpdate(Request $request){
		if ($request->hasFile('multi_img')) {
			$imgs = $request->multi_img;

			foreach ($imgs as $id => $img) {
				$imgDel = MultiImg::findOrFail($id);
				unlink($imgDel->image_name);
				$manager = new ImageManager(new Driver());
				$fileName = hexdec(uniqid()) . '.' . $img->getClientOriginalExtension();

				$image = $manager->read($img);
				$image = $image->resize(917, 1000);

				$multiImgDirectory = public_path('upload/products/multi-img');
				File::makeDirectory($multiImgDirectory, $mode = 0777, true, true);
				$image->toJpeg(80)->save($multiImgDirectory . '/' . $fileName);

				$save_url_multi = 'upload/products/multi-img/' . $fileName;

				$multiImg = MultiImg::findOrFail($id);
				$multiImg->image_name = $save_url_multi;
				$multiImg->save();

			} // end foreach

			$notification = array(
					'message' => 'Product Multi Image Updated Successfully',
					'alert-type' => 'info'
			);
		} else{
			$notification = array(
				'message' => 'Please Select New Image To Update',
				'alert-type' => 'warning'
			);
		}/* end if */

		
		return redirect()->back()->with($notification);

	} // end mehtod 


	/// Product Main Thambnail Update /// 
	public function thumbnailUpdate(Request $request){
		$pro_id = $request->id;
		$oldImage = $request->old_img;
		
		if ($request->hasFile('product_thumbnail')) {
			$manager = new ImageManager(new Driver());
			$fileName = hexdec(uniqid()) . '.' . $request->file('product_thumbnail')->getClientOriginalExtension();

			$image = $manager->read($request->file('product_thumbnail'));
			$image = $image->resize(917, 1000);

			$thumbnailDirectory = public_path('upload/products/thumbnail');
			File::makeDirectory($thumbnailDirectory, $mode = 0777, true, true);
			$image->toJpeg(80)->save($thumbnailDirectory . '/' . $fileName);

			$save_url = 'upload/products/thumbnail/' . $fileName;
			$product = Product::findOrFail($pro_id);
			$product->product_thumbnail = $save_url;
			$product->save();
			unlink($oldImage);

			$notification = array(
				'message' => 'Product Thumbnail Image Updated Successfully',
				'alert-type' => 'info'
			);
		}else{
			$notification = array(
				'message' => 'Please Select New Image To Update',
				'alert-type' => 'warning'
			);
		} /* end if */
		return redirect()->back()->with($notification);
   
	} // end method


	//// Multi Image Delete ////
	public function multiImgDelete($id){
		$oldimg = MultiImg::findOrFail($id);
		unlink($oldimg->image_name);
		MultiImg::findOrFail($id)->delete();

		$notification = array(
		   'message' => 'Product Image Deleted Successfully',
		   'alert-type' => 'success'
	   );

	   return redirect()->back()->with($notification);

	} // end method 


	public function inactive($id){
		Product::findOrFail($id)->update(['status' => 0]);
		$notification = array(
		   'message' => 'Product Inactive',
		   'alert-type' => 'success'
	   );

	   return redirect()->back()->with($notification);
	}


 	public function active($id){
	 	Product::findOrFail($id)->update(['status' => 1]);
		$notification = array(
		   'message' => 'Product Active',
		   'alert-type' => 'success'
	    );

	   return redirect()->back()->with($notification);
		
	}


	public function delete($id){
		$product = Product::findOrFail($id);
		unlink($product->product_thumbnail);
		Product::findOrFail($id)->delete();

		$images = MultiImg::where('product_id',$id)->get();
		foreach ($images as $img) {
			unlink($img->image_name);
		}
		MultiImg::where('product_id',$id)->delete();

		$notification = array(
		   'message' => 'Product Deleted Successfully',
		   'alert-type' => 'success'
	   );

	   return redirect()->back()->with($notification);

	}// end method 

}
