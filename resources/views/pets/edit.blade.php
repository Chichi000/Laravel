@extends('body')

@section('laman')
<div class="pb-20 my-2">
    <div class="text-center">
        <h1 class="text-5xl">
            Update Animals
        </h1>
    </div>
    <div>
        <div class="flex justify-center pt-4">
            {{ Form::model($pets,['route' => ['pets.update',$pets->id],'method'=>'PUT',
            'enctype'=>'multipart/form-data']) }}
            <div class="block">
                <div>
                    <label for="pet_name" class="text-lg">Pet Name</label>
                    {{ Form::text('pet_name',null,array('class'=>'block shadow-5xl p-2 my-2
                    w-full','id'=>'pet_name')) }}
                    @if($errors->has('pet_name'))
                    <p class="text-center text-red-500">{{ $errors->first('pet_name') }}</p>
                    @endif
                </div>

                <div>
                    <label for="sex" class="text-lg">Gender</label>
                    {{ Form::text('sex',null,array('class'=>'block shadow-5xl p-2 my-2 w-full','id'=>'sex')) }}
                    @if($errors->has('sex'))
                    <p class="text-center text-red-500">{{ $errors->first('sex') }}</p>
                    @endif
                </div>

                <div>
                    <label for="pictures" class="block text-lg pb-3">Pet Picture</label>
                    {{ Form::file('pictures',null,array('class'=>'block shadow-5xl p-2 my-2 w-full','id'=>'pictures')) }}
                    <img src="{{ asset('pictures/pets/'.$pets->pictures)}}" alt="I am A Pic" width="100" height="100"
                        class="ml-24 py-2">
                    @if($errors->has('pictures'))
                    <p class="text-center text-red-500">{{ $errors->first('pictures') }}</p>
                    @endif
                </div>

                <div>
                    <label for="customer_id" class="text-lg">Owner</label>
                    {!! Form::select('customer_id',$customers, $pets->customer_id,['class' => 'block shadow-5xl p-2
                    my-2
                    w-full']) !!}
                    @if($errors->has('customer_id'))
                    <p class="text-center text-red-500">{{ $errors->first('customer_id') }}</p>
                    @endif
                </div>

                <div>
                    <label for="kind_id" class="text-lg">Owner</label>
                    {!! Form::select('kind_id',$kind, $pets->kind_id,['class' => 'block shadow-5xl p-2
                    my-2
                    w-full']) !!}
                    @if($errors->has('kind_id'))
                    <p class="text-center text-red-500">{{ $errors->first('kind_id') }}</p>
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
