<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit9b0f69ab4cef3262769dfc43762b2b57
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'Ask\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Ask\\' => 
        array (
            0 => __DIR__ . '/../..' . '/model',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit9b0f69ab4cef3262769dfc43762b2b57::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit9b0f69ab4cef3262769dfc43762b2b57::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}