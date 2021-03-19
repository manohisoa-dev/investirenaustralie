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
				<h5>Repartition des produits par Etats</h5>
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
				<h5>Repartition des produits par prix</h5>
			</div>
			<div class="ibox-content">
				<div class="flot-chart">
					<div class="flot-chart-content" id="chart-price"></div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-6">
		<div class="ibox float-e-margins">
			<div class="ibox-title">
				<h5>Repartition des produits par type</h5>
			</div>
			<div class="ibox-content">
				<div class="flot-chart">
					<div class="flot-chart-content" id="chart-category"></div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-6">
		<div class="ibox float-e-margins">
			<div class="ibox-title">
				<h5>Repartition des produits par vendeur</h5>
			</div>
			<div class="ibox-content">
				<div class="flot-chart">
					<div class="flot-chart-content" id="chart-seller-type"></div>
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
function drawCategoryChart($data){
    var chart = AmCharts.makeChart("chart-category", {
      "type": "serial",
      "theme": "light",
      "marginRight": 70,
      "dataProvider": $data,
      "valueAxes": [{
        "axisAlpha": 0,
        "position": "left",
        "title": "Nombres de produits"
      }],
      "startDuration": 1,
      "graphs": [{
        "balloonText": "<b>[[type]]: [[number]]</b>",
        "fillColorsField": "color",
        "fillAlphas": 0.9,
        "lineAlpha": 0.2,
        "type": "column",
        "valueField": "number"
      }],
      "chartCursor": {
        "categoryBalloonEnabled": false,
        "cursorAlpha": 0,
        "zoomable": false
      },
      "categoryField": "type",
      "categoryAxis": {
        "gridPosition": "start",
        "labelRotation": 45
      },
      "export": {
        "enabled": true
      }
    });

}
function loadCategoryData() {
    $.ajax({
        url: "{{route('admin.chart.categories')}}",
        ifModified:true,
        success: function(content){
            drawCategoryChart(content.data);
        }
    });
}
loadCategoryData();
    

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
        url: "{{route('admin.chart.locations', ['type'=>'product'])}}",
        ifModified:true,
        success: function(content){
            drawLocationChart(content.data);
        }
    });
}
loadLocationData();
    
function drawPriceChart($data){
    var chart =  AmCharts.makeChart( "chart-price", {
        "type": "funnel",
        "theme": "light",
        "dataProvider": $data,
        "balloon": {
          "fixedPosition": true
        },
        "valueField": "number",
        "titleField": "label",
        "marginRight": 240,
        "marginLeft": 50,
        "startX": -500,
        "rotate": true,
        "labelPosition": "right",
        "balloonText": "[[label]]: [[number]]",
      }
    );

}
function loadPriceData() {
    $.ajax({
        url: "{{route('admin.chart.prices')}}",
        ifModified:true,
        success: function(content){
            drawPriceChart(content.data);
        }
    });
}
loadPriceData();
    
function drawSellerChart($data){
    var chart = AmCharts.makeChart("chart-seller-type", {
      "type": "serial",
      "theme": "light",
      "marginRight": 70,
      "dataProvider": $data,
      "valueAxes": [{
        "axisAlpha": 0,
        "position": "left",
        "title": "Nombres de produits"
      }],
      "startDuration": 1,
      "graphs": [{
        "balloonText": "<b>[[type_user_name]]: [[number]]</b>",
        "fillColorsField": "color",
        "fillAlphas": 0.9,
        "lineAlpha": 0.2,
        "type": "column",
        "valueField": "number"
      }],
      "chartCursor": {
        "categoryBalloonEnabled": false,
        "cursorAlpha": 0,
        "zoomable": false
      },
      "categoryField": "type_user_name",
      "categoryAxis": {
        "gridPosition": "start",
        "labelRotation": 45
      }
    });

}
function loadSellerData() {
    $.ajax({
        url: "{{route('admin.chart.sellers')}}",
        ifModified:true,
        success: function(content){
			console.log(content);
            drawSellerChart(content.data);
        }
    });
}
loadSellerData();
    
function check_demande($url) {
    $.ajax({
        url: $url,
        ifModified:true,
        success: function(content){
            $('#demandes').html(content); //span où tu veux que ce nombre apparaisse
        }
    });
    setTimeout(check_demande, 5000);
}
//check_demande();
</script>
@endsection

