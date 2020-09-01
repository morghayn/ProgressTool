<?php defined('_JEXEC') or die; ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
<input id="token" type="hidden" name="<?php echo JSession::getFormToken(); ?>" value="1"/>

<div class="buttonChest">
    <button class="buttonProjectBoard" onclick="redirectProjectBoard()">Project Board</button>
    <button onclick="showColumns()">Task List</button>
    <button onclick="showGraphs()">Graphs</button>
</div>

<div id="graphs" style="display: none;">
    <?php echo $this->loadTemplate('graphs'); ?>
</div>

<div id="columns">
    <?php echo $this->loadTemplate('columns'); ?>
</div>