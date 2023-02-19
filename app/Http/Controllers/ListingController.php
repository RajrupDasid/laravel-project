<?php

namespace App\Http\Controllers;
use App\Models\Listing;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ListingController extends Controller
{
    //Show all lisitngs
    public function index(){
        //dd(request('tag'));
        return view('listings.index',[
            'listings' => Listing::latest()->filter(request(['tag','search']))->paginate(6) //we can also put simplePaginate for a simple pagination
        ]);
    

    }
    //show single listings
    public function show(Listing $listing){
        return view('listings.show',[
            'listing' => $listing
        ]);
    }
    //Show create form
    public function create(){
        return view('listings.create');
    }

    //Show create data
    public function store(Request $request){
        $formFields = $request->validate([
            'title'=> 'required',
            'company'=>['required', Rule::unique('listings','company')],
            'location'=>'required',
            'website'=>'required',
            'email'=>['required','email'],
            'tags'=>'required',
            'description'=>'required',
        ]);
        Listing::create($formFields);
        //Session::flash('message',);

        return redirect('/')->with('message','Listing created successfully');
    }
}
