@extends('layout.master')
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
</style>
@endpush

@section('content')
@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
    <a href="/listMobil" class="btn btn-danger mb-3">Kembali</a>
    <div class="container">
        <div class="row">
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                  <h2 class="card-title">Merek: {{$mobil->merek}}</h2>
                  <p class="card-text">Model: {{$mobil->model}}</p>
                  <p class="card-text">Tarif/hari: Rp.{{number_format($mobil->tarif_sewa_per_hari, 2, ',', '.');}}</p>
                </div>
              </div>
        </div>
        <form action="/sewaMobil/{{$mobil->id}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <label for="tanggal_mulai">Tanggal Mulai Sewa:</label>
            <input type="date" id="tanggal_mulai" name="tanggal_mulai" onchange="hitungHarga()" required><br><br>
    
            <label for="tanggal_akhir">Tanggal Akhir Sewa:</label>
            <input type="date" id="tanggal_akhir" name="tanggal_selesai" onchange="hitungHarga()" required><br><br>
    
            <label for="total_harga">Total Harga (Rp):</label>
            <input type="number" id="total_harga" name="total_harga" readonly><br><br>
    
            <button type="submit" class="btn btn-success mb-3">Submit</button>
        </form>
    
        @if(session('success'))
            <div>{{ session('success') }}</div>
        @endif
    </div>
    @push('script')
        <script>
            function hitungHarga() {
            let tanggalMulai = document.getElementById('tanggal_mulai').value;
            let tanggalAkhir = document.getElementById('tanggal_akhir').value;
            let tarifPerHari = {{ $mobil->tarif_sewa_per_hari }}; 
            if (tanggalMulai && tanggalAkhir && tarifPerHari) {
                let tglMulai = new Date(tanggalMulai);
                let tglAkhir = new Date(tanggalAkhir);
                let selisihHari = (tglAkhir - tglMulai) / (1000 * 3600 * 24); 

                if (selisihHari >= 0) {
                    document.getElementById('total_harga').value = ((selisihHari + 1) * tarifPerHari).toLocaleString('id'); 
                } else {
                    alert("Tanggal akhir harus lebih besar dari tanggal mulai.");
                    document.getElementById('total_harga').value = "";
                }
            }
        }
        </script>
    @endpush
@endsection