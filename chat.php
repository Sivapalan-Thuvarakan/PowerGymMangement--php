<?php

	include"database.php";
	session_start();
	unset ($_SESSION["AID"]);
	if(!isset($_SESSION["UID"]) && !isset($_SESSION["TRID"]))
	{
		echo"<script>window.open('user_login.php?mes=Access Denied...','_self');</script>";
		
	}	
	if(isset($_SESSION["UID"]))
	 {
			$name=$_SESSION["UNAME"];
			$name .="-";
			$name .=$_SESSION["UROLE"];
	
	}
	if(isset($_SESSION["TRID"]))
	{
			$name=$_SESSION["TR_U_NAME"];
			$name .="-";
			$name .="Trainer";
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Power Gym</title>
		<link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" type="text/css" href="css/chat.css">
	</head>
	<body>
		<?php include"navbar.php";?><br>
	
			<div id="section">
				<?php include"sidebar.php";?><br>
				  <h3 class="text">Welcome <?php $name ?></h3><br><hr><br>
				<div class="content">
				
                <h3 class="text">Chat</h3><br>
					<form name="frm">
                        <input name="msg" id="msg" placeholder="Type Your Message...." required/>
						<input type="hidden" name="user" id="user" value='<?php echo $name ;?>'/>
						<button id="send" type="button">Send</button>
						<span id="status"></span>
                    </form>
					<div id="messagebox"></div>
				</div>
			</div>
			<?php include"footer.php";?>
            <script src="js/jquery.js"></script>
            <script>
                $(document).ready(function(){
					setInterval(() => {
						loadchats();
					}, 100);
                });
                function loadchats()
                {
                    $.ajax({url:"logs.php",success:function(result)
                    {
                        $("#messagebox").html(result);
                    }});
                }
            </script>
			<script>
				$(document).ready(function(){
					$("#msg").keypress(function(){
							$("#status").html("Typing Message.....");
							
					});

					setInterval(() => {
						loadchats();
					}, 100);
				
					$("#send").click(function()
					{
						var n=$("#user").val();
						var m=$("#msg").val();
						$.post("post.php",{name:n,message:m},function(data)
						{
							$("#status").html(data);
							$("#msg").val("")
						});
					});
				});
			</script>
	</body>
</html>