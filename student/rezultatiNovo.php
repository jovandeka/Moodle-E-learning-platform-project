<?php

    session_start();
    include "../admin/connection.php";
    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
        header("location: ../login.php");
        exit;
    }

    global $conn;

    $sum = 0;
    $pogresno=[];
    $idT = $_SESSION['id'];
    $testName = $_SESSION['nazivTesta'];
    if(isset($_SESSION['answer'])){
        for($i=1;$i<sizeof($_SESSION['answer'])+1;$i++){
            $praviBrojPitanja=(int)$i+(int)$_SESSION['offset'];
            $query = "SELECT * FROM pitanje WHERE idTesta = '$idT' AND brojPitanja = '$praviBrojPitanja'";
            $result = mysqli_query($conn, $query);

            while($row = mysqli_fetch_array($result)) {
                $answer = $row['tacan'];                
            }
            $answer=explode(",",$answer);
            $velicina=sizeof($answer);
            $tacnost=0;
            $datiOdgovori=array_unique($_SESSION['answer'][$i]);
            //echo $tacnost;
            // for($e=0;$e<sizeof($datiOdgovori);$e++){
            //     echo $datiOdgovori[$e];
            // }
            
            // for($k=0;$k<$velicina;$k++){
            //     for($j=0;$j<sizeof($datiOdgovori);$j++){
                   
            //         if($answer[$k]==$datiOdgovori[$j]){
            //             $tacnost++;
            //             break;
            //         }else{
            //             $tacnost--;
            //         }
            //     }
            // }
            $same = ( count( $answer ) == count( $datiOdgovori ) && !array_diff( $answer, $datiOdgovori ) );
            if($same){
                $sum=$sum+5;
            }else{
                $sum=$sum-2.5;
                array_push($pogresno,$i);
            }
            echo "\n";
            // for($k=0;$k<$velicina;$k++){
            //     //echo $_SESSION['answer'];
            //     //echo $_SESSION['answer2'];
            //     //echo $_SESSION['answer3'];
            //     //echo $_SESSION['answer4'];
            //     if(isset($_SESSION['answer'][$i])&&$answer[$k]==$_SESSION['answer'][$i]){$tacnost++;}
            //     if(isset($_SESSION['answer2'][$i])&&$answer[$k]==$_SESSION['answer2'][$i]){$tacnost++;}
            //     if(isset($_SESSION['answer3'][$i])&&$answer[$k]==$_SESSION['answer3'][$i]){$tacnost++;}
            //     if(isset($_SESSION['answer4'][$i])&&$answer[$k]==$_SESSION['answer4'][$i]){$tacnost++;}
            // }

            // if($tacnost==$velicina){
            //     $sum=$sum+5;
            // }else{
            //     $sum=$sum-2.5;
            //     array_push($pogresno,$i);
            // }

        }
        //echo $sum;
        $_SESSION['points']=$sum;
    }
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rezultat testa</title>
    <link rel="shortcut icon" href="../assets/favicon.ico" type="image/x-icon">
    <link rel="icon" href="../assets/favicon.ico" type="image/x-icon">


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
    <div class="container my-5" id="materialContent" style="min-height:30em">

    <h1 class="text-center">  <?php echo $_SESSION['nazivTesta']; ?> </h1> 
    <?php
        if($sum < 50) { ?>  
            <h3 class="text-center" style="color:#309649"> <?php echo $sum."/100"; ?> </h3>
            <?php
        }
        else { ?>
            <h3 class="text-center" style="color: red"> <?php echo $sum."/100"; ?> </h3>
            <?php
        }
    ?>
    <!-- u slucaju da je student bez greske odradio test-->
    <!-- <h1 class="mt-5 text-center">Nema netačnih pitanja.</h1> -->

    <h3 class="my-3"> Pogresno odgovorena pitanja: </h3>

    <?php

        $answer = "";
        
        for($i = 0; $i < sizeof($pogresno) ; $i++) { 
            $praviBrojPitanja=(int)$pogresno[$i]+$_SESSION['offset'];
            $query = "SELECT * FROM pitanje WHERE idTesta = '$idT' AND brojPitanja = '$praviBrojPitanja'";

            $result = mysqli_query($conn, $query);
            
            while($row = mysqli_fetch_array($result)) {
                $answer = $row['tacan'];
                $textQuestion = $row['tekstPitanja'];
                
            } ?>



                    <div class="row mt-4">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <strong> Pitanje broj: <?php echo $pogresno[$i]; ?> </strong>
                                </div>

                                <div class="card-body card-block">
                                    <p style="font-size:1.4em; font-weight:bold;"> <?php echo "Pitanje: ".$textQuestion; ?> </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                
            
        }
    ?>

    <div class="row mt-5 mb-3">
        <div class="text-left col-6 ">
            <a href="../student/insertTestResultProcess.php" class="btn btn-info" style="align-items:center"> Nazad na kurs </a>         
        </div>
    </div>

    </div>
    <!--ako u ovom gore divu imas malo sadrzaja  te ti footer ovako visi, samo ubaci ovo include footer u div sa klasom fixed-bottom-->
    <?php include("../footer.php")?>
     <!-- Latest compiled and minified JavaScript -->
   <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
   <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script></body>

</body>
</html>


