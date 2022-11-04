<?php

namespace App\Modules\Accounts\Http\Controllers\Dashboard;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Modules\Accounts\Entities\Supervisor;
use App\Modules\Accounts\Http\Requests\SupervisorRequest;
use App\Modules\Accounts\Repositories\SupervisorRepository;

class SupervisorController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;
    /**
     * The repository instance.
     *
     * @var \App\Modules\Accounts\Repositories\SupervisorRepository
     */
    private $repository;

    /**
     * SupervisorRepository constructor.
     *
     * @param \App\Modules\Accounts\Repositories\SupervisorRepository $repository
     */
    public function __construct(SupervisorRepository $repository)
    {
        $this->authorizeResource(Supervisor::class, 'supervisor');

        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $supervisors = $this->repository->all();

        return view('accounts::supervisors.index', compact('supervisors'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('accounts::supervisors.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(SupervisorRequest $request)
    {
        $supervisor = $this->repository->create($request->allWithHashedPassword());

        flash(trans('accounts::supervisors.supervisors.created'));

        return redirect()->route('dashboard.supervisors.show', $supervisor);
    }

    /**
     * Show the specified resource.
     * @param \App\Modules\Accounts\Entities\Supervisor $supervisor
     * @return \Illuminate\Http\Response
     * @return Response
     */
    public function show(Supervisor $supervisor)
    {
        $supervisor = $this->repository->find($supervisor);

        return view('accounts::supervisors.show', compact('supervisor'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param \App\Modules\Accounts\Entities\Supervisor $supervisor
     * @return Response
     */
    public function edit(Supervisor $supervisor)
    {
        $supervisor = $this->repository->find($supervisor);

        return view('accounts::supervisors.edit', compact('supervisor'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(SupervisorRequest $request, Supervisor $supervisor)
    {
        $supervisor = $this->repository->update($supervisor, $request->allWithHashedPassword());

        flash(trans('accounts::supervisors.messages.updated'));

        return redirect()->route('dashboard.supervisors.show', $supervisor);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy(Supervisor $supervisor)
    {
        //
        $this->repository->delete($supervisor);

        flash(trans('accounts::supervisors.messages.deleted'));

        return redirect()->route('dashboard.supervisors.index');
    }
}
