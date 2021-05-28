<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = ['name', 'description'];

    public function permissionsAvailable( $filter = null)
    {
        $permissions = Permission::whereNotIn ('permissions.id', function ($query)
        {
            $query->select('permission_profile.permission_id');
            $query->from('permission_profile');
            $query->whereRaw("permission_profile.profile_id={$this->id}");

        })->where(function ($queryFilter) use ($filter)
        {
            if($filter)
                $queryFilter->where('permissions.name', 'LIKE', "%{$filter}%");
        })
          ->paginate();

        return $permissions;
    }

    public function plansAvailable( $filter = null)
    {
        $plans = Plan::whereNotIn ('plans.id', function ($query)
        {
            $query->select('plan_profile.plan_id');
            $query->from('plan_profile');
            $query->whereRaw("plan_profile.profile_id={$this->id}");

        })->where(function ($queryFilter) use ($filter)
        {
            if($filter)
                $queryFilter->where('plans.name', 'LIKE', "%{$filter}%");
        })
          ->paginate();

        return $plans;
    }
    
    public function permissions()
    {  
        return $this->belongsToMany(Permission::class);
    }
    
    public function plans()
    {  
        return $this->belongsToMany(Plan::class);
    }

    public function search($filter = null)
    {
        $results = $this->where('name', 'LIKE', "%$filter%")
                        ->orWhere('description', 'LIKE', "%$filter%")
                        ->paginate();
        return $results;
    }
}
