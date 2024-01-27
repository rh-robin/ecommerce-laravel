<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubCategory;
use App\Models\Category;

class SubCategoryController extends Controller
{
    public function view(){
        $categories = Category::orderBy('category_name_en','ASC')->get();
        //dd($categories);
        $subcategories = SubCategory::all();
        return view("backend.category.subcategory_view", compact("subcategories","categories"));
    }

    /* store category */
    public function store(Request $request){
        $request->validate([
            'subcategory_name_en' => 'required',
            'subcategory_name_bn' => 'required',
            'category_id' => 'required',
        ],[
            'subcategory_name_en.required' => 'Sub Category name in English is required',
            'subcategory_name_bn.required' => 'Sub Category name in Bangla is required',
            'category_id.required' => 'Please select a category',
        ]);
        $subcategory = new SubCategory;
        $subcategory->subcategory_name_en = $request->subcategory_name_en;
        $subcategory->subcategory_name_bn = $request->subcategory_name_bn;
        $subcategory->subcategory_slug_en = strtolower(str_replace(' ', '-', $request->subcategory_name_en));
        $subcategory->subcategory_slug_bn = strtolower(str_replace(' ', '-', $request->subcategory_name_bn));
        $subcategory->category_id = $request->category_id;
        $subcategory->save();
        $notification = array(
            'message' => 'Sub Category inserted Successfully',
            'alert-type'=> 'success'
        );
        return redirect()->back()->with($notification);
    } // end store


    // edit sub category
    public function edit($id){
        $categories = Category::orderBy('category_name_en','ASC')->get();
        $subcategory = SubCategory::findOrFail($id);
        return view('backend.category.subcategory_edit', compact('subcategory','categories'));
    } //end edit

    /* update subcategory */
    public function update(Request $request){
        $id = $request->id;
        $request->validate([
            'subcategory_name_en' => 'required',
            'subcategory_name_bn' => 'required',
            'category_id' => 'required',
        ],[
            'subcategory_name_en.required' => 'Sub Category name in English is required',
            'subcategory_name_bn.required' => 'Sub Category name in Bangla is required',
            'category_id.required' => 'Please select a category',
        ]);
        $subcategory = SubCategory::findOrFail($id);
        $subcategory->subcategory_name_en = $request->subcategory_name_en;
        $subcategory->subcategory_name_bn = $request->subcategory_name_bn;
        $subcategory->subcategory_slug_en = strtolower(str_replace(' ', '-', $request->subcategory_name_en));
        $subcategory->subcategory_slug_bn = strtolower(str_replace(' ', '-', $request->subcategory_name_bn));
        $subcategory->category_id = $request->category_id;
        $subcategory->save();
        $notification = array(
            'message' => 'Sub Category Updated Successfully',
            'alert-type'=> 'success'
        );
        return redirect()->back()->with($notification);
    } // end update


    // delete subcategory
    public function delete($id){
        SubCategory::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Sub Category Deleted Successfully',
            'alert-type'=> 'success'
        );
        return redirect()->back()->with($notification);
    }

}
