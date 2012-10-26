<?php

return array(
    'class' => 'ext.eauth.EAuth',
    'popup' => true, // Use the popup window instead of redirecting.
    'cache' => false, // Cache component name or false to disable cache. Defaults to 'cache'.
    'cacheExpire' => 0, // Cache lifetime. Defaults to 0 - means unlimited.
    'services' => array(// You can change the providers and their classes.
//                        'google' => array(
//                            'class' => 'GoogleOpenIDService',
//                        ),
//                        'yandex' => array(
//                            'class' => 'YandexOpenIDService',
//                        ),
//                        'twitter' => array(
//                            // register your app here: https://dev.twitter.com/apps/new
//                            'class' => 'TwitterOAuthService',
//                            'key' => '...',
//                            'secret' => '...',
//                        ),
        'google_oauth' => array(
            // register your app here: https://code.google.com/apis/console/
            'class' => 'CustomGoogleAuthService',
            'client_id' => '601138882389-tkfndj73f4cnnjpuu402ihva57ndscfb.apps.googleusercontent.com',
            'client_secret' => 'L_8-TQDdm31OEz9vXNfOWB8J',
            'title' => 'Google (OAuth)',
        ),
        'facebook' => array(
            // register your app here: https://developers.facebook.com/apps/
            'class' => 'CustomFacebookOAuthService',
            'client_id' => '376588799076610',
            'client_secret' => 'e48917e90c261a4ec630b20abddbe8e0',
        ),
        'vkontakte' => array(
            // register your app here: https://vk.com/editapp?act=create&site=1
            'class' => 'CustomVKontakteOAuthService',
            'client_id' => '3142907',
            'client_secret' => '9b1FoGkG8u2Rtyi9mFC6',
        ),
//                        'yandex_oauth' => array(
//                            // register your app here: https://oauth.yandex.ru/client/my
//                            'class' => 'YandexOAuthService',
//                            'client_id' => '...',
//                            'client_secret' => '...',
//                            'title' => 'Yandex (OAuth)',
//                        ),
        
//                        'linkedin' => array(
//                            // register your app here: https://www.linkedin.com/secure/developer
//                            'class' => 'LinkedinOAuthService',
//                            'key' => '...',
//                            'secret' => '...',
//                        ),
//                        'github' => array(
//                            // register your app here: https://github.com/settings/applications
//                            'class' => 'GitHubOAuthService',
//                            'client_id' => '...',
//                            'client_secret' => '...',
//                        ),
//                        'live' => array(
//                            // register your app here: https://manage.dev.live.com/Applications/Index
//                            'class' => 'LiveOAuthService',
//                            'client_id' => '...',
//                            'client_secret' => '...',
//                        ),
        
//                        'mailru' => array(
//                            // register your app here: http://api.mail.ru/sites/my/add
//                            'class' => 'MailruOAuthService',
//                            'client_id' => '...',
//                            'client_secret' => '...',
//                        ),
//                        'moikrug' => array(
//                            // register your app here: https://oauth.yandex.ru/client/my
//                            'class' => 'MoikrugOAuthService',
//                            'client_id' => '...',
//                            'client_secret' => '...',
//                        ),
//                        'odnoklassniki' => array(
//                            // register your app here: http://dev.odnoklassniki.ru/wiki/pages/viewpage.action?pageId=13992188
//                            // ... or here: http://www.odnoklassniki.ru/dk?st.cmd=appsInfoMyDevList&st._aid=Apps_Info_MyDev
//                            'class' => 'OdnoklassnikiOAuthService',
//                            'client_id' => '...',
//                            'client_public' => '...',
//                            'client_secret' => '...',
//                            'title' => 'Odnokl.',
//                        ),
    ),
        )
?>