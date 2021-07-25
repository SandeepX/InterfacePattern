<?php


namespace App\Repository;


use App\Models\User;
use App\UserInterface\UserInterface;

class UserRepositories implements UserInterface
{
    public function getAllUsers()
    {
      return User::paginate(15);
    }

    public function store($validatedData)
    {
        $validatedData['password'] = bcrypt($validatedData['password']);
       return User::create($validatedData);
    }

    public function findByUserId($Id){
        return User::findOrfail($Id);
    }

    public function update($data){
        return true;
    }

    public function changeStatus($validatedData,$status)
    {
        $data = $validatedData->update([
            'status' => $status
        ]);
        return $status;

    }

}
