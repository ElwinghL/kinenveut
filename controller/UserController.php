<?php

class UserController extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        $this->render('index');
    }
}
