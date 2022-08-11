@extends('app.layout')

@section('title', '予約詳細')

@section('content')
    <h2 class="text-xl">予約詳細</h2>

    <form action="/reservations/update" method="POST">
        @csrf
        <input name="reservation_id" type="hidden" value="{{ $reservation->reservationId }}">
        <div>
            <div class="my-3 flex">
                <label class="my-auto mr-2 block font-bold" for="room_id">会議室<span class="text-valencia">*</span></label>
                <select
                    class="border-geyser bg-aqua-haze focus-visible:border-science-blue dark:border-mako dark:bg-shark-200 dark:focus-visible:border-cornflower-blue dark:focus-visible:bg-shark-300 rounded-md border p-2 outline-none"
                    name="room_id" id="room_id">
                    @foreach ($rooms as $room)
                        @if ($room->id === $reservation->roomId)
                            <option value="{{ $room->id }}" selected>{{ $room->name }}</option>
                        @else
                            <option value="{{ $room->id }}">{{ $room->name }}</option>
                        @endif
                    @endforeach
                </select>
            </div>

            <div class="my-3">
                <label class="mb-2 block font-bold" for="summary">概要<span class="text-valencia">*</span></label>
                <input
                    class="bg-aqua-haze border-geyser focus-visible:border-science-blue dark:border-mako dark:bg-shark-200 dark:focus-visible:border-cornflower-blue dark:focus-visible:bg-shark-300 w-full rounded-md border p-2 outline-none focus-visible:bg-white"
                    id="summary" name="summary" type="text" value="{{ $reservation->summary }}">
            </div>

            <div class="my-3 flex">
                <div>
                    <label class="mb-2 block font-bold" for="start_at_date">開始日時<span class="text-valencia">*</span></label>
                    <input
                        class="bg-aqua-haze border-geyser focus-visible:border-science-blue dark:bg-shark-200 dark:border-mako dark:focus-visible:border-cornflower-blue dark:focus-visible:bg-shark-300 rounded-md border p-2 outline-none focus-visible:bg-white"
                        id="start_at_date" name="start_at_date" type="date" value="{{ $reservation->startAtDate }}">
                    <input
                        class="bg-aqua-haze border-geyser focus-visible:border-science-blue dark:bg-shark-200 dark:border-mako dark:focus-visible:border-cornflower-blue dark:focus-visible:bg-shark-300 rounded-md border p-2 outline-none focus-visible:bg-white"
                        id="start_at_time" name="start_at_time" type="time" value="{{ $reservation->startAtTime }}">
                </div>
                <span class="my-auto mx-4 font-bold">~</span>
                <div>
                    <label class="mb-2 block font-bold" for="end_at_date">終了日時<span class="text-valencia">*</span></label>
                    <input
                        class="bg-aqua-haze border-geyser focus-visible:border-science-blue dark:bg-shark-200 dark:border-mako dark:focus-visible:border-cornflower-blue dark:focus-visible:bg-shark-300 rounded-md border p-2 outline-none focus-visible:bg-white"
                        id="end_at_date" name="end_at_date" type="date" value="{{ $reservation->endAtDate }}">
                    <input
                        class="bg-aqua-haze border-geyser focus-visible:border-science-blue dark:bg-shark-200 dark:border-mako dark:focus-visible:border-cornflower-blue dark:focus-visible:bg-shark-300 rounded-md border p-2 outline-none focus-visible:bg-white"
                        id="end_at_time" name="end_at_time" type="time" value="{{ $reservation->endAtTime }}">
                </div>
                <div class="ml-4 flex items-end">
                    <button
                        class="border-geyser bg-aqua-haze hover:border-science-blue dark:bg-shark-200 dark:border-mako dark:hover:bg-shark-300 dark:hover:border-cornflower-blue mr-2 rounded-md border p-2 outline-none hover:bg-white"
                        id="add-hour-button">+1H</button>
                    <button
                        class="border-geyser bg-aqua-haze hover:border-science-blue dark:bg-shark-200 dark:border-mako dark:hover:bg-shark-300 dark:hover:border-cornflower-blue rounded-md border p-2 outline-none hover:bg-white"
                        id="add-half-hour-button">+30min</button>
                </div>
            </div>

            <div class="my-3">
                <label class="mb-2 block font-bold" for="note">備考</label>
                <textarea
                    class="bg-aqua-haze border-geyser focus-visible:border-science-blue dark:border-mako dark:bg-shark-200 dark:focus-visible:border-cornflower-blue dark:focus-visible:bg-shark-300 w-full rounded-md border p-2 outline-none focus-visible:bg-white"
                    id="note" name="note" rows="4">{{ $reservation->note }}</textarea>
            </div>
        </div>

        <div class="my-3 flex justify-between">
            <button
                class="bg-dodger-blue border-curious-blue hover:border-denim hover:bg-science-blue dark:border-goblin-100 dark:bg-goblin-200 dark:hover:bg-fruit-salad rounded-md border py-1 px-3 text-white">更新</button>
            <button
                class="hover:border-tamarillo hover:bg-shiraz text-valencia border-iron bg-aqua-haze dark:text-mandy dark:bg-bright-gray dark:border-river-bed-100 dark:hover:text-botticelli dark:hover:bg-flush-mahogany dark:hover:border-mandy rounded-md border py-1 px-3 hover:text-white"
                id="reservation-delete-button">削除</button>
        </div>
    </form>

    <form action="/reservations/delete" method="post" id="reservation-delete-form">
        @csrf
        <input name="room_id" type="hidden" value="{{ $reservation->roomId }}">
        <input name="reservation_id" type="hidden" value="{{ $reservation->reservationId }}">
    </form>
@endsection
