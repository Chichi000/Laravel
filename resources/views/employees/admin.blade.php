@extends('body')

@section('laman')

{{ Auth::user()->full_name }}
<div class="py-3">
  <table class="table-auto">
    <tr class="text-center">
      <th class="w-screen text-4xl">Id</th>
      <th class="w-screen text-4xl">Email</th>
    </tr>

    <tr>
      <td class=" text-center text-4xl text-white">
        {{ Auth::id() }}
      </td>
      <td class=" text-center text-4xl text-white">
        {{ Auth::user()->email }}
      </td>
    </tr>
  </table>
</div>
</div>


@endsection
