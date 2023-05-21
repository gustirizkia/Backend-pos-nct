@extends('layouts.admin')

@section('title')
    Admin Store
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row mb-3 justify-content-between">
            <div class="col-md-4">
                <a href="{{route('admin-store.create')}}" class="btn btn-primary">Tambah Admin</a>
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
                    <th scope="col">Store</th>
                    <th scope="col">Nama Admin</th>
                    <th scope="col">Email</th>
                    <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($admins as $admin)
                        <tr>
                            <td>{{$admin->store->name}}</td>
                            <td>{{$admin->user->name}}</td>
                            <td>{{$admin->user->email}}</td>
                            <td>
                                <form action="{{route('admin-store.destroy', $admin->id)}}" method="post" id="form_delete_{{$admin->id}}">
                                    @csrf
                                    @method("DELETE")
                                </form>
                                <a href="{{route('admin-store.edit', $admin->id)}}" class="btn btn-info btn-sm me-2 update_data">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <div class="btn btn-danger btn-sm delete_data" id="{{$admin->id}}">
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
