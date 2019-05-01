<?php

namespace App\Providers;

use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
        Gate::define('auth.ownOrAdmin', function ($entity, $user = null) {
            if (!$user) $user = Auth::user();

            if ($user) {
                if ($user->id == $entity->user_id || isSuperAdmin()) {
                    return true;
                }
            }

            // flash('你无权做此操作')->error();
            return false;
        });

        //
        // base update and edit
        Gate::define('basic-handle', function ($user, $entity) {
            if (isSuperAdmin()) return true;

            return ($entity->user_id === $user->id) ? true : false;
        });


        //
        // update within time
        Gate::define('update-within-time', function ($user, $entity, $time = 5) {
            return $this->updateWithInTimeGate($user, $entity, $time);
        });

        //
        // destroy
        Gate::define('update', function ($user, $entity) {
            return $this->updateGate($user, $entity);
        });

        //
        // destroy
        Gate::define('destroy', function ($user, $entity) {
            return $this->updateGate($user, $entity);
        });
    }

    /**
     * Update Within Time Gate
     */
    protected function updateWithInTimeGate($user, $entity, $time = 5)
    {
        if (isSuperAdmin()) return true;

        if ($entity->user_id === $user->id) {
            if ($entity->created_at->addMinutes($time)->gte(Carbon::now())) {
                return true;
            } else {
                flash("操作失败, 请在内容发布 {$time} 分钟之内进行此操作")->error();
            }
        } else {
            flash('你无权做此操作')->error();
        }

        return false;
    }

    /**
     * Update Gate
     */
    public function updateGate($user, $entity)
    {
        if (isSuperAdmin()) return true;

        if ($entity->user_id === $user->id) {
            return true;
        } else {
            flash('你无权做此操作')->error();
            return false;
        }
    }
}
