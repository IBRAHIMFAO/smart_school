{{-- <pre>
@php
    print_r($data);
    @endphp
    </pre> --}}

@php
    $statusColors = [
        'present' => 'rgba(78, 115, 223, 1)',
        'tardy' => 'rgba(255, 165, 0, 1)',
        'absences' => 'rgba(255, 0, 0, 1)',
    ];
@endphp
{{--
@foreach ($data as $groupData)
    <h6 class="text-primary fw-bold m-0" style="font-size: 20px;">{{ $groupData['label'] }}</h6>
    <div class="chart-area">
        <canvas
            data-bss-chart='{
            "type": "line",
            "data": {
                "labels": ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                "datasets": [
                    {
                        "label": "Absences",
                        "fill": true,
                        "data": {{ json_encode($groupData['data']['absent']) }},
                        "backgroundColor": "rgba(255, 0, 0, 0.05)",
                        "borderColor": "rgba(255, 0, 0, 1)"
                    },
                    {
                        "label": "Tardy",
                        "fill": true,
                        "data": {{ json_encode($groupData['data']['tardy']) }},
                        "backgroundColor": "rgba(255, 165, 0, 0.05)",
                        "borderColor": "rgba(255, 165, 0, 1)"
                    },
                    {
                        "label": "Present",
                        "fill": true,
                        "data": {{ json_encode($groupData['data']['present']) }},
                        "backgroundColor": "rgba(78, 115, 223, 0.05)",
                        "borderColor": "rgba(78, 115, 223, 1)"
                    }
                ]
            },
            "options": {
                "maintainAspectRatio": false,
                "legend": {
                    "display": false,
                    "labels": {
                        "fontStyle": "normal"
                    }
                },
                "title": {
                    "fontStyle": "normal"
                },
                "scales": {
                    "xAxes": [
                        {
                            "gridLines": {
                                "color": "rgb(234, 236, 244)",
                                "zeroLineColor": "rgb(234, 236, 244)",
                                "drawBorder": false,
                                "drawTicks": false,
                                "borderDash": ["2"],
                                "zeroLineBorderDash": ["2"],
                                "drawOnChartArea": false
                            },
                            "ticks": {
                                "fontColor": "#858796",
                                "fontStyle": "normal",
                                "padding": 20
                            }
                        }
                    ],
                    "yAxes": [
                        {
                            "gridLines": {
                                "color": "rgb(234, 236, 244)",
                                "zeroLineColor": "rgb(234, 236, 244)",
                                "drawBorder": false,
                                "drawTicks": false,
                                "borderDash": ["2"],
                                "zeroLineBorderDash": ["2"]
                            },
                            "ticks": {
                                "fontColor": "#858796",
                                "fontStyle": "normal",
                                "padding": 20
                            }
                        }
                    ]
                }
            }
        }'></canvas>
    </div>
@endforeach



@foreach ($data as $groupData)
<div class="card shadow mb-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h6 class="text-primary fw-bold m-0">{{ $groupData['label'] }}</h6>
        <div class="dropdown no-arrow"><button class="btn btn-link btn-sm dropdown-toggle" aria-expanded="false"
                data-bs-toggle="dropdown" type="button"><i class="fas fa-ellipsis-v text-gray-400"></i></button>
            <div class="dropdown-menu shadow dropdown-menu-end animated--fade-in">
                <p class="text-center dropdown-header">dropdown header:</p><a class="dropdown-item"
                    href="#">&nbsp;Action</a><a class="dropdown-item" href="#">&nbsp;Another action</a>
                <div class="dropdown-divider"></div><a class="dropdown-item" href="#">&nbsp;Something else
                    here</a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="chart-area">
            <div class="chartjs-size-monitor">
                <div class="chartjs-size-monitor-expand">
                    <div class=""></div>
                </div>
                <div class="chartjs-size-monitor-shrink">
                    <div class=""></div>
                </div>
            </div><canvas
            data-bss-chart='{
                "type": "line",
                "data": {
                    "labels": ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                    "datasets": [
                        {
                            "label": "Absences",
                            "fill": true,
                            "data": {{ json_encode($groupData['data']['absent']) }},
                            "backgroundColor": "rgba(255, 0, 0, 0.05)",
                            "borderColor": "rgba(255, 0, 0, 1)"
                        },
                        {
                            "label": "Tardy",
                            "fill": true,
                            "data": {{ json_encode($groupData['data']['tardy']) }},
                            "backgroundColor": "rgba(255, 165, 0, 0.05)",
                            "borderColor": "rgba(255, 165, 0, 1)"
                        },
                        {
                            "label": "Present",
                            "fill": true,
                            "data": {{ json_encode($groupData['data']['present']) }},
                            "backgroundColor": "rgba(78, 115, 223, 0.05)",
                            "borderColor": "rgba(78, 115, 223, 1)"
                        }
                    ]
                },
                "options": {
                    "maintainAspectRatio": false,
                    "legend": {
                        "display": false,
                        "labels": {
                            "fontStyle": "normal"
                        }
                    },
                    "title": {
                        "fontStyle": "normal"
                    },
                    "scales": {
                        "xAxes": [
                            {
                                "gridLines": {
                                    "color": "rgb(234, 236, 244)",
                                    "zeroLineColor": "rgb(234, 236, 244)",
                                    "drawBorder": false,
                                    "drawTicks": false,
                                    "borderDash": ["2"],
                                    "zeroLineBorderDash": ["2"],
                                    "drawOnChartArea": false
                                },
                                "ticks": {
                                    "fontColor": "#858796",
                                    "fontStyle": "normal",
                                    "padding": 20
                                }
                            }
                        ],
                        "yAxes": [
                            {
                                "gridLines": {
                                    "color": "rgb(234, 236, 244)",
                                    "zeroLineColor": "rgb(234, 236, 244)",
                                    "drawBorder": false,
                                    "drawTicks": false,
                                    "borderDash": ["2"],
                                    "zeroLineBorderDash": ["2"]
                                },
                                "ticks": {
                                    "fontColor": "#858796",
                                    "fontStyle": "normal",
                                    "padding": 20
                                }
                            }
                        ]
                    }
                }
            }'
                style="display: block; width: 861px; height: 320px;" width="1722" height="640"
                class="chartjs-render-monitor"></canvas>
        </div>
    </div>
</div>
@endforeach --}}


{{-- //############################################## --}}

<style>
    .chart-card {
        display: none;
    }

    .chart-card.active {
        display: block;
    }

    /* Sélectionne l'élément <select> avec l'ID "groupSelect" */
#groupSelect {
    color: rgb(241, 241, 241); /* Change la couleur du texte en vert */
    background-color: #05c0dd; /* Définit la couleur de fond en blanc */
}

/* Sélectionne toutes les options de l'élément <select> */
#groupSelect option {
    background-color: #05c0dd; /* Définit la couleur de fond des options en blanc */
}

/* Sélectionne l'option sélectionnée */
#groupSelect option:checked {
    background-color: green; /* Définit la couleur de fond de l'option sélectionnée en vert */
    color: white; /* Change la couleur du texte de l'option sélectionnée en blanc */
}


</style>

<!-- Add a select element to choose the group to display -->
<select id="groupSelect" class="btn btn-info" style="font-weight:800">
    {{-- <option value="d">Sélectionnez un groupe</option> --}}
    @foreach ($data as $groupData)
        <option  value="{{ $loop->index }}">{{ $groupData['label'] }}</option>
    @endforeach
</select>

<!-- Create a container to hold the chart cards -->
<div id="chartContainer">
    {{-- @foreach ($data as $groupData) --}}
    {{-- <div class="card shadow mb-4 chart-card"> --}}


        @foreach ($data as $key => $groupData)
        <div class="card shadow mb-4 chart-card {{ $key === 0 ? 'active' : '' }}">
            <div class="card-header d-flex justify-content-between align-items-center " style="background: #36b9cc;" >
                <h4 style="font-weight:50;font-weight: bold;color:rgb(245, 239, 239) " >Statistiques de présence :
                <i class="text-success "> {{ $groupData['label'] }} </i></h4>
                <div class="dropdown no-arrow">
                    <button class="btn btn-link btn-sm dropdown-toggle" aria-expanded="false" data-bs-toggle="dropdown"
                        type="button"><i class="fas fa-ellipsis-v text-gray-400"></i></button>
                    <div class="dropdown-menu shadow dropdown-menu-end animated--fade-in">
                        <p class="text-center dropdown-header">Select Group</p>
                        <a class="dropdown-item" href="#">&nbsp;Action</a>
                        <a class="dropdown-item" href="#">&nbsp;Another action</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">&nbsp;Something else here</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="chart-area">
                    <canvas
                        data-bss-chart='{
                    "type": "line",
                    "data": {
                        "labels": ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                        "datasets": [
                            {
                                "label": "Absences",
                                "fill": true,
                                "data": {{ json_encode($groupData['data']['absent']) }},
                                "backgroundColor": "rgba(255, 0, 0, 0.05)",
                                "borderColor": "rgba(255, 0, 0, 1)"
                            },
                            {
                                "label": "Tardy",
                                "fill": true,
                                "data": {{ json_encode($groupData['data']['tardy']) }},
                                "backgroundColor": "rgba(255, 165, 0, 0.05)",
                                "borderColor": "rgba(255, 165, 0, 1)"
                            },
                            {
                                "label": "Present",
                                "fill": true,
                                "data": {{ json_encode($groupData['data']['present']) }},
                                "backgroundColor": "rgba(78, 115, 223, 0.05)",
                                "borderColor": "rgba(78, 115, 223, 1)"
                            }
                        ]
                    },
                    "options": {
                        "maintainAspectRatio": false,
                        "legend": {
                            "display": false,
                            "labels": {
                                "fontStyle": "normal"
                            }
                        },
                        "title": {
                            "fontStyle": "normal"
                        },
                        "scales": {
                            "xAxes": [
                                {
                                    "gridLines": {
                                        "color": "rgb(234, 236, 244)",
                                        "zeroLineColor": "rgb(234, 236, 244)",
                                        "drawBorder": false,
                                        "drawTicks": false,
                                        "borderDash": ["2"],
                                        "zeroLineBorderDash": ["2"],
                                        "drawOnChartArea": false
                                    },
                                    "ticks": {
                                        "fontColor": "#858796",
                                        "fontStyle": "normal",
                                        "padding": 20
                                    }
                                }
                            ],
                            "yAxes": [
                                {
                                    "gridLines": {
                                        "color": "rgb(234, 236, 244)",
                                        "zeroLineColor": "rgb(234, 236, 244)",
                                        "drawBorder": false,
                                        "drawTicks": false,
                                        "borderDash": ["2"],
                                        "zeroLineBorderDash": ["2"]
                                    },
                                    "ticks": {
                                        "fontColor": "#858796",
                                        "fontStyle": "normal",
                                        "padding": 20
                                    }
                                }
                            ]
                        }
                    }
                }'></canvas>
                </div>
            {{-- ########################### Prameters ################################ --}}
                <div class="text-center small mt-4">
                    <span class="me-4">
                        <i class="fas fa-square  text-primary"></i>
                        <span>Presence</span>
                    </span>
                    <span class="me-4">
                        <i class="fas fa-square  text-orange" style="color: rgb(236, 148, 15);"></i>
                        <span>Retard</span>
                    </span>
                    <span class="me-4">
                        <i class="fas fa-square  text-danger"></i>
                        <span>Absence</span>
                    </span>
                </div>
            {{-- ########################### Prameters ################################ --}}

          </div>
        </div>
    @endforeach
</div>


<script>
    // Get references to the select element and the chart container
    const groupSelect = document.getElementById('groupSelect');
    const chartContainer = document.getElementById('chartContainer');

    // Add an event listener to the select element
    groupSelect.addEventListener('change', (event) => {
        const selectedIndex = parseInt(event.target.value);
        // Hide all chart cards
        const chartCards = document.getElementsByClassName('chart-card');
        for (let i = 0; i < chartCards.length; i++) {
            chartCards[i].classList.remove('active');
        }
        // Show the selected chart card
        chartCards[selectedIndex].classList.add('active');




    });
</script>


