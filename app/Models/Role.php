<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $table = 'user_role';

    protected $primaryKey = 'id';

    public $incrementing = true;

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */

    protected $fillable = [
        'name','status','created_by','updated_by'
    ];

    public $timestamps = true;

    const CREATED_AT = 'created_on';
    const UPDATED_AT = 'updated_on';

      /**
     * The storage format of the model's date columns.
     *
     * @var string
     */
    protected $dateFormat = 'Y-m-d H:i:s';
}
