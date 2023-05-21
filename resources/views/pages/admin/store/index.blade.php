@extends('layouts.admin')

@section('title')
     Store
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row mb-3 justify-content-between">
            <div class="col-md-4">
                <a href="{{route('store.create')}}" class="btn btn-primary">Tambah Admin</a>
            </div>
            <div class="col-md-4">
                <form action="" method="get">
                    <div class="d-flex align-items-center">
                        <input type="text" class="form-control me-2" placeholder="cari data . . ." name="search" value="{{request()->search}}">
                        <button class="btn btn-primary">
                            Cari
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">Nama</th>
                    <th scope="col">Jumlah Admin</th>
                    <th scope="col">Status</th>
                    <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($stores as $store)
                        <tr>
                            <td>{{$store->name}}</td>
                            <td>{{$store->admin_count}}</td>
                            <td>{{$store->status === 'active' ? "Active" : "In Active"}}</td>
                            <td>
                                <form action="{{route('store.destroy', $store->uuid)}}" method="post" id="form_delete_{{$store->id}}">
                                    @csrf
                                    @method("DELETE")
                                </form>
                                <a href="{{route('store.edit', $store->uuid)}}" class="btn btn-info btn-sm me-2 update_data">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <div class="btn btn-danger btn-sm delete_data" id="{{$store->id}}">
                                    <i class="bi bi-trash3"></i>
                                </div>
                                <a href="{{route('store-meja.index')}}?store_id={{$store->uuid}}" class="btn btn-success btn-sm ms-2">
                                    <i class="bi bi-columns-gap"></i>
                                </a>
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
