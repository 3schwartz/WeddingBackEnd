<?php

namespace App\Http\Controllers;

use App\GuestState;
use Illuminate\Http\Request;

class GuestStateController extends Controller
{
    public function show()
    {
        return GuestState::all();
    }    
}
