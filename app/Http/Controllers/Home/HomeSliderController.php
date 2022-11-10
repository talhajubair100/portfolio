<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HomeSlide;
use Image;

class HomeSliderController extends Controller
{
    public function HomeSlider(){

        $homeslide = HomeSlide::find(1);
        return view('admin.home.slider', compact('homeslide'));
    }

    public function UpdateSlider(Request $request){

        $slider_id = $request->id;
        if ($request->file('home_slide')){
            $image = $request->file('home_slide');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();// generate id unique for image
            Image::make($image)->resize(636, 852)->save('upload/home_slide/'.$name_gen);
            $save_url = 'upload/home_slide/'.$name_gen;

            HomeSlide::findOrFail($slider_id)->update([
                'title' => $request->title,
                'short_description' => $request->short_description,
                'video_url' => $request->video_url,
                'home_slide' => $save_url,
            ]);

            $notification = array(
                'message' => 'Home Slider Successfully Updated with image',
                'alert-type' => 'success'
            );
        
            return redirect()->back()->with($notification);
        }
        else{
            HomeSlide::findOrFail($slider_id)->update([
                'title' => $request->title,
                'short_description' => $request->short_description,
                'video_url' => $request->video_url,
            ]);

            $notification = array(
                'message' => 'Home Slider Successfully Updated',
                'alert-type' => 'success'
            );
        
            return redirect()->back()->with($notification);
        }
        
    }
}
