<?php
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 1 Jul 2000 05:00:00 GMT"); // Fecha en el pasado
header('Pragma: no-cache');

?>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta http-equiv="Expires" content="0">
	<meta http-equiv="Last-Modified" content="0">
	<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
	<meta http-equiv="Pragma" content="no-cache">	
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	

	<title>| SIGA v<?php echo $sigaVersionInfo;?> |</title>  
	
	<link href="/siga/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet">	
  <link href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet">	
	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
	<link href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.css" rel="stylesheet">
	<link href="/siga/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet"> 	
  <link href="/siga/plugins/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet">  
  <link href="/siga/plugins/fileinput/fileinput.css" rel="stylesheet">	
	<link href="/siga/plugins/iCheck/square/blue.css" rel="stylesheet">  
  <link href="/siga/plugins/datepicker/datepicker3.css" rel="stylesheet">             
  <link href="/siga/js/datepicker.css" rel="stylesheet" >
	<link href="/siga/plugins/fullcalendaryear/fullcalendar.css" rel="stylesheet">
  <link href="/siga/plugins/fullcalendar/fullcalendar.print.css" media="print" rel="stylesheet">  
  <link href="/siga/dist/css/AdminLTE.min.css" rel="stylesheet">
  <link href="/siga/dist/css/skins/_all-skins.min.css" rel="stylesheet">
  <link href="/siga/plugins/iCheck/flat/blue.css" rel="stylesheet">  
  <link href="/siga/plugins/pnotify/dist/pnotify.css" rel="stylesheet">
  <link href="/siga/plugins/pnotify/dist/pnotify.buttons.css" rel="stylesheet">
  <link href="/siga/plugins/pnotify/dist/pnotify.nonblock.css" rel="stylesheet">
	<link href="/siga/plugins/select2/select2.css" rel="stylesheet">
	<link href="/siga/components/siga.ico" rel="icon" type="image/x-icon">
	<link href="/siga/plugins/sweetalert2/sweetalert2.css" rel="stylesheet">
  <link href="/siga/dist/css/jquery-confirm.min.css" rel="stylesheet">
	<link href="/siga/vistas/DataTables1.10.0/extensions/TableTools/css/dataTables.tableTools.min.css" rel="stylesheet"/>
	<link href="/siga/assets/Firma_Digital/docs/css/signature-pad.css" rel="stylesheet">
	<link href="/siga/js/jquery-ui.css" rel="stylesheet" >
	<link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet" >
	<link href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css" rel="stylesheet" >
	<link href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.css" rel="stylesheet"/>
	<link href="https://cdn.datatables.net/fixedheader/3.1.6/css/fixedHeader.dataTables.min.css" rel="stylesheet">	
	<!-- <link rel="stylesheet" href="/siga/dist/css/spinner.css"> -->
	<style>

	/* example of setting the width for multiselect */
	.multiselectjs_multiSelect {
		width: 200px;
	}
		
	button.multiselect {
		font-size: 12px;
	}
	
	.dataTables_wrapper {
		font-family: tahoma;
		font-size: 10px;
	}
	
	#WindowLoad
	{
		position:fixed;
		top:0px;
		left:0px;
		z-index:3200;
		filter:alpha(opacity=65);
	   -moz-opacity:65;
		opacity:0.65;
		background:#000000;
	}
	
	.skin-blue .content-wrapper .content .box .table-chs tbody tr td:first-child span {
		background: rgba(0, 0, 0, 0.15);
		border: 2px solid #fff;
		display: inline-block;
		margin: 0 5px;
		width: 32px;
		height: 32px;
		line-height: 16px;
		padding: 0.5em;
		border-radius: 50%;
		-webkit-border-radius: 50%;
		-moz-border-radius: 50%;
		-o-border-radius: 50%;
		text-align: center;
	}
	
	
	.skin-blue .content-wrapper .content .box .table-chs tbody tr td:first-child span i {
		text-align: center;
		color: #fff;
	}

	/* Estilo para videos responsivos */
	video { width: 100%; height: auto; }
	.objeto-oculto { display: none; }
 </style>
  
</head>