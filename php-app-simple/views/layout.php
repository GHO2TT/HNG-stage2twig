<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title ?? 'TicketApp'; ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        html {
            scroll-behavior: smooth;
        }
        
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", "Roboto", "Oxygen", "Ubuntu", "Cantarell", "Fira Sans", "Droid Sans", "Helvetica Neue", sans-serif;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }
        
        .toast {
            position: fixed;
            bottom: 20px;
            right: 20px;
            padding: 16px 24px;
            border-radius: 8px;
            color: white;
            font-weight: 500;
            z-index: 9999;
            animation: slideIn 0.3s ease-out;
        }
        
        .toast-success {
            background-color: #10b981;
        }
        
        .toast-error {
            background-color: #ef4444;
        }
        
        @keyframes slideIn {
            from {
                transform: translateX(400px);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }
    </style>
</head>
<body>
    <?php include __DIR__ . '/components/navbar.php'; ?>
    
    <?php echo $content; ?>
    
    <?php if (isset($_SESSION['success'])): ?>
        <div class="toast toast-success"><?php echo e($_SESSION['success']); ?></div>
        <script>
            setTimeout(() => {
                document.querySelector('.toast').remove();
            }, 3000);
        </script>
        <?php unset($_SESSION['success']); ?>
    <?php endif; ?>
    
    <?php if (isset($_SESSION['error'])): ?>
        <div class="toast toast-error"><?php echo e($_SESSION['error']); ?></div>
        <script>
            setTimeout(() => {
                document.querySelector('.toast').remove();
            }, 3000);
        </script>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>
</body>
</html>
