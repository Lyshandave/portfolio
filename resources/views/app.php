<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Premium Fonts & Icons -->
    <script>
        window.addEventListener('error', function(e) {
            var container = document.getElementById('error-overlay');
            if (!container) {
                container = document.createElement('div');
                container.id = 'error-overlay';
                container.style.position = 'fixed';
                container.style.top = '0';
                container.style.left = '0';
                container.style.width = '100vw';
                container.style.height = '100vh';
                container.style.backgroundColor = '#fff';
                container.style.color = '#ff0000';
                container.style.padding = '20px';
                container.style.zIndex = '999999';
                container.style.overflow = 'auto';
                container.style.fontFamily = 'monospace';
                container.style.fontSize = '14px';
                document.body.appendChild(container);
            }
            container.innerHTML += '<h2>JS Crash Captured:</h2><pre>' + e.message + '\n at ' + e.filename + ':' + e.lineno + ':' + e.colno + '\n\n' + (e.error ? e.error.stack : '') + '</pre><hr>';
        });
    </script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css?family=Instrument+Sans:400,500,600,700|Space+Grotesk:500,700" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

    <!-- Initial Theme Setup script to prevent light-to-dark flash on load -->
    <script>
        if (localStorage.getItem('color-theme') === 'dark' ||
            (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>

    <?php echo app(\Illuminate\Foundation\Vite::class)->reactRefresh(); ?>
    <?php echo app(\Illuminate\Foundation\Vite::class)(['resources/css/app.css', 'resources/js/app.jsx']); ?>
</head>
<body class="preload bg-light-bg text-light-text dark:bg-dark-bg dark:text-dark-text min-h-screen transition-colors duration-300 relative w-full selection:bg-indigo-500 selection:text-white">
    <!-- Remove preload class when page has loaded to re-enable transitions -->
    <script>
        window.addEventListener('load', function() {
            document.body.classList.remove('preload');
        });
    </script>

    <div id="app"></div>
    <script type="application/json" data-page="app"><?php echo json_encode($page ?? (object)[]); ?></script>
</body>
</html>
