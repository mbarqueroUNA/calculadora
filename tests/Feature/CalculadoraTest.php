<?php

namespace Tests\Feature;

use Tests\TestCase;

class CalculadoraTest extends TestCase
{
    #[\PHPUnit\Framework\Attributes\Test]
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

    

    public function test_cp01_suma_correcta()
    {
        $response = $this->post('/calcular', [
            'a' => 3,
            'b' => 4,
            'op' => 'sumar'
        ]);

        $response->assertStatus(200);
        $response->assertSeeText('Resultado: 7');
    }

    public function test_cp01_1_suma_iccorrecta()
    {
        $response = $this->post('/calcular', [
            'a' => 3,
            'b' => 3,
            'op' => 'sumar'
        ]);

        $response->assertStatus(200);
        $response->assertSeeText('Resultado: 7');
    }


    #[\PHPUnit\Framework\Attributes\Test]
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
        $response->assertStatus(200);
        $response->assertSeeText('Resultado: 10');
    }

    /** @test */
    /**public function cp06_rechaza_solicitud_sin_token_csrf()
    {
        // Simulamos un POST sin token CSRF
        $response = $this->call('POST', '/calcular', [
            'a' => 5,
            'b' => 5,
            'op' => 'sumar'
        ], [], [], [
            'HTTP_REFERER' => 'http://localhost/calcular',
        ]);

        $response->assertStatus(419); // Laravel responde 419 cuando falta el token
    }*/
}
