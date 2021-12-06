'use strict';

let workspace = null;

function start() {
  // Create main workspace.
  workspace = Blockly.inject('blocklyDiv',
      {
        toolbox: document.getElementById('toolbox-categories'),
      });
}

function showCode() {
    // Generate JavaScript code and display it.
    Blockly.JavaScript.INFINITE_LOOP_TRAP = null;
    var code = Blockly.JavaScript.workspaceToCode(workspace);

    if (code){
      document.getElementById("showCode").innerHTML = code;
    }
  }

function runCode() {
  // Generate JavaScript code and run it.
  window.LoopTrap = 1000;
  Blockly.JavaScript.INFINITE_LOOP_TRAP =
      'if (--window.LoopTrap == 0) throw "Infinite loop.";\n';
  var code = Blockly.JavaScript.workspaceToCode(workspace);
  Blockly.JavaScript.INFINITE_LOOP_TRAP = null;
  try {
    eval(code);
  } catch (e) {
    alert(e);
  }
}

function moveUp(){
  update_moves();
  move_car_up();
}

function moveLeft(){
  update_moves();
  move_car_left();
}

function moveRight(){
  update_moves();
  move_car_right();
}

function moveDown(){
  update_moves();
  move_car_down();
}

Blockly.Blocks['up'] = {
  init: function() {
    this.appendValueInput("VALUE").setCheck("String").appendField("Move Up");
    this.setPreviousStatement(true, null);
    this.setNextStatement(true, null);
    this.setColour(255);
 this.setTooltip("Moves the car up");
 this.setHelpUrl("");
  }
};

Blockly.Blocks['left'] = {
  init: function() {
    this.appendValueInput("VALUE").setCheck("String").appendField("Move Left");
    this.setPreviousStatement(true, null);
    this.setNextStatement(true, null);
    this.setColour(255);
 this.setTooltip("Moves the car left");
 this.setHelpUrl("");
  }
};

Blockly.Blocks['right'] = {
  init: function() {
    this.appendValueInput("VALUE").setCheck("String").appendField("Move Right");
    this.setPreviousStatement(true, null);
    this.setNextStatement(true, null);
    this.setColour(255);
 this.setTooltip("Moves the car right");
 this.setHelpUrl("");
  }
};

Blockly.Blocks['down'] = {
  init: function() {
    this.appendValueInput("VALUE").setCheck("String").appendField("Move Down");
    this.setPreviousStatement(true, null);
    this.setNextStatement(true, null);
    this.setColour(255);
 this.setTooltip("Moves the car down");
 this.setHelpUrl("");
  }
};
