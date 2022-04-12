@extends('body')

@section('laman')
<div class="pb-20 my-2">
    <div class="text-center">
        <h1 class="text-5xl">
            Show Customer
        </h1>
    </div>
    <div>
        <div class="grid grid-flow-col justify-center pt-4">
            {{ Form::model($customers,['route' => ['cust.show',$customers->id],'method'=>'PUT',
            'enctype'=>'multipart/form-data']) }}
            <div class="block">
                <div class="grid grid-cols-2 py-2">
                    <label for="full_name" class="text-start text-lg">Full Name</label>
                    {{ Form::text('full_name',null,['readonly'],array('class'=>'block shadow-5xl p-2 my-2
                    w-full','id'=>'full_name')) }}
                </div>

                <div class="grid grid-cols-2 py-2">
                    <label for="cell_number" class="text-lg">Cell Number</label>
                    {{ Form::text('cell_number',null,['readonly'],array('class'=>'block shadow-5xl p-2
                    my-2w-full','id'=>'cell_number')) }}
                </div>

                <div>
                    <label for="pictures" class="block text-lg pb-3">Customer Pic</label>
                    <img src="{{ asset('pictures/customers/'.$Customers->pictures)}}" alt="Fawk You" width="100"
                        height="100" class="ml-36 py-2">
                </div>

                <div class="grid justify-center w-full pr-11">
                    <a href="{{url()->previous()}}" class="bg-gray-800 text-white font-bold py-2 px-4 mt-5 text-center"
                        role="button">Go Back &rarr;</a>
                </div>
            </div>
            </form>
        </div>
        @endsection
