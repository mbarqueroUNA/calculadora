namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Services\CalculadoraService;

class OperacionTest extends TestCase
{
    public function test_suma_basica()
    {
        $calc = new CalculadoraService();
        $this->assertEquals(9, $calc->sumar(4, 5));
    }
}
