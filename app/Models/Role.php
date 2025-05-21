<?php

namespace App\Models;

use Spatie\Permission\Models\Role as SpatieRole;

class Role extends SpatieRole
{
    /**
     * Relationship: A role belongs to an organization.
     */
    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }
}

