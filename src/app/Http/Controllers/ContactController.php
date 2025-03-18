<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;
use App\Models\Contact;

class ContactController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function confirm(ContactRequest $request)
    {
        $contact = $request->only(['last_name', 'first_name', 'gender', 'email', 'tel', 'address', 'building', 'category', 'content', ]);
        return view('confirm', ['contact' => $contact]);
    }
    
    public function store(ContactRequest $request)
    {
        $contact = $request->only(['last_name', 'first_name', 'gender', 'email', 'tel', 'address', 'building', 'category', 'content', ]);
        
        Contact::create([
            'name' => $contact['last_name'] . ' ' . $contact['first_name'],
            'gender' => $contact['gender'],
            'email' => $contact['email'],
            'tel' => $contact['tel'],
            'address' => $contact['address'],
            'building' => $contact['building'],
            'category' => $contact['category'],
            'content' => $contact['content'],
        ]);
        return redirect()->route('thanks');
    }
    
    public function edit(ContactRequest $request)
    {
    return view('index', ['contact' => $request->all()]);
    }

    public function admin(Request $request)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $search = $request->input('search');
        $gender = $request->input('gender');
        $category = $request->input('category');
        $date = $request->input('date');

        $contacts = Contact::when($search, function ($query, $search) {
            return $query->where('name', 'like', "%{$search}%")
                     ->orWhere('email', 'like', "%{$search}%");
        })->paginate(7);

        return view('admin', compact('contacts'));
    }
    public function show($id)
    {
        $contact = Contact::findOrFail($id);
        return view('contact-details', compact('contact'));
    }

    public function destroy($id)
    {
        Contact::findOrFail($id)->delete();
        return redirect()->route('admin')->with('success', 'データが削除されました');
    }
}
