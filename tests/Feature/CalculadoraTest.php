<?php

namespace Tests\Feature;

use Tests\TestCase;

class CalculadoraTest extends TestCase
{
    /** @test */
  public function cp02_multiplicacion_de_dos_numeros_negativos()
{
    $response = $this->post('/calcular', [
        'a' => -2,
        'b' => -5,
        'op' => 'multiplicar'
    ]);

    $response->assertStatus(200);
    $response->assertSeeText('Resultado: 10');
}

/** @test */
public function cp05_tiempo_de_respuesta_menor_a_1_segundo()
{
    $start = microtime(true);

    $response = $this->post('/calcular', [
        'a' => 5,
        'b' => 5,
        'op' => 'sumar'
    ]);

    $end = microtime(true);
    $duration = $end - $start;

    $this->assertLessThan(1, $duration, "La respuesta tardó más de 1 segundo.");
    $response->assertSeeText('Resultado: 10');
}

/** @test */
public function cp06_rechaza_solicitud_sin_token_csrf()
{
    $response = $this->call('POST', '/calcular', [
        'a' => 5,
        'b' => 5,
        'op' => 'sumar'
    ], [], [], [
        'HTTP_REFERER' => 'http://localhost/calcular',
    ]);

    $response->assertStatus(419); // Laravel devuelve 419 por CSRF inválido
}
}
