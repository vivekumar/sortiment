<tr>
<td class="header">
<a href="<?php echo e($url); ?>" style="display: inline-block;">
<?php if(trim($slot) === 'Laravel'): ?>

<img src="<?php echo e($message->embed('public/frontend/mail/img/sortiment-logo.png')); ?>" width="150" alt="logo">
<?php else: ?>
<?php echo e($slot); ?>

<?php endif; ?>
</a>
</td>
</tr>


<?php /**PATH /var/www/html/laravel/sortiment/resources/views/vendor/mail/html/header.blade.php ENDPATH**/ ?>