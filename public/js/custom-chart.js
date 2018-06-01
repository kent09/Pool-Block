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
            "topTextColor": "#2a9acc",
            "topTextFontSize": 24,
            "topTextYOffset": 200,
            "axisColor": "#67b7dc",
            "axisThickness": 1,
            "endValue": 100,
            // "gridInside": false,
            "inside": false,
            "radius": "80%",
            "valueInterval": 20,
            "tickColor": "#67b7dc",
            // "startAngle": -90,
            // "endAngle": 100,
            "unit": "%",
            // "bandOutlineAlpha": 0,
            // "bands": [{
            // "color": "#0080ff",
            // "endValue": 100,
            // "innerRadius": "105%",
            // "radius": "170%",
            // "gradientRatio": [0.5, 0, -0.5],
            // "startValue": 0
            // }, {
            // "color": "#3cd3a3",
            // "endValue": 0,
            // "innerRadius": "105%",
            // "radius": "170%",
            // "gradientRatio": [0.5, 0, -0.5],
            // "startValue": 0
            // }]
        }],
        "arrows": [{
            "nailBorderThickness": 10,
            "alpha": 1,
            "innerRadius": "20%",
            "nailRadius": 0,
            "radius": "90%"
        }]
    });

    setInterval(randomValue, 2000);

    // set random value
    function randomValue() {
    var values = firstpercentage.toFixed(2);
    chart.arrows[0].setValue(values);
    chart.axes[0].setTopText(values + " %");
    // adjust darker band to new value
    // chart.axes[0].bands[1].setEndValue(values);
    }

    var minando = AmCharts.makeChart("minandochart", {
        "theme": "light",
        "type": "gauge",
        "axes": [{
            "topTextColor": "#2a9acc",
            "topTextFontSize": 24,
            "topTextYOffset": 200,
            "axisColor": "#67b7dc",
            "axisThickness": 1,
            "endValue": 100,
            // "gridInside": false,
            "inside": false,
            "radius": "80%",
            "valueInterval": 20,
            "tickColor": "#67b7dc",
            // "startAngle": -90,
            // "endAngle": 100,
            "unit": "%",
            // "bandOutlineAlpha": 0,
            // "bands": [{
            // "color": "#0080ff",
            // "endValue": 100,
            // "innerRadius": "105%",
            // "radius": "170%",
            // "gradientRatio": [0.5, 0, -0.5],
            // "startValue": 0
            // }, {
            // "color": "#3cd3a3",
            // "endValue": 0,
            // "innerRadius": "105%",
            // "radius": "170%",
            // "gradientRatio": [0.5, 0, -0.5],
            // "startValue": 0
            // }]
        }],
        "arrows": [{
            "nailBorderThickness": 10,
            "alpha": 1,
            "innerRadius": "20%",
            "nailRadius": 0,
            "radius": "90%"
        }]
    });

    setInterval(MinandoValue, 2000);

    // set random value
    function MinandoValue() {
    var value = minandopercentage.toFixed(2);
    minando.arrows[0].setValue(value);
    minando.axes[0].setTopText(value + " %");
    // adjust darker band to new value
    // minando.axes[0].bands[1].setEndValue(value);
    }

    var cryptomineros = AmCharts.makeChart("cryptomineroschart", {
        "theme": "light",
        "type": "gauge",
        "axes": [{
            "topTextColor": "#2a9acc",
            "topTextFontSize": 24,
            "topTextYOffset": 200,
            "axisColor": "#67b7dc",
            "axisThickness": 1,
            "endValue": 100,
            // "gridInside": false,
            "inside": false,
            "radius": "80%",
            "valueInterval": 20,
            "tickColor": "#67b7dc",
            // "startAngle": -90,
            // "endAngle": 100,
            "unit": "%",
            // "bandOutlineAlpha": 0,
            // "bands": [{
            // "color": "#0080ff",
            // "endValue": 100,
            // "innerRadius": "105%",
            // "radius": "170%",
            // "gradientRatio": [0.5, 0, -0.5],
            // "startValue": 0
            // }, {
            // "color": "#3cd3a3",
            // "endValue": 0,
            // "innerRadius": "105%",
            // "radius": "170%",
            // "gradientRatio": [0.5, 0, -0.5],
            // "startValue": 0
            // }]
        }],
        "arrows": [{
            "nailBorderThickness": 10,
            "alpha": 1,
            "innerRadius": "20%",
            "nailRadius": 0,
            "radius": "90%"
        }]
    });

    setInterval(CryptominerosValue, 2000);

    // set random value
    function CryptominerosValue() {
    var value = cryptopercentage.toFixed(2);
    cryptomineros.arrows[0].setValue(value);
    cryptomineros.axes[0].setTopText(value + " %");
    // adjust darker band to new value
    // cryptomineros.axes[0].bands[1].setEndValue(value);
    }


    var superpools = AmCharts.makeChart("superpoolschart", {
        "theme": "light",
        "type": "gauge",
        "axes": [{
            "topTextColor": "#2a9acc",
            "topTextFontSize": 24,
            "topTextYOffset": 200,
            "axisColor": "#67b7dc",
            "axisThickness": 1,
            "endValue": 100,
            // "gridInside": false,
            "inside": false,
            "radius": "80%",
            "valueInterval": 20,
            "tickColor": "#67b7dc",
            // "startAngle": -90,
            // "endAngle": 100,
            "unit": "%",
            // "bandOutlineAlpha": 0,
            // "bands": [{
            // "color": "#0080ff",
            // "endValue": 100,
            // "innerRadius": "105%",
            // "radius": "170%",
            // "gradientRatio": [0.5, 0, -0.5],
            // "startValue": 0
            // }, {
            // "color": "#3cd3a3",
            // "endValue": 0,
            // "innerRadius": "105%",
            // "radius": "170%",
            // "gradientRatio": [0.5, 0, -0.5],
            // "startValue": 0
            // }]
        }],
        "arrows": [{
            "nailBorderThickness": 10,
            "alpha": 1,
            "innerRadius": "20%",
            "nailRadius": 0,
            "radius": "90%"
        }]
    });

    setInterval(SuperpoolsValue, 2000);

    // set random value
    function SuperpoolsValue() {
    var value = "0.00";
    superpools.arrows[0].setValue(value);
    superpools.axes[0].setTopText(value + " %");
    // adjust darker band to new value
    // superpools.axes[0].bands[1].setEndValue(value);
    }

    var makebitcoin = AmCharts.makeChart("makebitcoinchart", {
        "theme": "light",
        "type": "gauge",
        "axes": [{
            "topTextColor": "#2a9acc",
            "topTextFontSize": 24,
            "topTextYOffset": 200,
            "axisColor": "#67b7dc",
            "axisThickness": 1,
            "endValue": 100,
            // "gridInside": false,
            "inside": false,
            "radius": "80%",
            "valueInterval": 20,
            "tickColor": "#67b7dc",
            // "startAngle": -90,
            // "endAngle": 100,
            "unit": "%",
            // "bandOutlineAlpha": 0,
            // "bands": [{
            // "color": "#0080ff",
            // "endValue": 100,
            // "innerRadius": "105%",
            // "radius": "170%",
            // "gradientRatio": [0.5, 0, -0.5],
            // "startValue": 0
            // }, {
            // "color": "#3cd3a3",
            // "endValue": 0,
            // "innerRadius": "105%",
            // "radius": "170%",
            // "gradientRatio": [0.5, 0, -0.5],
            // "startValue": 0
            // }]
        }],
        "arrows": [{
            "nailBorderThickness": 10,
            "alpha": 1,
            "innerRadius": "20%",
            "nailRadius": 0,
            "radius": "90%"
        }]
    });

    setInterval(MakebitcoinValue, 2000);

    // set random value
    function MakebitcoinValue() {
    var value = "0.00";
    makebitcoin.arrows[0].setValue(value);
    makebitcoin.axes[0].setTopText(value + " %");
    // adjust darker band to new value
    // makebitcoin.axes[0].bands[1].setEndValue(value);
    }


    var mineventure = AmCharts.makeChart("mineventurechart", {
        "theme": "light",
        "type": "gauge",
        "axes": [{
            "topTextColor": "#2a9acc",
            "topTextFontSize": 24,
            "topTextYOffset": 200,
            "axisColor": "#67b7dc",
            "axisThickness": 1,
            "endValue": 100,
            // "gridInside": false,
            "inside": false,
            "radius": "80%",
            "valueInterval": 20,
            "tickColor": "#67b7dc",
            // "startAngle": -90,
            // "endAngle": 100,
            "unit": "%",
            // "bandOutlineAlpha": 0,
            // "bands": [{
            // "color": "#0080ff",
            // "endValue": 100,
            // "innerRadius": "105%",
            // "radius": "170%",
            // "gradientRatio": [0.5, 0, -0.5],
            // "startValue": 0
            // }, {
            // "color": "#3cd3a3",
            // "endValue": 0,
            // "innerRadius": "105%",
            // "radius": "170%",
            // "gradientRatio": [0.5, 0, -0.5],
            // "startValue": 0
            // }]
        }],
        "arrows": [{
            "nailBorderThickness": 10,
            "alpha": 1,
            "innerRadius": "20%",
            "nailRadius": 0,
            "radius": "90%"
        }]
    });

    setInterval(MineventureValue, 2000);

    // set random value
    function MineventureValue() {
    var value = "0.00";
    mineventure.arrows[0].setValue(value);
    mineventure.axes[0].setTopText(value + " %");
    // adjust darker band to new value
    // mineventure.axes[0].bands[1].setEndValue(value);
    }