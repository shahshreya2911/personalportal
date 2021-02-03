@extends('layouts.app')



@section('page-title', 'Analytics')

@section('page-heading', 'Analytics')





<style type="text/css">

    .form-group.inline {

    display: inline-block;

}

</style>

@section('content')



@include('partials.messages')

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>



<!-- Inside the body tag -->

<canvas id="myChart" style="height:auto; width: auto; min-height:250px" aria-label="Analytics Chart" role="img"></canvas>

<!-- Before the body closing tag -->

<script>



        function getRandomColor() {

            var letters = '0123456789ABCDEF'.split('');

            var color = '#';

            for (var i = 0; i < 6; i++) {

                color += letters[Math.floor(Math.random() * 16)];

            }

            return color;

        }



        function getRandomColorEach(count) {

            var data =[];

            for (var i = 0; i < count; i++) {

                data.push(getRandomColor());

            }

            return data;

        }



        var countries = {!! json_encode($country) !!};



        var ctx = document.getElementById('myChart').getContext('2d');

        var chart = new Chart(ctx, {

            // The type of chart we want to create

            type: 'doughnut',



            // The data for our dataset

            data: {

                labels: {!! json_encode($country) !!},

                datasets: [{

                    label: "Countries",

                    backgroundColor: getRandomColorEach(countries.length),

                    borderColor: '#328daa',

                    data: {!! json_encode($country_sessions) !!},

                }]

            },



            // Configuration options go here

            options: {

                responsive: true

            }

        });

</script>

@stop