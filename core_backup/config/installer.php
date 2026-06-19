<?php

return [
    'app_name' => 'Influstar',
    'super_admin_role_id' => 1,
    'admin_model' => \App\Models\Admin::class,
    'admin_table' => 'admins',
    'multi_tenant' => false,
    'author' => 'byteseed',
    'product_key' => 'a98d267489bb3d09b7bead361bd700583db2ec9c',
    'php_version' => '8.2',
    'database_type' => 'mysql', // mysql or pgsql (depending on product database type)
    'extensions' => ['BCMath', 'Ctype', 'JSON', 'Mbstring', 'OpenSSL', 'PDO', 'pdo_mysql', 'Tokenizer', 'XML', 'cURL', 'fileinfo'],
    'website' => 'https://bytesed.com/',
    'email' => 'contact@bytesed.com',
    'env_example_path' => public_path('env-sample.txt'),
    'broadcast_driver' => 'log',
    'cache_driver' => 'file',
    'queue_connection' => 'sync',
    'mail_port' => '587',
    'mail_encryption' => 'tls',
    'model_has_roles' => true,
    'bundle_pack' => false,
    'bundle_pack_key' => 'dsfasd',
];