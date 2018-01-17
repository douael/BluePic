<div class="alert <?php echo $type; ?>">
    <i class="fa
    <?php if ($type == "warning"): ?>
    fa-exclamation-circle
    <?php elseif ($type == "success"): ?>
    fa-check-circle
    <?php elseif ($type == "info"): ?>
    fa-info-circle
    <?php elseif ($type == "danger"): ?>
    fa-times-circle
    <?php endif; ?>
" aria-hidden="true"></i>
    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
    <?php echo $text; ?>
</div>