<?php

namespace App\Http\Controllers;

use App\Guest;
use App\ModelUtil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GuestController extends Controller
{
    public function index()
    {
        return Guest::select('name')->orderBy('name')->get();
    }

    public function show()
    {
        $guests = Guest::orderBy('name')->get();

        foreach($guests as $guest) {
            $guest->address = $guest->address;
            $guest->gueststate;
        }

        return $guests;
    }

    public function delete(string $id) 
    {
        Guest::destroy($id);
    }

    public function create(Request $request)
    {
        $guest = new Guest;
        $guest->name = $request->name;
        $guest->email = $request->email;

        $guest->save();

        ModelUtil::persistAddress($guest, $request->address);
        ModelUtil::persistGuestState($guest, $request->gueststate);

        return $guest;
    }

    public function update(Request $request) 
    {
        $guest = Guest::findOrFail($request->id);

        if ($request->name != null)
            $guest->name = $request->name;
        if ($request->email != null)
            $guest->email = $request->email == 'null' ? null : $request->email;

        $guest->save();

        ModelUtil::persistAddress($guest, $request->address);
        ModelUtil::persistGuestState($guest, $request->gueststate);

        return $guest;
    }

    public function export() {

        $guests = DB::table('guests')
        ->select('guests.name', 'name')
        ->addSelect('guests.email', 'email')
        ->addSelect('addresses.homeAddress', 'homeAddress')
        ->addSelect('gueststate.stateName', 'stateName')
        ->leftJoin('addresses', 'addresses.id', '=', 'guests.address_id')
        ->leftJoin('gueststate', 'gueststate.id', '=', 'guests.guestState_id')
        ->orderBy('guests.name')
        ->get()->toArray();

        $filename = 'guestList';

        self::exportGuests($guests, $filename);
        die();
    }

//     SELECT guests.name, guests.email, guests.saveTheDateSend, guests.invitationSend, guests.attending, addresses.homeAddress
// from guests left join addresses on addresses.id = guests.id
// order by guests.name


    private static function exportGuests($guests, $filename) {

        $header = array(
            'Name',
            'Email',
            'Address',
            'Attending',
        );

        self::export_csv($header, $guests, $filename);

    }

    private static function export_csv($header, $data, $filename) {

        // Open the output stream
        $fh = fopen('php://output', 'w');

        // Start output buffering (to capture stream contents)
        ob_start();

        // CSV Header
        if(is_array($header)){
            fputcsv($fh, $header);
        }

        // CSV Data
        foreach ($data as $row) {

            fputcsv($fh, self::mapRow($row));
        }

        // Get the contents of the output buffer
        $string = ob_get_clean();

        // Output CSV-specific headers
        header('Pragma: public');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Cache-Control: private', false);
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename="' . $filename . '.csv";');
        header('Content-Transfer-Encoding: binary');

        // Stream the CSV data
        exit($string);
    }

    private static function mapRow($guest) {
        return [
            $guest->name,
            $guest->email,
            $guest->homeAddress,
            $guest->stateName
        ];
    }    
}
