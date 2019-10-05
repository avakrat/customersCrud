<?php

namespace App\Repositories;

interface CustomerRepositoryInterface {
    /**
     * Get customer by id
     *
     * @param int
     */
    public function get($customer_id);

    /**
     * Get all customers.
     *
     * @return mixed
     */
    public function all();

    /**
     * Delete a record
     *
     * @param int
     */
    public function delete($customer_id);

    /**
     * Update existing record
     *
     * @param int
     * @param array
     */
    public function update($customer_id, array $data);

    /**
     * Store New
     *
     * @param array
     */
    public function store(array $data);
}