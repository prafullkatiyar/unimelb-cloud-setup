<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <title>Simple markers</title>
	<link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
	  #info-box {
        background-color: white;
        border: 1px solid black;
        bottom: 30px;
        height: 20px;
        padding: 10px;
        position: absolute;
        left: 30px;
		opacity 0.9;
      }
	  
	  #info-box1 {
        background-color: white;
        border: 1px solid black;
        top: 30px;
        right: 30px;
        height: 20px;
        padding: 10px;
        position: absolute;
		opacity 0.9;
		top: 0;
		right: 0;
		width: 70%;
      }
	  
	  div.fixed {
			 position: fixed;
			bottom: 0;
			right: 0;
			width: 300px;
		}
    </style>
  </head>
  <body>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
			<div class="container">
				
				<code> Negative : 3k &lt black &lt 4k, 4k &lt maroon &lt 5k, 5k &lt aqua &lt 6k,  14k &lt golden  </code>
			</div>
			<div class="collapse navbar-collapse" id="navbarResponsive">
			  <ul class="navbar-nav ml-auto">
				<li class="nav-item active">
					<a href="index" type="button" class="btn btn-success" onclick="aurinButtons(box2, this, '#21315b')" style="margin-left: 10px;">Home Page</a>
				</li>
			  </ul>
			</div>
	</nav>
    <div id="map"></div>
	<div class="fixed" >
			<img src="twitter.png"/>
	</div>
	 
	<!-- 
	<div id="info-box1">
		Clusted and cloud computing project 2
	</div>
	-->
    <script>
	
	
		 
	function initMap() 
	{
			var melbourne = {lat: -37.81, lng: 144.96};
			var map = new google.maps.Map(document.getElementById('map'), {
				zoom: 10,
				center: melbourne
			});
			
			var points = [];
			var su;
			var xhr = new XMLHttpRequest();
			xhr.open('GET', 'suburb_sentiment-SA2polygon.json', false);
			xhr.onload = function() {
				var data = JSON.parse(xhr.responseText);
				data.rows.forEach(function(suburb) {
					su = suburb.key['SA2_NAME16'];
					
					var pos = suburb.value['positive'];
					var colorPos = "red";
					radPos = pos/100;
					if(pos>3000 && pos < 4000) {
						radPos = 15;
						colorPos = "yellow";
					}
					if(pos>4000 && pos< 5000) {
						radPos = 15;
						colorPos = "green";
					}
					if(pos>5000 && pos< 6000) {
						radPos = 15;
						colorPos = "blue";
					}
					if(pos>6000 && pos< 7000) {
						radPos = 15;
						colorPos = "lime";
					}
					if(pos>15000) {
						radPos = 15;
						colorPos = "silver";
					}
					
					 
					var neg = suburb.value['negative'];
					var colorNeg = "olive";
					radNeg = neg/100;
					if(neg>3000 && neg < 4000) {
						radNeg = 10;
						colorNeg = "black";
					}
					if(neg>4000 && neg< 5000) {
						radNeg = 10;
						colorNeg = "maroon";
					}
					if(neg>5000 && neg< 6000) {
						radNeg = 10;
						colorNeg = "aqua";
					}
					if(neg>14000) {
						radNeg = 10;
						colorNeg = "golden";
					}
					
					
					
					
					var points = getPoints(su);
					
					var m = {lat: points[0], lng: points[1]};
					
					var marker = new google.maps.Marker({
						position: m,
						icon: getCircle(radPos,colorPos),
						map: map,
						title: su+' Positive: '+pos
					});
					
					var marker = new google.maps.Marker({
						position: m,
						icon: getCircle(radNeg,colorNeg),
						map: map,
						title: su+' Negative: '+neg
					});
				});
			};
			xhr.send();
	}
	
	function getCircle(magnitude,c) {
        return {
          path: google.maps.SymbolPath.CIRCLE,
          fillColor: c,
          fillOpacity: .8,
         // scale: Math.pow(2, magnitude) / 2,
          scale: magnitude,
          strokeColor: 'white',
          strokeWeight: .5
        };
    }
	
	function getPoints(sa2_name) 
	{
		//console.log(sa2_name);
		var coordArray2 = [];
		var xhr = new XMLHttpRequest();
		xhr.open('GET', 'location_coordinates.json', false);
		xhr.onload = function() {
		var data = JSON.parse(xhr.responseText);
			var index = 0;
			var f = data.rows[index].sa2_name;
			coordArray2[0] = data.rows[index][sa2_name].coordinates[0];
			coordArray2[1] = data.rows[index][sa2_name].coordinates[1];
			//console.log(f.coordinates[0]);
		};
		xhr.send();
		return coordArray2;
	}
	
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBe0V7f-KFrbBPNZ1fsbRSNEKVeLGjTsxg&callback=initMap">
    </script>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-bottom">
		  <div class="container">
			<code> Positive: 3k &lt yellow &lt 4k, 4k &lt green &lt 5k ,   5k &lt blue &lt 6k,  6k &lt lime &lt 7k ,  silver &lt 15k </code>
		  </div>
		</nav>
  </body>
</html>