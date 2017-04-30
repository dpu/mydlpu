<?php

namespace App\DTO\Cet;

class CetScoresDTO
{
    public $name = '';

    public $school = '';

    public $type = '';

    /** @var CetScoresWrittenDTO $written */
    public $written = null;

    /** @var CetScoresOralDTO $oral */
    public $oral = null;

}
