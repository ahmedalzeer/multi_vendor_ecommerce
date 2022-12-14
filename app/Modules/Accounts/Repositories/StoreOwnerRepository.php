<?php


namespace App\Modules\Accounts\Repositories;


use App\Modules\Accounts\Entities\StoreOwner;
use App\Modules\Accounts\Http\Filters\StoreOwnerFilter;
use App\Modules\Contracts\CrudRepository;
use App\Modules\Stores\Entities\Store;

class StoreOwnerRepository implements CrudRepository
{

    /**
     * @var \App\Modules\Accounts\Http\Filters\StoreOwnerFilter
     */
    private $filter;

    /**
     * StoreOwnerRepository constructor.
     *
     * @param \App\Modules\Accounts\Http\Filters\StoreOwnerFilter $filter
     */
    public function __construct(StoreOwnerFilter $filter)
    {
        $this->filter = $filter;
    }

    /**
     * Get all clients as a collection.
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function all()
    {
        return StoreOwner::filter($this->filter)->paginate();
    }

    /**
     * Save the created model to storage.
     *
     * @param array $data
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileIsTooBig
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\DiskDoesNotExist
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileDoesNotExist
     * @return \App\Modules\Accounts\Entities\StoreOwner
     */
    public function create(array $data)
    {
        $storeOwner = StoreOwner::create($data);

        $this->setType($storeOwner, $data);

        $this->uploadAvatar($storeOwner, $data);

        return $storeOwner;
    }

    /**
     * Display the given client instance.
     *
     * @param mixed $model
     * @return \App\Modules\Accounts\Entities\storeOwner
     */
    public function find($model)
    {
        if ($model instanceof StoreOwner) {
            return $model;
        }

        return StoreOwner::findOrFail($model);
    }

    /**
     * Update the given client in the storage.
     *
     * @param mixed $model
     * @param array $data
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\DiskDoesNotExist
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileDoesNotExist
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileIsTooBig
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function update($model, array $data)
    {
        $storeOwner = $this->find($model);

        $storeOwner->update($data);

        $this->setType($storeOwner, $data);

        $this->uploadAvatar($storeOwner, $data);

        return $storeOwner;
    }

    /**
     * Delete the given client from storage.
     *
     * @param mixed $model
     * @throws \Exception
     * @return void
     */
    public function delete($model)
    {
        $this->find($model)->delete();
    }

    /**
     * @param StoreOwner $storeOwner
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function createStore(StoreOwner $storeOwner, array $data)
    {
        return $storeOwner->stores()->create($data);
    }

    /**
     * @param Store $store
     * @param array $data
     * @return Store
     */
    public function updateStore(Store $store, array $data)
    {
        $store->update($data);

        return $store;
    }

    public function deleteStore(Store $store)
    {
        return $store->delete();
    }

    /**
     * Set the client type.
     *
     * @param \App\Modules\Accounts\Entities\StoreOwner $storeOwner
     * @param array $data
     * @return \App\Modules\Accounts\Entities\StoreOwner
     */
    private function setType(StoreOwner $storeOwner, array $data)
    {
        if (isset($data['type'])) {
            $storeOwner->setType($data['type']);
        }

        return $storeOwner;
    }

    /**
     * Upload the avatar image.
     *
     * @param \App\Modules\Accounts\Entities\StoreOwner $StoreOwner
     * @param array $data
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\DiskDoesNotExist
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileDoesNotExist
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileIsTooBig
     * @return \app\Modules\Accounts\Entities\StoreOwner
     */
    private function uploadAvatar(StoreOwner $storeOwner, array $data)
    {
        if (isset($data['avatar'])) {
            $storeOwner->addMedia($data['avatar'])->toMediaCollection('avatars');
        }

        return $storeOwner;
    }

}
