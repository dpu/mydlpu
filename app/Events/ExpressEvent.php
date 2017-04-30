<?php

namespace App\Events;

use App\Models\Express;
use Illuminate\Queue\SerializesModels;

class ExpressEvent extends Event
{
    use SerializesModels;

    public $express;

    public function __construct(Express $express)
    {
        $this->express = $express;
    }

}
