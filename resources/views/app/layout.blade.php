<!DOCTYPE html>
<html class="h-full" lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>@yield('title')</title>
</head>

<body class="h-full w-full">
    <div class="flex h-full flex-col">
        <div class="bg-shark-100 h-16 shrink-0 text-white">
            <section class="mx-auto h-full w-3/4">
                @include('app.header')
            </section>
        </div>

        <div class="text-shark-100 bg-white">
            <div class="mx-auto w-3/4">
                @if (session('message'))
                    <section
                        class="bg-pattens-blue border-anakiwa mt-8 rounded-md border">
                        <div class="container mx-auto px-6 py-4">
                            <svg class="inline h-6 w-6 fill-current" viewBox="0 0 40 40">
                                <path
                                    d="M20 3.33331C10.8 3.33331 3.33337 10.8 3.33337 20C3.33337 29.2 10.8 36.6666 20 36.6666C29.2 36.6666 36.6667 29.2 36.6667 20C36.6667 10.8 29.2 3.33331 20 3.33331ZM16.6667 28.3333L8.33337 20L10.6834 17.65L16.6667 23.6166L29.3167 10.9666L31.6667 13.3333L16.6667 28.3333Z">
                                </path>
                            </svg>
                            {{ session('message') }}
                        </div>
                    </section>
                @endif

                @if (session('exception'))
                    <section
                        class="border-flax bg-lemon-chiffon mt-8 rounded-md border">
                        <div class="container mx-auto px-6 py-4">
                            <svg class="inline h-6 w-6 fill-current" viewBox="0 0 40 40">
                                <path
                                    d="M20 3.36667C10.8167 3.36667 3.3667 10.8167 3.3667 20C3.3667 29.1833 10.8167 36.6333 20 36.6333C29.1834 36.6333 36.6334 29.1833 36.6334 20C36.6334 10.8167 29.1834 3.36667 20 3.36667ZM19.1334 33.3333V22.9H13.3334L21.6667 6.66667V17.1H27.25L19.1334 33.3333Z">
                                </path>
                            </svg>
                            {{ session('exception') }}
                        </div>
                    </section>
                @endif

                @if ($errors->any())
                    <section
                        class="border-flax bg-lemon-chiffon mt-8 rounded-md border">
                        <div class="container mx-auto px-6 py-4">
                            <svg class="inline h-6 w-6 fill-current" viewBox="0 0 40 40">
                                <path
                                    d="M20 3.36667C10.8167 3.36667 3.3667 10.8167 3.3667 20C3.3667 29.1833 10.8167 36.6333 20 36.6333C29.1834 36.6333 36.6334 29.1833 36.6334 20C36.6334 10.8167 29.1834 3.36667 20 3.36667ZM19.1334 33.3333V22.9H13.3334L21.6667 6.66667V17.1H27.25L19.1334 33.3333Z">
                                </path>
                            </svg>
                            @foreach ($errors->all() as $error)
                                {{ $error }}<br>
                            @endforeach
                        </div>
                    </section>
                @endif

                <section class="my-8">
                    @yield('content')
                </section>
            </div>
        </div>
    </div>

    <script>
        (function() {
            const theme = localStorage.getItem('theme');
            if (theme === 'dark') {
                document.documentElement.classList.add('dark');
                localStorage.setItem('theme', 'dark');
                document.getElementById('theme-toggle-light-icon').classList.remove('hidden');
                document.getElementById('theme-toggle-dark-icon').classList.add('hidden');
            } else {
                document.documentElement.classList.remove('dark');
                localStorage.setItem('theme', 'light');
                document.getElementById('theme-toggle-light-icon').classList.add('hidden');
                document.getElementById('theme-toggle-dark-icon').classList.remove('hidden');
            }
        })();
    </script>
</body>

</html>
