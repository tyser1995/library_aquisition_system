<?php

namespace App\Imports;

use App\Models\Hotel;
use App\Models\Contact;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Auth;

class HotelImport implements ToModel, WithHeadingRow
{
    public $country_id;
    public $hotel_group_id;

    public function __construct($country_id, $hotel_group_id){
        $this->country_id = $country_id;
        $this->hotel_group_id = $hotel_group_id;
    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {

        $contact = Contact::where('country_id','=',$this->country_id)->where('contact_name','=',$row['contact_name'])->get()->first();
        if(!$contact && $row['contact_name'] != ""){
            $contact = new Contact;
            $contact->country_id   = $this->country_id;
            $contact->type   = 'office';
            $contact->title        = ucwords($row['position']);
            $contact->contact_info = "";
            $contact->email_address   = $row['email_address'];
            $contact->contact_name = ucwords($row['contact_name']);
            $contact->user_id = Auth::user()->id;
            $contact->save();
        }

        $hotel = Hotel::where('country_id','=',$this->country_id)->where('hotel_name','=',$row['property'])->get()->first();
        if($contact && !$hotel && $row['property'] != ""){
            return new Hotel([
                'hotel_name' => ucwords($row['property']),
                'country_id' => $this->country_id,
                'contact_id' => $contact->id,
                'website' => '',
                'address' => $row['location'],
                'latitude' => '',
                'longitude' => '',
                'room_type' => '',
                'phone_number' => '',
                'created_by_user_id' => Auth::user()->id
            ]);
        }else{
            return null;
        }

        
    }
}
