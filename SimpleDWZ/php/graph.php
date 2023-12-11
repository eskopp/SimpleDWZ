<?php
    include __DIR__."/graph_content.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>Internal Rating</title>
    <link rel="icon" href="../img/logo.png">
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../style/old.css">

</head>

<body>
    <div class="container">
    <h1><center>Internal Rating</center></h1><br><hr>
    <div class="container">
    <h2>Development</h2>
    <canvas id="myChart"></canvas>

    <div id="tooltip"></div>

    <script>
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['00', '01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23', '24', '25', '26', '27', '28', '29', '30', '31', '32', '33', '34', '35', '36', '37', '38', '39', '40', '41', '42', '43', '44', '45', '46', '47', '48', '49', '50'],
                datasets: [
                    <?php echo generateCodeBlocks(); ?>
                ]
            },
            options: {
                responsive: true,
                plugins: {
                    tooltip: {
                        enabled: false,
                        external: function(context) {
                            var tooltip = document.getElementById('tooltip');
                            if (!tooltip) {
                                tooltip = document.createElement('div');
                                tooltip.id = 'tooltip';
                                document.body.appendChild(tooltip);
                            }
                            return tooltip;
                        },
                        onHover: function(event, tooltipItem, context) {
                            var tooltip = document.getElementById('tooltip');
                            if (tooltipItem.length > 0) {
                                var datasetIndex = tooltipItem[0].datasetIndex;
                                var index = tooltipItem[0].index;
                                var datasetLabel = context.chart.data.datasets[datasetIndex].label;
                                var value = context.chart.data.datasets[datasetIndex].data[index];
                                tooltip.style.display = 'block';
                                tooltip.style.left = event.native.clientX + 'px';
                                tooltip.style.top = event.native.clientY + 'px';
                                tooltip.innerHTML = datasetLabel + ': ' + value;
                            } else {
                                tooltip.style.display = 'none';
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: false,
                        min: 850,
                        stepSize: 50,
                        max: 1300
                    }
                }
            }
        });
    </script>
    <a href="../" target="_self"><button type="button">Back</button></a><br>
    </div>
    </div>

    
</body>

</html>
