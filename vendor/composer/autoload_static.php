<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit9a1262240930cd68d00f284d8a1fb4ce
{
    public static $prefixLengthsPsr4 = array (
        'p' => 
        array (
            'parinpan\\fanjwt\\libs\\' => 21,
            'parinpan\\fanjwt\\' => 16,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'parinpan\\fanjwt\\libs\\' => 
        array (
            0 => __DIR__ . '/..' . '/parinpan/fan-jwt/libs',
        ),
        'parinpan\\fanjwt\\' => 
        array (
            0 => __DIR__ . '/..' . '/parinpan/fan-jwt',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit9a1262240930cd68d00f284d8a1fb4ce::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit9a1262240930cd68d00f284d8a1fb4ce::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
