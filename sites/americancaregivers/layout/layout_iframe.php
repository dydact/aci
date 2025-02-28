<?php
/**
 * Custom layout file for American Caregivers Incorporated.
 * Incorporates text-based "iris" branding with dydact logos.
 *
 * @package OpenEMR
 */

// This code is adapted from the default OpenEMR layout

// Main header HTML display
$res = array();
?>
<!DOCTYPE html>
<html>
<head>
    <?php Header::setupHeader(
        $GLOBALS['encounter'] > 0 ?
        ['datetime-picker', 'common', 'compact-ui'] :
        ['datetime-picker', 'common']
    ); ?>
    <link rel="stylesheet" href="<?php echo $GLOBALS['web_root']; ?>/sites/americancaregivers/styles/iris-brand.css">
    
    <title><?php echo text($openemr_name); ?> <?php echo (!empty($title) ? " - $title" : ""); ?></title>
    
    <style>
        .navbar-custom {
            background-color: #ffffff;
            border-bottom: 1px solid #e7e7e7;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }
        
        .main-sidebar {
            background-color: #f8f9fa;
            border-right: 1px solid #e7e7e7;
        }
        
        .brand-iris {
            font-family: 'Montserrat', sans-serif;
            font-weight: 700;
            font-size: 24px;
            color: var(--iris-primary);
            letter-spacing: -0.5px;
        }
        
        .iris-logo-container {
            display: flex;
            align-items: center;
            padding: 10px 15px;
        }
        
        .iris-logo-img {
            height: 30px;
            width: auto;
            margin-right: 8px;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-md navbar-light bg-light navbar-custom">
        <div class="container-fluid">
            <div class="iris-logo-container">
                <img src="<?php echo $GLOBALS['web_root']; ?>/sites/americancaregivers/images/LOGO.png" alt="dydact Logo" class="iris-logo-img">
                <span class="brand-iris">iris</span>
            </div>
            
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo $GLOBALS['web_root']; ?>/interface/main/tabs/main.php">
                            <i class="fa fa-home"></i> <?php echo xlt('Home'); ?>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo $GLOBALS['web_root']; ?>/interface/main/messages/messages.php?form_active=1">
                            <i class="fa fa-envelope"></i> <?php echo xlt('Messages'); ?>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-user"></i> <?php echo xlt('Account'); ?>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="<?php echo $GLOBALS['web_root']; ?>/interface/usergroup/user_info.php">
                                <?php echo xlt('My Profile'); ?>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="<?php echo $GLOBALS['web_root']; ?>/interface/logout.php">
                                <?php echo xlt('Logout'); ?>
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    
    <!-- Now render the rest of the regular page content -->
    <?php 
    // Render the original OpenEMR content below
    // ... existing code ...
    ?>
</body>
</html> 