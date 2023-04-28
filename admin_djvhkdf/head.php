<?php session_start();
error_reporting(0);
include_once('config.php');
//require_once('function.php');
//$obj_fun = new functions();
if(!isset($_SESSION['status'])){ echo '<script type="text/javascript">window.location = "login.php"</script>'; header('location:login.php');}
$admin = $obj_fun ->getUser($_SESSION['type']);
?>
<meta charset="utf-8">
<title>Admin | <?php echo company;?> </title>
<noscript>
	<meta http-equiv="refresh" content="0; url=no-js.html" />
</noscript>
<meta name="description" content="">
<meta name="author" content="Antique Touch | www.antiquetouch.in">
<meta name="robots" content="index, follow">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- Style -->
<link rel="stylesheet" href="css/organon-green.css?31120">
<link rel='stylesheet' type='text/css' href='css/plugins/jquery.jgrowl.css'>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<?php
	$masteradmin = $obj_fun->getUser('master-admin');
?>
<link rel="shortcut icon" href="<?php echo $masteradmin['favicon']; ?> ">
<script src="sweetalert/sweetalert.min.js"></script>
<link rel="stylesheet" type="text/css" href="sweetalert/sweetalert.css">
<link rel="stylesheet" href="css/custom.css">
<script src="js/jquery.min.js"></script>
<script src="js/libs/modernizr.js"></script>
<script src="js/libs/selectivizr.js"></script>
<script type="text/javascript" src="js/plugins/jGrowl/jquery.jgrowl.js"></script>
<script type="text/javascript" src="js/custom.js"></script>
<script>
	function success(msg){
		$.jGrowl("", {
			header: msg,
			sticky: true,
			theme: 'success'
		});
	}
	function danger(msg){
		$.jGrowl("", {
			header: msg,
			sticky: true,
			theme: 'danger'
		});
	}
</script>

<style>
.container{float: left; width: 100%;}
.sidebar-actionbar {left: 87px;  top: 55px; width: 160px;}
.sidebar-actionbar li{width: 50%;}
.sidebar-actionbar li a:hover{text-decoration:none;}
a.active{background:#C2C4CC!important; box-shadow:0 2px 4px rgba(0, 0, 0, 0.4) inset!important; color:#1A1A1A!important;}
.badge{cursor:pointer}
tab-pane.active{height: 250px;}
select{width:313px}
.table th, .table td{vertical-align:middle}
td .btn{width:50px}
td .full-width{
	width:auto;
}
.data-block.nested.rm-bordr{border-top: medium none; border-top-left-radius: 0px; border-top-right-radius: 0px;}
.data-block.nested{border-top: medium none; border-top-left-radius: 70px; border-top-right-radius: 70px;}
.data-block.nested header{background-color:#333132; height: 61px; padding: 0!important; text-transform:none;}
.data-block.nested header hr{border-top: 1px solid rgba(255, 255, 255, 0.12); opacity: 0.1; width: 100%; margin: 4px 0px 0px;}

.img {
	background: none repeat scroll 0 0 white;
	float: right;
	height: 150px;
	padding: 3px;
}
.img img {height: 100%;}
.fileupload.fileupload-new, .fileupload.fileupload-exists {
	float: left;
	width: 210px;
}
</style>
<style>
	.filter-menu li label{
		color:#333333;
	}
	.filter-menu li:hover {
		background-color:#d9d9d9;
	}
	.tbl_btn_update{
		opacity:0;
	}
	.table th, .table td{
		text-align:center;
	}
	.datatable.table input{
		border:none;
		margin:0 10px;
	}
	/*.table th:last-child.sorting {
		background-image:none !important;
	}*/
	
	.table tr td:first-child:hover,
	.table tr td:last-child:hover {
		background-color: rgba(0, 0, 0, 0.1) !important;
		cursor: default;
	}
	.table tr td:hover{
		background-color: #1d1d1d !important;
    	cursor: pointer;
	}
	</style>
	
    	
<script>

<?php if(!basename($_SERVER['REQUEST_URI'])=="index.php"){ ?>
$(document).ajaxStart(function(){
  //$('.container[portfolio=1]').html('');
  $("#ajax-loader-container").show();
});

$(document).ajaxStop(function(){
  $("#ajax-loader-container").hide();
});
<?php }?>
</script>
<style>
#ajax-loader-container{
	background: url(ajax-loader-portfolio.gif) no-repeat;
	position : fixed;
	top : 49%;
	left : 49%;
	display : none;
	height : 32px;
	width : 32px;
	z-index : 100;
}
</style>

<div id="ajax-loader-container" class="loading loading-green"></div>