<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Slider;


use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\File;

class SliderController extends Controller
{
    public function view(){
		$sliders = Slider::latest()->get();
		return view('backend.slider.slider_view',compact('sliders'));
	}


    public function store(Request $request){
        // Validate the request
		$validatedData = $request->validate([
			'slider_image' => 'required|mimes:jpeg,png,jpg'
		]);

        $slider = new Slider();
        if ($request->hasFile('slider_image')) {
			$manager = new ImageManager(new Driver());
			$fileName = hexdec(uniqid()) . '.' . $request->file('slider_image')->getClientOriginalExtension();

			$image = $manager->read($request->file('slider_image'));
			$image = $image->resize(870, 370);

			$thumbnailDirectory = public_path('upload/sliders');
			File::makeDirectory($thumbnailDirectory, $mode = 0777, true, true);
			$image->toJpeg(80)->save($thumbnailDirectory . '/' . $fileName);

			$save_url = 'upload/sliders/' . $fileName;
            $slider->slider_image = $save_url;
		}
        $slider->title_en = $request->title_en;
        $slider->title_bn = $request->title_bn;
        $slider->description_en = $request->description_en;
        $slider->description_bn = $request->description_bn;
        $slider->save();

        // Redirect back with a success message
		$notification = array(
			'message' => 'Slider Inserted Successfully',
			'alert-type' => 'success'
		);

		return redirect()->back()->with($notification);
    }


    public function edit($id){
        $slider = Slider::findOrFail($id);
        return view('backend.slider.slider_edit',compact('slider'));
    }

    public function update(Request $request){
        // Validate the request
		$validatedData = $request->validate([
			'slider_image' => 'mimes:jpeg,png,jpg'
		]);
        $old_image = $request->old_image;
        $id = $request->id;

        $slider = Slider::findOrFail($id);
        if ($request->hasFile('slider_image')) {
            unlink($old_image);
			$manager = new ImageManager(new Driver());
			$fileName = hexdec(uniqid()) . '.' . $request->file('slider_image')->getClientOriginalExtension();

			$image = $manager->read($request->file('slider_image'));
			$image = $image->resize(870, 370);

			$thumbnailDirectory = public_path('upload/sliders');
			File::makeDirectory($thumbnailDirectory, $mode = 0777, true, true);
			$image->toJpeg(80)->save($thumbnailDirectory . '/' . $fileName);

			$save_url = 'upload/sliders/' . $fileName;
            $slider->slider_image = $save_url;
		}
        $slider->title_en = $request->title_en;
        $slider->title_bn = $request->title_bn;
        $slider->description_en = $request->description_en;
        $slider->description_bn = $request->description_bn;
        $slider->save();

        // Redirect back with a success message
		$notification = array(
			'message' => 'Slider Updated Successfully',
			'alert-type' => 'success'
		);

		return redirect()->back()->with($notification);
    }


    public function delete($id){
    	$slider = Slider::findOrFail($id);
    	$img = $slider->slider_image;
    	unlink($img);
    	Slider::findOrFail($id)->delete();

    	$notification = array(
			'message' => 'Slider Delectd Successfully',
			'alert-type' => 'info'
		);

		return redirect()->back()->with($notification);

    } // end method


    public function inactive($id){
    	Slider::findOrFail($id)->update(['status' => 0]);

    	$notification = array(
			'message' => 'Slider Inactive Successfully',
			'alert-type' => 'info'
		);

		return redirect()->back()->with($notification);

    } // end method 


    public function active($id){
    	Slider::findOrFail($id)->update(['status' => 1]);

    	$notification = array(
			'message' => 'Slider Active Successfully',
			'alert-type' => 'info'
		);

		return redirect()->back()->with($notification);

    } // end method 
}
