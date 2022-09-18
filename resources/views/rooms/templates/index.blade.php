@extends('app.layout')

@section('title', '予約テンプレート一覧')

@section('content')
    @if (!empty($templates))
        <div class="grid grid-cols-3 justify-center gap-4">
            @foreach ($templates as $template)
                {{-- <div class="bg-aqua-haze border-geyser dark:bg-outer-space dark:border-mako rounded-md border p-4">
                    <a class="hover:text-science-blue text-xl hover:underline" href="{{ $room->detailUrl }}">{{ $room->name }}</a>
                </div> --}}
                <div class="bg-aqua-haze border-geyser dark:bg-outer-space dark:border-mako rounded-md border p-4">
                    <div class="mb-4 text-lg font-bold">{{ $template->summary }}</div>
                    <div>{{ $template->startAt }} ~ {{ $template->endAt }}</div>
                    {{-- ViewModelでエスケープ済みなので、HTMLタグエスケープはしない --}}
                    <p class="mt-4 text-sm">{!! $template->note !!} </p>
                </div>
            @endforeach
        </div>
    @else
        <h2 class="text-xl">予約テンプレートがありません。</h2>
    @endif
@endsection
