<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Product;

class ProductFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $product = new Product();
        $product->setName('IWI Jericho 941 9mm gun');
        $product->setDescription('Great pistol!');
        $product->setPrice(9000);
        $product->setAvailable(true);
        $manager->persist($product);

        $product = new Product();
        $product->setName('AK-47 Kalashnikov gun');
        $product->setDescription('Legendary rifle.');
        $product->setPrice(11000.99);
        $product->setAvailable(false);
        $manager->persist($product);

        $product = new Product();
        $product->setName('M1 Abrams tank');
        $product->setDescription('I want one.');
        $product->setPrice(2500000.03);
        $product->setAvailable(true);
        $manager->persist($product);

        $manager->flush();
    }
}
