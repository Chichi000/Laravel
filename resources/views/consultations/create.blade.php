@extends('body')

@section('laman')
<div class="pb-20 my-2">
    <div class="text-center">
        <h1 class="text-5xl">
            Add Consultation
        </h1>
    </div>
    <div>

        <div class="flex justify-center pt-3">
            <form action="/consultation" method="POST">
                @csrf
                <div class="block">
                    <div>
                        <label for="date" class="text-lg">Date</label>
                        <input type="date" class="block shadow-5xl p-2 my-2 w-full" id="date" name="date"
                            placeholder="Date" value="{{old('date')}}">
                        @if($errors->has('date'))
                        <p class="text-center text-red-500">{{ $errors->first('date') }}</p>
                        @endif
                    </div>

                    <div>
                        <label for="cost" class="text-lg">cost</label>
                        <input type="text" class="block shadow-5xl p-2 my-2 w-full" id="cost" name="cost"
                            placeholder="cost" value="{{old('cost')}}">
                        @if($errors->has('cost'))
                        <p class="text-center text-red-500">{{ $errors->first('cost') }}</p>
                        @endif
                    </div>

                    <div>
                        <label for="comment" class="text-lg">Comment</label>
                        <input type="text" class="block shadow-5xl p-2 my-2 w-full" id="comment" name="comment"
                            placeholder="Comment for Animal" value="{{old('comment')}}">
                        @if($errors->has('comment'))
                        <p class="text-center text-red-500">{{ $errors->first('comment') }}</p>
                        @endif
                    </div>

                    <label for="employee_id" class="text-lg">Employees</label>
                    <select name="employee_id" id="employee_id" class="block shadow-5xl p-2 w-full">
                        @foreach ($employees as $id => $employee)
                        <option value="{{ $id }}">{{ $employee }}</option>
                        @endforeach
                    </select>

                    <label for="dis_injury_id" class="text-lg">Disease & Injury</label>
                    <select name="dis_injury_id" id="dis_injury_id" class="block shadow-5xl p-2 w-full">
                        @foreach ($dis_injury as $id => $dis_injury)
                        <option value="{{ $id }}">{{ $dis_injury }}</option>
                        @endforeach
                    </select>

                    <label for="pet_id" class="text-lg">Animals</label>
                    <select name="pet_id" id="pet_id" class="block shadow-5xl p-2 w-full">
                        @foreach ($pets as $id => $pet)
                        <option value="{{ $id }}">{{ $pet }}</option>
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
