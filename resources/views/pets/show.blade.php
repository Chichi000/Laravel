@extends('body')

@section('contents')
<div class="pb-20 my-2">
    <div class="text-center">
        <h1 class="text-5xl">
            Show Animals
        </h1>
    </div>
    <div>
        <div class="grid grid-flow-col justify-center pt-4">
            {{ Form::model($pets,['route' => ['pets.show',$pets->id],'method'=>'PUT',
            'enctype'=>'multipart/form-data']) }}
            <div class="block">
                <div class="grid grid-cols-2 py-2">
                    <label for="pet_name" class="text-lg">Pet Name</label>
                    {{ Form::text('pet_name',null,['readonly'],array('class'=>'block shadow-5xl p-2 my-2
                    w-full','id'=>'pet_name')) }}
                </div>

                <div class="grid grid-cols-2 py-2">
                    <label for="sex" class="text-lg">Sex</label>
                    {{ Form::text('sex',null,['readonly'],array('class'=>'block shadow-5xl p-2 my-2
                    w-full','id'=>'sex')) }}
                </div>

                <div class="grid grid-cols-2 py-2">
                    <label for="kind" class="text-lg">Kind</label>
                    {{ Form::text('kind',null,['readonly'],array('class'=>'block shadow-5xl p-2 my-2
                    w-full','id'=>'kind')) }}
                </div>

                <div>
                    <label for="pictures" class="block text-lg pb-3">Animal Pic</label>
                    <img src="{{ asset('uploads/pictures/'.$pictures->pictures)}}" alt="I am A Pic" width="100" height="100"
                        class="ml-36 py-2">
                </div>

                <div>
                    <label for="customer_id" class="text-lg">Type</label>
                    {!! Form::select('customer_id',$customers, $pictures->customer_id,['class' => 'block shadow-5xl
                    p-2 my-2 w-full', 'disabled' => true]) !!}
                </div>

                <div class="grid justify-center w-full pr-11">
                    <a href="{{url()->previous()}}" class="bg-gray-800 text-white font-bold py-2 px-4 mt-5 text-center"
                        role="button">Go Back </a>
                </div>
            </div>
            </form>
        </div>
        @endsection
