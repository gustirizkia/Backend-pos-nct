@extends('layouts.admin')

@section('title')
    Tambah Produk
@endsection

@section('content')

{{-- tambah Kategori  --}}
<div class="modal fade" id="tambahKategori" tabindex="-1" aria-labelledby="tambahKategoriLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="tambahKategoriLabel">Tambah Kategori</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{route('createKategoriProduk')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
          <label for="">Nama Kategori</label>
          <input type="text" class="form-control mb-3" name="name" required>
          <input type="text" class="form-control mb-3" name="vendor_uuid" hidden value="{{$vendor->uuid}}">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>

      </form>
    </div>
  </div>
</div>
{{-- tambah Kategori end --}}

<div class="card">
    <div class="card-body">
        <div data-bs-toggle="modal" data-bs-target="#tambahKategori" href="{{route('store-meja.create')}}" class="btn btn-warning me-3">Tambah Kategori</div>
        <div class="mb-3">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
        <form action="{{route('admin-produk.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
          <label for="">Nama</label>
          <input type="text" class="form-control mb-3" name="nama" required {{old('name')}}>

          <div class="mb-3">
              <label for="">Price</label>
              <input type="number" class="form-control price" name="price" required {{old('number')}}>
              <small>Rp. <span id="idr"></span></small>
          </div>
          <div class="mb-3">
            <input type="file" class="form-control" name="image">
            <small>Max 4mb</small>
          </div>
          <div class="mb-3">
            <label for="">Pilih Kategori</label>
            <select name="kategori_id" id="" class="form-select">
                @forelse ($kategori as $item)
                    <option value="{{$item->id}}">{{$item->name}}</option>
                @empty
                    <option value="">No Kategori</option>
                @endforelse

            </select>
          </div>
          <div class="mb-3">
            <label for="">Deskripsi Produk</label>
            <textarea name="deskripsi" id=""  rows="4" class="form-control">{{old('deskripsi')}}</textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>

      </form>
    </div>
</div>
@endsection

@push('addScript')
    <script>
        $(".price").on("input", function(){
            let value = parseInt($(".price").val());
            if(value){
                $("small #idr").text(value.toLocaleString())
            }else{
                $("small #idr").text(0)
            }
        });
    </script>
@endpush
