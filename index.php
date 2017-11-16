<!DOCTYPE html>
<html lang="en">
<?php
include "sqlhelper.php";
$mysqli = new sqlhelper();
$sql="select * from chart";
$res=$mysqli->execute_dql($sql);
$res2=$mysqli->execute_dql($sql);
$i=0;
$len= $res->num_rows;
    ?>
<head>
    <meta charset="UTF-8">
    <title>Shanghai_Mc</title>
    <style type="text/css">
            .anchorBL {
            display: none;
        }
            .min{ min-height:100px; width:200px}
    </style>
</head>

<body>
    <div id="map-wrap" style="height: 680px;">
    </div>
</body>

<!-- 这里以后是地图 -->
<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=Mxwp81MDPbM0GTIwh7WP0yHTgoFQPKeb"></script>
<script src="echarts.min.js"></script>
<script src="bmap.min.js"></script>

<script>
    var geoCoordMap = {
        <?php
        while ($rows_coordinate=$res->fetch_assoc()){
            $i++;
            $row=$rows_coordinate["coordinate"];
            if($i != $len){
                echo "\"Mc_$i\": $row,";
            }else{
                echo "\"Mc_$i\": $row";
            }

        }
        ?>
    };
    var data = [
        <?php
        $i=0;
        while ($rows_coordinate=$res2->fetch_assoc()){
            $i++;
            $row=$rows_coordinate["status"];
            if($i != $len){
                echo "{ name: \"Mc_$i\", value: '$row' },";
            }else{
                echo "{ name: \"Mc_$i\", value: '$row' }";
            }

        }
        ?>
    ]

    var convertData = function (data) {
        var res = [];
        for (var i = 0; i < data.length; i++) {
            var geoCoord = geoCoordMap[data[i].name];
            if (geoCoord) {
                res.push({
                    name: data[i].name,
                    value: geoCoord.concat(data[i].value)
                });
                //alert(geoCoord.concat(data[i].value));
            }
        }
        return res;
    };

    var bmapChart = echarts.init(document.getElementById('map-wrap'));
    var option = {
        title: {
            //
            x: 'middle',
            y: 15,
            text: 'name',
            textStyle: {
                color: '#fff'
            }
        },
        tooltip: {
            formatter: function (params) {
                return params.name + ' : ' + params.value[2];
            },
            
        },
        legend: {
            orient: 'vertical',
            y: 'bottom',
            x: 'right',
            data: ['state'],
            textStyle: {
                color: '#fff'
            }
        },
        visualMap: {
            //
            categories: ['ok', 'check', 'error'],
            y: 'top',
            x: 'right',
            //红黄蓝
            color: ['#FF0000', '#FFFF00', '#7FFF00'],
            textStyle: {
                color: '#fff'
            }
        },
        bmap: {
            center: [121.316113, 31.123965],
            zoom: 10,
            roam: true,
            mapStyle: {
                styleJson: [
                    {
                        'featureType': 'land',
                        'elementType': 'geometry',
                        'stylers': {
                            'color': '#081734'
                        }
                    },
                    {
                        'featureType': 'building',
                        'elementType': 'geometry',
                        'stylers': {
                            'color': '#04406F'
                        }
                    },
                    {
                        'featureType': 'building',
                        'elementType': 'labels',
                        'stylers': {
                            'visibility': 'off'
                        }
                    },
                    {
                        'featureType': 'highway',
                        'elementType': 'geometry',
                        'stylers': {
                            'color': '#015B99'
                        }
                    },
                    {
                        'featureType': 'highway',
                        'elementType': 'labels',
                        'stylers': {
                            'visibility': 'off'
                        }
                    },
                    {
                        'featureType': 'arterial',
                        'elementType': 'geometry',
                        'stylers': {
                            'color': '#003051'
                        }
                    },
                    {
                        'featureType': 'arterial',
                        'elementType': 'labels',
                        'stylers': {
                            'visibility': 'off'
                        }
                    },
                    {
                        'featureType': 'green',
                        'elementType': 'geometry',
                        'stylers': {
                            'visibility': 'off'
                        }
                    },
                    {
                        'featureType': 'water',
                        'elementType': 'geometry',
                        'stylers': {
                            'color': '#044161'
                        }
                    },
                    {
                        'featureType': 'subway',
                        'elementType': 'geometry.stroke',
                        'stylers': {
                            'color': '#003051'
                        }
                    },
                    {
                        'featureType': 'subway',
                        'elementType': 'labels',
                        'stylers': {
                            'visibility': 'off'
                        }
                    },
                    {
                        'featureType': 'railway',
                        'elementType': 'geometry',
                        'stylers': {
                            'visibility': 'off'
                        }
                    },
                    {
                        'featureType': 'railway',
                        'elementType': 'labels',
                        'stylers': {
                            'visibility': 'off'
                        }
                    },
                    {
                        'featureType': 'all',
                        'elementType': 'labels.text.stroke',
                        'stylers': {
                            'color': '#313131'
                        }
                    },
                    {
                        'featureType': 'all',
                        'elementType': 'labels.text.fill',
                        'stylers': {
                            'color': '#FFFFFF'
                        }
                    },
                    {
                        'featureType': 'manmade',
                        'elementType': 'geometry',
                        'stylers': {
                            'visibility': 'off'
                        }
                    },
                    {
                        'featureType': 'manmade',
                        'elementType': 'labels',
                        'stylers': {
                            'visibility': 'off'
                        }
                    },
                    {
                        'featureType': 'local',
                        'elementType': 'geometry',
                        'stylers': {
                            'visibility': 'off'
                        }
                    },
                    {
                        'featureType': 'local',
                        'elementType': 'labels',
                        'stylers': {
                            'visibility': 'off'
                        }
                    },
                    {
                        'featureType': 'subway',
                        'elementType': 'geometry',
                        'stylers': {
                            'lightness': -65
                        }
                    },
                    {
                        'featureType': 'railway',
                        'elementType': 'all',
                        'stylers': {
                            'lightness': -40
                        }
                    },
                    {
                        'featureType': 'boundary',
                        'elementType': 'geometry',
                        'stylers': {
                            'color': '#8b8787',
                            'weight': '1',
                            'lightness': -29
                        }
                    }]
            }
        },
        series: [
            {
                //
                name: 'state',
                type: 'scatter',
                coordinateSystem: 'bmap',
                data: convertData(data),
                symbolSize: 12,
                label: {
                    normal: {
                        show: false
                    },
                    emphasis: {
                        show: false
                    }
                },
                itemStyle: {
                    emphasis: {
                        borderColor: '#fff',
                        borderWidth: 1
                    }
                }
            }
        ]
    }
    bmapChart.setOption(option);
</script>

</html>