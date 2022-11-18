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
}
