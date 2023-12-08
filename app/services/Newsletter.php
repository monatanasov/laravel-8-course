<?php

namespace App\services;

use MailchimpMarketing\ApiClient;

class Newsletter
{
    public function subscribe (string $email, string $list = null)
    {
        //null-safe assignment. If list is NULL then make it equal to the right side of the operator
        $list ??= config('services.mailchimp.lists.subscribers');


        return $this->client()->lists->addListMember($list, [
            'email_address' => $email,
            'status' => 'subscribed'
        ]);
    }

    protected function client()
    {
        $mailchimp = new ApiClient();

        return $mailchimp->setConfig([
            'apiKey' => config('services.mailchimp.key'),
            'server' => 'us21'
        ]);
    }

}
