<?php

    session_start();
    include "../admin/connection.php";

    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
        header("location: ../login.php");
        exit;
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Izmena Fotografije Studenta </title>
    <link rel="shortcut icon" href="../assets/favicon.ico" type="image/x-icon">
    <link rel="icon" href="../assets/favicon.ico" type="image/x-icon">

    <!-- Bootstrap cdn -->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">    <!--CSS sheet -->
    <link rel="stylesheet" type="text/css" href="../css/style.css">

    <script src="https://kit.fontawesome.com/49ff4a7b2e.js" crossorigin="anonymous"></script>

    <style>
        html{
            min-height:100%;
        }
    </style>
</head>
<body style="background-image: linear-gradient(#7ea7e0, white) ;">
<?php include("../navbar.php")?>
    <div class="container my-5" id="materialContent">
    <?php echo "<img src='../assets/".$_SESSION['fotografijaKorisnika']."' style='width:10%; height:10%;  float:right; alt='Profila slika'>"?>
		<h2 class="pb-4"> <strong> Izmena fotografije studenta </strong> </h2>

		
		<form action="updateStudentPhotoProcess.php" method="post" enctype="multipart/form-data">
            <label for="img"><strong>Promenite profilnu sliku:</strong></label>
			<input type="file" id="img" name="img" accept="image/*">
            
            </br></br>
            
            <input type="reset" class="btn btn-danger" value="Očisti polja"> &emsp; 
            <input type="submit" class="btn btn-success" name="submitBtn" value="Unesi izmene">
		</form>
    </div>
    <!--ako u ovom gore divu imas malo sadrzaja  te ti footer ovako visi, samo ubaci ovo include footer u div sa klasom fixed-bottom-->
    <div class="fixed-bottom">
        <?php include("../footer.php")?>
    </div>
     <!-- Latest compiled and minified JavaScript -->
   <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
   <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script></body>

</body>
</html>