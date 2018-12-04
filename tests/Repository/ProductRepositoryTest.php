<?php

namespace App\Tests\Service;

use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Doctrine\Common\Collections\ArrayCollection;

class ProductRepositoryTest extends KernelTestCase
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $entityManager;

    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        $kernel = self::bootKernel();

        $this->entityManager = $kernel->getContainer()
            ->get('doctrine')
            ->getManager();
    }

    public function testFetchByPhraseInName_case1()
    {
        $products = $this->entityManager
            ->getRepository(Product::class)
            ->fetchByPhraseInName('gun')
        ;

        $this->assertInstanceOf(ArrayCollection::class, $products);
        $this->assertCount(2, $products);
    }

    public function testFetchByPhraseInName_case2()
    {
        $products = $this->entityManager
            ->getRepository(Product::class)
            ->fetchByPhraseInName('armor')
        ;

        $this->assertInstanceOf(ArrayCollection::class, $products);
        $this->assertCount(0, $products);
    }

    public function testFetchAvailable()
    {
        $products = $this->entityManager
            ->getRepository(Product::class)
            ->fetchAvailable()
        ;

        $this->assertInstanceOf(ArrayCollection::class, $products);
        $this->assertCount(2, $products);
    }

    public function testGetNotAvailableCount()
    {
        $productsCount = $this->entityManager
            ->getRepository(Product::class)
            ->getNotAvailableCount()
        ;

        $this->assertEquals(1, $productsCount);
    }

    /**
     * {@inheritDoc}
     */
    protected function tearDown()
    {
        parent::tearDown();

        $this->entityManager->close();
        $this->entityManager = null; // avoid memory leaks
    }
}
