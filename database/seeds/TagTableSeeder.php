<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/28
 * Time: 14:31
 */
use App\Tag;
use Illuminate\Database\Seeder;

class TagTableSeeder extends Seeder
{
    /**
     * Seed the tags table
     */
    public function run()
    {
        Tag::truncate();

        factory(Tag::class, 5)->create();
    }
}