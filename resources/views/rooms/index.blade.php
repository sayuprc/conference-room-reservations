@extends('app.layout')

@section('title', '会議室一覧')

@section('content')
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
