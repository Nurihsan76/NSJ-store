@extends('layouts/app')

@section('content')
    
<div class="container">
  <div class="row">
    <div class="col-10">
      <h1 class="mt-3">Daftar Produk</h1>

      <a href="/produk/tambah" class="btn btn-primary my-3">Tambah Produk</a>
      
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
                  <th scope="col">Jumlah</th>
                  <th scope="col">Keuntangan</th>
                  <th scope="col">Terrjual</th>
                  <th scope="col">Ubah</th>
                  <th scope="col">Hapus</th>
                </tr>
            </thead>
            <tbody>
              @foreach ($produk as $item)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
              <td>{{ $item['nama'] }}</td>
              <td>{{ $item['harga'] }}</td>
              <td>{{ $item['modal'] }}</td>
              <td>{{ $item['jumlah'] }}</td>
              <td>{{ $item['keuntungan'] }}</td>
                <td> <a href="{{url('harian/'.$item['id'])}}" class="btn btn-info float-left">Terjual</a> </td>
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

  {{ $produk->links() }}
  
</div>

@endsection