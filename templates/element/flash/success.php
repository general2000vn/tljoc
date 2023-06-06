<?php

/**
 * @var \App\View\AppView $this
 * @var array $params
 * @var string $message
 */
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
?>

<div class="alert alert-success text-center" role="alert">
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-hidden="true">×</button>
    <i class="fa fa-check-circle-o me-2" aria-hidden="true"></i> <?= $message ?>
</div>