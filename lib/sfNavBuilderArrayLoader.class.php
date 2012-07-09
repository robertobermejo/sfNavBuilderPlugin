<?php

/**
 * Description of sfNavBuilderArrayLoader
 *
 * @author roberto
 */
class sfNavBuilderArrayLoader
{

    private static $instance;

    public static function getInstance($menu = null)
    {
        if (!isset(self::$instance))
        {
            self::$instance = new sfNavBuilderArrayLoader($menu);
        }
        return self::$instance;
    }

    private $menu = null;

    public function __construct($menu = null)
    {
        if (is_null($menu))
        {
            $this->menu = new sfNavBuilder();
        } else {
            $this->menu = $menu;
        }
        return $this;
    }

    public function getMenu()
    {
        return $this->menu;
    }

    public function setup($enviorments)
    {
        foreach ($enviorments as $enviorment => $menus)
        {
            if (in_array($enviorment, array('all', sfConfig::get('sf_environment'))))
            {
                if (is_array($menus))
                {
                    foreach ($menus as $menu)
                    {
                        if (is_array($menu))
                        {
                            if (array_key_exists('text', $menu) && array_key_exists('url', $menu))
                            {
                                $navItem = new sfNavBuilderItem();
                                $navItem->setDisplayName($menu['text'])
                                        ->setUrl(url_for($menu['url']));
                                if (array_key_exists('class', $menu))
                                {
                                    $navItem->setClass($menu['class']);
                                }
                                if (array_key_exists('activate_when', $menu))
                                {
                                    $navItem->addActivateWhen($menu['activate_when']);
                                }
                                $this->menu->addItem($navItem);
                            }
                        }
                    }
                }
            }
        }
    }

}