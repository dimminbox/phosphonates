<div class="form">
    <?php echo UserModule::t("Welcome");
            if (isset($model->profile))
                    echo ' <b>'.CHtml::encode($model->profile->firstname.' '.$model->profile->lastname).'</b>'; ?>
    <ul>
        <li><?php echo CHtml::link(UserModule::t('Profile'),array('profile/')); ?></li>
        <li><?php echo CHtml::link(UserModule::t('Edit profile'),array('profile/edit')); ?></li>
        <li><?php echo CHtml::link(UserModule::t('Change password'),array('profile/changepassword')); ?></li>
        <li><?php echo CHtml::link(UserModule::t('Logout'),array('/user/logout')); ?></li>
    </ul>
</div>

