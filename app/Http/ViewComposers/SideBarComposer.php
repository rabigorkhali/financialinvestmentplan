<?php

namespace App\Http\ViewComposers;

use Config;
use Illuminate\View\View;

class SideBarComposer
{
    public function compose(View $view)
    {
        $modules = Config::get('cmsConfig.modules');
        $view->with('modules', $modules);
    }
}
