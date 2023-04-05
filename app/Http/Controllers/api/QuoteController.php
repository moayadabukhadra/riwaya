<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Quote;

class QuoteController extends Controller
{
    public function index(){
        $quotes = Quote::with(['author'])->get();
        return response()->json($quotes, 200, [], JSON_PRETTY_PRINT);
    }

    public function show(Quote $quote){
        return response()->json($quote->load('author'), 200, [], JSON_PRETTY_PRINT);
    }

    public function getRandomQuote(){
        $quote = Quote::with('author')->inRandomOrder()->first();
        return response()->json($quote, 200, [], JSON_PRETTY_PRINT);
    }



}
