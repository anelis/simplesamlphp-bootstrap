<?php

$this->data['header'] = $this->t('{core:frontpage:page_title}');
$this->includeAtTemplateBase('includes/header.php');

?>


<!-- 
<div id="tabdiv">
<ul>
	<li><a href="#welcome"><?php echo $this->t('{core:frontpage:welcome}'); ?></a></li>
	<li><a href="#configuration"><?php echo $this->t('{core:frontpage:configuration}'); ?></a></li>
	<li><a href="#metadata"><?php echo $this->t('{core:frontpage:metadata}'); ?></a></li>
</ul> -->
<?php
if ($this->data['isadmin']) {
	echo '<p class="float-r">' . $this->t('{core:frontpage:loggedin_as_admin}') . '</p>';
} else {
	echo '<p class="float-r"><a href="' . $this->data['loginurl'] . '">' . $this->t('{core:frontpage:login_as_admin}') . '</a></p>';
}
?>

<div class="row-fluid">
    <div class="span6">
        <code><?php 
            echo $this->data['directory'] . ' (' . $this->data['version'] . ')'; 
        ?></code>
    </div>

    <div class="span6">
        <table class="table table-striped">
            <?php
                $icon_enabled  = '<img src="/' . $this->data['baseurlpath'] . 'resources/icons/silk/accept.png" alt="enabled" />';
                $icon_disabled = '<img src="/' . $this->data['baseurlpath'] . 'resources/icons/silk/delete.png" alt="disabled" />';
                $has_saml20 = $this->data['enablematrix']['saml20-idp'];
                $has_shib13 = $this->data['enablematrix']['shib13-idp'];
            ?>
            <tr class="<?php echo $has_saml20 ? 'success' : 'muted'; ?>">
                <td>SAML 2.0 IdP</td>
                <td><?php echo $has_saml20 ? $icon_enabled : $icon_disabled; ?></td>
            </tr>
			
            <tr class="<?php echo $has_shib13 ? 'success' : 'muted'; ?>">
                <td>Shib 1.3 IdP</td>
                <td><?php echo $has_shib13 ? $icon_enabled : $icon_disabled; ?></td>
            </tr>
        </table>
    </div>
</div>

<div class="row-fluid">
    <div class="span6">
        <div class="well">
            <ul class="nav nav-list">
                <li class="nav-header"><?php echo $this->t('{core:frontpage:configuration}'); ?></li>
            <?php
                foreach ($this->data['links_config'] AS $link) {
                    echo '<li><a href="' . htmlspecialchars($link['href']) . '">' . $this->t($link['text']) . '</a></li>';
                }
            ?>
            </ul>
        </div>
    </div>

    <div class="span6">
    <?php
        if (array_key_exists('warnings', $this->data) && is_array($this->data['warnings']) && !empty($this->data['warnings'])) {
            echo '<h2>' . $this->t('{core:frontpage:warnings}') . '</h2>';

            foreach($this->data['warnings'] AS $warning) {
                echo '<div class="alert">' . $this->t($warning) . '</div>';
            }
        }
    ?>
    </div>
</div>

<div class="row-fluid">
    <div class="span12">
    <?php 
    if ($this->data['isadmin']) {

        echo '<h2>'. $this->t('{core:frontpage:checkphp}') . '</h2>';
        echo '<div class="enablebox"><table class="table table-striped">';
        
        
        $icon_enabled  = '<img src="/' . $this->data['baseurlpath'] . 'resources/icons/silk/accept.png" alt="enabled" />';
        $icon_disabled = '<img src="/' . $this->data['baseurlpath'] . 'resources/icons/silk/delete.png" alt="disabled" />';
        
        
        foreach ($this->data['funcmatrix'] AS $func) {
            echo '<tr class="' . ($func['enabled'] ? 'success' : 'error') . '"><td>' . ($func['enabled'] ? $icon_enabled : $icon_disabled) . '</td>
            <td>' . $this->t('{core:frontpage:' . $func['required']. '}') . '</td><td>' . $func['descr'] . '</td></tr>';
        }
        echo('</table></div>');
    }
    ?>
    </div>
</div>
	
	

		
<?php $this->includeAtTemplateBase('includes/footer.php'); ?>
