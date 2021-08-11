<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit8a353fac79dc68aec391e68cd26a3492
{
    public static $prefixLengthsPsr4 = array (
        'M' => 
        array (
            'MercadinhoHC\\core\\model\\' => 24,
            'MercadinhoHC\\core\\controller\\' => 29,
            'MercadinhoHC\\app\\model\\' => 23,
            'MercadinhoHC\\app\\controller\\' => 28,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'MercadinhoHC\\core\\model\\' => 
        array (
            0 => __DIR__ . '/../..' . '/core/model',
        ),
        'MercadinhoHC\\core\\controller\\' => 
        array (
            0 => __DIR__ . '/../..' . '/core/controller',
        ),
        'MercadinhoHC\\app\\model\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app/model',
        ),
        'MercadinhoHC\\app\\controller\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app/controller',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit8a353fac79dc68aec391e68cd26a3492::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit8a353fac79dc68aec391e68cd26a3492::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit8a353fac79dc68aec391e68cd26a3492::$classMap;

        }, null, ClassLoader::class);
    }
}
