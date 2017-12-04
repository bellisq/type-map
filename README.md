# Bellisq Type Map

## What is the Type Map?
```php
namespace Bellisq\TypeMap;

interface TypeMapInterface
{

    public function get(string $type);
    public function has(string $type): bool;

}
```

It looks like the `PSR-11 Container Interface`. Compared to the `PSR-11`, type map has typehints for each argument and return value and both functions receive `$type` instead of `$id`. The argument `$type` requires the fully-qualified-class-name like `Bellisq\TypeMap\TypeMapInterface`.

## Install
This package has not been registered to packagist yet.

# Branches
Type map has three derived interfaces: `Container`, `Instantiator` and `TypeMapAggregation`.

```php
namespace Belisq\TypeMap;

interface ContainerInterface extends TypeMapInterface { }
interface InstantiatorInterface extends TypeMapInterface { }
interface TypeMapAggregationInterface extends TypeMapInterface { }
```

A container knows what types of objects it can return. In other words a conteiner has the list of objects it can return. In contast an instantiator doesn't know that. So, an instantiator will check the existence of the `$type` given as an argument and check if it is possible to instantiate the `$type`.

An aggregation holds multiple type maps. It delegates `get` method and `has` method to type maps which it holds.

## DI Instantiator
```php
use Bellisq\TypeMap\DI\DIInstantiator;
use Some\Foo\ClassA;
use Some\Bar\ClassB;

class YourClass {
    public function __construct(ClassA $ca, ClassB $cb) { }
}

$typeMap = new YourTypeMap; // This type map supports ClassA and ClassB.
$diInstantiator = new DIInstantiator($typeMap);

$diInstantiator->get(YourClass::class);     // returns an instance of YourClass
```

`DIInstantiator` instantiates various classes completing arguments of those constructors automatically.

## DI Container
### Prepare Providers
```php
use Bellisq\TypeMap\DI\ProviderInterface;
use Bellisq\TypeMap\DI\Registers\ObjectRegister;

use Path\To\YourClass;
use Some\Foo\ClassA;

class YourClassProvider implements ProviderInterface {
    public static function registerObjects(ObjectRegister $or) {
        $or->register(YourClass::class);
    }

    private $ca;
    public function __construct(ClassA $ca) {
        $this->ca = $ca;
    }
    public function getInstance(string $type) {
        if($type === YourClass::class) {
            return new YourClass($this->ca);
        }
    }
}
```

### Prepare Container
```php
use Bellisq\TypeMap\DI\DIContainer;
use Bellisq\TypeMap\DI\Registers\ProviderRegister;

use Path\To\YourClassProvider;
use Some\Foo\ClassAProvider;

class YourDIContainer extends DIContainer {
    public function registerProviders(ProviderRegister $pr) {
        $pr->register(YourClassProvider::class)
           ->register(ClassAProvider::class);
    }
}
```

### Use Container
```php
$dc = new YourDIContainer;
$dc->get(YourClass::class);
```

In this case the container automatically solved the dependency between `YourClass`(`YourClassProvider`) and `ClassA`. The container instantiated `ClassA` first and injected an instance of `ClassA` into `YourClassProvider`.