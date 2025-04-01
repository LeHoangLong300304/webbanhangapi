<?php
// Khởi tạo session
session_start();

// Tự động load controller, model, helper
spl_autoload_register(function ($className) {
    $paths = [
        'app/controllers/',
        'app/models/',
        'app/helpers/'
    ];
    foreach ($paths as $path) {
        $file = $path . $className . '.php';
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});

// Lấy request URI
$request = $_SERVER['REQUEST_URI'];
$base_path = '/webbanhang';
$uri = str_replace($base_path, '', $request);
$uri = trim($uri, '/');

// Phân tích URI
$segments = explode('/', $uri);

// Xác định controller, action, param
$controllerSegment = $segments[0] ?? '';
$actionSegment = $segments[1] ?? 'index';
$paramSegment = $segments[2] ?? null;

/** XỬ LÝ API REQUESTS */
if ($controllerSegment === 'api' && isset($segments[1])) {
    $apiName = ucfirst($segments[1]) . 'ApiController';

    if (class_exists($apiName)) {
        $controller = new $apiName();
        $method = $_SERVER['REQUEST_METHOD'];
        $id = $segments[2] ?? null;

        // Map HTTP method -> action
        switch ($method) {
            case 'GET':
                $action = $id ? 'show' : 'index';
                break;
            case 'POST':
                $action = 'store';
                break;
            case 'PUT':
                $action = $id ? 'update' : null;
                break;
            case 'DELETE':
                $action = $id ? 'destroy' : null;
                break;
            default:
                http_response_code(405);
                echo json_encode(['message' => 'Method Not Allowed']);
                exit;
        }

        if ($action && method_exists($controller, $action)) {
            $id ? $controller->$action($id) : $controller->$action();
        } else {
            http_response_code(404);
            echo json_encode(['message' => 'Action not found']);
        }
    } else {
        http_response_code(404);
        echo json_encode(['message' => 'API Controller not found']);
    }

    exit;
}

/** XỬ LÝ WEB REQUESTS */

// Xác định Controller
$controllerName = !empty($controllerSegment)
    ? ucfirst($controllerSegment) . 'Controller'
    : 'ProductController'; // Default controller nếu không nhập gì

// Kiểm tra controller có tồn tại không
if (!class_exists($controllerName)) {
    echo "❌ Controller <strong>$controllerName</strong> không tồn tại.";
    exit;
}

$controller = new $controllerName();

// Xác định Action
$action = $actionSegment;

// Các action cần param
$actionsRequireParam = [
    'editProduct', 'deleteProduct', 'editCategory', 'deleteCategory',
    'editAccount', 'deleteAccount', 'show', 'edit', 'delete',
    'addToCart', 'removeFromCart'
];

// Kiểm tra method tồn tại trong controller không
if (!method_exists($controller, $action)) {
    echo "❌ Action <strong>$action</strong> không tồn tại trong controller <strong>$controllerName</strong>.";
    exit;
}

// Nếu action cần param
if (in_array($action, $actionsRequireParam)) {
    if ($paramSegment !== null) {
        $controller->$action($paramSegment);
    } else {
        echo "❗ Cần tham số (ID) cho action <strong>$action</strong>.";
    }
} else {
    // Action không cần param
    $controller->$action();
}
?>
