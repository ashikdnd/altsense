<?php 
ob_start();
session_start();
date_default_timezone_set("Asia/Kolkata");

include('config.php');

$userid = $_SESSION['userid'];
$name = $_SESSION['full_name'];

if(isset($_SESSION['authenticated'])) {} 
else {
	header('location: login.php');
}

$sql = "SELECT * FROM tasks where `user_id` = '$userid' && `status` = '1'";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>

	<title>Components - Forms</title>

	<!-- Required meta tags always come first -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="x-ua-compatible" content="ie=edge">


	<!-- Bootstrap CSS -->
	<link rel="stylesheet" type="text/css" href="Bootstrap/dist/css/bootstrap-reboot.css">
	<link rel="stylesheet" type="text/css" href="Bootstrap/dist/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="Bootstrap/dist/css/bootstrap-grid.css">

	<!-- Main Styles CSS -->
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link rel="stylesheet" type="text/css" href="css/fonts.min.css">

	<!-- Main Font -->
	<script src="js/webfontloader.min.js"></script>
	<script>
		WebFont.load({
			google: {
				families: ['Roboto:300,400,500,700:latin']
			}
		});
	</script>

</head>
<body>


<!-- Preloader -->

<div id="hellopreloader">
	<div class="preloader">
		<svg width="45" height="45" stroke="#fff">
			<g fill="none" fill-rule="evenodd" stroke-width="2" transform="translate(1 1)">
				<circle cx="22" cy="22" r="6" stroke="none">
					<animate attributeName="r" begin="1.5s" calcMode="linear" dur="3s" repeatCount="indefinite" values="6;22"/>
					<animate attributeName="stroke-opacity" begin="1.5s" calcMode="linear" dur="3s" repeatCount="indefinite" values="1;0"/>
					<animate attributeName="stroke-width" begin="1.5s" calcMode="linear" dur="3s" repeatCount="indefinite" values="2;0"/>
				</circle>
				<circle cx="22" cy="22" r="6" stroke="none">
					<animate attributeName="r" begin="3s" calcMode="linear" dur="3s" repeatCount="indefinite" values="6;22"/>
					<animate attributeName="stroke-opacity" begin="3s" calcMode="linear" dur="3s" repeatCount="indefinite" values="1;0"/>
					<animate attributeName="stroke-width" begin="3s" calcMode="linear" dur="3s" repeatCount="indefinite" values="2;0"/>
				</circle>
				<circle cx="22" cy="22" r="8">
					<animate attributeName="r" begin="0s" calcMode="linear" dur="1.5s" repeatCount="indefinite" values="6;1;2;3;4;5;6"/>
				</circle>
			</g>
		</svg>

		<div class="text">Loading ...</div>
	</div>
</div>

<!-- ... end Preloader -->
<div class="container">
	<div class="row">


		<div class="col col-lg-12 col-md-12 col-sm-12 col-12">
			<h2 class="presentation-margin">Comments form</h2>
			<div  class="ui-block">

				<?php

				if(isset($_SESSION['has_error'])) {
				?>
				<div class="alert alert-danger"><?php echo $_SESSION['has_error']; ?></div>
				<?php 
				}
				?>
				<?php

				if(isset($_SESSION['has_success'])) {
				?>
				<div class="alert alert-success"><?php echo $_SESSION['has_success']; ?></div>
				<?php 
				}
				?>

				<!-- Comment Form  -->
				
				<form class="comment-form inline-items" method="POST" action="taskprocess.php">
				
					<div class="post__author author vcard inline-items">
						<img src="img/author-page.jpg" alt="author">
				
						<div class="form-group with-icon-right ">
							<input type="text" name="task_title" class="form-control">
						</div>
					</div>
				
					<button type="submit" class="btn btn-md-2 btn-primary">Add Task</button>
				
					<button type="reset" class="btn btn-md-2 btn-border-think c-grey btn-transparent custom-color">Cancel</button>
				
				</form>
				
				<!-- ... end Comment Form  -->
			</div>
		</div>

	</div>

	<div class="row">
		<div class="col-md-8 offset-md-2">
			<div class="ui-block">
				<div class="ui-block-title">
					<h6 class="title">Your Pending Tasks</h6>
					<a href="#" class="more"><svg class="olymp-three-dots-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-three-dots-icon"></use></svg></a>
				</div>

				
				<!-- Notification List -->
				
				<ul class="notification-list">
					<?php 
					while($row = mysqli_fetch_assoc($result)) {
					echo '<li data-taskid="'.$row['id'].'" data-userid="'.$row["user_id"].'">
						<div class="author-thumb">
							<img src="img/avatar4-sm.jpg" alt="author">
						</div>
						<div class="notification-event">
							<a href="#" class="h6 notification-friend">'.$name.'</a>
							<p>'.$row["task_title"].'</p>
							<span class="notification-date"><time class="entry-date updated" datetime="2004-07-24T18:18">'.date('jS M, Y - h:i a', $row["created_at"]).'</time></span>
						</div>
						<span class="notification-icon">
											<svg class="olymp-heart-icon mark-completed"><use xlink:href="svg-icons/sprites/icons.svg#olymp-heart-icon"></use></svg>
										</span>
						<div class="more">
							<svg class="olymp-little-delete delete-task"><use xlink:href="svg-icons/sprites/icons.svg#olymp-little-delete"></use></svg>
						</div>
					</li>';
					}
					?>

				</ul>
				
				<!-- ... end Notification List -->

			</div>

			
		

		</div>
	</div>

</div>




<a class="back-to-top" href="#">
	<img src="svg-icons/back-to-top.svg" alt="arrow" class="back-icon">
</a>


<!-- JS Scripts -->
<script src="js/jquery-3.2.1.js"></script>
<script src="js/jquery.appear.js"></script>
<script src="js/jquery.mousewheel.js"></script>
<script src="js/perfect-scrollbar.js"></script>
<script src="js/jquery.matchHeight.js"></script>
<script src="js/svgxuse.js"></script>
<script src="js/imagesloaded.pkgd.js"></script>
<script src="js/Headroom.js"></script>
<script src="js/velocity.js"></script>
<script src="js/ScrollMagic.js"></script>
<script src="js/jquery.waypoints.js"></script>
<script src="js/jquery.countTo.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/material.min.js"></script>
<script src="js/bootstrap-select.js"></script>
<script src="js/smooth-scroll.js"></script>
<script src="js/selectize.js"></script>
<script src="js/swiper.jquery.js"></script>
<script src="js/moment.js"></script>
<script src="js/daterangepicker.js"></script>
<script src="js/simplecalendar.js"></script>
<script src="js/fullcalendar.js"></script>
<script src="js/isotope.pkgd.js"></script>
<script src="js/ajax-pagination.js"></script>
<script src="js/Chart.js"></script>
<script src="js/chartjs-plugin-deferred.js"></script>
<script src="js/circle-progress.js"></script>
<script src="js/loader.js"></script>
<script src="js/run-chart.js"></script>
<script src="js/jquery.magnific-popup.js"></script>
<script src="js/jquery.gifplayer.js"></script>
<script src="js/mediaelement-and-player.js"></script>
<script src="js/mediaelement-playlist-plugin.min.js"></script>
<script src="js/ion.rangeSlider.js"></script>

<script src="js/base-init.js"></script>
<script defer src="fonts/fontawesome-all.js"></script>

<script src="Bootstrap/dist/js/bootstrap.bundle.js"></script>

<script>
	$(function() {
		$('.delete-task').on('click', function() {
			var elem = $(this);
			var taskid = $(this).closest('li').attr('data-taskid');
			var userid = $(this).closest('li').attr('data-userid');
			console.log(taskid);

			var con = confirm('Are you sure to delete this task? You cannot undo');
			if(con) {
				// call the delete api
				$.ajax({
					url: 'api.php?taskid='+taskid+'&userid='+userid+'&method=delete',
					type: 'GET',
					dataType: 'JSON',
					success: function(res) {
						if(res.success == true) {
							elem.closest('li').remove();
						}
					},
					error:function(e) {
						console.log(e)
					}
				})
			}
		})

		$('.mark-completed').on('click', function() {
			var elem = $(this);
			var taskid = $(this).closest('li').attr('data-taskid');
			var userid = $(this).closest('li').attr('data-userid');
			console.log(taskid);

			var con = confirm('Are you sure to update this task as completed?');
			if(con) {
				// call the delete api
				$.ajax({
					url: 'api.php?taskid='+taskid+'&userid='+userid+'&method=update',
					type: 'GET',
					dataType: 'JSON',
					success: function(res) {
						if(res.success == true) {
							elem.closest('li').remove();
						}
					},
					error:function(e) {
						console.log(e)
					}
				})
			}
		})
	})
</script>

</body>
</html>