<!doctype html>

<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta charset="UTF-8">
	<title>每周健康紀錄</title>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"></script>
	<script src="https://d.line-scdn.net/liff/1.0/sdk.js"></script>

</head>

<?php
//資料庫設定
//資料庫位置
$db_server = "120.126.17.44";
//資料庫名稱
$db_name = "health_record_book";
//資料庫管理者帳號
$db_user = "casebook";
//資料庫管理者密碼
$db_passwd = "eric441567";
//對資料庫連線
$link=mysqli_connect($db_server, $db_user, $db_passwd,$db_name)
       or die("無法對資料庫連線");
//資料庫連線採UTF8
mysqli_query($link,'SET CHARACTER SET utf8');
mysqli_query($link,"SET collation_connection = 'utf8_general_ci'");
//選擇資料庫
mysqli_select_db($link,$db_name)
      or die("無法使用資料庫");
	  
$user_id=$_GET['id'];
$value=$_GET['value'];
$sql="select * from f3 where user_id='$user_id'";
$result= mysqli_query($link,$sql);
$i=0;
while($row = mysqli_fetch_array($result))
{
    if($i==7)
    {
        break;
    }
    $date[$i]=$row['date'];
    $weight[$i]=$row['weight'];
    $sugar[$i]=$row['sugar'];
    $date[$i]=$row['date'];
    $systolic[$i]=$row['systolic'];
    $diastolic[$i]=$row['diastolic'];
    $pulse[$i]=$row['pulse'];
    /*
    echo $date[$i];
    echo $weight[$i];
    echo $sugar[$i];*/
    $i=$i+1;

}
#echo $i;
#print_r($date[0]);


?>
<body>
<a id="link"></a>
	<canvas id="myChart" width="10" height="10" style='width:10px;height:10px'></canvas>
<script>
var i=<?php echo $i?>;
console.log(i);
var g=0;
var date_Array = <?php echo json_encode($date); ?>;
var weight_Array = <?php echo json_encode($weight); ?>;
var sugar_Array = <?php echo json_encode($sugar); ?>;
var systolic_Array = <?php echo json_encode($systolic); ?>;
var diastolic_Array = <?php echo json_encode($diastolic); ?>;
var pulse_Array = <?php echo json_encode($pulse); ?>;
var ctx = document.getElementById('myChart').getContext('2d');
if("<?php echo $value; ?>"=="0")
{
    var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: date_Array,
        datasets: [{
            label: '體重',
            data: weight_Array,
            backgroundColor:'rgba(255, 99, 132)',  
            borderColor: 'rgb(255, 99, 132)',
						fill:false,
            borderWidth: 2
        },{
        		label: '血糖',
            data:sugar_Array,
            backgroundColor:'rgba(54, 162, 235)',  
            borderColor: 'rgb(54, 162, 235)',
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
}
else
{
    var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: date_Array,
        datasets: [{
            label: '收縮壓',
            data: systolic_Array,
            backgroundColor:'rgba(255, 99, 132)',  
            borderColor: 'rgb(255, 99, 132)',
						fill:false,
            borderWidth: 2
        },{
        		label: '舒張壓',
            data:diastolic_Array,
            backgroundColor:'rgba(54, 162, 235)',  
            borderColor: 'rgb(54, 162, 235)',
						fill:false,
            borderWidth: 2
        
        	},{
        		label: '脈搏',
            data:pulse_Array,
            backgroundColor:'rgba(12, 183, 230)',  
            borderColor: 'rgb(128, 94, 235)',
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
}

</script>
</body>

</html>
