<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Language;

class LanguageApiController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if (!$user->tokenCan('read')) response()->json(['message' => 'Forbidden!'], 403);
        $lang = Language::all();
        if (!$lang) abort(404);
        return response()->json($lang);
    }
}
