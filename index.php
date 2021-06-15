<?php include 'header.php';?>


<?php date_default_timezone_set('asia/ho_chi_minh'); echo ' <i style="margin-left:2em" class="fa fa-calendar" aria-hidden="true" ></i><label > '.date('d/m/Y h:i:s a'). ' </label> '.'<br/>';?> 
 <div class="container" style="height:410px;min-height:100px;margin:0 auto;" id="main"> </div>  


<script type="text/javascript">
var myArr={"temp":"9","humi":"8"};
var json_temp=0,json_humi=0;
var nhiet=0,am=0;
Highcharts.setOptions({
global: {
useUTC: false
}
});
function activeLastPointToolip(chart) {
var points = chart.series[0].points;
chart.tooltip.refresh(points[points.length -1]);
}

// alert(json_temp);
$('#main').highcharts({
//	Highcharts.chart('main', {
chart: {
type: 'spline',
animation: Highcharts.svg,
marginRight: 10,
events: {
load: function () {
	
var series_temp = this.series[0],
series_humi = this.series[1],
chart = this;
setInterval(function () {
		var xmlhttp = new XMLHttpRequest();
		var url = "data.json";
		xmlhttp .overrideMimeType("application/json");
		xmlhttp.onreadystatechange = function() {
		    if (this.readyState == 4 && this.status == 200) {
		         myArr = JSON.parse(this.responseText);				
		          json_temp = myArr['temp'];
       		      json_humi = myArr['humi'];		
			$('#temp').append("<b class='tam' style='color:red'>"+json_temp+" °C</b>");
			$('#humi').append("<b class='tam' style='color:blue'>"+json_humi+" %</b>");
		    console.log("Temp:", json_temp );
   			console.log("Humi:", json_humi );
			  
		    }
		};
		xmlhttp.open("GET", url, true);
		xmlhttp.send();
		
		var x = (new Date()).getTime(), 
		y_temp = Number(json_temp);
		y_humi = Number(json_humi);
		console.log(typeof(y_temp));
		console.log("YT:", y_temp);
		console.log("YH", y_humi);
		
		series_temp.addPoint([x, y_temp], true, true);		
		series_humi.addPoint([x, y_humi], true, true);
		activeLastPointToolip(chart);
		$('.tam').remove();
	
}, 10000);
}
}
},
title: {
text: 'Environment Data Logger'
},
subtitle: {
        text: '.................'
    },
credits: { 
enabled: false 
},
xAxis: {
type: 'datetime',
tickPixelInterval: 150
},
yAxis: {
title: {
text: 'values'
},
plotLines: [{
value: 0,
width: 1,
color:'#808080'
}]
},
plotOptions: {
        line: {
            dataLabels: {
                enabled: true
            },
            enableMouseTracking: false
        }
    },
tooltip: {
formatter: function () {
return '<b>' + this.series.name + '</b><br/>' +
Highcharts.dateFormat('%Y-%m-%d %H:%M:%S', this.x) + '<br/>' +
Highcharts.numberFormat(this.y, 2);
}
},
legend: {
	backgroundColor: '#FCFFC5',
        borderColor: '#C98657',
        borderWidth: 1,
enabled: true
},
exporting: {
enabled: false
},
series: [
{
name: 'Temperature (°C)',
zones: [{  
    color: 'red'  
}],
color: 'red',
data: (function () {
// generate an array of random data
var data = [],
time = (new Date()).getTime(),
i;
for (i = -19; i <= 0; i += 1) {
data.push({	
x: time + i * 1000,
y: 0 //Math.random()
});
}

return data;
}())

},
{
name: 'Humi (%)',
zones: [{  
    color: 'blue'  
}],
color: 'blue',
data: (function () {
// generate an array of random data
var data = [],
time = (new Date()).getTime(),
i;
for (i = -19; i <= 0; i += 1) {
data.push({
x: time + i * 1000,
y: 0//Math.random()
});
}
return data;
}())
}]
}, function(c) {
activeLastPointToolip(c)
});
</script>

<table class="container" style="margin-top:3em">
  <tr style=" background-color:lightgray; ">
    <td id="temp">
		
	  <span class="nhan">Soil temperature</span><br/>
	  <i class="fa fa-thermometer-half" aria-hidden="true" ></i>  
	</td>
    <td id="humi">	
      <span class="nhan">Soil moisture</span><br/>
	  <i class="fa fa-tint"></i>   
	</td>
    <td id="temp">	
      <span class="nhan">Air temperature</span><br/>
	  <i class="fa fa-thermometer-half" aria-hidden="true" ></i>
	  <b style="color:red">29.45 °C</b>
	</td>
	<td id="humi">
      <span class="nhan">Air moisture</span><br/>
	  <i class="fa fa-tint"></i>
	  <b style="color:blue">56 %</b>
	</td>

  </tr>
 
</table>

 	<!-- <div id="demo0" class="alert alert-warning col-sm-4" 	>	
	 <span>Date: </span> <br/>
	 <i class="fa fa-calendar" aria-hidden="true" ></i>
	 
	 <?php date_default_timezone_set('asia/ho_chi_minh'); echo '<strong>'.date('d/m/Y h:i:s a'). ' </strong> '.'<br/>';?> 
	 </div> -->
</body>
</html> 