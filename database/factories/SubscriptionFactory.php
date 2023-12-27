<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Subscription;
use App\Models\User;
use App\Models\Subpage;


class SubscriptionFactory extends Factory
{
    protected $model = Subscription::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(), // Creates a User for each Subscription
            'subpage_id' => Subpage::factory(), // Creates a Subpage for each Subscription
        ];
    }
}
