@extends('body')

@section('laman')
<div class="pb-20 my-2">
    <div class="text-center">
        <h1 class="text-5xl">
            Update Transaction
        </h1>
    </div>
    <div>
        <div class="flex justify-center pt-4">
            {{ Form::model($transactions,['route' => ['transac.update',$transactions->id],'method'=>'POST']) }}
            <div class="block">
                <div>
                    <label for="date" class="text-lg">Date</label>
                    {{ Form::text('date',null,array('class'=>'block shadow-5xl p-2 my-2
                    w-full','id'=>'date')) }}
                    @if($errors->has('date'))
                    <p class="text-center text-red-500">{{ $errors->first('date') }}</p>
                    @endif
                </div>

                <div>
                    <label for="employee_id" class="text-lg">Vet</label>
                    {!! Form::select('employee_id',$employees, $transactions->employee_id,['class' => 'block
                    shadow-5xl
                    p-2
                    my-2
                    w-full']) !!}
                    @if($errors->has('employee_id'))
                    <p class="text-center text-red-500">{{ $errors->first('employee_id') }}</p>
                    @endif
                </div>

                <div>
                    <label for="pets_id" class="text-lg">Type</label>
                    {!! Form::select('pets_id',$animals, $transactions->pets_id,['class' => 'block
                    shadow-5xl
                    p-2
                    my-2
                    w-full']) !!}
                    @if($errors->has('pets_id'))
                    <p class="text-center text-red-500">{{ $errors->first('pets_id') }}</p>
                    @endif
                </div>

                <div>
                    <label for="service_id" class="text-lg">Type</label>
                    {!! Form::select('service_id',$services, $transactions->service_id,['class' => 'block
                    shadow-5xl
                    p-2
                    my-2
                    w-full']) !!}
                    @if($errors->has('service_id'))
                    <p class="text-center text-red-500">{{ $errors->first('service_id') }}</p>
                    @endif
                </div>

                <div>
                    <label for="status" class="text-lg mt-2">Status</label>
                    {{ Form::select('status',array('Not Paid' => 'Not Paid', 'Pending' => 'Pending',
                    'Paid'
                    => 'Paid'))}}
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