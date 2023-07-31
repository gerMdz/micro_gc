<?php

namespace App\Services;

use App\Models\Autor;
use App\Traits\ConsumerServiciosExternos;

class AutorService
{
    use ConsumerServiciosExternos;

    /**
     * @var string
     */
    public $baseUri;

    public function __construct()
    {
        $this->baseUri = config('services.autores.base_uri');
    }

    /**
     * @return string
     */
    public function getAutores(): string
    {
        return $this->realizarRequest('GET', '/autores');
    }

    /**
     * @param $request
     * @return string
     */
    public function altaAutor($request): string
    {
        return $this->realizarRequest('POST', '/autores', $request);
    }

    /**
     * @param $autor
     * @return string
     */
    public function getAutor($autor): string
    {
        return $this->realizarRequest('GET', "/autores/{$autor}");
    }

    public function borraAutor($autor): string
    {
        return $this->realizarRequest('DELETE', "/autores/{$autor}");
    }

    public function modificaAutor(array $all, int $autor): string
    {
        return $this->realizarRequest('PUT', "/autores/{$autor}", $all);
    }


}
