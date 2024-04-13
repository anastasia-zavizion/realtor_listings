<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Offer;

class Listing extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['city','baths','code','area','beds', 'street', 'street_nr', 'price'];

    protected $sortable = ['price','created_at'];

    public function owner() : BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function scopeMostRecent($query) : Builder{
        return $query->orderByDesc('created_at');
    }


    public function scopeWithoutSold($query) : Builder{

        return $query->whereNull('sold_at');

        /*return $query
            ->doesntHave('offers')
            ->orWhereDoesntHave(
                'offers',
                fn (Builder $query) => $query->whereNotNull(['accepted_at'])
            );*/
    }

    public function scopeFilter(Builder $query,array $filters) :Builder{
        return $query->when($filters['priceFrom'] ?? false, fn($query, $value) => $query->where('price', '>=', $value))
            ->when($filters['priceTo'] ?? false, fn($query, $value) => $query->where('price', '<=', $value))
            ->when($filters['baths'] ?? false, fn($query, $value) => $query->where('baths', (int)$value >= 6 ? '>=' : '=' , $value))
            ->when($filters['beds'] ?? false, fn($query, $value) => $query->where('beds', (int)$value >= 6 ? '>=' : '=' , $value))
            ->when($filters['areaFrom'] ?? false, fn($query, $value) => $query->where('area','>=', $value))
            ->when($filters['areaTo'] ?? false, fn($query, $value) => $query->where('area','<=', $value))
            ->when($filters['deleted'] ?? false, fn($query, $value) => $query->withTrashed())
            ->when($filters['by'] ?? false, fn($query, $value) =>
            !in_array($value,$this->sortable) ? $query : $query->orderBy($value, $filters['order'] ?? 'DESC'));

    }

    public function images() :HasMany{
        return $this->hasMany(ListingImage::class);
    }

    public function offers():HasMany{
        return $this->hasMany(Offer::class, 'listing_id');
    }
}
