<?php

namespace App\Service;

class CarModelDetector
{
    private array $carModels = [
        'Audi' => [
            'Q2',
            'Q3',
            'SQ5',
            'Q5',
            'SQ7',
            'Q7',
            'Q8',
            'R8',
            'Rs3',
            'Rs4',
            'Rs5',
            'Rs7',
            'S3',
            'S4 Avant',
            'S4 Cabriolet',
            'Cabriolet',
            'S4',
            'S5',
            'S7',
            'S8',
            'Tts',
            'Tt',
            'V8',
        ],
        'BMW' => [
            'M3',
            'M4',
            'M535',
            'M5',
            'M635',
            'M6',
            'Serie 1',
            'Serie 2',
            'Serie 3',
            'Serie 4',
            'Serie 5',
            'Serie 6',
            'Serie 7',
            'Serie 8',
        ],
        'Citroen' => [
            'C15',
            'C1',
            'C25TD',
            'C25D',
            'C25E',
            'C25',
            'C2',
            'C3 Aircross',
            'C3 Picasso',
            'C3',
            'C4 Picasso',
            'C4',
            'C5',
            'C6',
            'C8',
            'Ds3',
            'Ds4',
            'Ds5',
        ],
    ];

    public function detectCarModel(string $modelSent): array
    {
        $result = array();

        $carModels = $this->carModels;

        // lower case + remove all whitespaces
        $modelSent = strtolower(str_replace(' ', '', $modelSent));

        // remove accents
        $modelSent = $this->removeAccents($modelSent);

        foreach ($carModels as $brand => $models) {
            foreach ($models as $model) {
                if (strpos($modelSent, strtolower(str_replace(' ', '', $model))) !== false) {
                    $result['brand'] = $brand;
                    $result['model'] = $model;
                    break;
                }
            }
        }

        return $result;
    }

    public function removeAccents(string $str): string
    {
        $search  = array('À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ù', 'Ú', 'Û', 'Ü', 'Ý', 'à', 'á', 'â', 'ã', 'ä', 'å', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ð', 'ò', 'ó', 'ô', 'õ', 'ö', 'ù', 'ú', 'û', 'ü', 'ý', 'ÿ');
        $replace = array('A', 'A', 'A', 'A', 'A', 'A', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U', 'U', 'Y', 'a', 'a', 'a', 'a', 'a', 'a', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'o', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'y', 'y');

        $varMaChaine = str_replace($search, $replace, $str);
        return $varMaChaine;
    }
}