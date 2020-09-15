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

<p class="introductionParagraph">
    <b>Timeline Redirects</b><br>
    The three links below are redirects to your current position on the <a href="/timeline">ECCO timeline</a> for the given categories
    <b class="people">People</b>, <b class="technology">Technology</b> and <b class="finance">Finance</b>.
</p>

<div class="buttonChest">
    <?php foreach ($this->categories as $category): ?>
        <?php $onclick = "timelineRedirect($category->id, $this->projectID, $this->countryID)"; ?>
        <button onclick="<?php echo $onclick; ?>" style="background-color: <?php echo $category->colour_hex; ?>;">
            <?php echo $category->category; ?>
        </button>
    <?php endforeach; ?>
</div>

