<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class Blog extends Model
{
    protected $table = 'blog';
    protected $primaryKey = 'blog_id';
    public const CREATED_AT = 'dt_created';
    public const UPDATED_AT = 'dt_updated';
    protected $fillable = [
        'title',
        'description','text',
        'category_id',
        'user_id',
    ];
    public function category(): BelongsTo
    {
        return $this->belongsTo(
            Category::class,
            'category_id',
            'category_id'
        );
    }
    public function author(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'user_id',
            'id'
        );
    }
}
