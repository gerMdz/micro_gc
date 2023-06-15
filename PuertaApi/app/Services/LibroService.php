<?php

namespace App\Services;

use App\Traits\ConsumerServiciosExternos;

class LibroService
{
    use ConsumerServiciosExternos;

    /**
     * @var string
     */
    public  $baseUri;

    public function __construct()
    {
        $this->baseUri = config('services.libros.base_uri');
    }


}
