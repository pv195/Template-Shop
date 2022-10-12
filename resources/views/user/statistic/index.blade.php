@extends('user.layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="limiter">
                <div class="h1-title-statistic">
                    <h3>Sell /​ Statistics</h3>
                </div>
                <div class="h1-money-statistic">
                    <h3><i class="fas fa-donate icon1"></i>{{ $totalIncome }}$</h3>
                </div>
                <ul class="nav nav-tabs">
                    <li class="active option-statistic"><a data-toggle="tab" href="#home">Statistics By Product</a></li>
                    <li class="option-statistic"><a data-toggle="tab" href="#menu1">Statistics By Brands</a></li>
                    <li class="option-statistic"><a data-toggle="tab" href="#menu2">Statistics By Category</a></li>
                </ul>
                <div class="tab-content">
                    <div id="home" class="tab-pane fade in active">
                        <div class="table100 ver1 m-b-110">
                            <div class="table100-head">
                                <table>
                                    <thead>
                                        <tr class="row100 head">
                                            <th class="cell100 column1">Product Name</th>
                                            <th class="cell100 column2">Quantity Sold</th>
                                            <th class="cell100 column3">Total Money</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                            <div class="table100-body js-pscroll">
                                <table>
                                    <tbody>
                                        @foreach ($statisticByProduct as $item)
                                            <tr class="row100 body">
                                                <td class="cell100 column1">{{ $item->name }}</td>
                                                <td class="cell100 column2">{{ $item->total_quantity }}</td>
                                                <td class="cell100 column3">{{ $item->total_money }}$</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div id="menu1" class="tab-pane fade">
                        <div class="table100 ver1 m-b-110">
                            <div class="table100-head">
                                <table>
                                    <thead>
                                        <tr class="row100 head">
                                            <th class="cell100 column1">Brand Name</th>
                                            <th class="cell100 column2">Quantity Sold</th>
                                            <th class="cell100 column3">Total Money</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                            <div class="table100-body js-pscroll">
                                <table>
                                    <tbody>
                                        @foreach ($statisticByBrand as $item)
                                            <tr class="row100 body">
                                                <td class="cell100 column1">{{ $item->name }}</td>
                                                <td class="cell100 column2">{{ $item->total_quantity }}</td>
                                                <td class="cell100 column3">{{ $item->total_money }}$</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div id="menu2" class="tab-pane fade">
                        <div class="table100 ver1 m-b-110">
                            <div class="table100-head">
                                <table>
                                    <thead>
                                        <tr class="row100 head">
                                            <th class="cell100 column1">Category Name</th>
                                            <th class="cell100 column2">Quantity Sold</th>
                                            <th class="cell100 column3">Total Money</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                            <div class="table100-body js-pscroll">
                                <table>
                                    <tbody>
                                        @foreach ($statisticByCategory as $item)
                                            <tr class="row100 body">
                                                <td class="cell100 column1">{{ $item->name }}</td>
                                                <td class="cell100 column2">{{ $item->total_quantity }}</td>
                                                <td class="cell100 column3">{{ $item->total_money }}$</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="donut-chart">
                <canvas class="chart" id="doughnutChart"></canvas>
            </div>
            <div class="bar-chart">
                <canvas class="chart" id="myChart"></canvas>
            </div>
        </div>
    </div>
@endsection
@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/user/main.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/user/util.css') }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
@endpush
@section('js')
    <script>
        var dataDonutChart = <?php echo $dataDonutChart; ?>;
        var labelDonutChart = <?php echo $labelDonutChart; ?>;
        var dataBarChart = <?php echo $dataBarChart; ?>;
        var ctxP = document.getElementById("doughnutChart").getContext('2d');
        var myPieChart = new Chart(ctxP, {
            type: 'pie',
            data: {
                labels: labelDonutChart,
                datasets: [{
                    data: dataDonutChart,
                    backgroundColor: ["#F7464A", "#46BFBD", "#FDB45C", "#949FB1", "#4D5360", '#4D5213', "#4D5093", "#FDB113", "FD5293"
                    ],
                }]
            },
            options: {
                responsive: true
            }
        });

        var ctx = document.getElementById("myChart").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ["January", "February", "March", "April", "May", "June",
                    "July", "August", "September", "October", "November", "December"
                ],
                datasets: [{
                    label: 'Money',
                    data: dataBarChart,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(135, 91, 192, 0.2)',
                        'rgba(13, 161, 295, 0.2)',
                        'rgba(135, 216, 96, 0.2)',
                        'rgba(13, 191, 192, 0.2)',
                        'rgba(333, 112, 155, 0.2)',
                        'rgba(135, 119, 94, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255,99,132,1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(235, 91, 132, 1)',
                        'rgba(53, 161, 235, 1)',
                        'rgba(135, 216, 96, 1)', ,
                        'rgba(73, 191, 192, 1)',
                        'rgba(133, 112, 255, 1)',
                        'rgba(235, 119, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    </script>
@endsection
