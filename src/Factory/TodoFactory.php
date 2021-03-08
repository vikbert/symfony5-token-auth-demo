<?php

namespace App\Factory;

use App\Entity\Todo;
use App\Repository\TodoRepository;
use JetBrains\PhpStorm\ArrayShape;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @method static Todo|Proxy createOne(array $attributes = [])
 * @method static Todo[]|Proxy[] createMany(int $number, $attributes = [])
 * @method static Todo|Proxy find($criteria)
 * @method static Todo|Proxy findOrCreate(array $attributes)
 * @method static Todo|Proxy first(string $sortedField = 'id')
 * @method static Todo|Proxy last(string $sortedField = 'id')
 * @method static Todo|Proxy random(array $attributes = [])
 * @method static Todo|Proxy randomOrCreate(array $attributes = [])
 * @method static Todo[]|Proxy[] all()
 * @method static Todo[]|Proxy[] findBy(array $attributes)
 * @method static Todo[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static Todo[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static TodoRepository|RepositoryProxy repository()
 * @method Todo|Proxy create($attributes = [])
 */
final class TodoFactory extends ModelFactory
{
    #[ArrayShape(['title' => "string", 'isDone' => "bool"])]
    protected function getDefaults(): array
    {
        return [
            'title' => self::faker()->realText(50),
            'isDone' => self::faker()->boolean(50),
        ];
    }

    protected static function getClass(): string
    {
        return Todo::class;
    }
}
