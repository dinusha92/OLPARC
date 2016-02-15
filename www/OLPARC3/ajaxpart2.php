<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport"    content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author"      content="Sergey Pozhilov (GetTemplate.com)">
	
	<title>OLPARC: Automatic Results Checking</title>

	<link rel="shortcut icon" href="assets/images/gt_favicon.png">
	
	<link rel="stylesheet" media="screen" href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,700">
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/font-awesome.min.css">

	<!-- Custom styles for our template -->
	<link rel="stylesheet" href="assets/css/bootstrap-theme.css" media="screen" >
	<link rel="stylesheet" href="assets/css/main.css">

	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	<script src="assets/js/html5shiv.js"></script>
	<script src="assets/js/respond.min.js"></script>
	<![endif]-->
	<script language="javascript">
		function add(type) {
 
					    //Create an input type dynamically.
					    var element = document.createElement("input");
					 
					    //Assign different attributes to the element.
					    element.setAttribute("type", type);
					    element.setAttribute("value", type);
					    element.setAttribute("name", type);
					 	element.setAttribute("size", 10);
					 
					    var foo = document.getElementById("fooBar");
					 
					    //Append the element in page (in span).
					    foo.appendChild(element);
 
		}






</script>

</head>

<body>
	<!-- Fixed navbar -->
	<div class="navbar navbar-inverse navbar-fixed-top headroom" >
		<div class="container">
			<div class="navbar-header">
				<!-- Button for smallest screens -->
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"><span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
				<a class="navbar-brand" href="index.html"></a>
			</div>
			<div class="navbar-collapse collapse">
				<ul class="nav navbar-nav pull-right">
					<li><a href="index.php">Home</a></li>
					<li><a href="about.html">About</a></li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">How to Use <b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li><a href="lottery_purchasing.html">Lottery Purchasing</a></li>
							<li class="active"><a href="resultschecking.html">Automatic Results Checking</a></li>
						</ul>
					</li>
					<li><a href="contact.html">Contact</a></li>
					<li><a class="btn" href="signin.html">SIGN IN / SIGN UP</a></li>
				</ul>
			</div><!--/.nav-collapse -->
		</div>
	</div> 
	<!-- /.navbar -->

	<header id="head" class="secondary"></header>

	<!-- container -->
	<div class="container">

		<ol class="breadcrumb">
			<li><a href="index.php">Home</a></li>
			<li class="active">Automatic Results Cheking</li>
		</ol>

		<div class="row">
			
			<!-- Article main content -->
			<article class="col-md-8 maincontent">
				<header class="page-header">
					<h1 class="page-title">Automatic Results Checking</h1>
				</header>
					<form action="db_lotterydetails.php" method="GET">
						<div class="row">
								
							<div class="col-sm-4">
								
								<select  id = "lottery_name" onchange = "setLayout()">
									 <option value="Mahajana Sampatha">Mahajana Sampatha</option>
								 	 <option value="Jayoda">Jayoda</option>
								  	 <option value="Super Bowl">Super Bowl</option>
								 	 <option value="Jathika Sampatha">Jathika Sampatha</option>

								</select>
							</div>
							<div class="col-sm-4">
								<input class="form-control" type="text" placeholder="Draw Number" name="drawno">
							</div>
							<div class="col-sm-4">
								<input class="form-control" type="date" placeholder="Date" name="date">
							</div>
							 	
							<div id="ajax"  style=" padding-top: 60px; ">



							</div>
								
								
								

							<!--	<INPUT type="button" value="Add" onclick="add('text')"/>
								<span id="fooBar">&nbsp;</span> -->
																	
						</div>
						
					</form>
			</article>
			<!-- /Article -->
			
			<!-- Sidebar -->
			<aside class="col-md-4 sidebar sidebar-right">

			
				<div class="row widget">
					<div class="col-xs-12">
						<h4></h4>
						<p><img src="assets/images/mahajanasampatha.jpg" alt=""></p>
					</div>
				</div>
				<div class="row widget">
					<div class="col-xs-12">
						<h4</h4>
						<p><img src="assets/images/jathikasampatha.jpg" alt=""></p>
						<p></p>
					</div>
				</div>

			</aside>
			<!-- /Sidebar -->

		</div>
	</div>	<!-- /container -->
	

	<footer id="footer" class="top-space">

		<div class="footer1">
			<div class="container">
				<div class="row">
					
					<div class="col-md-3 widget">
						<h3 class="widget-title">Contact</h3>
						<div class="widget-body">
							<p>+712939439<br>
								<a href="mailto:#">dinusha.12@cse.mrt.ac.lk</a><br>
								<br>
								No 80, Alugolla Road, Badulla.
							</p>	
						</div>
					</div>

					<div class="col-md-3 widget">
						<h3 class="widget-title">Follow us</h3>
						<div class="widget-body">
							<p class="follow-me-icons">
								<a href=""><i class="fa fa-twitter fa-2"></i></a>
								
								<a href=""><i class="fa fa-facebook fa-2"></i></a>
							</p>	
						</div>
					</div>

					<div class="col-md-6 widget">
						<h3 class="widget-title">OLPARC Partners</h3>
						<div class="widget-body">
							<p>OLPARC system is affiliated with national lottery board and development lottery board in Sri Lanka in order to enhance people to buy lottery and increase the winning chance.</p>
							 
						</div>
					</div>

				</div> <!-- /row of widgets -->
			</div>
		</div>

		<div class="footer2">
			<div class="container">
				<div class="row">
					
					<div class="col-md-6 widget">
						<div class="widget-body">
							<p class="simplenav">
								<a href="#">Home</a> | 
								<a href="about.html">About</a> |
								<a href="lottery_purchasing.html">How to</a> |
								<a href="contact.html">Contact</a> |
								<b><a href="signup.html">Sign up</a></b>
							</p>
						</div>
					</div>

					

				</div> <!-- /row of widgets -->
			</div>
		</div>
	</footer>	
		





	<!-- JavaScript libs are placed at the end of the document so the pages load faster -->
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
	<script src="assets/js/headroom.min.js"></script>
	<script src="assets/js/jQuery.headroom.min.js"></script>
	<script src="assets/js/template.js"></script>


<script>

function setLayout() {
	
	var str=document.getElementById("lottery_name").value;
	
        
        //console.log("http://olparc.16mb.com/web_lotterydetails.php?lotteryname="+str);
	
    if (str == "") {
        document.getElementById("ajax").innerHTML = "";
        return;
    } else { 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {

			
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("ajax").innerHTML = xmlhttp.responseText;
				
            }
        }
        xmlhttp.open("GET","http://olparc.16mb.com/web_lotterydetails.php?lotteryname="+str,true);
        xmlhttp.send();
		
    }
}

function setHistory() {
	
	var str=document.getElementById("lottery_name").value;
	
        
        //console.log("http://olparc.16mb.com/web_lotterydetails.php?lotteryname="+str);
	
    if (str == "") {
        document.getElementById("ajax").innerHTML = "";
        return;
    } else { 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {

			
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("ajax").innerHTML = xmlhttp.responseText;
				
            }
        }
        xmlhttp.open("GET","http://olparc.16mb.com/web_lotterydetails.php?lotteryname="+str,true);
        xmlhttp.send();
		
    }
}

setLayout() ;


</script>
</body>
</html>