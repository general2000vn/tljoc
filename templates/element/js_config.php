<?php
    use Cake\Core\Configure;

    $fullBaseUrl = Configure::read('App.fullBaseUrl') . Configure::read('App.base') . DS;
?>

<script type="text/javascript">
    var fullBaseUrl = "<?= $fullBaseUrl ?>";
</script>