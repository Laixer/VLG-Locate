<?php

namespace App\Http\Controllers;

use Auth;
use App\Location;
use App\Source;

use Ivory\GoogleMap\Map;
use Ivory\GoogleMap\Helper\MapHelper;
use Ivory\GoogleMap\Events\MouseEvent;
use Ivory\GoogleMap\Overlays\Marker;
use Ivory\GoogleMap\Overlays\InfoWindow;

use Ivory\HttpAdapter\Guzzle6HttpAdapter;
use Geocoder\Provider\GoogleMaps;

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

    public function board(Request $request)
    {
        return view('board');
    }

    public function map(Request $request)
    {
        $map = new Map();
        $map->setStylesheetOption('width', '100%');
        $map->setStylesheetOption('height', '450px');
        $map->setLanguage('nl');
        $map->setCenter(51.9360628, 4.430924, true);
        $map->setMapOption('zoom', 11);

        foreach(Location::all() as $location) {
            $marker = new Marker();
            $marker->setPosition($location->address_lat, $location->address_long, true);

            $marker->setInfoWindow(new InfoWindow('<h4>'  . $location->source->name . '</h4><p>Project: ' . $location->name . '<br />' . $location->address . ' ' . $location->address_number . ', ' . $location->city . '<br />' . $location->contact_name . '<br />' . $location->phone . '</p>'));
            $map->addMarker($marker);
        }

        return view('map', ['map' => $map, 'helper' => new MapHelper()]);
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
            'number' => 'required',
            'name' => 'required',
            'placed' => 'required',
            'till' => 'required',
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
        $location->planned_till = $request->input('till');
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

        $geocoder = new GoogleMaps(new Guzzle6HttpAdapter());
        $response = $geocoder->geocode($location->address . ' ' . $location->address_number . ', ' . $location->city . ', ' . $location->postal . ', Nederland');

        if ($response->count() == 0)
            return back()->withInput()->with('error', 'Adres niet gevonden');

        $location->address_lat = $response->first()->getLatitude();
        $location->address_long = $response->first()->getLongitude();

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

        $geocoder = new GoogleMaps(new Guzzle6HttpAdapter());
        $response = $geocoder->geocode($location->address . ' ' . $location->address_number . ', ' . $location->city . ', ' . $location->postal . ', Nederland');

        if ($response->count() == 0)
            return back()->withInput()->with('error', 'Adres niet gevonden');

        $location->address_lat = $response->first()->getLatitude();
        $location->address_long = $response->first()->getLongitude();

        $location->save();

        return back()->with('success', 'Project opgeslagen');
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
