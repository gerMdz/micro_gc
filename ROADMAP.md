### Lumen, Microservicios y Laravel

#### Data

Cap. 3 - Código fuente [1](https://www.udemy.com/course/microservicios-con-lumen-una-arquitectura-orientada-a-servicios/learn/lecture/12176980#overview)


Cap. 6 - Generar string aleatorio [2](http://www.unit-conversion.info/texttools/random-string-generator/)

Cap. 16 - PUT application/x-www-form-urlencoded [16](https://www.udemy.com/course/microservicios-con-lumen-una-arquitectura-orientada-a-servicios/learn/lecture/12177192#overview)


#### Acciones

Habilitar en bootstrap/app.php sacando los comentarios de las siguientes líneas

```php
- //$app->withFacades();
- //$app->withEloquent();
+ $app->withFacades();
+ $app->withEloquent();
```

Generar APP_KEY
[Unit-Conversion](http://www.unit-conversion.info/texttools/random-string-generator/)

Agregar passport

```bash
composer require dusterio/lumen-passport
```


Habilitar en bootstrap/app.php sacando los comentarios de las siguientes líneas

```php
// $app->register(App\Providers\AppServiceProvider::class);
$app->register(App\Providers\AuthServiceProvider::class);
// $app->register(App\Providers\EventServiceProvider::class);
$app->register(Laravel\Passport\PassportServiceProvider::class);
$app->register(Dusterio\LumenPassport\PassportServiceProvider::class);
```
Tuve que modificar 2 métodos en los vendors. Muy mala práctica.

primero 
```bash
composer require laminas/laminas-diactoros
```

Luego en el vendor cambiar 2 líneas
vendor/dusterio/lumen-passport/src/Http/Controllers/AccessTokenController.php

> -- use Zend\Diactoros\Response as Psr7Response;
>
> ++ use Laminas\Diactoros\Response as Psr7Response;
> 
> -- $tokenId = $this->jwt->parse($payload['access_token'])->getClaim('jti');
> 
> ++ $tokenId = $this->jwt->parse($payload['access_token'])->claims()->get('jti');


##### Next
[Final](https://www.udemy.com/course/microservicios-con-lumen-una-arquitectura-orientada-a-servicios/learn/lecture/12176648#overview)

