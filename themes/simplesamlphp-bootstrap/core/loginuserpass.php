<?php
$this->data['header'] = $this->t('{login:user_pass_header}');

if (strlen($this->data['username']) > 0) {
	$this->data['autofocus'] = 'password';
} else {
	$this->data['autofocus'] = 'username';
}
$this->includeAtTemplateBase('includes/header.php');

?>


<div class="row">
    <div class="span10 offset2">
        <h2><?php echo $this->t('{login:user_pass_header}'); ?></h2>
        <p><?php echo $this->t('{login:user_pass_text}'); ?></p>
        <?php if ($this->data['errorcode'] !== NULL) { ?>
        <div class="alert alert-block alert-error">
            <h4 class="alert-heading">
                <img src="/<?php echo $this->data['baseurlpath']; ?>resources/icons/experience/gtk-dialog-error.48x48.png" class="visible-desktop" />
                <?php echo $this->t('{login:error_header}'); ?>
                <small><?php echo $this->t('{errors:title_' . $this->data['errorcode'] . '}'); ?></small>
            </h4>
            <p><?php echo $this->t('{errors:descr_' . $this->data['errorcode'] . '}'); ?></p>
        </div>
        <?php } ?>
    </div>
</div>

<div class="row">
    <div class="span2">
        <img src="/<?php echo $this->data['baseurlpath']; ?>resources/icons/experience/gtk-dialog-authentication.48x48.png" alt="" class="hidden-phone" />
    </div>

    <div class="span10">

        <form action="?" method="post" name="f" class="well form-horizontal">
            <div class="control-group">
                <label for="username" class="control-label"><?php echo $this->t('{login:username}'); ?></label>
                <div class="controls">
                    <div class="input-prepend">
                        <span class="add-on"><i class="icon-user"></i></span>
                    <?php
                        if ($this->data['forceUsername']) {
                            echo '<span class="input-large uneditable-input">' . htmlspecialchars($this->data['username']) . '</span>';
                        } else {
                            echo '<input type="text" id="username" tabindex="1" name="username" value="' . htmlspecialchars($this->data['username']) . '" class="input-large" />';
                        }
                    ?>
                    </div>
                </div>
            </div>

            <div class="control-group">
                <label for="password" class="control-label"><?php echo $this->t('{login:password}'); ?></label>
                <div class="controls">
                    <div class="input-prepend">
                        <span class="add-on"><i class="icon-lock"></i></span>
                        <input id="password" type="password" tabindex="2" name="password" class="input-large" />
                    </div>
                </div>
            </div>
            <?php if (array_key_exists('organizations', $this->data)) { ?>
            <div class="control-group">
                <label for="organization" class="control-label"><?php echo $this->t('{login:organization}'); ?></label>
                <div class="controls">
                    <div class="input-prepend">
                        <span class="add-on"><i class="icon-globe"></i></span>
                        <select name="organization" tabindex="3">
                        <?php
                            $selectedOrg = NULL;
                            if (array_key_exists('selectedOrg', $this->data))
                                $selectedOrg = $this->data['selectedOrg'];
                            foreach ($this->data['organizations'] as $orgId => $orgDesc) {
                                if (is_array($orgDesc)) {
                                    $orgDesc = $this->t($orgDesc);
                                }

                                if ($orgId === $selectedOrg) {
                                    $selected = 'selected="selected" ';
                                } else {
                                    $selected = '';
                                }

                                echo '<option ' . $selected . 'value="' . htmlspecialchars($orgId) . '">' . htmlspecialchars($orgDesc) . '</option>';
                            }
                        ?>
                        </select>
                    </div>
                </div>
            </div>
            <?php } ?>
            <?php foreach ($this->data['stateparams'] as $name => $value) {
                echo('<input type="hidden" name="' . htmlspecialchars($name) . '" value="' . htmlspecialchars($value) . '" />');
            }
            ?>
            <div class="form-actions">
                <button type="submit" tabindex="4" class="btn btn-primary">
                    <i class="icon-off icon-white"></i>
                    <?php echo $this->t('{login:login_button}'); ?>
                </button>
                    <a href="/module.php/userregistration/lostPassword.php" class="btn">
                    <i class="icon icon-refresh"></i>
                    <?php echo $this->t('{userregistration:userregistration:link_lostpw}'); ?>
                </a>
            </div>
        </form>
    </div>
</div>

<?php

if(!empty($this->data['links'])) {
	echo '<ul class="links" style="margin-top: 2em">';
	foreach($this->data['links'] AS $l) {
		echo '<li><a href="' . htmlspecialchars($l['href']) . '">' . htmlspecialchars($this->t($l['text'])) . '</a></li>';
	}
	echo '</ul>';
}
?>

<div class="row">
    <div class="span10 offset2">
    <?php
        echo('<h2>' . $this->t('{login:help_header}') . '</h2>');
        echo('<p>' . $this->t('{login:help_text}') . '</p>');
    ?>
    </div>
</div>

<?php $this->includeAtTemplateBase('includes/footer.php'); ?>
