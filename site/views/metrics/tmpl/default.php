<?php defined('_JEXEC') or die; ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"
        integrity="sha512-d9xgZrVZpmmQlfonhQUvTR7lMPtO7NkZMkA0ABN3PHCbKA5nqylQ/yWlFAyY6hYgdF1Qh6nYiuADWwKB4C2WSw=="
        crossorigin="anonymous"></script>

<input id="token"
       type="hidden"
       name="<?php echo JSession::getFormToken(); ?>"
       value="1"/>

<div class="buttonChest">
    <button class="projectBoard" onclick="redirectProjectBoard()">Project Board</button>
    <button onclick="showColumns()">Task List</button>
    <button onclick="showGraphs()">Graphs</button>
</div>

<?php echo $this->loadTemplate('abstracts'); ?>
<?php echo $this->loadTemplate('graphs'); ?>
<?php echo $this->loadTemplate('columns'); ?>
<?php echo $this->loadTemplate('timelineredirects'); ?>
