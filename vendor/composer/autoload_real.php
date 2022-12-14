<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInitbd68021ec7e63b1948f53bd4c8b9c6ff
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    /**
     * @return \Composer\Autoload\ClassLoader
     */
    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        require __DIR__ . '/platform_check.php';

        spl_autoload_register(array('ComposerAutoloaderInitbd68021ec7e63b1948f53bd4c8b9c6ff', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInitbd68021ec7e63b1948f53bd4c8b9c6ff', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInitbd68021ec7e63b1948f53bd4c8b9c6ff::getInitializer($loader));

        $loader->register(true);

        $includeFiles = \Composer\Autoload\ComposerStaticInitbd68021ec7e63b1948f53bd4c8b9c6ff::$files;
        foreach ($includeFiles as $fileIdentifier => $file) {
            composerRequirebd68021ec7e63b1948f53bd4c8b9c6ff($fileIdentifier, $file);
        }

        return $loader;
    }
}

/**
 * @param string $fileIdentifier
 * @param string $file
 * @return void
 */
function composerRequirebd68021ec7e63b1948f53bd4c8b9c6ff($fileIdentifier, $file)
{
    if (empty($GLOBALS['__composer_autoload_files'][$fileIdentifier])) {
        $GLOBALS['__composer_autoload_files'][$fileIdentifier] = true;

        require $file;
    }
}
