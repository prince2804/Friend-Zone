<!DOCTYPE html>
<?php
session_start();
include("includes/header.php");

if(!isset($_SESSION['user_email'])){
	header("location: index.php");
}
?>
<html>
<head>
	<title>Edit Account Settings</title>
	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="style/home_style2.css">
</head>
<body>
<div class="row">
	<div class="col-sm-2">
	</div>
	<div class="col-sm-8">
		<form action="" method="post" enctype="multipart/form-data">
			<table class="table table-bordered table-hover">
					<tr align="center">
						<td colspan="6" class="active"><h2>Edit your Profile</h2></td>
					</tr>
					<tr>
						<td style="font-weight: bold;">Change your Firstname</td>
						<td>
						<input class="form-control" type="text" name="f_name" required value="<?php echo $first_name;?>">
						</td>
					</tr>

					<tr>
						<td style="font-weight: bold;">Change your Lastname</td>
						<td>
						<input class="form-control" type="text" name="l_name" required value="<?php echo $last_name;?>">
						</td>
					</tr>

					<tr>
						<td style="font-weight: bold;">Change your Username</td>
						<td>
						<input class="form-control" type="text" name="u_name" required value="<?php echo $user_name;?>">
						</td>
					</tr>


					<tr>
						<td style="font-weight: bold;">Description</td>
						<td>
						<input class="form-control" type="text" name="describe_user" required value="<?php echo $describe_user;?>">
						</td>
					</tr>

					<tr>
						<td style="font-weight: bold;">Relationship Status</td>
						<td>
							<select class="form-control"  name="Relationship" >
							<option><?php echo $Relationship_status ?></option>
							<option>Single</option>
							<option>Complicated</option>
							<option>Married</option>
							<option>Engaged</option>
							</select>
						</td>
					</tr>


					<tr>
						<td style="font-weight: bold;">Password</td>
						<td>
						<input class="form-control" type="password" name="u_name" id="mypass" required value="<?php echo $user_pass;?>">
						<input type="checkbox" onclick="show_password()"><strong>Show password</strong>
						</td>
					</tr>

					<tr>
						<td style="font-weight: bold;">Email</td>
						<td>
						<input class="form-control" type="text" name="u_email" required value="<?php echo $user_email;?>">
						</td>
					</tr>

					<tr>
						<td style="font-weight: bold;">country</td>
						<td>
							<select class="form-control"  name="u_country" >
							<option><?php echo $user_country ?></option>
							<option>india</option>
							<option>UAE</option>
							<option>UK</option>
							<option>USA</option>
							</select>
						</td>
					</tr>


					<tr>
						<td style="font-weight: bold;">Gender</td>
						<td>
							<select class="form-control"  name="u_gender" >
							<option><?php echo $user_gender ?></option>
							<option>Male</option>
							<option>Female</option>
							<option>Others</option>

							</select>
						</td>
					</tr>


					<tr>
						<td style="font-weight: bold;">Birthday</td>
						<td>
						<input class="form-control" type="text" name="u_birthday" required value="<?php echo $user_birthday;?>">
						</td>
					</tr>


					<tr>
						<td style="font-weight: bold;">Forgotten Password</td>
						<td>
						<button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal">Turn on</button>

						<div id="myModal" class="modal fade" role="dialog">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal">&times;</button>
										<h4 class="modal-title">Modal header</h4>
									</div>
									<div class="modal-body">
										<form action="recovery.php?id=<?php echo $user_id; ?>" method="post" id="f">
											<strong>What is your school best friend name</strong>
											<textarea class="form-control" cols="83"rows="4" name="content" placeholder="Someone"></textarea><br>
											<input class="btn btn-default" type="submit" name="sub" value="Submit" style="width: 100px;"><br><br>
											<pre>Answer the above question we will ask this question if you forgot your <br>password</pre>
											<br><br>
											</form>
											<?php
											if(isset($_POST['sub']))
											{
												$btn=htmlentities($_POST['content']);
												if($btn=='')
													{
													echo"<script>alert('please enter somthing')</script>";
													echo"<script>window.open('edit_profile.php?u_id$user_id','_self')</script>";
														exit();
													}
												else
													{
													$update="update users set recovery_account='$btn'
													where user_id='$user_id'";
													$run=mysqli_query($con,$update);
													if($run)
														{
															echo"<script>alert('working...')</script>";
															echo"<script>window.open('edit_profile.php?u_id$user_id','_self')</script>";
														}
													else
													{
													echo"<script>alert('Error updating information')
												</script>";
														echo"<script>window.open('edit_profile.php?u_id$user_id','_self')</script>";
														}
													}
														
														
												}

											?>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-default" data-dismiss="modal">close</button>
									</div>
									</div>
									</div>
								</div>
						</td>
					</tr> 


					<tr align="center">
					<td colspan="6">
					<input type="submit" class="btn btn-info" name="update" style="width:250px;" value="update">
					</td>

					</tr>
			</table>
		</form>
	</div>
	<div class="col-sm-2">
	</div>
</div>
</body>
</html>
<?php
if(isset($_POST['update']))
{
	$f_name=htmlentities($_POST['f_name']);
	$l_name=htmlentities($_POST['l_name']);
	$u_name=htmlentities($_POST['u_name']);
	$describe_user=htmlentities($_POST['describe_user']);
	$u_pass=htmlentities($_POST['u_pass']);
	$u_email=htmlentities($_POST['u_email']);
	$u_country=htmlentities($_POST['u_country']);
	$u_gender=htmlentities($_POST['u_gender']);
	$u_birthday=htmlentities($_POST['u_birthday']);
	$Relationshipe_status=htmlentities($_POST['Relationship']);
	
	
	$update="update users set f_name='$f_name',l_name='$l_name',user_name='$u_name',describe_user='$describe_user',Relationship='$Relationshipe_status',
	user_pass='$u_pass',user_email='$u_email',user_country='$u_country',user_birthday='$u_birthday',user_gender='$u_gender' where user_id='$user_id'";
	
	
	$run=mysqli_query($con,$update);
	if($run)
	{
		echo"<script>alert('Your profile updated')</script>";
		echo"<script>window.open('edit_profile.php?u_id$user_id','_self')</script>";
	}
}

?>