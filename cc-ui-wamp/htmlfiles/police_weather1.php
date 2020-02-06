<!-- Styles -->
<style>
#chartdiv {
  width: 100%;
  height: 500px;
}										
</style>

<!-- Resources -->
<script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
<script src="https://www.amcharts.com/lib/3/serial.js"></script>
<script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
<link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
<script src="https://www.amcharts.com/lib/3/themes/light.js"></script>

<!-- Chart code -->
<script>
var chart = AmCharts.makeChart("chartdiv", {
    "theme": "light",
    "type": "serial",
    "dataProvider": [{
        "country": "USA",
        "year2004": 3.5,
        "year2005": 4.2
    }, {
        "country": "UK",
        "year2004": 1.7,
        "year2005": 3.1
    }, {
        "country": "Canada",
        "year2004": 2.8,
        "year2005": 2.9
    }, {
        "country": "Japan",
        "year2004": 2.6,
        "year2005": 2.3
    }, {
        "country": "France",
        "year2004": 1.4,
        "year2005": 2.1
    }, {
        "country": "Brazil",
        "year2004": 2.6,
        "year2005": 4.9
    }, {
        "country": "Russia",
        "year2004": 6.4,
        "year2005": 7.2
    }, {
        "country": "India",
        "year2004": 8,
        "year2005": 7.1
    }, {
        "country": "China",
        "year2004": 9.9,
        "year2005": 10.1
    }],
    "valueAxes": [{
        "stackType": "3d",
        "unit": "%",
        "position": "left",
        "title": "GDP growth rate",
    }],
    "startDuration": 1,
    "graphs": [{
        "balloonText": "GDP grow in [[category]] (2004): <b>[[value]]</b>",
        "fillAlphas": 0.9,
        "lineAlpha": 0.2,
        "title": "2004",
        "type": "column",
        "valueField": "year2004"
    }, {
        "balloonText": "GDP grow in [[category]] (2005): <b>[[value]]</b>",
        "fillAlphas": 0.9,
        "lineAlpha": 0.2,
        "title": "2005",
        "type": "column",
        "valueField": "year2005"
    }],
    "plotAreaFillAlphas": 0.1,
    "depth3D": 60,
    "angle": 30,
    "categoryField": "country",
    "categoryAxis": {
        "gridPosition": "start"
    },
    "export": {
    	"enabled": true
     }
});
jQuery('.chart-input').off().on('input change',function() {
	var property	= jQuery(this).data('property');
	var target		= chart;
	chart.startDuration = 0;

	if ( property == 'topRadius') {
		target = chart.graphs[0];
      	if ( this.value == 0 ) {
          this.value = undefined;
      	}
	}

	target[property] = this.value;
	chart.validateNow();
});
</script>
<script>
      var demoData = {
    "title": "3D Stacked Column Chart",
    "description": "3D stacked columns are placed one behind another instead of placing them one on top of another (regular stacking or 100% stacking). This kind of stacking is limited to column graphs only, as only these graphs do support 3D look. You can stack more than two graphs, just remember to put the graphs with the highest values to the back, as otherwise thy will hide the graphs with smaller values.",
    "javascript": "var chart = AmCharts.makeChart(\"chartdiv\", {\r\n    \"theme\":\"light\",\n    \"type\": \"serial\",\r\n    \"dataProvider\": [{\r\n        \"country\": \"USA\",\r\n        \"year2004\": 3.5,\r\n        \"year2005\": 4.2\r\n    }, {\r\n        \"country\": \"UK\",\r\n        \"year2004\": 1.7,\r\n        \"year2005\": 3.1\r\n    }, {\r\n        \"country\": \"Canada\",\r\n        \"year2004\": 2.8,\r\n        \"year2005\": 2.9\r\n    }, {\r\n        \"country\": \"Japan\",\r\n        \"year2004\": 2.6,\r\n        \"year2005\": 2.3\r\n    }, {\r\n        \"country\": \"France\",\r\n        \"year2004\": 1.4,\r\n        \"year2005\": 2.1\r\n    }, {\r\n        \"country\": \"Brazil\",\r\n        \"year2004\": 2.6,\r\n        \"year2005\": 4.9\r\n    }, {\r\n        \"country\": \"Russia\",\r\n        \"year2004\": 6.4,\r\n        \"year2005\": 7.2\r\n    }, {\r\n        \"country\": \"India\",\r\n        \"year2004\": 8,\r\n        \"year2005\": 7.1\r\n    }, {\r\n        \"country\": \"China\",\r\n        \"year2004\": 9.9,\r\n        \"year2005\": 10.1\r\n    }],\r\n    \"valueAxes\": [{\r\n        \"stackType\": \"3d\",\r\n        \"unit\": \"%\",\r\n        \"position\": \"left\",\r\n        \"title\": \"GDP growth rate\",\r\n    }],\r\n    \"startDuration\": 1,\r\n    \"graphs\": [{\r\n        \"balloonText\": \"GDP grow in [[category]] (2004): <b>[[value]]<\/b>\",\r\n        \"fillAlphas\": 0.9,\r\n        \"lineAlpha\": 0.2,\r\n        \"title\": \"2004\",\r\n        \"type\": \"column\",\r\n        \"valueField\": \"year2004\"\r\n    }, {\r\n        \"balloonText\": \"GDP grow in [[category]] (2005): <b>[[value]]<\/b>\",\r\n        \"fillAlphas\": 0.9,\r\n        \"lineAlpha\": 0.2,\r\n        \"title\": \"2005\",\r\n        \"type\": \"column\",\r\n        \"valueField\": \"year2005\"\r\n    }],\r\n    \"plotAreaFillAlphas\": 0.1,\r\n    \"depth3D\": 60,\r\n    \"angle\": 30,\r\n    \"categoryField\": \"country\",\r\n    \"categoryAxis\": {\r\n        \"gridPosition\": \"start\"\r\n    },\r\n    \"export\": {\r\n    \t\"enabled\": true\r\n     }\r\n});\r\njQuery('.chart-input').off().on('input change',function() {\r\n\tvar property\t= jQuery(this).data('property');\r\n\tvar target\t\t= chart;\r\n\tchart.startDuration = 0;\r\n\r\n\tif ( property == 'topRadius') {\r\n\t\ttarget = chart.graphs[0];\r\n      \tif ( this.value == 0 ) {\r\n          this.value = undefined;\r\n      \t}\r\n\t}\r\n\r\n\ttarget[property] = this.value;\r\n\tchart.validateNow();\r\n});",
    "html": "<div id=\"chartdiv\"><\/div>",
    "css": "#chartdiv {\r\n  width: 100%;\r\n  height: 500px;\r\n}\t\t\t\t\t\t\t\t\t\t",
    "controls": "[ {\r\n  \"category\": \"Graph\",\r\n  \"title\": \"Fill Alpha\",\r\n  \"type\": \"slider\",\r\n  \"min\": 0,\r\n  \"max\": 1,\r\n  \"property\": \"graphs[0].fillAlphas\"\r\n}, {\r\n  \"category\": \"Chart\",\r\n  \"title\": \"Angle\",\r\n  \"type\": \"slider\",\r\n  \"min\":  0,\r\n  \"max\": 89,\r\n  \"property\": \"angle\"\r\n}, {\r\n  \"category\": \"Chart\",\r\n  \"title\": \"Depth 3D\",\r\n  \"type\": \"slider\",\r\n  \"min\": 1,\r\n  \"max\": 120,\r\n  \"property\": \"depth3D\"\r\n} ]",
    "resources": [
        "https:\/\/www.amcharts.com\/lib\/3\/amcharts.js",
        "https:\/\/www.amcharts.com\/lib\/3\/serial.js",
        "https:\/\/www.amcharts.com\/lib\/3\/plugins\/export\/export.min.js",
        "https:\/\/www.amcharts.com\/lib\/3\/plugins\/export\/export.css"
    ]
}      </script>
<!-- HTML -->
<div id="chartdiv"></div>