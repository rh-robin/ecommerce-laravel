<?php

namespace App\Http\Controllers\Backend;

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Imagick\Driver;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Brand;

class BrandController extends Controller
{
    public function view(){
        $brands = Brand::all();
        return view("backend.brand.brand_view", compact("brands"));
    }

    public function store(Request $request){
        
        $request->validate([
            'brand_name_en' => 'required',
            'brand_name_bn' => 'required',
            'brand_image' => 'required|mimes:jpg,jpeg,png',
        ],[
            'brand_name_en.required' => 'Brand name in English is required',
            'brand_name_bn.required' => 'Brand name in Bangla is required',
            'brand_image.required' => 'Brand image is required(jpg, jpeg, png)',
            'brand_image.mimes' => 'Brand image type must be jpg, jpeg or png',
        ]);
        if($request->file('brand_image')){
            //$manager = new ImageManager(new Driver());
            //$img = $manager->read($request->file('brand_image'));
            //$img = $img->resize(166,110);
            //$img->toJpeg(80)->save(base_path('public/upload/brand_images/'. $img_name));


            $img = $request->file('brand_image');
            $img_name = hexdec(uniqid()) .'.'. $request->file('brand_image')->getClientOriginalExtension();
            $img_url = 'upload/brand_images/'.$img_name;
            $img->move(public_path('upload/brand_images'), $img_name);
            Brand::insert([
                'brand_name_en' => $request->brand_name_en,
                'brand_name_bn' => $request->brand_name_bn,
                'brand_slug_en' => strtolower(str_replace(' ','-', $request->brand_name_en)),
                'brand_slug_bn' => strtolower(str_replace(' ','-', $request->brand_name_bn)),
                'brand_image' => $img_url,
            ]);
            $notification = array(
                'message' => 'Brand inserted Successfully',
                'alert-type'=> 'success'
            );
            return redirect()->back()->with($notification);
        }
    } // end store

    public function edit($id){
        $brand = Brand::findOrFail($id);
        return view('backend.brand.brand_edit', compact('brand'));
    }

    /* Update Brand */
    public function update(Request $request){
        $id = $request->id;
        $old_image = $request->old_image;
        $request->validate([
            'brand_name_en' => 'required',
            'brand_name_bn' => 'required',
            'brand_image' => 'mimes:jpg,jpeg,png'
        ],[
            'brand_name_en.required' => 'Brand name in English is required',
            'brand_name_bn.required' => 'Brand name in Bangla is required',
            'brand_image.mimes' => 'Brand image type must be jpg, jpeg, png'
        ]);

        $brand = Brand::findOrFail($id);
        $brand->brand_name_en = $request->brand_name_en;
        $brand->brand_name_bn = $request->brand_name_bn;
        $brand->brand_slug_en = strtolower(str_replace(' ', '-', $request->brand_name_en));
        $brand->brand_slug_bn = strtolower(str_replace(' ', '-', $request->brand_name_bn));

        if ($request->file('brand_image')) {
            // Delete the old image
            if ($old_image && file_exists(public_path($old_image))) {
                unlink(public_path($old_image));
            }

            // Upload and save the new image
            $img = $request->file('brand_image');
            $img_name = hexdec(uniqid()) .'.'. $request->file('brand_image')->getClientOriginalExtension();
            $img_url = 'upload/brand_images/'.$img_name;
            $img->move(public_path('upload/brand_images'), $img_name);

            $brand->brand_image = $img_url;
        }

        // Save the changes
        $brand->save();

        $notification = [
            'message' => 'Brand Updated Successfully',
            'alert-type'=> 'success'
        ];

        return redirect()->back()->with($notification);
    } // end update


    public function delete($id){
        $brand = Brand::findOrFail($id);
        $img = $brand->brand_image;
        unlink($img);
        Brand::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Brand Deleted Successfully',
            'alert-type'=> 'success'
        );
        return redirect()->back()->with($notification);
    }
}
