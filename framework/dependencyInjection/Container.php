<?php
declare(strict_types=1);

namespace MorenoGeneralProbeFrameWork\dependencyInjection;

use \ReflectionException;
use Psr\Container\ContainerInterface;

class Container implements ContainerInterface
{
    private array $entries = [];

    public function get(string $id)
    {
        if ($this->has($id)) {
            $entry = $this->entries[$id];
            if (is_callable($entry)) {
                return $entry($this);
            }
            $id = $entry;
        }
        return $this->resolve($id);
    }

    public function has(string $id): bool
    {

        return isset($this->entries[$id]);
    }

    public function set(string $id, callable|string $concrete)
    {
        $this->entries[$id] = $concrete;
    }

    /**
     * @throws ReflectionException
     */
    private function resolve(string $id)
    {
        $reflectionClass = new \ReflectionClass($id);
        if (!$reflectionClass->isInstantiable()) {
            throw new ContainerException("is not instantiable $id");
        }

        $constructor = $reflectionClass->getConstructor();
        if (!$constructor) {
            return new $id();
        }
        $parameters = $constructor->getParameters();
        if (!$parameters) {
            return new $id();
        }
        $dependencies = array_map(
            function (\ReflectionParameter $param) use ($id) {
                $name = $param->getName();
                $type = $param->getType();
                if (!$type) {
                    throw new ContainerException("cant resolve class $id no type for param $name");
                }

                if ($type instanceof \ReflectionUnionType) {
                    throw new ContainerException("cant resolve class $id ReflectionUnionType is not supported $name");
                }
                if ($type instanceof \ReflectionNamedType && !$type->isBuiltin()) {
                    return $this->get($type->getName());
                }
                throw new ContainerException("cant resolve class $id because invalid param $name");

            }
            , $parameters);
        return $reflectionClass->newInstanceArgs($dependencies);
    }

}
