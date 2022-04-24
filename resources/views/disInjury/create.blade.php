@extends('body')

@section('laman')
<div class="pb-20 my-2">
    <div class="text-center">
        <h1 class="text-5xl">
            Add Disease and Injury
        </h1>
    </div>
    <div>

        <div class="flex justify-center pt-3">
            <form action="/disInjury" method="POST">
                @csrf
                <div class="block">
                    <div>
                        <label for="dis_injury" class="text-lg">dis_injury</label>
                        <input type="text" class="block shadow-5xl p-2 my-2 w-full" id="dis_injury"
                            name="dis_injury" placeholder="dis_injury" value="{{old('dis_injury')}}">
                        @if($errors->has('dis_injury'))
                        <p class="text-center text-red-500">{{ $errors->first('dis_injury') }}</p>
                        @endif
                    </div>

                    <div class="grid grid-cols-2 gap-2 w-full">
                        <button type="submit" class="bg-green-800 text-white font-bold p-2 mt-5">
                            Submit
                        </button>
                        <a href="{{url()->previous()}}" class="bg-gray-800 text-white font-bold p-2 mt-5 text-center"
                            role="button">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
        @endsection
