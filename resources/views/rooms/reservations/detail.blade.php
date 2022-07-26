@extends('app.layout')

@section('title', '予約詳細')

@section('content')
    <div>
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

        @if ($errors->any())
            <div class="mx-auto mt-4 w-3/4 bg-red-500 text-white">
                <div class="container mx-auto flex items-center justify-start px-6 py-4">
                    <div class="flex">
                        <svg viewBox="0 0 40 40" class="h-6 w-6 fill-current">
                            <path
                                d="M20 3.36667C10.8167 3.36667 3.3667 10.8167 3.3667 20C3.3667 29.1833 10.8167 36.6333 20 36.6333C29.1834 36.6333 36.6334 29.1833 36.6334 20C36.6334 10.8167 29.1834 3.36667 20 3.36667ZM19.1334 33.3333V22.9H13.3334L21.6667 6.66667V17.1H27.25L19.1334 33.3333Z">
                            </path>
                        </svg>
                    </div>
                    <div class="ml-1">
                        @foreach ($errors->all() as $error)
                            {{ $error }}<br>
                        @endforeach
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

        <section class="mx-auto mt-4 w-3/4 rounded-md bg-white p-6 shadow-md">
            <div class="flex justify-between">
                <h2 class="text-lg font-semibold capitalize text-gray-700">予約詳細</h2>

                <form action="/reservations/delete" method="post">
                    @csrf
                    <input type="hidden" name="room_id" value="{{ $reservation->roomId }}">
                    <input type="hidden" name="reservation_id" value="{{ $reservation->reservationId }}">
                    <button
                        class="transform rounded-md bg-red-700 px-6 py-2 leading-5 text-white transition-colors duration-200 hover:bg-red-600 focus:bg-red-600 focus:outline-none">削除</button>
                </form>
            </div>

            <form action="/reservations/update" method="POST">
                @csrf
                <input type="hidden" name="room_id" value="{{ $reservation->roomId }}">
                <input type="hidden" name="reservation_id" value="{{ $reservation->reservationId }}">
                <div class="mt-4">
                    <div>
                        <label class="text-gray-700" for="summary">概要</label>
                        <input
                            id="summary"
                            type="text"
                            name="summary"
                            value="{{ $reservation->summary }}"
                            class="mt-2 block w-full rounded-md border border-gray-200 bg-white px-4 py-2 text-gray-700 focus:border-blue-400 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-40">
                    </div>

                    <div class="mt-2 flex items-center">
                        <div>
                            <label class="block text-gray-700" for="start_at_date">開始日時</label>
                            <input id="start_at_date" type="date" name="start_at_date"
                                value="{{ $reservation->startAtDate }}"
                                class="mt-2 rounded-md border border-gray-200 bg-white px-4 py-2 text-gray-700 focus:border-blue-400 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-40">
                            <input id="start_at_time" type="time" name="start_at_time"
                                value="{{ $reservation->startAtTime }}"
                                class="rounded-md border border-gray-200 bg-white px-4 py-2 text-gray-700 focus:border-blue-400 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-40">
                        </div>
                        <span class="mx-4">~</span>
                        <div>
                            <label class="block text-gray-700" for="end_at_date">終了日時</label>
                            <input id="end_at_date" type="date" name="end_at_date"
                                value="{{ $reservation->endAtDate }}"
                                class="mt-2 rounded-md border border-gray-200 bg-white px-4 py-2 text-gray-700 focus:border-blue-400 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-40">
                            <input id="end_at_time" type="time" name="end_at_time"
                                value="{{ $reservation->endAtTime }}"
                                class="mt-2 rounded-md border border-gray-200 bg-white px-4 py-2 text-gray-700 focus:border-blue-400 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-40">
                        </div>
                    </div>

                    <div class="mt-2">
                        <label class="text-gray-700" for="note">備考</label>
                        <textarea id="note" rows="4" name="note"
                            class="mt-2 block w-full rounded-md border border-gray-200 bg-white px-4 py-2 text-gray-700 focus:border-blue-400 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-40">{{ $reservation->note }}</textarea>
                    </div>
                </div>

                <div class="mt-6 flex justify-end">
                    <button
                        class="transform rounded-md bg-gray-700 px-6 py-2 leading-5 text-white transition-colors duration-200 hover:bg-gray-600 focus:bg-gray-600 focus:outline-none">更新</button>
                </div>
            </form>
        </section>

        <div class="mx-auto mt-5 w-3/4">
            <a href="{{ $reservation->roomUrl }}" class="text-blue-500 no-underline hover:underline">戻る</a>
        </div>
    </div>
@endsection
