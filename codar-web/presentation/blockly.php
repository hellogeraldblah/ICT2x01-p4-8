<xml id="toolbox-categories" style="display: none">

  <!-- Control Category -->
  <category name="Movement" categorystyle="list_category">
    <block type="up"></block>
    <block type="left"></block>
    <block type="right"></block>
    <block type="down"></block>
  </category>

  <!-- Logic Category -->
  <category name="Logic" categorystyle="logic_category">
    <block type="controls_if"></block>
    <block type="logic_compare"></block>
    <block type="logic_operation"></block>
    <block type="logic_negate"></block>
    <block type="logic_boolean"></block>
    <block type="logic_null"></block>
    <block type="logic_ternary"></block>
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
    <block type="controls_forEach"></block>
    <block type="controls_flow_statements"></block>
  </category>

  <!-- Math Category -->
  <category name="Math" colour="%{BKY_MATH_HUE}">
    <block type="math_number">
      <field name="NUM">123</field>
    </block>
    <block type="math_arithmetic"></block>
    <block type="math_single"></block>
    <block type="math_trig"></block>
    <block type="math_constant"></block>
    <block type="math_number_property"></block>
    <block type="math_round"></block>
    <block type="math_on_list"></block>
    <block type="math_modulo"></block>
    <block type="math_constrain">
      <value name="LOW">
        <block type="math_number">
          <field name="NUM">1</field>
        </block>
      </value>
      <value name="HIGH">
        <block type="math_number">
          <field name="NUM">100</field>
        </block>
      </value>
    </block>
    <block type="math_random_int">
      <value name="FROM">
        <block type="math_number">
          <field name="NUM">1</field>
        </block>
      </value>
      <value name="TO">
        <block type="math_number">
          <field name="NUM">100</field>
        </block>
      </value>
    </block>
    <block type="math_random_float"></block>
    <block type="math_atan2"></block>
  </category>


  <category name="Lists" colour="%{BKY_LISTS_HUE}">
    <block type="lists_create_empty"></block>
    <block type="lists_create_with"></block>
    <block type="lists_repeat">
      <value name="NUM">
        <block type="math_number">
          <field name="NUM">5</field>
        </block>
      </value>
    </block>
    <block type="lists_length"></block>
    <block type="lists_isEmpty"></block>
    <block type="lists_indexOf"></block>
    <block type="lists_getIndex"></block>
    <block type="lists_setIndex"></block>
  </category>

  <category name="Variables" colour="330" custom="VARIABLE"></category>


</xml>
