<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class User
 * @package App\Models
 */
class User extends Model
{
    /** @var string */
    protected $table = 'users';

    /** @var string[] */
    protected $guarded = [
        'id',
    ];

    /** @var string[] */
    protected $hidden = [
        'uid',
    ];
}
