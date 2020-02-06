const mapStyle = [{
    'featureType': 'all',
    'elementType': 'all',
    'stylers': [{'visibility': 'on'}]
}, {
    'featureType': 'landscape',
    'elementType': 'geometry',
    'stylers': [{'visibility': 'on'}]
}, {
    'featureType': 'water',
    'elementType': 'labels',
    'stylers': [{'visibility': 'on'}]
}, {
    'featureType': 'water',
    'elementType': 'geometry',
    'stylers': [{'visibility': 'on'}, {'hue': '#5f94ff'}, {'lightness': 60}]
}];
var map;
var map2;
var heatmap;
var infoWindow;
var dataMin = Number.MAX_VALUE, dataMax = -Number.MAX_VALUE;


// define constants
const box1 = 'p_tot_tot';
const box2 = 'p_tot_married';
const box3 = 'p_tot_never_married';
const sentimentjson = 'twitter/_design/GeoData/_view/suburb_sentiment-SA2polygon.json';
const melbourne = {lat: -37.81, lng: 144.96};
const JSON_file = 'aurin/Marriage_data.json';
const MELB_GRID = 'MELB_SA2_GRID.json';

const pub_trans = 'twitter/_design/GeoData/_view/public_transport_sentiment-coordinates.json';
const police = 'twitter/_design/GeoData/_view/police_sentiment-coordinates.json';
const government = 'twitter/_design/GeoData/_view/government_sentiment-coordinates.json';
const policeGraph = 'twitter/_design/GraphData/_view/police_sentiment.json';
const weatherGraph = 'twitter/_design/GraphData/_view/weather_sentiment.json';


function initMap() {
    // load the map
    map = new google.maps.Map(document.getElementById('map'), {
        center: melbourne,
        zoom: 10,
        styles: mapStyle
    });

    infoWindow = new google.maps.InfoWindow;

    // set up the style rules and events for google.maps.Data
    map.data.setStyle(styleFeature);
    map.data.addListener('mouseover', mouseInToRegion);
    map.data.addListener('mouseout', mouseOutOfRegion);
    map.data.addListener('click', clickInRegion);

    // state polygons only need to be loaded once, do them now
    loadMapShapes();
}


function initMap2() {
    // load the map
    map2 = new google.maps.Map(document.getElementById('map2'), {
        center: melbourne,
        zoom: 10,
        styles: mapStyle
    });



    // set up the style rules and events for google.maps.Data
    map2.data.setStyle(styleFeature);
    map2.data.addListener('mouseover', mouseInToRegion);
    map2.data.addListener('mouseout', mouseOutOfRegion);
    map2.data.addListener('click', clickInRegion);
}

function add_heatmap(file,sentiment) {
    try {
        heatmap.setData([]);
    }
    catch(err){
        console.log("no heatmap");
    }
    heatmap = new google.maps.visualization.HeatmapLayer({
        data: getPoints(file,sentiment),
        map: map2,
        radius: 30
    });
}

function getPoints(file,sentiment) {
    var coordArray2 = [];

    var xhr = new XMLHttpRequest();
    xhr.open('GET', file, false);
    xhr.onload = function() {
        var data = JSON.parse(xhr.responseText);
        data.rows[sentiment].value.forEach(function(coord) {
            var latitude = coord[1];
            var longitude = coord[0];
            coordArray2.push(new google.maps.LatLng(latitude,longitude));
        });
    };
    xhr.send();

    return coordArray2;
}

/** Loads the state boundary polygons from a GeoJSON source. */
function loadMapShapes() {
    // load suburb polygons
    map.data.loadGeoJson(MELB_GRID, { idPropertyName: 'sa2_main16' });

    // wait for the request to complete by listening for the first feature to be
    // added
    google.maps.event.addListenerOnce(map.data, 'addfeature', function() {
        google.maps.event.trigger(document.getElementById('data-variable'),
            'change');
    });
}

/**load JSON data from file. Add desired property to map data to be graphed */
function loadAurinData(variable) {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', JSON_file, false);
    xhr.onload = function() {
        var censusData = JSON.parse(xhr.responseText);
        censusData.features.forEach(function(row) {
            var dataVariable = row.properties[variable];
            var suburbName = row.properties.sa2_main16;

            // keep track of min and max values
            if (dataVariable < dataMin) {
                dataMin = dataVariable;
            }
            if (dataVariable > dataMax) {
                dataMax = dataVariable;
            }
            // update the existing row with the new data
            map.data
                .getFeatureById(suburbName)
                .setProperty('data_Variable', dataVariable);
        });
        var quarter=(dataMax-dataMin)/4+dataMin;
        var half=2*(dataMax-dataMin)/4+dataMin;
        var threequarter=3*(dataMax-dataMin)/4+dataMin;
        // update and display the legend
        document.getElementById('data-min').textContent =
            dataMin.toLocaleString();
        document.getElementById('data-max').textContent =
            dataMax.toLocaleString();
        document.getElementById('data-25pc').textContent =
            Math.round(quarter).toLocaleString();
        document.getElementById('data-50pc').textContent =
            Math.round(half).toLocaleString();
        document.getElementById('data-75pc').textContent =
            Math.round(threequarter).toLocaleString();
    };
    xhr.send();
}

function loadNectarData(view,sentiment) {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', view, true);
    xhr.onload = function() {
        var nectarData = JSON.parse(xhr.responseText);
        nectarData.rows.forEach(function(row) {
            var Nnegative = row.value["negative"];
            var Npositive = row.value["positive"];
            var Nneutral = row.value["neutral"];
            var dataVariable = (row.value[sentiment]/(Nnegative+Nneutral+Npositive))*100
            var suburbName = row.key.SA2_MAIN16;

            // plotting percent
            dataMin = 0;
            dataMax = 100;
            // update the existing row with the new data
            map.data
                .getFeatureById(suburbName)
                .setProperty('data_Variable', dataVariable);
        });
        var quarter=(dataMax-dataMin)/4+dataMin;
        var half=2*(dataMax-dataMin)/4+dataMin;
        var threequarter=3*(dataMax-dataMin)/4+dataMin;
        // update and display the legend
        document.getElementById('data-min').textContent =
            dataMin.toLocaleString();
        document.getElementById('data-max').textContent =
            dataMax.toLocaleString();
        document.getElementById('data-25pc').textContent =
            Math.round(quarter).toLocaleString();
        document.getElementById('data-50pc').textContent =
            Math.round(half).toLocaleString();
        document.getElementById('data-75pc').textContent =
            Math.round(threequarter).toLocaleString();
    };
    xhr.send();
}

// Remove data from each shape on the map and resets the UI.
function clearData() {
    dataMin = Number.MAX_VALUE;
    dataMax = -Number.MAX_VALUE;
    map.data.forEach(function(row) {
        row.setProperty('data_Variable', undefined);
    });
    document.getElementById('data-box').style.display = 'none';
    document.getElementById('data-caret').style.display = 'none';
    document.getElementById('data-min').textContent = 'max';
    document.getElementById('data-25pc').textContent = ' ';
    document.getElementById('data-50pc').textContent = ' ';
    document.getElementById('data-75pc').textContent = ' ';
    document.getElementById('data-max').textContent = 'min';
}

// Applies a gradient style based on the 'data_Variable' column.
function styleFeature(feature) {
    var low = [236, 78, 64];  // color of smallest datum
    var high = [360, 69, 54];   // color of largest datum

    // delta represents where the value sits between the min and max
    var delta = (feature.getProperty('data_Variable') - dataMin) /
        (dataMax - dataMin);

    var color = [];
    for (var i = 0; i < 3; i++) {
        // calculate an integer color based on the delta
        color[i] = (high[i] - low[i]) * delta + low[i];
    }

    // determine whether to show this shape or not
    var showRow = true;
    if (feature.getProperty('data_Variable') == null ||
        isNaN(feature.getProperty('data_Variable'))) {
        showRow = false;
    }

    var outlineWeight = 0.5, zIndex = 1;
    if (feature.getProperty('state') === 'hover') {
        outlineWeight = zIndex = 2;
    }

    return {
        strokeWeight: outlineWeight,
        strokeColor: 'white',
        zIndex: zIndex,
        fillColor: 'hsl(' + color[0] + ',' + color[1] + '%,' + color[2] + '%)',
        fillOpacity: 0.8,
        visible: showRow
    };
}

// Responds to the mouse-in event on a map shape (state).

function mouseInToRegion(e) {
    // set the hover state so the setStyle function can change the border
    e.feature.setProperty('state', 'hover');

    var percent = (e.feature.getProperty('data_Variable') - dataMin) /
        (dataMax - dataMin) * 100;

    // update the label
    document.getElementById('data-label').textContent =
        e.feature.getProperty('sa2_name16');
    document.getElementById('data-value').textContent =
        e.feature.getProperty('data_Variable').toLocaleString();
    document.getElementById('data-box').style.display = 'block';
    document.getElementById('data-caret').style.display = 'block';
    document.getElementById('data-caret').style.paddingTop = percent*15.7 + '%';
}

// Responds to the mouse-out event on a map shape (state).
function mouseOutOfRegion(e) {
    // reset the hover state, returning the border to normal
    e.feature.setProperty('state', 'normal');
}

function clickInRegion(e) {
    var regionName = e.feature.getProperty('sa2_name16');
    var regionData = e.feature.getProperty('data_Variable').toLocaleString();

    var infoString = '<b>' + regionName + '</b><br>' + '<b>Value: </b>' + regionData;

    infoWindow.setContent(infoString);
    infoWindow.setPosition(e.latLng);

    infoWindow.open(map);
}

function openPage(pageName,elmnt,color,map) {
    if (map === 'map1'){
        initMap()
    }
    if (map === 'map2'){
        initMap2()
    }
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablink");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].style.backgroundColor = "";
    }
    document.getElementById(pageName).style.display = "block";
    elmnt.style.backgroundColor = color;
}
// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();

function aurinButtons(buttonContent,elmnt, color){
    clearData();
    loadAurinData(buttonContent);
    buttons = document.getElementsByClassName("databutton");
    for (i = 0; i < buttons.length; i++) {
        buttons[i].style.backgroundColor = "";
    }
    elmnt.style.backgroundColor = color;
}

function nectarButtons(buttonContent,sentiment,elmnt, color){
    clearData();
    loadNectarData(buttonContent,sentiment);
    buttons = document.getElementsByClassName("databutton");
    /*
	for (i = 0; i < buttons.length; i++) {
        buttons[i].style.backgroundColor = "";
    }
    elmnt.style.backgroundColor = color;
	*/
};

var allNeu = graphdata(policeGraph, 0,"neutral");
var allPos = graphdata(policeGraph, 0,'positive');
var allNeg = graphdata(policeGraph, 0,'negative');
document.getElementById("all_neu").style.width = allNeu.toString() + "%";
document.getElementById("all_pos").style.width = allPos.toString() + "%";
document.getElementById("all_neg").style.width = allNeg.toString() + "%";

var policeNeu= graphdata(policeGraph, 1,"neutral");
var policePos = graphdata(policeGraph, 1,'positive');
var policeNeg = graphdata(policeGraph, 1,'negative');
document.getElementById("police_neu").style.width = policeNeu.toString() + "%";
document.getElementById("police_pos").style.width = policePos.toString() + "%";
document.getElementById("police_neg").style.width = policeNeg.toString() + "%";


var rainyNeu = graphdata(weatherGraph, 1,'neutral');
var rainyPos = graphdata(weatherGraph, 1,'positive');
var rainyNeg = graphdata(weatherGraph, 1,'negative');
document.getElementById("rainy_neu").style.width = rainyNeu.toString() + "%";
document.getElementById("rainy_pos").style.width = rainyPos.toString() + "%";
document.getElementById("rainy_neg").style.width = rainyNeg.toString() + "%";

var sunnyNeu = graphdata(weatherGraph, 2,'neutral');
var sunnyPos = graphdata(weatherGraph, 2,'positive');
var sunnyNeg = graphdata(weatherGraph, 2,'negative');
document.getElementById("sunny_neu").style.width = sunnyNeu.toString() + "%";
document.getElementById("sunny_pos").style.width = sunnyPos.toString() + "%";
document.getElementById("sunny_neg").style.width = sunnyNeg.toString() + "%";

console.log(allNeu,allNeg,allPos);
console.log(policeNeu,policeNeg,policePos);
console.log(rainyNeu,rainyNeg,rainyPos);
console.log(sunnyNeu,sunnyNeg,sunnyPos);

function graphdata(file, index,wanted) {
    var result;
    var xhr = new XMLHttpRequest();
    xhr.open('GET', file, false);
    xhr.onload = function () {
        var data = JSON.parse(xhr.responseText);
        var total = data.rows[index].value["neutral"] + data.rows[index].value["positive"] + data.rows[index].value["negative"];
        result = (100 * data.rows[index].value[wanted] / total);
    };
    xhr.send();
    return result;
};

