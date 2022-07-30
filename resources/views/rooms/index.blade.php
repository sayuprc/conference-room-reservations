@extends('app.layout')

@section('title', '会議室一覧')

@section('content')
    @if (!empty($rooms))
        <div class="grid grid-cols-3 justify-center gap-4">
            @foreach ($rooms as $room)
                <div class="bg-aqua-haze border-geyser dark:bg-outer-space dark:border-mako rounded-md border p-4">
                    <a class="hover:text-science-blue text-xl hover:underline"
                        href="{{ $room->detailUrl }}">{{ $room->name }}</a>
                </div>
            @endforeach
        </div>
    @else
        <h2 class="text-xl">会議室がありません。</h2>
    @endif
@endsection
