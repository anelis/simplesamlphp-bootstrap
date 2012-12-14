<?php

$this->data['header'] = $this->t('{userregistration:userregistration:link_panel}');
//$this->data['head'] = '<link rel="stylesheet" href="resources/userregistration.css" type="text/css">';

$this->includeAtTemplateBase('includes/header.php');

if(isset($this->data['userMessage'])){ ?>
	<div class="alert alert-info"><?php echo $this->t($this->data['userMessage']); ?></div>
<?php }?>

<h2><?php echo $this->t('{userregistration:userregistration:link_panel}') ?></h2> 

<ul class="nav nav-tabs nav-stacked">
<?php
	foreach ($this->data['links'] AS $link) {
		echo '<li><a href="' . htmlspecialchars($link['href']) . '">' . $this->t($link['text']) . '</a>';
		if(isset($link['extra_text'])) {
			echo $link['extra_text'];
		}
		echo '</li>';
	}
?>
</ul>

<?php
$this->includeAtTemplateBase('includes/footer.php');
?>
