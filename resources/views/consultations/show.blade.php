@extends('body')

@section('laman')
<div class="pb-20 my-2">
    <div class="text-center">
        <h1 class="text-5xl">
            Show Consultations
        </h1>
    </div>
    <div>
        <div class="grid grid-flow-col justify-center pt-4">
            {{ Form::model($consultations,['route' => ['consultation.update',$consultations->id],'method'=>'PUT']) }}
            <div class="block">
                <div class="grid grid-cols-2 py-2">
                    <label for="date" class="text-start text-lg">Date</label>
                    {{ Form::date('date',null,['readonly'],array('class'=>'block shadow-5xl p-2 my-2
                    w-full','id'=>'date')) }}
                </div>

                <div class="grid grid-cols-2 py-2">
                    <label for="diseases" class="text-start text-lg">Disease or Injury</label>
                    {{ Form::text('diseases',null,['readonly'],array('class'=>'block shadow-5xl p-2 my-2
                    w-full','id'=>'diseases')) }}
                </div>

                <div class="grid grid-cols-2 py-2">
                    <label for="price" class="text-start text-lg">Price</label>
                    {{ Form::text('price',null,['readonly'],array('class'=>'block shadow-5xl p-2 my-2
                    w-full','id'=>'price')) }}
                </div>

                <div class="grid grid-cols-2 py-2">
                    <label for="comment" class="text-start text-lg">Comment</label>
                    {{ Form::text('comment',null,['readonly'],array('class'=>'block shadow-5xl p-2 my-2
                    w-full','id'=>'comment')) }}
                </div>

                <div>
                    <label for="vet" class="text-lg">Vet</label>
                    {!! Form::select('vet',$employees, $consultations->vet ,['class' => 'block
                    shadow-5xl
                    p-2
                    my-2
                    w-full', 'disabled' => true]) !!}
                </div>

                <div>
                    <label for="pet" class="text-lg">Animal</label>
                    {!! Form::select('pet',$pet, $consultations->pet ,['class' => 'block
                    shadow-5xl
                    p-2
                    my-2
                    w-full', 'disabled' => true]) !!}
                </div>

                <div class="grid justify-center w-full">
                    <a href="{{url()->previous()}}" class="bg-gray-800 text-white font-bold py-2 px-4 mt-5 text-center"
                        role="button">Go Back &rarr;</a>
                </div>
            </div>
            </form>
        </div>
        @endsection
