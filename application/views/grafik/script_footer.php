<script>
function tampilkanGrafik() {

    $(document).ready(function() {
        $("#grafik").hide();
        $("#loading").show();

        $.ajax({
            url: "<?= site_url('grafik/loadgrafik/') ?>",
            dataType:"json",
            type: "get",
            success: function(response) {
                $("#grafik").show();
                $("#loading").hide();
                if (response.status === false) {
                    alert(response.message);
                    $("#grafik").hide();
                } else {
                    $("#grafik").show();

                    var chartData = {
                        labels: response.area,
                        datasets: [{
                            label: 'Data Area',
                            backgroundColor: 'rgba(255, 99, 132, 0.4)' ,
                            fillColor: 'rgba(210, 214, 222, 1)',
                            strokeColor: 'rgba(210, 214, 222, 1)',
                            pointColor: 'rgba(210, 214, 222, 1)',
                            pointStrokeColor: '#c1c7d1',
                            pointHighlightFill: '#fff',
                            pointHighlightStroke: 'rgba(220,220,220,1)',
                            data: response.rata
                        }]
                    };
                    drawGrafik(chartData);
                }

            },
            error: function(jqXHR, textStatus, errorThrown) {
                $("#loading").hide();
                alert("Error : " + textStatus);
            }
        });
    });

}
function drawGrafik(chartData) {
    $('#barChart').remove(); // this is my <canvas> element
    $('#chart').append('<canvas id="barChart" style="height:300px"><canvas>');

    var barOptions = {
        events: false,
        showTooltips: true,
        maintainAspectRatio: false,
        animation: {
            duration: 500,
            easing: "easeOutQuart",
            onComplete: function() {
                var ctx = this.chart.ctx;
                ctx.font = Chart.helpers.fontString(Chart.defaults.global.defaultFontFamily, 'normal', Chart
                    .defaults.global.defaultFontFamily);
                ctx.textAlign = 'left';
                ctx.textBaseline = 'bottom';

                this.data.datasets.forEach(function(dataset) {
                    
                    for (var i = 0; i < dataset.data.length; i++) {
                        var model = dataset._meta[Object.keys(dataset._meta)[0]].data[i]._model,
                            scale_max = dataset._meta[Object.keys(dataset._meta)[0]].data[i]._yScale
                            .maxHeight;
                        left = dataset._meta[Object.keys(dataset._meta)[0]].data[i]._xScale.left;
                        offset = dataset._meta[Object.keys(dataset._meta)[0]].data[i]._xScale
                            .longestLabelWidth;
                        ctx.fillStyle = '#444';
                        var y_pos = model.y - 5;
                        var label = model.label;
                        // Make sure data value does not get overflown and hidden
                        // when the bar's value is too close to max value of scale
                        // Note: The y value is reverse, it counts from top down
                        if ((scale_max - model.y) / scale_max >= 0.93)
                            y_pos = model.y + 20;
                        // ctx.fillText(dataset.data[i], model.x, y_pos);
                        ctx.fillText(dataset.data[i], left + 10, model.y + 8);
                    }
                });
            }
        }
    };

    var ctx = document.getElementById("barChart").getContext("2d");
    var myBar = new Chart(ctx, {
        type: 'horizontalBar',
        data: chartData,
        options: barOptions
    });
}
function tampilkanGrafik2() {

    $(document).ready(function() {
        $("#grafik2").hide();
        $("#loading2").show();

        $.ajax({
            url: "<?= site_url('grafik/loadgrafik2/') ?>",
            dataType:"json",
            type: "get",
            success: function(response) {
                $("#grafik2").show();
                $("#loading2").hide();
                if (response.status === false) {
                    alert(response.message);
                    $("#grafik2").hide();
                } else {
                    $("#grafik2").show();

                    var chartData = {
                        labels: response.area,
                        datasets: [{
                            label: 'Data Area',
                            backgroundColor: 'rgba(255, 99, 132, 0.4)' ,
                            fillColor: 'rgba(210, 214, 222, 1)',
                            strokeColor: 'rgba(210, 214, 222, 1)',
                            pointColor: 'rgba(210, 214, 222, 1)',
                            pointStrokeColor: '#c1c7d1',
                            pointHighlightFill: '#fff',
                            pointHighlightStroke: 'rgba(220,220,220,1)',
                            data: response.rata
                        }]
                    };
                    drawGrafik2(chartData);
                }

            },
            error: function(jqXHR, textStatus, errorThrown) {
                $("#loading2").hide();
                alert("Error : " + textStatus);
            }
        });
    });

}
function drawGrafik2(chartData) {
    $('#barChart2').remove(); // this is my <canvas> element
    $('#chart2').append('<canvas id="barChart" style="height:300px"><canvas>');

    var barOptions = {
        events: false,
        showTooltips: true,
        maintainAspectRatio: false,
        animation: {
            duration: 500,
            easing: "easeOutQuart",
            onComplete: function() {
                var ctx = this.chart.ctx;
                ctx.font = Chart.helpers.fontString(Chart.defaults.global.defaultFontFamily, 'normal', Chart
                    .defaults.global.defaultFontFamily);
                ctx.textAlign = 'left';
                ctx.textBaseline = 'bottom';

                this.data.datasets.forEach(function(dataset) {
                    
                    for (var i = 0; i < dataset.data.length; i++) {
                        var model = dataset._meta[Object.keys(dataset._meta)[0]].data[i]._model,
                            scale_max = dataset._meta[Object.keys(dataset._meta)[0]].data[i]._yScale
                            .maxHeight;
                        left = dataset._meta[Object.keys(dataset._meta)[0]].data[i]._xScale.left;
                        offset = dataset._meta[Object.keys(dataset._meta)[0]].data[i]._xScale
                            .longestLabelWidth;
                        ctx.fillStyle = '#444';
                        var y_pos = model.y - 5;
                        var label = model.label;
                        // Make sure data value does not get overflown and hidden
                        // when the bar's value is too close to max value of scale
                        // Note: The y value is reverse, it counts from top down
                        if ((scale_max - model.y) / scale_max >= 0.93)
                            y_pos = model.y + 20;
                        // ctx.fillText(dataset.data[i], model.x, y_pos);
                        ctx.fillText(dataset.data[i], left + 10, model.y + 8);
                    }
                });
            }
        }
    };

    var ctx = document.getElementById("barChart2").getContext("2d");
    var myBar = new Chart(ctx, {
        type: 'horizontalBar',
        data: chartData,
        options: barOptions
    });
}
function _drawGrafik(areaChartData) {
    $('#barChart').remove(); // this is my <canvas> element
    $('#chart').append('<canvas id="barChart" style="height:300px"><canvas>');
    var barChartCanvas = $('#barChart').get(0).getContext('2d');
    var barChart = new Chart(barChartCanvas);
    var barChartData = areaChartData;
    barChartData.datasets[0].fillColor = '#00a65a';
    barChartData.datasets[0].strokeColor = '#00a65a';
    barChartData.datasets[0].pointColor = '#00a65a';

    var barChartOptions = {
        //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
        scaleBeginAtZero: true,
        //Boolean - Whether grid lines are shown across the chart
        scaleShowGridLines: true,
        //String - Colour of the grid lines
        scaleGridLineColor: 'rgba(0,0,0,.05)',
        //Number - Width of the grid lines
        scaleGridLineWidth: 1,
        //Boolean - Whether to show horizontal lines (except X axis)
        scaleShowHorizontalLines: true,
        //Boolean - Whether to show vertical lines (except Y axis)
        scaleShowVerticalLines: true,
        //Boolean - If there is a stroke on each bar
        barShowStroke: true,
        //Number - Pixel width of the bar stroke
        barStrokeWidth: 2,
        //Number - Spacing between each of the X value sets
        barValueSpacing: 5,
        //Number - Spacing between data sets within X values
        barDatasetSpacing: 1,
        //String - A legend template
        legendTemplate: '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].fillColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
        //Boolean - whether to make the chart responsive
        responsive: true,
        maintainAspectRatio: true,
        
    }

    barChartOptions.datasetFill = false;
    barChart.Bar(barChartData, barChartOptions);
}

$(document).ready(function() {
    $('.select2').select2();
    tampilkanGrafik();
});
</script>