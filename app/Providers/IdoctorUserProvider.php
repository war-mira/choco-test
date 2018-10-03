<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 01.02.2018
 * Time: 17:55
 */

namespace App\Providers;


use Illuminate\Auth\EloquentUserProvider;
use Illuminate\Support\Str;

class IdoctorUserProvider extends EloquentUserProvider
{
    public function retrieveByCredentials(array $credentials)
    {
        if (empty($credentials) ||
            (count($credentials) === 1 &&
                array_key_exists('password', $credentials))) {
            return;
        }

        // First we will add each credential element to the query as a where clause.
        // Then we can execute the query and, if we found a user, return it in a
        // Eloquent User "model" that will be utilized by the Guard instances.
        $query = $this->createModel()->newQuery()->where('role', '!=', 3);

        if (array_key_exists('phone', $credentials))
            $query->where('phone_verified', 1);
        foreach ($credentials as $key => $value) {
            if (!Str::contains($key, 'password')) {
                $query->where($key, $value);
            }
        }

        $user = $query->first();
        return $user;
    }
}