<?php
define('DIR', '../');
require_once(DIR . 'includes/db.php');
// Update Personal Info
if (isset($_POST['update_personal_information'])) {
	$fname = _POST('fname');
	$lname = _POST('lname');
	$name = "$fname $lname";

	$dbData = [
		'fname' => $fname,
		'lname' => $lname,
		'name' => $name
	];
	// Upload avatar
	$avatar = $_fn->upload_file("avatar", [
		'path' => _DIR_ . "images/users/",
		'allowed_exts' => IMAGES_EXTS
	]);
	if ($avatar['status'] === 'success')
		$dbData['image'] = $avatar['filename'];

	$update = $db->update('users', $dbData, ['id' => LOGGED_IN_USER['id']]);
	if ($update)
		returnSuccess('Information Updated Successfully');
}
// Change Password
if (isset($_POST['change_password'])) {
	$current_password = _POST('current_password');
	$new_password = _POST('new_password');
	$confirm_password = _POST('confirm_password');

	// Validate
	if (!$new_password !== $confirm_password)
		returnError('New password is not matching with confirm password. Please try again');
	// Verify current password
	if (!password_verify($current_password, LOGGED_IN_USER['password']))
		returnError('Current password is wrong. Please enter a correct password');
	// Update password
	$new_password = password_hash($new_password, PASSWORD_BCRYPT);
	$update = $db->update('users', ['password' => $new_password], [
		'id' => LOGGED_IN_USER['id']
	]);

	if ($update) returnSuccess('Passowrd Changed Successfully');
}
