@extends('body')

@section('laman')
<div class="pb-20 my-2">
    <div class="text-center">
        <h1 class="text-5xl">
            Update Consultations
        </h1>
    </div>
    <div>
        <div class="flex justify-center pt-4">
            {{ Form::model($consultations,['route' => ['consultation.update',$consultations->id],'method'=>'PUT']) }}
            <div class="block">
                <div>
                    <label for="date" class="text-lg">Date</label>
                    {{ Form::date('date',null,array('class'=>'block shadow-5xl p-2 my-2
                    w-full','id'=>'date')) }}
                    @if($errors->has('date'))
                    <p class="text-center text-red-500">{{ $errors->first('date') }}</p>
                    @endif
                </div>

                <div>
                    <label for="cost" class="text-lg">cost</label>
                    {{ Form::text('cost',null,array('class'=>'block shadow-5xl p-2 my-2 w-full','id'=>'cost')) }}
                    @if($errors->has('cost'))
                    <p class="text-center text-red-500">{{ $errors->first('cost') }}</p>
                    @endif
                </div>

                <div>
                    <label for="comment" class="text-lg">Comment</label>
                    {{ Form::text('comment',null,array('class'=>'block shadow-5xl p-2 my-2 w-full','id'=>'comment')) }}
                    @if($errors->has('comment'))
                    <p class="text-center text-red-500">{{ $errors->first('comment') }}</p>
                    @endif
                </div>

                <div>
                    <label for="employee_id" class="text-lg">Vet</label>
                    {!! Form::select('employee_id',$employees, $consultations->employee_id ,['class' => 'block
                    shadow-5xl
                    p-2
                    my-2
                    w-full']) !!}
                    @if($errors->has('employee_id'))
                    <p class="text-center text-red-500">{{ $errors->first('employee_id ') }}</p>
                    @endif
                </div>

                <div>
                    <label for="dis_injury_id" class="text-lg">Vet</label>
                    {!! Form::select('dis_injury_id',$dis_injury, $consultations->dis_injury_id ,['class' =>
                    'block
                    shadow-5xl
                    p-2
                    my-2
                    w-full']) !!}
                    @if($errors->has('dis_injury_id'))
                    <p class="text-center text-red-500">{{ $errors->first('dis_injury_id ') }}</p>
                    @endif
                </div>

                <div>
                    <label for="pet_id" class="text-lg">Animal</label>
                    {!! Form::select('pet_id',$pets, $consultations->pet_id ,['class' => 'block
                    shadow-5xl
                    p-2
                    my-2
                    w-full']) !!}
                    @if($errors->has('pet_id'))
                    <p class="text-center text-red-500">{{ $errors->first('pet_id ') }}</p>
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
