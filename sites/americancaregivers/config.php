<?php

use OpenEMR\Common\Crypto\CryptoGen;

// globals that require more security
//  The set of globals below can only be modified directly in this script (ie. can not be set while using OpenEMR) and
//  they will be encrypted while stored in globals object in memory (to not allow overriding of the global if bad actor
//  somehow gets access to globals).
// note that need to skip this block of code during upgrading (or else will have database issues since no keys table)
if (empty($GLOBALS['ongoing_sql_upgrade'])) {
    $cryptoGen = new CryptoGen();
    // Print command for spooling to printers, used by statements.inc.php
    //   This is the command to be used for printing (without the filename).
    //   The word following "-P" should be the name of your printer.  This
    //   example is designed for 8.5x11-inch paper with 1-inch margins,
    //   10 CPI, 6 LPI, 65 columns, 54 lines per page.
    // If lpr services are installed on Windows this setting will be similar
    //   Otherwise configure it as needed (print /d:PRN) might be an option for Windows parallel printers
    $GLOBALS['more_secure']['print_command'] = 'lpr -P HPLaserjet6P -o cpi=10 -o lpi=6 -o page-left=72 -o page-top=72';
    //Enscript command used by Hylafax.
    $GLOBALS['more_secure']['hylafax_enscript'] = 'enscript -M Letter -B -e^ --margins=36:36:36:36';
    foreach ($GLOBALS['more_secure'] as $key => $value) {
        $GLOBALS['more_secure'][$key] = $cryptoGen->encryptStandard($value);
    }
}

//used differently by different applications, intuit programs only like numbers
$GLOBALS['oer_config']['ofx']['bankid']     = "123456789";

//you can use this to match to an existing account in you accounting application
$GLOBALS['oer_config']['ofx']['acctid']     = "123456789";

//use FL for FLORIDA compatible format, leave blank for default
$GLOBALS['oer_config']['prescriptions']['format'] = "";

// Document storage repository document root. Must include a trailing slash.
$GLOBALS['oer_config']['documents']['repopath'] = $GLOBALS['OE_SITE_DIR'] . "/documents/";
$GLOBALS['oer_config']['documents']['file_command_path'] = "/usr/bin/file";

//Name of prescription graphic in interface/pic/ directory without preceding slash. Can be JPEG or PNG, normally 3 inches wide.
$GLOBALS['oer_config']['prescriptions']['logo_pic'] = "Rx.png";

// Name of signature graphic in interface/pic/ directory without preceding
// slash. Normally 3 inches wide.  This filename may include the string
// "{userid}" to indicate the numeric ID of the user, so that prescriptions
// can print with the correct provider's signature if you have multiple
// providers.  Also signature images are used only for faxed prescriptions,
// not printed prescriptions.
$GLOBALS['oer_config']['prescriptions']['sig_pic'] = "sig.png";
//Option to used signature graphic or not
$GLOBALS['oer_config']['prescriptions']['use_signature'] = false;

// To print the prescription medication area on a grey background:
$GLOBALS['oer_config']['prescriptions']['shading'] = false;

// only works with hylafax sendfax client, and sendfax must be in PATH
// assign 'sendfax' to turn fax sending on
$GLOBALS['oer_config']['prescriptions']['sendfax'] = '';

// asign a value here if there is any prefix needed to get dialing tone
// you can also append a comma to add a one second delay
// i.e. 9, will dial 9 for external tone, and wait a second.
$GLOBALS['oer_config']['prescriptions']['prefix'] = '';

// Similarly for bottle labels if you are dispensing drugs.  Note that paper
// size here or for prescriptions may be an array (0, 0, width, height).
// As above, these measurements are in points.
$GLOBALS['oer_config']['druglabels']['paper_size'] = array(0, 0, 216, 216);
$GLOBALS['oer_config']['druglabels']['left']   = 18;
$GLOBALS['oer_config']['druglabels']['right']  = 18;
$GLOBALS['oer_config']['druglabels']['top']    = 18;
$GLOBALS['oer_config']['druglabels']['bottom'] = 18;
$GLOBALS['oer_config']['druglabels']['logo_pic'] = 'druglogo.png';
$GLOBALS['oer_config']['druglabels']['disclaimer'] =
  'Caution: Federal law prohibits dispensing without a prescription. ' .
  'Use only as directed.';

// American Caregivers Incorporated client configuration
$GLOBALS['practice_name'] = "American Caregivers Incorporated";
$GLOBALS['practice_address'] = "2301 Broadbirch Drive, Ste 135";
$GLOBALS['practice_city'] = "Silver Spring";
$GLOBALS['practice_state'] = "MD";
$GLOBALS['practice_zip'] = "20904";

// dydact LLMs branding with text-based iris
$GLOBALS['openemr_name'] = "iris,";
$GLOBALS['login_tagline_text'] = "Powered by dydact LLMs";
$GLOBALS['css_header'] = "
/* Custom CSS for iris branding */
:root {
  --iris-primary: #6978E4;
  --iris-secondary: #7E8BF7;
  --iris-accent: #3F51B5;
  --iris-text: #333333;
}

/* Login page styling */
.login-content .form-signin {
  background-color: white !important;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1) !important;
  border-radius: 8px !important;
}

/* iris text styling */
.title-text {
  font-family: 'Montserrat', sans-serif !important;
  font-weight: 700 !important;
  font-size: 36px !important;
  color: var(--iris-primary) !important;
  letter-spacing: -0.5px !important;
}

/* Navbar brand */
.navbar-brand {
  font-family: 'Montserrat', sans-serif !important;
  font-weight: 600 !important;
}

/* General styling improvements */
.btn-primary {
  background-color: var(--iris-primary) !important;
  border-color: var(--iris-primary) !important;
}
.btn-primary:hover {
  background-color: var(--iris-secondary) !important;
  border-color: var(--iris-secondary) !important;
}
";

// Add missing global variables that were in the error logs
$GLOBALS['language_default'] = 'English (Standard)';
$GLOBALS['allow_debug_language'] = false;
$GLOBALS['language_menu_showall'] = false;
$GLOBALS['tiny_logo_1'] = '';
$GLOBALS['tiny_logo_2'] = '';
$GLOBALS['login_into_facility'] = false;
$GLOBALS['google_signin_client_id'] = '';
$GLOBALS['show_label_login'] = true;
$GLOBALS['show_tagline_on_login'] = true;
$GLOBALS['display_acknowledgements_on_login'] = false;
$GLOBALS['show_labels_on_login_form'] = true;
$GLOBALS['show_primary_logo'] = true;
$GLOBALS['primary_logo_width'] = '300';
$GLOBALS['logo_position'] = 'center';
$GLOBALS['secondary_logo_width'] = '100';
$GLOBALS['extra_logo_login'] = false;
$GLOBALS['secondary_logo_position'] = 'left';
$GLOBALS['login_page_layout'] = 'center';

//don't alter below this line unless you are an advanced user and know what you are doing

$GLOBALS['oer_config']['prescriptions']['logo'] = dirname(__FILE__) .
  "/../../interface/pic/" . $GLOBALS['oer_config']['prescriptions']['logo_pic'];
$GLOBALS['oer_config']['prescriptions']['signature'] = dirname(__FILE__) .
  "/../../interface/pic/" . $GLOBALS['oer_config']['prescriptions']['sig_pic'];

$GLOBALS['oer_config']['druglabels']['logo'] = dirname(__FILE__) .
  "/../../interface/pic/" . $GLOBALS['oer_config']['druglabels']['logo_pic'];

$GLOBALS['oer_config']['documents']['repository'] = $GLOBALS['oer_config']['documents']['repopath'];
