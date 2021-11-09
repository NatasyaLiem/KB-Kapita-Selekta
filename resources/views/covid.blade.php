@extends('isi.home') 

@section('container')
<div id="piechart" style="width: auto; height: 700px;"></div>

<script type="text/javascript">
    window.onload = function() {
        google.charts.load('current', {'packages' : ['corechart']});
        google.charts.setOnLoadCallback(function() {drawChart()});    
    };

    function drawChart() {
        result=JSON.parse('<?php echo $total;?>');
        console.log(result);
            
        var data = new google.visualization.DataTable();
            
        data.addColumn('string', 'Negara');
        data.addColumn('number', 'Jumlah');

        var array=[];

        $.each(result, function(i, obj) {
            array.push([obj[0], parseInt(obj[1])]);
        });

        data.addRows(array);
        //data.addRows(result);

        console.log(array);

        //menggambar pie chart
        var options = {
            title: 'Total Kasus Setiap Negara'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
    };
</script>


@endsection