@extends('app.layout')

@section('title', '会議室登録')

@section('content')
    <h2 class="text-xl">会議室登録</h2>

    <form action="/rooms/register" class="mt-4" method="POST">
        @csrf
        <label class="mb-2 block font-bold" for="room_name">会議室名<span class="text-valencia">*</span></label>
        <input
            class="bg-aqua-haze border-geyser focus-visible:border-science-blue w-1/2 rounded-md border p-2 outline-none focus-visible:bg-white"
            id="room_name" name="name" type="text">
        <button
            class="bg-dodger-blue border-curious-blue hover:border-denim hover:bg-science-blue rounded-md border py-2 px-3 text-white">登録</button>
    </form>
@endsection
