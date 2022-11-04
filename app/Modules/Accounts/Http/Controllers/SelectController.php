<?php

namespace App\Modules\Accounts\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Modules\Accounts\Entities\User;
use App\Modules\Accounts\Http\Filters\SelectFilter;
use App\Modules\Accounts\Transformers\SelectResource;

class SelectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \Modules\Accounts\Http\Filters\SelectFilter $filter
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(SelectFilter $filter)
    {
        $users = User::filter($filter)->paginate();

        return SelectResource::collection($users);
    }
}
