@extends('body')

@section('laman')

<div class="pt-8 pb-4 px-8">
    <a href="kind/create" class="p-3 border-none italic text-white bg-black text-lg">
        Add a new kind &rarr;
    </a>
</div>

<div class="py-3">
    <table class="table-auto">
        <tr class="text-white text-center">
            <th class="w-screen text-3xl">Id</th>
            <th class="w-screen text-3xl">kind</th>
            <th class="w-screen text-3xl">Update</th>
            <th class="w-screen text-3xl">Delete</th>
            <th class="w-screen text-3xl">Restore</th>
        </tr>

        @forelse ($kind as $kinds)
        <tr>
            </td>
            <td class=" text-center text-3xl">
                {{ $kinds->id }}
            </td>
            <td class=" text-center text-3xl">
                {{ $kinds->kind }}
            </td>

            @if($kinds->deleted_at)
            <td class=" text-center">
                <a href="#">
                    <p class="text-center text-2xl bg-green-600 p-2">
                        Update &rarr;
                    </p>
                </a>
            </td>
            @else
            <td>
                <a href="kind/{{ $kinds->id }}/edit" class="text-center text-2xl bg-green-600 p-2">
                    Update &rarr;
                </a>
            </td>
            @endif
            <td class=" text-center">
                {!! Form::open(array('route' => array('kind.destroy', $kinds->id),'method'=>'DELETE')) !!}
                <button type="submit" class="text-center text-2xl bg-red-600 p-2">
                    Delete &rarr;
                </button>
                {!! Form::close() !!}
            </td>
            @if($kinds->deleted_at)
            <td>
                <a href="{{ route('kind.restore', $kinds->id) }}">
                    <p class="text-center text-red-700 text-2xl bg-purple-500 py-2 mx-3">
                        Restore &rarr;
                    </p>
                </a>
            </td>
            @else
            <td>
                <a href="#">
                    <p class="text-center text-2xl bg-purple-500 py-2 mx-3">
                        Restore &rarr;
                    </p>
                </a>
            </td>
            @endif
        </tr>
        @empty
        <p>No kinds Data in the Database</p>
        @endforelse
    </table>
    <div class="pt-6 px-4">{{ $kind->links( )}}</div>
</div>
</div>
@endsection
