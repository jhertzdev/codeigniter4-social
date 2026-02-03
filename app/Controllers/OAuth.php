<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use Hybridauth\Hybridauth;
use Hybridauth\Storage\Session;
use Config\HybridAuth as HybridConfig;

class OAuth extends BaseController
{
    public function redirect(string $provider)
    {
        session(); // Initialize CI session early to prevent ini_set errors

        try {
            $config = config('HybridAuth');
            $hybridauth = new Hybridauth([
                'callback'  => base_url($config->callback . '/' . $provider),
                'providers' => $config->providers,
                'storage'   => new Session(),
            ]);

            $adapter = $hybridauth->authenticate($provider);

            $userProfile = $adapter->getUserProfile();

            return $this->response->setJSON($userProfile);
        } catch (\Exception $e) {
            return redirect()->to('/login')->with('error', 'Authentication failed: ' . $e->getMessage());
        }
    }

    public function callback(string $provider)
    {
        session(); // Initialize CI session early to prevent ini_set errors

        try {
            $config = config('HybridAuth');
            $hybridauth = new Hybridauth([
                'callback'  => base_url($config->callback . '/' . $provider),
                'providers' => $config->providers,
                'storage'   => new Session(),
            ]);

            $adapter = $hybridauth->authenticate($provider);

            $userProfile = $adapter->getUserProfile();

            $adapter->disconnect();

            if (auth()->loggedIn()) {
                auth()->logout();
            }

            session()->setTempdata('social_email', $userProfile->email, 300);

            return redirect()->to('/auth/social-login');
        } catch (\Exception $e) {
            return redirect()->to('/login')->with('error', 'Authentication error: ' . $e->getMessage());
        }
    }

    public function socialLogin()
    {
        if (auth()->loggedIn()) {
            auth()->logout();
        }

        $email = session()->getTempdata('social_email');

        if (! $email) {
            return redirect()->to('/login')->with('error', 'Session expired. Please try logging in again.');
        }

        $result = auth()->setAuthenticator('social')->attempt(['email' => $email]);

        if ($result->isOK()) {
            return redirect()->to(config('Auth')->loginRedirect());
        }

        return redirect()->to('/login')->with('error', $result->reason());
    }
}