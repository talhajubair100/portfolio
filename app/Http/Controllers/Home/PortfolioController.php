<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Portfolio;
use Illuminate\Support\Carbon;
use Image;

class PortfolioController extends Controller
{
    public function AllPortfolio()
    {
        $portfolio = Portfolio::latest()->get();
        return view('admin.portfolio.all_portfolio', compact('portfolio'));
    }

    public function AddPortfolio()
    {
        return view('admin.portfolio.add_portfolio');
    }

    public function StorePortfolio(Request $request){
        
        $request->validate(
            [
                'portfolio_name' =>'required',
                'portfolio_title' =>'nullable',
                'portfolio_description' => 'nullable',
                'portfolio_image' => 'nullable|mimes:jpg,png,gif',
            ],
            [
                'portfolio_name.required' => 'Please Input Portfolio Name', // Custom error message for validation
            ]
            
        );

        $image = $request->file('portfolio_image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();// generate id unique for image
        Image::make($image)->resize(1020, 519)->save('upload/potfolio/'.$name_gen);
        $save_url = 'upload/potfolio/'.$name_gen;

        Portfolio::insert([
            'portfolio_name' => $request->portfolio_name,
            'portfolio_title' => $request->portfolio_title,
            'portfolio_description' => $request->portfolio_description,
            'portfolio_image' => $save_url,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Portfoli Successfully Added with image',
            'alert-type' => 'success'
        );
    
        return redirect()->route('all.portfolio')->with($notification);

          
    }

    public function EditPortfolio($id){
        $portfolio = Portfolio::findOrFail($id);

        return view('admin.portfolio.edit_portfolio', compact('portfolio'));
    }

    public function UpdatePortfolio(Request $request){

        $portfolio_id = $request->id;
        if ($request->file('portfolio_image')){
            $image = $request->file('portfolio_image');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();// generate id unique for image
            Image::make($image)->resize(1020, 519)->save('upload/potfolio/'.$name_gen);
            $save_url = 'upload/potfolio/'.$name_gen;

            Portfolio::findOrFail($portfolio_id)->update([
                'portfolio_name' => $request->portfolio_name,
                'portfolio_title' => $request->portfolio_title,
                'portfolio_description' => $request->portfolio_description,
                'portfolio_image' => $save_url,
            ]);

            $notification = array(
                'message' => 'Portfolio Successfully Updated with image',
                'alert-type' => 'success'
            );
        
            return redirect()->route('all.portfolio')->with($notification);
        }
        else{
            Portfolio::findOrFail($portfolio_id)->update([
                'portfolio_name' => $request->portfolio_name,
                'portfolio_title' => $request->portfolio_title,
                'portfolio_description' => $request->portfolio_description,
                
            ]);

            $notification = array(
                'message' => 'Portfolio Successfully Updated',
                'alert-type' => 'success'
            );
        
            return redirect()->route('all.portfolio')->with($notification);
        }
    }

    public function DeletePortfolio($id){
        $portfolio = Portfolio::findOrFail($id);
        $img = $portfolio->portfolio_image;
        unlink($img); // delete image from folder

        Portfolio::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Portfolio Deleted Successfully',
            'alert-type' => 'success'
        );
    
        return redirect()->route('all.portfolio')->with($notification);
    }
}
