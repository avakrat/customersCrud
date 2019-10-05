<?php 

namespace App\Repositories;
use App\Models\Customer;
use Carbon\Carbon;

class CustomerRepository implements CustomerRepositoryInterface {
    /**
     * Get customer by id
     *
     * @param int
     */
    public function get($customer_id) {
        return Customer::find($customer_id);
    }

    /**
     * Get all customers.
     *
     * @return mixed
     */
    public function all() {
        return Customer::all();
    }

    /**
     * Delete a record
     *
     * @param int
     */
    public function delete($customer_id) {
        Customer::findOrFail($customer_id)->delete();
    }

    /**
     * Update existing record
     *
     * @param int
     * @param array
     */
    public function update($customer_id, $data) {
        $customer = Customer::findOrFail($customer_id);
        $customer->email = $data->email;
        $customer->firstname = $data->firstname;
        $customer->lastname = $data->lastname;
        $customer->phone = $data->phone;
        $customer->save();
        return $customer;
    }

    /**
     * Store New
     *
     * @param array
     */
    public function store($data) {
        $customer = new Customer;
        $customer->email = $data->email;
        $customer->firstname = $data->firstname;
        $customer->lastname = $data->lastname;
        $customer->phone = $data->phone;
        $customer->regtime = Carbon::now()->timestamp;
        $customer->save();
        return $customer;
    }
}