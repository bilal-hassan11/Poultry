<?php

namespace App\Permissions;

use Illuminate\Contracts\Auth\Access\Gate;

trait HasPermissionsTrait
{
  public function hasPermissionTo($permission)
  {
    return (bool) $this->hasPermission($permission);
  }

  public function hasRole(...$roles)
  {
    foreach ($roles as $role) {
      if ($this->user_type == $role) {
        return true;
      }
    }
    return false;
  }

  protected function hasPermission($permission)
  {
    if ($this->user_type == 'admin') {
      return true;
    }

    // $permissions = collect($this->user_permissions)->keyBy('name')->keys()->all();

    $permissions = collect($this->user_permissions);
    return (bool) $permissions->where('name', $permission)->count();
  }

  public function can($permission, $arguments = [])
  {
    // dd($this->hasPermission($permission));
    return (bool) $this->hasPermission($permission, $arguments);
  }

  public function canAny($_permissions, $arguments = [])
  {
    if ($this->user_type == 'admin') {
      return true;
    }
    $permissions = collect($this->user_permissions);
    return (bool) $permissions->whereIn('name', $_permissions)->count();
  }

  public function cant($permission, $arguments = [])
  {
    if ($this->user_type == 'admin') {
      return false;
    }
    return !$this->hasPermission($permission, $arguments);
  }

  public function cannot($permission, $arguments = [])
  {
    return $this->cant($permission, $arguments);
  }
}
