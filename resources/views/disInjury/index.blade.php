@extends('body')

@section('laman')

<div class="pt-8 pb-4 px-8">
    <a href="disInjury/create" class="p-3 border-none italic text-white bg-black text-lg">
        Add a new disInjury &rarr;
    </a>
</div>

<div class="py-3">
    <table class="table-auto">
        <tr class="text-white text-center">
            <th class="w-screen text-3xl">Id</th>
            <th class="w-screen text-3xl">Disease & Injury</th>
            <th class="w-screen text-3xl">Update</th>
            <th class="w-screen text-3xl">Delete</th>
            <th class="w-screen text-3xl">Restore</th>
        </tr>

        @forelse ($disInjury as $disInjurys)
        <tr>
            </td>
            <td class=" text-center text-3xl">
                {{ $disInjurys->id }}
            </td>
            <td class=" text-center text-3xl">
                {{ $disInjurys->dis_injury }}
            </td>

            @if($disInjurys->deleted_at)
            <td class=" text-center">
                <a href="#">
                    <p class="text-center text-2xl bg-green-600 p-2">
                        Update &rarr;
                    </p>
                </a>
            </td>
            @else
            <td>
                <a href="disInjury/{{ $disInjurys->id }}/edit" class="text-center text-2xl bg-green-600 p-2">
                    Update &rarr;
                </a>
            </td>
            @endif
            <td class=" text-center">
                {!! Form::open(array('route' => array('disInjury.destroy', $disInjurys->id),'method'=>'DELETE'))
                !!}
                <button disInjurys="submit" class="text-center text-2xl bg-red-600 p-2">
                    Delete &rarr;
                </button>
                {!! Form::close() !!}
            </td>
            @if($disInjurys->deleted_at)
            <td>
                <a href="{{ route('disInjury.restore', $disInjurys->id) }}">
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
        <p>No Disease or Injury Data in the Database</p>
        @endforelse
    </table>
    <div class="pt-6 px-4">{{ $disInjury->links( )}}</div>
</div>
</div>
@endsection
