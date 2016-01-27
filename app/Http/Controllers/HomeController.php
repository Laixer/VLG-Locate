<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use VLG\GSSAuth\Hello;

class HomeController extends Controller
{

	public function welcome(Request $request)
	{
		return view('dashboard');
	}

	public function getList(Request $request)
	{
		return view('list');
	}

}
