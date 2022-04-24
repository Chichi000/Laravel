@extends('body')

@section('laman')
<div class="pb-20 my-2">
    <div class="text-center">
        <h1 class="text-5xl">
            Pet Information
        </h1>
    </div>
    <div class="py-3">
        <table class="table-auto">
            <tr class="text-white text-center">
                <th class="w-screen text-3xl">Pet Id</th>
                <th class="w-screen text-3xl">Pet Name</th>
                <th class="w-screen text-3xl">Gender</th>
                <th class="w-screen text-3xl">Breed</th>
                <th class="w-screen text-3xl">Owner</th>
                <th class="w-screen text-3xl">Pet Pic</th>
            </tr>

            @forelse ($pets as $pet)
            <tr>
                <td class=" text-center text-3xl">
                   {{$pet->id}}
                </td>
                <td class=" text-center text-3xl">
                    {{ $pet->pet_name }}
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
            </tr>
            @empty
            <p>No Pets Data in the Database</p>
            @endforelse
        @endsection
