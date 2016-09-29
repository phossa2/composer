<?php
/**
 * Phossa Project
 *
 * PHP version 5.4
 *
 * @category  Library
 * @package   Phossa2\Composer
 * @copyright Copyright (c) 2016 phossa.com
 * @license   http://mit-license.org/ MIT License
 * @link      http://www.phossa.com/
 */
/*# declare(strict_types=1); */

namespace Phossa2\Composer;

use Composer\Package\PackageInterface;
use Composer\Installer\LibraryInstaller;

/**
 * Installer
 *
 * @package Phossa2\Composer
 * @author  Hong Zhang <phossa@126.com>
 * @version 2.0.0
 * @since   2.0.0 added
 */
class Installer extends LibraryInstaller
{
    // phossa2 application
    const TYPE_APP = 'phossa2-app';

    // phossa2 extension
    const TYPE_EXT = 'phossa2-extension';

    // app dir defined in extra
    const EXTRA_APPPATH = 'app-path';

    /**
     * {@inheritDoc}
     */
    public function supports($packageType)
    {
        // types supported
        $types = [
            'phossa2-app',
            'phossa2-extension'
        ];
        return in_array($packageType, $types);
    }

    /**
     * {@inheritDoc}
     */
    public function getPackageBasePath(PackageInterface $package)
    {
        $extra = $package->getExtra();
        switch ($package->getType()) {
            // install to a custom app dir if defined
            case self::TYPE_APP:
                return isset($extra[self::EXTRA_APPPATH]) ?
                    $extra[self::EXTRA_APPPATH] : 'app';

            // install to extension dir
            case self::TYPE_EXT:
                return 'extension/' . $package->getPrettyName();
        }
    }
}
