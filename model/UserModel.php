<?php

class UserModel extends Model
{
    public function __construct()
	{
    }

    public function newUser($firstName, $lastName, $birthDate, $email, $password) {
        $request = db()->prepare("INSERT INTO Users(firstName, lastName, email, password, birthDate, isAdmin) VALUES (?, ?, ?, ?, ?, false)");
        $success = $request->execute(array($firstName, $lastName, $email, $password, $birthDate));
        return $success;
    }
}