<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function getLogout()
	{
		auth()->logout();
		return redirect()->route('gallery');
	}
}
