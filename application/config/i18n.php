<?php

return [
    'translations' => [
        // All "app*" categories...
        'app*' => [
            'class' => 'yii\i18n\PhpMessageSource',
            //'basePath' => '@app/messages',    // implicit
            //'sourceLanguage' => 'en-US',      // implicit
            'fileMap' => [
                'app' => 'app.php',
                //'app/error' => 'error.php',
            ],
        ],
    ],
];
