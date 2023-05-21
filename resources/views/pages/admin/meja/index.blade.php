@extends('layouts.admin')

@section('title')
     Meja {{$store->name}}
@endsection

@section('content')
<!-- Modal -->
<div class="modal fade" id="tambahMeja" tabindex="-1" aria-labelledby="tambahMejaLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="tambahMejaLabel">Tambah meja</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{route('store-meja.store')}}" method="post">
      @csrf
        <div class="modal-body">
            <label for="">Nomor/Nama Meja</label>
            <input type="text" class="form-control mb-3" name="nomor_meja" required>
            <input type="text" class="form-control mb-3" name="uuid_store" value="{{$store->uuid}}" hidden>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
        </div>

      </form>
    </div>
  </div>
</div>
<div class="card">
    <div class="card-body">
        <div class="row mb-3 justify-content-between">
            <div class="col-md-4">
                <div data-bs-toggle="modal" data-bs-target="#tambahMeja" href="{{route('store-meja.create')}}" class="btn btn-primary">Tambah Meja</div>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">QR COde</th>
                    <th scope="col">Nomor Meja</th>
                    <th scope="col">Status</th>
                    <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($meja as $item)
                        <tr>
                            <td>
                                <div class="showQR" >
                                    {{-- {!! QrCode::size(60)->generate(url($store->uuid."?meja=".$item->nomor_meja)); !!} --}}
                                   <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(100)->generate('Make me into an QrCode!')) !!} ">
                                </div>
                            </td>
                            <td>{{$item->nomor_meja}}</td>
                            <td>{{$item->status === 'active' ? "Active" : "In Active"}}</td>
                            <td>
                                <form action="{{route('store-meja.destroy', $item->uuid)}}" method="post" id="form_delete_{{$item->id}}">
                                    @csrf
                                    @method("DELETE")
                                </form>
                                <a href="{{route('store-meja.edit', $item->uuid)}}" class="btn btn-info btn-sm me-2 update_data">
                                    <i class="bi bi-pencil"></i>
                                </a>
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


    </script>
@endpush
