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
      <th class="w-screen text-3xl">Id</th>
      <th class="w-screen text-3xl">Full Name</th>
      <th class="w-screen text-3xl">Cell Number</th>
      <th class="w-screen text-3xl">Customer Pic</th>
      <th class="w-screen text-3xl">Pet</th>
      <th class="w-screen text-3xl">Actions</th>
    </tr>

    @forelse ($customers as $customer)

    <tr>
      <td class="text-center text-3xl">
        <a href="{{route('cust.show',$customer->id)}}">{{$customer->id}}</a>
      </td>
      <td class="text-center text-3xl">
        {{ $customer->full_name }}
      </td>
      <td class="text-center text-3xl">
        {{ $customer->cell_number }}
      </td>
      <td class="pl-12">
        <img src="{{ asset('pictures/customers/'.$customer->pictures)}}" alt="Antok na ko Diya" width="100" height="100">
      </td>
      <td class="text-center text-3xl">
        {{ $customer->pet_name }}
      </td>
      <td class=" text-center">
        <a href="cust/{{ $customer->id }}/edit" class="text-center text-2xl bg-green-600 p-2">
          Update
        </a>
      </td>
      <td class=" text-center">
        {!! Form::open(array('route' => array('cust.destroy', $customer->id),'method'=>'DELETE')) !!}
        <button type="submit" class="text-center text-2xl bg-red-600 p-2 my-2"
        onclick="return confirm('Do you want to delete this data on database?')">
          Delete
        </button>
        {!! Form::close() !!}
      </td>

      @if($customer->deleted_at)
      <td>
        <a href="{{ route('cust.restore', $customer->id) }}">
          <p class="text-center text-red-700 text-2xl bg-purple-500 p-2 my-2"
          onclick="return confirm('Do you want to restore this data?')">
            Restore
          </p>
        </a>
      </td>
      @else
      <td>
        <a href="#">
          <p class="text-center text-2xl bg-purple-500 p-2 my-2">
            Restore
          </p>
        </a>
      </td>
      @endif

      <td>
        <a href="{{ route('cust.forceDelete', $customer->id) }}">
          <p class="text-center text-2xl bg-warning p-2 ml-3 mr-4 my-2"
            onclick="return confirm('Do you want to delete this data permanently?')">
            Destroy
          </p>
        </a>
      </td>
    </tr>
    @empty
    <p>No Data in the Database</p>
    @endforelse
  </table>

  <div class="pt-6 px-4">{{ $customers->links( )}}</div>
</div>
</div>
@endsection
