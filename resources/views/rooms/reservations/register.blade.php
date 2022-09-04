@extends('app.layout')

@section('title', '予約登録')

@section('content')
    <script>
        localStorage.setItem('templates', JSON.stringify(@json($templates)));
    </script>

    <h2 class="text-xl">予約登録</h2>

    <div class="flex">
        <label class="my-auto mr-2 block font-bold" for="template">テンプレート</label>
        <select
            class="border-geyser bg-aqua-haze focus-visible:border-science-blue dark:border-mako dark:bg-shark-200 dark:focus-visible:border-cornflower-blue dark:focus-visible:bg-shark-300 rounded-md border p-2 outline-none"
            id="template" name="template_id">
            <option value="">---</option>
            @foreach ($templates as $template)
                <option value="{{ $template->template_id }}">{{ $template->summary }}</option>
            @endforeach
        </select>
    </div>

    <form action="/reservations/register" method="POST">
        @csrf
        <input name="room_id" type="hidden" value="{{ $room_id }}">
        <div>
            <div class="my-3">
                <label class="mb-2 block font-bold" for="summary">概要<span class="text-valencia">*</span></label>
                <input
                    autocomplete="off"
                    class="bg-aqua-haze border-geyser focus-visible:border-science-blue dark:border-mako dark:bg-shark-200 dark:focus-visible:border-cornflower-blue dark:focus-visible:bg-shark-300 w-full rounded-md border p-2 outline-none focus-visible:bg-white"
                    id="summary" name="summary" type="text" value="{{ old('summary') }}">
            </div>

            <div class="my-3 flex">
                <div>
                    <label class="mb-2 block font-bold" for="start_at_date">開始日時<span class="text-valencia">*</span></label>
                    <input
                        class="bg-aqua-haze border-geyser focus-visible:border-science-blue dark:bg-shark-200 dark:border-mako dark:focus-visible:border-cornflower-blue dark:focus-visible:bg-shark-300 rounded-md border p-2 outline-none focus-visible:bg-white"
                        id="start_at_date" name="start_at_date" type="date" value="{{ old('start_at_date') }}">
                    <input
                        class="bg-aqua-haze border-geyser focus-visible:border-science-blue dark:bg-shark-200 dark:border-mako dark:focus-visible:border-cornflower-blue dark:focus-visible:bg-shark-300 rounded-md border p-2 outline-none focus-visible:bg-white"
                        id="start_at_time" name="start_at_time" type="time" value="{{ old('start_at_time') }}">
                </div>
                <span class="my-auto mx-4 font-bold">~</span>
                <div>
                    <label class="mb-2 block font-bold" for="end_at_date">終了日時<span class="text-valencia">*</span></label>
                    <input
                        class="bg-aqua-haze border-geyser focus-visible:border-science-blue dark:bg-shark-200 dark:border-mako dark:focus-visible:border-cornflower-blue dark:focus-visible:bg-shark-300 rounded-md border p-2 outline-none focus-visible:bg-white"
                        id="end_at_date" name="end_at_date" type="date" value="{{ old('end_at_date') }}">
                    <input
                        class="bg-aqua-haze border-geyser focus-visible:border-science-blue dark:bg-shark-200 dark:border-mako dark:focus-visible:border-cornflower-blue dark:focus-visible:bg-shark-300 rounded-md border p-2 outline-none focus-visible:bg-white"
                        id="end_at_time" name="end_at_time" type="time" value="{{ old('end_at_time') }}">
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
                    id="note" name="note" rows="4">{{ old('note') }}</textarea>
            </div>
        </div>

        <div class="my-3">
            <button
                class="bg-dodger-blue border-curious-blue hover:border-denim hover:bg-science-blue dark:border-goblin-100 dark:bg-goblin-200 dark:hover:bg-fruit-salad rounded-md border py-1 px-3 text-white">登録</button>
        </div>
    </form>
@endsection
