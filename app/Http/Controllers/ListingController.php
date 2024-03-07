<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ListingController extends Controller
{
    //show all listings
    public function index(){
     //dd(request('tag'));
    return view('listings.index',
    ['Listings' => Listing::latest()->filter(request(['tag','search']))->paginate(4)
]);
    }
    //show single listings
    public function show(Listing $listing){
        return view('listings.show',['listing'=>$listing]);

    }
    

    public function create(){
        return view('listings.create');
    }

    public function edit(Listing $listing){
     
        return view('listings.edit',['listing'=>$listing]);

    }

    public function store(Request $request){
        //dd($request->file('logo'));
        $formValues = $request->validate([
            'title'=> 'required',
            'company'=> ['required',Rule::unique('listings','company')],
            'location' => 'required',
            'website' => 'required',
            'email' => ['required','email'],
            'tags' =>'required',
            'description' => 'required'
           // 'user_id' => 'required'
        ]);

        if($request->hasFile('logo') ){
            $formValues['logo'] = $request->file('logo')->store('logos','public');
          //  dd($formValues);
        }

        $formValues['user_id'] = auth()->id();

        Listing::create($formValues);

        return redirect('/');
    }

    public function update(Request $request,Listing $listing){
        //dd($request->file('logo'));

        if($listing->user_id != auth()->id()){
            abort(403,'unauotherized action');
        }
        $formValues = $request->validate([
            'title'=> 'required',
            'company'=> 'required',
            'location' => 'required',
            'website' => 'required',
            'email' => ['required','email'],
            'tags' =>'required',
            'description' => 'required'
        ]);

        if($request->hasFile('logo') ){
            $formValues['logo'] = $request->file('logo')->store('logos','public');
          //  dd($formValues);
        }

        $listing->update($formValues);

        return redirect('/');
    }

    public function destroy(Listing $listing){
        if($listing->user_id != auth()->id()){
            abort(403,'unauotherized action');
        }
        $listing->delete();
        return redirect('/');
    }

    public function manage(){
        
        return view('listings.manage',['listings'=>auth()->user()->listings()->get()]);
    }

}
