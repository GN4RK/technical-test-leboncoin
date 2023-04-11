<?php

namespace App\Tests\Entity;

use App\Entity\Ad;
use App\Entity\AdAuto;
use PHPUnit\Framework\TestCase;

class AdAutoTest extends TestCase
{
    private Ad $ad;
    private AdAuto $adAuto;
    
    public function setUp(): void
    {
        $this->ad = new Ad();
        $this->adAuto = new AdAuto();
        $this->ad->setAdAuto($this->adAuto);
    }

    public function testId(): void
    {
        $this->assertNull($this->ad->getId());
    }

    public function testTitle(): void
    {
        $this->ad->setTitle("test");
        $this->assertSame("test", $this->ad->getTitle());
    }

    public function testContent(): void
    {
        $this->ad->setContent("Content");
        $this->assertSame("Content", $this->ad->getContent());
    }

    public function testAdAuto(): void
    {
        $this->assertSame($this->adAuto, $this->ad->getAdAuto());
    }

    public function testBrand(): void
    {
        $this->adAuto->setBrand("Brand");
        $this->assertSame("Brand", $this->adAuto->getBrand());
    }

    public function testModel(): void
    {
        $this->adAuto->setModel("Model");
        $this->assertSame("Model", $this->adAuto->getModel());
    }

    public function testAutoId(): void
    {
        $this->assertNull($this->adAuto->getId());
    }
}