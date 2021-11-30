<!--
=========================================================
* Soft UI Dashboard - v1.0.3
=========================================================

* Product Page: https://www.creative-tim.com/product/soft-ui-dashboard
* Copyright 2021 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://www.creative-tim.com/license)

* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!DOCTYPE html>
<html lang="en">

<?php $page="Profile"; ?>
<?php
$display_name = "Moe Lester";
$display_username = "mLester";
?>

<!-- Header -->
<?php require_once "shared_presentation/head.php" ?>
<!-- End of Header -->

<body class="g-sidenav-show bg-gray-100">

  <!-- Side Panel -->
  <?php require_once "shared_presentation/sidepanel.php" ?>
  <!-- End Side Panel -->

  <div class="main-content position-relative bg-gray-100 max-height-vh-100 h-100">

    <!-- Navbar -->
    <?php require_once "shared_presentation/navbar.php" ?>
    <!-- End Navbar -->


    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-6 mt-4 mx-auto">
          <div class="card mb-4">
            <div class="card-header pb-0 p-3">
              <h6 class="mb-1"><?php echo $display_name; ?>'s' Profile</h6>
              <p class="text-sm">@<?php echo $display_username; ?></p>
            </div>
            <div class="card-body p-3">
              <form method="POST">
              <div class="row">
                <div class="form-group">
                  <p>
                  <div class="input-group">
                      <input type="text" class="form-control" value="<?php echo $display_name; ?>" placeholder="What do people call you in real life?">
                  </div>
                </p>
                <p>
                  <div class="input-group">
                      <span class="input-group-text" id="basic-addon1">@</span>
                      <input type="text" class="form-control" value="<?php echo $display_username; ?>" placeholder="What do people call you online?">
                  </div>
                </p>
                </div>
              </div>
              <div class="row">
                <p>
                <button type="button" class="btn btn-outline-primary">Save</button>
                </p>
              </div>
            </form>
            </div>
          </div>
        </div>
      </div>
      <!-- Footer -->
      <?php require_once "shared_presentation/footer.php" ?>
      <!-- End Footer -->
    </div>
  </div>

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
