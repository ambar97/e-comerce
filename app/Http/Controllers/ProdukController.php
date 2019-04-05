<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Produk;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $no = 1;
        $produks = Produk::orderBy('created_at','asc')->paginate(30);
        return view('ikan.daftar',compact('produks','no'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create()
    // {

    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'     => 'required|min:4',
            'stok'     => 'required|min:1',
            'harga'     => 'required|min:3',
            'satuan'     => 'required',
            'image'     => 'required',
            'deskripsi' => 'required|min:8'
        ]);
        // menjadi slug
        $slug = str_slug($request->name, '-');
        // chek apa lug ada yang sama
        if (Produk::where('slug',$slug)->first() != null) {
            $slug = $slug. '-' . time();
        }

        // dd($slug);

        $image = $request->file('image');
        $input['namefile'] = time().'-'.$image->getClientOriginalName();
        $tempat = public_path('image/projek');
        $image->move($tempat,$input['namefile']);

        if (Auth::check() && Auth::user()->role == 1) {
          Produk::create([
            'name' => $request->name,
            'stok' => $request->stok,
            'harga' => $request->harga,
            'slug'  => $slug,
            'deskripsi' => $request->deskripsi,
            'image' => $input['namefile'],
            'satuan' => $request->satuan,
            'user_id'   => Auth::user()->id,
        ]);
      } 
      return redirect('/produk');
  }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        // dd('masuk');
       $ikan = Produk::where('slug',$slug)->first();
       // dd($ikan);
       return view('ikan.single_ikan', compact('ikan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $prodak = Produk::findOrFail($id);
        // validari
        $this->validate($request,[
            'name'     => 'required|min:4',
            'stok'     => 'required|min:1',
            'harga'     => 'required|min:3',
            'satuan'     => 'required',
            'image'     => 'required',
            'deskripsi' => 'required|min:8'
        ]);

        $slug = str_slug($request->title, '-');

        // chek slug ada apa tidak di database
        if (Produk::where('slug',$slug)->first() != null) {
            $slug = $slug. '-' . time();
        }

        $image = $request->file('image');
        $input['namefile'] = time().'-'.$image->getClientOriginalName();
        $tempat = public_path('image/projek');
        $image->move($tempat,$input['namefile']);

        if (Auth::check() && Auth::user()->role == 1) {
            $prodak->update([
             'name' => $request->name,
             'stok' => $request->stok,
             'harga' => $request->harga,
             'slug'  => $slug,
             'deskripsi' => $request->deskripsi,
             'image' => $input['namefile'],
             'satuan' => $request->satuan,
             'user_id'   => Auth::user()->id,
         ]);

        }else {
           abort(404);
       }
       return redirect('/produk');
   }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
     $produk = Produk::findOrFail($id);

     if (Auth::check() && Auth::user()->role == 1) {
      $produk->delete();
  }else {
     abort(404);
 }

 return redirect('/produk');
}
}
