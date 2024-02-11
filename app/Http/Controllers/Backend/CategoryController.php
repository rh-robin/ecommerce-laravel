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
        ],[
            'category_name_en.required' => 'Category name in English is required',
            'category_name_bn.required' => 'Category name in Bangla is required',
        ]);

        
        Category::insert([
            'category_name_en' => $request->category_name_en,
            'category_name_bn' => $request->category_name_bn,
            'category_slug_en' => strtolower(str_replace(' ','-', $request->category_name_en)),
            'category_slug_bn' => strtolower(str_replace(' ','-', $request->category_name_bn)),
            'category_icon' => $request->category_icon,
        ]);
        $notification = array(
            'message' => 'Category inserted Successfully',
            'alert-type'=> 'success'
        );
        return redirect()->back()->with($notification);
    } // end store

    public function edit($id){
        $category = Category::findOrFail($id);
        return view('backend.category.category_edit', compact('category'));
    }


    /* update category */
    public function update(Request $request){
        $id = $request->id;
        $request->validate([
            'category_name_en' => 'required',
            'category_name_bn' => 'required',
        ],[
            'category_name_en.required' => 'Category name in English is required',
            'category_name_bn.required' => 'Category name in Bangla is required',
        ]);
        $category = Category::findOrFail($id);
        $category->category_name_en = $request->category_name_en;
        $category->category_name_bn = $request->category_name_bn;
        $category->category_slug_en = strtolower(str_replace(' ', '-', $request->category_name_en));
        $category->category_slug_bn = strtolower(str_replace(' ', '-', $request->category_name_bn));
        $category->category_icon = $request->category_icon;
        

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



