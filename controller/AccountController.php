<?php

class AccountController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->login();
    }
    public function login()
    {
        $this->render("login");
    }
    public function suscribe()
    {
        $this->render("suscribe");
    }
}
