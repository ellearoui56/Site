<?php
return [
    'openai' => [
        'api_key' => getenv('OPENAI_API_KEY'),
        'base_url' => getenv('OPENAI_BASE_URL') ?: 'https://api.openai.com/v1',
        'default_model' => 'gpt-4',
    ],
];