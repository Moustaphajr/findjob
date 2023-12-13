<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ListingController extends Controller
{
    public function index()
    {



        return view('listings.index', [
            "heading" => "Latest Listings",
            "listings" => Listing::latest()->filter(request(['tag', 'search']))->paginate(6)
        ]);
    }

    public function show(Listing $listing)
    {
        return view('listings.show', [
            "listing" => $listing
        ]);
    }


    public function  create()
    {
        return view('listings.create');
    }

    public function store(Request $request)

    {


        $formField = $request->validate([
            'title' => 'required',
            'company' => ['required', Rule::unique('listings', 'company')],
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required',
            "logo" => 'mimes:png,jpg,jpeg|max:5048'
        ]);


        $formField['user_id'] = auth()->id();

        if ($request->hasFile('logo')) {
            $formField['logo'] = $request->file('logo')->store('logos', 'public');
        }

        Listing::create($formField);

        return  redirect('/')->with('success', 'Listing created successfully');
    }


    public function edit(Listing $listing)
    {
        if ($listing->user_id !== auth()->id()) {
            abort(403, 'Unauthorized Action');
        }
        return view('listings.edit', [
            'listing' => $listing
        ]);
    }

    public function update(Request $request, Listing $listing)
    {
        $formField = $request->validate([
            'title' => 'required',
            'company' => 'required',
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required',
            "logo" => 'mimes:png,jpg,jpeg|max:5048'
        ]);

        if ($request->hasFile('logo')) {
            $formField['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $listing->update($formField);
        return redirect()->back()->with('success', 'Listing updated successfully');
    }


    public function destroy(Listing $listing)
    {
        if ($listing->user_id !== auth()->id()) {
            abort(403, 'Unauthorized Action');
        }
        $listing->delete();
        return redirect('/')->with('success', 'Listing deleted successfully');
    }

    public function Manage()
    {

        return view('listings.manage', [
            'listings' => auth()->user()->listings
        ]);
    }
}
