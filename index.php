<!-- 
This file allows you to host this page as a static file on Heroku 

-->
<!doctype html>
<html>
  <head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta charset="UTF-8">
	<title>每周健康紀錄</title>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"></script>
	<script src="https://d.line-scdn.net/liff/1.0/sdk.js"></script>

</head>

<body>
<p id="test">4444</p>
<script>
liff.init(function (data) {
        initializeApp(data);
    });
function initializeApp(data)
{
	liff.getProfile().then(function (profile) {
            document.getElementById('test').textContent = profile.userId;
        }).catch(function (error) {
            window.alert("Error getting profile: " + error);
        });
}
</script>
  <a id="link"></a>
	<canvas id="myChart" width="10" height="10" style='width:10px;height:10px'></canvas>
<script>
var ctx = document.getElementById('myChart').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: ['星期一', '星期二', '星期三', '星期四', '星期五', '星期六', '星期日'],
        datasets: [{
            label: '收縮壓',
            data: [20.4, 19, 3, 5, 0, 3,5],
            backgroundColor:'rgba(255, 99, 132)',  
            borderColor: 'rgb(255, 99, 132)',
						fill:false,
            borderWidth: 2
        },{
        		label: '舒張壓',
            data: [70, 50, 40, 30, 10, 10,50],
            backgroundColor:'rgba(54, 162, 235)',  
            borderColor: 'rgb(54, 162, 235)',
						fill:false,
            borderWidth: 2
        
        	},{
          	label: '脈搏',
            data: [70, 58, 49, 93, 91, 81,50],
            backgroundColor:'rgba(153, 102, 255)',  
            borderColor: 'rgb(153, 102, 255)',
						fill:false,
            borderWidth: 2
          
          	}]
    },
    options: {
       animation: {
          onComplete: function () {
          var ctx = this.chart.ctx;
          ctx.font = Chart.helpers.fontString(Chart.defaults.global.defaultFontFamily, 'normal', Chart.defaults.global.defaultFontFamily);
          ctx.fillStyle = "black";
          ctx.textAlign = 'center';
          ctx.textBaseline = 'bottom';
          this.data.datasets.forEach(function (dataset)
          {
              for (var i = 0; i < dataset.data.length; i++) {
                  for(var key in dataset._meta)
                  {
                      var model = dataset._meta[key].data[i]._model;
                      ctx.fillText(dataset.data[i], model.x, model.y - 5);
                  }
              }
          });
    }
}
    }
});
</script>

</body>

</html>
