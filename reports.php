<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=1">
  <meta name="description" content="Get your Website & Android Apps made from us at cheapest prices">
  <meta name="author" content="Techno3Gamma">
  <title>Login - Report Submit</title>
  <!-- SEO  -->

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/touch-icon.png" rel="touch-icon">
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Montserrat:300,400,500,700" rel="stylesheet">
  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom CSS Files -->
  <link href="assets/css/main.css" rel="stylesheet">
</head>
<body style="background:#000;">
<section>
      <div class="container">     
        <div class="row  mt-5">
          <div class="col-lg-6 m-auto">
            <div class="card bg-dark mt-5">
            <div class="section-header mt-3" > 
            <h3>
        
        </h3>
        <div class="align-centre">
        <h6>
        
        </h6>
        </div>
        </div>
        <div class="m-auto" > 
        <h4>
        <?php echo '<a href="logout.php?logout">Logout</a>';?>
        </h4>
        </div>
            <div class="card-body">
              <form action="mail.php" method="POST" enctype="multipart/form-data">
                <input type="text" name="Name" placeholder="Name" class="form-control mb-3" >
                <input style="height:70px;" type="text" name="Message" placeholder="Message" class="form-control mb-3" id="message">
                <input type="file" name="uploaded_file" class="form-control mb-3" accept="image/png,image/jpeg,document/pdf,docs/xlxs,doc/doc" id="file" required>               
                <div class="align-centre">
                  <button class="btn btn-primary btn-xl text-uppercase" name="submit">Submit Report</button>
                </div>
              </form>
            </div>
            </div>          
          </div>
        </div>
    </div>
  </div>
</section>
<a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>
  <!-- Uncomment below i you want to use a preloader -->
  <!-- <div id="preloader"></div> -->
  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
  
</body>
</html>