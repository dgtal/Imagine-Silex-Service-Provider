<?php

/*
 * This file is part of Imagine Service Provider.
 *
 * (c) 2013 Romain Neutron <imprec@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Neutron\Silex\Provider;

use Pimple\ServiceProviderInterface;
use Pimple\Container;

class ImagineServiceProvider implements ServiceProviderInterface
{
    public function register(Container $app)
    {
        if (class_exists('\Gmagick')) {
            $app['imagine.driver'] = 'Gmagick';
        } elseif (class_exists('\Imagick')) {
            $app['imagine.driver'] = 'Imagick';
        } else {
            $app['imagine.driver'] = 'Gd';
        }

        $app['imagine'] = function($app) {
            $classname = sprintf('Imagine\%s\Imagine', $app['imagine.driver']);
            $imagine = new $classname;

            return $imagine;
        };
    }

    public function boot($app)
    {
    }
}
