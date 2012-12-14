<?php 
$this->data['header'] = $this->t('{core:frontpage:page_title}');
$this->includeAtTemplateBase('includes/header.php'); 
?>


<?php
if ($this->data['isadmin']) {
	echo '<p class="float-r">' . $this->t('{core:frontpage:loggedin_as_admin}') . '</p>';
} else {
	echo '<p class="float-r"><a href="' . $this->data['loginurl'] . '">' . $this->t('{core:frontpage:login_as_admin}') . '</a></p>';
}
?>
<div class="row">
<div class="span6">
<p><?php echo $this->t('{core:frontpage:intro}'); ?></p>
</div>
<div class="span6">
<ul class="nav nav-tabs nav-stacked">
<?php
	foreach ($this->data['links_welcome'] AS $link) {
		echo '<li><a href="' . htmlspecialchars($link['href']) . '">' . $this->t($link['text']) . '</a></li>';
	}
?>
</ul>
</div>
</div>

<section>
    <header class="page-header">
        <h2><?php echo $this->t('{core:frontpage:about_header}'); ?></h2>
    </header>

<div class="row">
    <p><?php echo $this->t('{core:frontpage:about_text}'); ?></p>
</div>
</section>
		
<?php $this->includeAtTemplateBase('includes/footer.php'); ?>
