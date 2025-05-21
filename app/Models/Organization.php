<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    use HasFactory;

    // Table name (optional if follows Laravel's convention)
    protected $table = 'organizations';

    // Fillable fields
    protected $fillable = ['name', 'parent_id'];

    /**
     * Relationship: An organization can have many roles.
     */
    public function roles()
    {
        return $this->hasMany(Role::class);
    }

    /**
     * Relationship: An organization can have many suborganizations (self-referencing).
     */
    public function suborganizations()
    {
        return $this->hasMany(Organization::class, 'parent_id');
    }

    /**
     * Relationship: An organization belongs to a parent organization.
     */
    public function parent()
    {
        return $this->belongsTo(Organization::class, 'parent_id');
    }
}
