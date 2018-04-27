<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta name="_token" content="{{ csrf_token() }}">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="refresh" content="25">
        

        <title>Pool Blocks</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
        <link rel="stylesheet" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
        <style>
            img {
                width: 30px;
            }

            .row {
                margin-top: 10px;
            }

            .showChart {
                width: 100%;
                height: 500px;
            }
        </style>
    </head>
    <body>
        <nav class="navbar navbar-dark bg-dark">
            <a class="navbar-brand" href="#"><img src="https://steemitimages.com/0x0/https://the-superior-coin.com/images/Superior.png" alt=""> SUP Pool Blocks</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent"></div>
        </nav>
        
        <div class="row">
            <div class="col-md-6">
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
                                <p>Superiorcoin.minandoando.com</p>
                                <p>Total Blocks Mined: <span id="minando_value"></span></p>
                                <div id="minandochart" class="showChart"></div>
                            </div>
                        </div>
                    </div>
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
            <div class="col-md-6" style="margin-top: 10px;">
                <div class="card">
                    <div class="card-header text-white bg-dark">Total Block hit Percentage within 24 hours</div>
                    <div class="card-body">
                        <p>Total Blocks Hit: <b id="network_value">0</b></p>
                        <p>Total Unaccounted: <b id="unaccounted">0</b></p>
                        <p>Total Unaccounted Percentage: <b id="unaccount_percent">0</b></p>
                        <div id="barchart" class="showChart"></div>
                    </div>
                </div>
                <div>
                    <table class="table" id="myTable" style="margin-top: 12px;">
                        <thead class="thead-dark">
                            <tr>
                            <th scope="col">Day</th>
                            <th scope="col">Total Blocks Hit</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $datum)
                                <tr>
                                    <td>Day {{ $datum->day+1 }}</td>
                                    <td>{{ $datum->totalhit }}</td>
                                </tr>    
                            @endforeach
                        
                        </tbody>
                    </table>
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
    

    <script>
    var _token = $('meta[name=_token]').attr('content');
    var $pieData = [];
    var network = 0;
    var summary = 0;
    var unaccountedTotal = 0;
    var bar = AmCharts.makeChart( "barchart", {
    "type": "serial",
    "theme": "light",
    "dataProvider": [],
    "minWidth": 200,
    "maxWidth": 400,
    "maxHeight": 400,
    "minHeight": 200,
    "overrides": {
        "precision": 2,
    "legend": {
      "enabled": false
    },
    "valueAxes": [ {
        "gridColor": "#FFFFFF",
        "gridAlpha": 0.2,
        "dashLength": 0,
        "inside": true
    } ],
    },
    "gridAboveGraphs": true,
    "startDuration": 1,
    "graphs": [ {
        "balloonText": "[[category]]: <b>([[value]]%)</b>",
        "fillAlphas": 0.8,
        "lineAlpha": 0.2,
        "type": "column",
        "valueField": "visits"
    } ],
    "chartCursor": {
        "categoryBalloonEnabled": false,
        "cursorAlpha": 0,
        "zoomable": false
    },
    "categoryField": "country",
    "categoryAxis": {
        "gridPosition": "start",
        "gridAlpha": 0,
        "tickPosition": "start",
        "tickLength": 20
    },
    "responsive": {
        "enabled": true
    },
    "export": {
        "enabled": true
    }

    } );
   
    newPool(bar);
    var firstpercentage = 0;
    var minandopercentage = 0;


    function newPool(piec){
        $.ajax({
            url: 'superiorcoinpool/api',
            type: 'GET',
            dataType: 'json',
            data: {_token: _token},
        })
        .done(function(data) {
            // console.log(piec);
            $('#pool_value1').html(data.newpool);
            $('#minando_value').html(data.minandoando);
            $('#crypto_value').html(data.cryptomineros);
            $('#network_value').html(data.newNetwork);
            $('#unaccounted').html(data.unaccountedTotal);
            $('#unaccount_percent').html(data.unaccountedPercent.toFixed(2)+ "%");
            firstpercentage = data.newpool_percentage;
            minandopercentage = data.minan_percentage;
            cryptopercentage = data.crypto_percentage;
            
            piec.dataProvider =[ {
                "country": "Superiorcoinpool",
                "visits": firstpercentage.toFixed(2)
            }, {
                "country": "SUP.superpools",
                "visits": 0
            }, {
                "country": "SUP.minandoando",
                "visits": minandopercentage.toFixed(2)
            }, {
                "country": "SUP.cryptomineros",
                "visits": cryptopercentage.toFixed(2)
            }, {
                "country": "SUP.makebitcoin",
                "visits": 0
            }, {
                "country": "SUP.mineventure",
                "visits": 0
            } ]
           piec.validateData();
        })
        .fail(function(data) {
            console.log("error");
        });
    }

    var chart = AmCharts.makeChart("chartdiv", {
    "theme": "light",
    "type": "gauge",
    "axes": [{
        "topTextFontSize": 20,
        "topTextYOffset": 70,
        "axisColor": "#31d6ea",
        "axisThickness": 1,
        "endValue": 100,
        "gridInside": true,
        "inside": true,
        "radius": "50%",
        "valueInterval": 10,
        "tickColor": "#67b7dc",
        "startAngle": -90,
        "endAngle": 90,
        "unit": "%",
        "bandOutlineAlpha": 0,
        "bands": [{
        "color": "#0080ff",
        "endValue": 100,
        "innerRadius": "105%",
        "radius": "170%",
        "gradientRatio": [0.5, 0, -0.5],
        "startValue": 0
        }, {
        "color": "#3cd3a3",
        "endValue": 0,
        "innerRadius": "105%",
        "radius": "170%",
        "gradientRatio": [0.5, 0, -0.5],
        "startValue": 0
        }]
    }],
    "arrows": [{
        "alpha": 1,
        "innerRadius": "35%",
        "nailRadius": 0,
        "radius": "170%"
    }]
    });

    setInterval(randomValue, 2000);

    // set random value
    function randomValue() {
    var values = firstpercentage.toFixed(2);
    chart.arrows[0].setValue(values);
    chart.axes[0].setTopText(values + " %");
    // adjust darker band to new value
    chart.axes[0].bands[1].setEndValue(values);
    }

    var minando = AmCharts.makeChart("minandochart", {
    "theme": "light",
    "type": "gauge",
    "axes": [{
        "topTextFontSize": 20,
        "topTextYOffset": 70,
        "axisColor": "#31d6ea",
        "axisThickness": 1,
        "endValue": 100,
        "gridInside": true,
        "inside": true,
        "radius": "50%",
        "valueInterval": 10,
        "tickColor": "#67b7dc",
        "startAngle": -90,
        "endAngle": 90,
        "unit": "%",
        "bandOutlineAlpha": 0,
        "bands": [{
        "color": "#0080ff",
        "endValue": 100,
        "innerRadius": "105%",
        "radius": "170%",
        "gradientRatio": [0.5, 0, -0.5],
        "startValue": 0
        }, {
        "color": "#3cd3a3",
        "endValue": 0,
        "innerRadius": "105%",
        "radius": "170%",
        "gradientRatio": [0.5, 0, -0.5],
        "startValue": 0
        }]
    }],
    "arrows": [{
        "alpha": 1,
        "innerRadius": "35%",
        "nailRadius": 0,
        "radius": "170%"
    }]
    });

    setInterval(MinandoValue, 2000);

    // set random value
    function MinandoValue() {
    var value = minandopercentage.toFixed(2);
    minando.arrows[0].setValue(value);
    minando.axes[0].setTopText(value + " %");
    // adjust darker band to new value
    minando.axes[0].bands[1].setEndValue(value);
    }

    var cryptomineros = AmCharts.makeChart("cryptomineroschart", {
    "theme": "light",
    "type": "gauge",
    "axes": [{
        "topTextFontSize": 20,
        "topTextYOffset": 70,
        "axisColor": "#31d6ea",
        "axisThickness": 1,
        "endValue": 100,
        "gridInside": true,
        "inside": true,
        "radius": "50%",
        "valueInterval": 10,
        "tickColor": "#67b7dc",
        "startAngle": -90,
        "endAngle": 90,
        "unit": "%",
        "bandOutlineAlpha": 0,
        "bands": [{
        "color": "#0080ff",
        "endValue": 100,
        "innerRadius": "105%",
        "radius": "170%",
        "gradientRatio": [0.5, 0, -0.5],
        "startValue": 0
        }, {
        "color": "#3cd3a3",
        "endValue": 0,
        "innerRadius": "105%",
        "radius": "170%",
        "gradientRatio": [0.5, 0, -0.5],
        "startValue": 0
        }]
    }],
    "arrows": [{
        "alpha": 1,
        "innerRadius": "35%",
        "nailRadius": 0,
        "radius": "170%"
    }]
    });

    setInterval(CryptominerosValue, 2000);

    // set random value
    function CryptominerosValue() {
    var value = cryptopercentage.toFixed(2);
    cryptomineros.arrows[0].setValue(value);
    cryptomineros.axes[0].setTopText(value + " %");
    // adjust darker band to new value
    cryptomineros.axes[0].bands[1].setEndValue(value);
    }


    var superpools = AmCharts.makeChart("superpoolschart", {
    "theme": "light",
    "type": "gauge",
    "axes": [{
        "topTextFontSize": 20,
        "topTextYOffset": 70,
        "axisColor": "#31d6ea",
        "axisThickness": 1,
        "endValue": 100,
        "gridInside": true,
        "inside": true,
        "radius": "50%",
        "valueInterval": 10,
        "tickColor": "#67b7dc",
        "startAngle": -90,
        "endAngle": 90,
        "unit": "%",
        "bandOutlineAlpha": 0,
        "bands": [{
        "color": "#0080ff",
        "endValue": 100,
        "innerRadius": "105%",
        "radius": "170%",
        "gradientRatio": [0.5, 0, -0.5],
        "startValue": 0
        }, {
        "color": "#3cd3a3",
        "endValue": 0,
        "innerRadius": "105%",
        "radius": "170%",
        "gradientRatio": [0.5, 0, -0.5],
        "startValue": 0
        }]
    }],
    "arrows": [{
        "alpha": 1,
        "innerRadius": "35%",
        "nailRadius": 0,
        "radius": "170%"
    }]
    });

    setInterval(SuperpoolsValue, 2000);

    // set random value
    function SuperpoolsValue() {
    var value = "0.00";
    superpools.arrows[0].setValue(value);
    superpools.axes[0].setTopText(value + " %");
    // adjust darker band to new value
    superpools.axes[0].bands[1].setEndValue(value);
    }

    var makebitcoin = AmCharts.makeChart("makebitcoinchart", {
    "theme": "light",
    "type": "gauge",
    "axes": [{
        "topTextFontSize": 20,
        "topTextYOffset": 70,
        "axisColor": "#31d6ea",
        "axisThickness": 1,
        "endValue": 100,
        "gridInside": true,
        "inside": true,
        "radius": "50%",
        "valueInterval": 10,
        "tickColor": "#67b7dc",
        "startAngle": -90,
        "endAngle": 90,
        "unit": "%",
        "bandOutlineAlpha": 0,
        "bands": [{
        "color": "#0080ff",
        "endValue": 100,
        "innerRadius": "105%",
        "radius": "170%",
        "gradientRatio": [0.5, 0, -0.5],
        "startValue": 0
        }, {
        "color": "#3cd3a3",
        "endValue": 0,
        "innerRadius": "105%",
        "radius": "170%",
        "gradientRatio": [0.5, 0, -0.5],
        "startValue": 0
        }]
    }],
    "arrows": [{
        "alpha": 1,
        "innerRadius": "35%",
        "nailRadius": 0,
        "radius": "170%"
    }]
    });

    setInterval(MakebitcoinValue, 2000);

    // set random value
    function MakebitcoinValue() {
    var value = "0.00";
    makebitcoin.arrows[0].setValue(value);
    makebitcoin.axes[0].setTopText(value + " %");
    // adjust darker band to new value
    makebitcoin.axes[0].bands[1].setEndValue(value);
    }


    var mineventure = AmCharts.makeChart("mineventurechart", {
    "theme": "light",
    "type": "gauge",
    "axes": [{
        "topTextFontSize": 20,
        "topTextYOffset": 70,
        "axisColor": "#31d6ea",
        "axisThickness": 1,
        "endValue": 100,
        "gridInside": true,
        "inside": true,
        "radius": "50%",
        "valueInterval": 10,
        "tickColor": "#67b7dc",
        "startAngle": -90,
        "endAngle": 90,
        "unit": "%",
        "bandOutlineAlpha": 0,
        "bands": [{
        "color": "#0080ff",
        "endValue": 100,
        "innerRadius": "105%",
        "radius": "170%",
        "gradientRatio": [0.5, 0, -0.5],
        "startValue": 0
        }, {
        "color": "#3cd3a3",
        "endValue": 0,
        "innerRadius": "105%",
        "radius": "170%",
        "gradientRatio": [0.5, 0, -0.5],
        "startValue": 0
        }]
    }],
    "arrows": [{
        "alpha": 1,
        "innerRadius": "35%",
        "nailRadius": 0,
        "radius": "170%"
    }]
    });

    setInterval(MineventureValue, 2000);

    // set random value
    function MineventureValue() {
    var value = "0.00";
    mineventure.arrows[0].setValue(value);
    mineventure.axes[0].setTopText(value + " %");
    // adjust darker band to new value
    mineventure.axes[0].bands[1].setEndValue(value);
    }
    </script>

    <script>
        // $(document).ready( function () {
            
        // });

        function getNetwork(){
            $.ajax({
                url: `/networkstats/api`,
                type: 'GET',
                dataType: 'json',
                data: {_token: _token},
            })
            .done(function(data) {
                $('#myTable tbody').html('');
                $.each(data.chuck_days, function(key, val){
                    $row = `<tr>
                        <td>Day ${30 - key} => ${val.latest_start} - ${val.latest_end}</td>
                        <td>${val.count}</td>
                    </tr>`;
                    $('#myTable tbody').append($row);
                });
                // table.draw();
                // console.log($row);
            })
            .fail(function(data) {
                console.log("error");
            });
        }

        function newNetwork(){
            $.ajax({
                url: '/newnetworks/api',
                type: 'GET',
                dataType: 'json',
                data: {_token: _token},
            })
            .done(function(data) {
                // console.log(data);
                $('#pie_values').text(data.newNetwork);
            })
            .fail(function(data) {
                console.log("error");
            });
        }
    </script>
</html>