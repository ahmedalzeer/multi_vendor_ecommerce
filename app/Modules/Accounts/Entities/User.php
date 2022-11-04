<?php

namespace App\Modules\Accounts\Entities;

use App\Http\Filters\Filterable;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Modules\Accounts\Entities\Helpers\UserHelpers;
use App\Modules\Accounts\Entities\Presenters\UserPresenter;
use App\Modules\Support\Traits\Selectable;
use Illuminate\Support\Collection;
use Spatie\MediaLibrary\Conversions\Conversion;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Notifications\Notifiable;
use Parental\HasChildren;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Laracasts\Presenter\PresentableTrait;
use Spatie\MediaLibrary\MediaCollections\FileAdder;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class User extends Authenticatable implements HasMedia
{
    use Notifiable,
        UserHelpers,
        HasChildren,
        HasMediaTrait,
        HasChildren,
        PresentableTrait,
        Filterable,
        Selectable;

    /**
     * The code of admin type.
     *
     * @var string
     */
    const ADMIN_TYPE = 'admin';

    /**
     * The code of customer type.
     *
     * @var string
     */
    const CUSTOMER_TYPE = 'customer';

    /**
     * The code of store owner type.
     *
     * @var string
     */
    const STORE_OWNER_TYPE = 'store_owner';

    /**
     * The code of supervisor type.
     *
     * @var string
     */
    const SUPERVISOR_TYPE = 'supervisor';

    /**
     * The code of shipping company owner type.
     *
     * @var string
     */
    const SHIPPING_COMPANY_OWNER_TYPE = 'shipping_company_owner';

    /**
     * The code of shipping company owner type.
     *
     * @var string
     */
    const DELEGATE_TYPE = 'delegate';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'country_id',
        'remember_token',
    ];

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['media'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * @var array
     */
    protected $childTypes = [
        self::ADMIN_TYPE => Admin::class,
        self::CUSTOMER_TYPE => Customer::class,
        self::STORE_OWNER_TYPE => StoreOwner::class,
        self::SUPERVISOR_TYPE => Supervisor::class,
        self::SHIPPING_COMPANY_OWNER_TYPE => ShippingCompanyOwner::class,
        self::DELEGATE_TYPE => Delegate::class,
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The presenter class name.
     *
     * @var string
     */
    protected $presenter = UserPresenter::class;

    /**
     * Get the number of models to return per page.
     *
     * @return int
     */
    public function getPerPage()
    {
        return request('perPage', parent::getPerPage());
    }

    /**
     * Define the media collections.
     *
     * @return void
     */
    public function registerMediaCollections() :void
    {
        $this
            ->addMediaCollection('avatars')
            ->useFallbackUrl('https://www.gravatar.com/avatar/'.md5($this->email).'?d=mm')
            ->singleFile();
    }

    public function media(): MorphMany
    {
        // TODO: Implement media() method.
    }

    public function addMedia(string|UploadedFile $file): FileAdder
    {
        // TODO: Implement addMedia() method.
    }

    public function copyMedia(string|UploadedFile $file): FileAdder
    {
        // TODO: Implement copyMedia() method.
    }

    public function hasMedia(string $collectionName = ''): bool
    {
        // TODO: Implement hasMedia() method.
    }

    public function getMedia(string $collectionName = 'default', callable|array $filters = []): Collection
    {
        // TODO: Implement getMedia() method.
    }

    public function clearMediaCollection(string $collectionName = 'default'): HasMedia
    {
        // TODO: Implement clearMediaCollection() method.
    }

    public function clearMediaCollectionExcept(string $collectionName = 'default', array|Collection $excludedMedia = []): HasMedia
    {
        // TODO: Implement clearMediaCollectionExcept() method.
    }

    public function shouldDeletePreservingMedia(): bool
    {
        // TODO: Implement shouldDeletePreservingMedia() method.
    }

    public function loadMedia(string $collectionName)
    {
        // TODO: Implement loadMedia() method.
    }

    public function addMediaConversion(string $name): Conversion
    {
        // TODO: Implement addMediaConversion() method.
    }

    public function registerMediaConversions(Media $media = null): void
    {
        // TODO: Implement registerMediaConversions() method.
    }

    public function registerAllMediaConversions(): void
    {
        // TODO: Implement registerAllMediaConversions() method.
    }
}
