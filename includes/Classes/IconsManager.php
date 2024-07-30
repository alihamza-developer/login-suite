<?php

use FN\Functions;
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
        $this->db = new Database();
    }

    // Remove Commented Code
    function remove_commented_code($svg_content)
    {
        $pattern = '/<!--(.|\s)*?-->/';
        $svg_content = preg_replace($pattern, '', $svg_content);
        return trim($svg_content);
    }

    // Add Icon
    public function add_icons($data = [])
    {

        $files = $this->fn->sort_multiple_files($data);

        $add  = 0;
        $updated = 0;

        foreach ($files as $file) {

            $name = trim($file['name']);
            $tmp_name = trim($file['tmp_name']);

            $prefix =  get_file_info($name)['name'];
            $name = to_title_case($prefix);
            $prefix = to_slug($prefix);

            $content = file_get_contents($tmp_name);
            $content = $this->remove_commented_code($content);
            $exist = $this->db->select_one("icons", "id", ['prefix' => $prefix]);

            $saved = $this->db->save('icons', [
                'prefix' => $prefix,
                'name' => $name,
                'content' => $content,
            ], [
                'prefix' => $prefix
            ]);


            if ($exist) {
                $updated++;
                continue;
            } else if ($saved) {
                $add++;
            }
        }

        $this->load(); // Load Icons in site
        // Return Response
        return $this->fn->success("$add Icons Saved and $updated is updated");
    }

    // Export Icons 
    public function export_icons($type = "json")
    {
        // Get Icons
        $icons = $this->db->select("icons", "name,prefix,content");

        // Loop for edit icon data
        foreach ($icons as $key => $icon) {
            $icon['content'] = html_entity_decode(htmlspecialchars_decode($icon['content']));
            $icons[$key] = $icon;
        }


        // Generate filenames
        $filename = generate_file_name($type, UPLOAD_PATH);
        $filepath = merge_path(UPLOAD_PATH, $filename);

        // Export Icons in JSON File
        if ($type == "json") {
            $icons_data = json_encode($icons, JSON_PRETTY_PRINT);
            $file = fopen($filepath, 'w');
            fwrite($file, $icons_data);
            fclose($file);

            if (!file_exists($filepath))
                return $this->fn->error("Icons can't exported!");
        } else if ($type == "zip") {

            $zip = new ZipArchive();
            $zip->open($filepath, ZipArchive::CREATE);

            foreach ($icons as $icon) {
                $prefix = $icon['prefix'];
                $content = $icon['content'];
                $zip->addFromString("$prefix.svg", $content);
            }

            $zip->close(); // Close Zip
        }


        // Return Response
        return $this->fn->success([
            'filename' => $filename,
            'url' => merge_path(SITE_URL, 'images/uploads', $filepath)
        ]);
    }

    // Import Icons
    public function import_icons($file)
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
            ], [
                'prefix' => $prefix
            ]);

            if ($saved) $total_saved++;
        }
        $this->load(); // Load Icons in site

        return $this->fn->success("$total_saved Icons Imported");
    }

    // Load
    public function load()
    {
        $icons = $this->db->select("icons", "name,prefix,content");

        $icons_array = [];
        foreach ($icons as $icon) {
            $prefix = $icon['prefix'];
            $content = $icon['content'];

            $content = html_entity_decode(htmlspecialchars_decode($content));

            $icons_array[$prefix] = $content;
        }
        // Export Icons String and store into PHP File
        $icons_array = var_export($icons_array, true);

        $code = "<?php\n\$SITE_ICONS = \t$icons_array;";

        file_put_contents(_DIR_ . 'includes/svg-icons.php', $code);
    }
}

$icons_manager = new IconsManager();
