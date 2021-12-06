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
  $page="Create Challenge";
  require_once "../constants.php";
?>

<!-- Header -->
<?php require_once __SHARED_PRESENTATION_DIR__ . "head.php" ?>
<!-- End of Header -->

<body class="g-sidenav-show bg-gray-100" onload="start()">

  <!-- Side Panel -->
  <?php require_once __SHARED_PRESENTATION_DIR__ . "sidepanel.php" ?>
  <!-- End Side Panel -->

  <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">

    <!-- Navbar -->
    <?php require_once __SHARED_PRESENTATION_DIR__ . "navbar.php" ?>
    <!-- End Navbar -->

    <div class="container-fluid py-4">
      <div class="row my-4">
        <!-- Container for map design -->
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header pb-0">
                <div class="col-lg-6 col-7">
                  <h6>Map Design</h6>
                </div>
            </div>
            <div class="card-body pt-2">
              <div class="row">

              <form method="POST" action="../../logic/create_challenge_form.php" enctype="multipart/form-data" id="create_form">

                <!-- Challenge name -->
                <label class="form-control-label" for="basic-url">Challenge Name</label>
                <input type="text" class="form-control" placeholder="Pick an exciting name!" name="challengeName" required/>

                <p></p>

                <!-- Number of moves -->
                <label class="form-control-label" for="challengeImage">Number of Moves</label>
                <input type="number" class="form-control" placeholder="Number of moves to complete the challenge!" name="number_of_moves" required/>

                <p></p>

                <!-- Challenge file upload -->
                <label class="form-control-label" for="challengeImage">Challenge Design Image</label>
                <input type="file" class="form-control" name="fileToUpload" id="fileToUpload" required/>

              </form>

              </div>
            </div>
        </div>
      </div>
      </div>

      <!-- Create challenge submit button -->
      <button type="submit" name="submit" class="btn btn-outline-danger" form="create_form">Create</button>

      <!-- Footer -->
      <?php require_once __SHARED_PRESENTATION_DIR__ . "footer.php" ?>
      <!-- End Footer -->

    </div>

  </main>

  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/chartjs.min.js"></script>

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
