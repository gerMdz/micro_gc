<?php

namespace App\Services;

use App\Traits\ConsumerServiciosExternos;

class AutorService
{
    use ConsumerServiciosExternos;

    /**
     * @var string
     */
    public  $baseUri;

    public function __construct()
    {
        $this->baseUri = config('services.autores.base_uri');
    }


}
