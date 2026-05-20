
<?php
// spl_autoload_register(function ($class) {
//     $directories = [
//         __DIR__ . '/app/Controllers/',
//         __DIR__ . '/app/Models/',
//         __DIR__ . '/Config/'
//     ];


//     foreach ($directories as $directory) {
//         $file = $directory . $class . '.php';
// var_dump($file);
//         if (file_exists($file)) {
//             echo 'Exists: ' . $file . "\n";
//             require_once $file;
//             return; 
//         }
// var_dump(debug_backtrace());

//     }
// });

// spl_autoload_register( 'psr4_autoloader' );

// /**
//  * @param string $class The fully-qualified class name.
//  * @return void
//  */
// function psr4_autoloader($class) {

//     $class_path = str_replace('\\', '/', $class);

//     $file =  __DIR__  . $class_path . '.php';

//     // if the file exists, require it
//     if (file_exists($file)) {
//         require $file;
//     }
// }

spl_autoload_register(function ($class) {
    // Map your namespace prefixes to their respective directories
    $directories = [
        'App\\'    => __DIR__ . '/app/',
        'Config\\' => __DIR__ . '/Config/',
        ''
    ];

    foreach ($directories as $directory => $base_dir) {
        $len = strlen($directory);

        // Check if the requested class uses the current namespace prefix
        if (strncmp($directory, $class, $len) === 0) {

            // Get the relative class name (everything after the prefix)
            $relative_class = substr($class, $len);

            // Replace namespace backslashes with directory slashes
            $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

            // If the file exists, require it and exit the loop
            if (file_exists($file)) {
                require $file;
                return;
            }
        }
    }
});
