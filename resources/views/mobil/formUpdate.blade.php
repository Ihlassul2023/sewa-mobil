@extends('layout.master')

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/css/bootstrap-select.min.css" integrity="sha512-mR/b5Y7FRsKqrYZou7uysnOdCIJib/7r5QeJMFvLNHNhtye3xJp1TdJVPLtetkukFn227nKpXD9OjUc09lx97Q==" crossorigin="anonymous"
  referrerpolicy="no-referrer" />
  <style>

      .image-preview {
        margin-top: 15px;
        width: 200px;
        height: 200px;
        border: 2px dashed #ccc;
        display: flex;
        align-items: center;
        justify-content: center;
        background-size: cover;
        background-position: center;
        color: #999;
    }
  </style>
@endpush
@section('content')
<a href="/mobil" class="btn btn-danger">Kembali</a>
<div class="w-25">
<h3 class="text-center">Edit Mobil</h3>
<form action="/mobil/{{$mobil->id}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="mb-3 mt-3">
      <label for="exampleInputEmail1" class="form-label">Merek Mobil</label>
      <input type="text" name="merek" value="{{$mobil->merek}}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
    </div>
    @error('merek')
        <div class="alert alert-danger">
            {{ $message }}
        </div>
     @enderror
    <div class="mb-3 mt-3">
      <label for="exampleInputEmail1" class="form-label">Model</label>
      <input type="text" name="model" value="{{$mobil->model}}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
    </div>
    @error('model')
        <div class="alert alert-danger">
            {{ $message }}
        </div>
     @enderror
    <div class="mb-3 mt-3">
      <label for="exampleInputEmail1" class="form-label">No Plat</label>
      <input type="text" name="no_plat" value="{{$mobil->no_plat}}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
    </div>
    @error('no_plat')
        <div class="alert alert-danger">
            {{ $message }}
        </div>
     @enderror
    <div class="mb-3 mt-3">
      <label for="exampleInputEmail1" class="form-label">foto</label>
      <input type="file" name="photo" accept="image/*" class="form-control" id="exampleInputEmail1" onchange="previewImage(event)" aria-describedby="emailHelp">
      <div id="imagePreview" style="background-image: url({{Storage::url($mobil->photo)}}); background-size: cover; background-position: center;" class="image-preview">Preview</div>
    </div>
    @error('photo')
        <div class="alert alert-danger">
            {{ $message }}
        </div>
     @enderror
    <div class="mb-3 mt-3">
      <label for="exampleInputEmail1" class="form-label">Tarif per hari</label>
      <input type="number" value="{{$mobil->tarif_sewa_per_hari}}" name="tarif_sewa_per_hari" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
    </div>
    @error('tarif_sewa_per_hari')
        <div class="alert alert-danger">
            {{ $message }}
        </div>
     @enderror
    
     
    <button type="submit" class="btn btn-primary">Edit</button>
  </form>
</div>
@endsection
@push('script')
<script>
    function previewImage(event) {
            const input = event.target;
            const previewContainer = document.getElementById('imagePreview');

            if (input.files && input.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    previewContainer.style.backgroundImage = `url('${e.target.result}')`;
                    previewContainer.textContent = '';
                };

                reader.readAsDataURL(input.files[0]);
            } else {
                previewContainer.style.backgroundImage = '';
                previewContainer.textContent = 'Preview';
            }
        }
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/js/bootstrap-select.min.js" integrity="sha512-FHZVRMUW9FsXobt+ONiix6Z0tIkxvQfxtCSirkKc5Sb4TKHmqq1dZa8DphF0XqKb3ldLu/wgMa8mT6uXiLlRlw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endpush
