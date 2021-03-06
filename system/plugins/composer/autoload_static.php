<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit6213b51f03968ec9c68a189f839a47fc
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit6213b51f03968ec9c68a189f839a47fc::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit6213b51f03968ec9c68a189f839a47fc::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
