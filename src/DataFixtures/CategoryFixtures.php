<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Repository\PostRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class CategoryFixtures extends Fixture implements DependentFixtureInterface
{

    public function __construct(
        private PostRepository $postRepository
    ){
    }
    public function load(ObjectManager $manager): void
    {
        $categories = [];
        $faker = Factory::create('fr_FR');
        for($i=0; $i < 10; $i++){
            $category = new Category();
            $category->setName($faker->words(1, true))
                     ->setDescription(
                        mt_rand(0, 1) === 1 ? $faker->realText(254) : null
                     );
            $manager->persist($category);
            $categories[] = $category;
            
        }
        $posts = $this->postRepository->findAll();
        foreach ($posts as $post){
            $post->addCategory(
                $categories[mt_rand(0, count($categories) -1)]
            );
        }
        $manager->flush();
    }
    public function getDependencies(): array
    {
        return [PostFixtures::class];
    }
}
