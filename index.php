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
<script>
liff.init(function (data) {
        initializeApp(data);
    });
function initializeApp(data)
{
	liff.getProfile().then(function (profile) {
            document.getElementById('test').textContent = profile.userId;
        });
}
function express(){
var value="0";

location.href="test2.php?id=" +id+"&value="+value;
}
function express2(){
var value="1";
location.href="test2.php?id=" +id+"&value="+value;
}
</script>
<input type ="button" onclick="express(id)" value="血糖與體重">
<input type ="button" onclick="express2(id)" value="脈搏與血壓">



</body>

</html>
