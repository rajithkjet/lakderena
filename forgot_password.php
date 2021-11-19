<?php 
    include "header.php";
    include './Authenticate.php';
?>

<div class="container">
	<div class="d-flex justify-content-center h-100">
		<div class="card">
			<div class="card-header">
				<div style="text-align:center;">
					<img src="./images/ld.png" alt="" width="50px" height="50px">
				</div>
				<h3>Password Reset Link</h3>
			</div>
			<?php $auth = new Authenticate(); ?>

			<?php if(isset($_POST['submit'])):?>
				<?php if(!$auth->userEmailExists($_POST['email'])) :?>
					<p class="d-flex justify-content-center links" style="color:red;">User does not exists with provided email.</p>
				<?php else: ?>
					<?php if($auth->sendPasswordResetLink(strip_tags($_POST['email']))): ?>
						<p style="padding-left: 10px;" class="d-flex justify-cont ent-center links"> Password reset link has been sent to your email.</p>
                    <?php else:?>
                        <p style="padding-left: 10px;" class="d-flex justify-cont ent-center links"> Something went wrong.</p>
					<?php endif; ?>
				<?php endif;?>
			<?php endif;?>
			<div class="card-body">
				<form action="" method="post">
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-user"></i></span>
						</div>
						<input type="email" name="email" id="email" class="form-control" placeholder="Email" required>		
					</div>
                    <div class="form-group">
						<input type="submit" name="submit" value="Send Reset Link" class="btn float-right login_btn" style="width: 180px;">
					</div>
				</form>
			</div>
			<div class="card-footer">
				<div class="d-flex justify-content-center links">
					Back to <a href="index.php">Login</a>
				</div>
			</div>
		</div>
	</div>
</div>

<?php include "footer.php" ?>
