<!DOCTYPE html>
<html lang="en">

<?php $page="Play Challenge"; ?>

<!-- Challenge Class -->
<?php
require_once "../logic/classes/challenge.php";
require_once "../logic/challengeManagement.php";
require_once "../databases/database.php";

  $challenge_list_obj = new ChallengeManagement($conn);
  $challenge_list = $challenge_list_obj->get_challenges();

 ?>

<!-- Header -->
<?php require_once "shared_presentation/head.php" ?>
<!-- End of Header -->

<!-- <body class="g-sidenav-show bg-gray-100" onload="start()"> -->
  <body class="g-sidenav-show bg-gray-100">

  <!-- Side Panel -->
  <?php require_once "shared_presentation/sidepanel.php" ?>
  <!-- End Side Panel -->

  <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">

    <!-- Navbar -->
    <?php require_once "shared_presentation/navbar.php" ?>
    <!-- End Navbar -->

    <?php $challenge = $challenge_list_obj->search_challenge($_POST["challenge_id"]); ?>

    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-sm">
          <!-- Button trigger modal -->
          <button type="button" class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#tutorialModal">
            Help
          </button>
        </div>
      </div>

      <div class="row">
        <div class="col-sm">
          <h5 class="font-weight-bolder mb-0">
            Number of moves:
            <span class="text-danger font-weight-bolder" id="current_moves">0</span>
            <span class="text-danger font-weight-bolder">/ <?php echo $challenge->numberOfMoves ?></span>
          </h5>
        </div>
      </div>

      <div class="row my-4">
        <!-- Container for map design -->
        <div class="col-lg-4">
          <div class="card h-100">
            <div class="card-header pb-0">
              <h4><?php echo $challenge->name; ?></h4>
              <h6>Map #<?php echo $challenge->id; ?></h6>
            </div>
            <div class="card-body px-0 pb-2 text-center">
              <!-- <img src="<?php echo $challenge->filepath; ?>" alt="Challenge Map" class="img-fluid border-radius-lg"> -->
              <canvas class="img-fluid border-radius-lg" id="canvas" width="320" height="320"></canvas>
            </div>
          </div>
        </div>
        <div class="col-lg-2">
          <div class="card h-100">
            <div class="card-header pb-0">
              <div class="row">
                <div class="col-lg-6 col-7">
                  <h6>History</h6>
                </div>
              </div>
            </div>
            <div class="card-body px-0 pb-2 text-center">

            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="card h-100">
            <div class="card-header pb-0">
              <h6>Commands</h6>
            </div>
            <div class="card-body p-3">
              <div id="blocklyDiv" style="height: 480px; width: 690px;"></div>

              <!-- Blockly xml asset -->
              <?php require_once "blockly.php"; ?>
              <!-- End Blockly xml asset -->

            </div>
          </div>
        </div>
      </div>

      <button type="button" class="btn btn-outline-primary" onclick="showCode()" data-bs-toggle="modal" data-bs-target="#showCodeModal">
        Show Code
      </button>

      <button type="button" class="btn btn-outline-primary" onclick="runCode()">
        Run Code
      </button>
      <!-- Footer -->
      <?php require_once "shared_presentation/footer.php" ?>
      <!-- End Footer -->
    </div>
  </main>


    <!-- Tutorial Modal -->
    <div class="modal fade" id="tutorialModal" tabindex="-1" role="dialog" aria-labelledby="tutorialModal" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Tutorial</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body" id="tutorial">Guide here</div>
          <div class="modal-footer">
            <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Show Code Modal -->
    <div class="modal fade" id="showCodeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Generated Javascript</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body" id="showCode">If you see this message, it means you have nothing in the workspace!</div>
          <div class="modal-footer">
            <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Game Over Modal -->
    <div class="modal fade" id="showCodeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Generated Javascript</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body" id="showCode">If you see this message, it means you have nothing in the workspace!</div>
          <div class="modal-footer">
            <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>


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

    var moves = 0;
    var canvas = document.getElementById("canvas");
    var context = canvas.getContext("2d");
    var circle_context = canvas.getContext("2d");

    var map_img = new Image();
    map_img.src = "<?php echo $challenge->filepath; ?>";

    var start_x = 48;
    var start_y = 304;
    var end_x = 272;
    var end_y = 16;
    var current_x = 48;
    var current_y = 304;
    var circle_radius = 12;
    var grid_size = 32;

    var path_color = null;

    window.onload = function() {
      start();
      draw_img();
      // Indicates the color of path which the "car" can go
      path_color = circle_context.getImageData(start_x, start_y, 1, 1);
      draw_car(start_x, start_y);
    }

    function compareImages(img1, img2) {
       if (img1.data.length != img2.data.length)
           return false;
       for (var i = 0; i < img1.data.length; ++i) {
           if (img1.data[i] != img2.data[i])
               return false;
       }
       return true;
    }

    function update_moves(number_to_add) {
      moves += number_to_add;
      document.getElementById("current_moves").innerHTML = moves;
    }

    function draw_img() {
      context.drawImage(map_img, 0, 0);
    }

    function draw_car(old_x, old_y, new_x=start_x, new_y=start_y){
      // Collision detection on map
      if (compareImages(circle_context.getImageData(new_x, new_y, 1, 1), path_color)) {
        console.log("You can move safely!");
        circle_context.beginPath();
        circle_context.arc(new_x, new_y, circle_radius, 0, Math.PI * 2);
        circle_context.fillStyle = "red";
        circle_context.fill();
        current_x = new_x;
        current_y = new_y;
      } else {
        console.log("Cannot move!");
        circle_context.beginPath();
        circle_context.arc(old_x, old_y, circle_radius, 0, Math.PI * 2);
        circle_context.fillStyle = "red";
        circle_context.fill();
      }

      if (new_x == end_x && new_y == end_y) {
        alert("Game over!");
      }

    }

    function move_car_up() {
      circle_context.clearRect(0, 0, canvas.width, canvas.height);
      draw_img();
      new_y = current_y - grid_size;
      draw_car(current_x, current_y, current_x, new_y);
    }

    function move_car_left() {
      circle_context.clearRect(0, 0, canvas.width, canvas.height);
      draw_img();
      new_x = current_x - grid_size;
      draw_car(current_x, current_y, new_x, current_y);
    }

    function move_car_right() {
      circle_context.clearRect(0, 0, canvas.width, canvas.height);
      draw_img();
      new_x = current_x + grid_size;
      draw_car(current_x, current_y, new_x, current_y);
    }

    function move_car_down() {
      circle_context.clearRect(0, 0, canvas.width, canvas.height);
      draw_img();
      new_y = current_y + grid_size;
      draw_car(current_x, current_y, current_x, new_y);
    }

    // Move forward block return
    Blockly.JavaScript['up'] = function(block) {
      var code = "moveUp();\n";
      return code;
    };

    // Move left block return
    Blockly.JavaScript['left'] = function(block) {
      var code = "moveLeft()\n";
      return code;
    };

    // Move right block return
    Blockly.JavaScript['right'] = function(block) {
      var code = "moveRight()\n";
      return code;
    };

    // Move backward block return
    Blockly.JavaScript['down'] = function(block) {
      var code = "moveDown()\n";
      return code;
    };

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
