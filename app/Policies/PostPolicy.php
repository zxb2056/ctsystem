<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Post;

class PostPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    public function update(User $user,Post $post){

        return $user->id ==$post->admin_user_id;
    }
    public function delete(User $user,Post $post){
        //可以用if 如果user_id不等于，没有正面语句。
        return $user->id == $post->admin_user_id;
    }
}
