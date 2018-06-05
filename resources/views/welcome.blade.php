<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta name="_token" content="{{ csrf_token() }}">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- <meta http-equiv="refresh" content="25"> -->

        <title>Pool Blocks</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker3.min.css">
        <style>
            img {
                width: 30px;
            }

            .row {
                margin-top: 10px;
            }
            .bg-dark .row {
                margin-top: 0; 
            }
            .showChart {
                width: 100%;
                height: 500px;
            }
            .date {
                padding: 10px;
            }
            .datepicker table tr td.disabled {
                color: #eaeaea;
            }
            .sortYr {
                text-align: center;
                padding: 10px;
            }
            .sortYr button {
                border: 
            }
            .serdate {

            }
        </style>
    </head>
    <body>
        <!-- <nav class="navbar navbar-dark bg-dark">
            
            <a class="navbar-brand" href="#"><img src="https://steemitimages.com/0x0/https://the-superior-coin.com/images/Superior.png" alt=""> SUP Pool Blocks</a>
            
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
               
            <div class="input-append date">
              <input class="span2 datepicker" size="16" type="text">
              <span class="add-on"><i class="icon-th"></i></span>
            </div>
           
            <div class="collapse navbar-collapse" id="navbarSupportedContent"></div>
        </nav> -->
        <div class="navbar-dark bg-dark">
            <div class="row">
                <div class="col-md-4">
                    <a class="navbar-brand" href="#"><img src="https://steemitimages.com/0x0/https://the-superior-coin.com/images/Superior.png" alt=""> SUP Pool Blocks</a>
                </div>
                <div class="col-md-8">
                    <input type="hidden" class="hidden-last" value="{{ $last->pool_timestamps }}">
                    <div class="row justify-content-end">
                        <div class="col-3">
                            <div class="input-group date text-right" id="datepicker" data-provide="datepicker">
                                <input class="form-control text-center" size="16" type="text">
                                <span class="input-group-addon">
                                    <span class="fa fa-calendar"></span>
                                </span>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="sortYr">
                                <button class="btn btn-light">Sort Yearly</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-7">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header text-white bg-dark">Total Block hit Percentage within 24 hours</div>
                            <div class="card-body">
                                <p>Superiorcoinpool.com</p>
                                <p>Total Blocks Mined: <span id="pool_value1"></span></p>
                                <div id="chartdiv" class="showChart"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header text-white bg-dark">Total Block hit Percentage within 24 hours</div>
                            <div class="card-body">
                                <p>Superiorcoin.minandoando.com</p>
                                <p>Total Blocks Mined: <span id="minando_value"></span></p>
                                <div id="minandochart" class="showChart"></div>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header text-white bg-dark">Total Block hit Percentage within 24 hours</div>
                            <div class="card-body">
                                <p>Sup.cryptomineros.com</p>
                                <p>Total Blocks Mined: <span id="crypto_value"></span></p>
                                <div id="cryptomineroschart" class="showChart"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header text-white bg-dark">Total Block hit Percentage within 24 hours</div>
                            <div class="card-body">
                                <p>Superior.superpools.net</p>
                                <p>Total Blocks Mined: <span id="chartdiv2_blocks">0</span></p>
                                <div id="superpoolschart" class="showChart"></div>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header text-white bg-dark">Total Block hit Percentage within 24 hours</div>
                            <div class="card-body">
                                <p>Sup.makebitcoin.today</p>
                                <p>Total Blocks Mined: 0</p>
                                <div id="makebitcoinchart" class="showChart"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header text-white bg-dark">Total Block hit Percentage within 24 hours</div>
                            <div class="card-body">
                                <p>Sup.mineventure.org/</p>
                                <p>Total Blocks Mined: 0</p>
                                <div id="mineventurechart" class="showChart"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div>
                    <h3>Disclaimer</h3>
                    <div>The data that being fetch from the serve are base on GMT UTC -8 time. It may have some discrepancy on fetching the total block since the local time don't match on serve time</div>
                </div>
                <div>
                    <table class="table" id="myTable" style="margin-top: 12px;">
                        <thead class="thead-dark">
                            <tr>
                            <th scope="col">Date</th>
                            <th scope="col" style="text-align: center;">Total Blocks Hit</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $datum)
                                <tr>
                                    <td>{{ \Carbon\Carbon::createFromTimestamp($datum->today)->format('m-d-Y') }}</td>
                                    <td style="text-align: center;">{{ $datum->totalhit }}</td>
                                </tr>    
                            @endforeach
                        
                        </tbody>
                    </table>
                </div>
                <div class="card" style="margin-top: 20px;">
                    <div class="card-header text-white bg-dark">Total Block hit Percentage within 24 hours</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4"><p>Total Blocks Hit: <b id="network_value" style="color: #2a9acc;">0</b></p></div>
                            <div class="col-md-4"><p>Total Unaccounted: <b id="unaccounted" style="color: #2a9acc;">0</b></p></div>
                            <div class="col-md-4"><p>Total Unaccounted Percentage: <b id="unaccount_percent" style="color: #2a9acc;">0</b></p></div>
                        </div>
                        <div id="barchart" class="showChart"></div>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
    <script src="https://www.amcharts.com/lib/3/serial.js"></script>
    <script src="https://www.amcharts.com/lib/3/gauge.js"></script>
    <script src="https://www.amcharts.com/lib/3/pie.js"></script>
    <script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
    <script src="https://www.amcharts.com/lib/3/themes/light.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/amcharts/3.21.12/plugins/responsive/responsive.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.1/moment.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment-timezone/0.5.17/moment-timezone-with-data.min.js"></script>
    <script type="text/javascript" src="{{ asset('js/custom-chart.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/ajax-request.js') }}"></script>

</html>