@extends('app.layout')

@section('title', '予約テンプレート詳細')

@section('content')
    <h2 class="text-xl">予約テンプレート詳細</h2>

    <form action="/templates/update" method="POST">
        @csrf
        <input name="template_id" type="hidden" value="{{ $template->templateId }}">
        <div>
            <div class="my-3">
                <label class="mb-2 block font-bold" for="summary">概要<span class="text-valencia">*</span></label>
                <input
                    autocomplete="off"
                    class="bg-aqua-haze border-geyser focus-visible:border-science-blue dark:border-mako dark:bg-shark-200 dark:focus-visible:border-cornflower-blue dark:focus-visible:bg-shark-300 w-full rounded-md border p-2 outline-none focus-visible:bg-white"
                    id="summary" name="summary" type="text" value="{{ $template->summary }}">
            </div>

            <div class="my-3 flex">
                <div>
                    <label class="mb-2 block font-bold" for="start_at">開始日時<span class="text-valencia">*</span></label>
                    <input
                        class="bg-aqua-haze border-geyser focus-visible:border-science-blue dark:bg-shark-200 dark:border-mako dark:focus-visible:border-cornflower-blue dark:focus-visible:bg-shark-300 rounded-md border p-2 outline-none focus-visible:bg-white"
                        id="start_at" name="start_at" type="time" value="{{ $template->startAt }}">
                </div>
                <span class="my-auto mx-4 font-bold">~</span>
                <div>
                    <label class="mb-2 block font-bold" for="end_at">終了日時<span class="text-valencia">*</span></label>
                    <input
                        class="bg-aqua-haze border-geyser focus-visible:border-science-blue dark:bg-shark-200 dark:border-mako dark:focus-visible:border-cornflower-blue dark:focus-visible:bg-shark-300 rounded-md border p-2 outline-none focus-visible:bg-white"
                        id="end_at" name="end_at" type="time" value="{{ $template->endAt }}">
                </div>
            </div>

            <div class="my-3">
                <label class="mb-2 block font-bold" for="note">備考</label>
                <textarea
                    class="bg-aqua-haze border-geyser focus-visible:border-science-blue dark:border-mako dark:bg-shark-200 dark:focus-visible:border-cornflower-blue dark:focus-visible:bg-shark-300 w-full rounded-md border p-2 outline-none focus-visible:bg-white"
                    id="note" name="note" rows="4">{{ $template->note }}</textarea>
            </div>
        </div>

        <div class="my-3 flex justify-between">
            <button
                class="bg-dodger-blue border-curious-blue hover:border-denim hover:bg-science-blue dark:border-goblin-100 dark:bg-goblin-200 dark:hover:bg-fruit-salad rounded-md border py-1 px-3 text-white">更新</button>
            {{-- <button
                class="hover:border-tamarillo hover:bg-shiraz text-valencia border-iron bg-aqua-haze dark:text-mandy dark:bg-bright-gray dark:border-river-bed-100 dark:hover:text-botticelli dark:hover:bg-flush-mahogany dark:hover:border-mandy rounded-md border py-1 px-3 hover:text-white"
                id="template-delete-button">削除</button> --}}
        </div>
    </form>

    {{-- <form action="/templates/delete" method="post" id="template-delete-form">
        @csrf
        <input name="template_id" type="hidden" value="{{ $template->templateId }}">
    </form> --}}
@endsection
