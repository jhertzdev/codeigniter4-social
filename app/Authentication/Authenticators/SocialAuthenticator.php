<?php

namespace App\Authentication\Authenticators;

use CodeIgniter\Shield\Authentication\Authenticators\Session;
use CodeIgniter\Shield\Entities\User;
use CodeIgniter\Shield\Result;

class SocialAuthenticator extends Session
{
    public function attempt(array $credentials): Result
    {
        $email = $credentials['email'] ?? null;

        if (!$email) {
            return new Result([
                'success' => false,
                'reason'  => 'A valid email is required.',
            ]);
        }

        $users = auth()->getProvider();

        // Buscar usuario por email
        $user = $users->findByCredentials(['email' => $email]);

        // Si no existe, crearlo
        if (!$user) {
            $user = new User([
                'username' => explode('@', $email)[0] . '_' . bin2hex(random_bytes(2)), // Evita duplicados
                'email'    => $email,
                'active'   => 1, 
            ]);

            $users->save($user);
            
            $user = $users->findById($users->getInsertID());
        }

        $this->login($user);

        return new Result([
            'success'   => true,
            'extraInfo' => ['user' => $user],
        ]);
    }
}