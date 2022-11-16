<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\About;
use Image;
use Illuminate\Http\Request;
use App\Models\MultiImage;

use Illuminate\Support\Carbon;

class AboutController extends Controller
{
    public function AboutPage()
    {
        $aboutpage = About::find(1);
        return view('admin.about.about_page', compact('aboutpage'));
    }

    public function HomeAbout(){
        $about = About::find(1);
        return view('frontend.about_page', compact('about'));
    }

    public function AboutMultiImage(){

        return view('admin.about.multi_image');
    }

    public function StoreMultiImage(Request $request){

        $image = $request->file('multi_image');
        foreach($image as $multi_img){
            $name_gen = hexdec(uniqid()).'.'.$multi_img->getClientOriginalExtension();
            Image::make($multi_img)->resize(220, 220)->save('upload/multi_image/'.$name_gen);
            $save_url = 'upload/multi_image/'.$name_gen;
            
            MultiImage::insert([
                'multi_images' => $save_url,
                'created_at' => Carbon::now()
            ]);
        } // end foreach
            $notification = array(
                'message' => 'Multi image uploaded successfully',
                'alert-type' => 'success'
            );

        return Redirect()->route('all.multi.image')->with($notification);
        
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


    public function AllMultiImage(){

        $allMultiImage = MultiImage::all();

        return view('admin.about.all_multi_image', compact('allMultiImage'));

    }

    public function EditMultiImage($id){

        $editMultiImage = MultiImage::findOrFail($id);

        return view('admin.about.edit_multi_image', compact('editMultiImage'));
    }

    public function UpdateMultiImage(Request $request){

        $multi_image_id = $request->id;
        if ($request->file('multi_image')){
            $image = $request->file('multi_image');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();// generate id unique for image
            Image::make($image)->resize(220, 220)->save('upload/multi_image/'.$name_gen);
            $save_url = 'upload/multi_image/'.$name_gen;

            MultiImage::findOrFail($multi_image_id)->update([
                
                'multi_images' => $save_url,
            ]);

            $notification = array(
                'message' => 'Image Updated Successfully',
                'alert-type' => 'success'
            );
        
            return redirect()->route('all.multi.image')->with($notification);
        }
        
    }

    public function DeleteMultiImage($id){
            
            $multi = MultiImage::findOrFail($id);
            $img = $multi->multi_images;
            unlink($img); // delete image from folder

            MultiImage::findOrFail($id)->delete();
    
            $notification = array(
                'message' => 'Image Deleted Successfully',
                'alert-type' => 'success'
            );
        
            return redirect()->route('all.multi.image')->with($notification);
    }

}
