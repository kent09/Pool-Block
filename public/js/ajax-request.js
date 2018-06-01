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