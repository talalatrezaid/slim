<?php

namespace App\Models;

use \PDO;
use Selective\Database\Connection;
use DomainException;

class Order
{
    // get all orders
    public function get_orders($conn,$date)
    {
        // $query = $conn->select()->from('orders')->join("customers","orders.customer_id","=","customers.id");
        $query = $conn->select()->from('orders');

        $query->columns(['orders.*', 'customers.full_name', 'customers.contact']);
        
        $query->join('customers', 'orders.customer_id', '=', 'customers.id');
      
        if(strlen($date)>0)
        {   

            $date2 = $date." 11:59:59";
            $date = $date." 00:00:00";
                $query->where("orders.date",">=",$date);
           $query->where("orders.date","<=",$date2);
        }
        $query->limit(50);
        $rows = $query->execute()->fetchAll() ?: [];
    
        return $rows;

    }

    public function get_total_orders($conn,$date)
    {
        // $query = $conn->select()->from('orders')->join("customers","orders.customer_id","=","customers.id");
        $query = $conn->select()->from('orders');

        $query->columns([$query->raw('count(*) AS orders_count')]);
        
        $query->join('customers', 'orders.customer_id', '=', 'customers.id');
      
        if(strlen($date)>0)
        {
            $date2 = $date." 11:59:59";
            $date = $date." 00:00:00";
                $query->where("orders.date",">=",$date);
           $query->where("orders.date","<=",$date2);
        }
        $rows = $query->execute()->fetchAll() ?: [];
        return $rows;

    }

    // inser order
    public function insert_order($connection,$order)
    {
        $connection->insert()
        ->into('orders')
        ->set($order)
        ->execute();
       return 1;

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