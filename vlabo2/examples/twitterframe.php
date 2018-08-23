<body bgcolor="gray">

<div onclick="window.parent.ck_sw();turnmes();">

<script>
msw=0;
function turnmes(){
	 if(msw==0){
		document.getElementById('mes').innerHTML='start';
		msw=1;
	 }else{
	 	document.getElementById('mes').innerHTML='stop';
		msw=0;
	 }
//alert("a");
}
</script>
HELLO WORLD!! Click here to <span id="mes">stop</span><BR>
<?php $id= $_GET['id'];
$str='https://aa/'.$id.'';
?>
<iframe src='<?php echo $str;?>' width='460' height='320'></iframe>
</div>
