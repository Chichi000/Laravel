@extends('body')

@section('laman')

<div class="pt-8 pb-4 px-8">
    <a href="signup">
        Add New Employee
    </a>

</div>
<div class="py-3">
    <table class="table-auto">
        <tr class="text-white text-center">
            <th class="w-screen text-3xl">Id</th>
            <th class="w-screen text-3xl">Full Name</th>
            <th class="w-screen text-3xl">Email</th>
            <th class="w-screen text-3xl">Image</th>
        </tr>

        @forelse ($employees as $employee)
        <tr>
            @if($employee->deleted_at)
            <td class="text-center text-3xl">
                <a href="#">{{$employee->id}}</a>
            </td>
            @else
            <td class="text-center text-3xl">
                <a href="{{route('employees.show',$employee->id)}}">{{$employee->id}}</a>
            </td>
            @endif
            </td>
            <td class="text-center text-3xl">
                {{ $employee->full_name }}
            </td>
            <td class="text-center text-3xl">
                {{ $employee->email }}
            </td>
            <td class="pl-10">
                <img src="{{ asset('pictures/employees/'.$employee->pictures)}}" alt="skskskks" width="75" height="75">
            </td>
            @if($employee->deleted_at)
            <td class=" text-center">
                <a href="#">
                    <p class="text-center text-2xl bg-green-600 p-2">
                        Update &rarr;
                    </p>
                </a>
            </td>
            @else
            <td>
                <a href="employees/{{ $employee->id }}/edit" class="text-center text-2xl bg-green-600 p-2">
                    Update &rarr;
                </a>
            </td>
            @endif
            <td class=" text-center">
                {!! Form::open(array('route' => array('employees.destroy', $employee->id),'method'=>'DELETE')) !!}
                <button type="submit" onclick="return confirm('Do you want to delete this data on database?')">
                    Delete &rarr;
                </button>
                {!! Form::close() !!}
            </td>
            @if($employee->deleted_at)
            <td>
                <a href="{{ route('employees.restore', $employee->id) }}">
                    <p onclick="return confirm('Do you want to restore this data?')">
                        Restore &rarr;
                    </p>
                </a>
            </td>
            @else
            <td>
                <a href="#">
                    <p>
                        Restore &rarr;
                    </p>
                </a>
            </td>
            @endif

            @empty
            <p>NO DATA</p>
            @endforelse
    </table>
    <div class="pt-6 px-4">{{ $employees->links()}}</div>
</div>
</div>
@endsection