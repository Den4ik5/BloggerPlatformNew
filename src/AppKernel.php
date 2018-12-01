<?php
/**
 * Created by PhpStorm.
 * User: Den
 * Date: 28.11.2018
 * Time: 22:29
 */

declare(strict_types=1);

namespace App;


class AppKernel
{

    public function registerBundles()
    {
        $bundles =  array(
            // ...
            new Knp\Bundle\MenuBundle\KnpMenuBundle(),
            new Symfony\Cmf\Bundle\MenuBundle\CmfMenuBundle(),
        );

        // ...
    }
}