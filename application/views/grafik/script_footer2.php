<script>

function tampilkanGrafik() {

    $(document).ready(function() {
        $("#grafik").hide();
        $("#loading").show();

        $.ajax({
            url: "<?= site_url('grafik/loadgrafik2/') ?>",
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
$(document).ready(function() {
    $('.select2').select2();
    tampilkanGrafik();
});
</script>