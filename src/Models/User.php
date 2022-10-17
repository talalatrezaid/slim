<?php

namespace App\Models;

use \PDO;
use Selective\Database\Connection;
use DomainException;

class User
{
    // get all users
    public function get_users($conn)
    {
        $query = $conn->select()->from('users');

        $query->columns(['id', 'first_name','last_name', 'email']);

        $row = $query->execute()->fetch() ?: [];

        // if(!$row) {
        //     throw new DomainException(sprintf('User not found'));
        // }
        return $row;

    }

    // inser user
    public function insert_user($connection,$user)
    {
        $connection->insert()
        ->into('users')
        ->set($user)
        ->execute();
       return  $userId = $connection->lastInsertId();

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