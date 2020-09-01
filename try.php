<?php
    ob_start();
    session_start();
	include("db_conn.php");
	  if(!isset($_POST['link'])){
        header("location: student_dashboard.php");
    }
    $license = $_POST['license'];
    $name = $_POST['name'];
    $link = $_POST['link']; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Demo</title>
<?php include('head_links.php'); ?>
</head>
<body>
<!-- Courses section -->
    <br><br>
		  <form class="comment-form" style="text-align: center;">
		    <div style="font-size:18px;">Name: <input type="text" value="<?php echo $name; ?>" style="border-width:0px;border:none; max-width:250px; font-size:18px;"  id="myInput" readOnly>
                <button type="button" class="my-btn" style="height:36px; font-size:14px; border-radius:20px" onclick="myFunction()"><i class="fa fa-files-o"></i> Copy</button>		
		 </div> </form> 
		<div id="embedWidget"></div>

<script type='text/javascript'>
	var _options = {
		'_license_key':'<?php echo $license; ?>',
		'_role_token':'',
		'_registration_token':'',
		'_widget_containerID':'embedWidget',
		'_widget_width':'100%',
		'_widget_height':'100vh',
		'_password_token':'<?php echo $link; ?>',
	};
	
	(function() {
		!function(i){
			i.Widget=function(c){
				'function'==typeof c&&i.Widget.__cbs.push(c),
				i.Widget.initialized&&(i.Widget.__cbs.forEach(function(i){i()}),
				i.Widget.__cbs=[])
			},
			i.Widget.__cbs=[]
		}(window);
		var ab = document.createElement('script'); 
		ab.type = 'text/javascript'; 
		ab.async = true;
		ab.src = 'https://embed.livewebinar.com/em?t='+_options['_license_key']+'&'+Object.keys(_options).reduce(function(a,k){
				a.push(k+'='+encodeURIComponent(_options[k]));
				return a
			},[]).join('&');
		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ab, s);
	})();
</script>
<script>
function myFunction() {
  var copyText = document.getElementById("myInput");
  copyText.select();
  copyText.setSelectionRange(0, 99999)
  document.execCommand("copy");
}
</script>
</html>
