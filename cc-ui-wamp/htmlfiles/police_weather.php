<!DOCTYPE html>
<html lang="en-US" prefix="og: http://ogp.me/ns#">
<head>
<meta charset="UTF-8"><script type="text/javascript">window.NREUM||(NREUM={}),__nr_require=function(e,t,n){function r(n){if(!t[n]){var o=t[n]={exports:{}};e[n][0].call(o.exports,function(t){var o=e[n][1][t];return r(o||t)},o,o.exports)}return t[n].exports}if("function"==typeof __nr_require)return __nr_require;for(var o=0;o<n.length;o++)r(n[o]);return r}({1:[function(e,t,n){function r(){}function o(e,t,n){return function(){return i(e,[f.now()].concat(u(arguments)),t?null:this,n),t?void 0:this}}var i=e("handle"),a=e(2),u=e(3),c=e("ee").get("tracer"),f=e("loader"),s=NREUM;"undefined"==typeof window.newrelic&&(newrelic=s);var p=["setPageViewName","setCustomAttribute","setErrorHandler","finished","addToTrace","inlineHit","addRelease"],d="api-",l=d+"ixn-";a(p,function(e,t){s[t]=o(d+t,!0,"api")}),s.addPageAction=o(d+"addPageAction",!0),s.setCurrentRouteName=o(d+"routeName",!0),t.exports=newrelic,s.interaction=function(){return(new r).get()};var m=r.prototype={createTracer:function(e,t){var n={},r=this,o="function"==typeof t;return i(l+"tracer",[f.now(),e,n],r),function(){if(c.emit((o?"":"no-")+"fn-start",[f.now(),r,o],n),o)try{return t.apply(this,arguments)}catch(e){throw c.emit("fn-err",[arguments,this,e],n),e}finally{c.emit("fn-end",[f.now()],n)}}}};a("setName,setAttribute,save,ignore,onEnd,getContext,end,get".split(","),function(e,t){m[t]=o(l+t)}),newrelic.noticeError=function(e){"string"==typeof e&&(e=new Error(e)),i("err",[e,f.now()])}},{}],2:[function(e,t,n){function r(e,t){var n=[],r="",i=0;for(r in e)o.call(e,r)&&(n[i]=t(r,e[r]),i+=1);return n}var o=Object.prototype.hasOwnProperty;t.exports=r},{}],3:[function(e,t,n){function r(e,t,n){t||(t=0),"undefined"==typeof n&&(n=e?e.length:0);for(var r=-1,o=n-t||0,i=Array(o<0?0:o);++r<o;)i[r]=e[t+r];return i}t.exports=r},{}],4:[function(e,t,n){t.exports={exists:"undefined"!=typeof window.performance&&window.performance.timing&&"undefined"!=typeof window.performance.timing.navigationStart}},{}],ee:[function(e,t,n){function r(){}function o(e){function t(e){return e&&e instanceof r?e:e?c(e,u,i):i()}function n(n,r,o,i){if(!d.aborted||i){e&&e(n,r,o);for(var a=t(o),u=m(n),c=u.length,f=0;f<c;f++)u[f].apply(a,r);var p=s[y[n]];return p&&p.push([b,n,r,a]),a}}function l(e,t){v[e]=m(e).concat(t)}function m(e){return v[e]||[]}function w(e){return p[e]=p[e]||o(n)}function g(e,t){f(e,function(e,n){t=t||"feature",y[n]=t,t in s||(s[t]=[])})}var v={},y={},b={on:l,emit:n,get:w,listeners:m,context:t,buffer:g,abort:a,aborted:!1};return b}function i(){return new r}function a(){(s.api||s.feature)&&(d.aborted=!0,s=d.backlog={})}var u="nr@context",c=e("gos"),f=e(2),s={},p={},d=t.exports=o();d.backlog=s},{}],gos:[function(e,t,n){function r(e,t,n){if(o.call(e,t))return e[t];var r=n();if(Object.defineProperty&&Object.keys)try{return Object.defineProperty(e,t,{value:r,writable:!0,enumerable:!1}),r}catch(i){}return e[t]=r,r}var o=Object.prototype.hasOwnProperty;t.exports=r},{}],handle:[function(e,t,n){function r(e,t,n,r){o.buffer([e],r),o.emit(e,t,n)}var o=e("ee").get("handle");t.exports=r,r.ee=o},{}],id:[function(e,t,n){function r(e){var t=typeof e;return!e||"object"!==t&&"function"!==t?-1:e===window?0:a(e,i,function(){return o++})}var o=1,i="nr@id",a=e("gos");t.exports=r},{}],loader:[function(e,t,n){function r(){if(!x++){var e=h.info=NREUM.info,t=d.getElementsByTagName("script")[0];if(setTimeout(s.abort,3e4),!(e&&e.licenseKey&&e.applicationID&&t))return s.abort();f(y,function(t,n){e[t]||(e[t]=n)}),c("mark",["onload",a()+h.offset],null,"api");var n=d.createElement("script");n.src="https://"+e.agent,t.parentNode.insertBefore(n,t)}}function o(){"complete"===d.readyState&&i()}function i(){c("mark",["domContent",a()+h.offset],null,"api")}function a(){return E.exists&&performance.now?Math.round(performance.now()):(u=Math.max((new Date).getTime(),u))-h.offset}var u=(new Date).getTime(),c=e("handle"),f=e(2),s=e("ee"),p=window,d=p.document,l="addEventListener",m="attachEvent",w=p.XMLHttpRequest,g=w&&w.prototype;NREUM.o={ST:setTimeout,SI:p.setImmediate,CT:clearTimeout,XHR:w,REQ:p.Request,EV:p.Event,PR:p.Promise,MO:p.MutationObserver};var v=""+location,y={beacon:"bam.nr-data.net",errorBeacon:"bam.nr-data.net",agent:"js-agent.newrelic.com/nr-1071.min.js"},b=w&&g&&g[l]&&!/CriOS/.test(navigator.userAgent),h=t.exports={offset:u,now:a,origin:v,features:{},xhrWrappable:b};e(1),d[l]?(d[l]("DOMContentLoaded",i,!1),p[l]("load",r,!1)):(d[m]("onreadystatechange",o),p[m]("onload",r)),c("mark",["firstbyte",u],null,"api");var x=0,E=e(4)},{}]},{},["loader"]);</script>
<link rel="icon" type="image/x-icon" href="https://www.amcharts.com/favicon.ico" />
<meta name="viewport" id="viewport" content="width=device-width, initial-scale=1">
<script>
	if ( screen.width >= 768 && screen.width <= 1136 ) {
		var ratio = Math.round( screen.width / 13 ) / 100;
		document.getElementById( "viewport" ).setAttribute( "content", "width=1300, initial-scale=" + ratio );
	}
</script>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="https://www.amcharts.com/xmlrpc.php">
<title>3D Stacked Column Chart - amCharts</title>
<link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link rel="canonical" href="https://www.amcharts.com/demos/3d-stacked-column-chart/" />
<meta property="og:locale" content="en_US" />
<meta property="og:type" content="article" />
<meta property="og:title" content="3D Stacked Column Chart - amCharts" />
<meta property="og:description" content="3D stacked columns are placed one behind another instead of placing them one on top of another (regular stacking or 100% stacking). This kind of stacking is limited to column graphs only, as only these graphs do support 3D look. You can stack more than two graphs, just remember to put the graphs with the &hellip;" />
<meta property="og:url" content="https://www.amcharts.com/demos/3d-stacked-column-chart/" />
<meta property="og:site_name" content="amCharts" />
<meta property="article:section" content="Column &amp; Bar" />
<meta name="twitter:card" content="summary" />
<meta name="twitter:description" content="3D stacked columns are placed one behind another instead of placing them one on top of another (regular stacking or 100% stacking). This kind of stacking is limited to column graphs only, as only these graphs do support 3D look. You can stack more than two graphs, just remember to put the graphs with the [&hellip;]" />
<meta name="twitter:title" content="3D Stacked Column Chart - amCharts" />

<link rel='dns-prefetch' href='//s.w.org' />
<link rel="alternate" type="application/rss+xml" title="amCharts &raquo; Feed" href="https://www.amcharts.com/feed/" />
<link rel="alternate" type="application/rss+xml" title="amCharts &raquo; Comments Feed" href="https://www.amcharts.com/comments/feed/" />
<link rel='stylesheet' id='-lib-3-plugins-export-export-css-css' href='https://www.amcharts.com/lib/3/plugins/export/export.css?ver=4.9.5' type='text/css' media='all' />
<link rel='stylesheet' id='amcharts2-style-css' href='https://www.amcharts.com/wp-content/themes/amcharts2/css/main.css?ver=20171012-02' type='text/css' media='all' />
<link rel='stylesheet' id='amcharts2-style-demo-css' href='https://www.amcharts.com/wp-content/themes/amcharts2/css/demo.css?ver=20171012-02' type='text/css' media='all' />
<script type='text/javascript' src='https://www.amcharts.com/lib/3/amcharts.js?ver=20171012-02'></script>
<script type='text/javascript' src='https://www.amcharts.com/lib/3/serial.js?ver=20171012-02'></script>
<script type='text/javascript' src='https://www.amcharts.com/lib/3/plugins/export/export.min.js?ver=20171012-02'></script>
<script type='text/javascript' src='https://www.amcharts.com/lib/3/themes/none.js?ver=20171012-02'></script>
<script type='text/javascript' src='https://www.amcharts.com/lib/3/themes/light.js?ver=20171012-02'></script>
<script type='text/javascript' src='https://www.amcharts.com/lib/3/themes/dark.js?ver=20171012-02'></script>
<script type='text/javascript' src='https://www.amcharts.com/lib/3/themes/black.js?ver=20171012-02'></script>
<script type='text/javascript' src='https://www.amcharts.com/lib/3/themes/chalk.js?ver=20171012-02'></script>
<script type='text/javascript' src='https://www.amcharts.com/lib/3/themes/patterns.js?ver=20171012-02'></script>
<link rel='https://api.w.org/' href='https://www.amcharts.com/wp-json/' />
<link rel="EditURI" type="application/rsd+xml" title="RSD" href="https://www.amcharts.com/xmlrpc.php?rsd" />
<link rel="wlwmanifest" type="application/wlwmanifest+xml" href="https://www.amcharts.com/wp-includes/wlwmanifest.xml" />
<meta name="generator" content="WordPress 4.9.5" />
<link rel='shortlink' href='https://www.amcharts.com/?p=7393' />
<link rel="alternate" type="application/json+oembed" href="https://www.amcharts.com/wp-json/oembed/1.0/embed?url=https%3A%2F%2Fwww.amcharts.com%2Fdemos%2F3d-stacked-column-chart%2F" />
<link rel="alternate" type="text/xml+oembed" href="https://www.amcharts.com/wp-json/oembed/1.0/embed?url=https%3A%2F%2Fwww.amcharts.com%2Fdemos%2F3d-stacked-column-chart%2F&#038;format=xml" />
<meta property="og:image" content="https://www.amcharts.com/wp-content/uploads/2013/12/demo_7393_light.jpg" /> <!--[if lt IE 9]>
  <script type='text/javascript' src='https://www.amcharts.com/wp-content/themes/amcharts2/js/html5shiv.min.js?ver=20171012-02'></script>
  <script type='text/javascript' src='https://www.amcharts.com/wp-content/themes/amcharts2/js/respond.min.js?ver=20171012-02'></script>
  <![endif]-->
<style>
      #chartdiv {
  width: 100%;
  height: 500px;
}										      </style>
</head>
<body class="demo-template-default single single-demo postid-7393 no-logo alt-bg">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
			<div class="container">
				
				 
			</div>
			<div class="collapse navbar-collapse" id="navbarResponsive">
			  <ul class="navbar-nav ml-auto">
				<li class="nav-item active">
					<a href="index" type="button" class="btn btn-success" onclick="aurinButtons(box2, this, '#21315b')" style="margin-left: 10px;">Home Page</a>
				</li>
			  </ul>
			</div>
	</nav>
<div id="page" class="site">
<header id="masthead" class="site-header" role="banner">
 
 
 
</header>
<div id="content" class="site-content">
<div id="primary" class="content-area">
<main id="main" class="site-main" role="main">
 
 
<div class="demo-body demo-background">
 
<div class="content-col">

<div class="demo-code demo-code-html">
<div id="chartdiv"></div> </div>
</div>

 
</div>
<div class="demo-body demo-background">
<noscript><img src="https://www.amcharts.com/wp-content/uploads/2013/12/demo_7393_light.jpg" /></noscript>
<?php
		
		
		$json3 = file_get_contents('police_sentiment.json');
		$data3 = json_decode(utf8_decode($json3), true);
		$c = $data3['rows'];
		$sub = array();
		$i =0;
		
		$all_neg = $c[0]['value']['negative'];
		$all_neu = $c[0]['value']['neutral'];
		$all_pos = $c[0]['value']['positive'];
		
		//echo $all_neg;
		//echo $all_neu;
		//echo $all_pos;
		
		$pol_neg = $c[1]['value']['negative'];
		$pol_neu = $c[1]['value']['neutral'];
		$pol_pos = $c[1]['value']['positive'];
		
		//echo "<br><br>";
		
		//echo $pol_neg;
		//echo $pol_neu;
		//echo $pol_pos;
		
		$json4 = file_get_contents('weather_sentiment.json');
		$data4 = json_decode(utf8_decode($json4), true);
		$d = $data4['rows'];
		
		$rain_neg = $d[1]['value']['negative'];
		$rain_neu = $d[1]['value']['neutral'];
		$rain_pos = $d[1]['value']['positive'];
		
		//echo "<br><br>";
		
		//echo $rain_neg;
		//echo $rain_neu;
		//echo $rain_pos;
		
		$sun_neg = $d[2]['value']['negative'];
		$sun_neu = $d[2]['value']['neutral'];
		$sun_pos = $d[2]['value']['positive'];
		
		//echo "<br><br>";
		
		//echo $sun_neg;
		//echo $sun_neu;
		//echo $sun_pos;
		
		/*
		
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
		*/
?>
<script>
          try {
            var chart = AmCharts.makeChart("chartdiv", {
    "theme":"light",
    "type": "serial",
    "dataProvider": [
	{
        "country": "Police Neg",
        "year2004": <?php echo $pol_neg; ?>,
        "year2005": <?php echo $all_neg; ?>
    },
	{
        "country": "Police Neu",
        "year2004": <?php echo $pol_neu; ?>,
        "year2005": <?php echo $all_neu; ?>
    },
	{
        "country": "Police Pos",
        "year2004": <?php echo $pol_pos; ?>,
        "year2005": <?php echo $all_pos; ?>
    },
	{
        "country": "Rain Neg",
        "year2004": <?php echo $rain_neg; ?>,
        "year2005": <?php echo $all_neg; ?>
    },
	{
        "country": "Rain Neu",
        "year2004": <?php echo $rain_neu; ?>,
        "year2005": <?php echo $all_neu; ?>
    },
	{
        "country": "Rain Pos",
        "year2004": <?php echo $rain_pos; ?>,
        "year2005": <?php echo $all_pos; ?>
    },
	
	{
        "country": "Sunny Neg",
        "year2004": <?php echo $sun_neg; ?>,
        "year2005": <?php echo $all_neg; ?>
    },
	{
        "country": "Sunny Neu",
        "year2004": <?php echo $sun_neu; ?>,
        "year2005": <?php echo $all_neu; ?>
    },
	{
        "country": "Sunny Pos",
        "year2004": <?php echo $sun_pos; ?>,
        "year2005": <?php echo $all_pos; ?>
    }
	],
    "valueAxes": [{
        "stackType": "3d",
        "unit": "",
        "position": "left",
        "title": "Tweet Count",
    }],
    "startDuration": 1,
    "graphs": [{
        //"balloonText": " [[category]] : <b>[[value]]</b>",
        "balloonText": "  <b>[[value]]</b>",
        "fillAlphas": 0.9,
        "lineAlpha": 0.2,
        "title": "2004",
        "type": "column",
        "valueField": "year2004"
    }, {
        //"balloonText": " [[category]] Total: <b>[[value]]</b>",
        "balloonText": "  <b>[[value]]</b>",
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
});          }
          catch( e ) {
            console.log( e );
          }
        </script>
<script>
          try {
            // Demo controls
            var amchartsDemoControls = [ {
  "category": "Graph",
  "title": "Fill Alpha",
  "type": "slider",
  "min": 0,
  "max": 1,
  "property": "graphs[0].fillAlphas"
}, {
  "category": "Chart",
  "title": "Angle",
  "type": "slider",
  "min":  0,
  "max": 89,
  "property": "angle"
}, {
  "category": "Chart",
  "title": "Depth 3D",
  "type": "slider",
  "min": 1,
  "max": 120,
  "property": "depth3D"
} ]          }
          catch( e ) {
            console.log( e );
          }
        </script>
<div class="demo-controls">
<div class="content-col">
<div class="row" id="demo-control-holder">
</div>
</div>
</div>
</div>
 
<script>
      var demoData = {
    "title": "3D Stacked Column Chart",
    "description": "3D stacked columns are placed one behind another instead of placing them one on top of another (regular stacking or 100% stacking). This kind of stacking is limited to column graphs only, as only these graphs do support 3D look. You can stack more than two graphs, just remember to put the graphs with the highest values to the back, as otherwise thy will hide the graphs with smaller values.",
    "javascript": "var chart = AmCharts.makeChart(\"chartdiv\", {\r\n    \"theme\":\"light\",\n    \"type\": \"serial\",\r\n    \"dataProvider\": [{\r\n        \"country\": \"USA\",\r\n        \"year2004\": 3.5,\r\n        \"year2005\": 4.2\r\n    }, {\r\n        \"country\": \"UK\",\r\n        \"year2004\": 1.7,\r\n        \"year2005\": 3.1\r\n    }, {\r\n        \"country\": \"Canada\",\r\n        \"year2004\": 2.8,\r\n        \"year2005\": 2.9\r\n    }, {\r\n        \"country\": \"Japan\",\r\n        \"year2004\": 2.6,\r\n        \"year2005\": 2.3\r\n    }, {\r\n        \"country\": \"France\",\r\n        \"year2004\": 1.4,\r\n        \"year2005\": 2.1\r\n    }, {\r\n        \"country\": \"Brazil\",\r\n        \"year2004\": 2.6,\r\n        \"year2005\": 4.9\r\n    }, {\r\n        \"country\": \"Russia\",\r\n        \"year2004\": 6.4,\r\n        \"year2005\": 7.2\r\n    }, {\r\n        \"country\": \"India\",\r\n        \"year2004\": 8,\r\n        \"year2005\": 7.1\r\n    }, {\r\n        \"country\": \"China\",\r\n        \"year2004\": 9.9,\r\n        \"year2005\": 10.1\r\n    }],\r\n    \"valueAxes\": [{\r\n        \"stackType\": \"3d\",\r\n        \"unit\": \"%\",\r\n        \"position\": \"left\",\r\n        \"title\": \"Tweets Count\",\r\n    }],\r\n    \"startDuration\": 1,\r\n    \"graphs\": [{\r\n        \"balloonText\": \"GDP grow in [[category]] (2004): <b>[[value]]<\/b>\",\r\n        \"fillAlphas\": 0.9,\r\n        \"lineAlpha\": 0.2,\r\n        \"title\": \"2004\",\r\n        \"type\": \"column\",\r\n        \"valueField\": \"year2004\"\r\n    }, {\r\n        \"balloonText\": \"GDP grow in [[category]] (2005): <b>[[value]]<\/b>\",\r\n        \"fillAlphas\": 0.9,\r\n        \"lineAlpha\": 0.2,\r\n        \"title\": \"2005\",\r\n        \"type\": \"column\",\r\n        \"valueField\": \"year2005\"\r\n    }],\r\n    \"plotAreaFillAlphas\": 0.1,\r\n    \"depth3D\": 60,\r\n    \"angle\": 30,\r\n    \"categoryField\": \"country\",\r\n    \"categoryAxis\": {\r\n        \"gridPosition\": \"start\"\r\n    },\r\n    \"export\": {\r\n    \t\"enabled\": true\r\n     }\r\n});\r\njQuery('.chart-input').off().on('input change',function() {\r\n\tvar property\t= jQuery(this).data('property');\r\n\tvar target\t\t= chart;\r\n\tchart.startDuration = 0;\r\n\r\n\tif ( property == 'topRadius') {\r\n\t\ttarget = chart.graphs[0];\r\n      \tif ( this.value == 0 ) {\r\n          this.value = undefined;\r\n      \t}\r\n\t}\r\n\r\n\ttarget[property] = this.value;\r\n\tchart.validateNow();\r\n});",
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
</main>
</div>
</div>
 
<script type='text/javascript' src='https://www.amcharts.com/wp-includes/js/jquery/jquery.js'></script>
<script type='text/javascript' src='https://www.amcharts.com/wp-content/themes/amcharts2/js/main.js?ver=20171012-02'></script>
<script type='text/javascript' src='https://www.amcharts.com/wp-content/themes/amcharts2/js/demo.js?ver=20171012-02'></script>
<script type='text/javascript' src='https://www.amcharts.com/wp-includes/js/jquery/ui/core.min.js?ver=1.11.4'></script>
<script type='text/javascript' src='https://www.amcharts.com/wp-includes/js/jquery/ui/widget.min.js?ver=1.11.4'></script>
<script type='text/javascript' src='https://www.amcharts.com/wp-includes/js/jquery/ui/mouse.min.js?ver=1.11.4'></script>
<script type='text/javascript' src='https://www.amcharts.com/wp-includes/js/jquery/ui/slider.min.js?ver=1.11.4'></script>
<script type='text/javascript' src='https://www.amcharts.com/wp-content/themes/amcharts2/js/jquery.ui.touch-punch.min.js?ver=20171012-02'></script>
<script type='text/javascript' src='https://www.amcharts.com/wp-content/themes/amcharts2/js/jquery.kinetic.min.js?ver=20171012-02'></script>
<script type='text/javascript' src='https://www.amcharts.com/wp-includes/js/wp-embed.min.js?ver=4.9.5'></script>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-22221037-1', 'auto', {'allowLinker': true});
  ga('send', 'pageview');
  ga('require', 'linker');
  ga('linker:autoLink', ['amcharts.cleverbridge.com']);
</script>
<script type="text/javascript" src="//downloads.mailchimp.com/js/signup-forms/popup/embed.js" data-dojo-config="usePlainJson: true, isDebug: false"></script><script type="text/javascript">require(["mojo/signup-forms/Loader"], function(L) { L.start({"baseUrl":"mc.us1.list-manage.com","uuid":"0a74d1bfdc666e9fa96b39e15","lid":"f7af0fa56b"}) })</script>
<script type="text/javascript">window.NREUM||(NREUM={});NREUM.info={"beacon":"bam.nr-data.net","licenseKey":"2b927c5092","applicationID":"5849300","transactionName":"NABbZxNUWRAEWhcKWA1KeFAVXFgNSkoKDVAPABRXBFhY","queueTime":0,"applicationTime":1436,"atts":"GEdYEVtOSh4=","errorBeacon":"bam.nr-data.net","agent":""}</script></body>
</html>