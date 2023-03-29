<?php
namespace App\Service;
use PHPUnit\Framework\TestCase;
class CarModelDetectorTest extends TestCase
{
    public function testDefault()
    {
        $carModelDetector = new CarModelDetector();
        $result = $carModelDetector->detectCarModel("rs4 avant");
        $this->assertSame("Audi", $result['brand']);
        $this->assertSame("Rs4", $result['model']);

        $result = $carModelDetector->detectCarModel("Gran Turismo Série5");
        $this->assertSame("BMW", $result['brand']);
        $this->assertSame("Serie 5", $result['model']);

        $result = $carModelDetector->detectCarModel("ds 3 crossback");
        $this->assertSame("Citroen", $result['brand']);
        $this->assertSame("Ds3", $result['model']);

        $result = $carModelDetector->detectCarModel("CrossBack ds 3");
        $this->assertSame("Citroen", $result['brand']);
        $this->assertSame("Ds3", $result['model']);
    }
}