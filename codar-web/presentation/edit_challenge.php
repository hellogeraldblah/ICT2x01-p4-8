<!DOCTYPE html>
<html lang="en">

<?php $page="Edit Challenge"; ?>

<?php
require_once "../logic/challengeManagement.php";

$challenge = $challenge_list_obj->search_challenge($_POST["challenge_id"]);
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
      <div class="row my-4">
        <!-- Container for map design -->
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header pb-0">
                <div class="col-lg-6 col-7">
                  <h4><?php echo $challenge->name; ?></h4>
                  <h6>Map #<?php echo $challenge->id; ?></h6>
                </div>
            </div>
            <div class="card-body pt-2">
              <div class="row">

                <form method="POST" action="../../logic/edit_challenge_form.php" enctype="multipart/form-data" id="create_form">
                <input type="hidden" name="challenge_id" value=<?php echo $challenge->id; ?>>
                <p>
                <!-- Challenge name -->
                <label class="form-control-label" for="basic-url">Challenge Name</label>
                <input type="text" class="form-control" onchange="remove_disabled()" value="<?php echo $challenge->name; ?>" placeholder="Pick an exciting name!" name="challengeName"/>
                </p>
                <!-- <button disabled type="submit" id="submit_challengeName_button" name="submit" class="btn btn-outline-danger">Save</button> -->

                <p>
                <!-- Number of moves -->
                <label class="form-control-label" for="challengeImage">Number of Moves</label>
                <input type="number" class="form-control" onchange="remove_disabled()" value="<?php echo $challenge->number_of_moves; ?>" placeholder="Number of moves to complete the challenge!" name="number_of_moves"/>
                </p>
                <!-- <button disabled type="submit" id="submit_numberOfMoves_button" name="submit" class="btn btn-outline-danger" form="create_form">Save</button> -->
                <p>
                <!-- Challenge file upload -->
                <label class="form-control-label" for="challengeImage">Challenge Design Image</label>

                <input type="file" class="form-control" onchange="remove_disabled()" name="fileToUpload" id="fileToUpload"/>
                </p>
                <h6>Current Map:</h6>
                <img src="<?php echo $challenge->filepath; ?>" alt="Challenge Map" class="img-fluid border-radius-lg">
                <!-- <button disabled type="submit" id="submit_fileToUpload_button" name="submit" class="btn btn-outline-danger" form="create_form">Save</button> -->
                </form>
              </div>
            </div>
        </div>
      </div>
      </div>

      <button disabled type="submit" id="submit_button" name="submit" class="btn btn-outline-danger" form="create_form">Save</button>

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
