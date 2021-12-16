<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Task;

class TaskFactory extends Factory
{
    protected $model = Task::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $done = $this->faker->randomElement([true, false]);

        return [
            'task_name'   => $this->faker->sentence(3),
            'description' => $this->faker->text(),
            'done'        => $done,
            'done_at'     => ($done == true) ? $this->faker->dateTime('now', 'Asia/Manila') : null,
        ];
    }
}
