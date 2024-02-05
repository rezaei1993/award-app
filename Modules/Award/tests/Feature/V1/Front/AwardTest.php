<?php

namespace Modules\Award\tests\Feature\V1\Front;

use Modules\Award\App\Models\Award;
use Modules\Award\App\Models\AwardUser;
use Modules\User\App\Models\User;
use Tests\TestCase;


class AwardTest extends TestCase
{
    public function testWhenUserDoesntHaveSufficientPoints()
    {
        User::factory()->create([
            'point' => 0
        ]);

        $res = $this->get(route('lucky-wheel'));
        $res->assertStatus(422);
    }

    public function testWhenUserHasSufficientPoints()
    {
        User::factory()->create([
            'point' => 20
        ]);
        Award::factory()->create([
            'inventory' => 1
        ]);
        $res = $this->get(route('lucky-wheel'));
        $res->assertStatus(200);
    }

    public function testWhenAwardIsEmpty()
    {
        $user = User::factory()->create([
            'point' => 20
        ]);
        Award::factory()->create([
            'title' => 'Empty'
        ]);
        $res = $this->get(route('lucky-wheel'));
        $res->assertStatus(200);
        $this->assertSame($res->json()['data'], [
            'title' => 'Empty'
        ]);

        $this->assertDatabaseHas(User::class, [
            'id' => $user->id,
            'point' => 20,
        ]);

        $this->assertDatabaseCount(AwardUser::class, 0);
    }


    public function testWhenAwardInventoryIsZero()
    {
        $user = User::factory()->create([
            'point' => 20
        ]);
        Award::factory()->create([
            'inventory' => 0
        ]);
        $res = $this->get(route('lucky-wheel'));
        $res->assertStatus(503);

        $this->assertDatabaseHas(User::class, [
            'id' => $user->id,
            'point' => 20,
        ]);

        $this->assertDatabaseCount(AwardUser::class, 0);
    }

    public function testWhenAwardInventoryIsNotZero()
    {
        $user = User::factory()->create([
            'point' => 20
        ]);

        $award = Award::factory()->create([
            'inventory' => 12
        ]);

        $res = $this->get(route('lucky-wheel'));
        $res->assertStatus(200);

        $this->assertDatabaseHas(User::class, [
            'id' => $user->id,
            'point' => 20 - config('award.points_to_deduct'),
        ]);

        $this->assertDatabaseHas(Award::class, [
            'id' => $award->id,
            'inventory' => 11,
        ]);

        $this->assertDatabaseHas(AwardUser::class, [
            'award_id' => $award->id,
            'user_id' => $user->id,
        ]);

        $this->assertDatabaseCount(AwardUser::class, 1);

        $this->assertSame($res->json()['data'], [
            'title' => $award->title
        ]);

    }
}
