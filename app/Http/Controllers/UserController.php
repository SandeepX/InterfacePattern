<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserStoreRequest;
use App\Models\User;
use App\UserInterface\UserInterface;


class UserController extends Controller
{
    public $user;
    public function __construct(UserInterface $user){
        $this->user = $user;
    }

    public function store(UserStoreRequest $request)
    {
        try{
            $validatedData = $request->validated();
            $data = $this->user->store($validatedData);
            return redirect()->back()->with('status','User Created Successfully');

        }catch(\Exception $exception){
            return redirect()->back()->with('status',$exception->getMessage());
        }
    }

    public function update($userId)
    {
        try{
            $user = $this->user->findByUserId($userId);
            return $this->user->update($user);

         }catch(\Exception $exception){
            return redirect()->back()->with('status',$exception->getMessage());
        }
    }

    public function changeStaus($userId)
    {
        try{
            $userData = $this->user->findByUserId($userId);          ;
            if($userData['status'] == 'active'){
                $status = 'inactive';
            }else{
                $status = 'active';
            }
            return $this->user->changeStatus($userData,$status);
        }catch(\Exception $exception){
            return redirect()->back()->with('status',$exception->getMessage());
        }
    }
}
