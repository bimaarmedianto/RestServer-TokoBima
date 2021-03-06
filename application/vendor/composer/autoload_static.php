<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit1a8f352b486965da4880639bc2454e39
{
    public static $prefixLengthsPsr4 = array (
        'c' => 
        array (
            'chriskacerguis\\RestServer\\' => 26,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'chriskacerguis\\RestServer\\' => 
        array (
            0 => __DIR__ . '/..' . '/chriskacerguis/codeigniter-restserver/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit1a8f352b486965da4880639bc2454e39::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit1a8f352b486965da4880639bc2454e39::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
