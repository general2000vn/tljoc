<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <title>
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

   
    <?= $this->fetch('meta') ?>
    <?= $this->fetch('head_css') ?>
    <?= $this->fetch('head_scripts') ?>
</head>
<body>
    <div class="container">
        <div clas="row">
            
        </div>
        <?= $this->Flash->render() ?>
        <?= $this->fetch('content') ?>
       
    </div>
    <?= $this->fetch('bottom_scripts') ?>
</body>
</html>
