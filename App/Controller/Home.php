<?php namespace App\Controller;

class Home
{
    public function indexAction()
    { 
        echo '<button type="button" onclick="alert(\'Clicky!\')">Click me</button>';
    }
}