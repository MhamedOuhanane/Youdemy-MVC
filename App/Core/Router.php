<?php
namespace App\Core;
class Router
{
    private $routes = [];
    public function add($method, $uri, $handler) {
        $this->routes[] = [
            'method' => strtoupper($method),
            'path' => $this->formatPath($uri),
            'handler' => $handler
        ];
    }
    public function dispatch($httpmethod, $path) {
        $uri = $this->formatPath($path);
        foreach ($this->routes as $route) {
            if($route['method'] == strtoupper($httpmethod) && $route['path'] == $uri) {
                try {
                    $class = $route['handler'][0];
                    $method = $route['handler'][1];
                    
                    if (!class_exists($class)) {
                        throw new \Exception("Controller class '$class' not found");
                    }
                    
                    $instance = new $class();
                    
                    if (!method_exists($instance, $method)) {
                        throw new \Exception("Method '$method' not found in controller '$class'");
                    }
                    
                    return call_user_func([$instance, $method]);
                } catch (\Exception $e) {
                    http_response_code(500);
                    return "Internal Server Error: " . $e->getMessage();
                }
            }
        }
        http_response_code(404);
        echo "404 Not Found";
    }
    private function formatPath($path) {
        $path = ucfirst($path);
        return '/' . trim($path, '/');
    }
} 

// class Router 
// {
//     private array $routes = [];
    
//     public function add(string $method, string $uri, array $handler): void 
//     {
//         $this->routes[] = [
//             'method' => strtoupper($method),
//             'path' => $this->formatPath($uri),
//             'handler' => $handler,
//             'params' => $this->extractParameters($uri)
//         ];
//     }

//     public function dispatch(string $httpmethod, string $path) 
//     {
//         $uri = $this->formatPath($path);
        
//         foreach ($this->routes as $route) {
//             $params = $this->matchRoute($route['path'], $uri);
            
//             if ($route['method'] === strtoupper($httpmethod) && $params !== false) {
//                 try {
//                     $class = $route['handler'][0];
//                     $method = $route['handler'][1];
                    
//                     if (!class_exists($class)) {
//                         throw new \Exception("Controller class '$class' not found");
//                     }
                    
//                     $instance = new $class();
                    
//                     if (!method_exists($instance, $method)) {
//                         throw new \Exception("Method '$method' not found in controller '$class'");
//                     }
                    
//                     // Passer les paramètres à la méthode du contrôleur
//                     return call_user_func_array([$instance, $method], $params);
//                 } catch (\Exception $e) {
//                     http_response_code(500);
//                     return "Internal Server Error: " . $e->getMessage();
//                 }
//             }
//         }
        
//         http_response_code(404);
//         return "404 Not Found";
//     }

//     private function extractParameters(string $uri): array 
//     {
//         $params = [];
//         preg_match_all('/{([^}]+)}/', $uri, $matches);
//         return $matches[1];
//     }

//     private function matchRoute(string $routePath, string $requestUri): false|array 
//     {
//         // Convertir le chemin de la route en expression régulière
//         $pattern = preg_replace('/{([^}]+)}/', '([^/]+)', $routePath);
//         $pattern = str_replace('/', '\/', $pattern);
//         $pattern = '/^' . $pattern . '$/';

//         if (preg_match($pattern, $requestUri, $matches)) {
//             // Enlever la première correspondance (match complet)
//             array_shift($matches);
//             return $matches;
//         }

//         return false;
//     }

//     private function formatPath(string $path): string 
//     {
//         return '/' . trim(preg_replace('#/+#', '/', $path), '/');
//     }
// }