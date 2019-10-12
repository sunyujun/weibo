<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class FollowersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();
        $user = $users->first();
        $user_id = $user->id;

        // ��ȡȥ���� ID Ϊ 1 �������û� ID ����
        $followers = $users->slice(1);
        $follower_ids = $followers->pluck('id')->toArray();

        // ��ע���� 1 ���û�����������û�
        $user->follow($follower_ids);

        // ���� 1 ���û�����������û�������ע 1 ���û�
        foreach ($followers as $follower) {
            $follower->follow($user_id);
        }
    }
}
