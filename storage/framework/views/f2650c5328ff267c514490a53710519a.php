<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Certificate</title>
</head>
<body>
    <h2><?php echo e($subject); ?></h2>
    <p>Dear <?php echo e($employee->name); ?>,</p>

    <p><?php echo $content; ?></p>

    <p>Best regards,<br><strong><?php echo e($hrName); ?></strong></p>
</body>
</html>
<?php /**PATH C:\Users\Ajeet Kumar Das\Downloads\Laravel-Project\Laravel-Project\hrsoft\resources\views\emails\certificate.blade.php ENDPATH**/ ?>