@extends('layouts.admin')

@section('title')
    Tambah Store
@endsection

@section('content')
<div class="card">
    <div class="card-body">
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
        <form action="{{route('store.store')}}" method="post" enctype="multipart/form-data">
        @csrf
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="">Nama</label>
                    <input type="text" class="form-control mt-2" name="name" required value="{{old('name')}}">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="">Image</label>
                    <input type="file" class="form-control mt-2" name="image" required>
                    <small class="text-secondary">Max 4mb</small>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="">Status</label>
                    <select name="status"  class="form-select">
                        <option value="active">Active</option>
                        <option value="inactive">In active</option>
                    </select>
                </div>
                <div class="col-12">
                    <button class="btn btn-primary" type="submit">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
