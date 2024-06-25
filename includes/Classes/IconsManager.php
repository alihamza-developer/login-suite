<?php
require_once _DIR_ . 'includes/svg-icons.php';

use FN\Functions;
use CategoriesManager\Categories;
use DB\Database;

class IconsManager
{
    public $category_type = "icons-manager";
    public $_category;

    private $db;
    private $fn;

    // Constructer
    public function __construct()
    {
        $this->fn = new Functions();
        $this->_category = new Categories();
        $this->db = new Database();
    }
    // Remove Commented Code
    function remove_commented_code($svg_content)
    {
        $pattern = '/<!--(.|\s)*?-->/';
        $svg_content = preg_replace($pattern, '', $svg_content);
        return $svg_content;
    }
    // Add Icon
    public function add_icons($data = [])
    {
        $icons = arr_val($data, 'icons');
        $category_id = arr_val($data, 'category_id');
        $category_id = $this->_category->is_exists($category_id);
        if (!$category_id) return $this->fn->error("Category can't exist");

        $icons = $this->fn->sort_multiple_files($icons);

        $total_saved = 0;

        foreach ($icons as $icon) {
            $name = $icon['name'];
            $tmp_name = $icon['tmp_name'];

            $prefix =  get_file_info($name)['name'];
            $name = to_title_case($prefix);
            $prefix = to_slug($prefix);
            $content = file_get_contents($tmp_name);
            $content = $this->remove_commented_code($content);

            // Save Icon to DB
            $saved = $this->db->save('icons', [
                'prefix' => $prefix,
                'name' => $name,
                'content' => $content,
                'category_id' => $category_id
            ], [
                'prefix' => $prefix
            ]);

            if ($saved) $total_saved++;
        }


        // Return Response
        return $this->fn->success("$total_saved Icons Saved");
    }

    // Fetch Icons Data
    public function get_icons_data()
    {
        $result = [];
        // First Get All Categories
        $categories = $this->_category->getAll([
            'type' => $this->category_type
        ]);

        if (!count($categories)) return [];

        foreach ($categories as $category) {
            $name = $category['name'];
            $slug = $category['slug'];
            $id = $category['id'];

            $icons = $this->get_icons([
                'columns' => 'id,name,prefix,content',
                'condition' => [
                    'category_id' => $id
                ]
            ]);

            $result[$slug] = [
                'name' => $name,
                'icons' => $icons
            ];
        }

        return $result;
    }

    // Get Icons 
    public function get_icons($data = [])
    {
        $cols = arr_val($data, 'columns', "*");
        $condition = arr_val($data, 'condition', []);

        $icons = $this->db->select("icons", $cols, $condition);

        foreach ($icons as $key => $icon) {

            $content = arr_val($icon, 'content');
            if ($content)
                $icon['content'] = htmlspecialchars_decode($content);

            $icons[$key] = $icon;
        }

        return $icons;
    }

    // Load Icons to Site
    public function load_icons_to_site()
    {
        $category_id = $this->_category->get(['type' => $this->category_type], 'id');
        if (!$category_id) return $this->fn->error("Category can't exists!");
        $category_id = $category_id['id'];

        $icons = $this->get_icons([
            'columns' => 'prefix,content',
            'condition' => [
                'category_id' => $category_id
            ]
        ]);

        $icons_array = [];
        foreach ($icons as $icon) {
            $prefix = $icon['prefix'];
            $content = $icon['content'];

            $icons_array[$prefix] = $content;
        }
        // Export Icons String and store into PHP File
        $icons_array = var_export($icons_array, true);

        $code = "<?php\n\$SITE_ICONS = \t$icons_array;";

        file_put_contents(_DIR_ . 'includes/svg-icons.php', $code);
    }

    // Fetch Icon content
    public function fetch_icon_content($data)
    {
        global $SITE_ICONS;

        $name = arr_val($data, 'name');
        $size = arr_val($data, 'size', 17);
        $color = arr_val($data, 'color', '#000');
        $height = arr_val($data, 'height');

        $height_ = $size;
        if ($height) $height_ = "$height";

        $svg = $SITE_ICONS[$name];
        $svg = str_replace("<svg ", "<svg width='{$size}' height='{$height_}' fill='{$color}' ", $svg);
        return $svg;
    }

    // Export Icons 
    public function export_icons()
    {
        // Get Icons
        $icons_data = $this->get_icons([
            'columns' => 'name,prefix,content'
        ]);

        $icons_data = json_encode($icons_data, JSON_PRETTY_PRINT);
        $json_f_name = generate_file_name('json', UPLOAD_PATH);
        $json_f_path = merge_path(UPLOAD_PATH, $json_f_name);
        // Create Json File
        $file = fopen($json_f_path, 'w');
        fwrite($file, $icons_data);
        fclose($file);

        if (!file_exists($json_f_path))
            return $this->fn->error("Icons can't exported!");

        return $this->fn->success([
            'filename' => $json_f_name,
            'url' =>  merge_path(SITE_URL, 'images/uploads', $json_f_name)
        ]);
    }

    // Import Icons
    public function import_icons($file, $category_id)
    {

        $icons_data = file_get_contents($file['tmp_name']);
        $icons_data = json_decode($icons_data, true);

        $total_saved = 0;
        foreach ($icons_data as $icon) {
            $name = arr_val($icon, 'name');
            $prefix = arr_val($icon, 'prefix');
            $content = arr_val($icon, 'content');

            $saved = $this->db->save('icons', [
                'prefix' => $prefix,
                'name' => $name,
                'content' => $content,
                'category_id' => $category_id
            ], [
                'prefix' => $prefix
            ]);

            if ($saved) $total_saved++;
        }

        return $this->fn->success("$total_saved Icons Imported");
    }
}

$icons_manager = new IconsManager();


// Get svg icon
function svg_icon($name, $size = "17", $color = "#000", $height = false)
{
    global $icons_manager;
    return $icons_manager->fetch_icon_content([
        'name' => $name,
        'size' => $size,
        'color' => $color,
        'height' => $height
    ]);
}
