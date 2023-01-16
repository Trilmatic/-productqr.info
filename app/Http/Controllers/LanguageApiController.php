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
        if(!$user->tokenCan('read') || !$user->has_pro_plan() || $user->is_over_api_limit()) return response('Forbidden', 403);
        $lang = Language::all();
        if (!$lang) abort(404);
        $user->call_api();
        return response()->json($lang);
    }
}
