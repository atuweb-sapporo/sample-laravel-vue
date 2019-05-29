<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Review
 * @package App\Models
 */
class Review extends Model
{
    /** @var string */
    protected $table = 'reviews';

    /** @var string[] */
    protected $guarded = [
        'id',
    ];
}
