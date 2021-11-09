@extends('isi.home') 

@section('container')
<div class="jumbotron jumbotron-fluid">
    <div class="container">
        <h1 class="display-4" id="negara">Negara</h1>
        <br>
        <p class="lead" id="populasi">Populasi : </p>
        <p class="lead" id="updated">Last Updated : </p>
    </div>
</div>

<div class="row">
    <div id="pie_tot" style="width: 1200px; height: 500px;"></div>
    <br>
</div>

<div class="row">
    <div id="line_tot_kasus" style="width: 1200px; height: 500px;"></div>
    <br>
</div>

<div class="row">
    <div id="line_new_kasus" style="width: 1200px; height: 500px;"></div>
    <br>
</div>

<div class="row">
    <div id="line_tot_death" style="width: 1200px; height: 500px;"></div>
    <br>
</div>

<div class="row">
    <div id="line_new_death" style="width: 1200px; height: 500px;"></div>
    <br>
</div>

<div class="row">
    <div id="line_vaccinated" style="width: 1200px; height: 500px;"></div>
    <br>
</div>

<div class="row">
    <div id="line_fvaccinated" style="width: 1200px; height: 500px;"></div>
    <br>
</div>

<script type="text/javascript">
    window.onload = function() {
        google.charts.load('current', {'packages' : ['corechart']});
        google.charts.setOnLoadCallback(function() {drawChart()});    
    };

    function drawChart() {
        result=JSON.parse('<?php echo $data;?>');
        console.log(result);

        var array_tot_case=[];
        var array_tot_death=[];
        var array_new_case=[];
        var array_new_death=[];
        var array_vaccinated=[];
        var array_fvaccinated=[];
        var array_population=[];
        var total=[];

        $.each(result, function(i, obj) {
            negara=obj[0];
            array_tot_case.push([obj[1], parseInt(obj[2])]);
            array_tot_death.push([obj[1], parseInt(obj[4])]);
            array_new_case.push([obj[1], parseInt(obj[3])]);
            array_new_death.push([obj[1], parseInt(obj[5])]);
            array_vaccinated.push([obj[1], parseInt(obj[6])]);
            array_fvaccinated.push([obj[1], parseInt(obj[7])]);
            array_population.push([obj[1], parseInt(obj[8])]);
        });

        document.getElementById('negara').innerHTML = "Negara " + negara;
        document.getElementById('populasi').innerHTML = "Populasi :  " + array_population[array_population.length-1][1];
        document.getElementById('updated').innerHTML = "Last Updated :  " + array_population[array_population.length-1][0];

        //menampilkan pie chart kematian dan banyak kasus
        var data = new google.visualization.DataTable();

        tot_case = array_tot_case[array_tot_case.length-1];
        tot_death = array_tot_death[array_tot_death.length-1];

        total.push(["Total Kasus", tot_case[1]]);
        total.push(["Total Death", tot_death[1]]);

        data.addColumn('string', 'Total');
        data.addColumn('number', 'Jumlah');

        console.log(total);

        data.addRows(total);

        var options = {
            title: 'Perbandingan Total Kasus dan Total Death'
        };

        var chart = new google.visualization.PieChart(document.getElementById('pie_tot'));

        chart.draw(data, options);


        //menampilkan line chart kasus
        var data = new google.visualization.DataTable();
        
        data.addColumn('string', 'Tanggal');
        data.addColumn('number', 'Jumlah');

        data.addRows(array_tot_case);

        var options = {
            title: 'Perkembangan Total Kasus',
            legend: { position: 'none' },
        };

        var chart = new google.visualization.LineChart(document.getElementById('line_tot_kasus'));
        chart.draw(data, options);

        //menampilkan line chart new kasus
        var data = new google.visualization.DataTable();
        
        data.addColumn('string', 'Tanggal');
        data.addColumn('number', 'Jumlah');

        data.addRows(array_new_case);

        var options = {
            title: 'Perkembangan Total Kasus Baru',
            legend: { position: 'none' },
        };

        var chart = new google.visualization.LineChart(document.getElementById('line_new_kasus'));
        chart.draw(data, options);

        //menampilkan line chart death
        var data = new google.visualization.DataTable();
        
        data.addColumn('string', 'Tanggal');
        data.addColumn('number', 'Jumlah');

        data.addRows(array_tot_death);

        var options = {
            title: 'Perkembangan Total Kematian',
            legend: { position: 'none' },
        };

        var chart = new google.visualization.LineChart(document.getElementById('line_tot_death'));
        chart.draw(data, options);


        //menampilkan line chart new death
        var data = new google.visualization.DataTable();
        
        data.addColumn('string', 'Tanggal');
        data.addColumn('number', 'Jumlah');

        data.addRows(array_new_death);

        var options = {
            title: 'Perkembangan Total Kematian Baru',
            legend: { position: 'none' },
        };

        var chart = new google.visualization.LineChart(document.getElementById('line_new_death'));
        chart.draw(data, options);


        //menampilkan line chart vaksinasi
        var data = new google.visualization.DataTable();
        
        data.addColumn('string', 'Tanggal');
        data.addColumn('number', 'Jumlah');

        data.addRows(array_vaccinated);

        var options = {
            title: 'Perkembangan Total Vaksinasi',
            legend: { position: 'none' },
        };

        var chart = new google.visualization.LineChart(document.getElementById('line_vaccinated'));
        chart.draw(data, options);


        //menampilkan line chart fully vaksinasi
        var data = new google.visualization.DataTable();
        
        data.addColumn('string', 'Tanggal');
        data.addColumn('number', 'Jumlah');

        data.addRows(array_fvaccinated);

        var options = {
            title: 'Perkembangan Total Vaksinasi Penuh',
            legend: { position: 'none' },
        };

        var chart = new google.visualization.LineChart(document.getElementById('line_fvaccinated'));
        chart.draw(data, options);


    };
</script>

@endsection