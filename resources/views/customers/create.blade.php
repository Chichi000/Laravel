@extends('body')

@section('laman')
<div class="pb-20 my-2">
    <div class="text-center">
        <h1 class="text-5xl">
            Add Customer
        </h1>
    </div>
    <div>

        <div class="flex justify-center pt-3">
            <form action="/cust" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="block">
                    <div>
                        <label for="full_name" class="text-lg">Full Name</label>
                        <input type="text" class="block shadow-5xl p-2 my-2 w-full" id="full_name" name="full_name"
                            placeholder="Full Name" value="{{old('full_name')}}">
                        @if($errors->has('full_name'))
                        <p class="text-center text-red-500">{{ $errors->first('full_name') }}</p>
                        @endif
                    </div>

                    <div>
                        <label for="cell_number" class="text-lg">Cell Number</label>
                        <input type="text" class="block shadow-5xl p-2 my-2 w-full" id="cell_number"
                            name="cell_number" placeholder="cell_number" value="{{old('cell_number')}}">
                        @if($errors->has('cell_number'))
                        <p class="text-center text-red-500">{{ $errors->first('cell_number') }}</p>
                        @endif
                    </div>

                    <div>
                        <label for="pictures" class="text-lg">Customer Picture</label>
                        <input type="file" class="block shadow-5xl p-2 w-full" id="pictures" name="pictures"
                            value="{{old('pictures')}}">
                        @if($errors->has('pictures'))
                        <p class="text-center text-red-500">{{ $errors->first('pictures') }}</p>
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
