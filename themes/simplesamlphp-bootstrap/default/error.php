<?php 
	$this->data['header'] = $this->t($this->data['dictTitle']);
	
	$this->data['head'] = '
<meta name="robots" content="noindex, nofollow" />
<meta name="googlebot" content="noarchive, nofollow" />';
	
	$this->includeAtTemplateBase('includes/header.php'); 
?>


<div class="alert alert-error">
	<h4 class="alert-heading"><?php echo $this->t($this->data['dictTitle']); ?></h4>
<?php
echo htmlspecialchars($this->t($this->data['dictDescr'], $this->data['parameters']));

/* Include optional information for error. */
if (isset($this->data['includeTemplate'])) {
	$this->includeAtTemplateBase($this->data['includeTemplate']);
}
?>
</div>

	<div class="trackidtext">
		<?php echo $this->t('report_trackid'); ?>
		<code><?php echo $this->data['error']['trackId']; ?></code>
	</div>
		

<?php
/* Print out exception only if the exception is available. */
if ($this->data['showerrors']) {
?>
<h2 class="alert-header"><?php echo $this->t('debuginfo_header'); ?></h2>
<p><?php echo $this->t('debuginfo_text'); ?></p>
<div class="well">
		
        <p><?php echo htmlspecialchars($this->data['error']['exceptionMsg']); ?></p>
        <pre><?php echo htmlspecialchars($this->data['error']['exceptionTrace']); ?></pre>
</div>
<?php
}
?>
    <div class="row-fluid">

<?php
    /* Add error report submit section if we have a valid technical contact. 'errorreportaddress' will only be set if
     * the technical contact email address has been set.
     */
    if (isset($this->data['errorReportAddress'])) {
?>
    <div class="span6">
        <h2><?php echo $this->t('report_header'); ?></h2>
        <p><?php echo $this->t('report_text'); ?></p>
        <form action="<?php echo htmlspecialchars($this->data['errorReportAddress']); ?>" method="post">
        
            <label for="email"><?php echo $this->t('report_email'); ?></label>
            <input type="text" size="25" name="email" id="email" value="<?php echo htmlspecialchars($this->data['email']); ?>" />
            <br />
            <textarea name="text" rows="6" cols="43"><?php echo $this->t('report_explain'); ?></textarea>
            <br />
            <input type="hidden" name="reportId" value="<?php echo $this->data['error']['reportId']; ?>" />
            <button type="submit" name="send" class="btn btn-primary">
                <i class="icon-white icon-envelope"></i>
                <?php echo $this->t('report_submit'); ?>
            </button>
        </form>
    </div>
<?php } ?>
    <div class="span6">
        <h2><?php echo $this->t('howto_header'); ?></h2>
        <p><?php echo $this->t('howto_text'); ?></p>
    </div>
</div>

<?php $this->includeAtTemplateBase('includes/footer.php'); ?>
