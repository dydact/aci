<?php
/**
 * Login screen.
 *
 * @package OpenEMR
 * @author  Rod Roark <rod@sunsetsystems.com>
 * @author  Brady Miller <brady.g.miller@gmail.com>
 * @author  Kevin Yeh <kevin.y@integralemr.com>
 * @link    http://www.open-emr.org
 */

// This includes the required code from globals.php
require_once("../globals.php");

use OpenEMR\Core\Header;
use OpenEMR\Services\FacilityService;

$facilityService = new FacilityService();

?><!DOCTYPE html>
<html>
<head>
    <?php Header::setupHeader(); ?>
    <link rel="stylesheet" href="<?php echo $GLOBALS['web_root']; ?>/sites/americancaregivers/styles/iris-brand.css">

    <title><?php echo text($openemr_name); ?></title>

    <style>
        .login-container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            background-color: white;
        }
        
        .login-body {
            background-color: #f5f7fa;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 0 15px;
        }

        .login-title-area {
            text-align: center;
            margin-bottom: 30px;
        }

        .dydact-logo {
            display: block;
            margin: 0 auto 15px;
            max-width: 180px;
            height: auto;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .btn-login {
            width: 100%;
            padding: 10px;
            background-color: var(--iris-primary);
            border: none;
        }

        .btn-login:hover {
            background-color: var(--iris-secondary);
        }

        .copyright {
            font-size: 12px;
            text-align: center;
            margin-top: 20px;
            color: #888;
        }
    </style>

    <script>
        function transmit_form() {
            document.forms[0].submit();
        }
    </script>
</head>
<body class="login-body">
    <div class="login-container">
        <div class="login-title-area">
            <img class="dydact-logo" src="<?php echo $GLOBALS['web_root']; ?>/sites/americancaregivers/images/dydactlogocard.png" alt="dydact logo">
            <h1 class="login-title">iris</h1>
            <p class="login-subtitle"><?php echo $GLOBALS['login_tagline_text']; ?></p>
        </div>

        <form method="POST" id="login_form" autocomplete="off" action="../main/main_screen.php?auth=login&site=<?php echo attr($_SESSION['site_id']); ?>">
            <input type="hidden" name="new_login_session_management" value="1">

            <div class="form-group">
                <label for="authUser"><?php echo xlt('Username'); ?></label>
                <input type="text" class="form-control" id="authUser" name="authUser" placeholder="<?php echo xla('Username'); ?>" />
            </div>

            <div class="form-group">
                <label for="clearPass"><?php echo xlt('Password'); ?></label>
                <input type="password" class="form-control" id="clearPass" name="clearPass" placeholder="<?php echo xla('Password'); ?>" />
            </div>

            <?php
            // Display the facility drop-down list if there are more than one
            $facilityService = new FacilityService();
            $facilities = $facilityService->getAllFacility();
            if (count($facilities) > 1) {
                echo '<div class="form-group">';
                echo '<label for="facility">' . xlt('Facility') . '</label>';
                echo '<select class="form-control" name="facility" id="facility">';
                foreach ($facilities as $facility) {
                    echo '<option value="' . attr($facility['id']) . '">' . text($facility['name']) . '</option>';
                }
                echo '</select>';
                echo '</div>';
            }
            ?>

            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-login" onclick="transmit_form()"><?php echo xlt('Login'); ?></button>
            </div>
        </form>

        <p class="copyright">&copy; <?php echo date('Y'); ?> American Caregivers Incorporated<br/>
        Powered by <strong>dydact</strong> LLC</p>
    </div>

    <script>
    // Focus on the first input field
    document.getElementById('authUser').focus();
    </script>
</body>
</html> 