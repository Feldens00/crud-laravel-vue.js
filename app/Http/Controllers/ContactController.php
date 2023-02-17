<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\ContactForm;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ContactController extends Controller
{
    public function Admin_Contact(){
        $contacts = Contact::all();
        return view('admin.contact.index', compact('contacts'));
    }

    public function Admin_Add_Contact(){
        return view('admin.contact.create');
    }

    public function Admin_Store_Contact(Request $request){
        
        $validetedData = $request->validate([
            'contact_adress' => 'required|min:5',
            'contact_email' => 'required|email',
            'contact_phone' => 'required|min:5',
        ],
        [
            'contact_adress.required' => 'Pleas insert a valid adress!',
            'contact_adress.min' => 'Pleas insert more then 5 character!',

            
            'contact_email.required' => 'Pleas insert a email!',
            'contact_email.email' => 'Pleas insert a valid email!',

            'contact_phone.required' => 'Pleas insert a valid phone!',
            'contact_phone.min' => 'Pleas insert more then 5 character!',

        ]);

        Contact::insert([
            'adress' => $request->contact_adress,
            'email' => $request->contact_email,
            'phone' => $request->contact_phone,
            'created_at' => Carbon::now(),
        ]);

        return Redirect()->route('admin.contact')->with('success','About Insert Successfuly');
    }


    public function Contact(){
        $contact = DB::table('contacts')->first();
        return view('pages.contact', compact('contact'));
    }

    public function Contact_Form(Request $request){
        $validetedData = $request->validate([
            'name' => 'required|min:5',
            'email' => 'required|email',
            'subject' => 'required|min:5',
            'message' => 'required|min:5',
        ],
        [
            'name.required' => 'Pleas insert a valid name!',
            'name.min' => 'Pleas insert more then 5 character!',

            
            'email.required' => 'Pleas insert a email!',
            'email.email' => 'Pleas insert a valid email!',

            'subject.required' => 'Pleas insert a valid subject!',
            'subject.min' => 'Pleas insert more then 5 character!',

            'message.required' => 'Pleas insert a valid message!',
            'message.min' => 'Pleas insert more then 5 character!',

        ]);

        ContactForm::insert([
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
            'created_at' => Carbon::now(),
        ]);

        return Redirect()->route('contact')->with('success','Your Message Send Successfuly');
    }

    public function Admin_Message(){
        $messages = ContactForm::all();
        return view('admin.contact.message', compact('messages'));
    }
}
