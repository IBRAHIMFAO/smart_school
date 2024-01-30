<div class="chart-area">
    <canvas id="absences-chart"></canvas>
</div>

@section('scripts')
<script>
    const data = {!! json_encode($datag) !!};

    // Define an array of colors (you can add more colors as needed)
    const colors = [
        "rgba(78, 115, 223, 0.6)",   // Blue
        "rgba(54, 185, 204, 0.6)",   // Turquoise
        "rgba(255, 99, 132, 0.6)",   // Red
        "rgba(75, 192, 192, 0.6)",   // Green
        "rgba(255, 159, 64, 0.6)",   // Orange
        "rgba(153, 102, 255, 0.6)",  // Purple
        "rgba(255, 206, 86, 0.6)",   // Yellow
        // Add more colors here...
    ];

    const chartData = {
        "labels": ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
        datasets: data.map((group, index) => ({ // Use map to access index for assigning colors
            label: group.label,
            fill: true,
            data: group.data.absent,
            backgroundColor: "rgba(255, 165, 0, 0.05)", // Assign a color based on the index
            borderColor: colors[index % colors.length] // Use the same color for border
        }))
    };

    const ctx = document.getElementById('absences-chart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: chartData,
        options: {
            maintainAspectRatio: false,
            legend: {
                display: true,
                labels: {
                    fontStyle: "normal"
                }
            },
            title: {
                fontStyle: "normal"
            },
            scales: {
                xAxes: [{
                    gridLines: {
                        color: "rgb(234, 236, 244)",
                        zeroLineColor: "rgb(234, 236, 244)",
                        drawBorder: false,
                        drawTicks: false,
                        borderDash: ["2"],
                        zeroLineBorderDash: ["2"],
                        drawOnChartArea: false
                    },
                    ticks: {
                        fontColor: "#858796",
                        fontStyle: "normal",
                        padding: 20
                    }
                }],
                yAxes: [{
                    gridLines: {
                        color: "rgb(234, 236, 244)",
                        zeroLineColor: "rgb(234, 236, 244)",
                        drawBorder: false,
                        drawTicks: false,
                        borderDash: ["2"],
                        zeroLineBorderDash: ["2"]
                    },
                    ticks: {
                        fontColor: "#858796",
                        fontStyle: "normal",
                        padding: 20
                    }
                }]
            }
        }
    });
</script>
@endsection
