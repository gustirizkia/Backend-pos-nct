@extends('layouts.admin')

@section('title')
     Admin Produk
@endsection

@push('addStyle')
    <style>
        .img__produk{
            width: 66px;
            height: auto;
            border-radius: 4px;
        }
    </style>
@endpush

@section('content')

{{-- tambah produk  --}}
<div class="modal fade" id="tambahProduk" tabindex="-1" aria-labelledby="tambahProdukLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="tambahProdukLabel">Tambah Produk</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{route('admin-produk.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
          <label for="">Nama</label>
          <input type="text" class="form-control mb-3" name="nama" required>

          <div class="mb-3">
              <label for="">Price</label>
              <input type="number" class="form-control price" name="price" required>
              <small>Rp. <span id="idr"></span></small>
          </div>
          <div class="mb-3">
            <input type="file" class="form-control" name="image">
            <small>Max 4mb</small>
          </div>
          <div class="">
            <label for="">Pilih Kategori</label>
            <select name="kategori_id" id="" class="form-select">
                @forelse ($kategori as $item)
                    <option value="{{$item->id}}">{{$item->name}}</option>
                @empty
                    <option value="">No Kategori</option>
                @endforelse

            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>

      </form>
    </div>
  </div>
</div>
{{-- tambah produk end --}}

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
        <div class="row mb-3 justify-content-between">
            <div class="col-md-6">
                <div data-bs-toggle="modal" data-bs-target="#tambahKategori" href="{{route('store-meja.create')}}" class="btn btn-warning me-3">Tambah Kategori</div>
                <div  data-bs-toggle="modal" data-bs-target="#tambahProduk" href="{{route('store-meja.create')}}" class="btn btn-primary">Tambah Produk</div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">Image</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Kategori</th>
                    <th scope="col">Price</th>
                    <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($produk as $item)
                        <tr>
                            <td>
                                <img src="{{$item->image}}" class="img-fluid img__produk" alt="">
                            </td>
                            <td>
                                {{$item->nama}}
                            </td>
                            <td>{{$item->kategori->name}}</td>
                            <td>Rp {{number_format($item->price)}}</td>
                            <td>
                                <form action="{{route('admin-produk.destroy', $item->uuid)}}" method="post" id="form_delete_{{$item->id}}">
                                    @csrf
                                    @method("DELETE")
                                </form>
                                <div onclick="handleUpdateData({{$item}})" class="btn btn-info btn-sm me-2 update_data">
                                    <i class="bi bi-pencil"></i>
                                </div>
                                <div class="btn btn-danger btn-sm delete_data" id="{{$item->id}}">
                                    <i class="bi bi-trash3"></i>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8">
                                <div class="text-center h5">Data Empty</div>
                            </td>
                        </tr>
                    @endforelse

                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="modalDownloadQR" tabindex="-1" aria-labelledby="modalDownloadQRLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="modalDownloadQRLabel">Download QR Code</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-center">
        <a href="" download="" class="tag_download">
            <img src="" alt="" class="img-fluid" id="download_qr">
            <p class="mt-2">Klik untuk simpan QR Code</p>
        </a>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="button_download">Download</button>
      </div>
    </div>
  </div>
</div>


@endsection

@push('addScript')
    <script>
        $(".delete_data").on("click", function(){
            let data_id = $(this).attr('id');

            Swal.fire({
                title: 'Konfirmasi untuk hapus data',
                icon: 'warning',
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Hapus'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Swal.fire(
                    // 'Deleted!',
                    // 'Your file has been deleted.',
                    // 'success'
                    // )
                    $("#form_delete_"+data_id).submit();
                }
            })

        });

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
