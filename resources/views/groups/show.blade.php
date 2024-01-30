@extends('layouts')

@section('content')

        <!-- show.blade.php -->

        <div class="container">

            <h1>{{ $group-> nom_group }} </h1>
            <table  class="table table-striped table-hover" id="tableindex">
                <thead >
                    <tr style="color:rgb(29, 98, 226); " >
                        <th scope="col">First Name</th>
                        <th >Last Name</th>
                        <th scope="col">absence number</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($students as $student)
                    <tr>
                        <td>{{ $student->firstName }}</td>
                        <td>{{ $student->lastName }}</td>
                        <td>{{ $student->attendance->where('status','absent')->count() }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
@endsection
