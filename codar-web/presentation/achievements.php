<!DOCTYPE html>
<html lang="en">

<?php $page="Achievements"; ?>

<!-- Achievement Class -->
<?php
require_once "../logic/achievementManagement.php";
$achievementsManagement = new AchievementManagement($conn);
$achievements = $achievementsManagement->viewAchievement(1); //need to change to session id
?>

<!-- Header -->
<?php require_once "shared_presentation/head.php" ?>
<!-- End of Header -->

<body class="g-sidenav-show bg-gray-100">

  <!-- Side Panel -->
  <?php require_once "shared_presentation/sidepanel.php" ?>
  <!-- End Side Panel -->

  <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">

    <!-- Navbar -->
    <?php require_once "shared_presentation/navbar.php" ?>
    <!-- End Navbar -->

    <div class="container-fluid py-4">
      <div class="row mt-4">
        <?php foreach ($achievements as $achievement){
            $challengeId = $achievement->getChallengeId();
            $res = $conn->query("SELECT name,filepath FROM challenges WHERE id = '$challengeId'");
            while($row = $res-> fetchArray()){
                $name = $row['name'];
                $filepath = "/assets/img/challenges" . "/" . $row['filepath'];
            }
            ?>
        <div class="col-lg-3">
          <div class="card">

              <div class="card-body p-3">
              <div class="card-header p-0 mx-3 mt-3 position-relative z-index-1">
                <img src=<?php echo $filepath?> class="img-fluid border-radius-lg">
              </div>
              </br>
              <a href="javascript:;" class="card-title h5 d-block text-darker" style="text-align: center">
                <?php echo $name?>
              </a>
              <p class="card-description mb-4 text-center">
                <div class="row text-center">
                  <div class="col-sm">
                    <?php if ($achievement->getNumberOfStars() >= 1) { echo "<span class='fa fa-star fa-3x checked'></span>";} else { echo "<span class='fa fa-star fa-3x'></span>"; }?>
                  </div>
                  <div class="col-sm">
                      <?php if ($achievement->getNumberOfStars() >= 2) { echo "<span class='fa fa-star fa-3x checked'></span>";} else { echo "<span class='fa fa-star fa-3x'></span>"; }?>
                  </div>
                  <div class="col-sm">
                      <?php if ($achievement->getNumberOfStars() >= 3) { echo "<span class='fa fa-star fa-3x checked'></span>";} else { echo "<span class='fa fa-star fa-3x'></span>"; }?>
                </div>
              </div>
              </p>
            </div>
          </div>
        </div>
        <?php }?>
      </div>

      <!-- Footer -->
      <?php require_once "shared_presentation/footer.php" ?>
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
