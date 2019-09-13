<?php

use Illuminate\Database\Seeder;
use App\Domain\File\Entities\File;

class FilesTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   * @return void
   */
  public function run()
  {
    factory(File::class)->create(
      [
        'id' => 1,
        'name' => 'Diploma'
      ]
    );

    factory(File::class)->create(
      [
        'id' => 2,
        'name' => 'Conclusão de Residencia'
      ]
    );

    factory(File::class)->create(
      [
        'id' => 3,
        'name' => 'Anuidade CRM'
      ]
    );

    factory(File::class)->create(
      [
        'id' => 4,
        'name' => 'Carteira do CRM'
      ]
    );

    factory(File::class)->create(
      [
        'id' => 5,
        'name' => 'RG'
      ]
    );

    factory(File::class)->create(
      [
        'id' => 6,
        'name' => 'CPF'
      ]
    );

    factory(File::class)->create(
      [
        'id' => 7,
        'name' => 'Currículo'
      ]
    );

    factory(File::class)->create(
      [
        'id' => 8,
        'name' => 'Carta de Apresentação'
      ]
    );

    factory(File::class)->create(
      [
        'id' => 9,
        'name' => 'Formulário de Estacionamento'
      ]
    );

    factory(File::class)->create(
      [
        'id' => 10,
        'name' => 'Foto 3x4'
      ]
    );
  }
}
