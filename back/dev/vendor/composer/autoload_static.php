<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInite78625d4bcd11b98af316ddd87b04b1f
{
    public static $files = array (
        '253c157292f75eb38082b5acb06f3f01' => __DIR__ . '/..' . '/nikic/fast-route/src/functions.php',
    );

    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Slim\\' => 5,
        ),
        'P' => 
        array (
            'Psr\\Http\\Message\\' => 17,
            'Psr\\Container\\' => 14,
        ),
        'F' => 
        array (
            'FastRoute\\' => 10,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Slim\\' => 
        array (
            0 => __DIR__ . '/..' . '/slim/slim/Slim',
        ),
        'Psr\\Http\\Message\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/http-message/src',
        ),
        'Psr\\Container\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/container/src',
        ),
        'FastRoute\\' => 
        array (
            0 => __DIR__ . '/..' . '/nikic/fast-route/src',
        ),
    );

    public static $prefixesPsr0 = array (
        'P' => 
        array (
            'Pimple' => 
            array (
                0 => __DIR__ . '/..' . '/pimple/pimple/src',
            ),
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInite78625d4bcd11b98af316ddd87b04b1f::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInite78625d4bcd11b98af316ddd87b04b1f::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInite78625d4bcd11b98af316ddd87b04b1f::$prefixesPsr0;
            $loader->classMap = ComposerStaticInite78625d4bcd11b98af316ddd87b04b1f::$classMap;

        }, null, ClassLoader::class);
    }
}