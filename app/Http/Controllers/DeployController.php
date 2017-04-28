<?php

namespace App\Http\Controllers;

class DeployController extends Controller
{

    public function deploy()
    {
        $target = base_path( '/deploy.sh' );
        echo exec("sh $target");
    }
}
