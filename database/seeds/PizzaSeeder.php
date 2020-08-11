<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class PizzaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pizzas')->insert([
            'title' => 'TROPICAL HAWAIIAN',
            'description' => 'Grab your floral shirt and dip in - Don\'t let anyone tell you it isn\'t amazing. This taste of the tropics brings together sweet pineapple, bacon crumble, bacon strips, and mozzarella cheese for a beach vacation on Flavour Island!',
            'price' => '1329',
            'picture' => 'picture1.jpg',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('pizzas')->insert([
            'title' => 'BUFFALO CHICKEN',
            'description' => 'All the Zing, without the wing - This tangy, spicy pie is made for Game Day. Kick off with Buffalo blue cheese sauce, grilled chicken, red onions, fire-roasted red peppers and mozzarella cheese.',
            'price' => '1329',
            'picture' => 'picture2.jpg',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('pizzas')->insert([
            'title' => 'CHIPOTLE CHICKEN',
            'description' => 'Smoky, zesty and bold - This Southwest-style flavor-bomb is set off with smoky chipotle sauce, then topped with chipotle chicken, zesty red onions, and melty mozzarella. Me gusta?',
            'price' => '1169',
            'picture' => 'picture3.jpg',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('pizzas')->insert([
            'title' => 'CHICKEN BRUSCHETTA',
            'description' => 'A Twist on Italian Taste - What can make bruschetta better? How about grilled chicken? Add roasted garlic, Italiano Blend Seasoning, parmesan and mozzarella, and it\'s molto deliziosa.',
            'price' => '1479',
            'picture' => 'picture4.jpg',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('pizzas')->insert([
            'title' => 'SWEET HEAT',
            'description' => 'A fiery bite with a sweet twist - Sometimes opposites attract and make sweet, spicy magic! Trust us, the combo of grilled chicken, pineapple, hot banana peppers and mozzarella cheese is totally amazing.',
            'price' => '1132',
            'picture' => 'picture6.jpg',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('pizzas')->insert([
            'title' => 'CANADIAN EH!',
            'description' => 'True north delicious - As Canadian as a toque on a moose. Pepperoni, fresh mushrooms, bacon crumble and 100% Canadian Dairy mozzarella cheese.',
            'price' => '1219',
            'picture' => 'picture7.jpg',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('pizzas')->insert([
            'title' => 'CLASSIC SUPER',
            'description' => 'The Pizza Pizza original - A staple since 1967, this one never goes out of style! A classic combo of pepperoni, fresh mushrooms, green peppers, and mozzarella cheese.',
            'price' => '1219',
            'picture' => 'picture8.jpg',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('pizzas')->insert([
            'title' => 'SAUSAGE MUSHROOM MELT',
            'description' => 'Creamy, dreamy and melty - Meet your dream pizza: rich, tasteful and?savoury. Made with creamy garlic sauce, spicy Italian sausage, fresh mushrooms, Italiano blend seasoning, and ooey-gooey mozzarella cheese.',
            'price' => '1069',
            'picture' => 'picture9.jpg',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('pizzas')->insert([
            'title' => 'SPICY BBQ CHICKEN',
            'description' => 'Saddle up for a slice - It\'s a showdown at Flavour Corral, with grilled chicken, hot banana peppers, red onions, Texas BBQ sauce and mozzarella cheese. Wanna amp it up even more? Add Frank\'s Red Hot!',
            'price' => '1329',
            'picture' => 'picture10.jpg',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
