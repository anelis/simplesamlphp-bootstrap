<?php 



$this->includeAtTemplateBase('includes/header.php'); 
	

echo('<pre>');

echo(htmlspecialchars(var_export($this->data['m'])));

echo('</pre>');

echo('<p>[ <a href="' . $this->data['backlink'] . '"> back </a> ]</p>');


$this->includeAtTemplateBase('includes/footer.php'); 

