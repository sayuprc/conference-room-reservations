@extends('app.layout')

@section('title', '予約テンプレート登録')

@section('content')
    <h2 class="text-xl">予約テンプレート登録</h2>

    <form action="/templates/register" method="POST">
        @csrf

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
                    <label class="mb-2 block font-bold" for="start_at">開始日時<span class="text-valencia">*</span></label>
                    <input
                        class="bg-aqua-haze border-geyser focus-visible:border-science-blue dark:bg-shark-200 dark:border-mako dark:focus-visible:border-cornflower-blue dark:focus-visible:bg-shark-300 rounded-md border p-2 outline-none focus-visible:bg-white"
                        id="start_at" name="start_at" type="time" value="{{ old('start_at') }}">
                </div>
                <span class="my-auto mx-4 font-bold">~</span>
                <div>
                    <label class="mb-2 block font-bold" for="end_at">終了日時<span class="text-valencia">*</span></label>
                    <input
                        class="bg-aqua-haze border-geyser focus-visible:border-science-blue dark:bg-shark-200 dark:border-mako dark:focus-visible:border-cornflower-blue dark:focus-visible:bg-shark-300 rounded-md border p-2 outline-none focus-visible:bg-white"
                        id="end_at" name="end_at" type="time" value="{{ old('end_at') }}">
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
