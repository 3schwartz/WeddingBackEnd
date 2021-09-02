<?php

namespace App\Http\Controllers;

use App\Address;
use App\ModelUtil;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public static function read(string $id)
    {
        $address = Address::find($id);
        $address->guests = $address->guests;

        return $address;
    }

    public function show()
    {
        $addresses = Address::orderBy('homeAddress')->get();

        foreach($addresses as $address) {
            $address->guests = $address->guests;
        }

        return $addresses;
    }

    public function create(Request $request)
    {
        $address = new Address;
        $address->homeAddress = $request->homeAddress;
        $address->save();

        ModelUtil::persistGuest($request->guests, $address);

        return $address;
    }

    public function update(Request $request)
    {
        $address = Address::findOrFail($request->id);

        if ($request->homeAddress != null)
            $address->homeAddress = $request->homeAddress;
        $address->save();

        ModelUtil::persistGuest($request->guests, $address);

        return $address;
    }

    public function delete(string $id) {
        Address::destroy($id);
    }
}
