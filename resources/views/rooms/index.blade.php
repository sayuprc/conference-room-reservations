@extends('app.layout')

@section('title', '会議室一覧')

@section('content')
    @if (session('message'))
        <div class="mx-auto my-4 w-3/4 bg-emerald-500 text-white">
            <div class="container mx-auto flex items-center justify-between px-6 py-4">
                <div class="flex">
                    <svg viewBox="0 0 40 40" class="h-6 w-6 fill-current">
                        <path
                            d="M20 3.33331C10.8 3.33331 3.33337 10.8 3.33337 20C3.33337 29.2 10.8 36.6666 20 36.6666C29.2 36.6666 36.6667 29.2 36.6667 20C36.6667 10.8 29.2 3.33331 20 3.33331ZM16.6667 28.3333L8.33337 20L10.6834 17.65L16.6667 23.6166L29.3167 10.9666L31.6667 13.3333L16.6667 28.3333Z">
                        </path>
                    </svg>

                    <p class="mx-3">{{ session('message') }}</p>
                </div>
            </div>
        </div>
    @endif

    @if (!empty($rooms))
        <div class="mx-auto grid w-3/4 grid-cols-2 justify-center gap-4">
            @foreach ($rooms as $room)
                <div class="rounded-lg bg-white px-8 py-4 shadow-md dark:bg-gray-800">
                    <div class="mt-2">
                        <a href="#"
                            class="text-2xl font-bold text-gray-700 hover:text-gray-600 hover:underline dark:text-white dark:hover:text-gray-200">{{ $room->name }}</a>
                    </div>

                    <div class="mt-4">
                        <a href="#" class="text-blue-600 hover:underline dark:text-blue-400">もっと見る</a>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <h2>会議室がありません。</h2>
    @endif
@endsection
