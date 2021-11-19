<?php include './Authenticate.php'; ?>

<div class="container">
	<div class="d-flex justify-content-center h-100">
		<div class="card">
			<div class="card-header">
				<div style="text-align:center;">
					<img src="./images/ld.png" alt="" width="50px" height="50px">
				</div>
				<h3>Sign In</h3>
                <?php $auth = new Authenticate(); ?>
                <?php if(isset($_POST['email']) || isset($_POST['password'])): ?>
                <?php $auth->login($_POST['email'], $_POST['password']); ?>
                <?php endif; ?>
			</div>
			<div class="card-body">
				<form action="" method="post">
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-user"></i></span>
						</div>
						<input type="text" name="email" id="email" class="form-control" placeholder="Email" required>		
					</div>
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-key"></i></span>
						</div>
						<input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
					</div>
					<div class="form-group">
						<input type="submit" value="Login" class="btn float-right login_btn">
					</div>
				</form>
			</div>
			<div class="card-footer">
				<div class="d-flex justify-content-center links">
					<a href="forgot_password.php">Forgot your password?</a>
				</div>
			</div>
		</div>
	</div>
</div>