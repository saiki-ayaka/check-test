<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Contact;
use App\Models\Category;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $categories = Category::all();

        $query = Contact::query();

        $this->applySearchFilters($query, $request);

        $contacts = $query->with('category')->paginate(7)->appends($request->all());

        return view('admin.index', compact('user', 'contacts','categories'));
    }

    public function export(Request $request)
    {
        $query = Contact::query();

        $this->applySearchFilters($query, $request);

        $contacts = $query->with('category')->get();

        $csvHeader = ['お名前', '性別', 'メールアドレス', 'お問い合わせの種類', 'お問い合わせ内容','画像パス'];
        $csvData = [];

        foreach ($contacts as $contact) {
            $gender = ($contact->gender == 1) ? '男性' : (($contact->gender == 2) ? '女性' : 'その他');
            $csvData[] = [
                $contact->last_name . $contact->first_name,
                $gender,
                $contact->email,
                $contact->category->content ?? '',
                $contact->detail,
                $contact->image_path
            ];
        }

        $callback = function () use ($csvHeader, $csvData) {
            $file = fopen('php://output', 'w');
            fputs($file, "\xEF\xBB\xBF");
            fputcsv($file, $csvHeader);
            foreach ($csvData as $row) {
                fputcsv($file, $row);
            }
            fclose($file);
        };

        $filename = 'contacts_' . date('YmdHis') . '.csv';
        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$filename",
        ];

        return response()->stream($callback, 200, $headers);
    }

    private function applySearchFilters($query, $request)
    {
        if ($request->filled('keyword')) {
            $keyword = $request->keyword;
            $query->where(function($q) use ($keyword) {
                $q->where('last_name', 'like', "%{$keyword}%")
                    ->orWhere('first_name', 'like', "%{$keyword}%")
                    ->orWhere('email', 'like', "%{$keyword}%")
                    ->orWhereRaw('CONCAT(last_name, first_name) LIKE ?', ["%{$keyword}%"]);
            });
        }
        if ($request->filled('gender') && $request->gender !== 'all') {
            $query->where('gender', $request->gender);
        }
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }
        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }
    }

    public function destroy(Request $request)
    {
        $contact = Contact::find($request->id);

        if ($contact) {
            $contact->delete(); 
        }
        return back();
    }

    public function admin()
    {
        return view('admin.index');
    }
}


