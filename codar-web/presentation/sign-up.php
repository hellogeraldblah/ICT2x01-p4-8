<!DOCTYPE html>
<html lang="en">

<?php $page="Sign-up" ?>

<!-- Header -->
<?php
  require_once "../constants.php";
  require_once __SHARED_PRESENTATION_DIR__ . "head.php"
?>
<!-- End of Header -->

<body class="g-sidenav-show  bg-gray-100">
  <section class="min-vh-100 mb-8">
    <div class="page-header align-items-start min-vh-50 pt-5 pb-11 m-3 border-radius-lg" style="background-image: url('../assets/img/curved-images/curved14.jpg');">
    </div>
    <div class="container">
      <div class="row mt-lg-n10 mt-md-n11 mt-n10">
        <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
          <div class="card z-index-0">
            <div class="card-header text-center pt-4">
              <h5>Codar Registration</h5>
            </div>

            <div class="card-body">
             <form method="POST" action="../../logic/create_user_form.php" enctype="multipart/form-data" id="create_form">
              <form role="form text-left">
                <div class="mb-3">
                  <input type="text" class="form-control" placeholder="Name" aria-label="Name" aria-describedby="email-addon" name="signup_name" required/>
                </div>
                <div class="mb-3">
                  <input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="email-addon" name="signup_username" required/>
                </div>
                <div class="mb-3">
                  <input type="password" class="form-control" placeholder="Password" aria-label="Password" aria-describedby="password-addon" name="signup_password" required/>
                </div>
                <div class="text-center">
                  <button type="submit" class="btn bg-gradient-dark w-100 my-4 mb-2" form="create_form">Sign up</button>
                </div>
                <p class="text-sm mt-3 mb-0">Already have an account? <a href="../index.php" class="text-dark font-weight-bolder">Sign in</a></p>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--   Core JS Files   -->
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/soft-ui-dashboard.min.js?v=1.0.3"></script>
</body>

</html>
