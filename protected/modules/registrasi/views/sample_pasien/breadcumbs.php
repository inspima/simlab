<ol class="breadcrumb">
    <li><a href="<?php echo Yii::app()->createUrl('/    '); ?>">Home</a> / </li>
    <li><a href="<?php echo Yii::app()->createUrl($this->module->getName() . '/'); ?>"><?php echo ucfirst($this->module->getName()); ?></a> / </li>
    <li class="active"><?php echo ucfirst(Yii::app()->controller->id) ?></li>
</ol>