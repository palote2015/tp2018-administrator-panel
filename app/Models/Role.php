<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use jeremykenedy\LaravelRoles\Contracts\RoleHasRelations as RoleHasRelationsContract;
use jeremykenedy\LaravelRoles\Traits\RoleHasRelations;
use jeremykenedy\LaravelRoles\Traits\Slugable;
class Role extends Model implements RoleHasRelationsContract
{
    use Slugable, RoleHasRelations;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'slug', 'description', 'level'];
    /**
     * Create a new model instance.
     *
     * @param array $attributes
     */


    public function users()
    {
        return $this->belongsToMany('App\Models\User', 'role_user', 
      'role_id', 'user_id');
    }




    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        if ($connection = config('roles.connection')) {
            $this->connection = $connection;
        }
    }
}