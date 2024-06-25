<?php

namespace Email;

use \Mailjet\Resources;
use \DB\Database;

require_once _DIR_ . "includes/inc/emails-data.php";

class Emails extends Database
{
    private $db;
    public function __construct($config = [])
    {
        global $db;
        $this->db = $db;
    }
    // Get Email Headers
    public function getHeaders()
    {
        $from = SITE_EMAIL;
        $site_name = SITE_NAME;
        $br = "\r\n";

        $headers = [
            "Reply-To" => $from,
            "Return-Path" => $from,
            "From" => $from,
            "Organization" => '',
            "MIME-Version" => '1.0',
            "Content-type" => 'text/html; charset=utf-8',
            "X-Priority" => '3',
            "X-Mailer" => "PHP" . phpversion(),
        ];

        $headers_str = "";

        foreach ($headers as $key => $value) {
            $headers_str .= "{$key} {$site_name} <\"$value\">";
        }

        return $headers_str;
    }
    // Create button
    public function createBtn($text, $href)
    {
        return '<a href="' . $href . '" style="text-align:center;background: #17a2b8;color:#fff;text-decoration:none;padding:15px 20px;display:inline-block;">' . $text . '</a>';
    }
    // Replace Variables from string
    function replace_email_vars($str, $vars = [], $is_email_body = false)
    {
        foreach ($vars as $var => $value) {
            $var = strtolower($var);
            if (!$is_email_body)
                $value = replaceBreaksToBr($value);
            $var = "_:" . $var . ":_";
            $str = str_replace($var, $value, $str);
        }
        return $str;
    }
    // Read Email File
    function get_data_from_file($filename, $vars = [])
    {
        $filepath = _DIR_ . "includes/Classes/templates/" . $filename;
        if (!is_file($filepath))
            return null;

        $file_data = file_get_contents($filepath);
        $vars = array_merge([
            'site_url' => SITE_URL,
            'site_name' => SITE_NAME,
            'site_email' => SITE_EMAIL,
            'site_phone' => SITE_PHONE,
            'site_phone_image' => url("images/png-icons/phone.png"),
            'site_mail_image' => url("images/png-icons/mail.png"),
            'site_url_image' => url("images/png-icons/globe.png"),
            'www_site_url' => get_www_url(SITE_URL),
            // 'email_header_image' => merge_path(SITE_URL, 'images/email-header.jpg'),
            // 'email_footer_image' => merge_path(SITE_URL, 'images/email-footer.jpg'),
        ], $vars);
        $file_data = $this->replace_email_vars($file_data, $vars);
        return $file_data;
    }
    // Get Email Structures
    function get_email_structure()
    {
        return $this->get_data_from_file('email_structure.html');
    }
    // Read Template file
    public function readTemplateFile($str, $vars = [])
    {
        $email_body = $this->replace_email_vars($str, $vars);
        $vars['email_body'] = $email_body;
        // Get Email Structure
        $email_structure = $this->get_email_structure();
        $file_data = $this->replace_email_vars($email_structure, $vars, true);
        return $file_data;
    }
    // Send Email
    /* 
    @param $options = [
        'template' => 'contactEmail',
        'to' => ADMIN_EMAIL,
        'subject' => "New Message from SITE_NAME",
        'vars' => [
            'name' => $name,
            'email' => $email,
            'subject' => $subject,
            'message' => $message
        ]
    ]
    */
    public function send($options)
    {
        $template = arr_val($options, 'template');
        $to = $options['to'];
        if ($template) {
            if (!isset(EMAILS[$template])) return;
            // Read Template file
            $name = $template;
            $template = EMAILS[$template];
            $email_template  = $this->db->select_one("email_templates", '*', ['name' => $name]);
            if (!$email_template) return;

            $subject = $email_template['subject'];
            $body = htmlspecialchars_decode($email_template['body']);
            $vars = arr_val($options, 'vars', []);
            $vars = array_merge($vars, [
                'site_name' => SITE_NAME,
                'site_url' => SITE_URL,
                'login_url' => merge_path(SITE_URL, "login"),
                'site_email' => CONTACT_EMAIL,
                'site_logo_url' => url('images/logo-with-name.png?v=1.0'),
            ]);
            // User Data
            $user = $this->db->select_one("users", '*', ['email' => $to]);
            $vars['user_firstname'] = arr_val($user, 'fname', '');
            $vars['user_lastname'] = arr_val($user, 'lname', '');
            $vars['user_name'] = arr_val($user, 'name', '');
            $vars['user_email'] = arr_val($user, 'email', '');
            // Read template file
            $data = $this->readTemplateFile($body, $vars);
            $subject_ = $this->replace_email_vars($subject, $vars);
            // Return Html
            if (arr_val($options, 'return_html', false))
                return $data;
            // echo $data;
            // exit;

            // Send Email
            return $this->sendEmailTo([
                'to' => $to,
                'body' => $data,
                'subject' => $subject_
            ]);
        }
        return false;
    }
    // Send email
    /* 
    @param $data = [
        'to' => ,
        'body' => ,
        'subject' => ,
        'to_name' => optional
    ]
    */
    public function sendEmailTo($data)
    {
        $mj = new \Mailjet\Client(MAILJET_API_KEY, MAILJET_SECRET_KEY, true, ['version' => 'v3.1']);
        $to_name = arr_val($data, 'to_name', '');
        $body = [
            'Messages' => [
                [
                    'From' => [
                        'Email' => CONTACT_EMAIL,
                        'Name' => SITE_NAME
                    ],
                    'To' => [
                        [
                            'Email' => $data['to'],
                            'Name' => $to_name
                        ]
                    ],
                    'Subject' => $data['subject'],
                    'TextPart' => "",
                    'HTMLPart' => $data['body'],
                    'CustomID' => "AppGettingStartedTest"
                ]
            ]
        ];

        $response = $mj->post(Resources::$Email, ['body' => $body]);
        print_r($response->success());
        exit;
    }
}
$_email = new Emails();
require_once _DIR_ . "includes/inc/emails.php";
