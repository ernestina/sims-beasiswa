<?php

class Authorization {

    private static $_instance = null;
    private $_roles = array();
    private $_access = array();
    private $_redirect = array();

    const ISNULL = 'ISNULL';

    public function __construct() {
        
    }

    public static function getInstance() {
        if (null === self::$_instance) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    public function addRole($role, $extends = null) {
        if ($role == self::ISNULL) {
            return false;
        }
        if (!is_null($extends)) {
            if (!is_array($extends)) {
                $extends = array($extends);
            }
            foreach ($extends as $extend) {
                if (!array_key_exists($extend, $this->_roles)) {
                    return false;
                }
            }
        }
        if (!array_key_exists($role, $this->_roles)) {
            $this->_roles[$role] = $extends;
            return true;
        }
        return false;
    }

    public function addAccess($resource, $role, $action) {
        $array = $this->_access[$role];

        if (is_null($role)) {
            $role = self::ISNULL;
        }
        if (!is_array($action)) {
            $action = array($action);
        }
        if (count($array) == 0 || !array_key_exists($resource, $array)) {
            $this->_access[$role][$resource] = $action;
            return true;
        }
        return false;
    }

    private function searchParents($role, $resource, $action) {
        foreach ($this->_roles[$role] as $parent) {
            if (is_array($this->_access[$parent][$resource]) && in_array($action, $this->_access[$parent][$resource])) {
                return true;
            }
            if (!is_null($this->_roles[$parent])) {
                return $this->searchParents($parent, $resource, $action);
            }
        }
        return false;
    }

    public function isAllowed($role, $resource, $action) {
        if (is_null($role)) {
            $role = self::ISNULL;
        }
        if (array_key_exists($role, $this->_roles) || $role == self::ISNULL) {
            if (is_array($this->_access[$role]) && array_key_exists($resource, $this->_access[$role])) {
                if (in_array($action, $this->_access[$role][$resource])) {
                    return true;
                }
            }
            if (is_array($this->_access[self::ISNULL]) && array_key_exists($resource, $this->_access[self::ISNULL])) {
                if (in_array($action, $this->_access[self::ISNULL][$resource])) {
                    return true;
                }
            }
            if (isset($this->_roles[$role])) {
                return $this->searchParents($role, $resource, $action);
            }
        }
        return false;
    }

    public function addRedirect($role, $controller, $action) {
        if (array_key_exists($role, $this->_roles)) {
            $this->_redirect[$role] = array('controller' => $controller, 'action' => $action);
            return true;
        }

        return false;
    }

    public function getRedirect($role) {
        if (array_key_exists($role, $this->_roles))
            return $this->_redirect[$role];

        return false;
    }

    public function getRoles() {
        return $this->_roles;
    }

    public function getAccesses() {
        return $this->_access;
    }

}

?>