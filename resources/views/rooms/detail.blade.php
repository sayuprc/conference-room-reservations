@extends('app.layout')

@section('title', '会議室詳細')

@section('content')
    <div class="mx-auto w-3/4">
        <div class="bg-white px-8 py-4 dark:bg-gray-800">
            <div class="mt-2">
                <a
                    class="text-2xl font-bold text-gray-700 hover:text-gray-600 hover:underline dark:text-white dark:hover:text-gray-200">{{ $room->name }}</a>
            </div>
        </div>
    </div>
@endsection
