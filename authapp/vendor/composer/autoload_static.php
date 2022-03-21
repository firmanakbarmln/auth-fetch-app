<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit0bc39d586194625b98f2f30e415f6d9c
{
    public static $prefixLengthsPsr4 = array (
        'F' => 
        array (
            'Firebase\\JWT\\' => 13,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Firebase\\JWT\\' => 
        array (
            0 => __DIR__ . '/..' . '/firebase/php-jwt/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit0bc39d586194625b98f2f30e415f6d9c::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit0bc39d586194625b98f2f30e415f6d9c::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit0bc39d586194625b98f2f30e415f6d9c::$classMap;

        }, null, ClassLoader::class);
    }
}