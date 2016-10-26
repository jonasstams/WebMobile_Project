<?php
interface ICustomerRepository
{
    public function findAll();
    public function findCustomerById($id);
    public function findHabitsFromCustomerById($id);
    public function addCustomer($customer);
}