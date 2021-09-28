<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Mailer Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used during sending email for various
    | messages that we need to send to the user. You are free to modify
    | these language lines according to your application's requirements.
    |
    */

    'admin' => 'ADMIN',
    'apl' => 'APL',
    'afa' => 'AFA',
    'seller' => 'Seller',
    'member' => 'Buyer',
    'customer' => 'Customer',
    
    'id' => 'Identifiant',
    'login' => 'Login',
    'password' => 'Password',
    
    'btn.active' => 'Activate account',
    'btn.more' => 'Know more',
    'btn.invoice' => 'Download the invoice',
    'btn.view.user' => 'See :role',
    'btn.contact_admin' => 'Contact Admin',
    'btn.login' => 'Login',
    
    'default_password' => 'Your default password is &ldquo;<b>:password</b>&rdquo; <br />',
    'quantity' => 'Amount :value',
    'amount' => 'Value :value',
    'tma' => 'TMA :value',
    
    'greeting' => 'Hello :Name',
    'thank' => 'Thank you for using our application.',
    
    'created.subject' => '[:app] Account created',
    'disabled.subject' => '[:app] Account suspended',
    'created.content.1' => "Someone has created an account at this email address.",
    'created.content.2' => "Please confirm your registration by clicking the link below.",
    
    'activated.subject' => '[:app] Confirmed registration',
    'activated.content' => 'Your registration has been confirmed.',
    'activated.collaborator.account.content' => 'Your account as a Collaborator is activated.',
    
    'reseted.subject' => '[:app] Request new password',
    'reseted.content' => "We&lsquo;ve received a request to reset your password. If you didn&lsquo;t make the request, just ignore this email. Otherwise, you can rest your password using this link :",
    
    'subscribed.subject' => '[:app] New registration (:plan)',
    'subscribed.content' => "Someone has subscribed to &ldquo; :plan &rdquo; (:count jours).",
    
    'disabled.subject' => '[:app] Account suspended',
    'disabled.content' => 'Your account has been suspended.',
    
    'order.subject' => '[:app] :ROLE - New order',
    'order.content' => "Someone ordered a product.",
    
    'payment.subject' => '[:app] :ROLE - New payment',
    'payment.content' => "Someone paid for a product.",
    
    'registration.metatitle' => 'Account verification',
    'registration.title' => 'Congratulations, your registration has been approved, here is the information concerning your account',
    'registration.foot' => 'Please follow this link to login.',
    'registration.clic_here' => 'Click here',

    'btn.reset.password' => 'Click here to reset your password',

    'document.sent' => 'Please download the documents below.',
    
    'suspended.user.logged' => 'A suspended user has just logged in',
    'suspended.user' => 'Username: <b>&ldquo; :user &rdquo;</b>',
    'txt.contact_admin' => 'For the recovery of your account, please contact the admin by the e-mail address <b>&ldquo; :mail &rdquo; </b>.',
    'activated.login.info' => 'Below are your login details: <br /> - Login: <b> :login </b> <br /> - Password: <b> :password </b>',
    'txt.end_exclusive_relationship_with_member' => 'End of the exclusive relationship with the member <b>&ldquo; :user &rdquo;</b>, registration number <b>&ldquo; :immat &rdquo;</b> in :day days.',
    'message_from_iea.subject' => '[:app] Message from IEA',
    'confirm.registration.message.member.1' => 'Thank you for sending your registration form to the "Investir en Australie".<br/><br/>',
    'confirm.registration.message.member.2' => 'Please confirm your registration by clicking on the link below.<br/><br/>',
    'confirm.registration.message.member.3' => 'In case of difficulty, please copy the link and paste it in the address bar of your browser.<br/><br/>',
    'confirm.registration.message.member.4' => 'As soon as you click on the registration confirmation link above, we will send an email to your email address containing your various usernames and your system-generated password. You will be asked to replace this system password later with a password that will be personal to you<br/><br/>',
    'confirm.registration.message.member.5' => 'Looking forward to,<br/><br/>',
    'confirm.registration.message.member.6' => 'Very cordial greetings<br/><br/>',
    'btn.confirm.registration'=>'Registration confirmation link',
    'registration.confirmed.member'=>'<p class=&quot;p-10px-tb&quot;>Hi <b>:name</b>, </p><p class=&quot;p-10px-b&quot;>We welcome you as a Member of the &quot;Invest in Australia&quot; portal. We will most often use the abbreviation IEA to refer to the &quot;Invest in Australia&quot; system or portal. For a first approach, the section &quot;How the Investing in Australia portal works&quot; on the home page offers you a synthetic view of the operations that you can perform via the portal.</p><p class=&quot;p-10px-b&quot;>You now have an IEA Portal Member account. We will communicate to you and remind you below of your username and password which will allow you to connect to the portal using the &quot;Connection&quot; tab at the top of the home page. The password provided to you is randomly generated by the system. It is recommended that you replace it with a personal and secret password. Your personal password that you will register must be at least 8 characters long and contain at least 1 lower case letter, 1 upper case letter, 1 number and 1 special character.</p><p class=&quot;p-10px-b&quot;>Your username and password are as follows:</p><p class=&quot;p-10px-b&quot;>- <b>Registration number : :immat</b><br/>- <b>Login : :login</b><br/>- <b>E-mail adress : :email</b><br/>- <b>Password : :password</b><br/></p><p class=&quot;p-10px-b&quot;>Only the email address and password will be required to log in as a Member, which will allow you to access your profile, your personal account and your personal dashboard through the &quot;Account&quot; tab in the toolbar.</p><p class=&quot;p-10px-b&quot;>In your profile you will find, throughout your practice on the portal, the various useful information, such as your affiliation situations with &quot;Local Partner Agencies&quot; and &quot;Francophone Australian Agencies&quot;. You can communicate with these agencies via the portal&rsquo;s internal messaging :</p><p class=&quot;p-10px-tb&quot;>The &quot;Local Partner Agencies&quot; (APL) </p> <p class=&quot; p-10px-tb &quot;> These are the agencies that are responsible for conducting real estate transaction files in Australia. During his search for goods it is possible for the Member to contact various AFA for information. However, once he has decided to initiate a specific purchase transaction, he will be asked to select a particular AFA who will then be entrusted with the conduct of the transaction. </p> <p class=&quot; p-10px -tb &quot;> The use of an AFA is completely free for the Member.</p><p class=&quot;p-10px-tb&quot;>Exchanges with AFAs are protected by anonymity, which prohibits communicating email or telephone contacts. This rule is essential to protect the Member from untimely solicitations from agencies. If a party breaks this rule, their message is automatically scrambled by the system. This rule of anonymity is lifted once the Member has initiated a purchase transaction.</p><p class=&quot;p-10px-tb&quot;>Transactions carried out through the IEA portal do not give rise to any payment of intervention fees to the IEA portal. Only the seller or his lawyer (solicitor) has to pay the purchase price of the property, taxes and public costs related to the purchase, as well as the emoluments of your own solicitor. We invite you to browse the blog articles of the portal and our &quot;{Investor&rsquo;s Guide}&quot; which will provide you with essential information relating to the main aspects of an investment of this type.</p><p class=&quot;p-10px-tb&quot;>When you have started a purchase operation, the portal will bring you, as needed, the contacts of French-speaking Australian professionals whose services you may need or useful. </p> <p class=&quot; p-10px-tb &quot; > We would like to thank you for the trust you have placed in us by registering as a Member on the IEA portal. Although it is still very limited, it is intended to cover all eight States and Territories of Australia. </p> <p class=&quot; p-10px-tb &quot;> Wishing you good navigation and in expressing the wish that you find a property that will meet your expectations.</p><p class=&quot;p-10px-tb&quot;>With our cordial greetings</p><p class=&quot;p-10px-tb text-right&quot;>The team &quot;Investir en Australie&quot;</p>',
];
