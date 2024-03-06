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
    /**
     * @var string
     */
    private $secret;

    public function __construct()
    {
        $this->baseUri = config('services.libros.base_uri');
        $this->secret = config('services.libros.secret');
    }

    /**
     * @return string
     */
    public function getLibros(): string
    {
        return $this->realizarRequest('GET', '/libros');
    }

    /**
     * @param $request
     * @return string
     */
    public function altaLibro($request): string
    {
        return $this->realizarRequest('POST', '/libros', $request);
    }

    /**
     * @param $libro
     * @return string
     */
    public function getLibro($libro): string
    {
        return $this->realizarRequest('GET', "/libros/{$libro}");
    }

    public function borraLibro($libro): string
    {
        return $this->realizarRequest('DELETE', "/libros/{$libro}");
    }

    public function modificaLibro(array $all, int $libro): string
    {
        return $this->realizarRequest('PUT', "/libros/{$libro}", $all);
    }


}

