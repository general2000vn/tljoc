<?php
        namespace App\Mailer;

        use Cake\Mailer\Mailer;

        class UserMailer extends Mailer
        {
            public function welcome($user)
            {
                return $this // Returning the chain is a good idea :)
                    ->setTo(Configure::read('admin_email'))
                    ->setSubject(sprintf("Welcome %s", $user->name))
                    //->template("welcome_mail") // By default template with same name as method name is used.
                    //->layout("custom")
                    //->set(["user" => $user]);
                    ;
            }
        }
?>