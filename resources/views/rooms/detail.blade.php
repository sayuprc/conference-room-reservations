@extends('app.layout')

@section('title', '会議室詳細')

@section('content')
    <div class="flex justify-between">
        <h2 class="my-auto text-xl font-bold">{{ $room->name }}</h2>
        <form action="/reservations/register" method="GET">
            <input name="room_id" type="hidden" value="{{ $room->id }}">
            <button
                class="border-curious-blue hover:border-denim hover:bg-science-blue bg-dodger-blue dark:border-goblin-100 dark:bg-goblin-200 dark:hover:bg-fruit-salad rounded-md border py-1 px-3 text-white"
                type="submit">予約登録</button>
        </form>
    </div>

    <div class="mt-8">
        @foreach ($room->reservations as $day => $reservations)
            <div class="my-8">
                <div class="text-lg">{{ $day }}</div>
                <hr>
                <div class="my-4 grid grid-cols-3 gap-4">
                    @foreach ($reservations as $reservation)
                        <div class="bg-aqua-haze border-geyser dark:bg-outer-space dark:border-mako rounded-md border p-4">
                            <div class="mb-4 text-lg font-bold">
                                <a class="hover:text-science-blue hover:underline"
                                    href="{{ $reservation->detailUrl }}">{{ $reservation->summary }}</a>
                            </div>
                            <div>{{ $reservation->startAt }} ~ {{ $reservation->endAt }}</div>
                            {{-- ViewModelでエスケープ済みなので、HTMLタグエスケープはしない --}}
                            <p class="mt-4 text-sm">{!! $reservation->note !!} </p>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    @endsection
