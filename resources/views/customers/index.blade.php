@extends('body')

@section('laman')

@if ($message = Session::get('success'))
<div class="bg-red-500 p-4">
  <strong class="text-white text-3xl pl-4">{{ $message }}</strong>
</div>
@endif

<div class="pt-8 pb-4 px-8">
  <a href="cust/create" class="p-3 border-none italic text-white bg-black text-lg">
    Add a new customer
  </a>
</div>

<div class="py-3">
  <table class="table-auto text-center">
    <tr class="text-white">
      <th class="w-screen text-3xl">Customer Id</th>
      <th class="w-screen text-3xl">Full Name</th>
      <th class="w-screen text-3xl">Cell Number</th>
      <th class="w-screen text-3xl">Customer Pic</th>
      <th class="w-screen text-3xl">Pet</th>

    </tr>

    @forelse ($customers as $customer)

    <tr>
      @if($customer->deleted_at)
      <td class="text-center text-3xl">
        <a href="#">{{$customer->id}}</a>
      </td>
      @else
      <td class="text-center text-3xl">
        <a href="{{route('cust.show',$customer->id)}}">{{$customer->id}}</a>
      </td>
      @endif
      </td>
      <td>
        {{ $customer->full_name }}
      </td>
      <td>
        {{ $customer->cell_number }}
      </td>
      <td class="pl-12">
        <img src="{{ asset('pictures/customers/'.$customer->pictures)}}" alt="Pics" width="100" height="100">
      </td>
      <td>
        {{ $customer->pet_name }}
      </td>
      @if($customer->deleted_at)
      <td class=" text-center">
        <a href="#">
          <p class="text-center text-2xl bg-green-600 p-2">
            Update &rarr;
          </p>
        </a>
      </td>
      @else
      <td>
        <a href="cust/{{ $customer->id }}/edit" class="text-center text-2xl bg-green-600 p-2">
          Update &rarr;
        </a>
      </td>
      @endif
      <td class=" text-center">
        {!! Form::open(array('route' => array('cust.destroy', $customer->id),'method'=>'DELETE')) !!}
        <button type="submit" onclick="return confirm('Do you want to delete this data on database?')">
          Delete
        </button>
        {!! Form::close() !!}
      </td>

      @if($customer->deleted_at)
      <td>
        <a href="{{ route('cust.restore', $customer->id) }}">
          <p onclick="return confirm('Do you want to restore this data?')">
            Restore
          </p>
        </a>
      </td>
      @else
      <td>
        <a href="#">
          <p>
            Restore
          </p>
        </a>
      </td>
      @endif


    </tr>
    @empty
    <p>NO DATA</p>
    @endforelse
  </table>

  <div>{{ $customers->links( )}}</div>
  <span class="flex justify-center pt-6">
    <form action="{{ url('result') }}" type="GET">
      <input type="result" name="result" id="result" class="text-center pb-1 px-2 w-full">
      <div class="grid w-full">
        <button class="bg-green-800 text-white font-bold p-2 mt-3">Search</button>
      </div>
  </span>
</div>
</div>
@endsection