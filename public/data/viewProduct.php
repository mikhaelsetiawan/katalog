<?php
	$work = $_POST['work'];
	$result = "";

	if($work == "default"){
		$result .= "<h4>
					Not only software and website
                    <br> we also work in computer networks and 
                    <br>hardware procurement. 
                    </h4>";
		echo $result;
	}

	if($work == "software"){
		$result .= "<h4>
					<strong style='color:#ae6665;'>Software </strong>Development
					  <br>
					We create application for desktop 
					<br>and apps for android.
                    </h4>";
		echo $result;
	}

	if($work == "website"){
		$result .= "<h4>
					<strong style='color:#dfba54;'>Website </strong>Development
					  <br>
					Don't know how to create a beautiful website?
					<br><br> Someone please call ...
					<br><strong>MAXEL </strong>!!!
                    </h4>";
		echo $result;
	}

	if($work == "internet"){
		$result .= "<h4>
					<strong style='color:#DFE32D;'>Internet </strong>Connection
					<br>
					Even your problem in love connection,
					<br>can we handle. Wanna try?
                    </h4>";
		echo $result;
	}

	if($work == "hardware"){
		$result .= "<h4>
					<strong style='color:#bfdf54;'>Hardware </strong>Procurement
					<br>
					  <div class='col-md-12' style='text-align:left;'>
					  	<div class='col-md-2' style='text-align:left;'></div>
					  	<div class='col-md-4' style='text-align:left;margin-left:20%;'>
							<span class='glyphicon glyphicon-check' style='font-size:14px;margin:0;color:grey;'></span>&nbsp;&nbsp; Desktop Application
							    <br>
							<span class='glyphicon glyphicon-check' style='font-size:14px;margin:0;color:grey;'></span>&nbsp;&nbsp; Apps for Android
							  <br>
							<span class='glyphicon glyphicon-check' style='font-size:14px;margin:0;color:grey;'></span>&nbsp;&nbsp; Website
							  <br>
							<span class='glyphicon glyphicon-check' style='font-size:14px;margin:0;color:grey;'></span>&nbsp;&nbsp; Internet Connection
					  	</div>
					  </div>
					  <div class='col-md-12' style='text-align:center;margin-top:-40px;margin-bottom:-10px;'>
						Ummm... Hardware ? 
						<br><strong>Check !!</strong>
					</div>
                    </h4>";
		echo $result;
	}

	if($work == "design"){
		$result .= "<h4>
					What would you need to make a <strong style='color:#2AB0C5;'>Digital Design </strong> ??
					<br><br>
					~ by yourself : <br>
					Idea -> Tools -> Skill -> Time -> Done...
					<br><br>
					~ with MAXEL : <br>
					Idea -> Share with us in <strong>Planner</strong> -> Relax.... -> Done !!!
                    </h4>";
		echo $result;
	}

	if($work == "video"){
		$result .= "<h4>
					Tell everyone about 
					<br>
					wedding, sweet 17<sup>th</sup>, or anything about your story 
					<br>
					with a <strong style='color:#9669FE;'>Video Animation</strong>
					<br>
					because word does not enough.
                    </h4>";
		echo $result;
	}

?>