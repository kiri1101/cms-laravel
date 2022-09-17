@extends('partnerlayout')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
@endsection

@section('content')
<div class="container-fluid -mt-[5rem]">
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-sm-flex align-item-sm-center flex-sm-nowrap">
                        <div>
                            <h3 class="mb-2">{{__('Initial Balance')}}</h3>
                            <ul class="list list-unstyled mb-0">
                                <li><span class="text-default text-sm">{{__('Amount')}}: </span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div> 
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-sm-flex align-item-sm-center flex-sm-nowrap">
                        <div>
                            <h3 class="mb-2">{{__('Present Balance')}}</h3>
                            <ul class="list list-unstyled mb-0">
                                <li><span class="text-default text-sm">{{__('Amount')}}: </span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>    
        </div>                     
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-sm-flex align-item-sm-center flex-sm-nowrap">
                        <div>
                            <h3 class="mb-2">{{__('Commissions')}}</h3>
                            <ul class="list list-unstyled mb-0">
                                <li><span class="text-default text-sm">{{__('Amount/Day')}}: </span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>       
    </div> 

    <div class="w-[60rem] px-5">
        <canvas id="myChart"></canvas>
    </div>
     
</div>       
@endsection

@section('script')
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>    
    <script>
        const labels = ['January','February','March','April','May','June','August','September','October','November','December']; 
        const data = {
            labels: labels,
            datasets: [{
                label: 'Commission',
                backgroundColor: 'rgb(255, 99, 132)',
                borderColor: 'rgb(255, 99, 132)',
                data: [65, 59, 80, 81, 56, 55, 40, 25, 39, 15, 70],
            }]
        };    
        const config = {
            type: 'line',
            data: data,
            options: {}
        };
        const myChart = new Chart(
          document.getElementById('myChart'),
          config
        );
    </script>
@endsection

