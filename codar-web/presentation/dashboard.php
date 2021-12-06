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
  $page="Dashboard";
  require_once "../constants.php";
?>

<?php include "modal.php" ?>
<?php $page="Dashboard"; ?>
<link rel="stylesheet" href="/assets/css/dashboard.css">
<!-- Header -->
<?php require_once __SHARED_PRESENTATION_DIR__ . "head.php" ?>

<!-- End of Header -->

<body class="g-sidenav-show bg-gray-100">

  <!-- Side Panel -->
  <?php require_once __SHARED_PRESENTATION_DIR__ . "sidepanel.php" ?>

  <!-- End Side Panel -->

  <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">

    <!-- Navbar -->
    <?php require_once __SHARED_PRESENTATION_DIR__ . "navbar.php"; ?>
    <!-- End Navbar -->

    <div class="container-fluid py-4">

      <div class="row">
        <h2>Welcome to codar</h2>
        <div class="dashboard-title">
          <span>The purpose of Codar is to provide next level of fun with technology for the next generations.</span>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <h5 class="font-weight-bolder mb-0">WiFi Module ESP8266</h5>
                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Please ensure that you're connected.</p>
                  </div>
                  <img src="data:image/png;base64,<?php echo base64_encode(file_get_contents(__DASHBOARD_IMG_DIR__ . "wifi-signal.png")); ?>"width="60">
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-dark shadow text-center border-radius-md">
                    <!-- <i class="fas fa-check" style="color:#17ad37;"></i> -->
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <h5 class="font-weight-bolder mb-0">Ultrasonic</h5>
                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Please ensure that you're connected.</p>
                  </div>
                  <img src="data:image/png;base64,<?php echo base64_encode(file_get_contents(__DASHBOARD_IMG_DIR__ . "ultrasonic_icon.png")); ?>"width="90">
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-dark shadow text-center border-radius-md">
                    <!-- <i class="fas fa-check" style="color:#17ad37;"></i> -->
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <h5 class="font-weight-bolder mb-0">
                      TCRT5000 IR Module
                    </h5>
                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Please ensure that you're connected.</p>
                  </div>
                  <img src="data:image/png;base64,<?php echo base64_encode(file_get_contents(__DASHBOARD_IMG_DIR__ . "TCRT5000 IR Module.png")); ?>"width="90">
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-dark shadow text-center border-radius-md">
                    <!-- <i class="fas fa-check" style="color:#17ad37;"></i> -->
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <h5 class="font-weight-bolder mb-0">IR optical speed sensors</h5>
                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Please ensure that you're connected.</p>
                  </div>
                  <img src="data:image/png;base64,<?php echo base64_encode(file_get_contents(__DASHBOARD_IMG_DIR__ . "speed_sensor.png")); ?>"width="90">
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-dark shadow text-center border-radius-md">
                    <!-- <i class="fas fa-check" style="color:#17ad37;"></i> -->
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div><br>
      <div class="row mt-4">
        <div class="col-lg-7 mb-lg-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                    <p class="mb-1 pt-2 text-bold">CODAR Speed</p>
                    <div id="chartContainer" style="height: 370px; width: 100%; overflow:auto">
                      <?php include "linegraph.php"; ?>
                      <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
                    </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-5">
          <div class="card h-100 p-3">
            <div class="overflow-hidden position-relative border-radius-lg bg-cover h-100">
              <div class="card-body position-relative z-index-1 d-flex flex-column h-100 p-3">
              <div class="codar_info">
                  <h2 class="mb-1 pt-2"><u>CODAR INFOMRATION</u></h2>
                    You can view all of codar's latest data collected here.
                    <table>
                      <tr>
                      <td><h3>Speed</h3><h6>(cm/sec)</h6></td>
                      <td><h3>Distance</h3><h6>(cm)</h6></td>
                      <td><h3>Direction</h3><h6>(L/R)</h6></td>
                      </tr>
                      <?php include "leaderboard.php"; ?>
                    </table>
                  </div>
                  </div>
              </div>

            </div>
          </div>
        </div>
      </div>

      <!-- Footer -->
      <?php require_once __SHARED_PRESENTATION_DIR__ . "footer.php" ?>
      <!-- End Footer -->

    </div>
  </main>


  <!--   Core JS Files   -->
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/chartjs.min.js"></script>
  <script src="https://code.highcharts.com/highcharts.js"></script>
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
