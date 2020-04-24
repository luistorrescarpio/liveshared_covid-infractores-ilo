<?require "../../system/client.php"?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>	ADMIN</title>
	<script src="<?=$public?>/js/jquery-3.2.1.min.js"></script>
	<?admin_script(['datatables','charts'])?>
	<script src="<?=$sys_lib?>/vuejs/vue.js"></script>
	<script src="<?=$sys_lib?>/vuejs/httpVueLoader.js"></script>
</head>
<body>
	<div id="app">
		<?admin_start()?>
		<h1>Welcome Admin</h1>
		<comp-blank></comp-blank>
		<?admin_end()?>		 
	</div>
	<script>
		$(window).on("load",function(){
	      app = new Vue({
	        el: '#app',
	        mounted: function(){
		        console.log("Component Main init!");
		    },components:{
	          'comp-blank': httpVueLoader('../Components/blank.vue')
	        }
	      });
	    });
	</script>
</body>
</html>
