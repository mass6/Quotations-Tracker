<?php namespace Acme\Repositories;

use Quotation;

class DbQuote implements MyInterface {

    public function getAll()
    {
        return Quotation::all()->take(3);
    }

} 