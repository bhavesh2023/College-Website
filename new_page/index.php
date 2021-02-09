<?php
    
?>

<?php
    $val = "pending";
    require_once 'SimpleXLSX.php';
    
    if ( $xlsx = SimpleXLSX::parse('student-mat.xlsx') ) {
      // print_r( $xlsx->rows() );
    } else {
      echo SimpleXLSX::parseError();
    }
    
    require_once __DIR__ . '/vendor/autoload.php';

    use Phpml\Classification\KNearestNeighbors;
    
    $samples = [[18, 4, 4, 2, 2, 3, 4, 3, 4, 1, 1, 3, 6, 5, 6, 6], [10, 4, 0, 2, 2, 2, 4, 3, 4, 1, 0, 3, 6, 5, 6, 6], [18, 0, 0, 2, 2, 6, 4, 3, 4, 1, 1, 3, 6, 5, 6, 6], [18, 0, 4, 2, 2, 0, 4, 3, 4, 1, 1, 3, 6, 5, 6, 6], [18, 4, 4, 2, 2, 0, 4, 3, 4, 1, 1, 3, 6, 5, 6, 6]];
    $labels = ['for business', 'elementary', 'higher edu', 'military', 'further'];
    $classifier = new KNearestNeighbors();

    /// echo "training...\n";

    $classifier->train($samples, $labels);

    // echo "training complete \n";

    // $val = $classifier->predict([10, 4, 4, 2, 2, 0, 4, 3, 4, 1, 1, 3, 6, 5, 6, 6]
// );

    // echo $val;
    ?>


<?php
    if (isset($_POST['submit']))
    {
      // header("Location: ./res.php");
      // echo "button pressed";
      $age = $_POST['age'];
      $medu = $_POST['medu'];
      $fedu = $_POST['medu'];
      $travel = $_POST['travel'];
      $study = $_POST['study'];
      $fails = $_POST['fails'];
      $inp = [10, 4, 4, 2, 2, 0, 4, 3, 4, 1, 1, 3, 6, 5, 6, 6];
      $inp[0] = $age;
      $inp[1] = $medu;
      $inp[2] = $fedu;
      $inp[5] = $fails;
      $inp[3] = $travel;
      $inp[4] = $study;
      $val = $classifier->predict($inp);
      // echo $val;
      header("header: ./res.php?val=".$val);
            
    }


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign Up Form by Colorlib</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <div class="main">
        <div class="container">
            <div class="signup-content">
                <div class="signup-img">
                    <img src="images/signup-img.jpg" alt="">
                </div>
                <div class="signup-form">
                    <form method="POST" class="register-form" id="register-form">
                        <h2>Machine learning demo</h2>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="name">Age :</label>
                                <input type="text" name="age" id="name" required />
                            </div>
                            <div class="form-group">
                                <label for="father_name">Father's aeducation</label>
                                <input type="text" name="fedu" id="father_name" required />
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="name">mother's education</label>
                                <input type="text" name="medu" id="name" required />
                            </div>
                            <div class="form-group">
                                <label for="father_name">fails</label>
                                <input type="text" name="fails" id="father_name" required />
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="name">Travel time</label>
                                <input type="text" name="travel" id="name" required />
                            </div>
                            <div class="form-group">
                                <label for="father_name">Study time</label>
                                <input type="text" name="study" id="father_name" required />
                            </div>
                        </div>



                        <div class="form-submit">
                            <input type="submit" value="Reset All" class="submit" name="reset" id="reset" />
                            <input type="submit" value="Submit Form" class="submit" name="submit" id="submit" />
                        </div>

                        <div><h1>prediction results: <?php echo $val;?> </h1></div>
                    </form>
                </div>
            </div>
        </div>

    </div>

    <!-- JS -->
    <script src="vendor_j/jquery/jquery.min.js"></script>
    <script src="js/main.js"></script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>