<!DOCTYPE html>
<?php



/**
 * Support the htmlinject hook, which allows modules to change header, pre and post body on all pages.
 */
$this->data['htmlinject'] = array(
	'htmlContentPre' => array(),
	'htmlContentPost' => array(),
	'htmlContentHead' => array(),
);


$jquery = array();
if (array_key_exists('jquery', $this->data)) $jquery = $this->data['jquery'];

if (array_key_exists('pageid', $this->data)) {
	$hookinfo = array(
		'pre' => &$this->data['htmlinject']['htmlContentPre'], 
		'post' => &$this->data['htmlinject']['htmlContentPost'], 
		'head' => &$this->data['htmlinject']['htmlContentHead'], 
		'jquery' => &$jquery, 
		'page' => $this->data['pageid']
	);
		
	SimpleSAML_Module::callHooks('htmlinject', $hookinfo);	
}
// - o - o - o - o - o - o - o - o - o - o - o - o -

/**
 * Do not allow to frame simpleSAMLphp pages from another location.
 * This prevents clickjacking attacks in modern browsers.
 *
 * If you don't want any framing at all you can even change this to
 * 'DENY', or comment it out if you actually want to allow foreign
 * sites to put simpleSAMLphp in a frame. The latter is however
 * probably not a good security practice.
 */
header('X-Frame-Options: SAMEORIGIN');

?>
<html lang="en">
<head>
<meta charset="utf-8">
<title><?php
if(array_key_exists('header', $this->data)) {
	echo $this->data['header'];
} else {
	echo 'simpleSAMLphp';
}
?></title>

    <link rel="stylesheet" type="text/css" href="//www.bootstrapcdn.com/bootswatch/2.2.1/cerulean/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="//www.bootstrapcdn.com/twitter-bootstrap/2.2.1/css/bootstrap-responsive.min.css" />
	<link rel="icon" type="image/icon" href="/<?php echo $this->data['baseurlpath']; ?>resources/icons/favicon.ico" />

<?php

if(!empty($jquery)) {
	$version = '1.5';
	if (array_key_exists('version', $jquery))
		$version = $jquery['version'];

	if ($version == '1.5') {
		if (isset($jquery['css']) && $jquery['css'])
			echo('<link rel="stylesheet" media="screen" type="text/css" href="/' . $this->data['baseurlpath'] . 
				'resources/uitheme/jquery-ui-themeroller.css" />' . "\n");	
			
	} else if ($version == '1.6') {
		if (isset($jquery['css']) && $jquery['css'])
			echo('<link rel="stylesheet" media="screen" type="text/css" href="/' . $this->data['baseurlpath'] . 
				'resources/uitheme16/ui.all.css" />' . "\n");	
	}
}

if(!empty($this->data['htmlinject']['htmlContentHead'])) {
	foreach($this->data['htmlinject']['htmlContentHead'] AS $c) {
		echo $c;
	}
}




//if ($this->isLanguageRTL()) {
?>
	<!--link rel="stylesheet" type="text/css" href="/<?php echo $this->data['baseurlpath']; ?>resources/default-rtl.css" /-->
<?php	
//}
?>

	
	<meta name="robots" content="noindex, nofollow" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	

<?php	
if(array_key_exists('head', $this->data)) {
	echo '<!-- head -->' . $this->data['head'] . '<!-- /head -->';
}
?>
</head>
<?php
$onLoad = '';
if(array_key_exists('autofocus', $this->data)) {
	$onLoad .= 'SimpleSAML_focus(\'' . $this->data['autofocus'] . '\');';
}
if (isset($this->data['onLoad'])) {
	$onLoad .= $this->data['onLoad']; 
}

if($onLoad !== '') {
	$onLoad = ' onload="' . $onLoad . '"';
}
?>
<body<?php echo $onLoad; ?>>
<div class="navbar navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container-fluid">
            <button class="btn btn-navbar" data-toggle="collapse">
                <span class="icon-bar"/>
                <span class="icon-bar"/>
                <span class="icon-bar"/>
            </button>
            <a class="brand" href="<?php echo $this->data['baseurlpath'] ?>">SimpleSAMLphp</a>
            <ul class="nav">
        <?php 
        
        $includeLanguageBar = TRUE;
        if (!empty($_POST)) 
            $includeLanguageBar = FALSE;
        if (isset($this->data['hideLanguageBar']) && $this->data['hideLanguageBar'] === TRUE) 
            $includeLanguageBar = FALSE;
        
        if ($includeLanguageBar) {
            
            
            echo '<li id="languagebar" class="dropdown">';
            echo '<a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button">Language<b class="caret"></b></a>';
            echo '<ul class="dropdown-menu" role="menu">';
            $languages = $this->getLanguageList();
            $langnames = array(
                        'no' => 'Bokmål',
                        'nn' => 'Nynorsk',
                        'se' => 'Sámegiella',
                        'sam' => 'Åarjelh-saemien giele',
                        'da' => 'Dansk',
                        'en' => 'English',
                        'de' => 'Deutsch',
                        'sv' => 'Svenska',
                        'fi' => 'Suomeksi',
                        'es' => 'Español',
                        'fr' => 'Français',
                        'it' => 'Italiano',
                        'nl' => 'Nederlands',
                        'lb' => 'Luxembourgish', 
                        'cs' => 'Czech',
                        'sl' => 'Slovenščina', // Slovensk
                        'lt' => 'Lietuvių kalba', // Lithuanian
                        'hr' => 'Hrvatski', // Croatian
                        'hu' => 'Magyar', // Hungarian
                        'pl' => 'Język polski', // Polish
                        'pt' => 'Português', // Portuguese
                        'pt-br' => 'Português brasileiro', // Portuguese
                        'ru' => 'русский язык', // Russian
                        'et' => 'eesti keel',
                        'tr' => 'Türkçe',
                        'el' => 'ελληνικά',
                        'ja' => '日本語',
                        'zh' => '简体中文', // Chinese (simplified)
                        'zh-tw' => '繁體中文', // Chinese (traditional)
                        'ar' => 'العربية', // Arabic
                        'fa' => 'پارسی', // Persian
                        'ur' => 'اردو', // Urdu
                        'he' => 'עִבְרִית', // Hebrew
                        'id' => 'Bahasa Indonesia', // Indonesian
            );
            
            $textarray = array();
            foreach ($languages AS $lang => $current) {
                $lang = strtolower($lang);
                if ($current) {
                    $textarray[] = '<li class="disabled"><a href="#"><strong>' . $langnames[$lang] . '</strong></a></li>';
                } else {
                    $textarray[] = '<li><a href="' . htmlspecialchars(SimpleSAML_Utilities::addURLparameter(SimpleSAML_Utilities::selfURL(), array('language' => $lang))) . '">' .
                        $langnames[$lang] . '</a></li>';
                }
            }
            echo join(' ', $textarray);
            echo '</ul>';
            echo '</div>';

        }
    ?>
            </ul>
        </div>
    </div>
</div>

<div class="container-fluid" style="padding-top: 50px;">

    <header class="page-header">
        <h1>
            <a href="/<?php echo $this->data['baseurlpath']; ?>"><?php
                echo (isset($this->data['header']) ? $this->data['header'] : 'simpleSAMLphp');
            ?></a>
        </h1>
    </header>
<?php
if(!empty($this->data['htmlinject']['htmlContentPre'])) {
	foreach($this->data['htmlinject']['htmlContentPre'] AS $c) {
		echo $c;
	}
}
