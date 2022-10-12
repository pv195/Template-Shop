@extends('admin.layouts.app')
@section('content')
    <div class="container">
        <h2>Statistics</h2>
        <br>
        <!-- Nav tabs -->
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#home">Statistic by Orders</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#menu1">Statistics of total income by month</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#menu2">Statistics by Brands and Categories</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#menu3">Statistics by Products</a>
            </li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
            <div id="home" class="container tab-pane active"><br>
                <canvas id="orderChart"></canvas>
            </div>
            <div id="menu1" class="container tab-pane fade"><br>
                <canvas id="incomeChart"></canvas>
            </div>
            <div id="menu2" class="container tab-pane fade"><br>
                <div class="row">
                    <div class="col-sm">
                        <div class="row">
                            <h6 class="m-0 font-weight-bold text-primary">Statistic Income by Brand</h6>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <table class="table table-striped">
                                    <thead>
                                        <tr role="row">
                                            <th>Brand</th>
                                            <th>Total Income</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($statisticByBrands as $item)
                                            <tr role="row">
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->total }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm">
                        <div class="row">
                            <h6 class="m-0 font-weight-bold text-primary">Statistic Income by Categories</h6>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <table class="table table-striped">
                                    <thead>
                                        <tr role="row">
                                            <th>Category</th>
                                            <th>Total Income</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($statisticByCategories as $item)
                                            <tr role="row">
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->total }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="menu3" class="container tab-pane fade"><br>
                <div class="row">
                    <h6 class="m-0 font-weight-bold text-primary">Statistic Income by Product</h6>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <table class="table table-striped">
                            <thead>
                                <tr role="row">
                                    <th>Product</th>
                                    <th>Left Quantity</th>
                                    <th>Sold Quantity</th>
                                    <th>Total Income</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($statisticByProducts as $item)
                                    <tr role="row">
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>{{ $item->sold_quantity }}</td>
                                        <td>{{ $item->total }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src='https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.4/Chart.bundle.min.js'></script>
    <script>
        $(document).ready(function() {
            var labels = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
            var dataTotalOrder = <?php echo $statisticByTotalOrder; ?>;
            var dataCancelOrder = <?php echo $statisticByCancelOrder; ?>;
            var orderChart = $("#orderChart");
            var myOrderChart = new Chart(orderChart, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        data: dataTotalOrder,
                        label: "Total Orders",
                        borderColor: "rgba(54, 162, 235, 1)",
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        fill: false,
                        borderWidth: 2
                    }, {
                        data: dataCancelOrder,
                        label: "Cancel Orders",
                        borderColor: "rgba(153, 102, 255, 1)",
                        fill: true,
                        backgroundColor: 'rgba(153, 102, 255, 0.2)',
                        borderWidth: 2
                    }]
                },
                options: {
                    title: {
                        display: true,
                        text: 'Statistics of monthly orders'
                    }
                }
            });
            var dataTotalIncome = <?php echo $statisticByToTalIncome; ?>;
            var incomeChart = $("#incomeChart");
            var myIncomeChart = new Chart(incomeChart, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        data: dataTotalIncome,
                        label: "Total Income",
                        borderColor: "rgba(54, 162, 235, 1)",
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        fill: false,
                        borderWidth: 2
                    }]
                },
                options: {
                    title: {
                        display: true,
                        text: 'Monthly Income Statistics'
                    }
                }
            });
        });
    </script>
@endsection
