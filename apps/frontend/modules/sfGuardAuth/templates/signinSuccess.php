<?php use_stylesheet('signin') ?>

<div class="restricted">
    <p class="warn">L'acces à cette zone est protégé</p>
    <p class="help">Identifiez-vous pour continuer</p>
</div>	

<form class="signin" action="<?php echo url_for('sf_guard_signin') ?>" method="post">

    <?php echo $form->renderHiddenFields() ?>
    <?php echo $form->renderGlobalErrors() ?>

    <div class="fields">
        <fieldset>
            <?php echo $form['username']->renderLabel() ?>
            <?php echo $form['username']->renderError() ?>
            <?php echo $form['username'] ?>
        </fieldset>

        <fieldset>
            <?php echo $form['password']->renderLabel() ?>
            <?php echo $form['password']->renderError() ?>
            <?php echo $form['password'] ?>
        </fieldset>
    </div>

    <input class="submit" type="submit" value="login"/>
</form>


