@extends('body')

@section('laman')
<div class="pb-20 my-2">
    <div class="text-center">
        <h1 class="text-5xl">
            Service Information
        </h1>
    </div>
    <div class="py-3">
        <table class="table-auto">
            <tr class="text-white text-center">
                <th class="w-screen text-3xl">Service Id</th>
                <th class="w-screen text-3xl">Service Name</th>
                <th class="w-screen text-3xl">Cost</th>
                <th class="w-screen text-3xl">Service Pic</th>
            </tr>

            @forelse ($services as $service)
            <tr>
                <td class=" text-center text-3xl">
                   {{$service->id}}
                </td>
                <td class=" text-center text-3xl">
                    {{ $service->service_name }}
                </td>
                <td class=" text-center text-3xl">
                    {{ $service->cost }}
                </td>
                <td class="pl-12">
                    <img src="{{ asset('pictures/services/'.$service->images)}}" alt="I am A Pic" width="75" height="75">
                </td>
            </tr>
            @empty
            <p>NO DATA</p>
            @endforelse
        @endsection
