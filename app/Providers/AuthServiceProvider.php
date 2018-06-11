<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\User;
//use App\Models\Photo;
use App\Models\Album;
//use App\Policies\PhotoPolicy;
//use App\Policies\ALbumPolicy;


class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
       // 'App\Model' => 'App\Policies\ModelPolicy',
        //Album::class, AlbumPolicy::class,
       // Photo::class, PhotoPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();


        Gate::define('manage_album', function(User $user, Album $album){
            return true;
            //dd ($user->id);    //31
            //dd ($album->user_id;);    //31
             return $user->id == $album->user_id;
        });


    }
}
