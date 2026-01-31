<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Request;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Request $request)
    {
        $pathAaray = $request->segments();
        $adminRoute = config('app.admin_route');
        $userAdminRoute = config('app.user_admin');

        if(in_array($adminRoute,$pathAaray)){
            config(['app.app_scop' => 'admin']);
        }elseif(in_array($userAdminRoute,$pathAaray)){
            config(['app.app_scop' => 'user_admin']);
        }

        $appScop = config('app.app_scop');
        if($appScop == 'admin'){
            $path = resource_path('admin/views');
        }elseif($appScop == 'front'){
            $path = resource_path('front/views');
        }else{
            $path = resource_path('user_admin/views');
        }
        view()->addLocation($path);
    }
}
