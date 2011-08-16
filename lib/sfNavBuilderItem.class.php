<?php
/**
 * sfNavBuilderItem
 * Defines a single menu item to pass into sfNavBuilder
 * @author Chris Sedlmayr catchamonkey <chris@sedlmayr.co.uk>
 */
class sfNavBuilderItem
{
    private $_displayName;
    private $_url;
    private $_activateWhen;
    private $_isActive;
    private $_children;
    private $_attributes;

    public function __construct()
    {
        $this->_displayName     = NULL;
        $this->_url             = NULL;
        $this->_activateWhen    = array();
        $this->_isActive        = FALSE;
        $this->_children        = array();
        $this->_attributes      = array();
    }

    public function setDisplayName($n)
    {
        if (!is_string($n))
        {
            throw new sfPluginException("Display Name must be a string", 1);
        }
        $this->_displayName = $n;
        return $this;
    }

    public function setUrl($u)
    {
        if (!is_string($u))
        {
            throw new sfPluginException("URL must be a string", 1);
        }
        $this->_url = $u;
        return $this;
    }

    public function addActivateWhen(Array $a)
    {
        $this->_activateWhen[] = $a;
        return $this;
    }

    public function setActive($b)
    {
        if (!is_bool($b))
        {
            throw new sfPluginException("Active state must be Boolean", 1);
            
        }
        $this->_isActive = $b;
        return $this;
    }

    public function addChild(sfNavBuilderItem $i)
    {
        $this->_children[] = $i;
        return $this;
    }

    /**
     * Alternative way to build hierarchy
     */
    public function setParent(sfNavBuilderItem $i)
    {
        $i->addChild($this);
        return $this;
    }

    /**
     * Adds an attribute to the item
     * @param String $name The attribute name
     * @param String $value The attribute value
     * @return sfNavBuilderItem $this The current sfNavBuilderItem instance
     */
    public function addAttribute($name, $value)
    {
        $this->_attributes[$name] = $value;
        return $this;
    }

    /**
     * Returns the attributes of this item as a single string
     * e.g. name="value" name2="value2"
     * @return String $ret All defined attributes in name="value" format
     **/
    public function getAttributes()
    {
        $ret = '';
        foreach ($this->_attributes as $name => $value)
        {
            $ret .= $name . '="'.$value.'"';
        }
        return $ret;
    }

    public function hasChildren()
    {
        return (empty($this->_children) ? FALSE : TRUE);
    }

    public function getDisplayName()
    {
        return $this->_displayName;
    }

    public function getUrl()
    {
        return $this->_url;
    }

    public function getActivateWhen()
    {
        return $this->_activateWhen;
    }

    public function isActive()
    {
        return $this->_isActive;
    }

    public function getChildren()
    {
        return $this->_children;
    }

    public function __toString()
    {
        return $this->getDisplayName();
    }
}