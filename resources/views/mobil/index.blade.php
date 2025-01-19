@extends('layout.master')
@section('judul')
 <h3>Mobil Saya</h3>
@endsection
@section('content')
<a href="/mobil/create" class="btn btn-primary mr-3 mb-3">Tambah Mobil</a>
    <div class="container">
        <div class="row">
            <form action="/mobil" method="GET" class="mb-4">
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
                      {{-- <a href="/mobil/{{$mobil->id}}" class="btn btn-primary">Detail</a> --}}
                      <a href="/mobil/{{$mobil->id}}/edit" class="btn btn-warning">Edit</a>
                      <form action="/mobil/{{$mobil->id}}" method="POST" onsubmit="return confirm('are you sure delete data?')" >
                        @csrf
                        @method('DELETE')
                        <input type="submit" class="btn btn-danger my-1" value="Delete">
                    </form>
                    </div>
                  </div>
                @empty
                    <h3>Tidak ada mobil</h3>
                @endforelse
            </div>
        </div>
    </div>
@endsection