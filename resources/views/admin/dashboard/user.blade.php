@extends('admin.layouts.app')

@section('title', 'Blogs - Listes ')

@section('breadcrumb')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
        <h2>Statistiques</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item active">
                <strong>@lang('app.products')</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <div class="title-action">
            
        </div>
    </div>
</div>

@endsection

@section('content')
<div class="row">
	<div class="col-lg-6">
		<div class="ibox float-e-margins">
			<div class="ibox-title">
				<h5>Repartition des utilisateurs par Etats</h5>
			</div>
			<div class="ibox-content">
				<div class="flot-chart">
					<div class="flot-chart-content" id="chart-location"></div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-6">
		<div class="ibox float-e-margins">
			<div class="ibox-title">
				<h5>Repartition des utilisateurs par date</h5>
			</div>
			<div class="ibox-content">
				<div class="flot-chart">
					<div class="flot-chart-content" id="chart-date"></div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('custom-script')
<script src="{{asset('administrator/amcharts/amcharts.js')}}"></script>
<script src="{{asset('administrator/amcharts/xy.js')}}"></script>
<script src="{{asset('administrator/amcharts/funnel.js')}}"></script>
<script src="{{asset('administrator/amcharts/pie.js')}}"></script>
<script src="{{asset('administrator/amcharts/serial.js')}}"></script>
<script src="{{asset('administrator/amcharts/gantt.js')}}"></script>
<script src="{{asset('administrator/amcharts/gauge.js')}}"></script>
<script src="{{asset('administrator/amcharts/radar.js')}}"></script>
<script type="text/javascript">
    
function drawLocationChart($data){
    var chart = AmCharts.makeChart( "chart-location", {
      "type": "pie",
      "dataProvider": $data,
      "valueField": "number",
      "titleField": "location",
       "balloon":{
        "fixedPosition":true
      }
    });

}
function loadLocationData() {
    $.ajax({
        url: "{{route('admin.chart.locations', array('type'=>'user'))}}",
        ifModified:true,
        success: function(content){
            drawLocationChart(content.data);
        }
    });
}
loadLocationData();
    
function drawDateChart($data){
    var chart = AmCharts.makeChart("chart-date", {
        "type": "serial",
        "theme": "light",
        "marginRight": 40,
        "marginLeft": 40,
        "autoMarginOffset": 20,
        "mouseWheelZoomEnabled":true,
        "dataDateFormat": "YYYY-MM-DD",
        "valueAxes": [{
            "id": "v1",
            "axisAlpha": 0,
            "position": "left",
            "ignoreAxisWidth":true
        }],
        "balloon": {
            "borderThickness": 1,
            "shadowAlpha": 0
        },
        "graphs": [{
            "id": "g1",
            "balloon":{
              "drop":true,
              "adjustBorderColor":false,
              "color":"#ffffff"
            },
            "bullet": "round",
            "bulletBorderAlpha": 1,
            "bulletColor": "#FFFFFF",
            "bulletSize": 5,
            "hideBulletsCount": 50,
            "lineThickness": 2,
            "title": "red line",
            "useLineColorForBulletBorder": true,
            "valueField": "number",
            "balloonText": "<span style='font-size:18px;'>[[number]]</span>"
        }],
        "chartScrollbar": {
            "graph": "g1",
            "oppositeAxis":false,
            "offset":30,
            "scrollbarHeight": 80,
            "backgroundAlpha": 0,
            "selectedBackgroundAlpha": 0.1,
            "selectedBackgroundColor": "#888888",
            "graphFillAlpha": 0,
            "graphLineAlpha": 0.5,
            "selectedGraphFillAlpha": 0,
            "selectedGraphLineAlpha": 1,
            "autoGridCount":true,
            "color":"#AAAAAA"
        },
        "chartCursor": {
            "pan": true,
            "valueLineEnabled": true,
            "valueLineBalloonEnabled": true,
            "cursorAlpha":1,
            "cursorColor":"#258cbb",
            "limitToGraph":"g1",
            "valueLineAlpha":0.2,
            "valueZoomable":true
        },
        "valueScrollbar":{
          "oppositeAxis":false,
          "offset":50,
          "scrollbarHeight":10
        },
        "categoryField": "date",
        "categoryAxis": {
            "parseDates": true,
            "dashLength": 1,
            "minorGridEnabled": true
        },
        "export": {
            "enabled": true
        },
        "dataProvider" : $data
      });

}
function loadDateData() {
    $.ajax({
        url: "{{route('admin.chart.dates')}}",
        ifModified:true,
        success: function(content){
            drawDateChart(content.data);
        }
    });
}
loadDateData();
    
</script>
@endsection

