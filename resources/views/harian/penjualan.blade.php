@extends('layouts/app')

@section('content')
    
<div class="container">
  <div class="row">
    <div class="col-10">
      <h1 class="mt-3">Daftar Produk</h1>

      {{-- <a href="/produk/tambah" class="btn btn-primary my-3">Tambah Produk</a> --}}
      
      <form method="POST" action="{{url('penjualan/cari')}}">
        @csrf

        <div class="input-group mb-3">
          <input type="text" name="cari" class="form-control" placeholder="cari barang..." aria-label="Recipient's username" aria-describedby="button-addon2">
            <div class="input-group-append">
              <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Button</button>
            </div>
        </div>
      </form>

      @if (session('status'))
      <div class="alert alert-info">
          {{ session('status') }}
      </div>
  @endif
      
  {{-- <ul class="list-group">
      <li class="list-group-item d-flex justify-content-between align-items-center">
          {{$item['nama']}}
        <a href="/santri/{{$item['id']}}" class="badge badge-primary justify-content-end">Detail</a>
    </li>
</ul>      --}}
<table class="table">
    <thead class="thead-dark">
              <tr>
                  <th scope="col">NO</th>
                  <th scope="col">Nama</th>
                  <th scope="col">Modal</th>
                  <th scope="col">Harga</th>
                  <th scope="col">Keuntangan</th>
                  <th scope="col">Jumlah</th>
                  <th scope="col">Terjual</th>
                </tr>
            </thead>
            <tbody>
              @foreach ($produk as $item)
              <tr>
              <th scope="row">{{ $loop->iteration }}</th>
              <td>{{ $item['nama'] }}</td>
              <td>{{ $item['harga'] }}</td>
              <td>{{ $item['modal'] }}</td>
              <td>{{ $item['keuntungan'] }}</td>
              <td>{{ $item['jumlah'] }}</td>
                <td>
                  <form method="POST" action="{{url('harian/'.$item['id'])}}">
                    @csrf
                  <div class="col-md-6">
                  <input id="jumlah_produk" type="text" class="form-control @error('jumlah_produk') is-invalid @enderror" name="jumlah_produk" value="{{ old('jumlah_produk') }}" required autocomplete="jumlah_produk" autofocus>

                  @error('jumlah_produk')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    <button type="submit" class="btn btn-primary">
                        Produk Terjual
                    </button>
              </div>
            </form>
          </td>
            </tr>
            @endforeach
            </tbody>
      </table>
    </div>
  </div>

  {{ $produk->links() }}
  
</div>

@endsection