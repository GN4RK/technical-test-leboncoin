<?php
namespace App\Service;
use PHPUnit\Framework\TestCase;
class CarModelDetectorTest extends TestCase
{
    public function testDefault(): void
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

        $authorisedAudiModels = [
            "Cabriolet", "Q2", "Q3", "Q5", "Q7", "Q8", "R8", "Rs3", "Rs4", "Rs5", "Rs7", "S3", "S4", "S4 Avant",
            "S4 Cabriolet", "S5", "S7", "S8", "SQ5", "SQ7", "Tt", "Tts", "V8"
        ];
        $authorisedBMWModels = [
            "M3", "M4", "M5", "M535", "M6", "M635", "Serie 1", "Serie 2", "Serie 3", "Serie 4", "Serie 5",
            "Serie 6", "Serie 7", "Serie 8"
        ];
        $authorisedCitroenModels = [
            "C1", "C15", "C2", "C25", "C25D", "C25E", "C25TD", "C3", "C3 Aircross", "C3 Picasso", "C4",
            "C4 Picasso", "C5", "C6", "C8", "Ds3", "Ds4", "Ds5"
        ];

        $inputAudi = [
            "cabriolet", "q2", "q3", "q5", "q7", "q8", "r8", "rs3", "rs4", "rs5", "rs7", "s3", "s4", "s4 avant",
            "s4 cabriolet", "s5", "s7", "s8", "sq5", "sq7", "tt", "tts", "v8"
        ];
        $inputBMW = [
            "m3", "m4", "m5", "m535", "m6", "m635", "serie 1", "serie 2", "serie 3", "serie 4", "serie 5",
            "serie 6", "serie 7", "serie 8"
        ];
        $inputCitroen = [
            "c1", "c15", "c2", "c25", "c25d", "c25e", "c25td", "c3", "c3 aircross", "c3 picasso", "c4",
            "c4 picasso", "c5", "c6", "c8", "ds3", "ds4", "ds5"
        ];

        for ($i = 0; $i < count($inputAudi); $i++) {
            $result = $carModelDetector->detectCarModel($inputAudi[$i]);
            $this->assertSame("Audi", $result['brand']);
            $this->assertSame($authorisedAudiModels[$i], $result['model']);
        }

        for ($i = 0; $i < count($inputBMW); $i++) {
            $result = $carModelDetector->detectCarModel($inputBMW[$i]);
            $this->assertSame("BMW", $result['brand']);
            $this->assertSame($authorisedBMWModels[$i], $result['model']);
        }

        for ($i = 0; $i < count($inputCitroen); $i++) {
            $result = $carModelDetector->detectCarModel($inputCitroen[$i]);
            $this->assertSame("Citroen", $result['brand']);
            $this->assertSame($authorisedCitroenModels[$i], $result['model']);
        }
    }
}