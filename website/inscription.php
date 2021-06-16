
 
<?php
session_start();
require_once('db.php');


if(isset($_POST['Envoyer']))
{
    if(isset($_POST['name'],$_POST['adresse'],$_POST['tel'],$_POST['email']) && !empty($_POST['name']) && !empty($_POST['adresse']) && !empty($_POST['tel']) && !empty($_POST['email'])&& !empty($_POST['password']))
    {
        $name = trim($_POST['name']);
        $adresse = trim($_POST['adresse']);
        $tel = trim($_POST['tel']);
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);
        $password = password_hash($password,PASSWORD_DEFAULT);

        if(filter_var($email, FILTER_VALIDATE_EMAIL))
		{
            $sql = 'select * from requests where email = :email';
            $pdo = new PDO($name,$adresse,$tel,$email,$password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $pdo->prepare($sql);
            $p = ['email'=>$email];
            $stmt->execute($p);
            
            if($stmt->rowCount() == 0)
            {
                $sql = "insert into requests (nom, adresse,tel, email, shadow,) values(:name,:adresse,:tel,:password)";
                
                try{
                    
                    $handle = $pdo->prepare($sql);
                    $params = [
                        ':name'=>$name,
                        ':adresse'=>$adresse,
                        ':tel'=>$tel,
                        ':email'=>$email,
                        ':password'=>$password
                    
                    ];
                    
                    $handle->execute($params);
                    
                    $success = 'User has been created successfully';
                    
                }
                catch(PDOException $e){
                    $errors[] = $e->getMessage();
                }
            }
            else
            {
                $valFirstName = $name;
                $valEmail = '';
                $valAdresse = $adresse;
                $valPassword = $password;
                $varTel= $tel;

                $errors[] = 'Email address already registered';
            }
        }
        else
        {
            $errors[] = "Email address is not valid";
        }
    }
    else
    {
        if(!isset($_POST['name']) || empty($_POST['name']))
        {
            $errors[] = ' name is required';
        }
        else
        {
            $valName = $_POST['name'];
        }
        if(!isset($_POST['adresse']) || empty($_POST['adresse']))
        {
            $errors[] = 'Adresse is required';
        }
        if(!isset($_POST['tel']) || empty($_POST['tel']))
        {
            $errors[] = 'telephone is required';
        }
        else
        {
            $varTel = $_POST['tel'];
        }

        if(!isset($_POST['email']) || empty($_POST['email']))
        {
            $errors[] = 'Email is required';
        }
        else
        {
            $valEmail = $_POST['email'];
        }

        if(!isset($_POST['password']) || empty($_POST['password']))
        {
            $errors[] = 'Password is required';
        }
        else
        {
            $valPassword = $_POST['password'];
        }
        
    }

}
?>
 

<!doctype html>
<html>
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

</head>
<body class="bg-dark">

<div class="container h-100">
	<div class="row h-100 mt-5 justify-content-center align-items-center">
		<div class="col-md-5 mt-3 pt-2 pb-5 align-self-center border bg-light">
			<h1 class="mx-auto w-25" >Inscription</h1>
			<?php 
				if(isset($errors) && count($errors) > 0)
				{
					foreach($errors as $error_msg)
					{
						echo '<div class="alert alert-danger">'.$error_msg.'</div>';
					}
                }
                
                if(isset($success))
                {
                    
                    echo '<div class="alert alert-success">'.$success.'</div>';
                }
			?>
			<form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">
                <div class="form-group">
					<label for="email">Name:</label>
					<input type="text" name="name" placeholder="Entrer le nom" class="form-control" value="<?php echo ($valFirstName??'')?>">
				</div>
                <div class="form-group">
					<label for="adresse">Adresse:</label>
					<input type="text" name="adresse" placeholder="Entrer votre adresse" class="form-control" value="<?php echo ($varAdresse??'')?>">
				</div>
                <div class="form-group">
					<label for="tel">Téléphone:</label>
					<input type="number" name="tel" placeholder="Enter votre numéro" class="form-control" value="<?php echo ($valTel??'')?>">
				</div>

                <div class="form-group">
					<label for="email">Email:</label>
					<input type="text" name="email" placeholder="Entrer votre email" class="form-control" value="<?php echo ($valEmail??'')?>">
				</div>
				<div class="form-group">
				<label for="email">Password:</label>
					<input type="password" name="password" placeholder="Enter Password" class="form-control" value="<?php echo ($valPassword??'')?>">
				</div>

				<button type="Envoyer" name="Envoyer" class="btn btn-primary">Envoyer</button>
				
				
			</form>
		</div>
	</div>
</div>
</body>
</html>
