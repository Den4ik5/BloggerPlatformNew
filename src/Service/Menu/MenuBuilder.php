<?php
/**
 * Created by PhpStorm.
 * User: Den
 * Date: 30.11.2018
 * Time: 17:02
 */
declare(strict_types=1);

namespace App\Service\Menu;


use Knp\Menu\FactoryInterface;
use Symfony\Component\HttpFoundation\RequestStack;

class MenuBuilder
{
    private $factory;

    /**
     * @param FactoryInterface $factory
     */
    public function __construct(FactoryInterface $factory)
    {
        $this->factory = $factory;
    }

    /**
     * @param RequestStack $requestStack
     * @return \Knp\Menu\ItemInterface
     */
    public function createMainMenu(RequestStack $requestStack)
    {
        $menu = $this->factory->createItem('root');

        $menu->addChild('Home', ['route' => 'login']);


        // ... add more children

        return $menu;
    }
    public function createSidebarMenu(RequestStack $requestStack)
    {
        $menu = $this->factory->createItem('sidebar');

        $menu->addChild('Home', ['route' => 'homepage']);
        $menu->addChild('Log in', ['route' => 'login']);
        $menu->addChild('Registration', ['route' => 'register']);
        $menu->addChild('Home', ['route' => 'somethingElse']);

        // ... add more children
        return $menu;
    }
}