<?php

namespace Modules\User\Services;

use Cartalyst\Sentinel\Permissions\StandardPermissions;

/**
 * This class overrides the default Cartalyst/Sentinel behavior and allows Role-based access if at least one of the
 * rolles allows access to the specific permission
 */
class LoosePermissions extends StandardPermissions
{
    /**
     * Does the heavy lifting of preparing permissions.
     *
     * @param array $prepared
     * @param array $permissions
     *
     * @return void
     */
    protected function preparePermissions(array &$prepared, array $permissions): void
    {
        foreach ($permissions as $keys => $value) {
            foreach ($this->extractClassPermissions($keys) as $key) {
                // If the value is not in the array, we're opting in
                if (! array_key_exists($key, $prepared)) {
                    $prepared[$key] = $value;

                    continue;
                }
            }
        }
    }
}
