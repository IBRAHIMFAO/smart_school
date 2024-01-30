@extends('dashboard.master')
{{-- @include('dashcontent') --}}
 {{-- @extends('layouts')

@section('content')

<div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-md-6 mx-auto">
        <h1>Les seances</h1>
        <div id="links">

        </div>
    </div>
    </div>
  </div>





@endsection


@push('js')
    <script>
        // Wait for the document to be ready
        $(document).ready(function() {
            // Add a submit event listener to the for
            $.ajax({
                url: "/getSessions",
                type: "GET",
                dataType: "json",
                success: function(response) {
                    // Do something with the response data
                    console.log(response);

                    for (var i = 0; i < response.length; i++) {
                        var ahref = $('<a>')
                        // append the div to an existing element on the page
                        var sessionID = response[i].id;
                        // var sessionName = response[i].name;
                        ahref.attr("href", "/session/"+sessionID+"/get")
                        ahref.attr("class", "btn btn-info mt-2")
                        ahref.text("seance numéro "+sessionID)
                        $("#links").append(ahref);
                        $("#links").append("<br>");
                    // Access the fields of each session object
                    // Do something with the fields
                    console.log("Session ID: " + sessionID);
                    // console.log("Session Name: " + sessionName);
                    }
                },
                error: function(error) {
                    // Handle the error
                    console.log(error);
                }
            });

            // $.ajax({
            //     url: "/getSessions",
            //     type: "GET",
            //     data: {
            //         query: query
            //     },
            //     // dataType: "json",
            //     success: function(data) {
            //         // Clear any existing rows from the table
            //         $('#data').empty();

            //         // Append a new row for each result returned by the controller
            //         $.each(data, function(i, item) {
            //             var row = $('<tr>').append(
            //                 $('<td>').text(item.id),
            //                 $('<td>').text(item.firstName),
            //                 $('<td>').text(item.lastName),
            //                 $('<td>').text(item.groupe_id),
            //             );
            //             $('#data').append(row);
            //         });
            //     },
            //     error: function(error) {
            //         // Handle the error
            //         console.log(error);
            //     }
            // });



        });
    </script>
@endpush


 --}}
