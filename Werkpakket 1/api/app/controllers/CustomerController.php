<?php

/**
 * Created by PhpStorm.
 * User: Jonas
 * Date: 8/10/2016
 * Time: 19:29
 */
require_once __DIR__.'/../core/Controller.php';
require_once __DIR__.'/../core/Database.php';
require_once __DIR__.'/../models/CustomerRepository.php';
require_once __DIR__.'/../models/ICustomerRepository.php';
require_once __DIR__.'/../views/CustomerView.php';
require_once __DIR__.'/../models/Customer.php';

class CustomerController extends Controller
{
    protected $customer;
    protected $repository;
    protected $view;


    public function __construct(ICustomerRepository $repository = null, CustomerView $view = null)
    {
        if($repository == null)
        {
            $this->repository = new CustomerRepository(Database::getDbConnection());
        }else{
            $this->repository = $repository;
        }
        $this->customer = new Customer();

        if($view == null)
        {
            $this->view = new CustomerView();
        }else{
            $this->view = $view;
        }

    }

    public function handleFindCustomerById($id)
    {
        $customer = $this->repository->findCustomerById($id);
        if($customer != null)
            $this->view->show(['data' => $customer->toArray()]);
        else
            $this->view->sendHttpNoContent();
    }
    
    public function handleFindAllCustomers()
    {
        $customers = $this->repository->findAll();
        if($customers != null)
            $this->view->show(['data' => $customers]);
        else
            $this->view->sendHttpNoContent();
    }

    public function handleCheckCustomerExists($id)
    {
        return $this->repository->checkCustomerExists($id);
    }
    
    public function handleAddCustomer($postData)
    {
        $customer = $this->decodeJson($postData);

        $customerAddResult = $this->repository->addCustomer($customer);

        if($customerAddResult['created']){
            $this->view->sendHttpCreated();
        }else{
            $this->view->sendHttpBadRequest($customerAddResult['error']);
        }
    }

    public function handleChangeCustomer($customerId,$putData)
    {
        $customerUpdateData = $this->decodeJson($putData);

        $customerChangeResult = $this->repository->changeCustomer($customerId, $customerUpdateData);
        
        if($customerChangeResult['changed']){
            $this->view->sendHttpAccepted();
        }else{
            $this->view->sendHttpBadRequest($customerChangeResult['error']);
        }
    }

    public function handleRemoveCustomer($customerId)
    {
       
         $customerRemoved = $this->repository->removeCustomer($customerId);
            if($customerRemoved)
                $this->view->sendHttpAccepted();
            else{
                $this->view->sendHttpBadRequest('No customer removed because no customer found with id: ' . $customerId);
        }
    }

    public function handleFindHabitsFromCustomerByCustId($id)
    {
        $habits = $this->repository->findHabitsFromCustomerById($id);
        if($habits != null)
            $this->view->show(['data' => $habits]);
        else
            $this->view->sendHttpNoContent();
    }
}