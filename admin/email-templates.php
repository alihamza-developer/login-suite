<?php
require_once('includes/db.php');
$page_name = 'Email Templates';

$JS_FILES_ = [
    'email-templates.js'
];

require_once "includes/head.php";
add_assets_template("tinyMCE");
?>

<div class="card">
    <div class="card-body">
        <div class="page-header pull-away">
            <h3 class="heading">Email Templates</h3>
        </div>
        <hr class="page-heading">
        <?php
        $emails = EMAILS;
        if ($emails) {
            $count = 1;
        ?>
            <div class="table-responsive">
                <table class="table dataTable">
                    <thead>
                        <tr class="ws">
                            <th>#</th>
                            <th>Title</th>
                            <th>Subject</th>
                            <th class="d-none">Body</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($emails as $key => $email) {
                            $email_template = $db->select_one("email_templates", '*', ['name' => $key]);

                            $subject = "";
                            $body = "";
                            if ($email_template) {
                                $subject = $email_template['subject'];
                                $body = htmlspecialchars_decode($email_template['body']);
                            }
                        ?>
                            <tr>
                                <td>
                                    <?= $count; ?>
                                </td>
                                <td class="ws"><?= $email['title']; ?></td>
                                <td class="ws" data-name="subject" data-value="<?= $subject; ?>"><?= $subject; ?></td>
                                <td class="d-none" data-name="body" data-value="<?= htmlspecialchars($body); ?>"><?= $body; ?></td>
                                <td data-name="key" data-value="<?= $key; ?>" data-title="<?= $email['title']; ?>">
                                    <a href="#" class="text-success editTableInfo" title="Éditer" data-toggle="popup" data-target="#updateEmailTemplate">
                                        <?= svg_icon("pencil-alt")  ?>
                                    </a>
                                </td>
                            </tr>
                        <?php $count++;
                        } ?>
                    </tbody>
                </table>
            </div>
        <?php } else { ?>
            <p>No Data found!</p>
        <?php } ?>
    </div>
</div>

<?php require_once "./components/email-templates/modal.php";
require_once "includes/foot.php"; ?>