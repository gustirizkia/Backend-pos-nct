<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    @livewireStyles

    <!-- Scripts -->
    <link rel="stylesheet" href="/css/app.css">
    <script src="/js/app.js" defer></script>
</head>
<body class="dark:bg-gray-900 bg-gray-100">



@include('includes.sidebar')

<div class=" sm:ml-64 ">
        {{-- navbar --}}
        @include('includes.navbar')

    {{-- main content --}}
    <div class="p-4">
        @yield('content')
    </div>
    {{-- main content end --}}

    {{-- bottom bar --}}
    <div class="hidden ">
        <div class="fixed bottom-0 md:right-12 px-6 py-3 z-40 w-full md:w-1/3 overflow-y-auto h-[90%] scrollbar scrollbar-thumb-slate-600 dark:scrollbar-thumb-white scrollbar-w-1 scrollbar-track-rounded-lg scrollbar-track-transparent  bg-white dark:bg-gray-900 shadow dark:text-gray-300  dark:border-gray-700 border-2  border-b-0 rounded-tl-xl ">
            <div class="flex justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                </svg>
            </div>
            <div class="font-medium text-xl mb-4">
                List Order
            </div>
            @for ($i = 1; $i < 10; $i++)
                <div class="my-3 bg-gray-50 dark:bg-gray-800 dark:text-gray-100  rounded-xl  relative border dark:border-0">
                    <div class="flex items-center p-4 relative">
                        <img src="https://images.unsplash.com/photo-1568901346375-23c9450c58cd?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=999&q=80"
                            alt="" class="w-24 rounded-xl">
                            <div class="ml-4">
                                <div class="font-semibold">Burger Kill</div>
                                <div class="">Qty 3</div>
                                <div class="text-sm font-light">Notes : Lorem ipsum dolor sit amet.</div>
                            </div>
                            <div id="time_remaining" class="text-gray-600 dark:text-gray-200 absolute top-0 right-0 p-4 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span class="ml-1">12:00:00</span>
                            </div>
                    </div>
                    <div class="">
                        <hr>
                        <div class="p-4 grid grid-flow-row grid-cols-2 gap-4">
                            <div class="bg-yellow-400 border-2 border-yellow-400 cursor-pointer w-full text-center py-2 rounded-lg text-sm font-medium">Done</div>
                            <div class="border-2 border-red-600 text-red-600 w-full text-center cursor-pointer py-2 rounded-lg text-sm font-medium ">Remove</div>
                        </div>
                    </div>
                    <div class="border bg-yellow-400 dark:bg-gray-700 text-white dark:text-gray-300 leading-none flex justify-center items-center h-6 w-6 rounded-full absolute text-sm font-bold -top-2 -left-2">
                        {{ $i }}
                    </div>
                </div>
            @endfor
        </div>
    </div>
</div>

    @livewireScripts

    <script>
        // On page load or when changing themes, best to add inline in `head` to avoid FOUC
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark')
        }

        var themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
        var themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');

        // Change the icons inside the button based on previous settings
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            themeToggleLightIcon.classList.remove('hidden');
        } else {
            themeToggleDarkIcon.classList.remove('hidden');
        }

        var themeToggleBtn = document.getElementById('theme-toggle');

        themeToggleBtn.addEventListener('click', function() {

    // toggle icons inside button
    themeToggleDarkIcon.classList.toggle('hidden');
    themeToggleLightIcon.classList.toggle('hidden');

    // if set via local storage previously
    if (localStorage.getItem('color-theme')) {
            if (localStorage.getItem('color-theme') === 'light') {
                document.documentElement.classList.add('dark');
                localStorage.setItem('color-theme', 'dark');
            } else {
                document.documentElement.classList.remove('dark');
                localStorage.setItem('color-theme', 'light');
            }

        // if NOT set via local storage previously
        } else {
            if (document.documentElement.classList.contains('dark')) {
                document.documentElement.classList.remove('dark');
                localStorage.setItem('color-theme', 'light');
            } else {
                document.documentElement.classList.add('dark');
                localStorage.setItem('color-theme', 'dark');
            }
        }

    });
    </script>
</body>
</html>
