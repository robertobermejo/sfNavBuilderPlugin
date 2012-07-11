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
        } else
        {
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
                            $navItem = $this->createItem($menu);
                            if ($navItem)
                            {
                                $this->menu->addItem($navItem);
                            }
                        }
                    }
                }
            }
        }
    }

    public function createItem($itemArray)
    {
        if (is_array($itemArray))
        {
            if (array_key_exists('text', $itemArray) && array_key_exists('url', $itemArray))
            {
                $navItem = new sfNavBuilderItem();
                $navItem->setDisplayName($itemArray['text'])
                        ->setUrl(url_for($itemArray['url']));
                if (array_key_exists('class', $itemArray))
                {
                    $navItem->setClass($itemArray['class']);
                }
                if (array_key_exists('activate_when', $itemArray))
                {
                    $navItem->addActivateWhen($itemArray['activate_when']);
                }
                if (array_key_exists('childrens', $itemArray))
                {
                    foreach ($itemArray['childrens'] as $childArray)
                    {
                        $childMenu = $this->createItem($childArray);
                        if ($childMenu) {
                            $navItem->addChild($childMenu);
                        }
                    }
                }
                return $navItem;
            }
        }
    }

}