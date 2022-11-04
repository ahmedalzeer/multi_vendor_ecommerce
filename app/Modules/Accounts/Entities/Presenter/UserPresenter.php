<?php


namespace App\Modules\Accounts\Entities\Presenter;

use Laracasts\Presenter\Presenter;

class UserPresenter
{

    /**
     * Display the localed type.
     *
     * @return string
     */
    public function type()
    {
        return trans('accounts::users.types.'.$this->entity->type);
    }

}
