<?php
use Illuminate\Database\Seeder;

class initSeed extends Seeder{
    public function run(){

        \App\Model\Groups::create(['name'=>"SuperAdmin",'status'=>1]);
        \App\Model\Groups::create(['name'=>"Editor",'status'=>1]);
        \App\Model\GroupPerms::create(['group_id'=>1,'controller'=>null,'action'=>null]);


        $user = new \App\User();
        $user->name = "Ertil";
        $user->surname = "Gani";
        $user->email = "ertil@prima-posizione.it";
        $user->password = bcrypt("admin");
        $user->status = 1;
        $user->save();

        \App\Model\UserGroup::create(['user_id'=>1,'group_id'=>1]);

        \App\Model\Report::create(['website_id'=>1, 'user_id'=>1]);
    }
}