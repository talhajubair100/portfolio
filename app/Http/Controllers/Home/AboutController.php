<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\About;
use Image;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function AboutPage()
    {
        $aboutpage = About::find(1);
        return view('admin.about.about_page', compact('aboutpage'));
    }



    public function UpdateAbout(Request $request){

        $about_id = $request->id;
        if ($request->file('about_image')){
            $image = $request->file('about_image');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();// generate id unique for image
            Image::make($image)->resize(523, 605)->save('upload/about/'.$name_gen);
            $save_url = 'upload/about/'.$name_gen;

            About::findOrFail($about_id)->update([
                'title' => $request->title,
                'short_title' => $request->short_title,
                'short_description' => $request->short_description,
                'description' => $request->description,
                'about_image' => $save_url,
            ]);

            $notification = array(
                'message' => 'About Page Successfully Updated with image',
                'alert-type' => 'success'
            );
        
            return redirect()->back()->with($notification);
        }
        else{
            About::findOrFail($about_id)->update([
                'title' => $request->title,
                'short_title' => $request->short_title,
                'short_description' => $request->short_description,
                'description' => $request->description,
            ]);

            $notification = array(
                'message' => 'About Successfully Updated',
                'alert-type' => 'success'
            );
        
            return redirect()->back()->with($notification);
        }
        
    }


}
