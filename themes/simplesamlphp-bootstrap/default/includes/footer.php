<?php

if(!empty($this->data['htmlinject']['htmlContentPost'])) {
	foreach($this->data['htmlinject']['htmlContentPost'] AS $c) {
		echo $c;
	}
}
?>

<footer class="foot">
<img src="/<?php echo $this->data['baseurlpath']; ?>resources/icons/ssplogo-fish-small.png" alt="Small fish logo" style="float: right" />		
Copyright &copy; 2007-2010 <a href="http://rnd.feide.no/">Feide RnD</a>
&emdash; <a href="https://twitter.github.com/bootstrap">Twitter Boostrap Theme</a> integration by
<a href="http://anelis.org/">Anelis</a>.
</footer>
</div><!-- /container-fluid -->
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js"></script>
<?php
if (!empty($jquery)) {
    $version = '1.7';
    if (array_key_exists('version', $jquery))
        $version = $jquery['version'];

    if (isset($jquery['core']) && $jquery['core'])
        echo ('<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/' .  $version . '/jquery.min.js></script>');

    if (isset($jquer['ui']) && $jquery['ui'])
        echo ('<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/' .  $version . '/jquery-ui.min.js></script>');
}
?>
<script type="text/javascript" src="/<?php echo $this->data['baseurlpath']; ?>resources/script.js"></script>
<script type="text/javascript" src="//www.bootstrapcdn.com/twitter-bootstrap/2.2.1/js/bootstrap.min.js"></script>
</body>
</html>
