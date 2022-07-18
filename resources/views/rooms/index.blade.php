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

    @if (session('exception'))
        <div class="mx-auto mt-4 w-3/4 bg-red-500 text-white">
            <div class="container mx-auto flex items-center justify-start px-6 py-4">
                <div class="flex">
                    <svg viewBox="0 0 40 40" class="h-6 w-6 fill-current">
                        <path
                            d="M20 3.36667C10.8167 3.36667 3.3667 10.8167 3.3667 20C3.3667 29.1833 10.8167 36.6333 20 36.6333C29.1834 36.6333 36.6334 29.1833 36.6334 20C36.6334 10.8167 29.1834 3.36667 20 3.36667ZM19.1334 33.3333V22.9H13.3334L21.6667 6.66667V17.1H27.25L19.1334 33.3333Z">
                        </path>
                    </svg>
                </div>
                <div class="ml-1">{{ session('exception') }}</div>
            </div>
        </div>
    @endif

    @if (!empty($rooms))
        <div class="mx-auto grid w-3/4 grid-cols-2 justify-center gap-4">
            @foreach ($rooms as $room)
                <div class="rounded-lg bg-white px-8 py-4 shadow-md dark:bg-gray-800">
                    <div class="mt-2">
                        <a href="{{ $room->detailUrl }}"
                            class="text-2xl font-bold text-gray-700 hover:text-gray-600 hover:underline dark:text-white dark:hover:text-gray-200">{{ $room->name }}</a>
                    </div>

                    <div class="mt-4">
                        <a href="{{ $room->detailUrl }}"
                            class="text-blue-600 hover:underline dark:text-blue-400">もっと見る</a>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <h2 class="mx-auto w-3/4">会議室がありません。</h2>
    @endif
@endsection
