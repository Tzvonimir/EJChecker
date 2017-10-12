<?php

namespace App\Util;

use App\Models\Action;
use App\Models\AppModule;
use App\Models\Role;
use App\Models\User;
use Auth;

class Permission
{

    /**
     * Checks a list of actions.
     * Mode:
     *   'all' - all actions must return true for the request to be true
     *   'any' - any action must return true for the request to be true
     *
     * @param string|array $actions
     * @param int|\App\Models\User $user
     * @param string $mode
     * @return bool
     */
    public static function checkAll($actions, $user = null, $mode = 'all')
    {
        if (is_string($actions)) {
            $actions = [$actions];
        }
        foreach ($actions as $action) {
            $allowed = Permission::check($action, $user);
            if ($mode === 'all' && $allowed === false) {
                return false;
            }
            if ($mode === 'any' && $allowed === true) {
                return true;
            }
        }
        if ($mode === 'all') {
            return true;
        }
        return false;
    }

    /**
     * Checks if a user has a permission for action.
     *
     * @param string $action
     * @param int|\App\Models\User $user
     * @return bool
     */
    public static function check($action, $user = null)
    {
        /* TODO rewrite with repository */
        if (is_int($user)) {
            $user = User::findOrFail($user);
        }
        if (!$user) {
            $user = Auth::user();

            if (!$user) {
                return false;
            }
        }

        /* TODO rewrite with repository */
        if (is_string($action)) {
            $action = Action::where('name', $action)->first();
        }

        if (!isset($action->name)) {
            return false;
        }

        /* if disabled in 'app_modules' */
        if (!self::checkAppModule($action->name)) {
            return false;
        }

        $roles = $user->roles()->get();
        /** @var Role $role */
        foreach ($roles as $role) {
            $pivot = $role->actions()
                ->where('name', $action->name)
                ->withPivot('is_allowed')
                ->first();
            if (!$pivot) {
                return false;
            }
            if ($pivot->pivot->is_allowed) {
                return true;
            }
        }
        return false;
    }

    /**
     * Checks 'app_module' table for permissions.
     *
     * @param string $action
     * @return bool
     */
    private static function checkAppModule($action)
    {
        /* TODO rewrite with repository */
        $module = AppModule::where('name', $action)->first();
        if (!isset($module->is_allowed)) {
            return true;
        }
        return $module->is_allowed;
    }

    /**
     * Adds actions (including M2M relationship with roles).
     *
     * @param array $actions
     * @param int $isAllowed
     */
    public static function addActions($actions, $isAllowed = 0)
    {
        $isAlreadyInDb = false;
        foreach ($actions as $action) {
            /* TODO rewrite with repository */
            $a = Action::where('name', $action)->first();
            if ($a) {
                $isAlreadyInDb = true;
                break;
            }
        }

        if (!$isAlreadyInDb) {
            /* TODO rewrite with repository */
            $roles = Role::all();
            foreach ($actions as $action) {
                $action = ['name' => $action];
                /* TODO rewrite with repository */
                $action = Action::create($action);
                foreach ($roles as $role) {
                    $role->actions()->attach($action, [
                        'is_allowed' => $isAllowed
                    ]);
                }
            }
        }
    }

    /**
     * Adds roles (including M2M relationship with actions).
     *
     * @param array $roles
     * @param int $isAllowed
     */
    public static function addRoles($roles, $isAllowed = 0)
    {
        $isAlreadyInDb = false;
        foreach ($roles as $role) {
            /* TODO rewrite with repository */
            $r = Role::where('name', $role)->first();
            if ($r) {
                $isAlreadyInDb = true;
                break;
            }
        }

        if (!$isAlreadyInDb) {
            /* TODO rewrite with repository */
            $actions = Action::all();
            foreach ($roles as $role) {
                $role = ['name' => $role];
                /* TODO rewrite with repository */
                $role = Role::create($role);
                foreach ($actions as $action) {
                    $action->roles()->attach($role, [
                        'is_allowed' => $isAllowed
                    ]);
                }
            }
        }
    }
}
