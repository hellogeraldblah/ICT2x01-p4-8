<?php
session_start();

if (!isset($_SESSION["user_id"]))
{
  header("location: ../index.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<?php
  $page="Challenges";
  require_once "../constants.php";
?>

<!-- Challenge Class -->
<?php
require_once __LOGIC_DIR__ . "challengeManagement.php";

$challenge_list = $challenge_management_obj->get_challenges($conn);

?>

<!-- Header -->
<?php require_once __SHARED_PRESENTATION_DIR__ . "head.php" ?>
<!-- End of Header -->

<body class="g-sidenav-show bg-gray-100">

  <!-- Side Panel -->
  <?php require_once __SHARED_PRESENTATION_DIR__ . "sidepanel.php" ?>
  <!-- End Side Panel -->

  <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">

    <!-- Navbar -->
    <?php require_once __SHARED_PRESENTATION_DIR__ . "navbar.php" ?>
    <!-- End Navbar -->

    <div class="container-fluid py-4">

        <?php foreach ($challenge_list as $key=>$challenge) { ?> <!-- Start of Foreach -->

        <?php if ($key == 0 or $key % 4 == 0) { echo '<div class="row mt-4">'; } ?> <!-- Opening <div> for class="row" -->

          <div class="col-lg-3">
            <div class="card">
              <div class="card-body p-3">
                <div class="card-header p-0 mx-3 mt-3 position-relative z-index-1 text-center">
                  <img src="<?php echo __CHALLENGES_MAP_DIR__ . $challenge->get_filepath(); ?>" class="img-fluid border-radius-lg">
                </div>
                </br>
                <a href="javascript:;" class="card-title h5 d-block text-darker text-center">
                  <?php echo $challenge->get_name(); ?>
                </a>
                <p class="card-description mb-4 text-center">
                  <form method="GET">
                    <div class="row text-center">
                      <input type="hidden" name="challenge_id" value=<?php echo $challenge->get_id(); ?>>
                      <div class="col-sm">
                          <input type="submit" formaction="play_challenge.php" class="btn btn-outline-dark" value="Play">
                      </div>
                      <div class="col-sm">
                        <input type="submit" formaction="edit_challenge.php" class="btn btn-outline-dark" value="Edit">
                      </div>
                  </div>
                </form>
                </p>
              </div>
            </div>
          </div>

        <?php if ($key + 1 % 4 == 0) { echo '</div>'; } ?> <!-- Closing <div> for class="row" -->

      <?php } ?> <!-- End of Foreach -->

      <?php require_once __SHARED_PRESENTATION_DIR__ . "footer.php" ?> <!-- Footer -->
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
