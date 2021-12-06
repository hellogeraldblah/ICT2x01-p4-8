<?php
session_start();

if (!isset($_SESSION["user_id"]))
{
  header("location: __INDEX_PAGE__");
}
?>

<!DOCTYPE html>
<html lang="en">

<?php
  $page="Profile";
  require_once "../constants.php";
?>
<?php
  require_once __CLASSES_DIR__ . "user.php";
?>

<!-- Header -->
<?php require_once __SHARED_PRESENTATION_DIR__ . "head.php" ?>
<!-- End of Header -->

<body class="g-sidenav-show bg-gray-100">

  <!-- Side Panel -->
  <?php require_once __SHARED_PRESENTATION_DIR__ . "sidepanel.php" ?>
  <!-- End Side Panel -->

  <div class="main-content position-relative bg-gray-100 max-height-vh-100 h-100">

    <!-- Navbar -->
    <?php require_once __SHARED_PRESENTATION_DIR__ . "navbar.php" ?>
    <!-- End Navbar -->


    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-6 mt-4 mx-auto">
          <div class="card mb-4">
            <div class="card-header pb-0 p-3">
              <h6 class="mb-1"><?php echo $_SESSION["user_name"] ?>'s Profile</h6>
              <p class="text-sm">@<?php echo $_SESSION["user_username"]; ?></p>
            </div>
            <div class="card-body p-3">
              <div class="row">
                <form method="POST" action="../logic/edit_user_form.php" enctype="multipart/form-data" id="edit_user">
                <input type="hidden" name="challenge_id" value=<?php echo $_SESSION["user_id"]; ?>>
                <p>
                <!-- Challenge name -->
                <label class="form-control-label" for="name">Name</label>
                <input type="text" class="form-control" value="<?php echo $_SESSION["user_name"]; ?>" name="name"/>
                </p>

                <p>
                <label class="form-control-label" for="username">Username</label>
                <input type="text" class="form-control" value="<?php echo $_SESSION["user_username"]; ?>" name="username"/>
                </p>
                </form>
              </div>
              <button disabled type="submit" id="submit_button" name="submit" class="btn btn-outline-danger" form="edit_user">Save</button>
            </div>
          </div>
        </div>
      </div>



      <!-- Footer -->
      <?php require_once __SHARED_PRESENTATION_DIR__ . "footer.php" ?>
      <!-- End Footer -->
    </div>
  </div>

  <!--   Core JS Files   -->
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script>
    function remove_disabled() {
      button_id = "submit_button";
      var p = document.getElementById(button_id);
      p.removeAttribute("disabled");
    }
  </script>
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
