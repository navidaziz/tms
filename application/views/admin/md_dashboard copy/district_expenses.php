<?php
$start_time = microtime(true);
$query = "SELECT * FROM financial_years";
$fys = $this->db->query($query)->result();

?>

<div class="jumbotron" style="padding: 2px;">
    <div id="district_expenses_div" style="width:100%; height:400px;"></div>

    <script>
        Highcharts.chart('district_expenses_div', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'District-Level Analysis of Scheme Expenditures'
            },
            subtitle: {
                text: 'Districts Ranked by Highest to Lowest Scheme Expenses'
            },
            xAxis: {
                type: 'category',
                labels: {
                    autoRotation: [-45, -90],
                    style: {
                        fontSize: '13px',
                        fontFamily: 'Verdana, sans-serif'
                    }
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Expeneses (millions)'
                }
            },
            tooltip: {
                shared: true,
                pointFormat: 'Expenses: <b>{point.y:.1f} millions</b>'
            },
            series: [{
                    type: 'column',
                    name: 'Expenses',
                    colors: [
                        '#9b20d9', '#9215ac', '#861ec9', '#7a17e6', '#7010f9', '#691af3',
                        '#6225ed', '#5b30e7', '#533be1', '#4c46db', '#4551d5', '#3e5ccf',
                        '#3667c9', '#2f72c3', '#277dbd', '#1f88b7', '#1693b1', '#0a9eaa',
                        '#03c69b', '#00f194'
                    ],
                    colorByPoint: true,
                    groupPadding: 0,
                    data: [
                        <?php
                        $query = "SELECT d.district_name, SUM(e.net_pay) as total FROM expenses as e
                    INNER JOIN districts as d ON(d.district_id = e.district_id)
                    and d.is_district =1
                    GROUP BY d.district_name ORDER BY total DESC";
                        $districts = $this->db->query($query)->result();
                        $count = 1;
                        foreach ($districts as $district) { ?> {
                                name: '<?php echo $count . '. ' . substr(htmlspecialchars($district->district_name), 0, 10); ?>',
                                y: <?php echo round($district->total / 1000000, 3); ?>
                            },
                        <?php $count++;
                        } ?>
                    ],
                    dataLabels: {
                        enabled: true,
                        rotation: -90,
                        color: '#FFFFFF',
                    }
                },

            ]
        });
    </script>



    <small style="font-size:9px !important">Execution Time: <?php
                                                            $end_time = microtime(true);
                                                            $execution_time = $end_time - $start_time;
                                                            echo $execution_time; ?> seconds</small>
</div>