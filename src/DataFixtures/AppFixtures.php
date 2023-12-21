<?php

namespace App\DataFixtures;

use App\Entity\Brand;
use App\Entity\Car;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Provider\Fakecar;

class AppFixtures extends Fixture
{
    private const NB_CARS = 50;
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();
        $faker->addProvider(new Fakecar($faker));
        $brands = [];

        for($i = 0; $i<self::NB_CARS; $i++){
             // [ 'brand' => 'Hummer', 'model' => 'H1' ]
        $carBrandAndModel = $faker->vehicleArray;

        if(array_key_exists($carBrandAndModel['brand'], $brands)){
           $brand=$brands[$carBrandAndModel['brand']];
        } else {
            $brand = new Brand();
            $brand->setName($carBrandAndModel['brand']);
            $manager->persist($brand);
            $brands[$carBrandAndModel['brand']] = $brand; 

        }
        $car = new Car();
        $car
            ->setName($carBrandAndModel['model'])
            ->setYear($faker->numberBetween(1990, 2018))
            ->setDoorCount($faker->vehicleDoorCount)
            ->setFuelType($faker->vehicleFuelType)
            ->setNbKm($faker->numberBetween(20000,250000))
            ->setType($faker->vehicleType)
            ->setVisible($faker->boolean(75))
            ->setBrand($brand);

        $manager->persist($car);

        }
 
        $manager->flush();
    }
}
