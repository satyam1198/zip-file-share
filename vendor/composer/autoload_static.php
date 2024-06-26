<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit5ec2b4fe61eeb49be27e0ac50b8e69da
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'App\\Resources\\' => 14,
            'App\\Models\\' => 11,
            'App\\Controllers\\' => 16,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'App\\Resources\\' => 
        array (
            0 => __DIR__ . '/../..' . '/App/Resources',
        ),
        'App\\Models\\' => 
        array (
            0 => __DIR__ . '/../..' . '/App/Models',
        ),
        'App\\Controllers\\' => 
        array (
            0 => __DIR__ . '/../..' . '/App/Controllers',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit5ec2b4fe61eeb49be27e0ac50b8e69da::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit5ec2b4fe61eeb49be27e0ac50b8e69da::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit5ec2b4fe61eeb49be27e0ac50b8e69da::$classMap;

        }, null, ClassLoader::class);
    }
}
