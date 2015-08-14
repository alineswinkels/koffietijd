<?php

namespace FH\Bundle\AppBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * Builds all menus needed for the app.
 *
 * @author Joost Farla <joost.farla@freshheads.com> 
 */
class MenuBuilder
{
    /**
     * @var \Knp\Menu\FactoryInterface
     */
    private $factory;

    /**
     * Constructor.
     *
     * @param \Knp\Menu\FactoryInterface $factory
     */
    public function __construct(FactoryInterface $factory)
    {
        $this->factory = $factory;
    }

    /**
     * Creates main menu.
     *
     * @return \Knp\Menu\ItemInterface
     */
    public function createMainMenu(Request $request)
    {
        $menu = $this->factory->createItem('root');

        $menu->setCurrentUri($request->getRequestUri());
        $menu->addChild('Home', array('route' => 'home'));
        $menu->addChild('Menu item 1', array('uri' => '#'));
        $menu->addChild('Menu item 2', array('uri' => '#'));

        return $menu;
    }
}
