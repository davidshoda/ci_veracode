<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Scan_Veracode extends CI_Controller

{
  public $catalogs = array();
  public $backup_predot_suffix = "bak4";
 // an underscore will be added, alphanum only
  public $backup_predot_suffixes_previous = array(
    "bak1",
    "bak2",
    "bak3"
  );
  public $regex_envelope_spaces = array(
    "front" => '/^[ \t]*',
    "back" => '[ \t]*$/i'
  );
  public $regex_envelope = array(

    "front" => '/',
    "back" => '/i'
  );
  public $switch_filemodify_onoff = 0;
 /*0 for modify off, 1 for on*/
  public $switch_backup_onoff = 0;
 /*0 for local file backup off, 1 for on, backup must be on for modify on*/
  public function __construct()

  {
    parent::__construct();
    $this->load->library('Array_Helpers');
    $this->catalogs = array(
      "catalog1" => array(
        "this_catalog" => array(
          array(
            "search" => 'print \$html;',
            "replace" => 'print SingletonHtmlPurifier::get_instance()->purify($html);', /*space sensitive but not case sensitive*/
            "restrict2filenames" => array(
              "class.progressbar.php"
            ) , /*empty array turns pattern match off*/
            "extensions" => array(
              ".php",
              ".inc"
            ) , /*empty array for filter off: search on all extensions*/
            "linenumberfilter" => array(
              "floor" => 50,
              "ceiling" => 55
            ) ,
            /*linenumberfilter: scalar -1 for off for all lines, array array("floor"=>301,"ceiling"=>306) for filtering search on line numbers 301 to 313 inclusively*/
          ) ,
          array(
            "search" => '\$self = \$\_SERVER\[\"PHP_SELF\"\];',
            "replace" => '$self = strip_tags($_SERVER["PHP_SELF"]);',
            "restrict2filenames" => array(
              "class.qbr.php",
              "class.qbrtest.php"
            ) , /*empty array turns pattern match off*/
            "extensions" => array(
              ".php",
              ".inc"
            ) , /*empty array for filter off: search on all extensions*/
            "linenumberfilter" => - 1,
            /*linenumberfilter: scalar -1 for off for all lines, array array("floor"=>301,"ceiling"=>306) for filtering search on line numbers 301 to 313 inclusively*/
          ) ,
          array(
            "search" => 'print \$style \. "<div class=\'alert\'>\$msg <a href=\'\.\.\/index.php\?type=\$type\'\>Go back\<\/a\>\<\/div\>";',
            "replace" => 'print SingletonHtmlPurifier::get_instance()->purify($style . "<div class=\'alert\'>$msg <a href=\'../index.php?type=$type\'>Go back</a></div>");',
            "restrict2filenames" => array(
              "class.rebate.php"
            ) , /*empty array turns pattern match off*/
            "extensions" => array(
              ".php",
              ".inc"
            ) , /*empty array for filter off: search on all extensions*/
            "linenumberfilter" => - 1,
            /*linenumberfilter: scalar -1 for off for all lines, array array("floor"=>301,"ceiling"=>306) for filtering search on line numbers 301 to 313 inclusively*/
          ) ,
          array(
            "search" => 'echo \"Error loading \$fullpath\";',
            "replace" => 'echo SingletonHtmlPurifier::get_instance()->purify("Error loading $fullpath");',
            "restrict2filenames" => array(
              "class.vendorform.php"
            ) , /*empty array turns pattern match off*/
            "extensions" => array(
              ".php",
              ".inc"
            ) , /*empty array for filter off: search on all extensions*/
            "linenumberfilter" => - 1,
            /*linenumberfilter: scalar -1 for off for all lines, array array("floor"=>301,"ceiling"=>306) for filtering search on line numbers 301 to 313 inclusively*/
          ) ,
          array(
            "search" => 'echo \"\<li\>\<a href=\'\" \. \$_\SERVER\[\'PHP_SELF\'\] \. \"\?id=\$id\'\>\$name\<\/a\>\<\/li\>\"\;',
            "replace" => 'echo SingletonHtmlPurifier::get_instance()->purify("<li><a href=\'" . $_SERVER[\'PHP_SELF\'] . "?id=$id\'>$name</a></li>");',
            "restrict2filenames" => array(
              "class.vendorlist.php"
            ) , /*empty array turns pattern match off*/
            "extensions" => array(
              ".php",
              ".inc"
            ) , /*empty array for filter off: search on all extensions*/
            "linenumberfilter" => - 1,
            /*linenumberfilter: scalar -1 for off for all lines, array array("floor"=>301,"ceiling"=>306) for filtering search on line numbers 301 to 313 inclusively*/
          ) ,
          array(
            "search" => '\<h1\>\<\?php echo \$heading; \?\>\<\/h1\>',
            "replace" => '<h1><?php echo $this->security->xss_clean($heading); ?></h1>',
            "restrict2filenames" => array(
              "error_404.php"
            ) , /*empty array turns pattern match off*/
            "extensions" => array(
              ".php",
              ".inc"
            ) , /*empty array for filter off: search on all extensions*/
            "linenumberfilter" => - 1,
            /*linenumberfilter: scalar -1 for off for all lines, array array("floor"=>301,"ceiling"=>306) for filtering search on line numbers 301 to 313 inclusively*/
          ) ,
          array(
            "search" => '\<\?php echo \$message; \?\>',
            "replace" => '<?php echo $this->security->xss_clean($message); ?>',
            "restrict2filenames" => array(
              "error_404.php"
            ) , /*empty array turns pattern match off*/
            "extensions" => array(
              ".php",
              ".inc"
            ) , /*empty array for filter off: search on all extensions*/
            "linenumberfilter" => - 1,
            /*linenumberfilter: scalar -1 for off for all lines, array array("floor"=>301,"ceiling"=>306) for filtering search on line numbers 301 to 313 inclusively*/
          ) ,
          array(
            "search" => '\<p\>Severity\: \<\?php echo \$severity; \?\>\<\/p\>',
            "replace" => '<p>Severity: <?php echo strip_tags($severity); ?></p>',
            "restrict2filenames" => array(
              "error_php.php"
            ) , /*empty array turns pattern match off*/
            "extensions" => array(
              ".php",
              ".inc"
            ) , /*empty array for filter off: search on all extensions*/
            "linenumberfilter" => - 1,
          ) ,
          array(
            "search" => '\<p\>Message\:  \<\?php echo \$message; \?\>\<\/p\>',
            "replace" => '<p>Message:  <?php echo strip_tags($message); ?></p>',
            "restrict2filenames" => array(
              "error_php.php"
            ) , /*empty array turns pattern match off*/
            "extensions" => array(
              ".php",
              ".inc"
            ) , /*empty array for filter off: search on all extensions*/
            "linenumberfilter" => - 1,
          ) ,
          array(
            "search" => '<p>Filename\: \<\?php echo \$filepath; \?\>\<\/p\>',
            "replace" => '<p>Filename: <?php echo strip_tags($filepath); ?></p>',
            "restrict2filenames" => array(
              "error_php.php"
            ) , /*empty array turns pattern match off*/
            "extensions" => array(
              ".php",
              ".inc"
            ) , /*empty array for filter off: search on all extensions*/
            "linenumberfilter" => - 1,
          ) ,
          array(
            "search" => '\<p\>Line Number\: \<\?php echo \$line; \?\>\<\/p\>',
            "replace" => '<p>Line Number: <?php echo strip_tags($line); ?></p>',
            "restrict2filenames" => array(
              "error_php.php"
            ) , /*empty array turns pattern match off*/
            "extensions" => array(
              ".php",
              ".inc"
            ) , /*empty array for filter off: search on all extensions*/
            "linenumberfilter" => - 1,
          ) ,
          array(
            "search" => '\<\?php echo \$msg; \?\>',
            "replace" => '<?php echo SingletonHtmlPurifier::get_instance()->purify($msg); ?>',
            "restrict2filenames" => array() , /*empty array turns pattern match off*/
            "extensions" => array(
              ".php",
              ".inc"
            ) , /*empty array for filter off: search on all extensions*/
            "linenumberfilter" => - 1,
          ) ,
          array(
            "search" => '\: \<span class="name"\>\<\?php echo \$_smarty_tpl\-\>getVariable\(\'loggedin_username\'\)\-\>value;\?\>',
            "replace" => ': <span class="name"><?php echo strip_tags($_smarty_tpl->getVariable(\'loggedin_username\')->value);?>',
            "restrict2filenames" => array() , /*empty array turns pattern match off*/
            "extensions" => array(
              ".php",
              ".inc"
            ) , /*empty array for filter off: search on all extensions*/
            "linenumberfilter" => - 1,
          ) ,
          /**
           manually escape . \
           ' or "
           when using regex_str_esc
           */
          array(
            "search" => $this->regex_str_esc('<img src="\.\./images/title-add-report-<?php echo $_smarty_tpl->getVariable(\'lang\')->value;?>') ,
            "replace" => '<img src="../images/title-add-report-<?php echo strip_tags($_smarty_tpl->getVariable(\'lang\')->value);?>',
            "restrict2filenames" => array() ,
            "extensions" => array(
              ".php",
              ".inc"
            ) ,
            "linenumberfilter" => - 1,
          ) ,
          array(
            "search" => $this->regex_str_esc('<form enctype="multipart/form-data" name="healthcheck_form" id="healthcheck_form" class="form" method="post" action="<?php echo $_SERVER[\'PHP_SELF\'];?>') ,
            "replace" => '<form enctype="multipart/form-data" name="healthcheck_form" id="healthcheck_form" class="form" method="post" action="<?php echo strip_tags($_SERVER[\'PHP_SELF\']);?>',
            "restrict2filenames" => array() ,
            "extensions" => array(
              ".php",
              ".inc"
            ) ,
            "linenumberfilter" => - 1,
          ) ,
          array(
            "search" => $this->regex_str_esc('<input class="field rep required" name="customer_citystate" id="customer_citystate" type="text" maxlength="150" title="Please enter the customer city/state." value="<?php echo $_smarty_tpl->getVariable(\'customer_citystate\')->value;?>') ,
            "replace" => '<input class="field rep required" name="customer_citystate" id="customer_citystate" type="text" maxlength="150" title="Please enter the customer city/state." value="<?php echo $purifier->purify($_smarty_tpl->getVariable(\'customer_citystate\')->value);?>',
            "restrict2filenames" => array() ,
            "extensions" => array(
              ".php",
              ".inc"
            ) ,
            "linenumberfilter" => - 1,
          ) ,
          array(
            "search" => $this->regex_str_esc('<legend><?php echo $_smarty_tpl->getConfigVariable(\'provide_manufactuer_spec_info\');?>') ,
            "replace" => '<legend><?php echo $purifier->purify($_smarty_tpl->getConfigVariable(\'provide_manufactuer_spec_info\'));?>',
            "restrict2filenames" => array() ,
            "extensions" => array(
              ".php",
              ".inc"
            ) ,
            "linenumberfilter" => - 1,
          ) ,
          array(
            "search" => $this->regex_str_esc('<label for="addtl_audit_datacenter_cooling"><?php echo $_smarty_tpl->getConfigVariable(\'cooling\');?>') ,
            "replace" => '<label for="addtl_audit_datacenter_cooling"><?php echo $purifier->purify($_smarty_tpl->getConfigVariable(\'cooling\'));?>',
            "restrict2filenames" => array() ,
            "extensions" => array(
              ".php",
              ".inc"
            ) ,
            "linenumberfilter" => - 1,
          ) ,
          array(
            "search" => $this->regex_str_esc('<textarea class="textarea ignore" name="dcdiscovery_q1" cols="170" rows="5" id="dcdiscovery_q1"><?php echo $_smarty_tpl->getVariable(\'dcdiscovery_q1\')->value;?>') ,
            "replace" => '<textarea class="textarea ignore" name="dcdiscovery_q1" cols="170" rows="5" id="dcdiscovery_q1"><?php echo $purifier->purify($_smarty_tpl->getVariable(\'dcdiscovery_q1\')->value);?>',
            "restrict2filenames" => array() ,
            "extensions" => array(
              ".php",
              ".inc"
            ) ,
            "linenumberfilter" => - 1,
          ) ,
          array(
            "search" => $this->regex_str_esc('<textarea class="textarea ignore" name="dcdiscovery_q2" cols="170" rows="5" id="dcdiscovery_q2"><?php echo $_smarty_tpl->getVariable(\'dcdiscovery_q2\')->value;?>') ,
            "replace" => '<textarea class="textarea ignore" name="dcdiscovery_q2" cols="170" rows="5" id="dcdiscovery_q2"><?php echo $purifier->purify($_smarty_tpl->getVariable(\'dcdiscovery_q2\')->value);?>',
            "restrict2filenames" => array() ,
            "extensions" => array(
              ".php",
              ".inc"
            ) ,
            "linenumberfilter" => - 1,
          ) ,
          array(
            "search" => $this->regex_str_esc('<textarea class="textarea ignore" name="dcdiscovery_q3" cols="170" rows="5" id="dcdiscovery_q3"><?php echo $_smarty_tpl->getVariable(\'dcdiscovery_q3\')->value;?>') ,
            "replace" => '<textarea class="textarea ignore" name="dcdiscovery_q3" cols="170" rows="5" id="dcdiscovery_q3"><?php echo $purifier->purify($_smarty_tpl->getVariable(\'dcdiscovery_q3\')->value);?>',
            "restrict2filenames" => array() ,
            "extensions" => array(
              ".php",
              ".inc"
            ) ,
            "linenumberfilter" => - 1,
          ) ,
          array(
            "search" => $this->regex_str_esc('<textarea class="textarea ignore" name="dcdiscovery_q4" cols="170" rows="5" id="dcdiscovery_q4"><?php echo $_smarty_tpl->getVariable(\'dcdiscovery_q4\')->value;?>') ,
            "replace" => '<textarea class="textarea ignore" name="dcdiscovery_q4" cols="170" rows="5" id="dcdiscovery_q4"><?php echo $purifier->purify($_smarty_tpl->getVariable(\'dcdiscovery_q4\')->value);?>',
            "restrict2filenames" => array() ,
            "extensions" => array(
              ".php",
              ".inc"
            ) ,
            "linenumberfilter" => - 1,
          ) ,
          array(
            "search" => $this->regex_str_esc('<textarea class="textarea ignore" name="dcdiscovery_q5" cols="170" rows="5" id="dcdiscovery_q5"><?php echo $_smarty_tpl->getVariable(\'dcdiscovery_q5\')->value;?>') ,
            "replace" => '<textarea class="textarea ignore" name="dcdiscovery_q5" cols="170" rows="5" id="dcdiscovery_q5"><?php echo $purifier->purify($_smarty_tpl->getVariable(\'dcdiscovery_q5\')->value);?>',
            "restrict2filenames" => array() ,
            "extensions" => array(
              ".php",
              ".inc"
            ) ,
            "linenumberfilter" => - 1,
          ) ,
          array(
            "search" => $this->regex_str_esc('<textarea class="textarea ignore" name="dcdiscovery_q6" cols="170" rows="5" id="dcdiscovery_q6"><?php echo $_smarty_tpl->getVariable(\'dcdiscovery_q6\')->value;?>') ,
            "replace" => '<textarea class="textarea ignore" name="dcdiscovery_q6" cols="170" rows="5" id="dcdiscovery_q6"><?php echo $purifier->purify($_smarty_tpl->getVariable(\'dcdiscovery_q6\')->value);?>',
            "restrict2filenames" => array() ,
            "extensions" => array(
              ".php",
              ".inc"
            ) ,
            "linenumberfilter" => - 1,
          ) ,
          array(
            "search" => $this->regex_str_esc('<textarea class="textarea ignore" name="dcdiscovery_q7" cols="170" rows="5" id="dcdiscovery_q7"><?php echo $_smarty_tpl->getVariable(\'dcdiscovery_q7\')->value;?>') ,
            "replace" => '<textarea class="textarea ignore" name="dcdiscovery_q7" cols="170" rows="5" id="dcdiscovery_q7"><?php echo $purifier->purify($_smarty_tpl->getVariable(\'dcdiscovery_q7\')->value);?>',
            "restrict2filenames" => array() ,
            "extensions" => array(
              ".php",
              ".inc"
            ) ,
            "linenumberfilter" => - 1,
          ) ,
          array(
            "search" => $this->regex_str_esc('<td colspan="3"><form id="InstallSecurity" name="InstallSecurity" method="post" action="<?php echo $_SERVER["PHP_SELF"] ?>" enctype="multipart/form-data" onsubmit="return CheckForm(this);"><input style="display: none;" type="submit">') ,
            "replace" => '<td colspan="3"><form id="InstallSecurity" name="InstallSecurity" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" enctype="multipart/form-data" onsubmit="return CheckForm(this);"><input style="display: none;" type="submit">',
            "restrict2filenames" => array() ,
            "extensions" => array(
              ".php",
              ".inc"
            ) ,
            "linenumberfilter" => - 1,
          ) ,
          array(
            "search" => $this->regex_str_esc('echo "<input type=\'hidden\' name=\'customer_id\' value=\'"\.$_SESSION[id]\."\' />";') ,
            "replace" => 'echo "<input type=\'hidden\' name=\'customer_id\' value=\'"\.$purifier->purify($_SESSION[id])\."\' />";',
            "restrict2filenames" => array() ,
            "extensions" => array(
              ".php",
              ".inc"
            ) ,
            "linenumberfilter" => - 1,
          ) ,
        ) ,
        "switch_catalog_scan_onoff" => 0, /*0 for scan off, 1 for on*/
        /* "base_directory"=>"../admin2/dshoda/test_veracode_content",*/
        "base_directory" => "..",
        "recursive_scan" => true,
      ) /* end this_catalog */
      , /* end catalog1 */
      "catalog2" => array(
        "this_catalog" => array(
          array(
            "search" => $this->regex_str_esc('print $row[\'document\'];') ,
            "replace" => 'print SingletonHtmlPurifier::get_instance()->purify($row[\'document\']);',
            "restrict2filenames" => array(
              "qbr.php"
            ) ,
            "extensions" => array(
              ".php",
              ".inc"
            ) ,
            "linenumberfilter" => - 1,
          ) ,
          array(
            "search" => $this->regex_str_esc('<title>Customer Usage Report: <?php echo $_SERVER[\"HTTP_HOST\"];?> </title>') ,
            "replace" => '<title>Customer Usage Report: <?php echo $this->security->xss_clean($_SERVER["HTTP_HOST"]);?> </title>',
            "restrict2filenames" => array(
              "view_csv_usage_log.php"
            ) ,
            "extensions" => array(
              ".php",
              ".inc"
            ) ,
            "linenumberfilter" => - 1,
          ) ,
          array(
            "search" => $this->regex_str_esc('<h1>Customer Usage Report: <?php echo $_SERVER[\"HTTP_HOST\"];?> </h1>') ,
            "replace" => '<h1>Customer Usage Report: <?php echo $this->security->xss_clean($_SERVER["HTTP_HOST"]);?> </h1>',
            "restrict2filenames" => array(
              "view_csv_usage_log.php"
            ) ,
            "extensions" => array(
              ".php",
              ".inc"
            ) ,
            "linenumberfilter" => - 1,
          ) ,
        ) ,
        "switch_catalog_scan_onoff" => 0, /*0 for scan off, 1 for on*/
        /* "base_directory"=>"../admin2/dshoda/test_veracode_content",*/
        "base_directory" => "..",
        "recursive_scan" => true,
      ) /* end this_catalog */
      , /* end catalog1 */
      "catalog3" => array(
        "this_catalog" => array(
          array(
            "search" => $this->regex_str_esc('$ubicacion_url = $_GET[\'ubicacion\'];') ,
            "replace" => '$ubicacion_url = strip_tags($_GET[\'ubicacion\']);',
            "restrict2filenames" => array(
              "weather_f.php"
            ) ,
            "extensions" => array(
              ".php",
              ".inc"
            ) ,
            "linenumberfilter" => array(
              "floor" => 1,
              "ceiling" => 5
            ) ,
          ) ,
          array(
            "search" => $this->regex_str_esc('$headers = "From: " \. $_POST["name"] \. "<" \. $_POST["email"] \.">\\\\r\\\\n";') ,
            "replace" => '$headers = "From: " . strip_tags($_POST["name"]) . "<" . strip_tags($_POST["email"]) .">\r\n";',
            "restrict2filenames" => array(
              "emailinventory.php",
              "email.php"
            ) ,
            "extensions" => array(
              ".php",
              ".inc"
            ) ,
            "linenumberfilter" => - 1,
          ) ,
          array(
            "search" => $this->regex_str_esc('$headers \.= "Reply-To: " \. $_POST["email"] \. "\\\\r\\\\n";') ,
            "replace" => '$headers .= "Reply-To: " . strip_tags($_POST["email"]) . "\r\n";',
            "restrict2filenames" => array(
              "emailinventory.php",
              "email.php"
            ) ,
            "extensions" => array(
              ".php",
              ".inc"
            ) ,
            "linenumberfilter" => - 1,
          ) ,
          array(
            "search" => $this->regex_str_esc('$headers \.= "Return-path: " \. $_POST["email"];') ,
            "replace" => '$headers .= "Return-path: " . strip_tags($_POST["email"]);',
            "restrict2filenames" => array(
              "emailinventory.php",
              "email.php"
            ) ,
            "extensions" => array(
              ".php",
              ".inc"
            ) ,
            "linenumberfilter" => - 1,
          ) ,
          array(
            "search" => $this->regex_str_esc('$message = "A leads submission list has been sent by: " \. $_POST["name"] \. "\\\\n\\\\n" \. "These are the selected leads:" \. "\\\\n\\\\n" \. $_POST["selectedLeads"];') ,
            "replace" => '$message = "A leads submission list has been sent by: " .strip_tags( $_POST["name"]) . "\n\n" . "These are the selected leads:" . "\n\n" . strip_tags($_POST["selectedLeads"]);',
            "restrict2filenames" => array(
              "emailinventory.php",
              "email.php"
            ) ,
            "extensions" => array(
              ".php",
              ".inc"
            ) ,
            "linenumberfilter" => - 1,
          ) ,
          array(
            "search" => $this->regex_str_esc('$subject = $_REQUEST["subject"];') ,
            "replace" => '$subject = htmlspecialchars($_REQUEST["subject"]);',
            "restrict2filenames" => array(
              "email_accessories.php"
            ) ,
            "extensions" => array(
              ".php",
              ".inc"
            ) ,
            "linenumberfilter" => - 1,
          ) ,
          array(
            "search" => $this->regex_str_esc('$message = $_REQUEST["message"];') ,
            "replace" => '$message = htmlspecialchars($_REQUEST["message"]);',
            "restrict2filenames" => array(
              "email_accessories.php"
            ) ,
            "extensions" => array(
              ".php",
              ".inc"
            ) ,
            "linenumberfilter" => - 1,
          ) ,
          array(
            "search" => $this->regex_str_esc('$sender = $_REQUEST["sender"];') ,
            "replace" => '$sender = htmlspecialchars($_REQUEST["sender"]);',
            "restrict2filenames" => array(
              "email_accessories.php"
            ) ,
            "extensions" => array(
              ".php",
              ".inc"
            ) ,
            "linenumberfilter" => - 1,
          ) ,
          array(
            "search" => $this->regex_str_esc('$contactInfo = $_REQUEST["contactInfo"];') ,
            "replace" => '$contactInfo = htmlspecialchars($_REQUEST["contactInfo"]);',
            "restrict2filenames" => array(
              "email_accessories.php"
            ) ,
            "extensions" => array(
              ".php",
              ".inc"
            ) ,
            "linenumberfilter" => - 1,
          ) ,
          array(
            "search" => $this->regex_str_esc('}else $_referer = $_POST["_referer"];') ,
            "replace" => '}else $_referer = strip_tags($_POST["_referer"]);',
            "restrict2filenames" => array(
              "index.php"
            ) ,
            "extensions" => array(
              ".php",
              ".inc"
            ) ,
            "linenumberfilter" => - 1,
          ) ,
          array(
            "search" => $this->regex_str_esc('$headers = "From: " \. $_POST["requester_name"] \. "<" \. $_POST["requester_email"] \.">\\\\r\\\\n";') ,
            "replace" => '$headers = "From: " \. strip_tags($_POST["requester_name"]) \. "<" \. strip_tags($_POST["requester_email"]) \.">\r\n";',
            "restrict2filenames" => array(
              "email.php"
            ) ,
            "extensions" => array(
              ".php",
              ".inc"
            ) ,
            "linenumberfilter" => - 1,
          ) ,
          array(
            "search" => $this->regex_str_esc('$headers \.= "Reply-To: " \. $_POST["requester_email"] \. "\\\\r\\\\n";') ,
            "replace" => '$headers \.= "Reply-To: " . strip_tags($_POST["requester_email"]) . "\r\n";',
            "restrict2filenames" => array(
              "email.php"
            ) ,
            "extensions" => array(
              ".php",
              ".inc"
            ) ,
            "linenumberfilter" => - 1,
          ) ,
          array(
            "search" => $this->regex_str_esc('$headers \.= "Return-path: " \. $_POST["requester_email"];') ,
            "replace" => '$headers \.= "Return-path: " \. strip_tags($_POST["requester_email"]);',
            "restrict2filenames" => array(
              "email.php"
            ) ,
            "extensions" => array(
              ".php",
              ".inc"
            ) ,
            "linenumberfilter" => - 1,
          ) ,
          /*Issue with this email*/
          array(
            "search" => $this->regex_str_esc('$message = strip_tags($_POST[requester_name]) \. " ("\.strip_tags($_POST[requester_email])\.") made a lead(s) request on "\.$date_on\." at "\.$date_at\."\.  It was made from a(n) "\.$customer_company_name \. " account login on edgebps\.com\.\\\\n\\\\n";') ,
            "replace" => '$message = strip_tags($_POST[requester_name]) \. " ("\.strip_tags($_POST[requester_email])\.") made a lead(s) request on "\.$date_on\." at "\.$date_at\."\.  It was made from a(n) "\.$customer_company_name \. " account login on edgebps\.com\.\n\n";',
            "restrict2filenames" => array(
              "email.php"
            ) ,
            "extensions" => array(
              ".php",
              ".inc"
            ) ,
            "linenumberfilter" => - 1,
          ) ,
          array(
            "search" => $this->regex_str_esc('$message = "A opportunities submission list has been sent by: " \. $_POST["name"] \. "\\\\n\\\\n" \. "These are the opportunities leads:" \. "\\\\n\\\\n" \. $_POST["selectedLeads"];') ,
            "replace" => '$message = "A opportunities submission list has been sent by: " \. strip_tags($_POST["name"]) \. "\\\\n\\\\n" \. "These are the opportunities leads:" \. "\\\\n\\\\n" \. strip_tags($_POST["selectedLeads"]);',
            "restrict2filenames" => array(
              "email.php"
            ) ,
            "extensions" => array(
              ".php",
              ".inc"
            ) ,
            "linenumberfilter" => - 1,
          ) ,
          array(
            "search" => $this->regex_str_esc('$file = $_GET[\'file\'];') ,
            "replace" => '$file = strip_tags($_GET[\'file\']);',
            "restrict2filenames" => array(
              "index.php"
            ) ,
            "extensions" => array(
              ".php",
              ".inc"
            ) ,
            "linenumberfilter" => - 1,
          ) ,
          array(
            "search" => $this->regex_str_esc('$password = $_POST[\'accountPassword\'];') ,
            "replace" => '$password = strip_tags($_POST[\'accountPassword\']);',
            "restrict2filenames" => array(
              "save.php"
            ) ,
            "extensions" => array(
              ".php",
              ".inc"
            ) ,
            "linenumberfilter" => - 1,
          ) ,
          array(
            "search" => $this->regex_str_esc('^$_referer = $_POST["_referer"];') ,
            "replace" => '$_referer = strip_tags($_POST["_referer"]);',
            "restrict2filenames" => array(
              "index.php"
            ) ,
            "extensions" => array(
              ".php",
              ".inc"
            ) ,
            "linenumberfilter" => - 1,
          ) ,
          /*
          array(
          "search"=>
          $this->regex_str_esc(
          ''
          ),
          "replace"=>
          ''
          ,
          "restrict2filenames"=>array("email_accessories.php"),
          "extensions"=>array(".php",".inc"),
          "linenumberfilter"=>-1,
          ),
          */
        ) ,
        "switch_catalog_scan_onoff" => 1, /*0 for scan off, 1 for on*/
        /* "base_directory"=>"../admin2/dshoda/test_veracode_content",*/
        "base_directory" => "../..",
        "recursive_scan" => true,
      ) /* end this_catalog */
      /* , */
      /* end catalog1 */
    );
  }
  /**
   * Index Page for this controller.
   *
   * Maps to the following URL
   *    http://example.com/index.php/welcome
   *  - or -
   *    http://example.com/index.php/welcome/index
   *  - or -
   * Since this controller is set as the default controller in
   * config/routes.php, it's displayed at http://example.com/
   *
   * So any other public methods not prefixed with an underscore will
   * map to /index.php/welcome/<method_name>
   * @see http://codeigniter.com/user_guide/general/urls.html
   */
  public function index()

  {
    // $this->load->model('Model_leads_xml2db_transform');
    // $data['next_upload_id_result'] = $this->Model_leads_xml2db_transform->get_next_upload_id_result();
    // $data['xml'] = simplexml_load_file(BASEPATH.'../../../xml/content/leads/BPS_Leads.xml');
    // $this->load->view('view_scan', $data);
  }
  public function content()

  {
    global $counter; //recursion increment
    global $extension_counter;
    global $found_num_lines, $fileList, $found_num_files;
    global $regex_current;
    // $this->array_helpers->testing();
    $catalogs_on_count = 0;
    foreach($this->catalogs AS $key_catalog => $val_catalog) {
      if ($val_catalog["switch_catalog_scan_onoff"] == 1) $catalogs_on_count++;
    }
    if ($catalogs_on_count > 1) {
      echo "error: only one catalog can be on per scan";
      exit;
    }
    if ($catalogs_on_count < 1) {
      echo "error: no catalogs on, must have one on to run scan";
      exit;
    }
    foreach($this->catalogs AS $key_catalog => $val_catalog) {
      if ($val_catalog["switch_catalog_scan_onoff"] != 1) continue;
      echo "<p>";
      echo "<hr />";
      echo "</p>";
      echo "<p>";
      echo "<b>" . $key_catalog . " Scan START</b>";
      echo "</p>";
      foreach($val_catalog["this_catalog"] AS $this_catalog_item) {
        echo "Catalog Top Level Directory Start: " . $val_catalog["base_directory"];
        echo "<br/>";
        echo "Search Pattern: <code>" . htmlentities($this_catalog_item["search"]) . "</code>";
        echo "<br/>";
        echo "Replace String: <code>" . htmlentities($this_catalog_item["replace"]) . "</code>";
        echo "<br/>";
        echo "Backup On/Off Switch: " . $this->switch_backup_onoff;
        echo "<br/>";
        echo "File Modify On/Off Switch: " . $this->switch_filemodify_onoff;
        echo "<br/>";
        echo "Restrict to Filenames: ";
        echo "<br/>";
        foreach($this_catalog_item["restrict2filenames"] AS $k => $v) echo $v . " ";
        if (sizeof($this_catalog_item["restrict2filenames"]) == 0) echo "[ all ]";
        echo "<br/>";
        echo "Backup Predot Suffix: " . $this->backup_predot_suffix;
        echo "<br/>";
        echo "Backup Previous Predot Suffix: ";
        echo "<br/>";
        foreach($this->backup_predot_suffixes_previous AS $k => $v) echo $v . " ";
        echo "<br/>";
        echo "Filetype(s)/extension(s): ";
        foreach($this_catalog_item["extensions"] AS $k => $v) echo $v . " ";
        if (sizeof($this_catalog_item["extensions"]) == 0) echo "[ all ]";
        echo "<br/>";
        echo "File line number filter: ";
        print_r($this_catalog_item["linenumberfilter"]);
        $found_num_lines = 0;
        $found_num_files = 0;
        $extension_counter = 0;
        $counter = 0;
        echo "<p>";
        /*
        $nfiles =
        $this->scanContent_getFiles(
        $this_catalog_item["search"],$this_catalog_item["replace"],$val_catalog["base_directory"], $val_catalog["recursive_scan"],
        $counter,$this_catalog_item["extensions"],$this_catalog_item["linenumberfilter"]);
        */
        $nfiles = $this->scanContent_getFiles($val_catalog, $this_catalog_item, $counter, $val_catalog["base_directory"]);
        echo "</p>";
        echo "<p>";
        echo "<b>Searched " . $extension_counter . " files recursively on base directory and all subdirectories of base directory</b><br/>";
        echo "<b>" . $found_num_lines . " match(es) found in " . $found_num_files . " files for </b><br/>";
        echo "<b>replaced line(s) matching <br/><code>" . htmlentities($this_catalog_item["search"]) . "</code></b><br/>";
        echo "<b>with line(s) <br/><code>" . htmlentities($this_catalog_item["replace"]) . "</code></b><br/>";
        echo "</p>";
        echo "<p>";
        echo "=================================";
        echo "</p>";
      }
      echo "<p>";
      echo "<b>" . $key_catalog . " Scan DONE</b>";
      echo "</p>";
    }
  }
  /**
   * Return the number of files that resides under a directory.
   *
   * @return integer
   * @param    string (required)   The directory you want to start in
   * @param    boolean (optional)  Recursive counting. Default to FALSE.
   * @param    integer (optional)  Initial value of file count
   */
  //  function scanContent_getFiles($regex_search,$replace,$dir, $recursive=false, $counter=0,$extensions,$linenumberfilter) {
  function scanContent_getFiles($val_catalog, $this_catalog_item, $counter = 0, $dir)
  {
    global $counter; //recursion increment
    global $extension_counter;
    if (trim($this_catalog_item["search"]) == '' || !isset($this_catalog_item["search"])) {
      echo "error: search or replace variable not set";
      exit;
    }
    if (is_dir($dir)) {
      if ($dh = opendir($dir)) {
        while (($file = readdir($dh)) !== false) {
          if ($file != "." && $file != ".." && $this->is_backup_file($file) != 1) {
            $counter = (is_dir($dir . "/" . $file)) ? $this->scanContent_getFiles($val_catalog, $this_catalog_item, $counter, $dir . "/" . $file) : $counter + 1;
            if (!is_dir($dir . "/" . $file)) { //only files, no dirs
              if (sizeof($this_catalog_item["extensions"]) == 0 && (in_array($file, $this_catalog_item["restrict2filenames"]) || sizeof($this_catalog_item["restrict2filenames"]) < 1)) {
                /*
                echo "-------------------";
                echo "<br/>";
                echo "Searching: ".realpath($dir."/".$file);
                echo "<br/>";
                echo "on regex search line: <code>".htmlentities($this_catalog_item["search"])."</code>";
                echo "for replace line: <code>".htmlentities($this_catalog_item["replace"])."</code>";
                */
                $matches_found = $this->readLines(realpath($dir . "/" . $file) , $this_catalog_item["search"], $this_catalog_item["replace"], $this_catalog_item["linenumberfilter"]);
                if ($matches_found > 0) {
                  echo "<br/>";
                  echo "---------";
                  echo "<br/>";
                  echo "Search matches returned";
                  echo "<br/>";
                  echo $matches_found . " match(es) found";
                  echo "<br/>";
                  echo "in " . realpath($dir . "/" . $file);
                  echo "<br/>";
                  echo "on regex search line: " . htmlentities($this_catalog_item["search"]);
                  echo "<br/>";
                  echo "for replace line: " . htmlentities($this_catalog_item["replace"]);
                }
                else {
                  echo "<br/>";
                  echo "---------";
                  echo "<br/>";
                  echo "Search matches not returned from search in ";
                  echo "<br/>";
                  echo "in " . realpath($dir . "/" . $file);
                  echo "<br/>";
                  echo "on regex search line: " . htmlentities($this_catalog_item["search"]);
                  echo "<br/>";
                  echo "for replace line: " . htmlentities($this_catalog_item["replace"]);
                }
                $extension_counter++;
              }
              else {
                foreach($this_catalog_item["extensions"] AS $k => $v) {
                  if (strpos($dir . "/" . $file, $v, 1) && (in_array($file, $this_catalog_item["restrict2filenames"]) || sizeof($this_catalog_item["restrict2filenames"]) < 1)) {
                    /*
                    echo "-------------------";
                    echo "<br/>";
                    echo "Searching: ".realpath($dir."/".$file);
                    echo "<br/>";
                    echo "on regex search line: ".htmlentities($this_catalog_item["search"]);
                    echo "<br/>";
                    echo "for replace line: ".htmlentities($this_catalog_item["replace"]);
                    */
                    $matches_found = $this->readLines(realpath($dir . "/" . $file) , $this_catalog_item["search"], $this_catalog_item["replace"], $this_catalog_item["linenumberfilter"]);
                    if ($matches_found > 0) {
                      echo "<br/>";
                      echo "---------";
                      echo "<br/>";
                      echo "Search matches returned";
                      echo "<br/>";
                      echo $matches_found . " match(es) found";
                      echo "<br/>";
                      echo "in " . realpath($dir . "/" . $file);
                      echo "<br/>";
                      echo "on regex search line: " . htmlentities($this_catalog_item["search"]);
                      echo "<br/>";
                      echo "for replace line: " . htmlentities($this_catalog_item["replace"]);
                    }
                    else {
                      echo "<br/>";
                      echo "---------";
                      echo "<br/>";
                      echo "Search matches not returned";
                      echo "<br/>";
                      echo "in " . realpath($dir . "/" . $file);
                      echo "<br/>";
                      echo "on regex search line: " . htmlentities($this_catalog_item["search"]);
                      echo "<br/>";
                      echo "for replace line: " . htmlentities($this_catalog_item["replace"]);
                    }
                    $extension_counter++;
                  }
                }
              }
            }
          }
        }
        closedir($dh);
      }
    }
    return $counter;
  }
  function readLines($filepath, $regex_search, $replace, $linenumberfilter)
  {
    global $found_num_lines, $fileList, $found_num_files;
    $lines_arr = file($filepath);
    $file = fopen($filepath, "r") or exit("Unable to open file!");
    $line_num = 1;
    $thisread_found_num = 0;
    while (!feof($file)) {
      $fileLine = fgets($file);
      if (preg_match($this->regex_envelope_spaces["front"] . $regex_search . $this->regex_envelope_spaces["back"], $fileLine)) {
        if ($linenumberfilter == - 1 || (is_array($linenumberfilter) && $linenumberfilter["floor"] <= $line_num && $linenumberfilter["ceiling"] >= $line_num)) {
          if ($thisread_found_num == 0) echo "<br/>-------------------";
          echo "<br/>Line #<b>{$line_num}</b> : <code>" . htmlentities($fileLine) . "</code>";
          $lines_arr = $this->array_helpers->array_replace($lines_arr, $regex_search, $replace, $line_num, $this);
          ++$thisread_found_num;
        }
      }
      $line_num++;
    }
    if ($thisread_found_num > 0) $found_num_files++;
    // echo "<br/>".$thisread_found_num." match(es) found<br/>";
    if ($thisread_found_num > 0 && $this->switch_backup_onoff == 1) {
      $this->file_local_backup($filepath, dirname($filepath) , basename($filepath));
      if ($this->switch_filemodify_onoff == 1) {
        echo "Updating file:<br/>";
        echo "$filepath<br/>";
        $this->array_helpers->array_writefile($filepath, $lines_arr);
        echo nl2br("update complete\n");
      }
    }
    $found_num_lines = $found_num_lines + $thisread_found_num;
    fclose($file);
    // exit;
    return $thisread_found_num;
  }
  function output_filename($dir, $file)
  {
    echo "<code>" . $dir . "/" . $file . "</code>";
  }
  function get_filename_stat($dir, $file)
  {
    return stat($dir . "/" . $file);
  }
  function file_local_backup($filepath, $path, $filename)
  {
    $file_to_backup = $filename;
    if ($handle = opendir($path)) {
      while (false !== ($file = readdir($handle))) {
        if ($file == $filename) {
          $dir_fullpath = $path . $file;
          $index_fullpath = $filepath;
          if (file_exists($filepath)) { //if there isnt already a backup with this predot suffix
            // $filepath_backup = $filepath.$predot_suffix ;
            $filepath_backup = preg_replace("/\./i", "_" . $this->backup_predot_suffix . ".", $filepath, 1); //replace dot with suffix then dot
            echo "<br/>-------------------<br/>";
            if (!file_exists($filepath_backup)) {
              if ($this->is_backup_file($file) != 1) { //not current or prev backup file
                echo nl2br("Backing up file:\n");
                echo nl2br("$filepath\n");
                echo nl2br("to:\n");
                echo nl2br("$filepath_backup\n");
                copy($filepath, $filepath_backup);
                echo nl2br("Backup created before modification(s)\n");
              }
            }
            else {
              echo nl2br("Backup already exists, modify catalog pre dot suffix for making another backup\n");
            }
          }
        }
      }
      closedir($handle);
    }
  }
  /**
   Returns 1 if backup file, returns 0 if not a backup file
   */
  function is_backup_file($file)
  {
    $backup_file = 0;
    // no backups of backups of most recent or previous
    foreach($this->backup_predot_suffixes_previous AS $prev_backup) {
      if (preg_match("/" . $prev_backup . "/i", $file)) {
        $backup_file = 1;
        // echo nl2br("Backup already exists on previous predot suffix, modify catalog pre dot suffix for making another backup\n");
      }
    }
    if (preg_match("/" . $this->backup_predot_suffix . "/i", $file)) {
      $backup_file = 1;
      // echo nl2br("Previous backup already exists on this predot suffix, modify catalog pre dot suffix for making another backup\n");
    }
    return $backup_file;
  }
  /*
  Escape for regex these chars:
  from preg_quote:
  .\+*?[^]$(){}=!<>|:-
  as
  /\+*?[^]$(){}!<>|:-
  does not need escaping
  =
  needs escaping
  /
  manually add forward slashes to
  "
  '
  .
  \
  manually add three backslashes before
  \
  as
  \\\\
  */
  function regex_str_esc($str)
  {
    $str = str_replace('/', '\/', $str);
    // $str = str_replace('\\','\\\\',$str);
    $str = str_replace('+', '\\+', $str);
    $str = str_replace('*', '\\*', $str);
    $str = str_replace('?', '\\?', $str);
    $str = str_replace('[', '\\[', $str);
    // $str = str_replace('^','\\^',$str);   //regex begin line
    $str = str_replace(']', '\\]', $str);
    $str = str_replace('$', '\$', $str);
    $str = str_replace('(', '\(', $str);
    $str = str_replace(')', '\)', $str);
    $str = str_replace('{', '\{', $str);
    $str = str_replace('}', '\}', $str);
    $str = str_replace('!', '\!', $str);
    $str = str_replace('<', '\<', $str);
    $str = str_replace('>', '\>', $str);
    $str = str_replace('|', '\|', $str);
    $str = str_replace(':', '\:', $str);
    $str = str_replace('-', '\-', $str);
    // $str = str_replace('_','\_',$str);
    return $str;
  }
}
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */