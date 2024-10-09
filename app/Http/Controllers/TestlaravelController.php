<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase\Database;
class TestlaravelController extends Controller
{
    public function __construct(Database $database)
    {
        
    }
    public function index(Database $database){
        $fac = $database->getReference('Facility')->getValue();
        return('');
    }
}
