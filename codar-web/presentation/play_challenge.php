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
  $page="Play Challenge";
  require_once "../constants.php";
?>

<!-- Challenge Class -->
<?php
require_once __LOGIC_DIR__ . "challengeManagement.php";

$challenge_list = $challenge_management_obj->get_challenges();

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

    <?php $challenge = $challenge_management_obj->search_challenge($_GET["challenge_id"]); ?>

    <div class="container-fluid py-4 class-1">
      <div class="row">
        <div class="col-sm">
          <!-- Button trigger modal -->
          <button type="button" class="btn btn-outline-dark" onclick="start_tour()">
            Help
          </button>
        </div>
      </div>

      <div class="row">
        <div class="col-sm class-2">
          <h5 class="font-weight-bolder mb-0">
            Number of moves:
            <span class="text-danger font-weight-bolder" id="current_moves">0</span>
            <span class="text-danger font-weight-bolder">/ <?php echo $challenge->get_number_of_moves() ?></span>
            &nbsp;
            <span data-bs-toggle="tooltip" data-bs-placement="right" title="Going over the max moves only decreases your stars!">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
              </svg>
            </span>
          </h5>

        </div>
      </div>

      <div class="row my-4">
        <!-- Container for map design -->
        <div class="col-lg-4" id="map_container">
          <div class="card h-100">
            <div class="card-header pb-0">
              <h4><?php echo $challenge->get_name(); ?></h4>
              <h6>Map #<?php echo $challenge->get_id(); ?></h6>
            </div>
            <div class="card-body px-0 pb-2 text-center">
              <canvas class="img-fluid border-radius-lg" id="canvas" width="320" height="320"></canvas>
            </div>
          </div>
        </div>

        <div class="col-lg-2" id="history_container">
          <div class="card h-100">
            <div class="card-header pb-0">
              <div class="row">
                  <h6> History
                    <span data-bs-toggle="tooltip" data-bs-placement="right" title="Shows only your last 10 moves!">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16">
                      <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                      <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                    </svg>
                  </span></h6>
              </div>
            </div>
            <div class="card-body px-0 pb-2 text-center" id="history_body">
              <p><span hidden class=" " id="history_1">Empty action</span></p>
              <p><span hidden id="history_2">Empty action</span></p>
              <p><span hidden id="history_3">Empty action</span></p>
              <p><span hidden id="history_4">Empty action</span></p>
              <p><span hidden id="history_5">Empty action</span></p>
              <p><span hidden id="history_6">Empty action</span></p>
              <p><span hidden id="history_7">Empty action</span></p>
              <p><span hidden id="history_8">Empty action</span></p>
              <p><span hidden id="history_9">Empty action</span></p>
              <p><span hidden id="history_10">Empty action</span></p>
            </div>
          </div>
        </div>
        <div class="col-lg-6" id="command_container">
          <div class="card h-100">
            <div class="card-header pb-0">
              <h6>Commands</h6>
            </div>
            <div class="card-body p-3">
              <div id="blocklyDiv" style="height: 480px; width: auto;"></div>

              <!-- Blockly xml asset -->
              <?php require_once __SHARED_PRESENTATION_DIR__ . "blockly.php"; ?>
              <!-- End Blockly xml asset -->

            </div>
          </div>
        </div>
      </div>

      <button type="button" class="btn btn-outline-primary" onclick="showCode()" id="show_container" data-bs-toggle="modal" data-bs-target="#showCodeModal">
        Show Code
      </button>

      <button type="button" class="btn btn-outline-primary" onclick="runCode()" id="run_container">
        Run Code
      </button>
      <!-- Footer -->
      <?php require_once "shared_presentation/footer.php" ?>
      <!-- End Footer -->
    </div>
  </main>

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

    <!-- Hidden form for game_over.php -->
    <form name="myform" method="POST" action="game_over.php">
      <input type="hidden" id="moves_input" name="moves" value=""><br>
      <input type="hidden" id="challenge_id_input" name="challenge_id" value="<?php echo $challenge->get_id(); ?>"><br>
      <button type="submit"></button>
    </form>

<!-- Blockly javascript -->
<script src="https://unpkg.com/blockly/blockly.min.js"></script>
<script src="../assets/js/blockly/index.js"></script>
<script src="../assets/js/blockly/javascript_compressed.js"></script>
<!-- End of Blockly javascript -->

<!-- Tutorial javascript -->
<script src="../assets/node_modules/popperjs/core/dist/umd/shepherd.min.js"></script>
<script src="../assets/node_modules/shepherd.js/dist/js/shepherd.min.js"></script> -->
<link rel="stylesheet" href="../assets/node_modules/shepherd.js/dist/css/shepherd.css"/>
<!-- End of Tutorial javascript -->

<script src="../assets/js/core/popper.min.js"></script>
<script src="../assets/js/core/bootstrap.min.js"></script>
<script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
<script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
<script src="../assets/js/plugins/chartjs.min.js"></script>

<!-- <script src="https://cdn.jsdelivr.net/npm/shepherd.js@5.0.1/dist/js/shepherd.js"></script> -->

<script>
    var moves = 0;
    var canvas = document.getElementById("canvas");
    var context = canvas.getContext("2d");
    var circle_context = canvas.getContext("2d");

    var map_img = new Image();
    map_img.src = "<?php echo __CHALLENGES_MAP_DIR__ . $challenge->get_filepath(); ?>";

    var start_x = 48;
    var start_y = 304;
    var end_x = 272;
    var end_y = 16;
    var current_x = 48;
    var current_y = 304;
    var circle_radius = 12;
    var grid_size = 32;

    var path_color = null;
    var max_history_count = 10;

    var history_array = new Array();
    var count = 0;
    var hist_tag = null;
    var element = null;
    var up_class = "badge badge-pill badge-lg bg-success";
    var left_class = "badge badge-pill badge-lg bg-info";
    var right_class = "badge badge-pill badge-lg bg-primary";
    var down_class = "badge badge-pill badge-lg bg-danger";

    window.onload = function() {
      start();
      draw_img();

      // Indicates the color of path which the "car" can go
      // under the assumption that it will spawn on a path block
      path_color = circle_context.getImageData(start_x, start_y, 1, 1);
      draw_car(start_x, start_y);
    }

    function compareImages(img1, img2) {
       if (img1.data.length != img2.data.length) {
           return false;
       }
       for (var i = 0; i < img1.data.length; ++i) {
           if (img1.data[i] != img2.data[i]) {
               return false;
           }
       }
       return true;
    }

    function detect_collision(x, y) {
      // Collision detection on map
      if (compareImages(circle_context.getImageData(x, y, 1, 1), path_color)) {
        return true;
      }
      return false;
    }

    function update_moves() {
      moves += 1;
      document.getElementById("current_moves").innerHTML = moves;
    }

    function draw_img() {
      context.drawImage(map_img, 0, 0);
    }

    function draw_car(old_x, old_y, new_x=start_x, new_y=start_y) {
      if (detect_collision(new_x, new_y) == true) {
        current_x = new_x;
        current_y = new_y;
      } else {
        console.log("Movement not allowed!" + new_x + new_y + " is not a path/starting block!" );
      }

      circle_context.beginPath();
      circle_context.arc(current_x, current_y, circle_radius, 0, Math.PI * 2);
      circle_context.fillStyle = "red";
      circle_context.fill();

      if (new_x == end_x && new_y == end_y) {
        game_over();
      } else {
        update_history();
      }
    }

    function add_history(data){
      history_array.push(data);
    }

    function update_history() {
      count = 0;
      console.log(history_array.length);

      for (i = history_array.length - 1; i >= 0; i--) {
        count+=1;

        hist_tag = "history_" + count;

        element = document.getElementById(hist_tag);
        element.innerHTML = history_array[i];

        if (history_array[i].includes("Up")) {
          element.className = up_class;
        } else if (history_array[i].includes("Left")) {
          element.className = left_class;
        } else if (history_array[i].includes("Right")) {
          element.className = right_class;
        } else {
          element.className = down_class;
        }
        element.removeAttribute("hidden");
        if (count == max_history_count) {
          break;
        }
      }
    }

    function game_over() {
      document.getElementById("moves_input").value = moves;
      document.myform.submit();
    }

    function move_car_up() {
      circle_context.clearRect(0, 0, canvas.width, canvas.height);
      draw_img();
      add_history("Move Up");
      new_y = current_y - grid_size;
      draw_car(current_x, current_y, current_x, new_y);
    }

    function move_car_left() {
      circle_context.clearRect(0, 0, canvas.width, canvas.height);
      draw_img();
      add_history("Move Left");
      new_x = current_x - grid_size;
      draw_car(current_x, current_y, new_x, current_y);
    }

    function move_car_right() {
      circle_context.clearRect(0, 0, canvas.width, canvas.height);
      draw_img();
      add_history("Move Right");
      new_x = current_x + grid_size;
      draw_car(current_x, current_y, new_x, current_y);
    }

    function move_car_down() {
      circle_context.clearRect(0, 0, canvas.width, canvas.height);
      draw_img();
      add_history("Move Down");
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
  <script>

  const tour = new Shepherd.Tour({
    defaultStepOptions: {
      cancelIcon: {
        enabled: true
      },
      scrollTo: { behavior: 'smooth', block: 'center' }
    }
  });

  tour.addStep({
    title: 'Playing a challenge (1/4)',
    text: `This is the map and the red circle represents your car! When you send a command, your car and the red circle moves together!`,
    attachTo: {
      element: '#map_container',
      on: 'top'
    },
    classes: 'shepherd shepherd-open shepherd-theme-arrows shepherd-transparent-text',
    buttons: [
      {
        action() {
          return this.back();
        },
        classes: 'shepherd shepherd-open shepherd-theme-arrows shepherd-transparent-text',
        text: 'Back'
      },
      {
        action() {
          return this.next();
        },
        text: 'Next'
      }
    ],
    id: 'creating'
  });

  tour.addStep({
    title: 'Playing a challenge (2/4)',
    text: `This is the movement history, any command you send will be shown here!`,
    attachTo: {
      element: '#history_container',
      on: 'top'
    },
    buttons: [
      {
        action() {
          return this.back();
        },
        classes: 'shepherd-theme-dark shepherd-button-secondary',
        text: 'Back'
      },
      {
        action() {
          return this.next();
        },
        text: 'Next'
      }
    ],
    id: 'creating'
  });

  tour.addStep({
    title: 'Playing a challenge (3/4)',
    text: `This is the command panel, you can cook up a mix of commands using the blocks to move the car to your destination!`,
    attachTo: {
      element: '#command_container',
      on: 'top'
    },
    buttons: [
      {
        action() {
          return this.back();
        },
        classes: 'shepherd-theme-dark shepherd-button-secondary',
        text: 'Back'
      },
      {
        action() {
          return this.next();
        },
        text: 'Next'
      }
    ],
    id: 'creating'
  });

  tour.addStep({
    title: 'Playing a challenge (4/4)',
    text: `This is the map and the red circle represents your car! When you send a command, your car and the red circle moves together!`,
    attachTo: {
      element: '#run_container',
      on: 'top'
    },
    buttons: [
      {
        action() {
          return this.back();
        },
        classes: 'shepherd-theme-dark shepherd-button-secondary',
        text: 'Back'
      },
      {
        action() {
          return this.complete();
        },
        text: 'Done'
      }
    ],
    id: 'creating'
  });

  function start_tour() {
    tour.start();
  }


  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/soft-ui-dashboard.min.js?v=1.0.3"></script>

</body>
</html>
