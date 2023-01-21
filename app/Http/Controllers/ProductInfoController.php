<?php

namespace App\Http\Controllers;

use App\Models\ProductInfo;
use App\Models\ProductInfoSection;
use App\Models\Product;
use App\Models\Language;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class ProductInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($hash)
    {
        $user = Auth::user();
        $product = Product::with("owner")->where('hash', $hash)->first();
        if (!$product) abort(404);
        if ($user->id != $product->user_id) abort(403);
        $languages = Language::all();
        return Inertia::render('ProductInfo/Create', [
            'product' => $product,
            'languages' => $languages,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $hash)
    {
        $user = Auth::user();
        $product = Product::where('hash', $hash)->first();
        if (!$product) abort(404);
        if ($user->id != $product->user_id) abort(403);
        $request->validate([
            'language_id' => 'required',
            'sections.*.title' => 'required'
        ]);
        $info = new ProductInfo([
            'language_id' => $request->get('language_id'),
            'product_id' => $product->id,
            'user_id' => $user->id,
        ]);
        $info->save();
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
        return redirect('/product/' . $product->hash . '/info?hash=' . $info->hash);
    }

    public function get_custom_qr(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'product_id' => 'required',
        ]);
        $product = Product::where('id', $request->get('product_id'))->first();
        if(!$product) abort(404);
        if ($user->id != $product->user_id) abort(403);
        $size = $request->get('size') ? $request->get('size') : '200x200';
        $url = "/products/" . $product->hash . '/info';
        $protocol = stripos($_SERVER['SERVER_PROTOCOL'], 'https') === 0 ? 'https://' : 'http://';
        $data =  $protocol . $_SERVER['HTTP_HOST'] . $url;
        //Get QR code
        $QR = imagecreatefrompng('https://chart.googleapis.com/chart?cht=qr&chld=H|1&chs=' . $size . '&chl=' . urlencode($data));
        //Add logo into QR
        $logo = $request->get('image') ? imagecreatefromstring(file_get_contents($request->get('image'))) : imagecreatefromstring(file_get_contents(public_path("qr-logo.png")));
        $QR_width = imagesx($QR);
        $QR_height = imagesy($QR);

        $logo_width = imagesx($logo);
        $logo_height = imagesy($logo);

        // Scale logo to fit in the QR Code
        $logo_qr_width = $QR_width / 3;
        $scale = $logo_width / $logo_qr_width;
        $logo_qr_height = $logo_height / $scale;

        imagecopyresampled($QR, $logo, $QR_width / 3, $QR_height / 3, 0, 0, $logo_qr_width, $logo_qr_height, $logo_width, $logo_height);
        ob_start();
        imagepng($QR);
        $stringdata = ob_get_contents();
        ob_end_clean();
        dd($stringdata);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductInfo  $productInfo
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $hash)
    {
        $product = Product::with("product_infos", "product_infos.language", "owner")->where('hash', $hash)->first();
        if (!$product) abort(404);
        $user = User::where('id', $product->user_id)->first();
        if ($user->product_over_limit($product->id)) {
            if (Auth::user() && Auth::user()->id === $user->id) return redirect()->route('subscription.upgrade');
            abort(404);
        }
        if ($request->input('hash')) {
            $info = $product->request_info($request->input('hash'))->with("sections")->first();
            if (!$info) abort(404);
        } else {
            $info = $product->info()->with("sections")->first();
            if (!$info) $info = $product->product_infos()->with("sections")->first();
        }

        if (Auth::user()) {
            return Inertia::render('ProductInfo/Show', [
                'product' => $product,
                'info' => $info,
            ]);
        } else {
            return Inertia::render('ProductInfo/ShowNoLayout', [
                'product' => $product,
                'info' => $info,
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductInfo  $productInfo
     * @return \Illuminate\Http\Response
     */
    public function edit($hash, $hash2)
    {
        $user = Auth::user();
        $product = Product::with("owner")->where('hash', $hash)->first();
        if (!$product) abort(404);
        if ($user->id != $product->user_id) abort(403);
        $info = ProductInfo::where('hash', $hash2)->with("sections")->first();
        if (!$info) abort(404);
        if ($user->id != $info->user_id) abort(403);
        $languages = Language::all();
        return Inertia::render('ProductInfo/Edit', [
            'product' => $product,
            'languages' => $languages,
            'info' => $info,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductInfo  $productInfo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $hash, $hash2)
    {
        $user = Auth::user();
        $product = Product::where('hash', $hash)->first();
        if (!$product) abort(404);
        if ($user->cannot('update', $product)) abort(403);
        $info = ProductInfo::where('hash', $hash2)->first();
        if (!$info) abort(404);
        if ($user->cannot('update', $info)) abort(403);
        $request->validate([
            'language_id' => 'required',
            'sections.*.title' => 'required'
        ]);
        $info->language_id = $request->get('language_id');
        $info->save();
        foreach ($request->get('sections') as $section) {
            if (isset($section['id'])) {
                $sec_edit = ProductInfoSection::findOrFail($section['id']);
                if ($user->cannot('update', $sec_edit)) abort(403);
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
        return redirect('/product/' . $product->hash . '/info?hash=' . $info->hash);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductInfo  $productInfo
     * @return \Illuminate\Http\Response
     */
    public function destroy($hash, $hash2)
    {
        $user = Auth::user();
        $product = Product::where('hash', $hash)->first();
        if (!$product) abort(404);
        $info = ProductInfo::where('hash', $hash2)->first();
        if (!$info) abort(404);
        if ($user->cannot('delete', $info)) abort(403);
        $info->delete();
        return redirect()->route('product.info.show', $product->hash);
    }

    public function destroy_section($hash, $hash2)
    {
        $user = Auth::user();
        $product = Product::where('hash', $hash)->first();
        if (!$product) abort(404);
        $section = ProductInfoSection::where('hash', $hash2)->first();
        if (!$section) abort(404);
        if ($user->cannot('delete', $section)) abort(403);
        $section->delete();
        redirect()->back()->with('success', 'deleted');
    }
}
