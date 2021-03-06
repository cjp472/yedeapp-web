<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = app(Faker\Generator::class);

        $avatars = [
            'https://fsdhubcdn.phphub.org/uploads/images/201710/14/1/s5ehp11z6s.png?imageView2/1/w/200/h/200',
            'https://fsdhubcdn.phphub.org/uploads/images/201710/14/1/Lhd1SHqu86.png?imageView2/1/w/200/h/200',
            'https://fsdhubcdn.phphub.org/uploads/images/201710/14/1/LOnMrqbHJn.png?imageView2/1/w/200/h/200',
            'https://fsdhubcdn.phphub.org/uploads/images/201710/14/1/xAuDMxteQy.png?imageView2/1/w/200/h/200',
            'https://fsdhubcdn.phphub.org/uploads/images/201710/14/1/ZqM7iaP4CR.png?imageView2/1/w/200/h/200',
            'https://fsdhubcdn.phphub.org/uploads/images/201710/14/1/NDnzMutoxX.png?imageView2/1/w/200/h/200',
        ];

        $users = factory(User::class)
        ->times(10)
        ->make()
        ->each(function ($user, $index) use ($faker, $avatars) {
            $user->avatar = $faker->randomElement($avatars);
        });
        
        // Make user model's hidden fields visible which can make it
        // manipulatable, then put them into an array.
        // $user_array = $users->makeVisible(['password', 'remember_token'])->toArray();
        // User::insert($user_array);

        foreach ($users as $user) {
            $user->save();
        }

        // Remake the first user's data
        $user = User::find(1);
        $user->name = 'Yede';
        $user->email = 'yedeapp@163.com';
        $user->phone = '18129835206';
        $user->avatar = 'https://fsdhubcdn.phphub.org/uploads/images/201710/14/1/ZqM7iaP4CR.png?imageView2/1/w/200/h/200';
        $user->save();
        $user->assignRole('Superadmin');        

        // Remake user 2 to 4 roles
        $user = User::find(2);
        $user->assignRole('Admin');

        $user = User::find(3);
        $user->assignRole('Writer');

        $user = User::find(4);
        $user->assignRole('Subscriber');
    }
}
