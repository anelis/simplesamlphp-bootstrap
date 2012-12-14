<?php
/**
 * Template to show list of configured authentication sources.
 *
 */
$this->data['header'] = 'Test authentication sources';

$this->includeAtTemplateBase('includes/header.php');
?>
<header class="page-header">
    <h1><?php echo $this->data['header']; ?></h1>
</header>
<ul class="nav nav-tabs nav-stacked">
<?php
foreach ($this->data['sources'] as $id) {
	echo '<li><a href="?as=' . htmlspecialchars(urlencode($id)) . '">' . htmlspecialchars($id) . '</a></li>';
}
?>
</ul>

<?php
$this->includeAtTemplateBase('includes/footer.php');
?>
