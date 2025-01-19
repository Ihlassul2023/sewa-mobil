@extends('layout.master')
@section('content')
@section('judul')
<h3>Daftar Mobil Sewa</h3>
@endsection
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
            <form action="/listMobil" method="GET" class="mb-4">
                <div class="input-group">
                    <input 
                        type="text" 
                        name="search" 
                        class="form-control mr-4" 
                        placeholder="Cari berdasarkan merek, no plat, atau model" 
                        value="{{ request('search') }}" 
                    />
                    <button type="submit" class="btn btn-primary">Cari</button>
                </div>
            </form>
        </div>
        <div class="row">
            <div class="col-12 col-md-4">
                @forelse ($mobils as $mobil )
                <div class="card" style="width: 18rem;">
                    <img src="{{Storage::url($mobil->photo)}}" class="card-img-top" alt="film">
                    <div class="card-body">
                      <h5 class="card-title">{{$mobil->merek}}</h5>
                      <p class="card-text">Model: {{$mobil->model}}</p>
                      <p class="card-text">Tarif/hari: Rp. {{number_format($mobil->tarif_sewa_per_hari, 2, ',', '.');}}</p>
                      @if ($mobil->status)
                      <span class="badge badge-danger">Disewa</span>
                      @else
                      <span class="badge badge-success">Tersedia</span>
                      @endif
                      <a href="/sewaMobil/{{$mobil->id}}" class="btn btn-primary">Sewa mobil</a>
                    </div>
                  </div>
                @empty
                    <h3>Tidak ada mobil</h3>
                @endforelse
            </div>
        </div>
    </div>
@endsection