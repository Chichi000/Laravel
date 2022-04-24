@extends('body')

@section('laman')
<div class="pb-20 my-2">
    <div class="text-center">
        <h1 class="text-5xl">
            Employee Information
        </h1>
    </div>
    <div class="py-3">
        <table class="table-auto text-center">
          <tr class="text-white">
            <th class="w-screen text-3xl">Employee Id</th>
            <th class="w-screen text-3xl">Email</th>
            <th class="w-screen text-3xl">Employee Pic</th>
          </tr>

          @forelse ($employees as $employee)

          <tr>
            <td class="text-center text-3xl">
             {{$employee->id}}
            </td>
            <td class="text-center text-3xl">
              {{ $employee->full_name }}
            </td>
            <td class="text-center text-3xl">
              {{ $employee->email }}
            </td>
            <td class="pl-12">
              <img src="{{ asset('pictures/employees/'.$employee->pictures)}}" alt="Pics" width="100" height="100">
            </td>
          </tr>
          @empty
          <p>No Data in the Database</p>
          @endforelse
        </table>
        @endsection
