<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Creating Dynamic Tabs in Bootstrap 4 via JavaScript</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

<link href="{{ URL::to('jqplot/jquery.jqplot.min.css') }}" rel="stylesheet">
<script src="{{ URL::to('jqplot/jquery.jqplot.js') }}"></script>
<script src="{{ URL::to('jqplot/plugins/jqplot.canvasTextRenderer.js') }}"></script>
<script src="{{ URL::to('jqplot/plugins/jqplot.canvasAxisLabelRenderer.js') }}"></script>

<style>
  .bs-example{
      margin: 20px;
    }
</style>

</head>
<body>

<div class="bs-example">
    <ul id="myTab" class="nav nav-pills">
        <li class="nav-item">
            <a href="#bb_tb" class="nav-link active"  id="tab_bb_tb">BB / TB</a>
        </li>
        <li class="nav-item">
            <a href="#tb_u" class="nav-link" id="tab_tb_u">TB/U</a>
        </li>
        <li class="nav-item">
            <a href="#bb_u" class="nav-link"  id="tab_bb_u">BB/U</a>
        </li>        
    </ul>
    <div class="tab-content">
        <div class="tab-pane fade show active" id="bb_tb">
            
            <div id="chart_bb_tb" style="margin-top:20px; margin-left:20px; width:400px; height:600px;"></div>
            
        </div>
        <div class="tab-pane fade" id="tb_u">
            <h5 class="mt-2">Grafik Tinggi badan / Usia</h5>
            
        </div>
        <div class="tab-pane fade" id="bb_u">
            <h5 class="mt-2">Grafik Berat badan / Usia</h5>
             <div id="chart_bb_u" style="margin-top:20px; margin-left:20px; width:400px; height:600px;"></div>
        </div>       
    </div>
</div>

<script>
  
  $(document).ready(function(){
        //bb_tb
        var l0 = [{{ $bb_tb_min_3_sd }} ];
        var l1 = [{{ $bb_tb_min_2_sd }} ];
        var l2 = [{{ $bb_tb_min_1_sd }}];
        var l3 = [{{ $bb_tb_median }}];
        var l4 = [{{ $bb_tb_plus_1_sd }}];
        var l5 = [{{ $bb_tb_plus_2_sd }}];
        var l6 = [{{ $bb_tb_plus_3_sd }}];

        var l7 = [{{ $bb_tb_array_anak }}];



        var plot1 = $.jqplot("chart_bb_tb", [l0, l1, l2, l3, l4, l5, l6, l7], {
        title: "Grafik Berat Badan Menurut Tinggi Badan",

        axesDefaults: {
            // pad: 0.5
        },
        axes:{
          xaxis:{
            min : 45,
            max : 120,
            tickInterval: 10,
            label:'Tinggi Badan (Cm)',
            labelRenderer: $.jqplot.CanvasAxisLabelRenderer
          },
          yaxis:{
            min:0,
            tickInterval: 4,
            label:'Berat Badan (Kg)',
            labelRenderer: $.jqplot.CanvasAxisLabelRenderer
          }
        },
        //////
        // Use the fillBetween option to control fill between two
        // lines on a plot.
        //////
        fillBetween: {
            // series1: Required, if missing won't fill.
            series1: [0,1,2,3,4,5],
            // series2: Required, if  missing won't fill.
            series2: [1,2,3,4,5,6],
            // color: Optional, defaults to fillColor of series1.
            color: ["rgba(255,215,0, 0.7)","rgba(253,253,97, 0.7)","rgba(69,139,116,0.7)","rgba(69,139,116,0.7)","rgba(253,253,97, 0.7)","rgba(255,215,0, 0.7)"],
            // baseSeries:  Optional.  Put fill on a layer below this series
            // index.  Defaults to 0 (first series).  If an index higher than 0 is
            // used, fill will hide series below it.
            // baseSeries: 0,
            // fill:  Optional, defaults to true.  False to turn off fill.
            fill: true
        },

        // seriesColors:['#cd5c5c', '#21252b', '#21252b', '#21252b', '#21252b','#21252b','#21252b','#34B7EA'],
        seriesDefaults: {
            rendererOptions: {
                //////
                // Turn on line smoothing.  By default, a constrained cubic spline
                // interpolation algorithm is used which will not overshoot or
                // undershoot any data points.
                //////
                smooth: true
            },
            // showMarker: false,
            lineWidth: 1,
        },
        series:[
          {
            showMarker: false,
            lineWidth: 1.5,
            color : '#cd5c5c'
          },
          {
            showMarker: false,
            lineWidth: 0.5,
            color :  '#000000'
          },
          {
            showMarker: false,
            lineWidth: 0.5,
            color :  '#000000'
          },
          {
            showMarker: false,
            lineWidth: 0.5,
            color :  '#000000'
          },
          {
            showMarker: false,
            lineWidth: 0.5,
            color :  '#000000'
          },
          {
            showMarker: false,
            lineWidth: 0.5,
            color :  '#000000'
          },
          {
            showMarker: false,
            lineWidth: 0.5,
            color :  '#000000'
          },
          {
            // lineWidth: 3,
            showMarker: true,
            color :  '#000000',
            showLine : false,
            markerOptions: { size: 7, style:"x" }
          }
        ]
    });


    var l8 = [{{ $bb_u_min_3_sd }} ];
    var l9 = [{{ $bb_u_min_2_sd }} ];
    var l10 = [{{ $bb_u_min_1_sd }}];
    var l11 = [{{ $bb_u_median }}];
    var l12 = [{{ $bb_u_plus_1_sd }}];
    var l13 = [{{ $bb_u_plus_2_sd }}];
    var l14 = [{{ $bb_u_plus_3_sd }}];

    var l15 = [{{ $bb_u_array_anak }}];
    

    var plot2 = $.jqplot("chart_bb_u", [l8, l9, l10, l11, l12, l13, l14, l15], {
        title: "Grafik Berat Badan Menurut Usia",

        axesDefaults: {
            // pad: 0.5
        },
        axes:{
          xaxis:{
            min : 0,
            max : 60,
            tickInterval: 10,
           label:'Umur (Bulan)',
            labelRenderer: $.jqplot.CanvasAxisLabelRenderer
          },
          yaxis:{
            min:0,
            tickInterval: 4,
           label:'Berat Badan (Kg)',
            labelRenderer: $.jqplot.CanvasAxisLabelRenderer
          }
        },
        //////
        // Use the fillBetween option to control fill between two
        // lines on a plot.
        //////
        fillBetween: {
            // series1: Required, if missing won't fill.
            series1: [0,1,2,3,4,5],
            // series2: Required, if  missing won't fill.
            series2: [1,2,3,4,5,6],
            // color: Optional, defaults to fillColor of series1.
            color: ["rgba(255,215,0, 0.7)","rgba(253,253,97, 0.7)","rgba(69,139,116,0.7)","rgba(69,139,116,0.7)","rgba(253,253,97, 0.7)","rgba(255,215,0, 0.7)"],
            // baseSeries:  Optional.  Put fill on a layer below this series
            // index.  Defaults to 0 (first series).  If an index higher than 0 is
            // used, fill will hide series below it.
            // baseSeries: 0,
            // fill:  Optional, defaults to true.  False to turn off fill.
            fill: true
        },

        // seriesColors:['#cd5c5c', '#21252b', '#21252b', '#21252b', '#21252b','#21252b','#21252b','#34B7EA'],
        seriesDefaults: {
            rendererOptions: {
                //////
                // Turn on line smoothing.  By default, a constrained cubic spline
                // interpolation algorithm is used which will not overshoot or
                // undershoot any data points.
                //////
                smooth: true
            },
            // showMarker: false,
            lineWidth: 1,
        },
        series:[
          {
            showMarker: false,
            lineWidth: 1.5,
            color : '#cd5c5c'
          },
          {
            showMarker: false,
            lineWidth: 0.5,
            color :  '#000000'
          },
          {
            showMarker: false,
            lineWidth: 0.5,
            color :  '#000000'
          },
          {
            showMarker: false,
            lineWidth: 0.5,
            color :  '#000000'
          },
          {
            showMarker: false,
            lineWidth: 0.5,
            color :  '#000000'
          },
          {
            showMarker: false,
            lineWidth: 0.5,
            color :  '#000000'
          },
          {
            showMarker: false,
            lineWidth: 0.5,
            color :  '#000000'
          },
          {
            // lineWidth: 3,
            showMarker: true,
            color :  '#000000',
            showLine : false,
            markerOptions: { size: 7, style:"x" }
          }
        ]
    });   


      $("#myTab a").click(function(e){
            $(this).tab('show');
        });


     $('.nav-pills a').on('show.bs.tab', function(){
        // alert('The new tab is about to be shown.');
      });

      $('.nav-pills a').on('shown.bs.tab', function(){
        //alert('The new tab is now fully shown.');
        if($(this).attr('id') == "tab_bb_tb"){
            console.log($(this).attr('id'));
            plot1.replot();
        }else if($(this).attr('id') == "tab_bb_u"){
            console.log($(this).attr('id'));
            plot2.replot();
        }
      });

      $('.nav-pills a').on('hide.bs.tab', function(e){
        // alert('The previous tab is about to be hidden.');
      });

      $('.nav-pills a').on('hidden.bs.tab', function(){
        // alert('The previous tab is now fully hidden.');
      });

 });

    
      
    


</script>

</body>
</html>