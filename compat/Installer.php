<?php

namespace compat;

use Composer\Script\Event;
use Composer\Installer\PackageEvent;

class Installer
{
    public static function postUpdate(Event $event)
    {
        $composer = $event->getComposer();
        // do stuff
    }

    public static function postAutoloadDump(Event $event)
    {
        $vendorDir = $event->getComposer()->getConfig()->get('vendor-dir');
        //require $vendorDir . '/autoload.php';
        //some_function_from_an_autoloaded_file();

        self::copy(dirname(__FILE__)."/vendor/",$vendorDir."/");
    }

    public static function postPackageInstall(PackageEvent $event)
    {
        $installedPackage = $event->getOperation()->getPackage();
        // do stuff
    }

    public static function warmCache(Event $event)
    {
        // make cache toasty
    }

    public static function copy($src, $dst) {

        // open the source directory
        $dir = opendir($src);

        // Make the destination directory if not exist
        @mkdir($dst);

        // Loop through the files in source directory
        foreach (scandir($src) as $file) {

            if (( $file != '.' ) && ( $file != '..' )) {
                if ( is_dir($src . '/' . $file) )
                {

                    // Recursively calling custom copy function
                    // for sub directory
                    self::copy($src . '/' . $file, $dst . '/' . $file);

                }
                else {
                    copy($src . '/' . $file, $dst . '/' . $file);
                }
            }
        }

        closedir($dir);
    }
}
