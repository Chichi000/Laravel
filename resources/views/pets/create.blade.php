@extends('body')

@section('laman')
<div class="pb-20 my-2">
    <div class="text-center">
        <h1 class="text-5xl">
            Add Animal
        </h1>
    </div>
    <div>

        <div class="flex justify-center pt-3">
            <form action="/pets" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="block">
                    <div>
                        <label for="pet_name" class="text-lg">Pet Name</label>
                        <input type="text" class="block shadow-5xl p-2 my-2 w-full" id="pet_name" name="pet_name"
                            placeholder="Pet Name" value="{{old('pet_name')}}">
                        @if($errors->has('pet_name'))
                        <p class="text-center text-red-500">{{ $errors->first('pet_name') }}</p>
                        @endif
                    </div>

                    <div>
                        <label for="sex" class="text-lg">Gender</label>
                        <input type="text" class="block shadow-5xl p-2 my-2 w-full" id="sex" name="sex"
                            placeholder="Sex" value="{{old('sex')}}">
                        @if($errors->has('sex'))
                        <p class="text-center text-red-500">{{ $errors->first('sex') }}</p>
                        @endif
                    </div>

                    <div>
                        <label for="pictures" class="text-lg">Pet Picture</label>
                        <input type="file" class="block shadow-5xl p-2 w-full" id="pictures" name="pictures"
                            value="{{old('pictures')}}">
                        @if($errors->has('pictures'))
                        <p class="text-center text-red-500">{{ $errors->first('pictures') }}</p>
                        @endif
                    </div>

                    <label for="customer_id" class="text-lg">Owner</label>
                    <select name="customer_id" id="customer_id" class="block shadow-5xl p-2 w-full">
                        @foreach ($customers as $id => $customer)
                        <option value="{{ $id }}">{{ $customer }}</option>
                        @endforeach
                    </select>

                    <label for="kind_id" class="text-lg">kind</label>
                    <select name="kind_id" id="kind_id" class="block shadow-5xl p-2 w-full">
                        @foreach ($kind as $id => $kind)
                        <option value="{{ $id }}">{{ $kind }}</option>
                        @endforeach
                    </select>

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