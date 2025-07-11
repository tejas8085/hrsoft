<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>HR Portal</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Always Load CSS -->
    <style>
        body {
            font-family: 'Instrument Sans', sans-serif;
            background-color: #FDFDFC;
            color: #1b1b18;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 2rem 1rem;
        }

        header {
            width: 100%;
            max-width: 1024px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        nav a {
            padding: 0.5rem 1rem;
            text-decoration: none;
            color: #1b1b18;
            border-radius: 4px;
            transition: background 0.3s;
        }

        nav a:hover {
            background-color: #f1f1f1;
        }

        .logo-img {
            height: 48px;
        }
    </style>
</head>

<body>
    <header>
        <a href="<?php echo e(url('/')); ?>">
            <img src="<?php echo e(asset('images/image.png')); ?>" alt="Logo" class="logo-img">
        </a>

        <?php if(Route::has('login')): ?>
            <nav>
                <?php if(auth()->guard()->check()): ?>
                    <a href="<?php echo e(url('/dashboard')); ?>">Dashboard</a>
                <?php else: ?>
                    <a href="<?php echo e(route('login')); ?>">Log in</a>
                    <?php if(Route::has('register')): ?>
                        <!-- <a href="<?php echo e(route('register')); ?>">Register</a> -->
                    <?php endif; ?>
                <?php endif; ?>
            </nav>
        <?php endif; ?>
    </header>

    <main>
        <?php echo $__env->yieldContent('content'); ?>
    </main>
</body>
</html>
<?php /**PATH C:\Users\Ajeet Kumar Das\Downloads\Laravel-Project\Laravel-Project\hrsoft\resources\views\welcome.blade.php ENDPATH**/ ?>