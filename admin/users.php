<?php
require_once('includes/db.php');
$page_name = 'Users';

require_once "includes/head.php";
?>
<div class="card">
    <div class="card-header">
        <div class="pull-away">
            <p>Users</p>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <?php
            $users = $db->select('users', '*', [
                'id' => [
                    'operator' => '!=',
                    'value' => LOGGED_IN_USER_ID
                ]
            ], [
                'order_by' => 'id DESC',
            ]);

            if ($users) {
            ?>
                <table class="table table-bordered dataTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>User</th>
                            <th>Join Date</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $count = 1;
                        foreach ($users as $user) {
                        ?>
                            <tr>
                                <td><?= $count; ?></td>
                                <td>
                                    <div class="media">
                                        <img src="../images/users/<?= $user['image']; ?>" alt="user-img" class="user-img small">
                                        <div class="media-body ml-2">
                                            <p class="name text-info"><?= $user['name']; ?></p>
                                            <p class="email text-muted"><?= $user['email']; ?></p>
                                        </div>
                                    </div>
                                </td>
                                <td><?= monthDate($user['date_added']); ?></td>
                                <td>
                                    <span class="text-white p-1 bold small-font <?= ($user['verify_status'] != '1') ? 'bg-warning text-dark' : 'bg-success' ?>">
                                        <?= ($user['verify_status'] == '1') ? 'Verified' : 'unverified' ?>
                                    </span>
                                </td>
                                <td>
                                    <div class=" align-center child-el-margin-x">
                                        <input type="checkbox" class="fancy-checkbox jx-req-element" data-submit='{"user_id": "<?= $user['id'] ?>"}' data-target="users" name="modifyUserIsAdmin" <?= $user['is_admin'] == "1" ? "checked" : "" ?>>
                                        <button class="no-btn-styles text-danger cp delete-btn" title="Delete" data-target="<?= $user['id']; ?>" data-action="user"><?= svg_icon("trash-alt")  ?></button>
                                    </div>
                                </td>
                            </tr>
                        <?php $count++;
                        } ?>
                    </tbody>
                </table>
            <?php
            } else { ?>
                <div class="alert alert-info">No users found</div>
            <?php } ?>
        </div>
    </div>
</div>
<?php require_once('./includes/foot.php'); ?>