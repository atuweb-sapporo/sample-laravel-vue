<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Book
 * @package App\Models
 */
class Book extends Model
{
    /** @var string */
    protected $table = 'books';

    /** @var string[] */
    protected $guarded = [
        'id',
    ];
}
