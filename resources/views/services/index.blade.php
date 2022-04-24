@extends('body')

@section('laman')

<div class="pt-8 pb-4 px-8">
    <a href="service/create" class="p-3 border-none italic text-white bg-black text-lg">
        Add a new service &rarr;
    </a>
</div>

<div class="py-3">
    <table class="table-auto">
        <tr class="text-white text-center">
            <th class="w-screen text-3xl">Service Id</th>
            <th class="w-screen text-3xl">Service Name</th>
            <th class="w-screen text-3xl">Cost</th>
            <th class="w-screen text-3xl">Service Pic</th>
        </tr>

        @forelse ($services as $service)
        <tr>
            <td class=" text-center text-3xl">
                <a href="{{route('service.show',$service->id)}}">{{$service->id}}</a>
            </td>
            <td class=" text-center text-3xl">
                {{ $service->service_name }}
            </td>
            <td class=" text-center text-3xl">
                {{ $service->cost }}
            </td>
            <td class="pl-12">
                <img src="{{ asset('pictures/services/'.$service->images)}}" alt="I am A Pic" width="75" height="75">
            </td>
            <td class=" text-center">
                <a href="service/{{ $service->id }}/edit" class="text-center text-2xl bg-green-600 p-2">
                    Update &rarr;
                </a>
            </td>
            <td class=" text-center">
                {!! Form::open(array('route' => array('service.destroy', $service->id),'method'=>'DELETE')) !!}
                <button type="submit" class="text-center text-2xl bg-red-600 p-2"
                onclick="return confirm('Do you want to delete this data?')">
                    Delete &rarr;
                </button>
                {!! Form::close() !!}
            </td>
            @if($service->deleted_at)
            <td>
                <a href="{{ route('service.restore', $service->id) }}">
                    <p
                    onclick="return confirm('Do you want to restore this data?')">
                        Restore &rarr;
                    </p>
                </a>
            </td>
            @else
            <td>
                <a href="#">
                    <p class="text-center text-2xl bg-purple-500 py-2 mx-3"
                    >
                        Restore &rarr;
                    </p>
                </a>
            </td>
            @endif

        </tr>
        @empty
        <p>NO DATA</p>
        @endforelse
    </table>
    <div class="pt-6 px-4">{{ $services->links()}}</div>
</div>
</div>
@endsection
