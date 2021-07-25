<?php


namespace App\UserInterface;

interface UserInterface
{
    public function getAllUsers();
    public function store(array $validatedData);
    public function findByUserId($Id);
    public function update($data);
    public function changeStatus($validatedData,$status);
}
