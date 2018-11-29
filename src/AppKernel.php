<?php
/**
 * Created by PhpStorm.
 * User: Den
 * Date: 28.11.2018
 * Time: 22:29
 */

namespace App;


class AppKernel
{
    public function registerBundles()
    {
        $bundles = [
            // ...

            new Knp\Bundle\MenuBundle\KnpMenuBundle(),
        ];

        // ...
    }
}