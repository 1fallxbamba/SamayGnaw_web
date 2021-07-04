<?php include("scripts2/register.php"); ?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8" />      
		<meta name="description" content="" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- LINEARICONS -->
	<link rel="stylesheet" href="fonts2/linearicons/style.css">

<!-- STYLE CSS -->
	<link rel="stylesheet" href="css3/style.css">

	<body>

		<div class="wrapper">
			<div class="inner">
				<form action="" method="POST">
					<h3>Créer votre salon</h3>

					<?php echo $success_msg; ?>
          			<?php echo $email_exist; ?> 

					<div class="form-holder">
						<span class="lnr lnr-user"></span>
						<input type="text" class="form-control" name="name" id="name" placeholder="Nom de votre salon">
						<?php echo $emptyError1; ?>
					</div>

					<div class="form-holder">
						<span class="lnr lnr-phone-handset"></span>
						<input type="text" class="form-control" maxlength="9" id="mobile" name="mobile" placeholder="Numéro de téléphone">
						<?php echo $emptyError4; ?>
					</div>

					<div class="form-holder">
						<span class="lnr lnr-envelope"></span>
						<input type="text" class="form-control"  name="email" id="email" placeholder="Adresse Email">
						<?php echo $emptyError3; ?>
					</div>

					<div class="form-holder">
						<span class="lnr lnr-home"></span>
						<input type="text" class="form-control" name="adresse" id="adresse" placeholder="Votre adresse">
						<?php echo $emptyError2; ?>
					</div>

					<div class="form-holder">
						<span class="lnr lnr-lock"></span>
						<input type="password" class="form-control" name="password" id="password" placeholder="Mot de passe">
						<?php echo $emptyError5; ?>
					</div>
					
					
					<div class="form-holder">
					<button type="submit" name="submit" id="submit" class="btn btn-primary btn-lg btn-block">
					Enregistrer
					</button>
					</div>
				</form>
				
			</div>
			
		<script src="js2/jquery-3.3.1.min.js"></script>
		<script src="js2/main.js"></script>
	</body>
</html>