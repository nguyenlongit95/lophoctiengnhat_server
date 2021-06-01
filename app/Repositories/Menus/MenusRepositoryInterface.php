<?php

namespace App\Repositories\Menus;

interface MenusRepositoryInterface
{
    /**
     * @return mixed
     */
    public function getMasterMenu();
    /**
     * @param $id
     * @return mixed
     */
    public function getSubMenu($id);
    /**
     * @return mixed
     */
    public function getAllMenus();
    /**
     * @param $menu
     * @return mixed
     */
    public function checkPages($menu);
    /**
     * @param $fieldCompare
     * @param $param
     * @return mixed
     */
    public function getMenusUsingConditions($fieldCompare, $param);
}
