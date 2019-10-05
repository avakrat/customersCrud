<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerStoreRequest;
use App\Repositories\CustomerRepositoryInterface;
use App\Http\Resources\CustomerResource;
use App\Http\Resources\CustomerCollection;



class CustomerController extends Controller
{
    protected $customer;

    /**
     * Constructor.
     *
     * @param CustomerRepositoryInterface $customer
     */
    public function __construct(CustomerRepositoryInterface $customer)
    {
        $this->customer = $customer;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->customer->all();
        return new CustomerCollection($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CustomerStoreRequest $request)
    {
        //return response()->json(null);
        $validated = $request->validated();
        $customer = $this->customer->store($request);
        return new CustomerResource($customer);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id,CustomerStoreRequest $request)
    {
        $validated = $request->validated();
        $customer = $this->customer->update($id,$request);
        return new CustomerResource($customer);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->customer->delete($id);
        return response()->json(null, 204);
    }
}
