<?php

namespace Database\Seeders;

use App\Models\Cartographer;
use Illuminate\Database\Seeder;

class CartographerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->create('Leonardo da Vinci', 'Italy', '1452–1519');
        $this->create('Willem Janszoon Blaeu', 'Netherlands', '1571–1638');
        $this->create('Johannes Blaeu', 'Netherlands', '1596–1673');
        $this->create('Gerardus Mercator', 'Netherlands', '1512–1594');
        $this->create('Waldo R. Tobler', 'United States', '1930–2018');
        $this->create('al-Idrisi', 'Sicily', '1100–1166');
        $this->create('Shen Kuo', 'China', '1031–1095');
        $this->create('Anaximander', 'Greek Anatolia', '610BC–546BC');
        $this->create('al-Khwārazmī', 'Persia', '780-850');
        $this->create('Sebastian Münster', 'Germany', '1488–1552');
        $this->create('Abraham Ortelius', 'France', '1527–1598');
        $this->create('Barbara Petchenik', 'United States', '1939–1992');
        $this->create('Johannes Janssonius', 'Netherlands', '1588–1664');
        $this->create('Johannes van Keulen', 'Netherlands', '1654–1715');
        $this->create('Johann Homann', 'Germany', '1664–1724');
        $this->create('Johannes Ruysch', 'Netherlands', '1466–1530');
        $this->create('Johannes Werner', 'Germany', '1466–1528');
        $this->create('Johannes Honterus', 'Transylvania', '1498–1549');
    }

    private function create(string $name, string $place, string $lifespan): Cartographer
    {
        return Cartographer::factory()->create([
            'name' => $name,
            'place' => $place,
            'lifespan' => $lifespan,
        ]);
    }
}
