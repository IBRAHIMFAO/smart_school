@extends('layouts')

@section('content')
    <h1 class="text-center" style="color:rgb(127, 207,0)">Attendance table </h1>
    <link rel="stylesheet" href="{{ url('css/attendance.css') }}">
    {{-- <p>Seance ID: {{ $attendance->id }}</p> --}}

    <!-- Add your attendance records here -->
    <!-- Customize the view based on your attendance data structure -->
@php
    $img=["https://images.pexels.com/photos/415829/pexels-photo-415829.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500",
     "https://images.pexels.com/photos/3779448/pexels-photo-3779448.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500",
      "https://images.pexels.com/photos/3765114/pexels-photo-3765114.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940",
      "https://images.pexels.com/photos/415829/pexels-photo-415829.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500" ]
@endphp

    <div class="container rounded mt-5 bg-white p-md-5">
        <div class="h2 font-weight-bold">Meetings</div>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">image</th>
                    <th scope="col">  Name  </th>
                    <th scope="col">Date</th>
                    {{-- <th scope="col">Time</th> --}}
                    <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody>

            @foreach ($attendance as $record )


            <tr class="bg-blue">
                <td class="pt-2"> <img src="{{ $img[1] }}" class="rounded-circle" alt="">
                    <div class="pl-lg-5 pl-md-3 pl-1 name"></div>
                </td>
                <td class="pt-3">{{ $record->student-> firstName }} {{ $record->student-> lastName }}</td>
                <td class="pt-3">{{ $record->date }}</td>
                {{-- <td class="pt-3">11:00 AM</td> --}}
                {{-- <td class="pt-3">{{ $record ->status }}</td> --}}
                {{-- <td class="pt-3" style="background-color: {{ $record->status === 'absent' ? 'rgb(249, 105, 90)' : 'inherit' }}">{{ $record->status }}</td> --}}
                {{-- <td class="pt-3" style="background-color: {{ $record->status === 'absent' ? 'rgb(249, 105, 90)' : 'inherit' }}; background-color: {{ $record->status === 'tardy' ? 'orange' : 'inherit' }}">{{ $record->status }}</td> --}}
                <td class="pt-3" style="background-color: {{ $record->status === 'absent' ? 'rgb(249, 105, 90)' : ($record->status === 'tardy' ? 'orange' : 'inherit') }}">{{ $record->status }}</td>


                <td class="pt-3"><span class="fa fa-check pl-3"></span></td>
                <td class="pt-3"><span class="fa fa-ellipsis-v btn"></span></td>
            </tr>
            <tr id="spacing-row">
                <td></td>
            </tr>

            @endforeach


            </tbody>
        </table>
    </div>
</div>

    </div>

















    {{-- <table>
        <thead>
            <tr>
                <th>Student Name</th>
                <th>Attendance Status</th>
            </tr>
        </thead>
        <tbody>
            <tr>sssssssssssssss</tr>
            <tr>ezzzzzzzzzzzzzz</tr>
            @foreach ($attendance as $record)
                <tr>
                    <td>{{ $record->student->name }}</td>
                    <td>{{ $record->status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table> --}}
@endsection
