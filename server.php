<?php

require_once __DIR__ . '/vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;

$app = new Silex\Application();

/**
 * checkAuth
 *
 * @param Request $request
 * @return bool
 */
$checkAuth = function (Request $request) {
    if (!$request->headers->has('x-api-token')) {
        return false;
    }
    if (!$request->headers->get('x-api-token') === 'YOUR-SECRET-KEY') {
        return false;
    }
    return true;
};

/**
 * for check connection.
 */
$app->get('/', function () use ($app) {
    return $app->json([]);
});

/**
 * Auth
 */
$app->post('/auth', function (Request $request) use ($app) {
    $data = json_decode($request->getContent(), true);

    if ($data['name'] == 'shinichi' && $data['password'] == 'p@ssw0rd') {
        return $app->json([
            'auth' => [
                'x-api-token' => 'YOUR-SECRET-TOKEN',
            ],
        ]);
    }

    return $app->abort(400, 'Authentication failed.');
});

/**
 * Get an item.
 */
$app->get('/items/1', function (Request $request) use ($app, $checkAuth) {
    if (!$checkAuth($request)) {
        return $app->abort(400, 'Unauthorized.');
    }

    return $app->json([
        'code' => 'MBA',
        'name' => 'MacBook Air',
        'size' => ['11-inch', '13-inch'],
    ]);
});

/**
 * Get users.
 */
$app->get('/users', function (Request $request) use ($app, $checkAuth) {
    if (!$checkAuth($request)) {
        return $app->abort(400, 'Unauthorized.');
    }

    return $app->json([
        [
            'id' => 1,
            'name' => 'Michel',
            'age' => 18,
            'hobby' => [
                'music',
                'play baseball'
            ],
            'other' => [
                'favorite hero' => 'spider man',
                'girlfriend' => [
                    'Mary',
                    'Jane',
                ]
            ],
        ],
        [
            'id' => 2,
            'name' => 'Bob',
            'age' => 21,
            'hobby' => [
                'movie',
                'running',
                'take a picture',
                'programming',
            ],
        ],
    ]);
});

/**
 * Redirect to google.
 */
$app->get('/redirect', function () use ($app) {
    return $app->redirect('https://google.com');
});


$app->run();