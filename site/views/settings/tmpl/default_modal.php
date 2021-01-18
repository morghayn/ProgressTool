<?php defined('_JEXEC') or die; ?>

<div id="pdModal" class="pdModal">
    <div class="content">
        <div class="heading">
            <h1>Deactivate Project</h1>
            <span id="closeModal">&times;</span>
        </div>

        <form action="<?php echo JRoute::_('index.php?option=com_progresstool&view=settings&task=project.deactivate'); ?>"
              method="post" class="projectForm deactivationForm" enctype="multipart/form-data">

            <div class="form-horizontal">
                <fieldset>
                    <input type="hidden" name="projectID" id="projectID" value="<?php echo $this->project['id']; ?>">
                    <p>Type in <b><?php echo $this->project['name']; ?></b> to confirm project deactivation.</p>
                    <div class="control-group">
                        <div class="control-label">
                            <label id="jform_confirmation-lbl" for="jform_confirmation" class="hasPopover required" title=""
                                   data-content="Type in your project name to confirm deactivation."
                                   data-original-title="Confirmation">Confirmation<span class="star">&nbsp;*</span></label>
                        </div>
                        <div class="controls">
                            <input type="text" name="jform[confirmation]" id="jform_confirmation" value="" class="textField required"
                                   placeholder="Confirmation" maxlength="100" required="" aria-required="true">
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="control-label">
                            <label id="jform_deactivation_reason-lbl"
                                   for="jform_deactivation_reason"
                                   class="hasPopover required"
                                   title=""
                                   data-content="Your deactivation reason can be 255 characters long."
                                   data-original-title="Reason">Reason<span class="star">&nbsp;*</span></label>
                        </div>
                        <div class="controls">
                    <textarea name="jform[deactivation_reason]" id="jform_deactivation_reason" cols="80" rows="4" class="required"
                              placeholder="Deactivation Reason" required="" aria-required="true" maxlength="255"></textarea>
                        </div>
                    </div>
                    <button type="button" class="dangerButton" onclick="Joomla.submitbutton('deactivate.deactivate')">
                        Deactivate this project
                    </button>
                </fieldset>
            </div>

            <input type="hidden" name="task">
            <input type="hidden" name="b9f6229090b48659fe07d4a68b792fec" value="1">
        </form>
    </div>
</div>