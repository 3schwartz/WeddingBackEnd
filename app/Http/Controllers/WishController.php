<?php

namespace App\Http\Controllers;

use App\Wish;
use Illuminate\Http\Request;

class WishController extends Controller
{
    public function show()
    {
        $wishes = Wish::orderBy('name')->get();

        return $wishes;
    }

    public function delete(string $id) 
    {
        Wish::destroy($id);        
    }

    public function create(Request $request)
    {
        $wish = new Wish;
        $wish->name = $request->name;
        $wish->url = $request->url;
        $wish->price = $request->price;
        $wish->save();
        
        return $wish;
    }

    public function update(Request $request) 
    {
        $wish = Wish::findOrFail($request->id);

        if ($request->name != null)
            $wish->name = $request->name;
        if ($request->url != null)
            $wish->url = $request->url;
        if ($request->price != null)
            $wish->price = $request->price;    

        $wish->save();

        return $wish;
    }
    
}
