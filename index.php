<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="utf-8">
<meta name="viewport"
	content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="">

<title>Simple PHP MIB Browser</title>

<!-- Bootstrap core CSS -->
<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

	<!-- Navigation -->
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top">
		<div class="container">
			<a class="navbar-brand" href="#">PHP MIB BROWSER</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse"
				data-target="#navbarResponsive" aria-controls="navbarResponsive"
				aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarResponsive"></div>
		</div>
	</nav>

	<!-- Page Content -->
	<div class="container">
		<hr>
		<div class="row">
			<div class="col-lg-4">
				<div class="col-lg-12">
					<h2>Method</h2>
					<select id="method" class="form-control">
						<option value="">SELECT</option>
						<option value="GET">GET</option>
						<option value="WALK">WALK</option>
						<option value="SET">SET</option>
					</select>
				</div>
				<div class="col-lg-12">
					<h2>OID</h2>
					<input type="text" class="form-control" id="oid">
				</div>
				<div class="col-lg-12">
					<h2>IP</h2>
					<input type="text" class="form-control" id="ip">
				</div>
				<div class="col-lg-12">
					<h2>COMMUNITY</h2>
					<input type="text" class="form-control" id="community">
				</div>
				<div class="col-lg-12 set" style="display:none;">
					<h2>VALUE</h2>
					<input type="text" class="form-control" id="setvalue">
				</div>
				<div class="col-lg-12 set" style="display:none;">
					<h2>TYPE</h2>
					<select id="settype" class="form-control">
						<option value="">SELECT</option>
						<option value="i">INTEGER</option>
						<option value="s">STRING</option>
						<option value="h">HEX-STRING</option>
					</select>
				</div>
				<div class="col-lg-12">
					<hr>
					<button type="button" id="go" class="btn btn-success">GO</button>
				</div>
			</div>
			<div class="col-lg-8">
				<div class="col-lg-12 error_div">
				</div>
				<div class="col-lg-12 success_div">
				</div>
			</div>
		</div>

		<!-- Bootstrap core JavaScript -->
		<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="  crossorigin="anonymous"></script>
		
		<script>

			$(document).ready(function(){

				$("#method").change(function(){
					if ($(this).val() == "SET"){
						$(".set").show();
					} else {
						$(".set").hide();
					}
				});
				
				$("#go").click(function(){
					$(".error_div,.success_div").html('');
					$.ajax({
	                    type: 'get',
	                    async: true,
	                    data: "method="+($("#method").val())+"&oid="+($("#oid").val())+"&ip="+($("#ip").val())+"&community="+($("#community").val())+"&setvalue="+($("#setvalue").val())+"&settype="+($("#settype").val()), 
	                    url: 'snmp_mib.php',
	                    success: function(res) {
	                    	$(".success_div").html(res);
	                    }, error: function(res) {
	                        $(".error_div").html('error');
	                    }
	               });

					
				});
			});

		</script>

</body>

</html>
