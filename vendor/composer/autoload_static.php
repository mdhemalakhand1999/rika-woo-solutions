<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInita90994a0717838fc95348c932b544b28
{
    public static $prefixLengthsPsr4 = array (
        'R' => 
        array (
            'Rika_Woo_Solutions\\' => 19,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Rika_Woo_Solutions\\' => 
        array (
            0 => __DIR__ . '/../..' . '/includes',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInita90994a0717838fc95348c932b544b28::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInita90994a0717838fc95348c932b544b28::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInita90994a0717838fc95348c932b544b28::$classMap;

        }, null, ClassLoader::class);
    }
}
