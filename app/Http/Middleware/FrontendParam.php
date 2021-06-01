<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use DB;
use Illuminate\View\View;

class FrontendParam
{
    const MASTER_MENUS = 0;
    const CHILD_MENUS = 1;
    const SUB_MENUS = 2;
    const SLOGAN = ['title', 'description'];
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $masterMenus = DB::table('menus')->where('status', config('const.active'))
            ->where('parent_id', self::MASTER_MENUS)->orderBy('sort', 'ASC')->get();
        view()->share('masterMenus', $masterMenus);

        $child_menus = DB::table('menus')->where('status', config('const.active'))
            ->where('parent_id', '>=', self::CHILD_MENUS)->orderBy('sort', 'ASC')->get();
        view()->share('childMenus', $child_menus);

        $slogan = DB::table('settings')->whereIn('key', self::SLOGAN)->select('id', 'key', 'value')->get()->toArray();
        view()->share('slogan', $slogan);

        return $next($request);
    }
}
