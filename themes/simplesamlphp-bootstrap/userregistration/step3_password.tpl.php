<?php

$this->data['header'] = $this->t('{userregistration:userregistration:link_newuser}');
$this->data['head'] = '<link rel="stylesheet" href="resources/userregistration.css" type="text/css">';
$this->data['head'] .= '<link rel="stylesheet" href="resources/jquery-simplePassMeter/simplePassMeter.css" type="text/css">';

$this->includeAtTemplateBase('includes/header.php'); ?>

<script type="text/javascript" src="resources/jquery-simplePassMeter/jquery.js"></script>
<script type="text/javascript" src="resources/jquery-simplePassMeter/jquery.simplePassMeter-0.2b.js"></script>



<?php if(isset($this->data['error'])){ ?>
	  <div class="alert alert-error">
	  <?php echo $this->data['error'];
		if ($this->data['refreshtoken']) {
			echo '<form method="POST"><input type="hidden" name="email" value="'.$this->data['email'].'"><input type="submit" name="refreshtoken" value="'.$this->t('get_token').'"></form>';
		}
	  ?>
	  </div>
<?php }?>

<?php
if(isset($this->data['passwordPolicy'])) {
	include_once($this->data['passwordPolicytpl']);
}
?>

<?php print $this->data['formHtml']; ?>

<?php $this->includeAtTemplateBase('includes/footer.php'); ?>
