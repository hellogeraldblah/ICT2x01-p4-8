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
  $page="Game Over";
  require_once "../constants.php";
?>

<!-- Challenge Class -->
<?php
require_once __LOGIC_DIR__ . "challengeManagement.php";
require_once __LOGIC_DIR__ . "achievementManagement.php";

$challenge = $challenge_management_obj->search_challenge($conn, $_POST["challenge_id"]);
$earned_stars = $challenge_management_obj->determineNumberOfStars($conn, $_POST["challenge_id"], $_POST["moves"]);
$achievementManagement_obj->awardAchievement($conn, $_SESSION["user_id"],$_POST["challenge_id"],$earned_stars); //need to change to session ID

?>

<!-- Header -->
<?php require_once __SHARED_PRESENTATION_DIR__ . "head.php" ?>
<!-- End of Header -->

<!-- <body class="g-sidenav-show bg-gray-100" onload="start()"> -->
  <body class="g-sidenav-show bg-gray-100">

  <!-- Side Panel -->
  <?php require_once __SHARED_PRESENTATION_DIR__ . "sidepanel.php" ?>
  <!-- End Side Panel -->

  <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">

    <!-- Navbar -->
    <?php require_once __SHARED_PRESENTATION_DIR__ . "navbar.php" ?>
    <!-- End Navbar -->

    <div class="container-fluid py-4">
      <div class="row mt-4">
          <div class="col-lg-3 mx-auto">
            <div class="card">
              <div class="card-body p-3">
                <div class="card-header p-0 mx-3 mt-3 position-relative z-index-1">
                  <div class="row text-center">
                    <div class="col-sm">
                      <?php if ($earned_stars >= 1) { echo "<span class='fa fa-star fa-3x checked'></span>"; } else { echo "<span class='fa fa-star fa-3x'></span>"; } ?>
                    </div>
                    <div class="col-sm">
                      <?php if ($earned_stars >= 2) { echo "<span class='fa fa-star fa-3x checked'></span>"; } else { echo "<span class='fa fa-star fa-3x'></span>"; } ?>
                    </div>
                    <div class="col-sm">
                      <?php if ($earned_stars >= 3) { echo "<span class='fa fa-star fa-3x checked'></span>"; } else { echo "<span class='fa fa-star fa-3x'></span>"; } ?>
                    </div>
                  </div>
                </div>
                <p class="card-description mb-4 text-center">
                    <h4 class="text-gradient text-danger mt-4 text-center">Congratulations!</h4>
                    <p class="text-center">
                      <?php echo "You have completed " . $challenge->get_name() ." in " . $_POST["moves"] . " moves!"; ?>
                    </p>
                    <form method="GET">
                      <input type="hidden" name="challenge_id" value=<?php echo $challenge->get_id(); ?>>
                    <div class="row text-center">
                      <div class="col-sm">
                          <input type="submit" formaction="play_challenge.php" class="btn btn-outline-dark" value="Restart">
                      </div>
                      <div class="col-sm">
                        <input type="submit" formaction="dashboard.php" class="btn btn-outline-dark" value="Exit">
                      </div>
                  </div>
                  </form>
                </p>
              </div>
            </div>
          </div>

      <?php require_once __SHARED_PRESENTATION_DIR__ . "footer.php" ?> <!-- Footer -->
    </div>




    </main>
  </body>

<!-- Blockly javascript -->
<script src="https://unpkg.com/blockly/blockly.min.js"></script>
<!-- <script src="https://unpkg.com/@blockly/dev-tools@2.0.0/dist/index.js"></script> -->
<script src="../assets/js/blockly/index.js"></script>
<script src="../assets/js/blockly/javascript_compressed.js"></script>
<!-- End of Blockly javascript -->

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
