<?php

namespace App\Models;

use \PDO;
use Selective\Database\Connection;
use DomainException;

class Customer
{
    // get all customers
    public function get_customers($conn)
    {
        $query = $conn->select()->from('customers');

        $query->columns(['id', 'first_name','last_name', 'email']);

        $row = $query->execute()->fetch() ?: [];

        // if(!$row) {
        //     throw new DomainException(sprintf('customer not found'));
        // }
        return $row;

    }

    // inser customer
    public function insert_customer($connection,$customer)
    {
        $connection->insert()
        ->into('customers')
        ->set($customer)
        ->execute();
       return  1;

    }

    //// update user
    public function update_user($connection,$user,$id)
    {
        if($connection->update()
        ->table('users')
        ->set($user)
        ->where('id', '=', $id)
        ->execute())
        {
            return 1;
        }
        else{
            return 0;
        }
    }
    
    //permenantly delete user
    public function delete_user($connection,$user_id)
    {

       if($connection->delete()->from('users')->where('id', '=', $user_id)->execute())
       {
        return 1;
       }
       else{
        return 0;
       }

    }
    
}