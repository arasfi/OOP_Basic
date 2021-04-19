<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitcc6eba8af4627b7222751bebbf3c2619
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitcc6eba8af4627b7222751bebbf3c2619::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitcc6eba8af4627b7222751bebbf3c2619::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitcc6eba8af4627b7222751bebbf3c2619::$classMap;

        }, null, ClassLoader::class);
    }
}