@extends('layout.master')
@section('judul')
<h3>Mobil Sewa Saya</h3>
@endsection
@section('content')
@push('styles')
<style>
.alert {
    padding: 15px;
    margin: 10px 0;
    border-radius: 4px;
}

.alert-danger {
    background-color: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
  }
  .badge {
    display: inline-block;
    padding: 5px 10px;
    font-size: 12px;
    font-weight: bold;
    text-align: center;
    border-radius: 5px;
    color: white;
}

.badge-danger {
    background-color: #dc3545; /* Warna merah untuk "Disewa" */
}

.badge-success {
    background-color: #28a745; /* Warna hijau untuk "Tersedia" */
}

</style>
@endpush
@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-4">
                @forelse ($peminjamans as $peminjaman )
                <div class="card" style="width: 18rem;">
                    <img src="{{Storage::url($peminjaman->mobil->photo)}}" class="card-img-top" alt="film">
                    <div class="card-body">
                      <h5 class="card-title">{{$peminjaman->mobil->merek}}</h5>
                      <p class="card-text">Model: {{$peminjaman->mobil->model}}</p>
                      <p class="card-text">No Plat: {{$peminjaman->mobil->no_plat}}</p>
                      <p class="card-text">Tanggal Mulai:  {{$peminjaman->tanggal_mulai}}</p>
                      @if ($peminjaman->pengembalian)
                      <p class="card-text">Tanggal Selesai:  {{$peminjaman->pengembalian->tanggal_pengembalian}}</p>
                      <p class="card-text">Total: Rp. {{number_format($peminjaman->pengembalian->total_biaya, 2, ',', '.');}}</p>
                      @else
                      <p class="card-text">Tanggal Selesai:  {{$peminjaman->tanggal_selesai}}</p>
                      <p class="card-text">Total: Rp. {{number_format($peminjaman->total_harga, 2, ',', '.');}}</p>
                      @endif
                      @if ($peminjaman->status)
                      <span class="badge badge-danger">telah dikembalikan</span>
                      @else
                      <span class="badge badge-success">Dipinjam</span>
                      @endif
                      @if (!$peminjaman->pengembalian)
                      <a href="/kembalikanMobil/{{$peminjaman->id}}" class="btn btn-primary">Kembalikan Mobil</a>
                     @endif
                    </div>
                  </div>
                @empty
                    <h3>Tidak ada mobil</h3>
                @endforelse
            </div>
        </div>
    </div>
@endsection