$(document).ready(function() {

	// =================================================================
	// Диграмма/график статистики
	// =================================================================

    $.ajax({
      type: 'GET',
      url : '/site/get-stats',
      dataType: 'json',
      success: function(res){
        var chart = Morris.Area({
          element: 'morris-chart-network',
          data: res,
          axes: false,
          xkey: 'hour',
          ykeys: ['hits', 'hosts'],
          labels: ['Просмотров', 'Уникальных посетителей'],
          yLabelFormat :function (y) { return y.toString() },
          gridEnabled: false,
          gridLineColor: 'transparent',
          lineColors: ['#8eb5e3','#1b72bc'],
          lineWidth:0,
          pointSize:2,
          pointFillColors:['#3e80bd'],
          pointStrokeColors:'#3e80bd',
          fillOpacity:.7,
          gridTextColor:'#999',
          parseTime: false,
          resize: true,
          behaveLikeLine: true,
          hideHover: 'auto'
        });
      }
    });

	// =================================================================
	// Статистика продаж
	// =================================================================
	$('#demo-panel-network-refresh').niftyOverlay().on('click', function(){
		var $el = $(this), relTime;
		$el.niftyOverlay('show');
		relTime = setInterval(function(){
			$el.niftyOverlay('hide');
			clearInterval(relTime);
		},2000);
	});

});
