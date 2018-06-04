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

$(function() {
    
    var last = $('.hidden-last').val();
    var input_today = $('#datepicker .form-control').val(moment().format('MM-DD-YYYY'));
    var last_date = new Date(last*1000);

    $('#datepicker').datepicker({
        format: 'mm-dd-yyyy',
        endDate: '+0d',
        startDate: last_date,
        todayHighlight: true,
        setDate: new Date(<?php echo date("Y,m,d"); ?>)
    }).on('changeDate', function(ev) {
        $('.datepicker-dropdown').hide();
        var value = $("#datepicker .form-control").datepicker("getUTCDate");
        $.ajax({
            url: '/date',
            type: 'POST',
            data: {_token: _token, date: new Date(value).getTime()},
        }).done(function(data) {
            var tr;
            $.each(data, function(key, val) {
                tr += "<tr><td>"+ moment(val.today*1000).format('MM-DD-YYYY') +"</td><td style='text-align: center;'>"+ val.totalhit +"</td></tr>";
            });
            $('#myTable tbody').html(tr);
        })
        .fail(function(data) {
            console.log("error");
        });
    });


    $('.sortYr button').click(function(){
        $.ajax({
            url: '/sort-year',
            type: 'GET',
            data: {_token: _token},
        }).done(function(data) {
            var tr;
            $.each(data, function(key, val) {
                tr += "<tr><td>"+ val.year +"</td><td style='text-align: center;'>"+ val.totalhit +"</td></tr>";
            });
            $('#myTable tbody').html(tr);
        })
        .fail(function(data) {
            console.log("error");
        });
    })
});