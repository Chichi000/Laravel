@extends('body')

@section('laman')
<div class="pb-20 my-2">
    <div class="text-center">
        <h1 class="text-5xl">
            Show Customer Information
        </h1>
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
            <td class="text-center text-3xl">
             {{$customer->id}}
            </td>
            <td class="text-center text-3xl">
              {{ $customer->full_name }}
            </td>
            <td class="text-center text-3xl">
              {{ $customer->cell_number }}
            </td>
            <td class="pl-12">
              <img src="{{ asset('pictures/customers/'.$customer->pictures)}}" alt="Pics" width="100" height="100">
            </td>
            <td class="text-center text-3xl">
              {{ $customer->pet_name }}
            </td>
          </tr>
          @empty
          <p>No Data in the Database</p>
          @endforelse
        </table>
        @endsection
