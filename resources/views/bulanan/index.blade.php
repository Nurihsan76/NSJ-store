@extends('layouts/app')

@section('content')
    
<div class="container">
  <div class="row">
    <div class="col-10">
      <h1 class="mt-3 my-3">Pemasukan Harian</h1>

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
                  <th scope="col">Tanggal</th>
                  <th scope="col">Pemasukan</th>
                  <th scope="col">Keuntungan</th>
                </tr>
            </thead>
            <tbody>
              @foreach ($bulanan as $item)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $item['tanggal'] }}</td>
              <td>{{ $item['pemasukan_hari_ini'] }}</td>
              <td>{{ $item['keuntungan_hari_ini'] }}</td>
          </tr>
              @endforeach
            </tbody>
      </table>
    </div>
  </div>
  
  {{ $bulanan->links() }}

</div>

@endsection