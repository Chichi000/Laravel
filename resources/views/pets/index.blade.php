@extends('body')

@section('laman')

<div class="pt-8 pb-4 px-8">
    <a href="pets/create" class="p-3 border-none italic text-white bg-black text-lg">
        Add a new pet
    </a>
</div>

<div class="py-3">
    <table class="table-auto">
        <tr class="text-white text-center">
            <th class="w-screen text-3xl">Id</th>
            <th class="w-screen text-3xl">Pet Name</th>
            <th class="w-screen text-3xl">Gender</th>
            <th class="w-screen text-3xl">Kind</th>
            <th class="w-screen text-3xl">Customer</th>
            <th class="w-screen text-3xl">Pet Pic</th>
            <th class="w-screen text-3xl">Actions</th>
        </tr>

        @forelse ($pets as $pet)
        <tr>
            <td class=" text-center text-3xl">
                <a href="{{route('pets.show',$pet->id)}}">{{$pet->id}}</a>
            </td>
            <td class=" text-center text-3xl">
                {{ $pet->pets_name }}
            </td>
            <td class=" text-center text-3xl">
                {{ $pet->sex }}
            </td>
            <td class=" text-center text-3xl">
                {{ $pet->kind }}
            </td>
            <td class=" text-center text-3xl">
                {{ $pet->full_name }}
            </td>
            <td class="pl-10">
                <img src="{{ asset('pictures/pets/'.$pet->pictures)}}" alt="skskskks" width="75" height="75">
            </td>
            <td class=" text-center">
                <a href="pets/{{ $pet->id }}/edit" class="text-center text-lg bg-green-600 p-2">
                    Update
                </a>
            </td>
            <td class=" text-center">
                {!! Form::open(array('route' => array('pets.destroy', $pet->id),'method'=>'DELETE')) !!}
                <button type="submit" class="text-center text-lg bg-red-600 p-2"
                onclick="return confirm('Do you want to delete this data on database?')">
                    Delete
                </button>
                {!! Form::close() !!}
            </td>
            @if($pet->deleted_at)
            <td>
                <a href="{{ route('pets.restore', $pet->id) }}">
                    <p class="text-center text-red-700 text-lg bg-purple-500 p-2">
                        Restore
                    </p>
                </a>
            </td>
            @else
            <td>
                <a href="#">
                    <p class="text-center text-lg bg-purple-500 p-2">
                        Restore
                    </p>
                </a>
            </td>
            @endif
            <td>
                <a href="{{ route('pets.forceDelete', $pet->id) }}">
                    <p class="text-center text-lg bg-warning p-2 m-2"
                        onclick="return confirm('Do you want to delete this data permanently?')">
                        Destroy
                    </p>
                </a>
            </td>
        </tr>
        @empty
        <p>No Pets Data in the Database</p>
        @endforelse
    </table>
    <div class="pt-6 px-4">{{ $pets->links( )}}</div>
</div>
</div>
@endsection
