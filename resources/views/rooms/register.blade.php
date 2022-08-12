@extends('app.layout')

@section('title', '会議室登録')

@section('content')
    <h2 class="text-xl">会議室登録</h2>

    <form action="/rooms/register" class="mt-4" method="POST">
        @csrf
        <label class="mb-2 block font-bold" for="room_name">会議室名<span class="text-valencia">*</span></label>
        <input
            autocomplete="off"
            class="bg-aqua-haze border-geyser focus-visible:border-science-blue dark:border-mako dark:bg-shark-200 dark:focus-visible:bg-shark-300 dark:focus-visible:border-cornflower-blue w-1/2 rounded-md border p-2 outline-none focus-visible:bg-white"
            id="room_name" name="name" type="text">
        <button
            class="border-curious-blue hover:border-denim hover:bg-science-blue bg-dodger-blue dark:border-goblin-100 dark:bg-goblin-200 dark:hover:bg-fruit-salad rounded-md border py-2 px-3 text-white">登録</button>
    </form>
@endsection
