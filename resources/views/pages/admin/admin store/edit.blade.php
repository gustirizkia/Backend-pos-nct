@extends('layouts.admin')

@section('title')
    Tambah Admin Store
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
        <form action="{{route('admin-store.update', $item->id)}}" method="post">
        @csrf
        @method("PUT")
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="">Nama</label>
                    <input type="text" class="form-control mt-2" name="name" required value="{{$item->user->name}}">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="">Email</label>
                    <input type="email" class="form-control mt-2" name="email" required value="{{$item->user->email}}">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="">Password</label>
                    <input type="password" class="form-control mt-2" name="password">
                    <small><i>kosongkan jika tidak ingin ganti</i></small>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="">Konfirmasi Password</label>
                    <input type="password" class="form-control mt-2" name="password_confirmation">
                    <small><i>kosongkan jika tidak ingin ganti</i></small>
                </div>
                <div class="col-md-12 mb-3">
                    <label for="">Store</label>
                    <select name="store_uuid" id="" class="form-select mt-2">
                        @foreach ($stores as $store)
                            <option value="{{$store->uuid}}" {{$item->store->uuid === $store->uuid ? 'selected' : ''}}>{{$store->name}}</option>
                        @endforeach
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
