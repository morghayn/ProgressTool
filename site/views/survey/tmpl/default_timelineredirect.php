<?php defined('_JEXEC') or die; ?>

<p class="abstract">
    <b>Timeline Redirects</b><br>The three links below are redirects to your current position on the <a href="/timeline">ECCO timeline</a> for the
    given categories<b class="people">People</b>, <b class="technology">Technology</b> and <b class="finance">Finance</b>.
</p>

<div class="buttonChest">
    <?php foreach ($this->categories as $category): ?>
        <?php $onclick = "timelineRedirect($category->id, $this->projectID, $this->countryID)"; ?>
        <button onclick="<?php echo $onclick; ?>" style="background-color: <?php echo $category->colour_hex; ?>;">
            <?php echo $category->category; ?>
        </button>
    <?php endforeach; ?>
</div>