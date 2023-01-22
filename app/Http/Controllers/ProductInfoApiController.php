<?php

namespace App\Http\Controllers;

use App\Models\ProductInfo;
use App\Models\ProductInfoSection;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductInfoApiController extends Controller
{

    public function index($hash)
    {
        $user = Auth::user();
        if (!$user->tokenCan('read') || !$user->has_pro_plan()) return response('Forbidden', 403);
        if($user->is_over_api_limit()) return response('You are over monthly request limit ', 429);
        $product = Product::with("product_infos", "product_infos.language")->where('hash', $hash)->first();
        if (!$product) return response('Not Found', 404);
        if ($user->id != $product->user_id) return response('Forbidden', 403);
        $user->call_api();
        return response()->json($product);
    }

    public function show($hash)
    {
        $user = Auth::user();
        if (!$user->tokenCan('read') || !$user->has_pro_plan()) return response('Forbidden', 403);
        if($user->is_over_api_limit()) return response('You are over monthly request limit ', 429);
        $info = ProductInfo::with("language")->where('hash', $hash)->first();
        if (!$info) return response('Not Found', 404);
        if ($user->id != $info->user_id) return response('Forbidden', 403);
        $user->call_api();
        return response()->json($info);
    }

    public function store(Request $request, $hash)
    {
        $user = Auth::user();
        if (!$user->tokenCan('create') || !$user->has_pro_plan()) return response('Forbidden', 403);
        if($user->is_over_api_limit()) return response('You are over monthly request limit ', 429);
        $product = Product::where('hash', $hash)->first();
        if (!$product) return response('Not Found', 404);
        if ($user->id != $product->user_id) return response('Forbidden', 403);
        $request->validate([
            'language_id' => 'required',
            'sections.*.title' => 'required',
            'sections.*.sort' => 'required'
        ]);
        $info = new ProductInfo([
            'language_id' => $request->get('language_id'),
            'product_id' => $product->id,
            'user_id' => $user->id,
        ]);
        $info->save();
        if ($request->get('sections')) {
            foreach ($request->get('sections') as $section) {
                $sec_new = new ProductInfoSection([
                    'product_info_id' => $info->id,
                    'user_id' => $user->id,
                    'title' => $section['title'],
                    'content' => $section['content'],
                    'sort' => $section['sort'],
                ]);
                $sec_new->save();
            }
        }
        $info = ProductInfo::with("sections")->findOrFail($info->id);
        $user->call_api();
        return response()->json($info);
    }

    public function update(Request $request, $hash, $hash2)
    {
        $user = Auth::user();
        if(!$user->has_pro_plan()) return response('Forbidden', 403);
        if($user->is_over_api_limit()) return response('You are over monthly request limit ', 429);
        $product = Product::where('hash', $hash)->first();
        if (!$product) return response('Not Found', 404);
        if ($user->cannot('update', $product)) return response('Forbidden', 403);
        $info = ProductInfo::where('hash', $hash2)->first();
        if (!$info) return response('Not Found', 404);
        if ($user->cannot('update', $info)) return response('Forbidden', 403);
        $request->validate([
            'language_id' => 'required',
            'sections.*.title' => 'required',
            'sections.*.sort' => 'required'
        ]);
        $info->language_id = $request->get('language_id');
        $info->save();
        foreach ($request->get('sections') as $section) {
            if (isset($section['id'])) {
                $sec_edit = ProductInfoSection::findOrFail($section['id']);
                if ($user->cannot('update', $sec_edit)) return response('Forbidden', 403);
                if($user->is_over_api_limit()) return response('You are over monthly request limit ', 429);
                $sec_edit->title = $section['title'];
                $sec_edit->content = $section['content'];
                $sec_edit->sort = $section['sort'];
                $sec_edit->save();
            } else {
                $sec_new = new ProductInfoSection([
                    'product_info_id' => $info->id,
                    'user_id' => $user->id,
                    'title' => $section['title'],
                    'content' => $section['content'],
                    'sort' => $section['sort'],
                ]);
                $sec_new->save();
            }
        }
        $user->call_api();
        return response()->json($info->with('sections'));
    }

    public function destroy($hash)
    {
        $user = Auth::user();
        if(!$user->has_pro_plan()) return response('Forbidden', 403);
        if($user->is_over_api_limit()) return response('You are over monthly request limit ', 429);
        $info = ProductInfo::where('hash', $hash)->first();
        if (empty($info)) return response('Not Found', 404);
        if ($user->cannot('delete', $info)) return response('Forbidden', 403);
        $info->delete();
        $user->call_api();
        return response('Success');
    }

    public function destroy_section($hash)
    {
        $user = Auth::user();
        if(!$user->has_pro_plan()) return response('Forbidden', 403);
        if($user->is_over_api_limit()) return response('You are over monthly request limit ', 429);
        $section = ProductInfoSection::where('hash', $hash)->first();
        if ($section->isEmpty()) return response('Not Found', 404);
        if ($user->cannot('delete', $section)) return response('Forbidden', 403);
        $section->delete();
        $user->call_api();
        return response('Success');
    }
}
