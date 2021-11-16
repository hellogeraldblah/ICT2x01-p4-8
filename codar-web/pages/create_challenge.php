<!DOCTYPE html>
<html lang="en">

<?php $page="Create Challenge"; ?>

<body class="g-sidenav-show bg-gray-100" onload="start()">

  <!-- Side Panel -->
  <?php include "shared_sections/sidepanel.php" ?>
  <!-- End Side Panel -->

  <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">

    <!-- Navbar -->
    <?php include "shared_sections/navbar.php" ?>
    <!-- End Navbar -->

    <div class="container-fluid py-4">

      <div class="row my-4">
        <!-- Container for map design -->
        <div class="col-lg-6">
          <div class="card">
            <div class="card-header pb-0">
              <div class="row">
                <div class="col-lg-6 col-7">
                  <h6>Map Design</h6>
                </div>
              </div>
            </div>
            <div class="card-body px-0 pb-2">
              <p></p>
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="card h-100">
            <div class="card-header pb-0">
              <h6>Solution</h6>
            </div>
            <div class="card-body p-3">
              <div id="blocklyDiv" style="height: 480px; width: 690px;"></div>
              <xml id="toolbox-categories" style="display: none">

                <!-- Control Category -->
                <category name="Movement" categorystyle="list_category">
                  <block type="forward"></block>
                  <block type="left"></block>
                  <block type="right"></block>
                  <block type="backward"></block>
                </category>

                <!-- Logic Category -->
                <category name="Logic" categorystyle="logic_category">
                  <block type="controls_if"></block>
                  <!-- <block type="logic_compare"></block> -->
                  <!-- <block type="logic_operation"></block> -->
                  <block type="logic_negate"></block>
                  <block type="logic_boolean"></block>
                  <!-- <block type="logic_null"></block> -->
                  <!-- <block type="logic_ternary"></block> -->
                </category>

                <!-- Loop Category -->
                <category name="Loops" categorystyle="loop_category">
                  <block type="controls_repeat_ext">
                    <value name="TIMES">
                      <shadow type="math_number">
                        <field name="NUM">5</field>
                      </shadow>
                    </value>
                  </block>
                  <block type="controls_whileUntil"></block>
                  <block type="controls_for">
                    <value name="FROM">
                      <shadow type="math_number">
                        <field name="NUM">1</field>
                      </shadow>
                    </value>
                    <value name="TO">
                      <shadow type="math_number">
                        <field name="NUM">10</field>
                      </shadow>
                    </value>
                    <value name="BY">
                      <shadow type="math_number">
                        <field name="NUM">1</field>
                      </shadow>
                    </value>
                  </block>
                  <!-- <block type="controls_forEach"></block> -->
                  <block type="controls_flow_statements"></block>
                </category>
              </xml>


            </div>
          </div>
        </div>
        <!-- <div class="col-lg-3">
          <div class="card h-100">
            <div class="card-header pb-0">
              <h6>Commands</h6>
            </div>
            <div class="card-body p-3">

            </div>
          </div>
        </div> -->
      </div>

      <button type="button" class="btn btn-outline-primary" onclick="showCode()">Show JavaScript</button>


      <!-- Footer -->
      <?php include "shared_sections/footer.php" ?>
      <!-- End Footer -->

    </div>

  </main>

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

    // Move forward block return
    Blockly.JavaScript['forward'] = function(block) {
      var code = "moveForward()\n";
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
    Blockly.JavaScript['backward'] = function(block) {
      var code = "moveBackward()\n";
      return code;
    };

    var ctx = document.getElementById("chart-bars").getContext("2d");

    new Chart(ctx, {
      type: "bar",
      data: {
        labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
        datasets: [{
          label: "Sales",
          tension: 0.4,
          borderWidth: 0,
          borderRadius: 4,
          borderSkipped: false,
          backgroundColor: "#fff",
          data: [450, 200, 100, 220, 500, 100, 400, 230, 500],
          maxBarThickness: 6
        }, ],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            display: false,
          }
        },
        interaction: {
          intersect: false,
          mode: 'index',
        },
        scales: {
          y: {
            grid: {
              drawBorder: false,
              display: false,
              drawOnChartArea: false,
              drawTicks: false,
            },
            ticks: {
              suggestedMin: 0,
              suggestedMax: 500,
              beginAtZero: true,
              padding: 15,
              font: {
                size: 14,
                family: "Open Sans",
                style: 'normal',
                lineHeight: 2
              },
              color: "#fff"
            },
          },
          x: {
            grid: {
              drawBorder: false,
              display: false,
              drawOnChartArea: false,
              drawTicks: false
            },
            ticks: {
              display: false
            },
          },
        },
      },
    });


    var ctx2 = document.getElementById("chart-line").getContext("2d");

    var gradientStroke1 = ctx2.createLinearGradient(0, 230, 0, 50);

    gradientStroke1.addColorStop(1, 'rgba(203,12,159,0.2)');
    gradientStroke1.addColorStop(0.2, 'rgba(72,72,176,0.0)');
    gradientStroke1.addColorStop(0, 'rgba(203,12,159,0)'); //purple colors

    var gradientStroke2 = ctx2.createLinearGradient(0, 230, 0, 50);

    gradientStroke2.addColorStop(1, 'rgba(20,23,39,0.2)');
    gradientStroke2.addColorStop(0.2, 'rgba(72,72,176,0.0)');
    gradientStroke2.addColorStop(0, 'rgba(20,23,39,0)'); //purple colors

    new Chart(ctx2, {
      type: "line",
      data: {
        labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
        datasets: [{
            label: "Mobile apps",
            tension: 0.4,
            borderWidth: 0,
            pointRadius: 0,
            borderColor: "#cb0c9f",
            borderWidth: 3,
            backgroundColor: gradientStroke1,
            fill: true,
            data: [50, 40, 300, 220, 500, 250, 400, 230, 500],
            maxBarThickness: 6

          },
          {
            label: "Websites",
            tension: 0.4,
            borderWidth: 0,
            pointRadius: 0,
            borderColor: "#3A416F",
            borderWidth: 3,
            backgroundColor: gradientStroke2,
            fill: true,
            data: [30, 90, 40, 140, 290, 290, 340, 230, 400],
            maxBarThickness: 6
          },
        ],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            display: false,
          }
        },
        interaction: {
          intersect: false,
          mode: 'index',
        },
        scales: {
          y: {
            grid: {
              drawBorder: false,
              display: true,
              drawOnChartArea: true,
              drawTicks: false,
              borderDash: [5, 5]
            },
            ticks: {
              display: true,
              padding: 10,
              color: '#b2b9bf',
              font: {
                size: 11,
                family: "Open Sans",
                style: 'normal',
                lineHeight: 2
              },
            }
          },
          x: {
            grid: {
              drawBorder: false,
              display: false,
              drawOnChartArea: false,
              drawTicks: false,
              borderDash: [5, 5]
            },
            ticks: {
              display: true,
              color: '#b2b9bf',
              padding: 20,
              font: {
                size: 11,
                family: "Open Sans",
                style: 'normal',
                lineHeight: 2
              },
            }
          },
        },
      },
    });
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
