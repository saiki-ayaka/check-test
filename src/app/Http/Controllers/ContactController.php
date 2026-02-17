<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;
use App\Models\Category;
use App\Models\Contact;

class ContactController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('index', compact('categories'));
    }

    public function confirm(ContactRequest $request)
    {
        $contact = $request->all();
        $category = Category::find($contact['category_id']);

        return view('confirm', compact('contact', 'category'));
    }

    public function store(Request $request)
    {
        $contact = $request->only(['first_name', 'last_name', 'gender', 'email', 'tel', 'address', 'building', 'category_id', 'detail', 'image_path']);

        Contact::create($contact);

        return view('thanks');
    }

    public function admin()
{
    // categoryのリレーションと一緒に、10件ずつ取得
    $contacts = Contact::with('category')->paginate(7);
    
    return view('admin', compact('contacts'));
}
}
