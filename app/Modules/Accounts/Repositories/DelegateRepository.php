<?php


namespace App\Modules\Accounts\Repositories;

use App\Modules\Accounts\Entities\Delegate;
use App\Modules\Accounts\Http\Filters\DelegateFilter;
use App\Modules\Contracts\CrudRepository;

class DelegateRepository implements CrudRepository
{

    /**
     * @var \App\Modules\Accounts\Http\Filters\DelegateFilter
     */
    private $filter;

    /**
     * DelegateRepository constructor.
     *
     * @param \App\Modules\Accounts\Http\Filters\DelegateFilter $filter
     */
    public function __construct(DelegateFilter $filter)
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
        return Delegate::filter($this->filter)->paginate();
    }

    /**
     * Save the created model to storage.
     *
     * @param array $data
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileIsTooBig
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\DiskDoesNotExist
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileDoesNotExist
     * @return \App\Modules\Accounts\Entities\Delegate
     */
    public function create(array $data)
    {
        $delegate = Delegate::create($data);

        $this->setType($delegate, $data);

        $this->uploadAvatar($delegate, $data);

        return $delegate;
    }

    /**
     * Display the given client instance.
     *
     * @param mixed $model
     * @return \App\Modules\Accounts\Entities\Delegate
     */
    public function find($model)
    {
        if ($model instanceof Delegate) {
            return $model;
        }

        return Delegate::findOrFail($model);
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
        $delegate = $this->find($model);

        $delegate->update($data);

        $this->setType($delegate, $data);

        $this->uploadAvatar($delegate, $data);

        return $delegate;
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
     * Set the client type.
     *
     * @param \App\Modules\Accounts\Entities\Delegate $delegate
     *$delegate @param array $data
     * @return \App\Modules\Accounts\Entities\Delegate
     */
    private function setType(Delegate $delegate, array $data)
    {
        if (isset($data['type'])) {
            $delegate->setType($data['type']);
        }

        return $delegate;
    }

    /**
     * Upload the avatar image.
     *
     * @param \App\Modules\Accounts\Entities\Delegate $delegat
     *e$delegate @param array $data
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\DiskDoesNotExist
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileDoesNotExist
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileIsTooBig
     * @return \App\Modules\Accounts\Entities\Delegate
     */
    private function uploadAvatar(Delegate $delegate, array $data)
    {
        if (isset($data['avatar'])) {
            $delegate->addMedia($data['avatar'])->toMediaCollection('avatars');
        }

        return $delegate;
    }
}
