@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Produk Terjual') }}</div>

                <div class="card-body">
                    <h1 class="text-center">{{$riwayatHarian->produk->nama}}</h1>
                <form method="POST" action="{{url('harian/'.$riwayatHarian['id'])}}">
                        @csrf
                        @method('PUT')

                        <div class="form-group row">
                            <label for="jumlah_produk" class="col-md-4 col-form-label text-md-right">{{ __('Terjual') }}</label>

                            <div class="col-md-6">
                                <input id="jumlah_produk" type="text" class="form-control @error('jumlah_produk') is-invalid @enderror" name="jumlah_produk" value="{{ $riwayatHarian->jumlah_produk }}" required autocomplete="jumlah_produk" autofocus>

                                @error('jumlah_produk')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tanggal" class="col-md-4 col-form-label text-md-right">{{ __('Tanggal') }}</label>

                            <div class="col-md-6">
                                <input id="tanggal" type="date" class="form-control @error('tanggal') is-invalid @enderror" name="tanggal" value="{{ $riwayatHarian->riwayat_Bulanan->tanggal }}" required autocomplete="tanggal" autofocus>

                                @error('tanggal')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Produk Terjual
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
