<?php

namespace App\Http\Controllers;

use App\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProdukController extends Controller
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
        $produk = Produk::where('user_id', Auth::id())->orderBy('id', 'desc')->paginate(10);
        return view('produk/index', compact('produk'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('produk/tambah');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|max:255',
            'modal' => 'required',
            'harga' => 'required',
            'jumlah' => 'required',
        ]);

        Produk::create([
            'nama' => $request->nama,
            'modal' => $request->modal,
            'harga' => $request->harga,
            'jumlah' => $request->jumlah,
            'keuntungan' => $request->harga - $request->modal,
            'user_id' => Auth::id(),
        ]);
        return redirect('produk')->with('status', 'produk berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function show(Produk $produk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function edit(Produk $produk)
    {
        if ($produk->user_id != Auth::id()) {
            return redirect('produk')->with('status', 'produk orang gagal diubah');
        }
        return view('produk/edit', compact('produk'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Produk $produk)
    {
        $request->validate([
            'nama' => 'required|max:255',
            'modal' => 'required',
            'harga' => 'required',
            'jumlah' => 'required',
        ]);

        if ($produk->user_id != Auth::id()) {
            return redirect('produk')->with('status', 'produk orang gagal diubah');
        }

        $produk->nama = $request->nama;
        $produk->modal = $request->modal;
        $produk->harga = $request->harga;
        $produk->jumlah = $request->jumlah;
        $produk->keuntungan = $request->harga - $request->modal;
        $produk->user_id = Auth::id();
        $produk->update();

        return redirect('produk')->with('status', 'produk berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function destroy(Produk $produk)
    {
        if ($produk->user_id != Auth::id()) {
            return redirect('produk')->with('status', 'produk orang gagal diubah');
        }

        Produk::destroy($produk->id);
        return redirect('produk')->with('status', 'produk berhasil dihapus');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function cari(Request $request)
    {
        $produk = Produk::where('user_id', Auth::id())->where('nama', 'like', '%'.$request->cari.'%')->orderBy('id', 'desc')->paginate(10);
        return view('produk/index', compact('produk'));
    }    
}
