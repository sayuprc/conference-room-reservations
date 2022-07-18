@extends('app.layout')

@section('title', '予約詳細')

@section('content')
    <div>
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

        <section class="mx-auto mt-4 w-3/4 rounded-md bg-white p-6 shadow-md dark:bg-gray-800">
            <h2 class="text-lg font-semibold capitalize text-gray-700 dark:text-white">予約詳細</h2>

            {{-- 更新機能作るのでいったんこのままにしておく --}}
            <form action="" method="POST">
                @csrf
                <div class="mt-4">
                    <div>
                        <label class="text-gray-700 dark:text-gray-200" for="summary">概要</label>
                        <input
                            id="summary"
                            type="text"
                            name="summary"
                            value="{{ $reservation->summary }}"
                            class="mt-2 block w-full rounded-md border border-gray-200 bg-white px-4 py-2 text-gray-700 focus:border-blue-400 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-40 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300 dark:focus:border-blue-300">
                    </div>

                    <div class="mt-2 flex items-center">
                        <div>
                            <label class="block text-gray-700 dark:text-gray-200" for="start_at_date">開始日時</label>
                            <input id="start_at_date" type="date" name="start_at_date"
                                value="{{ $reservation->startAtDate }}"
                                class="mt-2 rounded-md border border-gray-200 bg-white px-4 py-2 text-gray-700 focus:border-blue-400 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-40 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300 dark:focus:border-blue-300">
                            <input id="start_at_time" type="time" name="start_at_time"
                                value="{{ $reservation->startAtTime }}"
                                class="rounded-md border border-gray-200 bg-white px-4 py-2 text-gray-700 focus:border-blue-400 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-40 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300 dark:focus:border-blue-300">
                        </div>
                        <span class="mx-4">~</span>
                        <div>
                            <label class="block text-gray-700 dark:text-gray-200" for="end_at_date">終了日時</label>
                            <input id="end_at_date" type="date" name="end_at_date"
                                value="{{ $reservation->endAtDate }}"
                                class="mt-2 rounded-md border border-gray-200 bg-white px-4 py-2 text-gray-700 focus:border-blue-400 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-40 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300 dark:focus:border-blue-300">
                            <input id="end_at_time" type="time" name="end_at_time"
                                value="{{ $reservation->endAtTime }}"
                                class="mt-2 rounded-md border border-gray-200 bg-white px-4 py-2 text-gray-700 focus:border-blue-400 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-40 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300 dark:focus:border-blue-300">
                        </div>
                    </div>

                    <div class="mt-2">
                        <label class="text-gray-700 dark:text-gray-200" for="note">備考</label>
                        <textarea id="note" rows="4" name="note"
                            class="mt-2 block w-full rounded-md border border-gray-200 bg-white px-4 py-2 text-gray-700 focus:border-blue-400 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-40 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300 dark:focus:border-blue-300">{{ $reservation->note }}</textarea>
                    </div>
                </div>
            </form>
        </section>

        <div class="mx-auto mt-5 w-3/4">
            <a href="{{ $reservation->roomUrl }}" class="text-blue-500 no-underline hover:underline">戻る</a>
        </div>
    </div>
@endsection
