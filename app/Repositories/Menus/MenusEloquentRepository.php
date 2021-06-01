<?php

namespace App\Repositories\Menus;

use App\Models\Menus;
use App\Repositories\Eloquent\EloquentRepository;
use DB;

class MenusEloquentRepository extends EloquentRepository implements MenusRepositoryInterface
{

    /**
     * @return mixed
     */
    public function getModel()
    {
        return Menus::class;
    }

    /**
     * function get submenu
     *
     * @param int $id
     * @return mixed
     */
    public function getSubMenu($id)
    {
        $menus = DB::table('menus')->where('parent_id', $id)->orderBy('sort', 'ASC')->get();
        if (empty($menus)) {
            return null;
        }

        return $menus;
    }

    public function getMasterMenu()
    {
        $menus = DB::table('menus')->where('parent_id', 0)->orderBy('sort', 'ASC')->get();
        if (empty($menus)) {
            return null;
        }

        return $menus;
    }

    /**
     * Function get all menu
     *
     * @return mixed
     */
    public function getAllMenus()
    {
        $menus = Menus::get();

        return $menus;
    }

    /**
     * Function check page of menu
     *
     * @param $menu
     * @return mixed|void
     */
    public function checkPages($menu)
    {
        if (count($menu->pages) > 0) {
            return false;
        }

        return true;
    }

    /**
     * Function get menu using an conditions and whereIn query
     *
     * @param array $fieldCompare
     * @param array $param
     * @return bool|mixed
     */
    public function getMenusUsingConditions($fieldCompare, $param)
    {
        $menus = Menus::whereIn($fieldCompare, $param)->where('status', config('const.active'))
            ->orderBy('sort', 'DESC')->get();
        if (!$menus) {
            return false;
        }

        return $menus;
    }
}
