<?php

namespace App\Policies;

use App\Pharmacy;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PharmacyPolicy
{
    use HandlesAuthorization;

    public function update(User $user, Pharmacy $pharmacy)
    {
        return $pharmacy->sales_rep == $user->name;
    }

}
