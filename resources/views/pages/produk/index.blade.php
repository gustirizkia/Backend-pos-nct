@extends('layouts.dashboard')

@section('content')
    <div class="grid grid-flow-row grid-cols-12 gap-6">
        <div class="col-span-12 flex overflow-x-auto">
            <div class="card py-3 px-5 active">Semua</div>
            @foreach ($kategori as $item)
                <div class="card py-3 px-5 ml-4">{{ $item->nama }}</div>
            @endforeach
        </div>
        @foreach ($produk as $item)
            <div class="col-span-3">
                <div class="card p-4">
                    <img src="{{ $item->image }}" alt="" class="mb-4 rounded-xl">
                    <div class="text-xl font-medium mb-2">{{ $item->nama }}</div>
                    <div class="flex justify-between items-center">
                        <div class="flex items-center ">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="ml-2">
                                {{ $item->menit }} menit
                            </div>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" value="" class="sr-only peer" {{ $item->status === 'ready' ? 'checked ' : '' }}>
                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                            <span class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-300">Ready</span>
                        </label>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
