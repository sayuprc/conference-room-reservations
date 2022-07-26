@extends('app.layout')

@section('title', '会議室登録')

@section('content')
    <div>
        @if ($errors->any())
            <div class="mx-auto mt-4 w-3/4 bg-red-500 text-white">
                <div class="container mx-auto flex items-center justify-between px-6 py-4">
                    <div class="flex">
                        <svg viewBox="0 0 40 40" class="h-6 w-6 fill-current">
                            <path
                                d="M20 3.36667C10.8167 3.36667 3.3667 10.8167 3.3667 20C3.3667 29.1833 10.8167 36.6333 20 36.6333C29.1834 36.6333 36.6334 29.1833 36.6334 20C36.6334 10.8167 29.1834 3.36667 20 3.36667ZM19.1334 33.3333V22.9H13.3334L21.6667 6.66667V17.1H27.25L19.1334 33.3333Z">
                            </path>
                        </svg>

                        @foreach ($errors->all() as $error)
                            {{ $error }}
                        @endforeach
                    </div>
                </div>
            </div>
        @endif

        <section class="mx-auto mt-4 w-3/4 rounded-md bg-white p-6 shadow-md">
            <h2 class="text-lg font-semibold capitalize text-gray-700">会議室登録</h2>

            <form action="/rooms/register" method="POST">
                @csrf
                <div class="mt-4 grid grid-cols-1 gap-6 sm:grid-cols-2">
                    <div>
                        <label class="text-gray-700" for="room_name">会議室名</label>
                        <input id="room_name" type="text" name="name"
                            class="mt-2 block w-full rounded-md border border-gray-200 bg-white px-4 py-2 text-gray-700 focus:border-blue-400 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-40">
                    </div>
                </div>

                <div class="mt-6 flex justify-end">
                    <button
                        class="transform rounded-md bg-gray-700 px-6 py-2 leading-5 text-white transition-colors duration-200 hover:bg-gray-600 focus:bg-gray-600 focus:outline-none">登録</button>
                </div>
            </form>
        </section>
    </div>
@endsection
