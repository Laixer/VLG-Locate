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

    /**
     * Instantiate a new UserController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth.edit', ['except' => [
            'dashboard',
            'sources',
        ]]);
    }

	public function dashboard(Request $request)
	{
		return view('dashboard');
	}

	public function projectNew(Request $request)
	{
		return view('project_new');
	}

    public function projectEdit(Request $request)
    {
        $location = Location::find($request->get('id'));
        return view('project_edit', ['location' => $location]);
    }

    public function sourceNew(Request $request)
    {
        return view('source_new');
    }

    public function sources(Request $request)
    {
        return view('sources');
    }

    public function about(Request $request)
    {
        dd(Auth::user());
    }

    public function deleteUser(Request $request)
    {
        $user = User::find($request->input('id'));
        $user->delete();

        $audit = new Audit;
        $audit->payload = 'Gebruiker "' . $user->name . '" verwijderd';
        $audit->user_id = Auth::id();
        $audit->save();

        return redirect('/admin/users')->with('success', 'Gebruiker verwijderd');
    }

    public function sourceDelete(Request $request)
    {
        $source = Source::find($request->input('id'));
        if (!$source->isAvailable()) {
            return back();
        }

        $source->delete();

        return back()->with('success', 'Opnemer verwijderd');
    }

	public function doProjectNew(Request $request)
	{
        $this->validate($request, [
            'number' => 'required|unique:locations',
            'name' => 'required',
            'placed' => 'required',
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
        $location->address = $request->input('address');
        $location->address_number = $request->input('address_number');
        $location->postal = $request->input('postal');
        $location->city = $request->input('city');
        $location->contact_name = $request->input('contact');
        $location->email = $request->input('email');

        if ($request->input('removed'))
            $location->removed_at = $request->input('removed');

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

    public function doProjectUpdate(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|numeric',
            'number' => 'required',
            'name' => 'required',
            'placed' => 'required',
            'address' => 'required',
            'address_number' => 'required',
            'postal' => 'required',
            'city' => 'required',
            'contact' => 'required',
            'email' => 'required|email',
        ]);

        $location = Location::find($request->input('id'));
        $location->number = $request->input('number');
        $location->name = $request->input('name');
        $location->placed_at = $request->input('placed');
        $location->address = $request->input('address');
        $location->address_number = $request->input('address_number');
        $location->postal = $request->input('postal');
        $location->city = $request->input('city');
        $location->contact_name = $request->input('contact');
        $location->email = $request->input('email');

        if ($request->input('removed'))
            $location->removed_at = $request->input('removed');

        if ($request->input('phone'))
            $location->phone = $request->input('phone');

        if ($request->input('note'))
            $location->note = $request->input('note');

        if ($request->input('source') > 0) {
            if (!Source::find($request->input('source'))->isAvailable()) {
                return back();
            }
            $location->source_id = $request->input('source');
        }

        if ($request->input('data_requested'))
            $location->data_requested = true;
        else
            $location->data_requested = false;

        $location->save();

        return back()->with('success', 'Project opgeslagen');
    }

    public function projectDelete(Request $request)
    {
        Location::destroy($request->input('id'));

        return redirect('/')->with('success', 'Project verwijderd');
    }

    public function doSourceNew(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:sources',
        ]);

        $source = new Source;
        $source->name = $request->input('name');

        $source->save();

        return back()->with('success', 'Opnemer toegevoegd');
    }

}
