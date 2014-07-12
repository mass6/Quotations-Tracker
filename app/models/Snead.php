<?php

class Snead extends Eloquent implements SneadInterface {

    public function getAll()
    {
        return Quotation::all()->take(2);
    }


}