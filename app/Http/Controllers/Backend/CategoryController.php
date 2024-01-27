<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function view(){
        $categories = Category::all();
        return view("backend.category.category_view", compact("categories"));
    }


    /* store category */
    public function store(Request $request){
        
        $request->validate([
            'category_name_en' => 'required',
            'category_name_bn' => 'required',
            'category_image' => 'required|mimes:jpg,jpeg,png',
        ],[
            'category_name_en.required' => 'Category name in English is required',
            'category_name_bn.required' => 'Category name in Bangla is required',
            'category_image.required' => 'Category image is required(jpg, jpeg, png)',
            'category_image.mimes' => 'Category image type must be jpg, jpeg or png',
        ]);

        if($request->file('category_image')){
            $img = $request->file('category_image');
            $img_name = hexdec(uniqid()) .'.'. $request->file('category_image')->getClientOriginalExtension();
            $img_url = 'upload/category_images/'.$img_name;
            $img->move(public_path('upload/category_images'), $img_name);
            Category::insert([
                'category_name_en' => $request->category_name_en,
                'category_name_bn' => $request->category_name_bn,
                'category_slug_en' => strtolower(str_replace(' ','-', $request->category_name_en)),
                'category_slug_bn' => strtolower(str_replace(' ','-', $request->category_name_bn)),
                'category_image' => $img_url,
            ]);
            $notification = array(
                'message' => 'Category inserted Successfully',
                'alert-type'=> 'success'
            );
            return redirect()->back()->with($notification);
        }
    } // end store

    public function edit($id){
        $category = Category::findOrFail($id);
        return view('backend.category.category_edit', compact('category'));
    }


    /* update category */
    public function update(Request $request){
        $id = $request->id;
        $old_image = $request->old_image;
        $request->validate([
            'category_name_en' => 'required',
            'category_name_bn' => 'required',
            'category_image' => 'mimes:jpg,jpeg,png',
        ],[
            'category_name_en.required' => 'Category name in English is required',
            'category_name_bn.required' => 'Category name in Bangla is required',
            'category_image.mimes' => 'Category image type must be jpg, jpeg or png',
        ]);
        $category = Category::findOrFail($id);
        $category->category_name_en = $request->category_name_en;
        $category->category_name_bn = $request->category_name_bn;
        $category->category_slug_en = strtolower(str_replace(' ', '-', $request->category_name_en));
        $category->category_slug_bn = strtolower(str_replace(' ', '-', $request->category_name_bn));

        if ($request->file('category_image')) {
            // Delete the old image
            if ($old_image && file_exists(public_path($old_image))) {
                unlink(public_path($old_image));
            }

            // Upload and save the new image
            $img = $request->file('category_image');
            $img_name = hexdec(uniqid()) .'.'. $img->getClientOriginalExtension();
            $img_url = 'upload/category_images/'.$img_name;
            $img->move(public_path('upload/category_images'), $img_name);

            $category->category_image = $img_url;
        }

        // Save the changes
        $category->save();

        $notification = [
            'message' => 'Category Updated Successfully',
            'alert-type'=> 'success'
        ];

        return redirect()->back()->with($notification);
    } // end update


    public function delete($id){
        $category = Category::findOrFail($id);
        $img = $category->category_image;
        unlink($img);
        Category::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Category Deleted Successfully',
            'alert-type'=> 'success'
        );
        return redirect()->back()->with($notification);
    }


    

}



