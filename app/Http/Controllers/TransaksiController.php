<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\order;
use App\Produk;
use App\transaksi;
use App\pembayaran;
use Illuminate\Http\Request;

class TransaksiController extends Controller
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

    public function pembayaranProduk()
    {
        $transaksi = transaksi::join('orders', 'transactions.order_id', '=', 'orders.id')->where('orders.pemilik_id','=',Auth::user()->id)->where('orders.status','sudah')->where('transactions.id_pembayaran', null)->first();
        // dd($transaksi);
        return view('transaksi.pembayaran', compact('transaksi'));
    }

    public function ucapanBerhasil()
    {
        return view('transaksi.ucapan');
    }

    public function pembayaranUpload(Request $request)
    {
     $transaksis = transaksi::join('orders', 'transactions.order_id', '=', 'orders.id')->where('orders.pemilik_id','=',Auth::user()->id)->where('orders.status','sudah')->where('transactions.id_pembayaran', null)->get();


     $this->validate($request,[
        'norekening' => 'required|max:19',
        'image' => 'required'
    ]);

     $image = $request->file('image');
     $input['namefile'] = time().'-'.$image->getClientOriginalName();
     $tempat = public_path('image/atm');
     $image->move($tempat,$input['namefile']);

     $pembayarantTransaksi = pembayaran::create([
        'norekening' => $request->norekening,
        'fotoPembayaran'      => $input['namefile']
    ]);

    // dd($pembayarantTransaksi->id);

     if (count($transaksis)>0) {
        foreach ($transaksis as $transaksi) {

           $transaksiUpdate = transaksi::where('order_id',$transaksi->id)->first();

           $transaksiUpdate->update([
            'id_pembayaran' => $pembayarantTransaksi->id,
            'status' => 'dibayar',
        ]);
       }
   }

   return redirect('/transaksi-berhasil');
}
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function historyPesanan()
    {
        $no =1;

        if (Auth::check()) {
            $historys = transaksi::join('orders', 'transactions.order_id', '=', 'orders.id')->join('pembayaran', 'transactions.id_pembayaran', '=', 'pembayaran.id')->where('orders.status','sudah')->where('transactions.status', 'dibayar')->where('orders.pemilik_id', Auth::user()->id)->get();
            // dd($historys);

            return view('pembeli.history', compact('historys','no'));
        }else{
         abort(404);
     }
 }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
