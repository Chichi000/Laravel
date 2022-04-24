@extends('body')

@section('laman')

@if ($message = Session::get('error'))
<div class="bg-red-500 p-4">
    <strong class="text-white text-3xl pl-4">>{{ $message }}</strong>
</div>
@endif

<div class="pt-8 pb-4 px-8">
    <a href="consultation/create" class="p-3 border-none italic text-white bg-black text-lg">
        Add New Consultation &rarr;
    </a>

</div>

<div class="py-3">
    <table class="table-auto">
        <tr class="text-center">
            <th class="w-screen text-3xl">Id</th>
            <th class="w-screen text-3xl">Date</th>
            <th class="w-screen text-3xl">Price</th>
            <th class="w-screen text-3xl">Comment</th>
            <th class="w-screen text-3xl">Comment</th>
            <th class="w-screen text-3xl">Vet</th>
            <th class="w-screen text-3xl">Animal</th>

        </tr>

        @forelse ($consultations as $consultation)
        <tr>
            <td class="text-white text-center text-2xl">
                <a href="{{route('consultation.show',$consultation->id)}}">{{$consultation->id}}</a>
            </td>
            <td class="text-white text-center text-2xl">
                {{ $consultation->date }}
            </td>
            <td class="text-white text-center text-2xl">
                {{ $consultation->cost }}
            </td>
            <td class="text-white text-center text-2xl">
                {{ $consultation->comment }}
            </td>
            <td class="text-white text-center text-2xl">
                {{ $consultation->full_name }}
            </td>
            <td class="text-white text-center text-2xl">
                {{ $consultation->dis_injury }}
            </td>
            <td class="text-center">
                <a href="consultation/{{ $consultation->id }}/edit" class="text-center text-xl bg-green-600 p-2">
                    Update &rarr;
                </a>
            </td>
            <td class="text-center">
                {!! Form::open(array('route' => array('consultation.destroy', $consultation->id),'method'=>'DELETE'))
                !!}
                <button type="submit" >
                    Delete &rarr;
                </button>
                {!! Form::close() !!}
            </td>
            @if($consultation->deleted_at)
            <td>
                <a href="{{ route('consultation.restore', $consultation->id) }}">
                    <p >
                        Restore &rarr;
                    </p>
                </a>
            </td>
            @else
            <td>
                <a href="#">
                    <p class="text-center text-lg bg-purple-500 p-2">
                        Restore &rarr;
                    </p>
                </a>
            </td>
            @endif

        </tr>
        @empty
        <p>No Consultation Data in the Database</p>
        @endforelse
    </table>

    <span class="flex justify-center pt-6">
        <form action="{{ url('results') }}" type="GET">
            <input type="result" name="result" id="result" >
            <div class="grid w-full">
                <button >Search</button>
            </div>
    </span>

    <div >{{ $consultations->links( )}}</div>
</div>
</div>
@endsection
