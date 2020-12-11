<?php

namespace App\Http\Controllers;

use App\Produk;
use App\RiwayatBulanan;
use App\RiwayatHarian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RiwayatHarianController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $harian = RiwayatHarian::where('user_id', Auth::id())->orderBy('updated_at', 'desc')->paginate(10);
        return view('harian/index', compact('harian'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Produk $produk)
    {
        return view('harian/tambah', compact('produk'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Produk $produk)
    {
        // dd($produk);
        $request->validate([
            'jumlah_produk' => 'required',
            'tanggal' => 'required'
            ]);

        if ($produk->user_id != Auth::id()) {
            return redirect('harian')->with('status', 'dilarang memanipulasi produk orang');
        }

        if ($request->jumlah_produk > $produk->jumlah) {
            return redirect('harian')->with('status', 'jumlah melebihi stok');
        }
        $bulanan = RiwayatBulanan::where('user_id', Auth::id())->where('tanggal', $request->tanggal)->first();
        if (empty($bulanan)) {
            $bulanan = RiwayatBulanan::where('user_id', Auth::id())->where('status', 0)->first();
            if (!empty($bulanan)) {
                $bulanan->status = 1;
                $bulanan->update();
            }

            RiwayatBulanan::create([
                'user_id' => Auth::id(),
                'tanggal' => $request->tanggal,
                'pemasukan_hari_ini' => 0,
                'keuntungan_hari_ini' => 0,
                'status' => 0,
            ]);
        }

        $bulanan = RiwayatBulanan::where('user_id', Auth::id())->where('tanggal', $request->tanggal)->first();
        $riwayatHarian = RiwayatHarian::create([
            'produk_id' => $produk->id,
            'riwayat_bulanan_id' => $bulanan->id,
            'user_id' => Auth::id(),
            'jumlah_produk' => $request->jumlah_produk,
            'jumlah_harga_produk' => $request->jumlah_produk * $produk->harga,
            'jumlah_keuntungan' => $request->jumlah_produk * $produk->keuntungan,
        ]);

        $bulanan = RiwayatBulanan::where('user_id', Auth::id())->where('tanggal', $request->tanggal)->first();
        $bulanan->pemasukan_hari_ini = $bulanan->pemasukan_hari_ini + $produk->harga * $request->jumlah_produk;
        $bulanan->keuntungan_hari_ini =$bulanan->keuntungan_hari_ini + $produk->keuntungan * $request->jumlah_produk;
        $bulanan->update();

        $produk = Produk::where('id', $riwayatHarian->produk_id)->first();
        $produk->jumlah = $produk->jumlah - $riwayatHarian->jumlah_produk;
        $produk->update();

        return redirect('bulanan')->with('status', 'Riwayat berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\RiwayatHarian  $riwayatHarian
     * @return \Illuminate\Http\Response
     */
    public function show(RiwayatHarian $riwayatHarian)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\RiwayatHarian  $riwayatHarian
     * @return \Illuminate\Http\Response
     */
    public function edit(RiwayatHarian $riwayatHarian)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\RiwayatHarian  $riwayatHarian
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RiwayatHarian $riwayatHarian)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\RiwayatHarian  $riwayatHarian
     * @return \Illuminate\Http\Response
     */
    public function destroy(RiwayatHarian $riwayatHarian)
    {
        //
    }

    public function indexBulanan()
    {
        $bulanan = RiwayatBulanan::where('user_id', Auth::id())->orderBy('updated_at', 'desc')->paginate(10);
        return view('bulanan/index', compact('bulanan'));
    }
}
