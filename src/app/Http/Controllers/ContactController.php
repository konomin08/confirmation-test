<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    public function index()
    {
        return view('index');
    }
    //contact.blade.php（フォーム入力ページ）を呼び出す
    public function confirm(Request $request)
    {
        $contact = $request->only(['name', 'email', 'tel', 'content']);
        return view('confirm', ['contact' => $contact]);
    // 問い合わせフォームの送信ボタンクリック時に行われる処理
    }
    public function store(Request $request)
    {
        $contact = $request->only(['name', 'email', 'tel', 'content']);
        Contact::create($contact);
        return view('thanks');
    }
}
