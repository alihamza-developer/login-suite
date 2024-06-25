<?php
class Routes
{
    public $paths = [];
    public $pages = [];
    private function getIndexValue($index)
    {
        $value = false;
        $count = 0;
        foreach ($_GET as $param) {
            if ($count === $index) $value = $param;
            $count++;
        }
        return $value;
    }
    private function callback($callback, $parameters = [])
    {
        if (gettype($callback) === "string") {
            extract($parameters);
            require_once("views/" . $callback . ".php");
        } else if (gettype($callback) === "boolean") {
            return $parameters;
        } else {
            $callback($parameters);
        }
        exit;
    }
    public function check($path, $callback = false)
    {
        
        if (strlen($path) < 1) return false;
        if ($path === "/" && count($_GET) === 0) {
            return $this->callback($callback);
        }
        $path = ltrim($path, '/');
        $path = rtrim($path, '/');
        $pathArr = explode('/', $path);
        print_r($pathArr);
        if (count($pathArr) !== count($_GET)) return false;
        print_r($pathArr);
        $validPath = true;
        $parameters = [];
        foreach ($pathArr as $key => $param) {
            $_getValue = $this->getIndexValue($key);
            if (preg_match('/(\{\w*\})/m', $param, $match)) {
                $match = gettype($match) === "array" ? $match[0] : $match;
                $parameter_name = preg_replace('/[{]/', '', $match);
                $parameter_name = preg_replace('/[}]/', '', $parameter_name);
                if (strlen($parameter_name) > 0) {
                    $parameters[$parameter_name] = $_getValue;
                }
            } else {
                if ($param != $_getValue) {
                    $validPath = false;
                }
            }
        }
        if ($validPath) {
            return $this->callback($callback, $parameters);
        }
    }
    public function set($type, $file)
    {
        $file = rtrim($file, ".php");
        $file .= ".php";
        $this->pages[$type] = $file;
    }
    public function get($path, $file = "")
    {
        $file_path = $file;
        if ($file == "") {
            $file_path = $path;
        }
        if (substr($file_path, -1) == "/") $file_path .= "index.php";
        else $file_path .= ".php";
        array_push($this->paths, [
            "path" => $path,
            "file" => $file_path
        ]);
    }
}
$Route = new Routes();
