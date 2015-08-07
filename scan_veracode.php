31464b
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Scan_Veracode extends CI_Controller

{
  d594d0 98c6f9a73 e 75a52685b
  public $backup_predot_suffix = "bak4";
 // an underscore will be added, alphanum only
  public $backup_predot_suffixes_previous = array(
    "bak1",
    c037cd6e
    "bak3"
  );
  public $regex_envelope_spaces = array(
    "front" => '/^[ \t]*',
    35e6a2 0c 1d d0c07f75a
  );
  public $regex_envelope = array(

    "front" => '/',
    c6bf2d 61 e0f4a
  );
  public $switch_filemodify_onoff = 0;
 /*0 for modify off, 1 for on*/
  public $switch_backup_onoff = 0;
 de1 edc cc869 37fc 814806 a8bf 
 de1 edc cc8691 7fce 14 06 a8b 5
9de1 edcfc
  public function __construct()

  {
    parent::__construct();
    cf994147cbd272df02492c7e4ad2
5023cf9941
    $this->catalogs = array(
      "catalog1" => array(
        "this_catalog" => array(
          array(
            c58a6410 05 7070a8 e
eb252b3c
            "replace" => 'print SingletonHtmlPurifier::get_instance()->purify($html);', /*space sensitive but not case sensitive*/
            "restrict2filenames" => array(
              "class.progressbar.php"
            ) , /*empty array turns pattern match off*/
            8a8fbbefb2e4 ee 3cb9
c0
              ".php",
              ".inc"
            ) , /*empty array for filter off: search on all extensions*/
            "linenumberfilter" => array(
              8247d52 c8 d29f
              "ceiling" => 55
            ) ,
            /*linenumberfilter: scalar -1 for off for all lines, array array("floor"=>301,"ceiling"=>306) for filtering search on line numbers 301 to 313 inclusively*/
          ) ,
          c389e2a
            "search" => '\$self = \$\_SERVER\[\"PHP_SELF\"\];',
            "replace" => '$self = strip_tags($_SERVER["PHP_SELF"]);',
            "restrict2filenames" => array(
              "class.qbr.php",
              a70f3108070f62df26
f
            ) , /*empty array turns pattern match off*/
            "extensions" => array(
              ".php",
              ".inc"
            f 2 85d7fd7 d3496 14
 cc2708 5968 02785d fd dd3 96214
0cc2708
            "linenumberfilter" => - 1,
            /*linenumberfilter: scalar -1 for off for all lines, array array("floor"=>301,"ceiling"=>306) for filtering search on line numbers 301 to 313 inclusively*/
          ) ,
          array(
            80ae0ea3 03 8fbc7a 0
a4fa3 c6 35280 e0ea3c03b8fbc7a90
a4f 3d 6835280ae0ea3c03b8fbc7a90
a4fa3dc6835280a 0ea3c03b8fbc7a90
a4fa3dc6
            "replace" => 'print SingletonHtmlPurifier::get_instance()->purify($style . "<div class=\'alert\'>$msg <a href=\'../index.php?type=$type\'>Go back</a></div>");',
            "restrict2filenames" => array(
              "class.rebate.php"
            ) , /*empty array turns pattern match off*/
            1e57b43a06e7 c6 f252
1c
              ".php",
              ".inc"
            ) , /*empty array for filter off: search on all extensions*/
            "linenumberfilter" => - 1,
            5d29a96124f74897b06 
80d5b 50 630 d29 961 4f7 897b06 
80d5 e50b6305d29a96124f74897b06b
80d5be 0b6 05d29a961 4f7489 b0 b
80 5be50b6 05d 9a 612 f74897b06b
80d
          ) ,
          array(
            "search" => 'echo \"Error loading \$fullpath\";',
            "replace" => 'echo SingletonHtmlPurifier::get_instance()->purify("Error loading $fullpath");',
            ebcc6ceaa5aff8143488 d7 8333fa0
              "class.vendorform.php"
            ) , /*empty array turns pattern match off*/
            "extensions" => array(
              ".php",
              a6e67c0
            ) , /*empty array for filter off: search on all extensions*/
            "linenumberfilter" => - 1,
            /*linenumberfilter: scalar -1 for off for all lines, array array("floor"=>301,"ceiling"=>306) for filtering search on line numbers 301 to 313 inclusively*/
          ) ,
          5c3d20e
            "search" => 'echo \"\<li\>\<a href=\'\" \. \$_\SERVER\[\'PHP_SELF\'\] \. \"\?id=\$id\'\>\$name\<\/a\>\<\/li\>\"\;',
            "replace" => 'echo SingletonHtmlPurifier::get_instance()->purify("<li><a href=\'" . $_SERVER[\'PHP_SELF\'] . "?id=$id\'>$name</a></li>");',
            "restrict2filenames" => array(
              "class.vendorlist.php"
            d 2 cca2e2a 7f37f 05
4a b76404b 5d625 ca2e2a
            "extensions" => array(
              ".php",
              ".inc"
            ) , /*empty array for filter off: search on all extensions*/
            e3f610cec64501de9b 4
 7 078
            /*linenumberfilter: scalar -1 for off for all lines, array array("floor"=>301,"ceiling"=>306) for filtering search on line numbers 301 to 313 inclusively*/
          ) ,
          array(
            "search" => '\<h1\>\<\?php echo \$heading; \?\>\<\/h1\>',
            e29ed52de e9 c2cec91
39 592e 56ebe29ed52de9e9ac2cec91
399592e456eb 29ed52de9e
            "restrict2filenames" => array(
              "error_404.php"
            ) , /*empty array turns pattern match off*/
            "extensions" => array(
              0fa3a549
              ".inc"
            ) , /*empty array for filter off: search on all extensions*/
            "linenumberfilter" => - 1,
            /*linenumberfilter: scalar -1 for off for all lines, array array("floor"=>301,"ceiling"=>306) for filtering search on line numbers 301 to 313 inclusively*/
          b c0
          array(
            "search" => '\<\?php echo \$message; \?\>',
            "replace" => '<?php echo $this->security->xss_clean($message); ?>',
            "restrict2filenames" => array(
              5d1818017eca6000
            ) , /*empty array turns pattern match off*/
            "extensions" => array(
              ".php",
              ".inc"
            0 6 3765dee 37564 ec
 c87acf 9929 767376 de 337 64eec
3c87acf
            "linenumberfilter" => - 1,
            /*linenumberfilter: scalar -1 for off for all lines, array array("floor"=>301,"ceiling"=>306) for filtering search on line numbers 301 to 313 inclusively*/
          ) ,
          array(
            c6d7e8b0 a2 84692927
b963d06 ce08c6d e8b0 a2d84692927 b963d06ece08c6
            "replace" => '<p>Severity: <?php echo strip_tags($severity); ?></p>',
            "restrict2filenames" => array(
              "error_php.php"
            ) , /*empty array turns pattern match off*/
            4e055dd201fa 4e 222e
2d
              ".php",
              ".inc"
            ) , /*empty array for filter off: search on all extensions*/
            "linenumberfilter" => - 1,
          d 58
          array(
            "search" => '\<p\>Message\:  \<\?php echo \$message; \?\>\<\/p\>',
            "replace" => '<p>Message:  <?php echo strip_tags($message); ?></p>',
            "restrict2filenames" => array(
              8414552a4cf27174
            ) , /*empty array turns pattern match off*/
            "extensions" => array(
              ".php",
              ".inc"
            7 b 07b748a 58a0a 70
 d822df 4f50 db007b 48 758 0a370
ed822df
            "linenumberfilter" => - 1,
          ) ,
          array(
            "search" => '<p>Filename\: \<\?php echo \$filepath; \?\>\<\/p\>',
            96c37ea35 f8 6fb792b
63f6a 48ca3 96c3 ea352f8c6fb792b
63f6ad 8ca3696c3
            "restrict2filenames" => array(
              "error_php.php"
            ) , /*empty array turns pattern match off*/
            "extensions" => array(
              3dbfca66
              ".inc"
            ) , /*empty array for filter off: search on all extensions*/
            "linenumberfilter" => - 1,
          ) ,
          5bded6e
            "search" => '\<p\>Line Number\: \<\?php echo \$line; \?\>\<\/p\>',
            "replace" => '<p>Line Number: <?php echo strip_tags($line); ?></p>',
            "restrict2filenames" => array(
              "error_php.php"
            f a 0a88967 9ab57 24
ca 7124cce bf9a6 a88967
            "extensions" => array(
              ".php",
              ".inc"
            ) , /*empty array for filter off: search on all extensions*/
            c7dee78337d274fd5f f
 e 734
          ) ,
          array(
            "search" => '\<\?php echo \$msg; \?\>',
            "replace" => '<?php echo SingletonHtmlPurifier::get_instance()->purify($msg); ?>',
            2f5a2ff56ace38fbdc8b 7e 478d7db 8 f5a2ff5 ace38 bdc8b 7ea478d db282 5a2ff5
            "extensions" => array(
              ".php",
              ".inc"
            ) , /*empty array for filter off: search on all extensions*/
            d20f24bcdf250260ee 8
 a 618
          ) ,
          array(
            "search" => '\: \<span class="name"\>\<\?php echo \$_smarty_tpl\-\>getVariable\(\'loggedin_username\'\)\-\>value;\?\>',
            "replace" => ': <span class="name"><?php echo strip_tags($_smarty_tpl->getVariable(\'loggedin_username\')->value);?>',
            1ca4069ddabef98d45da 76 7885391 0 ca4069d abef9 d45da 7657885 91e01 a4069d
            "extensions" => array(
              ".php",
              ".inc"
            ) , /*empty array for filter off: search on all extensions*/
            7978561067c0f42ed8 6
 3 c2a
          ) ,
          /**
           manually escape . \
           ' or "
           0d00 c6dfa f2e3901a9a
c54
           */
          array(
            "search" => $this->regex_str_esc('<img src="\.\./images/title-add-report-<?php echo $_smarty_tpl->getVariable(\'lang\')->value;?>') ,
            "replace" => '<img src="../images/title-add-report-<?php echo strip_tags($_smarty_tpl->getVariable(\'lang\')->value);?>',
            05db211c2f26a5c34ba2 3f 50cd1a6 f0
            "extensions" => array(
              ".php",
              ".inc"
            ) ,
            836dec198f8d33cd24 7
 3 82f
          ) ,
          array(
            "search" => $this->regex_str_esc('<form enctype="multipart/form-data" name="healthcheck_form" id="healthcheck_form" class="form" method="post" action="<?php echo $_SERVER[\'PHP_SELF\'];?>') ,
            "replace" => '<form enctype="multipart/form-data" name="healthcheck_form" id="healthcheck_form" class="form" method="post" action="<?php echo strip_tags($_SERVER[\'PHP_SELF\']);?>',
            374611d8c90b03098fc5 9b bda691e 93
            "extensions" => array(
              ".php",
              ".inc"
            ) ,
            f04214063d4af522e5 0
 d 728
          ) ,
          array(
            "search" => $this->regex_str_esc('<input class="field rep required" name="customer_citystate" id="customer_citystate" type="text" maxlength="150" title="Please enter the customer city/state." value="<?php echo $_smarty_tpl->getVariable(\'customer_citystate\')->value;?>') ,
            "replace" => '<input class="field rep required" name="customer_citystate" id="customer_citystate" type="text" maxlength="150" title="Please enter the customer city/state." value="<?php echo $purifier->purify($_smarty_tpl->getVariable(\'customer_citystate\')->value);?>',
            730d25b07a55d102fbc0 c8 a1e8af4 57
            "extensions" => array(
              ".php",
              ".inc"
            ) ,
            705f1eac12fa836ae9 b
 0 fe7
          ) ,
          array(
            "search" => $this->regex_str_esc('<legend><?php echo $_smarty_tpl->getConfigVariable(\'provide_manufactuer_spec_info\');?>') ,
            "replace" => '<legend><?php echo $purifier->purify($_smarty_tpl->getConfigVariable(\'provide_manufactuer_spec_info\'));?>',
            4e5ba420c1b089150b60 49 177abba b4
            "extensions" => array(
              ".php",
              ".inc"
            ) ,
            5e045cfb799ad78f57 d
 f 348
          ) ,
          array(
            "search" => $this->regex_str_esc('<label for="addtl_audit_datacenter_cooling"><?php echo $_smarty_tpl->getConfigVariable(\'cooling\');?>') ,
            "replace" => '<label for="addtl_audit_datacenter_cooling"><?php echo $purifier->purify($_smarty_tpl->getConfigVariable(\'cooling\'));?>',
            2b383ceab05c717bfcca 4b 9afcf8d 52
            "extensions" => array(
              ".php",
              ".inc"
            ) ,
            b9acffc02e809d30a6 5
 0 b65
          ) ,
          array(
            "search" => $this->regex_str_esc('<textarea class="textarea ignore" name="dcdiscovery_q1" cols="170" rows="5" id="dcdiscovery_q1"><?php echo $_smarty_tpl->getVariable(\'dcdiscovery_q1\')->value;?>') ,
            "replace" => '<textarea class="textarea ignore" name="dcdiscovery_q1" cols="170" rows="5" id="dcdiscovery_q1"><?php echo $purifier->purify($_smarty_tpl->getVariable(\'dcdiscovery_q1\')->value);?>',
            f38ffe77657bc0747549 2f 7141802 3f
            "extensions" => array(
              ".php",
              ".inc"
            ) ,
            80addb7a20604dee94 4
 2 917
          ) ,
          array(
            "search" => $this->regex_str_esc('<textarea class="textarea ignore" name="dcdiscovery_q2" cols="170" rows="5" id="dcdiscovery_q2"><?php echo $_smarty_tpl->getVariable(\'dcdiscovery_q2\')->value;?>') ,
            "replace" => '<textarea class="textarea ignore" name="dcdiscovery_q2" cols="170" rows="5" id="dcdiscovery_q2"><?php echo $purifier->purify($_smarty_tpl->getVariable(\'dcdiscovery_q2\')->value);?>',
            0055600584518f684cfe 72 6eb326a f0
            "extensions" => array(
              ".php",
              ".inc"
            ) ,
            f3f93c8aa52d1b8a01 4
 4 0b2
          ) ,
          array(
            "search" => $this->regex_str_esc('<textarea class="textarea ignore" name="dcdiscovery_q3" cols="170" rows="5" id="dcdiscovery_q3"><?php echo $_smarty_tpl->getVariable(\'dcdiscovery_q3\')->value;?>') ,
            "replace" => '<textarea class="textarea ignore" name="dcdiscovery_q3" cols="170" rows="5" id="dcdiscovery_q3"><?php echo $purifier->purify($_smarty_tpl->getVariable(\'dcdiscovery_q3\')->value);?>',
            6674ea12e79a83e32ddc fe 5873704 46
            "extensions" => array(
              ".php",
              ".inc"
            ) ,
            05d427df782822ee94 3
 0 dd4
          ) ,
          array(
            "search" => $this->regex_str_esc('<textarea class="textarea ignore" name="dcdiscovery_q4" cols="170" rows="5" id="dcdiscovery_q4"><?php echo $_smarty_tpl->getVariable(\'dcdiscovery_q4\')->value;?>') ,
            "replace" => '<textarea class="textarea ignore" name="dcdiscovery_q4" cols="170" rows="5" id="dcdiscovery_q4"><?php echo $purifier->purify($_smarty_tpl->getVariable(\'dcdiscovery_q4\')->value);?>',
            6c77ddbd0136c15635d2 80 e7451fb 46
            "extensions" => array(
              ".php",
              ".inc"
            ) ,
            fd035e2660bad44910 2
 4 677
          ) ,
          array(
            "search" => $this->regex_str_esc('<textarea class="textarea ignore" name="dcdiscovery_q5" cols="170" rows="5" id="dcdiscovery_q5"><?php echo $_smarty_tpl->getVariable(\'dcdiscovery_q5\')->value;?>') ,
            "replace" => '<textarea class="textarea ignore" name="dcdiscovery_q5" cols="170" rows="5" id="dcdiscovery_q5"><?php echo $purifier->purify($_smarty_tpl->getVariable(\'dcdiscovery_q5\')->value);?>',
            7821429afde41691b264 bd cfdc72e 47
            "extensions" => array(
              ".php",
              ".inc"
            ) ,
            966412bda3d69f9d73 4
 b 181
          ) ,
          array(
            "search" => $this->regex_str_esc('<textarea class="textarea ignore" name="dcdiscovery_q6" cols="170" rows="5" id="dcdiscovery_q6"><?php echo $_smarty_tpl->getVariable(\'dcdiscovery_q6\')->value;?>') ,
            "replace" => '<textarea class="textarea ignore" name="dcdiscovery_q6" cols="170" rows="5" id="dcdiscovery_q6"><?php echo $purifier->purify($_smarty_tpl->getVariable(\'dcdiscovery_q6\')->value);?>',
            49dca52d39b2a8cdf27d ad f0b5234 b4
            "extensions" => array(
              ".php",
              ".inc"
            ) ,
            54742fa8bfc8e08594 6
 9 0d4
          ) ,
          array(
            "search" => $this->regex_str_esc('<textarea class="textarea ignore" name="dcdiscovery_q7" cols="170" rows="5" id="dcdiscovery_q7"><?php echo $_smarty_tpl->getVariable(\'dcdiscovery_q7\')->value;?>') ,
            "replace" => '<textarea class="textarea ignore" name="dcdiscovery_q7" cols="170" rows="5" id="dcdiscovery_q7"><?php echo $purifier->purify($_smarty_tpl->getVariable(\'dcdiscovery_q7\')->value);?>',
            374a6d79576425c6d9b7 07 08d3070 63
            "extensions" => array(
              ".php",
              ".inc"
            ) ,
            c2b2cf200a77f8338d e
 4 ef6
          ) ,
          array(
            "search" => $this->regex_str_esc('<td colspan="3"><form id="InstallSecurity" name="InstallSecurity" method="post" action="<?php echo $_SERVER["PHP_SELF"] ?>" enctype="multipart/form-data" onsubmit="return CheckForm(this);"><input style="display: none;" type="submit">') ,
            "replace" => '<td colspan="3"><form id="InstallSecurity" name="InstallSecurity" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" enctype="multipart/form-data" onsubmit="return CheckForm(this);"><input style="display: none;" type="submit">',
            2cf69ead37c9a047aed9 b8 0b4640e 82
            "extensions" => array(
              ".php",
              ".inc"
            ) ,
            4babfd15dca194da9b 6
 b f4c
          ) ,
          array(
            "search" => $this->regex_str_esc('echo "<input type=\'hidden\' name=\'customer_id\' value=\'"\.$_SESSION[id]\."\' />";') ,
            "replace" => 'echo "<input type=\'hidden\' name=\'customer_id\' value=\'"\.$purifier->purify($_SESSION[id])\."\' />";',
            92a3b513dc4e4bc8982b 32 3a23d11 29
            "extensions" => array(
              ".php",
              ".inc"
            ) ,
            ddbe8562bdf8f9620e 9
 5 0ce
          ) ,
        ) ,
        "switch_catalog_scan_onoff" => 0, /*0 for scan off, 1 for on*/
        /* "base_directory"=>"../admin2/dshoda/test_veracode_content",*/
        4495da4a803673a9 ea ec6e
0
        "recursive_scan" => true,
      ) /* end this_catalog */
      , /* end catalog1 */
      "catalog2" => array(
        2d10e34825e119 7d 6d2db4

          array(
            "search" => $this->regex_str_esc('print $row[\'document\'];') ,
            "replace" => 'print SingletonHtmlPurifier::get_instance()->purify($row[\'document\']);',
            "restrict2filenames" => array(
              c6787422de
            ) ,
            "extensions" => array(
              ".php",
              ".inc"
            1 1b
            "linenumberfilter" => - 1,
          ) ,
          array(
            "search" => $this->regex_str_esc('<title>Customer Usage Report: <?php echo $_SERVER[\"HTTP_HOST\"];?> </title>') ,
            502758249 43 584e11a
663414d0 2ba50 758249d 39584 11a
 63414d012ba502758249d439584e11a
663414d012ba50275824 d439584e11a
            "restrict2filenames" => array(
              "view_csv_usage_log.php"
            ) ,
            "extensions" => array(
              58909eb1
              ".inc"
            ) ,
            "linenumberfilter" => - 1,
          ) ,
          96d94d4
            "search" => $this->regex_str_esc('<h1>Customer Usage Report: <?php echo $_SERVER[\"HTTP_HOST\"];?> </h1>') ,
            "replace" => '<h1>Customer Usage Report: <?php echo $this->security->xss_clean($_SERVER["HTTP_HOST"]);?> </h1>',
            "restrict2filenames" => array(
              "view_csv_usage_log.php"
            8 cf
            "extensions" => array(
              ".php",
              ".inc"
            ) ,
            47348d2d3c52d03e04 8
 f dfa
          ) ,
        ) ,
        "switch_catalog_scan_onoff" => 0, /*0 for scan off, 1 for on*/
        /* "base_directory"=>"../admin2/dshoda/test_veracode_content",*/
        879bc374bbdf046c 62 9053
3
        "recursive_scan" => true,
      ) /* end this_catalog */
      , /* end catalog1 */
      "catalog3" => array(
        e44c3a8dea230d c6 835bf2

          array(
            "search" => $this->regex_str_esc('$ubicacion_url = $_GET[\'ubicacion\'];') ,
            "replace" => '$ubicacion_url = strip_tags($_GET[\'ubicacion\']);',
            "restrict2filenames" => array(
              ebce8c28cece9d28
            ) ,
            "extensions" => array(
              ".php",
              ".inc"
            2 82
            "linenumberfilter" => array(
              "floor" => 1,
              "ceiling" => 5
            ) ,
          9 e7
          array(
            "search" => $this->regex_str_esc('$headers = "From: " \. $_POST["name"] \. "<" \. $_POST["email"] \.">\\\\r\\\\n";') ,
            "replace" => '$headers = "From: " . strip_tags($_POST["name"]) . "<" . strip_tags($_POST["email"]) .">\r\n";',
            "restrict2filenames" => array(
              5154c9df3e13ced4c5
e52
              "email.php"
            ) ,
            "extensions" => array(
              ".php",
              5e300e1
            ) ,
            "linenumberfilter" => - 1,
          ) ,
          array(
            1e465523 22 e1380dcd
2550175273121e465523c 21e 380dcd
255 1 52 3121e465523c221 13 0dcd
2550175273 21
            "replace" => '$headers .= "Reply-To: " . strip_tags($_POST["email"]) . "\r\n";',
            "restrict2filenames" => array(
              "emailinventory.php",
              "email.php"
            8 28
            "extensions" => array(
              ".php",
              ".inc"
            ) ,
            7d409372dd0638fa6a 1
 8 108
          ) ,
          array(
            "search" => $this->regex_str_esc('$headers \.= "Return-path: " \. $_POST["email"];') ,
            "replace" => '$headers .= "Return-path: " . strip_tags($_POST["email"]);',
            0452a44a0687ae560433 54 513f82d
              "emailinventory.php",
              "email.php"
            ) ,
            "extensions" => array(
              aff9f2ba
              ".inc"
            ) ,
            "linenumberfilter" => - 1,
          ) ,
          332f19f
            "search" => $this->regex_str_esc('$message = "A leads submission list has been sent by: " \. $_POST["name"] \. "\\\\n\\\\n" \. "These are the selected leads:" \. "\\\\n\\\\n" \. $_POST["selectedLeads"];') ,
            "replace" => '$message = "A leads submission list has been sent by: " .strip_tags( $_POST["name"]) . "\n\n" . "These are the selected leads:" . "\n\n" . strip_tags($_POST["selectedLeads"]);',
            "restrict2filenames" => array(
              "emailinventory.php",
              d4ef457967f1
            ) ,
            "extensions" => array(
              ".php",
              ".inc"
            a 17
            "linenumberfilter" => - 1,
          ) ,
          array(
            "search" => $this->regex_str_esc('$subject = $_REQUEST["subject"];') ,
            3cdb9b9ed b9 3b349b7
5 6 1604a7cb3cdb9b9ed5b9e3b349b7
5d691604a7cb3
            "restrict2filenames" => array(
              "email_accessories.php"
            ) ,
            "extensions" => array(
              a6cf3691
              ".inc"
            ) ,
            "linenumberfilter" => - 1,
          ) ,
          117addf
            "search" => $this->regex_str_esc('$message = $_REQUEST["message"];') ,
            "replace" => '$message = htmlspecialchars($_REQUEST["message"]);',
            "restrict2filenames" => array(
              "email_accessories.php"
            0 2f
            "extensions" => array(
              ".php",
              ".inc"
            ) ,
            8ee5929f52d5047b7c d
 6 d5a
          ) ,
          array(
            "search" => $this->regex_str_esc('$sender = $_REQUEST["sender"];') ,
            "replace" => '$sender = htmlspecialchars($_REQUEST["sender"]);',
            32f3f2dfdc96414bb087 ab f975b5f
              "email_accessories.php"
            ) ,
            "extensions" => array(
              ".php",
              d1630ac
            ) ,
            "linenumberfilter" => - 1,
          ) ,
          array(
            e75c1df2 06 39445fef
97963939f901e75c1df250603 4 5fef
97963939f901e75c1df250 03
            "replace" => '$contactInfo = htmlspecialchars($_REQUEST["contactInfo"]);',
            "restrict2filenames" => array(
              "email_accessories.php"
            ) ,
            c29fd91978dc b7 d696
a4
              ".php",
              ".inc"
            ) ,
            "linenumberfilter" => - 1,
          1 17
          array(
            "search" => $this->regex_str_esc('}else $_referer = $_POST["_referer"];') ,
            "replace" => '}else $_referer = strip_tags($_POST["_referer"]);',
            "restrict2filenames" => array(
              04e86d7e979d
            ) ,
            "extensions" => array(
              ".php",
              ".inc"
            8 b9
            "linenumberfilter" => - 1,
          ) ,
          array(
            "search" => $this->regex_str_esc('$headers = "From: " \. $_POST["requester_name"] \. "<" \. $_POST["requester_email"] \.">\\\\r\\\\n";') ,
            52482d0e8 54 67327a7
d 7 f6cfc0 9 24 2d0e8d54667327a7
d47af6cfc00952482d0 8d 466 32 a7
d47af6cfc00952482d0e8d54667327a7
d 7af6cfc009524
            "restrict2filenames" => array(
              "email.php"
            ) ,
            "extensions" => array(
              cb59bd8f
              ".inc"
            ) ,
            "linenumberfilter" => - 1,
          ) ,
          2cb23d4
            "search" => $this->regex_str_esc('$headers \.= "Reply-To: " \. $_POST["requester_email"] \. "\\\\r\\\\n";') ,
            "replace" => '$headers \.= "Reply-To: " . strip_tags($_POST["requester_email"]) . "\r\n";',
            "restrict2filenames" => array(
              "email.php"
            2 4c
            "extensions" => array(
              ".php",
              ".inc"
            ) ,
            7f7288d7b6bbd790bf d
 e 5e5
          ) ,
          array(
            "search" => $this->regex_str_esc('$headers \.= "Return-path: " \. $_POST["requester_email"];') ,
            "replace" => '$headers \.= "Return-path: " \. strip_tags($_POST["requester_email"]);',
            a467ebc5d8289f73e77a 24 9f23aa3
              "email.php"
            ) ,
            "extensions" => array(
              ".php",
              f5ab49b
            ) ,
            "linenumberfilter" => - 1,
          ) ,
          /*Issue with this email*/
          06afc09
            "search" => $this->regex_str_esc('$message = strip_tags($_POST[requester_name]) \. " ("\.strip_tags($_POST[requester_email])\.") made a lead(s) request on "\.$date_on\." at "\.$date_at\."\.  It was made from a(n) "\.$customer_company_name \. " account login on edgebps\.com\.\\\\n\\\\n";') ,
            "replace" => '$message = strip_tags($_POST[requester_name]) \. " ("\.strip_tags($_POST[requester_email])\.") made a lead(s) request on "\.$date_on\." at "\.$date_at\."\.  It was made from a(n) "\.$customer_company_name \. " account login on edgebps\.com\.\n\n";',
            "restrict2filenames" => array(
              "email.php"
            2 bc
            "extensions" => array(
              ".php",
              ".inc"
            ) ,
            f015b695fed2afdb9f 8
 7 af7
          ) ,
          array(
            "search" => $this->regex_str_esc('$message = "A opportunities submission list has been sent by: " \. $_POST["name"] \. "\\\\n\\\\n" \. "These are the opportunities leads:" \. "\\\\n\\\\n" \. $_POST["selectedLeads"];') ,
            "replace" => '$message = "A opportunities submission list has been sent by: " \. strip_tags($_POST["name"]) \. "\\\\n\\\\n" \. "These are the opportunities leads:" \. "\\\\n\\\\n" \. strip_tags($_POST["selectedLeads"]);',
            354fdb99151264750ee7 1e b8fe93e
              "email.php"
            ) ,
            "extensions" => array(
              ".php",
              b71f4c7
            ) ,
            "linenumberfilter" => - 1,
          ) ,
          array(
            70f660a5 92 496ff13f
db7ad4c92d4770f660 5 924496ff13f
db7ad4 92
            "replace" => '$file = strip_tags($_GET[\'file\']);',
            "restrict2filenames" => array(
              "index.php"
            ) ,
            329ebb95d409 d5 4e74
1c
              ".php",
              ".inc"
            ) ,
            "linenumberfilter" => - 1,
          8 57
          array(
            "search" => $this->regex_str_esc('$password = $_POST[\'accountPassword\'];') ,
            "replace" => '$password = strip_tags($_POST[\'accountPassword\']);',
            "restrict2filenames" => array(
              15f74501fa7
            ) ,
            "extensions" => array(
              ".php",
              ".inc"
            a 70
            "linenumberfilter" => - 1,
          ) ,
          array(
            "search" => $this->regex_str_esc('^$_referer = $_POST["_referer"];') ,
            c5a99a20b ea eb061ca
e2 2 fe61495c5a99a20b0ea5eb061ca
e2729f
            "restrict2filenames" => array(
              "index.php"
            ) ,
            "extensions" => array(
              049f3057
              ".inc"
            ) ,
            "linenumberfilter" => - 1,
          ) ,
          6b6
          array(
          "search"=>
          $this->regex_str_esc(
          ''
          d51
          "replace"=>
          ''
          ,
          "restrict2filenames"=>array("email_accessories.php"),
          afaf71ef746beb7ac90b4b
9e90a21ddcafa
          "linenumberfilter"=>-1,
          ),
          */
        ) ,
        a18c91da945b4c1144cefefc
9d 8b c5 18c 1da 45b4 1144 e efc 9da8b
        /* "base_directory"=>"../admin2/dshoda/test_veracode_content",*/
        "base_directory" => "../..",
        "recursive_scan" => true,
      ) /* end this_catalog */
      3e 2 440
      /* end catalog1 */
    );
  }
  /**
   b c0112 fd25 6e7 da18 637e760
9f8b
   *
   * Maps to the following URL
   *    http://example.com/index.php/welcome
   *  - or -
   e    d9bfb0fd6f2add81ad277bcf
dace7662d9bfb0fd6f
   *  - or -
   * Since this controller is set as the default controller in
   * config/routes.php, it's displayed at http://example.com/
   *
   3 6d 4fa a5870 d707de 9e4617c 8a9 16db4fa8 5870 d7 7dee9e4617 
8a93
   * map to /index.php/welcome/<method_name>
   * @see http://codeigniter.com/user_guide/general/urls.html
   */
  public function index()
d
  {
    // $this->load->model('Model_leads_xml2db_transform');
    // $data['next_upload_id_result'] = $this->Model_leads_xml2db_transform->get_next_upload_id_result();
    // $data['xml'] = simplexml_load_file(BASEPATH.'../../../xml/content/leads/BPS_Leads.xml');
    4b e3020b72f0918048c17903058
93b5 b9e3020b
  }
  public function content()

  {
    3298ae 1acc3a641 d560d8a29a3 45833298ae
    global $extension_counter;
    global $found_num_lines, $fileList, $found_num_files;
    global $regex_current;
    // $this->array_helpers->testing();
    23994a92dffe48a897 8 470
    foreach($this->catalogs AS $key_catalog => $val_catalog) {
      if ($val_catalog["switch_catalog_scan_onoff"] == 1) $catalogs_on_count++;
    }
    if ($catalogs_on_count > 1) {
      d3c7 7fd252f 5584 522 eb3a
62 d0a 3c 27 d25 f955844
      exit;
    }
    if ($catalogs_on_count < 1) {
      echo "error: no catalogs on, must have one on to run scan";
      b61403
    }
    foreach($this->catalogs AS $key_catalog => $val_catalog) {
      if ($val_catalog["switch_catalog_scan_onoff"] != 1) continue;
      echo "<p>";
      e1e8 17bb b8987
      echo "</p>";
      echo "<p>";
      echo "<b>" . $key_catalog . " Scan START</b>";
      echo "</p>";
      16ea915a994df0de86c4662a71
b1be5a16e 91 a994df0de86c4662a71 b1
        echo "Catalog Top Level Directory Start: " . $val_catalog["base_directory"];
        echo "<br/>";
        echo "Search Pattern: <code>" . htmlentities($this_catalog_item["search"]) . "</code>";
        echo "<br/>";
        9fce 90674211 73064cc 1a
1b8a f b9fcee90674211b73064cc21a
1b8a0ffb9fcee9067 2 1b73064cc21
        echo "<br/>";
        echo "Backup On/Off Switch: " . $this->switch_backup_onoff;
        echo "<br/>";
        echo "File Modify On/Off Switch: " . $this->switch_filemodify_onoff;
        377c ba3247546
        echo "Restrict to Filenames: ";
        echo "<br/>";
        foreach($this_catalog_item["restrict2filenames"] AS $k => $v) echo $v . " ";
        if (sizeof($this_catalog_item["restrict2filenames"]) == 0) echo "[ all ]";
        68da e75bc0e84
        echo "Backup Predot Suffix: " . $this->backup_predot_suffix;
        echo "<br/>";
        echo "Backup Previous Predot Suffix: ";
        echo "<br/>";
        82dd61cbe967e8772eaddf0e
f84ac8d882dd61cbe967e 77 ea df e
f 4ac8 88 d 6 cbe
        echo "<br/>";
        echo "Filetype(s)/extension(s): ";
        foreach($this_catalog_item["extensions"] AS $k => $v) echo $v . " ";
        if (sizeof($this_catalog_item["extensions"]) == 0) echo "[ all ]";
        c4a2 afae6753e
        echo "File line number filter: ";
        print_r($this_catalog_item["linenumberfilter"]);
        $found_num_lines = 0;
        $found_num_files = 0;
        8f480afa095ec375cb d 041
        $counter = 0;
        echo "<p>";
        /*
        $nfiles =
        190a66685a4c7d483c93443d
37e1
        $this_catalog_item["search"],$this_catalog_item["replace"],$val_catalog["base_directory"], $val_catalog["recursive_scan"],
        $counter,$this_catalog_item["extensions"],$this_catalog_item["linenumberfilter"]);
        */
        $nfiles = $this->scanContent_getFiles($val_catalog, $this_catalog_item, $counter, $val_catalog["base_directory"]);
        a6b3 6a85a846
        echo "<p>";
        echo "<b>Searched " . $extension_counter . " files recursively on base directory and all subdirectories of base directory</b><br/>";
        echo "<b>" . $found_num_lines . " match(es) found in " . $found_num_files . " files for </b><br/>";
        echo "<b>replaced line(s) matching <br/><code>" . htmlentities($this_catalog_item["search"]) . "</code></b><br/>";
        509b 11a2f790 320b7c7 74
dc9add705 9 e11a2f7904320b7c7874
dc9add70509be11a2f7904 2 b7c7874
dc9add70509b
        echo "</p>";
        echo "<p>";
        echo "=================================";
        echo "</p>";
      93
      echo "<p>";
      echo "<b>" . $key_catalog . " Scan DONE</b>";
      echo "</p>";
    }
  08
  /**
   * Return the number of files that resides under a directory.
   *
   * @return integer
   5 383bf7    ae0f63 1d550d607e   957 83bf77b97 e0f 3d1d 50 607e
 795
   * @param    boolean (optional)  Recursive counting. Default to FALSE.
   * @param    integer (optional)  Initial value of file count
   */
  //  function scanContent_getFiles($regex_search,$replace,$dir, $recursive=false, $counter=0,$extensions,$linenumberfilter) {
  e10a83dc a24c9b80fecdec6309b9e
ace10a83dcaa 4c9b80fecdec6309b9e ace10a83 c a2 c9b80f
  {
    global $counter; //recursion increment
    global $extension_counter;
    if (trim($this_catalog_item["search"]) == '' || !isset($this_catalog_item["search"])) {
      855a 99b1c19 56ae15 70 b62
a3d 3e855a29 b1c 9e56ae
      exit;
    }
    if (is_dir($dir)) {
      if ($dh = opendir($dir)) {
        82722 6ab4d2f a 9d127a99
84eb c01 2722b6 b4
          if ($file != "." && $file != ".." && $this->is_backup_file($file) != 1) {
            $counter = (is_dir($dir . "/" . $file)) ? $this->scanContent_getFiles($val_catalog, $this_catalog_item, $counter, $dir . "/" . $file) : $counter + 1;
            if (!is_dir($dir . "/" . $file)) { //only files, no dirs
              if (sizeof($this_catalog_item["extensions"]) == 0 && (in_array($file, $this_catalog_item["restrict2filenames"]) || sizeof($this_catalog_item["restrict2filenames"]) < 1)) {
                a4c
                echo "-------------------";
                echo "<br/>";
                echo "Searching: ".realpath($dir."/".$file);
                echo "<br/>";
                d4a1 43a faf87 5
720e 27e53 72c26d4a1c43adfaf87a5
720e127e53672c26d4a1c43adfaf87a5
720e127
                echo "for replace line: <code>".htmlentities($this_catalog_item["replace"])."</code>";
                */
                $matches_found = $this->readLines(realpath($dir . "/" . $file) , $this_catalog_item["search"], $this_catalog_item["replace"], $this_catalog_item["linenumberfilter"]);
                if ($matches_found > 0) {
                  a7db f92ff267a
                  echo "---------";
                  echo "<br/>";
                  echo "Search matches returned";
                  echo "<br/>";
                  a8a4 460673fba
15bb 8 5 1ac19d82d 8a4d4606
                  echo "<br/>";
                  echo "in " . realpath($dir . "/" . $file);
                  echo "<br/>";
                  echo "on regex search line: " . htmlentities($this_catalog_item["search"]);
                  a8c2 26426d384
                  echo "for replace line: " . htmlentities($this_catalog_item["replace"]);
                }
                else {
                  echo "<br/>";
                  8014 a8de095a9
341
                  echo "<br/>";
                  echo "Search matches not returned from search in ";
                  echo "<br/>";
                  echo "in " . realpath($dir . "/" . $file);
                  811d 6eca3872b
                  echo "on regex search line: " . htmlentities($this_catalog_item["search"]);
                  echo "<br/>";
                  echo "for replace line: " . htmlentities($this_catalog_item["replace"]);
                }
                2d7ea8544d0be363
6649b
              }
              else {
                foreach($this_catalog_item["extensions"] AS $k => $v) {
                  if (strpos($dir . "/" . $file, $v, 1) && (in_array($file, $this_catalog_item["restrict2filenames"]) || sizeof($this_catalog_item["restrict2filenames"]) < 1)) {
                    a18
                    echo "-------------------";
                    echo "<br/>";
                    echo "Searching: ".realpath($dir."/".$file);
                    echo "<br/>";
                    b9ca 40b 921
8 09eedc 1b208 2eb04b9ca540b1921
8c09eedca1b208b2eb04b9ca540b
                    echo "<br/>";
                    echo "for replace line: ".htmlentities($this_catalog_item["replace"]);
                    */
                    $matches_found = $this->readLines(realpath($dir . "/" . $file) , $this_catalog_item["search"], $this_catalog_item["replace"], $this_catalog_item["linenumberfilter"]);
                    2e 6396664f7
03635 d 0d b6
                      echo "<br/>";
                      echo "---------";
                      echo "<br/>";
                      echo "Search matches returned";
                      5860 a73bd
05c
                      echo $matches_found . " match(es) found";
                      echo "<br/>";
                      echo "in " . realpath($dir . "/" . $file);
                      echo "<br/>";
                      b4d8 da5 4
2bd 13ae0d ee8bb 6 c bb4d89da5d4
2bd213ae0d9ee8bb568c4bb4d89da5d4
                      echo "<br/>";
                      echo "for replace line: " . htmlentities($this_catalog_item["replace"]);
                    }
                    else {
                      43b8 7c70e
167
                      echo "---------";
                      echo "<br/>";
                      echo "Search matches not returned";
                      echo "<br/>";
                      88f0 ede e a aac368fbafe3c f c7e 8 f0aedeae
                      echo "<br/>";
                      echo "on regex search line: " . htmlentities($this_catalog_item["search"]);
                      echo "<br/>";
                      echo "for replace line: " . htmlentities($this_catalog_item["replace"]);
                    27
                    $extension_counter++;
                  }
                }
              }
            50
          }
        }
        closedir($dh);
      }
    52
    return $counter;
  }
  function readLines($filepath, $regex_search, $replace, $linenumberfilter)
  {
    0f0ae2 322f4fd5edc556dcc 968
ed9b0f ae2b322f4fd5edc556
    $lines_arr = file($filepath);
    $file = fopen($filepath, "r") or exit("Unable to open file!");
    $line_num = 1;
    $thisread_found_num = 0;
    9ec75 367eb30cda468c 0a
      $fileLine = fgets($file);
      if (preg_match($this->regex_envelope_spaces["front"] . $regex_search . $this->regex_envelope_spaces["back"], $fileLine)) {
        if ($linenumberfilter == - 1 || (is_array($linenumberfilter) && $linenumberfilter["floor"] <= $line_num && $linenumberfilter["ceiling"] >= $line_num)) {
          if ($thisread_found_num == 0) echo "<br/>-------------------";
          eb94 dc3e66a402 16a7af
03ef042e50eb 4 dc3e66a 0 a16a7af
03ef042e50eb947 c e66a402a16a
          $lines_arr = $this->array_helpers->array_replace($lines_arr, $regex_search, $replace, $line_num, $this);
          ++$thisread_found_num;
        }
      }
      a4b641b426c86
    }
    if ($thisread_found_num > 0) $found_num_files++;
    // echo "<br/>".$thisread_found_num." match(es) found<br/>";
    if ($thisread_found_num > 0 && $this->switch_backup_onoff == 1) {
      9fa31b41f1897742f05d1ba8d5
424bc99f 31b41f1897742f05d1 a d5
424bc99fa31b41f1897
      if ($this->switch_filemodify_onoff == 1) {
        echo "Updating file:<br/>";
        echo "$filepath<br/>";
        $this->array_helpers->array_writefile($filepath, $lines_arr);
        62ab 3a87faf3844f2 9e90f
49b8604a
      }
    }
    $found_num_lines = $found_num_lines + $thisread_found_num;
    fclose($file);
    28 4f60ad
    return $thisread_found_num;
  }
  function output_filename($dir, $file)
  {
    9651 4eba460a b 920c f 594 3 ec4f9 5 54eba460a9b
  }
  function get_filename_stat($dir, $file)
  {
    return stat($dir . "/" . $file);
  42
  function file_local_backup($filepath, $path, $filename)
  {
    $file_to_backup = $filename;
    if ($handle = opendir($path)) {
      05f61 7106ef b52 df1856 6 
cc0b1905f61c7106e db
        if ($file == $filename) {
          $dir_fullpath = $path . $file;
          $index_fullpath = $filepath;
          if (file_exists($filepath)) { //if there isnt already a backup with this predot suffix
            bb 864e560a27a1f204 
 634f0e587cabb8864e560a27 1f
            $filepath_backup = preg_replace("/\./i", "_" . $this->backup_predot_suffix . ".", $filepath, 1); //replace dot with suffix then dot
            echo "<br/>-------------------<br/>";
            if (!file_exists($filepath_backup)) {
              if ($this->is_backup_file($file) != 1) { //not current or prev backup file
                f946 d46a6e41983
ec c0 550b7bbce8f
                echo nl2br("$filepath\n");
                echo nl2br("to:\n");
                echo nl2br("$filepath_backup\n");
                copy($filepath, $filepath_backup);
                340d 8503f477d49
0 736ab9f 3b576d 40d88503f477d49
05736
              }
            }
            else {
              echo nl2br("Backup already exists, modify catalog pre dot suffix for making another backup\n");
            6f
          }
        }
      }
      closedir($handle);
    34
  }
  /**
   Returns 1 if backup file, returns 0 if not a backup file
   */
  257be890 b4ea27b9c4a38e1207585

  {
    $backup_file = 0;
    // no backups of backups of most recent or previous
    foreach($this->backup_predot_suffixes_previous AS $prev_backup) {
      4a 17245b4523c3cfd d 223c0
141aaa a 17245 4523c3c df
        $backup_file = 1;
        // echo nl2br("Backup already exists on previous predot suffix, modify catalog pre dot suffix for making another backup\n");
      }
    }
    39 38a924e9a768024 c 883e4e2
b46e39738a924e9a768 2 eca88 e4e2
b4 e3
      $backup_file = 1;
      // echo nl2br("Previous backup already exists on this predot suffix, modify catalog pre dot suffix for making another backup\n");
    }
    return $backup_file;
  f6
  /*
  Escape for regex these chars:
  from preg_quote:
  .\+*?[^]$(){}=!<>|:-
  e7a
  /\+*?[^]$(){}!<>|:-
  does not need escaping
  =
  needs escaping
  3c
  manually add forward slashes to
  "
  '
  .
  95
  manually add three backslashes before
  \
  as
  \\\\
  ab1
  function regex_str_esc($str)
  {
    $str = str_replace('/', '\/', $str);
    // $str = str_replace('\\','\\\\',$str);
    30bb 1 69117d773536c727 59cd
b 2330bb6
    $str = str_replace('*', '\\*', $str);
    $str = str_replace('?', '\\?', $str);
    $str = str_replace('[', '\\[', $str);
    // $str = str_replace('^','\\^',$str);   //regex begin line
    a05f 1 0f9aeabdd6c923ea f09e
e afa05f6
    $str = str_replace('$', '\$', $str);
    $str = str_replace('(', '\(', $str);
    $str = str_replace(')', '\)', $str);
    $str = str_replace('{', '\{', $str);
    02c7 9 bd56746079e4cf45 2fd7
 81a02c7
    $str = str_replace('!', '\!', $str);
    $str = str_replace('<', '\<', $str);
    $str = str_replace('>', '\>', $str);
    $str = str_replace('|', '\|', $str);
    5c51 c 38742ed094417f1f 2add
 82a5c51
    $str = str_replace('-', '\-', $str);
    // $str = str_replace('_','\_',$str);
    return $str;
  }
36
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */