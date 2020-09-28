<?php

class AuctionController extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        $this->render("index");
    }
    public function myAuction()
    {
        $this->render("myAuction");
    }
    
    public function alerte()
    {
        $this->render("alerte");
    }
}
