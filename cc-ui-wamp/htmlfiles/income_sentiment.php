<!-- Styles -->
<?php
		$json3 = file_get_contents('suburb_sentiment_time-SA2polygon.json');
		$data3 = json_decode(utf8_decode($json3), true);
		$c = $data3['rows'];
		$sub = array();
		$i =0;
		
		foreach ($c as $key1 => $value1)
		{
			if($key1>0)
			{
				$sub[$i] = $c[$key1]['key']['SA2_NAME16'];
				//echo $c[$key1]['SA2_NAME16'];
				//echo $c[$key1]['key']['SA2_NAME16']."<br>";
				$i = $i+1;
			}
			 
		}
		 
?>

<link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" style="margin-bottom: 15px;">
	<div class="container">
		<form method="get" action="income_sentiment.php">
			<ul class="navbar-nav">
				<li class="nav-item">
					<select name="type1"> 
						<?php
						if(isset($_GET['type1']))
						{
							?>
								<option value="<?php echo $_GET['type1']; ?>"><?php echo $_GET['type1']; ?></option>
							<?php
						}
						?>
						<option value="positive">Positive</option>
						<option value="negative">Negative</option>
						<option value="neutral">Neutral</option>
					</select>
					<select name="sub1"> 
					<?php
						if(isset($_GET['sub1']))
						{
							?>
								<option value="<?php echo $_GET['sub1']; ?>"><?php echo $_GET['sub1']; ?></option>
							<?php
						}
						?>
					<?php
						$sub_count = count($sub);
						for($j=0;$j<$sub_count-1;$j++)
						{
							?>
							<option value="<?php echo $sub[$j]; ?>"><?php echo $sub[$j]; ?></option>
							<?php
						}
					?>
					</select>
				</li>
				<li class="nav-item">
				||||
				</li>
				<li class="nav-item">
					<select name="type2">
						<?php
						if(isset($_GET['type2']))
						{
							?>
								<option value="<?php echo $_GET['type2']; ?>"><?php echo $_GET['type2']; ?></option>
							<?php
						}
						?>
						<option value="positive">Positive</option>
						<option value="negative">Negative</option>
						<option value="neutral">Neutral</option>
					</select>
				</li>
				<li class="nav-item">
					<select name="sub2">
					<?php
						if(isset($_GET['sub2']))
						{
							?>
								<option value="<?php echo $_GET['sub2']; ?>"><?php echo $_GET['sub2']; ?></option>
							<?php
						}
						?>
					<?php
						$sub_count = count($sub);
						for($j=0;$j<$sub_count-1;$j++)
						{
							?>
							<option value="<?php echo $sub[$j]; ?>"><?php echo $sub[$j]; ?></option>
							<?php
						}
					?>
					</select>
				</li>
				
				 
				<li class="nav-item">
					<input type="submit" name="submit_form" />
				</li>
			</ul>
		</form>
	</div>
	<div class="collapse navbar-collapse" id="navbarResponsive">
		<ul class="navbar-nav ml-auto">
			<li class="nav-item active">
				<a href="index" type="button" class="btn btn-success" onclick="aurinButtons(box2, this, '#21315b')" style="margin-left: 10px;">Home Page</a>
			</li>
		</ul>
	</div>
</nav>
<style>
#chartdiv{
  width: 100%;
  height: 500px;
}

.amcharts-graph-g2 .amcharts-graph-stroke {
  stroke-dasharray: 3px 3px;
  stroke-linejoin: round;
  stroke-linecap: round;
  -webkit-animation: am-moving-dashes 1s linear infinite;
  animation: am-moving-dashes 1s linear infinite;
}

@-webkit-keyframes am-moving-dashes {
  100% {
    stroke-dashoffset: -31px;
  }
}
@keyframes am-moving-dashes {
  100% {
    stroke-dashoffset: -31px;
  }
}


.lastBullet {
  -webkit-animation: am-pulsating 1s ease-out infinite;
  animation: am-pulsating 1s ease-out infinite;
}
@-webkit-keyframes am-pulsating {
  0% {
    stroke-opacity: 1;
    stroke-width: 0px;
  }
  100% {
    stroke-opacity: 0;
    stroke-width: 50px;
  }
}
@keyframes am-pulsating {
  0% {
    stroke-opacity: 1;
    stroke-width: 0px;
  }
  100% {
    stroke-opacity: 0;
    stroke-width: 50px;
  }
}

.amcharts-graph-column-front {
  -webkit-transition: all .3s .3s ease-out;
  transition: all .3s .3s ease-out;
}
.amcharts-graph-column-front:hover {
  fill: #496375;
  stroke: #496375;
  -webkit-transition: all .3s ease-out;
  transition: all .3s ease-out;
}

.amcharts-graph-g3 {
  stroke-linejoin: round;
  stroke-linecap: round;
  stroke-dasharray: 500%;
  stroke-dasharray: 0 /;    /* fixes IE prob */
  stroke-dashoffset: 0 /;   /* fixes IE prob */
  -webkit-animation: am-draw 40s;
  animation: am-draw 40s;
}
@-webkit-keyframes am-draw {
    0% {
        stroke-dashoffset: 500%;
    }
    100% {
        stroke-dashoffset: 0%;
    }
}
@keyframes am-draw {
    0% {
        stroke-dashoffset: 500%;
    }
    100% {
        stroke-dashoffset: 0%;
    }
}
/* OVERWRITE OUR MAIN STYLE */
.demo-flipper-front.demo-panel-white, body {
  background-color: white;
}									
</style>

<!-- Resources -->
<script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
<script src="https://www.amcharts.com/lib/3/serial.js"></script>
<script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
<link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
<script src="https://www.amcharts.com/lib/3/themes/light.js"></script>

<!-- Chart code -->
<?php
//if(isset($_POST['type1'] && $_POST['type2'] && $_POST['sub1'] && $_POST['sub2']))
if(isset($_GET['type1']))
{
	//echo "<br><br><br><br><br><br>";
	
	$json3 = file_get_contents('suburb_sentiment_time-SA2polygon.json');
	$data3 = json_decode(utf8_decode($json3), true);
	$c1 = $data3['rows'];
		
		
	$t1 = $_GET['type1'];
	$t2 = $_GET['type2'];
	$s1 = $_GET['sub1'];
	$s2 = $_GET['sub2'];
	
	
	//echo $_POST['type1']."<br>";
	//echo $_POST['type2']."<br>";
	//echo $_POST['sub1']."<br>";
	//echo $_POST['sub2']."<br><br><br><br>";
	//echo "<br><br>";
	
	$data_set1 = array();
	$data_set2 = array();
	$p = 0;
	foreach ($c1 as $key2 => $value2)
	{
		//if($c[$key1]['key']['SA2_NAME16'] == $s1)
		if($key2>0)
		{
			//////////////////////////////////////////////////// first dataset//////////////////////////////////////////////////////////////////////
			//////////////////////////////////////////////////// first dataset//////////////////////////////////////////////////////////////////////
			if($c1[$key2]['key']['SA2_NAME16'] == $s1)
			{
				echo $c1[$key2]['key']['SA2_NAME16']."<br>";
				//$new[$p][0] = $c1[$key2]['key']['SA2_NAME16'];
				
				for($m=0;$m<24;$m++)
				{
					if(!empty($c1[$key2]['value'][$m]))
					{
						if(!empty($c1[$key2]['value'][$m][$t1]))
							$data_set1[$m][0] = $c1[$key2]['value'][$m][$t1];
						else
							$data_set1[$m][0] = 0;
						
						if(!empty($c1[$key2]['value'][$m]['positive']))
							$data_set1[$m][1] = $c1[$key2]['value'][$m]['positive'];
						else
							$data_set1[$m][1] = 0;
						
						if(!empty($c1[$key2]['value'][$m]['negative']))
							$data_set1[$m][2] = $c1[$key2]['value'][$m]['negative'];
						else
							$data_set1[$m][2] = 0;
						
						if(!empty($c1[$key2]['value'][$m]['neutral']))
							$data_set1[$m][3] = $c1[$key2]['value'][$m]['neutral'];
						else
							$data_set1[$m][3] = 0;
						
					}
				
					else
					{
						$data_set1[$m][0] = 0;
						$data_set1[$m][1] = 0;
						$data_set1[$m][2] = 0;
						$data_set1[$m][3] = 0;
					}
				}
			}
			//////////////////////////////////////////////////// first dataset//////////////////////////////////////////////////////////////////////
			//////////////////////////////////////////////////// first dataset//////////////////////////////////////////////////////////////////////
			
			//////////////////////////////////////////////////// second dataset//////////////////////////////////////////////////////////////////////
			//////////////////////////////////////////////////// second dataset//////////////////////////////////////////////////////////////////////
			if($c1[$key2]['key']['SA2_NAME16'] == $s2)
			{
				echo $c1[$key2]['key']['SA2_NAME16']."<br>";
				//$new[$p][0] = $c1[$key2]['key']['SA2_NAME16'];
				
				for($m1=0;$m1<24;$m1++)
				{
					if(!empty($c1[$key2]['value'][$m1]))
					{
						if(!empty($c1[$key2]['value'][$m1][$t1]))
							$data_set2[$m1][0] = $c1[$key2]['value'][$m1][$t1];
						else
							$data_set2[$m1][0] = 0;
						
						if(!empty($c1[$key2]['value'][$m1]['positive']))
							$data_set2[$m1][1] = $c1[$key2]['value'][$m1]['positive'];
						else
							$data_set2[$m1][1] = 0;
						
						if(!empty($c1[$key2]['value'][$m1]['negative']))
							$data_set2[$m1][2] = $c1[$key2]['value'][$m1]['negative'];
						else
							$data_set2[$m1][2] = 0;
						
						if(!empty($c1[$key2]['value'][$m1]['neutral']))
							$data_set2[$m1][3] = $c1[$key2]['value'][$m1]['neutral'];
						else
							$data_set2[$m1][3] = 0;
						
					}
				
					else
					{
						$data_set2[$m1][0] = 0;
						$data_set2[$m1][1] = 0;
						$data_set2[$m1][2] = 0;
						$data_set2[$m1][3] = 0;
					}
				}
			}
			//////////////////////////////////////////////////// second dataset//////////////////////////////////////////////////////////////////////
			//////////////////////////////////////////////////// second dataset//////////////////////////////////////////////////////////////////////
	
			
			//$i = $i+1;
			$p = $p+1;
		}
			 
	}
}
?>
<script>
var chartData = [ 
<?php
for($k=0;$k<24;$k++)
{
?>
{
  "Hours": "<?php echo $k."-".($k+1); ?>",
  "distance": <?php echo ($data_set1[$k][1]+$data_set1[$k][2]+$data_set1[$k][3]); ?>,
  "distance1": <?php echo ($data_set2[$k][1]+$data_set2[$k][2]+$data_set2[$k][3]); ?>,
  "townSize": 10,
  "latitude": <?php echo $data_set1[$k][1]; ?>,
  "latitude1": <?php echo $data_set2[$k][1]; ?>
  
},
<?php
}
?>    
{
  "date": " ",
  "latitude": 0 ,
  "duration":  0,
  "townName": " ",
  "townName2": "",
  "bulletClass": "lastBullet"
} ];
var chart = AmCharts.makeChart( "chartdiv", {
  "type": "serial",
"theme": "light",

  "dataDateFormat": "YYYY-MM-DD",
  "dataProvider": chartData,

  "addClassNames": true,
  "startDuration": 1,
  //"color": "#FFFFFF",
  "marginLeft": 0,
	
	/*
  "categoryField": "date",
  "categoryAxis": {
    "parseDates": true,
    "minPeriod": "DD",
    "autoGridCount": false,
    "gridCount": 50,
    "gridAlpha": 0.1,
    "gridColor": "#FFFFFF",
    "axisColor": "#555555",
    "dateFormats": [ {
      "period": 'DD',
      "format": 'DD'
    }, {
      "period": 'WW',
      "format": 'MMM DD'
    }, {
      "period": 'MM',
      "format": 'MMM'
    }, {
      "period": 'YYYY',
      "format": 'YYYY'
    } ]
  },
	*/
	
	
  "categoryField": "Hours",
  "categoryAxis": {
    "parseSuburb": true,
    "minPeriod": "DD",
    "autoGridCount": false,
    "gridCount": 50,
    "gridAlpha": 0.1,
    "gridColor": "#FFFFFF",
    "axisColor": "#555555",
    "suburbFormats": [ {
      "format": 'DD'
    } ]
  },
  
  
  "valueAxes": [ {
    "id": "a1",
    "title": "distance",
    "gridAlpha": 0,
    "axisAlpha": 0
  }, {
    "id": "a2",
    "position": "right",
    "gridAlpha": 0,
    "axisAlpha": 0,
    "labelsEnabled": false
  }, {
    "id": "a3",
    "title": "duration",
    "position": "right",
    "gridAlpha": 0,
    "axisAlpha": 0,
    "inside": true,
    "duration": "mm",
    "durationUnits": {
      "DD": "d. ",
      "hh": "h ",
      "mm": "min",
      "ss": ""
    }
  } ],
  "graphs": [ {
    "id": "g1",
    "valueField": "distance",
    "title": "<?php echo $_GET['sub1']; ?>",
    "type": "column",
    "fillAlphas": 0.9,
    "valueAxis": "a1",
    "balloonText": "[[value]] tweeets",
    "legendValueText": "[[value]] Tweets",
    "legendPeriodValueText": "total: [[value.sum]] Tweets",
    "lineColor": "olive",
    "alphaField": "alpha"
  },{
    "id": "g4",
    "valueField": "distance1",
    "title": "<?php echo $_GET['sub2']; ?>",
    "type": "column",
    "fillAlphas": 0.9,
    "valueAxis": "a1",
    "balloonText": "[[value]] tweets",
    "legendValueText": "[[value]] Tweets",
    "legendPeriodValueText": "total: [[value.sum]] mi",
    "lineColor": "#263138",
    "alphaField": "alpha"
  },

  {
    "id": "g2",
    "valueField": "latitude",
    "classNameField": "bulletClass",
    "title": "<?php echo $_GET['sub1']; ?>/<?php echo $_GET['type1']; ?>",
    "type": "line",
    "valueAxis": "a2",
    "lineColor": "olive",
    "lineThickness": 1,
    "legendValueText": "[[value]]/[[description]]",
    "descriptionField": "townName",
    "bullet": "round",
    "bulletSizeField": "townSize",
    "bulletBorderColor": "#786c56",
    "bulletBorderAlpha": 1,
    "bulletBorderThickness": 0,
    "bulletColor": "olive",
    "labelText": "[[townName2]]",
    "labelPosition": "right",
    "balloonText": "<?php echo $_GET['type1']; ?> tweets:[[value]]",
    "showBalloon": true,
    "animationPlayed": true
  }, 
  {
    "id": "g5",
    "valueField": "latitude1",
    "classNameField": "bulletClass",
    "title": "<?php echo $_GET['sub2']; ?>/<?php echo $_GET['type2']; ?>",
    "type": "line",
    "valueAxis": "a2",
    "lineColor": "#786c56",
    "lineThickness": 1,
    "legendValueText": "[[value]]/[[description]]",
    "descriptionField": "townName",
    "bullet": "round",
    "bulletSizeField": "townSize",
    "bulletBorderColor": "#786c56",
    "bulletBorderAlpha": 1,
    "bulletBorderThickness": 0,
    "bulletColor": "#000000",
    "labelText": "[[townName2]]",
    "labelPosition": "right",
    "balloonText": "<?php echo $_GET['type2']; ?> tweets:[[value]]",
    "showBalloon": true,
    "animationPlayed": true
  } ],

  "chartCursor": {
    "zoomable": false,
    "categoryBalloonDateFormat": "DD",
    "cursorAlpha": 0,
    "valueBalloonsEnabled": false
  },
  "legend": {
    "bulletType": "round",
    "equalWidths": false,
    "valueWidth": 120,
    "useGraphSettings": true,
    //"color": "#FFFFFF"
  }
} );
</script>

<!-- HTML -->
<div id="chartdiv" style="margin-top: 80px;"></div>	