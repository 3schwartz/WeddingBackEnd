<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin', ['except' => ['checkAdmin']]);
    }
    
    public function isAdmin() {
        return response()->json(
            [
                'message' => 'true',
                'isAdmin' => Auth::user()->isAdmin]);
    }

    public function checkAdmin() {
        if (Auth::user()) {
            $admin = Auth::user()->isAdmin;
        } else {
            $admin = 0;
        }
        return response()->json(
            [
                'message' => 'checkAdmin',
                'isAdmin' => $admin]);
    }
}
