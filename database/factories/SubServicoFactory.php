<?php

namespace Database\Factories;


use App\Models\SubServico;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SubServico>
 */
class SubServicoFactory extends Factory
{
    protected $model = SubServico::class;
    private $currentImageIndex = 0;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $imageFiles = [
            'Burst_Fade_Haircut.png',
            'Buzz_Cut_Fade.png',
            'Comb_Over_Taper_Fade.png',
            'Cool_Short_Curly_Haircut_Drop_Fade.png',
            'Cornrow.png',
            'Crop_Haircut_Medium_Fade.png',
            'Double_Side_Part_Haircut.png',
            'High_Skin_Fade_Buzz_Cut.png',
            'Long_Curly_Hair_Fade.png',
            'Pompadour_Fade.png',
            'Quiff_Mid_Skin_Fade.png',
            'Short_Crop_Mid_Skin_Fade.png',
            'Short_Spiky_Quiff_Haircut_Beard.png',
            'Short_Textured_Haircut.png',
            'Slick_Back.png',
            'Textured_Crop_Mid_Skin_Fade.png',
            'Textured_Quiff_Meets_Pompadour_Haircut_Line_Up.png',
            'Top_Knot.png'
        ];

        $hours = str_pad($this->faker->numberBetween(0, 3), 2, '0', STR_PAD_LEFT); // Horas entre 00 e 03
        $minutes = str_pad($this->faker->numberBetween(0, 59), 2, '0', STR_PAD_LEFT); // Minutos entre 00 e 59
        $tempo_de_duracao = "$hours:$minutes";

        $selectedImage = $this->faker->randomElement($imageFiles);
        return [
            'name' => basename($selectedImage, '.png'), // Remove .png from the name
            'preco' => $this->faker->randomFloat(2, 10, 50),
            'tempo_de_duracao' => $tempo_de_duracao,
            'imagem' => "images/$selectedImage", // Directly store the relative path
            'servico_id' => $this->faker->numberBetween(1, 5),
        ];
    }
}
