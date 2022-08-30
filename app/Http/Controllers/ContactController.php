<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Helpers\GlobalHelper;


class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {        
        $this->middleware('permission:contact-list', ['only' => ['index']]);
        $this->middleware('permission:contact-create', ['only' => ['create','store']]);
        $this->middleware('permission:contact-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:contact-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the users
     *
     * @param  \App\Models\User  $model
     * @return \Illuminate\View\View
     */
    public function index(Contact $model)
    {
        return view('contacts.index', [
            'contacts' => $model->orderBy('contact_name','ASC')->paginate(15)
        ]);
    }

    public function create()
    {
        $countries = Country::all();
        return view('contacts.create', [
            'countries' => $countries
        ]);
    }

    public function store(Request $request, Contact $model)
    {
        if ($request->isMethod('post'))
        {
            $contact = new Contact;
            $contact->country_id   = $request->input('country_id');
            $contact->type   = $request->input('type');
            $contact->title        = ucwords($request->input('title'));
            $contact->contact_info = $request->input('contact_info');
            $contact->email_address   = $request->input('email_address');
            $contact->contact_name = ucwords($request->input('contact_name'));
            $contact->user_id = Auth::user()->id;
            $contact->save();

            return redirect()->route('contacts')->withStatus(__('Contact added'));
        }else{
            return redirect()->route('contact.create')->withError(__('Invalid form entry'));
        }
    }

    public function edit(Contact $contact)
    {
        $countries = Country::all();
        return view('contacts.edit', ['contact' =>$contact, 'countries' => $countries]);
    }

    public function update(Request $request, Contact $contact)
    {
        if ($request->isMethod('post') || $request->isMethod('put'))
        {
            if($contact) {
                $contact->type   = $request->input('type');
                $contact->country_id   = $request->input('country_id');
                $contact->title        = ucwords($request->input('title'));
                $contact->email_address   = $request->input('email_address');
                $contact->contact_info = $request->input('contact_info');
                $contact->contact_name = ucwords($request->input('contact_name'));
                $contact->save();

                return redirect()->route('contact.index')->withStatus(__('Contact updated.'));             
            }
        }
        return redirect()->route('contact.edit', $contact)->withError(__('Invalid form entry'));
    }

    public function destroy(Contact $contact)
    {
        if($contact) {   
            $contact->delete();
            return redirect()->route('contact.index')->withStatus(__('Contact deleted'));  
        }
        return redirect()->route('contact.index')->withError(__('Unable to delete'));  
    }
}
