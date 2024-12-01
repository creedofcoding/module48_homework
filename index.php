<?php

// Абстрактный класс "Машина"
abstract class Vehicle
{
    protected string $name;
    protected ?string $interior; // Элемент индивидуализма, может быть null
    public function __construct(string $name, ?string $interior = null)
    {
        $this->name = $name;
        $this->interior = $interior;
    }

    // Геттер для имени
    public function getName(): string
    {
        return $this->name;
    }

    // Общие методы для всех машин
    abstract public function moveForward(): void;
    abstract public function moveBackward(): void;

    // Полиморфная способность
    abstract public function specialAbility(): void;

    // Дополнительные способности
    public function honk(): void
    {
        echo "{$this->name} сигналит!\n";
    }

    public function wipers(): void
    {
        echo "{$this->name} включает дворники!\n";
    }

    // Показать индивидуальные особенности
    public function showInterior(): void
    {
        echo "{$this->name} имеет отделку салона: {$this->interior}.\n";
    }
}

// Интерфейс для машин с салоном
interface HasInterior
{
    public function showInterior(): void;
}

// Интерфейс для машин с дворниками
interface HasWipers
{
    public function wipers(): void;
}

// Класс "Легковая машина"
class Car extends Vehicle implements HasWipers, HasInterior
{
    public function __construct(string $name, string $interior)
    {
        parent::__construct($name, $interior);
    }

    public function moveForward(): void
    {
        echo "{$this->name} едет вперед.\n";
    }

    public function moveBackward(): void
    {
        echo "{$this->name} едет назад.\n";
    }

    public function specialAbility(): void
    {
        echo "{$this->name} использует закись азота!\n";
    }
}

// Класс "Бульдозер"
class Bulldozer extends Vehicle implements HasWipers, HasInterior
{
    public function __construct(string $name, string $interior)
    {
        parent::__construct($name, $interior);
    }

    public function moveForward(): void
    {
        echo "{$this->name} движется вперед с ковшом.\n";
    }

    public function moveBackward(): void
    {
        echo "{$this->name} движется назад с ковшом.\n";
    }

    public function specialAbility(): void
    {
        echo "{$this->name} управляет ковшом!\n";
    }
}

// Класс "Танк"
class Tank extends Vehicle
{
    public function moveForward(): void
    {
        echo "{$this->name} едет вперед, раздавливая препятствия.\n";
    }

    public function moveBackward(): void
    {
        echo "{$this->name} едет назад, поворачивая башню.\n";
    }

    public function specialAbility(): void
    {
        echo "{$this->name} стреляет из пушки!\n";
    }
}

// Функция для обработки машин
function operateVehicle(Vehicle $vehicle): void
{
    $vehicle->moveForward();
    $vehicle->moveBackward();
    $vehicle->specialAbility();
    $vehicle->honk();

    //проверка на наличие дворников
    if ($vehicle instanceof HasWipers) {
        $vehicle->wipers();
    } else {
        echo "{$vehicle->getName()} не имеет дворников.\n";
    }

    //проверка на наличие салона
    if ($vehicle instanceof HasInterior) {
        $vehicle->showInterior();
    } else {
        echo "{$vehicle->getName()} не имеет салона.\n";
    }
}

// Пример использования
$car = new Car("Легковая машина", "Кожаная обивка");
$bulldozer = new Bulldozer("Бульдозер", "Прочный металл");
$tank = new Tank("Танк");

echo "<pre>";
echo "=== Управление машинами ===\n";
operateVehicle($car);
echo "\n";
operateVehicle($bulldozer);
echo "\n";
operateVehicle($tank);
echo "</pre>";
