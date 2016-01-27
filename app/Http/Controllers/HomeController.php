<?php

namespace App\Http\Controllers;

use Auth;
use App\Location;
use App\Source;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use VLG\GSSAuth\Hello;

class HomeController extends Controller
{

	public function dashboard(Request $request)
	{
		return view('dashboard');
	}

	public function projectNew(Request $request)
	{
		return view('project_new');
	}

    public function SourceNew(Request $request)
    {
        return view('source_new');
    }

	public function doProjectNew(Request $request)
	{
        $this->validate($request, [
            'number' => 'required|unique:locations',
            'name' => 'required',
            'placed' => 'required',
            'removed' => 'required',
            'address' => 'required',
            'address_number' => 'required',
            'postal' => 'required',
            'city' => 'required',
            'contact' => 'required',
            'email' => 'required|email',
            'source' => 'required|numeric',
        ]);

        $location = new Location;
        $location->number = $request->input('number');
        $location->name = $request->input('name');
        $location->placed_at = $request->input('placed');
        $location->removed_at = $request->input('removed');
        $location->address = $request->input('address');
        $location->address_number = $request->input('address_number');
        $location->postal = $request->input('postal');
        $location->city = $request->input('city');
        $location->contact_name = $request->input('contact');
        $location->email = $request->input('email');
        
        if ($request->input('phone'))
            $location->phone = $request->input('phone');

        if ($request->input('note'))
            $location->note = $request->input('note');

		if (!Source::find($request->input('source'))->isAvailable()) {
			return back();
		}
        $location->source_id = $request->input('source');

        if ($request->input('data_requested'))
            $location->data_requested = true;
        else
        	$location->data_requested = false;

        $location->save();

        return back()->with('success', 'Project toegevoegd');
	}

    public function doSourceNew(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        $source = new Source;
        $source->name = $request->input('name');

        $source->save();

        return back()->with('success', 'Opnemer toegevoegd');
    }

}
