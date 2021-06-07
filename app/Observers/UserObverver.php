<?php

namespace App\Observers;

use App\Models\User;

class UserObverver
{
    /**
     * Evento executado ap�s a user ser criada
     *
     * @param User $user
     */
    public function created(User $user)
    {
        //enviar E-mail
    }


    /**
     * Evento executado ap�s a user ser atualizada
     *
     * @param User $user
     */
    public function updated(User $user)
    {
        
    }

    /**
     * Evento executado ap�s a user ser deletada
     *
     * @param User $user
     */
    public function deleted(User $user)
    {
        
    }
}
