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
                  <h2 class="card-title">Merek: {{$peminjaman->mobil->merek}}</h2>
                  <p class="card-text">Model: {{$peminjaman->mobil->model}}</p>
                  <p class="card-text">Tanggal Mulai: {{$peminjaman->tanggal_mulai}}</p>
                  <p class="card-text">Tanggal Selesai: {{$peminjaman->tanggal_selesai}}</p>
                  <p class="card-text">Tarif/hari: Rp.{{number_format($peminjaman->mobil->tarif_sewa_per_hari, 2, ',', '.');}}</p>
                  <p class="card-text">Total Sebelum: Rp.{{number_format($peminjaman->total_harga, 2, ',', '.');}}</p>
                </div>
              </div>
        </div>
        <form action="/kembalikanMobil/{{$peminjaman->mobil->id}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <label for="tanggal_mulai">Tanggal Pengembalian:</label>
            <input type="date" id="tanggal_kembali" name="tanggal_pengembalian" onchange="hitungHarga()" required><br><br>
    
    
            <label for="total_harga">Total Harga (Rp):</label>
            <input type="number" id="total_harga" name="total_harga" readonly><br><br>
            <label for="total_hari">Total Hari (Rp):</label>
            <input type="number" id="total_hari" name="total_hari" readonly><br><br>
    
            <button type="submit" class="btn btn-success mb-3">Submit</button>
        </form>
    
        @if(session('success'))
            <div>{{ session('success') }}</div>
        @endif
    </div>
    @push('script')
        <script>
           function hitungHarga() {
    let tanggalKembali = document.getElementById('tanggal_kembali').value;
    let tanggalAkhir = "{{ $peminjaman->tanggal_selesai }}"; 
    let tanggalMulai = "{{ $peminjaman->tanggal_mulai }}"; 
    let tarifPerHari = {{ $peminjaman->mobil->tarif_sewa_per_hari }};
    let totalSebelumnya = {{ $peminjaman->total_harga }};

    if (tanggalKembali && tanggalAkhir && tarifPerHari) {
        let tglKembali = new Date(tanggalKembali);
        let tglAkhir = new Date(tanggalAkhir);
        let tglMulai = new Date(tanggalMulai)
        let selisihHari = (tglKembali - tglAkhir) / (1000 * 3600 * 24); 
        let totalSelisih = (tglKembali-tglMulai) / (1000*3600*24)

        if (selisihHari >= 0) {
           
            let totalHargaBaru = ((selisihHari + 1) * tarifPerHari)+totalSebelumnya
            document.getElementById('total_hari').value=totalSelisih
            document.getElementById('total_harga').value = totalHargaBaru.toLocaleString('id')
        } else {
            document.getElementById('total_hari').value=totalSelisih
            document.getElementById('total_harga').value = totalSebelumnya.toLocaleString('id')
        }
    }
}

        </script>
    @endpush
@endsection