<?php

namespace App\Modules\Accounts\Http\Controllers\Dashboard;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Modules\Accounts\Entities\ShippingCompany;
use App\Modules\Accounts\Entities\ShippingCompanyOwner;
use App\Modules\Accounts\Http\Requests\ShippingCompanyRequest;
use App\Modules\Accounts\Repositories\ShippingCompanyOwnerRepository;

class ShippingCompanyController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;


    /**
     * @var \App\Modules\ShippingCompanies\Repositories\ShippingCompanyRepository
     */
    private $repository;

    /**
     * ShippingCompaniesController constructor.
     * @param ShippingCompanyOwnerRepository $repository
     */
    public function __construct(ShippingCompanyOwnerRepository $repository)
    {
        $this->authorizeResource(ShippingCompany::class, 'shipping_company');

        $this->repository = $repository;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Modules\Accounts\Http\Requests\AddressRequest $request
     * @param \App\Modules\Accounts\Entities\Customer $shippingCompanyOwner
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ShippingCompanyRequest $request, ShippingCompanyOwner $shippingCompanyOwner)
    {
        $this->repository->createShippingCompany($shippingCompanyOwner, $request->all());

        flash(trans('accounts::shipping_companies.messages.created'));

        return redirect()->route('dashboard.shipping_company_owners.show', $shippingCompanyOwner);
    }

    /**
     * @param ShippingCompanyOwner $shippingCompanyOwner
     * @param ShippingCompany $shippingCompany
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(ShippingCompanyOwner $shippingCompanyOwner, ShippingCompany $shippingCompany)
    {
        $shippingCompanyPrice = $shippingCompany->ShippingCompanyPrices()->first();

        $price = $shippingCompanyPrice->price;

        $city_id = $shippingCompanyPrice->City()->first()->id;

        $price = (float) $price;

        return view('accounts::shipping_companies.edit', compact('shippingCompanyOwner', 'shippingCompany', 'price', 'city_id'));
    }

    /**
     * @param ShippingCompanyRequest $request
     * @param ShippingCompanyOwner $shippingCompanyOwner
     * @param ShippingCompany $shippingCompany
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ShippingCompanyRequest $request, ShippingCompanyOwner $shippingCompanyOwner, ShippingCompany $shippingCompany)
    {
        $this->repository->updateShippingCompany($shippingCompany, $request->all());

        flash(trans('accounts::shipping_companies.messages.updated'));

        return redirect()->route('dashboard.shipping_company_owners.show', $shippingCompanyOwner);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy(ShippingCompanyOwner $shippingCompanyOwner, ShippingCompany $shippingCompany)
    {
        $this->repository->deleteShippingCompany($shippingCompany);

        flash(trans('accounts::shipping_companies.messages.deleted'));

        return redirect()->route('dashboard.shipping_company_owners.show', $shippingCompanyOwner);
    }
}
