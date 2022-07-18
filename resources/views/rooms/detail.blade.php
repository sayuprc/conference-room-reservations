@extends('app.layout')

@section('title', '会議室詳細')

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

    <div class="mx-auto w-3/4">
        <div class="flex">
            <div class="bg-white dark:bg-gray-800">
                <div>
                    <p class="text-2xl font-bold text-gray-700 dark:text-white"> {{ $room->name }}</p>
                </div>
            </div>

            <div class="ml-6">
                <form action="/reservations/register" method="GET">
                    <input type="hidden" name="room_id" value="{{ $room->id }}">
                    <button type="submit"
                        class="rounded-lg bg-blue-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">予約登録</button>
                </form>
            </div>
        </div>

        <div>
            @foreach ($room->reservations as $day => $reservations)
                <div class="mt-8">
                    <h3 class="text-xl font-bold text-gray-700">{{ $day }}</h3>
                    <div class="grid grid-cols-3 gap-4">
                        @foreach ($reservations as $reservation)
                            <div class="rounded px-6 py-4 shadow-lg">
                                <div class="mb-2 font-bold">{{ $reservation->summary }}</div>
                                <div class="mb-2 text-base text-gray-700">{{ $reservation->startAt }} ~
                                    {{ $reservation->endAt }}</div>
                                {{-- ViewModelでエスケープ済みなので、HTMLタグエスケープはしない --}}
                                <p class="text-base text-gray-700">{!! $reservation->note !!} </p>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
