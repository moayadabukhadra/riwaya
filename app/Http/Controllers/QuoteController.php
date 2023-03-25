<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Quote;
use Illuminate\Http\Request;

class QuoteController extends Controller
{
    public function index()
    {
        return view('quote.quotes-table');
    }

    public function show(Quote $quote = null)
    {
        $authors = Author::all();
        return view('quote.quote-form', compact('quote', 'authors'));
    }

    public function store(Request $request, Quote $quote = null)
    {
        $request->validate([
            'body' => 'required',
            'author_id' => 'required',
        ],[
            'body.required' => 'الرجاء إدخال النص',
            'author_id.required' => 'الرجاء إدخال الكاتب',
        ]);

        Quote::updateOrCreate(['id' => $quote->id ?? null],
            $request->all('body', 'author_id'));

        return redirect()->route('quote.index')
            ->with('success', 'تمت الإضافة بنجاح');
    }
}
