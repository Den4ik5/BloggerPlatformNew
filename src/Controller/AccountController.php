<?php
/**
 * Created by PhpStorm.
 * User: Den
 * Date: 28.11.2018
 * Time: 22:46
 */

namespace App\Controller;


class AccountController
{
    public function accountInfo()
    {
        // allow any authenticated user - we don't care if they just
        // logged in, or are logged in via a remember me cookie
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_REMEMBERED');

        // ...
    }

    public function resetPassword()
    {
        // require the user to log in during *this* session
        // if they were only logged in via a remember me cookie, they
        // will be redirected to the login page
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
    }
}