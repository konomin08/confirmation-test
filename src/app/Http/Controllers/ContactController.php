<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;  // 正しいインポート
use App\Http\Requests\ContactRequest;
use App\Models\Contact;

class ContactController extends Controller
{
    public function index()
    {
        return view('index');
    }
    //contact.blade.php（フォーム入力ページ）を呼び出す
    public function confirm(ContactRequest $request)
    {
        $contact = $request->only(['last_name', 'first_name', 'gender', 'email', 'tel', 'address', 'building', 'category', 'content', ]);
        return view('confirm', ['contact' => $contact]);
    // 問い合わせフォームの送信ボタンクリック時に行われる処理
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
        // return view('thanks');
        return redirect()->route('thanks');
    }
    public function edit(ContactRequest $request)
    {
    // 入力データをフォーム画面に戻して再表示
    return view('index', ['contact' => $request->all()]);
    }
    // 管理者用の問い合わせ管理画面
    public function admin(Request $request)
    {
        // ユーザーが認証されていない場合、リダイレクト
        if (!auth()->check()) {
            return redirect()->route('login'); // ログインページにリダイレクト
        }
        // // お問い合わせ内容を全件取得
        // $contacts = Contact::paginate(7);  // ページネーションを利用して7件ごとに表示
        // return view('admin', compact('contacts'));
        
        // 検索用パラメータを取得
        $search = $request->input('search');
        $gender = $request->input('gender');
        $category = $request->input('category');
        // $dateFrom = $request->input('date_from');
        // $dateTo = $request->input('date_to');
        $date = $request->input('date');

        // お問い合わせ内容を全件取得、または検索を行う
        $contacts = Contact::when($search, function ($query, $search) {
            return $query->where('name', 'like', "%{$search}%")
                     ->orWhere('email', 'like', "%{$search}%");
        })->paginate(7);  // ページネーションを利用して7件ごとに表示

        return view('admin', compact('contacts'));
    }
    public function show($id)
    {
    // お問い合わせの詳細データを取得
        $contact = Contact::findOrFail($id);
        return view('contact-details', compact('contact'));
    }

    public function destroy($id)
    {
    // お問い合わせデータを削除
        Contact::findOrFail($id)->delete();
        return redirect()->route('admin')->with('success', 'データが削除されました');
    }

}
