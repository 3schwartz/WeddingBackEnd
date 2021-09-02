<?php

namespace App;

class ModelUtil
{
    static function persistGuest($guests, Address $address)
    {
        if (is_null($guests))
            return;
        
        foreach ($guests as &$gst) {
            $guest = Guest::findOrFail($gst['id']);
            $guest->address_id = $address->id;
            $guest->save();
        }
    }

    static function persistAddress(Guest $guest, $address) 
    {
        if(is_null($address)) 
            return;

        if($address === 'null') {
            $guest->address_id = null;
            $guest->save();
            return;
        }
        
        $addr = Address::findOrFail($address); 
        $guest->address_id = $addr->id;
        $guest->save();
    }

    static function persistGuestState(Guest $guest, $gueststate) 
    {
        if(is_null($gueststate)) 
            return;

        if($gueststate === 'null') {
            $guest->guestState_id = null;
            $guest->save();
            return;
        }
        
        $state = GuestState::findOrFail($gueststate); 
        $guest->guestState_id = $state->id;
        $guest->save();
    }
}