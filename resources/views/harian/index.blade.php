@extends('layouts/app')

@section('content')
    
<div class="container">
  <div class="row">
    <div class="col-10">
      <h1 class="mt-3 my-3">Riwayat Pemasukan</h1>

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
                  <th scope="col">Tanggal Masuk</th>
                  <th scope="col">Tanggal Ubah</th>
                  <th scope="col">Untuk Tanggal</th>
                  <th scope="col">Nama</th>
                  <th scope="col">Jumlah Produk</th>
                  <th scope="col">Jumlah Harga Produk</th>
                  <th scope="col">Jumlah Keuntangan</th>
                  <th scope="col">Ubah</th>
                  <th scope="col">Hapus</th>
                </tr>
            </thead>
            <tbody>
              @foreach ($harian as $item)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $item['created_at'] }}</td>
                    <td>{{ $item['updated_at'] }}</td>
                    <td>{{ $item->riwayat_bulanan->tanggal}}</td>
                    <td>{{ $item->produk->nama }}</td>
              <td>{{ $item['jumlah_produk'] }}</td>
              <td>{{ $item['jumlah_harga_produk'] }}</td>
              <td>{{ $item['jumlah_keuntungan'] }}</td>
              <td>
              <a href="{{url('produk/'.$item['id'].'/edit')}}" class="btn btn-success float-left">Ubah</a>
            </td>
            <td>
              <form method="post" action="{{'produk/'.$item['id']}}">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger float-left" onclick="return confirm('yakin?')">Hapus</button>
              </form>
            </td>
          </tr>
              @endforeach
            </tbody>
      </table>
    </div>
  </div>

  {{ $harian->links() }}
  
</div>

@endsection