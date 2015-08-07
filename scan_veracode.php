6766dea
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Scan_Veracode extends CI_Controller

{
  0722cb 9bcfe9477 9 95581df7a4
  public $backup_predot_suffix = "bak4";
 // an underscore will be added, alphanum only
  public $backup_predot_suffixes_previous = array(
    "bak1",
    e77344d2f
    "bak3"
  );
  public $regex_envelope_spaces = array(
    "front" => '/^[ \t]*',
    2cdd1a 08 58 bced569568
  );
  public $regex_envelope = array(

    "front" => '/',
    931e84 28 3a23a2
  );
  public $switch_filemodify_onoff = 0;
 /*0 for modify off, 1 for on*/
  public $switch_backup_onoff = 0;
 bc0 931 312a2 04fc bc9684 9aca 

 3b7 d16 22c9fb 4eec 49 0c b78 7
63b7 d1602
  public function __construct()

  29
    parent::__construct();
    38db994d85dd669f583bdcd2289a
342538db99
    $this->catalogs = array(
      59c7f069cf d2 7e90c9a
        "this_catalog" => array(
          array(
            8e5f5269 82 04b188 8
79c74efc
            7287a2f28 f4 cce3a5 
3650f5cdf2157287a2f28df41cce3a54
3650f5cdf2157287a2f28 f41cce3 54
3650f5 df2 572 7a2f 8df41cce3a54
            "restrict2filenames" => array(
              "class.progressbar.php"
            ) , /*empty array turns pattern match off*/
            6804797c236c ba 620a
d8d
              ".php",
              ".inc"
            ) , /*empty array for filter off: search on all extensions*/
            "linenumberfilter" => array(
              695b011 5c eefaa
              "ceiling" => 55
            ) ,
            /*linenumberfilter: scalar -1 for off for all lines, array array("floor"=>301,"ceiling"=>306) for filtering search on line numbers 301 to 313 inclusively*/
          ) ,
          ec41dbd1
            "search" => '\$self = \$\_SERVER\[\"PHP_SELF\"\];',
            "replace" => '$self = strip_tags($_SERVER["PHP_SELF"]);',
            "restrict2filenames" => array(
              "class.qbr.php",
              a28a0df5dd807340f4

0
            ) , /*empty array turns pattern match off*/
            "extensions" => array(
              ".php",
              e93e521
            e 2 d213b1c 6da2d 55
 bd7961 b065 e2dd21 b1 86d 2dc55
7bd7961
            "linenumberfilter" => - 1,
            44458bbb068f180617e 
8daa2 68 7dd 445 bbb 68f 80617e 
8daa 06897dd44458bbb068f180617e8
8daa20 897 d44458bbb 68f180 17 8
8d a206897 d44 58 bb0 8f180617e8
8da
          ) ,
          array(
            df21aa46 a9 a0d03c c
b0637 d5 6eddf 1aa464a96a0d03ccc
f58 de 00750fc5dcd880a218e68ff0f

b0637bd5b6eddf2 aa464a96a0d03ccc
b0637bd5
            "replace" => 'print SingletonHtmlPurifier::get_instance()->purify($style . "<div class=\'alert\'>$msg <a href=\'../index.php?type=$type\'>Go back</a></div>");',
            "restrict2filenames" => array(
              7066898169c5246fee

            ) , /*empty array turns pattern match off*/
            78687b821c23 3d 164c
03
              ".php",
              192b40c
            ) , /*empty array for filter off: search on all extensions*/
            "linenumberfilter" => - 1,
            a5e3bda1a50134cc4c2 
91857 fa dd7 5e3 da1 501 4cc4c2 
6e57 dc5f2f9c13f9d1b57833cd60b36

91857a a1d 7a5e3bda1 50134c 4c 2
91 57afa1d 7a5 3b a1a 0134cc4c22
918
          ) ,
          604d6ef
            "search" => 'echo \"Error loading \$fullpath\";',
            "replace" => 'echo SingletonHtmlPurifier::get_instance()->purify("Error loading $fullpath");',
            2568ccd2b4ebf80f055e 5c cfdf5e4
              "class.vendorform.php"
            e f 510e02b d12e0 12
22 2fdcd59 6eef4 10e02b
            "extensions" => array(
              ".php",
              bbd2176
            ) , /*empty array for filter off: search on all extensions*/
            59e9390a905178004d 5
 0 af7
            /*linenumberfilter: scalar -1 for off for all lines, array array("floor"=>301,"ceiling"=>306) for filtering search on line numbers 301 to 313 inclusively*/
          ) ,
          1f40cea
            "search" => 'echo \"\<li\>\<a href=\'\" \. \$_\SERVER\[\'PHP_SELF\'\] \. \"\?id=\$id\'\>\$name\<\/a\>\<\/li\>\"\;',
            80a129a3a fb f9f98 0
97e9786a658d80a129a3a4fbcf9f9810
97e9786a658d80a129 3a4fbcf9 9 10
97e9786a658d80a129a a fbcf9f9810
97e9786a658d80a129a3
            "restrict2filenames" => array(
              "class.vendorlist.php"
            1 0 6b904f1 84591 83
f7 09b4a27 a160d b904f1
            085c0fbc4a55 77 6d5f
4c
              ".php",
              ".inc"
            ) , /*empty array for filter off: search on all extensions*/
            265fa4596acb3d43ab 0
 4 d0bf
            /*linenumberfilter: scalar -1 for off for all lines, array array("floor"=>301,"ceiling"=>306) for filtering search on line numbers 301 to 313 inclusively*/
          ) ,
          array(
            "search" => '\<h1\>\<\?php echo \$heading; \?\>\<\/h1\>',
            adda3b0b5 a3 adbec57

8b f20b de329678c52d35ab3f083872
8b4f20b7de32 678c52d35a
            "restrict2filenames" => array(
              "error_404.php"
            b 4 add8fe2 cd06b 60
6f e47df8f 7b44e dd8fe2
            "extensions" => array(
              e50f089b
              ".inc"
            ) , /*empty array for filter off: search on all extensions*/
            ccf53b80e452d6d401 3
 a 131
            /*linenumberfilter: scalar -1 for off for all lines, array array("floor"=>301,"ceiling"=>306) for filtering search on line numbers 301 to 313 inclusively*/
          d be
          array(
            "search" => '\<\?php echo \$message; \?\>',
            48a6582ba 33 79addc 
63e 305bbbcf48a6582ba233b79addca
63ea305b bcf48
            "restrict2filenames" => array(
              a51830a1b1dae17d
            ) , /*empty array turns pattern match off*/
            "extensions" => array(
              a217443a
              ".inc"
            1 2 affc5dd 3d448 f5
 a791cf 229e f28aff 5d 03d 48bf5
1a791cf
            6d16b099474186ef84 7
 9 6e7
            /*linenumberfilter: scalar -1 for off for all lines, array array("floor"=>301,"ceiling"=>306) for filtering search on line numbers 301 to 313 inclusively*/
          ) ,
          array(
            f9c07cbb 02 d4d6c6e8
65838cb c92e80f 4b7f 29efa314688 65838cb3c92e80f
            "replace" => '<p>Severity: <?php echo strip_tags($severity); ?></p>',
            "restrict2filenames" => array(
              "error_php.php"
            ) , /*empty array turns pattern match off*/
            8eefff58ddfa 32 a29e

93
              ".php",
              ".inc"
            ) , /*empty array for filter off: search on all extensions*/
            b6d6e5fac0639f3f9e 9
 5 7fd
          0 a1
          array(
            "search" => '\<p\>Message\:  \<\?php echo \$message; \?\>\<\/p\>',
            "replace" => '<p>Message:  <?php echo strip_tags($message); ?></p>',
            b8867f20cac5cc3be9a1 23 dedb761
              85e8443a6e7a1b74
            ) , /*empty array turns pattern match off*/
            "extensions" => array(
              ".php",
              f70f77d
            2 b f2498a5 ecdc6 0f
 61c800 f6f1 2baf24 8a 7ec c680f
f61c800
            "linenumberfilter" => - 1,
          0 03
          array(
            "search" => '<p>Filename\: \<\?php echo \$filepath; \?\>\<\/p\>',
            e79b588fa 01 f401fef
08767 7ce91 e79b 88fa5013f401fef
be92cc 28ba35dae0
            "restrict2filenames" => array(
              "error_php.php"
            ) , /*empty array turns pattern match off*/
            "extensions" => array(
              06d29aa66
              ".inc"
            ) , /*empty array for filter off: search on all extensions*/
            "linenumberfilter" => - 1,
          ) ,
          aea71870
            "search" => '\<p\>Line Number\: \<\?php echo \$line; \?\>\<\/p\>',
            "replace" => '<p>Line Number: <?php echo strip_tags($line); ?></p>',
            "restrict2filenames" => array(
              "error_php.php"
            e 5 32b7e3d 9fc38 a3

60 a0896dd 2b9f6 a61119
            "extensions" => array(
              ".php",
              ".inc"
            a 8 11f48c8 45ada f7
 e32336 a019 88211f 8c 745 da2f7
0e32336
            372208da667ae958af 8
 0 2c5
          ) ,
          array(
            e30abab5 bb b22cf170 5cb9 07e9e7 e30abab
            "replace" => '<?php echo SingletonHtmlPurifier::get_instance()->purify($msg); ?>',
            f96484d67da1d5242d15 18 970189b 6 96484d6 da1d5 42d15 18e9701 9b96f 6484d6
            "extensions" => array(
              ".php",
              6f5025c
            ) , /*empty array for filter off: search on all extensions*/
            f2190d02e8d262becb 6
 0 e5e
          ) ,
          760a85b
            "search" => '\: \<span class="name"\>\<\?php echo \$_smarty_tpl\-\>getVariable\(\'loggedin_username\'\)\-\>value;\?\>',
            "replace" => ': <span class="name"><?php echo strip_tags($_smarty_tpl->getVariable(\'loggedin_username\')->value);?>',
            d8661ef63f25ec858d25 3d 10dbd33 2 8661ef6 f25ec 58d25 3db10db 3372d 661ef6
            "extensions" => array(
              30731841
              ".inc"
            ) , /*empty array for filter off: search on all extensions*/
            ce6835ff6154fcb62b 2
 5 008
          5 f0
          /**
           manually escape . \
           ' or "
           31fe 1b49f 5d1826cda6
915a
           */
          array(
            "search" => $this->regex_str_esc('<img src="\.\./images/title-add-report-<?php echo $_smarty_tpl->getVariable(\'lang\')->value;?>') ,
            "replace" => '<img src="../images/title-add-report-<?php echo strip_tags($_smarty_tpl->getVariable(\'lang\')->value);?>',
            f9f1ba2952bd9d5395dc a6 d7bcf16 cf9
            "extensions" => array(
              ".php",
              ".inc"
            ) ,
            59ca15cd3d03dd1806 6

 a c79
          ) ,
          array(
            "search" => $this->regex_str_esc('<form enctype="multipart/form-data" name="healthcheck_form" id="healthcheck_form" class="form" method="post" action="<?php echo $_SERVER[\'PHP_SELF\'];?>') ,
            419e0a5bd 58 ec09dc 
697d004f8654419e0a5bdf58eec0 dcd
697d004f8654419e0a5 df58eec09dcd
697d004f 654419e0a5bd 58eec09dcd
69 d004f8654419e a5bd 58eec09dcd
697d004f8654419e0a5bdf58eec09
            6de9e76431d53a0f91e2 90 f0f2840 e6
            "extensions" => array(
              ".php",
              ".inc"
            1 2e
            8d9200f89c5daa6d42 8
 e 12e
          ) ,
          array(
            49da99a0 04 529b6877
0b89e9cde62d49da99a a04e529b6877 0b8 e9cde62d4 da99a0a04e529b6877
0b89e9 de62d49da99a0a04e529b68 7
0b89e9cde 2d49da99a0a04e5 9b6877
0b89e9 de62d 9da 9a0a04e5 9b6877
0b89e cde62d49da99 0a04 529b6877
0b89e9cde62d49da99a0a04e529b6877
0b89e9cde62d49da99a a0
            "replace" => '<input class="field rep required" name="customer_citystate" id="customer_citystate" type="text" maxlength="150" title="Please enter the customer city/state." value="<?php echo $purifier->purify($_smarty_tpl->getVariable(\'customer_citystate\')->value);?>',
            3daf9de09ce50c1052b5 21 6d7bdec b3
            "extensions" => array(
              ".php",
              e92fdb0
            ) ,
            ddd81edb30f895ef1c 2
 7 943
          ) ,
          b5cda00
            "search" => $this->regex_str_esc('<legend><?php echo $_smarty_tpl->getConfigVariable(\'provide_manufactuer_spec_info\');?>') ,
            "replace" => '<legend><?php echo $purifier->purify($_smarty_tpl->getConfigVariable(\'provide_manufactuer_spec_info\'));?>',
            6299fe85418e72e08519 4d e2968f4 b6
            "extensions" => array(
              98409b7f
              ".inc"
            ) ,
            116856456912216695 8
 6 373
          d e5
          array(
            "search" => $this->regex_str_esc('<label for="addtl_audit_datacenter_cooling"><?php echo $_smarty_tpl->getConfigVariable(\'cooling\');?>') ,
            "replace" => '<label for="addtl_audit_datacenter_cooling"><?php echo $purifier->purify($_smarty_tpl->getConfigVariable(\'cooling\'));?>',
            2946687fe6e9f136d63a 5e 43aa1df 42
            df9a944f7efd 49 5234
fa
              ".php",
              ".inc"
            ) ,
            11f52c3157835a792d e
 8 dcae
          ) ,
          array(
            "search" => $this->regex_str_esc('<textarea class="textarea ignore" name="dcdiscovery_q1" cols="170" rows="5" id="dcdiscovery_q1"><?php echo $_smarty_tpl->getVariable(\'dcdiscovery_q1\')->value;?>') ,
            "replace" => '<textarea class="textarea ignore" name="dcdiscovery_q1" cols="170" rows="5" id="dcdiscovery_q1"><?php echo $purifier->purify($_smarty_tpl->getVariable(\'dcdiscovery_q1\')->value);?>',
            e3f48e8ff0de61d46da3 5d 34e197a 7e3
            "extensions" => array(
              ".php",
              ".inc"
            ) ,
            75a8979f02f19b27d1 6

 0 e3b
          ) ,
          array(
            "search" => $this->regex_str_esc('<textarea class="textarea ignore" name="dcdiscovery_q2" cols="170" rows="5" id="dcdiscovery_q2"><?php echo $_smarty_tpl->getVariable(\'dcdiscovery_q2\')->value;?>') ,
            0f0ead38f e4 6065b17
86 b1fcbc4c60f0ead 8fbe476 65b17
86eb1fcbc4c60f0 ad38fbe476 65b17
86 b1fcbc4c60f0ead38fbe47606 b17
 6eb1fcbc4c60f0ead38fbe476065b17
86eb1fcbc4c60f0ead38fbe476065b17
86eb1fcbc4c6
            4a565c79eb85bff02053 ff 831e649 84
            "extensions" => array(
              ".php",
              ".inc"
            1 45
            084001f1278cb6daa4 e
 a 0f9
          ) ,
          array(
            56ee7215 52 727e4f61
dfb3398ce91756ee7215c5 e727e4f61
dfb33 8ce9175 ee7215c52e727e4f61
df 3398ce9175 ee7215c5 e727e4f61
dfb3398ce91756e 7215 52e727e4f61
dfb3398ce91756ee7215c52e727e4f61
dfb3398ce917 6e
            "replace" => '<textarea class="textarea ignore" name="dcdiscovery_q3" cols="170" rows="5" id="dcdiscovery_q3"><?php echo $purifier->purify($_smarty_tpl->getVariable(\'dcdiscovery_q3\')->value);?>',
            d5363fdef74a9ea2f202 66 7b3cb80 7d
            "extensions" => array(
              ".php",
              2cb4855
            ) ,
            89a86c2bfc54a80e39 3
 b f02
          ) ,
          f2925ba
            "search" => $this->regex_str_esc('<textarea class="textarea ignore" name="dcdiscovery_q4" cols="170" rows="5" id="dcdiscovery_q4"><?php echo $_smarty_tpl->getVariable(\'dcdiscovery_q4\')->value;?>') ,
            "replace" => '<textarea class="textarea ignore" name="dcdiscovery_q4" cols="170" rows="5" id="dcdiscovery_q4"><?php echo $purifier->purify($_smarty_tpl->getVariable(\'dcdiscovery_q4\')->value);?>',
            6469c07699f080629311 b3 81772e0 56
            "extensions" => array(
              88588b6a
              ".inc"
            ) ,
            ed8f34a8e7cf6fabef 2
 0 c9b
          a 8b
          array(
            "search" => $this->regex_str_esc('<textarea class="textarea ignore" name="dcdiscovery_q5" cols="170" rows="5" id="dcdiscovery_q5"><?php echo $_smarty_tpl->getVariable(\'dcdiscovery_q5\')->value;?>') ,
            "replace" => '<textarea class="textarea ignore" name="dcdiscovery_q5" cols="170" rows="5" id="dcdiscovery_q5"><?php echo $purifier->purify($_smarty_tpl->getVariable(\'dcdiscovery_q5\')->value);?>',
            038491fe2d9928a1fcca 6c d2d8504 50
            e67de0e681c5 73 fdac
ad
              ".php",
              ".inc"
            ) ,
            0abd159e08cec711a0 a
 4 6f26
          ) ,
          array(
            "search" => $this->regex_str_esc('<textarea class="textarea ignore" name="dcdiscovery_q6" cols="170" rows="5" id="dcdiscovery_q6"><?php echo $_smarty_tpl->getVariable(\'dcdiscovery_q6\')->value;?>') ,
            "replace" => '<textarea class="textarea ignore" name="dcdiscovery_q6" cols="170" rows="5" id="dcdiscovery_q6"><?php echo $purifier->purify($_smarty_tpl->getVariable(\'dcdiscovery_q6\')->value);?>',
            8486541af5dabd4f0f2a 1d 6c8259e 784
            "extensions" => array(
              ".php",
              ".inc"
            ) ,
            2a92d811f60de5debc b

 e 4cb
          ) ,
          array(
            "search" => $this->regex_str_esc('<textarea class="textarea ignore" name="dcdiscovery_q7" cols="170" rows="5" id="dcdiscovery_q7"><?php echo $_smarty_tpl->getVariable(\'dcdiscovery_q7\')->value;?>') ,
            ed95ca5f0 3a 859f2f4
31 bbd24b055ed95ca f0d3af8 9f2f4
312bbd24b055ed9 ca5f0d3af8 9f2f4
31 bbd24b055ed95ca5f0d3af859 2f4
 12bbd24b055ed95ca5f0d3af859f2f4
312bbd24b055ed95ca5f0d3af859f2f4
312bbd24b055
            5095850778dfa819362c ce be47bec c5
            "extensions" => array(
              ".php",
              ".inc"
            6 41
            7a1c31a02ea030b061 a
 b da5
          ) ,
          array(
            6108566d 31 4a35711b
d2732d2989566108 66df31c4a35711b
d 732d2989566108566df3 c4a35711b
d2732d298956 108566df31c4a 5711b
d2732d2 8956 108566df31c4a35711b
 273 d2989566108566df31c4a35711b
d 732d298956610856 df31c4a35711b
d2732d2989 66108566df31c4a 5711b
 2732d29895661085 6d
            "replace" => '<td colspan="3"><form id="InstallSecurity" name="InstallSecurity" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" enctype="multipart/form-data" onsubmit="return CheckForm(this);"><input style="display: none;" type="submit">',
            cf05dec3f77e32a22bea 3c 52e2b85 5c
            "extensions" => array(
              ".php",
              660b4ae
            ) ,
            c3e58538d429581dbd 7
 b 16f
          ) ,
          195bc76
            "search" => $this->regex_str_esc('echo "<input type=\'hidden\' name=\'customer_id\' value=\'"\.$_SESSION[id]\."\' />";') ,
            "replace" => 'echo "<input type=\'hidden\' name=\'customer_id\' value=\'"\.$purifier->purify($_SESSION[id])\."\' />";',
            d901fda0e6c90d0c9cf8 e0 7537fbf ad
            "extensions" => array(
              ac962852
              ".inc"
            ) ,
            f73393e7c7f5fbfe8b 1
 a 234
          8 db
        ) ,
        "switch_catalog_scan_onoff" => 0, /*0 for scan off, 1 for on*/
        /* "base_directory"=>"../admin2/dshoda/test_veracode_content",*/
        8addf72de8653c46 57 3f48
1e
        "recursive_scan" => true,
      ) /* end this_catalog */
      , /* end catalog1 */
      "catalog2" => array(
        46e0bee86d6b30 f1 d007e6


          array(
            "search" => $this->regex_str_esc('print $row[\'document\'];') ,
            "replace" => 'print SingletonHtmlPurifier::get_instance()->purify($row[\'document\']);',
            b723742a5cb36025d5bf cb 890803c
              26db102fb3
            ) ,
            "extensions" => array(
              ".php",
              3578750
            d 53
            "linenumberfilter" => - 1,
          ) ,
          array(
            c588f519 d7 ba8dda2b
206aedc9ecbfc588f519cd7dba8d a2b
2 6aedc9e bfc58 f519 d7dba8dda2b
206aedc9ecbfc5 8f519cd7db 8d
            a5f0d146c 06 9de96e8
5f79cafe 43aa5 0d146c7 6e9de 6e8
 f79cafec43aa5f0d146c706e9de96e8
5f79cafec43aa5f0d146 706e9de96e8
            a989373ae73d8951a458 2c d30e32c
              "view_csv_usage_log.php"
            ) ,
            "extensions" => array(
              60ed7e40
              1244ff7
            ) ,
            "linenumberfilter" => - 1,
          ) ,
          40d811c
            0ecfb331 ef fa324da6
d6f105073fb10ecfb3317ef0f 324da 
d6f105 73fb1 ecfb 317ef0fa324da6
d6f105073fb 0ecfb33 7e
            "replace" => '<h1>Customer Usage Report: <?php echo $this->security->xss_clean($_SERVER["HTTP_HOST"]);?> </h1>',
            "restrict2filenames" => array(
              "view_csv_usage_log.php"
            9 02
            641f7d95dcc8 4f 12bd
df
              ".php",
              ".inc"
            ) ,
            ac7c90e709197f3781 4
 d ca49
          ) ,
        ) ,
        "switch_catalog_scan_onoff" => 0, /*0 for scan off, 1 for on*/
        /* "base_directory"=>"../admin2/dshoda/test_veracode_content",*/
        77bcbe24c60c40c1 ad 810c

4
        "recursive_scan" => true,
      ) /* end this_catalog */
      , /* end catalog1 */
      81b87399f9 28 92623c4
        c7fb0e17f5246d e9 e2c456

          array(
            "search" => $this->regex_str_esc('$ubicacion_url = $_GET[\'ubicacion\'];') ,
            e02a75436 d7 32b3257
46ccbde 3 d0e02a75436ad7732b3257
46ccbde93cd0e
            "restrict2filenames" => array(
              4a8c310c90d66b42
            ) ,
            "extensions" => array(
              4b699bb0
              ".inc"
            0 20
            "linenumberfilter" => array(
              "floor" => 1,
              53d40578b 2a 70
            ) ,
          2 00
          array(
            "search" => $this->regex_str_esc('$headers = "From: " \. $_POST["name"] \. "<" \. $_POST["email"] \.">\\\\r\\\\n";') ,
            1fcc1819d 3e ad0e31b
9 b 182cf8 7 f c1819dd3e8ad0e31b
97bd182c 8 71f c 819dd3e8ad0e31b
97bd182cf8c 1fcc1819dd3e
            "restrict2filenames" => array(
              f9129323d214f9eeeb
009
              "email.php"
            0 c1
            "extensions" => array(
              ".php",
              9c66387
            ) ,
            07ec8c05546d93c011 3
 5 31b
          ) ,
          array(
            32b9cae8 f3 4767d0d0
a2eeda8e708432b9cae8d 3e4 67d0d0
237 6 8d d67966893721b89 37 b2cd

a2eeda8e70 43
            "replace" => '$headers .= "Reply-To: " . strip_tags($_POST["email"]) . "\r\n";',
            "restrict2filenames" => array(
              "emailinventory.php",
              f6e8f8f7a513
            7 c9
            "extensions" => array(
              ".php",
              ".inc"
            a 4c
            6bc314cbae939d00f7 f
 b 234
          ) ,
          array(
            e520cfb5 f2 79cfd133
9661e46aad6fe520cfb54 267 cfd133
9661e4 a d6 e520cfb54f2679cfd1 3

            "replace" => '$headers .= "Return-path: " . strip_tags($_POST["email"]);',
            20dfd36e4ac02352eae7 85 a39d75c
              "emailinventory.php",
              "email.php"
            d 48
            "extensions" => array(
              19aae04b
              ".inc"
            ) ,
            24dcbde1a2ed164d0d 1
 3 bdb
          ) ,
          ffab811
            "search" => $this->regex_str_esc('$message = "A leads submission list has been sent by: " \. $_POST["name"] \. "\\\\n\\\\n" \. "These are the selected leads:" \. "\\\\n\\\\n" \. $_POST["selectedLeads"];') ,
            "replace" => '$message = "A leads submission list has been sent by: " .strip_tags( $_POST["name"]) . "\n\n" . "These are the selected leads:" . "\n\n" . strip_tags($_POST["selectedLeads"]);',
            93967da6840316bdb40f 4a 67d0d1a
              "emailinventory.php",
              c907cd3633b9
            ) ,
            "extensions" => array(
              46cbbd21
              ".inc"
            e 1b
            "linenumberfilter" => - 1,
          ) ,
          876092c
            "search" => $this->regex_str_esc('$subject = $_REQUEST["subject"];') ,
            749f27d60 da d095af9
6 d 85e4f603749f27d60ada1d095af9
6edf85e4f6037
            cfc3da0b74d3b757e78d 06 13daf5d
              "email_accessories.php"
            ) ,
            "extensions" => array(
              85b99edd
              0b3655e
            ) ,
            "linenumberfilter" => - 1,
          ) ,
          1e3d24a
            40dd9686 c4 d1dda78e
838a4bb6b02340dd9686d 4 d1dda78e
838a4bb6b02340 d9
            "replace" => '$message = htmlspecialchars($_REQUEST["message"]);',
            "restrict2filenames" => array(
              "email_accessories.php"
            9 65
            4a7c071f2299 46 0eb2
07
              ".php",
              ".inc"
            ) ,
            c8e77293b2f4c54ffc 8
 2 cdb1
          ) ,
          array(
            "search" => $this->regex_str_esc('$sender = $_REQUEST["sender"];') ,
            "replace" => '$sender = htmlspecialchars($_REQUEST["sender"]);',
            93acd448c692409b2e2c 96 5f06cbde
              "email_accessories.php"
            ) ,
            "extensions" => array(
              ".php",
              4438fdfe
            ) ,
            "linenumberfilter" => - 1,
          ) ,
          array(
            e005db91 81 dcb1c78c

a8fccd53b22e5b43defad6ecf 8 1568
a8fccd53b22e5b43defad6 cf
            "replace" => '$contactInfo = htmlspecialchars($_REQUEST["contactInfo"]);',
            "restrict2filenames" => array(
              f8d35dd028957e3d19
6c907
            ) ,
            b277e8af1b02 e7 23b9
be
              ".php",
              a16d075
            ) ,
            "linenumberfilter" => - 1,
          4 33
          array(
            b1d44f99 52 f9f5e454
6cb8a004758fb1d44f 9f521f9f5 4 4
6cb8a004758fb1d44f9 f5
            "replace" => '}else $_referer = strip_tags($_POST["_referer"]);',
            "restrict2filenames" => array(
              3bfc0b53cd08
            ) ,
            c3ae75279713 20 9b5d
8b
              ".php",
              ".inc"
            5 13
            "linenumberfilter" => - 1,
          8 ee
          array(
            "search" => $this->regex_str_esc('$headers = "From: " \. $_POST["requester_name"] \. "<" \. $_POST["requester_email"] \.">\\\\r\\\\n";') ,
            c5a227ac2 ad 84f4aa7
2 6 cc6e83 f 5a 27ac2bad784f4aa7
225d13870aae6d37235 28 1b9 7e a4

2561cc6e837fc5a227ac2bad784f4aa7
2 61cc6e837fc5a
            "restrict2filenames" => array(
              "email.php"
            9 d0
            "extensions" => array(
              89d74d48
              ".inc"
            ) ,
            29ecbfb9cfc86e4b1f e
 d a9e
          ) ,
          0be95dd
            "search" => $this->regex_str_esc('$headers \.= "Reply-To: " \. $_POST["requester_email"] \. "\\\\r\\\\n";') ,
            "replace" => '$headers \.= "Reply-To: " . strip_tags($_POST["requester_email"]) . "\r\n";',
            08f563790ce653550d04 f6 5ff163f
              "email.php"
            2 74
            "extensions" => array(
              ".php",
              acaa7ee
            ) ,
            3db8677f7363a1cec0 0
 0 2aa
          ) ,
          dab9b24
            "search" => $this->regex_str_esc('$headers \.= "Return-path: " \. $_POST["requester_email"];') ,
            "replace" => '$headers \.= "Return-path: " \. strip_tags($_POST["requester_email"]);',
            c1c347b94c94d7603c3f 27 44b6b4e
              "email.php"
            e 2c
            "extensions" => array(
              ".php",
              84c4e98
            ) ,
            a3337b5221fee30e6e 5
 9 88a
          ) ,
          /*Issue with this email*/
          4f585ff
            "search" => $this->regex_str_esc('$message = strip_tags($_POST[requester_name]) \. " ("\.strip_tags($_POST[requester_email])\.") made a lead(s) request on "\.$date_on\." at "\.$date_at\."\.  It was made from a(n) "\.$customer_company_name \. " account login on edgebps\.com\.\\\\n\\\\n";') ,
            2d472aefe 17 6c52094
7 c 2f590f722d472aefeb17b6c52094
7fcd2 59 f 22d472aefeb17b6c52094
7fcd2f590f722d472aefe 17b6 5 094
7fc 2f590f7 2d 72aefeb17b6c52 94 7fcd2f590f722d47  ef b17 6c52 94
7 cd2f 90f722d472aefeb17b6c52094 7f d f590f72 d472a fe 17b6c52094
7fcd2f590f72
            "restrict2filenames" => array(
              "email.php"
            b 71
            "extensions" => array(
              321c0070
              ".inc"
            ) ,
            62ac7f20321b640826 b
 f 235
          8 f6
          array(
            "search" => $this->regex_str_esc('$message = "A opportunities submission list has been sent by: " \. $_POST["name"] \. "\\\\n\\\\n" \. "These are the opportunities leads:" \. "\\\\n\\\\n" \. $_POST["selectedLeads"];') ,
            "replace" => '$message = "A opportunities submission list has been sent by: " \. strip_tags($_POST["name"]) \. "\\\\n\\\\n" \. "These are the opportunities leads:" \. "\\\\n\\\\n" \. strip_tags($_POST["selectedLeads"]);',
            98201ca4719dae322add 9f 3257f37
              2b67a99369ae
            ) ,
            "extensions" => array(
              ".php",
              209ed92
            5 4a
            "linenumberfilter" => - 1,
          ) ,
          array(
            b7f8f8a9 84 faa7a4c5
799203a3fe0c77a7e6 f 4f72a7217b0

e0e869 c3
            "replace" => '$file = strip_tags($_GET[\'file\']);',
            "restrict2filenames" => array(
              "index.php"
            e 7c
            f674365a578e a7 e953
46
              ".php",
              ".inc"
            0 9f
            "linenumberfilter" => - 1,
          1 29
          array(
            "search" => $this->regex_str_esc('$password = $_POST[\'accountPassword\'];') ,
            713028b8f 4a 9f0b428
ce 4 b51f27e713028b8f84a59f0b428
ceb4bb51f27e713
            "restrict2filenames" => array(
              f50ab992343
            ) ,
            "extensions" => array(
              8a0fb35c
              ".inc"
            3 36
            "linenumberfilter" => - 1,
          ) ,
          d4ba456
            "search" => $this->regex_str_esc('^$_referer = $_POST["_referer"];') ,
            a7c4a4c67 45 66303a1
b0 3 dd6ff62a7c4a4c67845066303a1
b0131d
            bd9167b6b206a1c27810 c4 d0f5b64
              "index.php"
            ) ,
            "extensions" => array(
              9732a508
              efb953a
            ) ,
            "linenumberfilter" => - 1,
          ) ,
          452
          c5c3429
          "search"=>
          $this->regex_str_esc(
          ''
          ac2
          33dfbcd5d52e
          ''
          ,
          "restrict2filenames"=>array("email_accessories.php"),
          a435c24105913832952b1e
da774cf2ea4725
          "linenumberfilter"=>-1,
          ),
          */
        ) ,
        6efecf62135281e8654d0019

2c 2d 52 4b6 411 b9c3 31ba 7 235 2c82d
        /* "base_directory"=>"../admin2/dshoda/test_veracode_content",*/
        "base_directory" => "../..",
        "recursive_scan" => true,
      b e8 317 de080f5f3efd 55f
      ed 1 f65
      /* end catalog1 */
    );
  }
  7761
   f 5f873 1a21 21a 965a d4c9ab5
a2cf
   *
   * Maps to the following URL
   6    e0cff36a6b6cf75548ee9b44
f7262915e0cf
   *  - or -
   d    b7c5fda2fc7b37173bd986e6
4d5d0400b7c5fda2fc
   *  - or -
   f a3f7c 0e84 db4cd2f866 31 89
 27 da3 7c60e84 db4cd2f866 31a
   * config/routes.php, it's displayed at http://example.com/
   *
   c c6 838 457a6 6320a3 2538a4b 99c 7c648380 57a6 63 0a382538a4 
99cc
   0 8b4 fa f2ed5ae0eace0dbd0f2c
a1a068b48fa4
   * @see http://codeigniter.com/user_guide/general/urls.html
   */
  public function index()
f
  20
    // $this->load->model('Model_leads_xml2db_transform');
    // $data['next_upload_id_result'] = $this->Model_leads_xml2db_transform->get_next_upload_id_result();
    // $data['xml'] = simplexml_load_file(BASEPATH.'../../../xml/content/leads/BPS_Leads.xml');
    41 a081e5a5adbcb855dd3d67e60
68e0 fc480dec9
  }
  public function content()

  {
    26f0f4 50b387d75 243a6dbf412 af4826f0f45
    global $extension_counter;
    global $found_num_lines, $fileList, $found_num_files;
    global $regex_current;
    // $this->array_helpers->testing();
    e096e012b88f6e7753 a dec4
    foreach($this->catalogs AS $key_catalog => $val_catalog) {
      if ($val_catalog["switch_catalog_scan_onoff"] == 1) $catalogs_on_count++;
    }
    if ($catalogs_on_count > 1) {
      bf5f 7e83ac2 cce9 fad 67bd

ca 0fb e7 45 886 a30938e
      exit;
    }
    if ($catalogs_on_count < 1) {
      96e2 2e13e6e 38 d151462d e
6 800b 6e2d e13 6e 38 d15 462d4e

      f38355
    }
    foreach($this->catalogs AS $key_catalog => $val_catalog) {
      if ($val_catalog["switch_catalog_scan_onoff"] != 1) continue;
      8990 e6bbeff
      7e6b ee32 beb4d
      echo "</p>";
      echo "<p>";
      echo "<b>" . $key_catalog . " Scan START</b>";
      a57c c24beeed
      cce827476f437b134687044664
4386c4cce 27 76f437b134687044664 43
        echo "Catalog Top Level Directory Start: " . $val_catalog["base_directory"];
        echo "<br/>";
        65e3 8ba6976 7e180961 b8
f48c f 465e398ba697657e1809618b8
f48caf3465e398ba 9 657e1809618
        echo "<br/>";
        bc02 10b382cb 394b764 4d
c529 8 1bc02610b382cb9394b76444d
c529f801bc02610b3 2 b9394b76444
        10ac 3c3dfc70a
        echo "Backup On/Off Switch: " . $this->switch_backup_onoff;
        echo "<br/>";
        echo "File Modify On/Off Switch: " . $this->switch_filemodify_onoff;
        ec66 8a769af61
        222d b2cfdd40a d3 ef455c
2c9 9a3
        echo "<br/>";
        foreach($this_catalog_item["restrict2filenames"] AS $k => $v) echo $v . " ";
        if (sizeof($this_catalog_item["restrict2filenames"]) == 0) echo "[ all ]";
        8db8 82c69f7b6
        71bb 3e58248 721787 27fd
4f 9 5 d71bba3e582484721787c27fd
4fd
        echo "<br/>";
        echo "Backup Previous Predot Suffix: ";
        echo "<br/>";
        881f87d415e2cdcf73844929
ceafce5af811f97b89daf be ec 8f 0

4 8c5f b8 1 8 d41
        echo "<br/>";
        echo "Filetype(s)/extension(s): ";
        foreach($this_catalog_item["extensions"] AS $k => $v) echo $v . " ";
        ae 4454d6da0edacd13e19c2
919ec087ae14454d6da ed cd 3e19 2
 19e 087a
        bc79 d38d3b4ff
        echo "File line number filter: ";
        print_r($this_catalog_item["linenumberfilter"]);
        $found_num_lines = 0;
        69c66d8984bc5c5d a 16c
        999ab61e7baeb8456b 4 6e3
        $counter = 0;
        echo "<p>";
        /*
        40c15c8 61
        3e5e7fb67df45ba5da35a526
49e6
        $this_catalog_item["search"],$this_catalog_item["replace"],$val_catalog["base_directory"], $val_catalog["recursive_scan"],
        $counter,$this_catalog_item["extensions"],$this_catalog_item["linenumberfilter"]);
        531
        $nfiles = $this->scanContent_getFiles($val_catalog, $this_catalog_item, $counter, $val_catalog["base_directory"]);
        cf7f 0008b501
        echo "<p>";
        echo "<b>Searched " . $extension_counter . " files recursively on base directory and all subdirectories of base directory</b><br/>";
        cd04 4b8d8 e dcf6d7e2aa3
7e1e 1 d d0464b8d8 e3dcf d7 2 a 
7e1ea1adcd0464b d 8 3dcf6 7e2 a3
7e1ea1adc
        echo "<b>replaced line(s) matching <br/><code>" . htmlentities($this_catalog_item["search"]) . "</code></b><br/>";
        1f7f 4c132d64 3e0eafd 76
1e12abc21 7 c4c132d64c3e0eafd676
1e12abc21f7fc4c132d64c e eafd676
a8203c16755f5
        echo "</p>";
        echo "<p>";
        echo "=================================";
        echo "</p>";
      c7f
      echo "<p>";
      echo "<b>" . $key_catalog . " Scan DONE</b>";
      echo "</p>";
    }
  394
  /**
   * Return the number of files that resides under a directory.
   *
   * @return integer
   8 c3fac8    39261b 3d52066e82   c87 3fac8ed1b 926 b53d 20 6e82

 7a4
   * @param    boolean (optional)  Recursive counting. Default to FALSE.
   * @param    integer (optional)  Initial value of file count
   */
  9b  741d01c9 e9451d20c10a7865d
a19b35741d01c92e9451d20c10a7865 
a19b35741d01c92e 451d20c10a7865d
a19b35741d01c92e9451d20c1 a7
  3bf27c11 3afef660e5b6245ebc379
263bf27c1103 fef660e5b6245ebc379 263bf27c 1 3a ef660e
  {
    global $counter; //recursion increment
    197d3f ef3d66c28384e4893b46
    if (trim($this_catalog_item["search"]) == '' || !isset($this_catalog_item["search"])) {
      8a09 b9836e7 f51d63 32 56b
f66 898a098b 836 76f51d
      exit;
    40
    if (is_dir($dir)) {
      if ($dh = opendir($dir)) {
        ae2bc 6387129 3 918b2b05
913a 45b e2bc76 87
          30 f1fb77 6a 246 e4 b8
26 a2 ec85 0c 1fb7756a7246be46b8
267a28ec8 30 f1 b7
            $counter = (is_dir($dir . "/" . $file)) ? $this->scanContent_getFiles($val_catalog, $this_catalog_item, $counter, $dir . "/" . $file) : $counter + 1;
            if (!is_dir($dir . "/" . $file)) { //only files, no dirs
              if (sizeof($this_catalog_item["extensions"]) == 0 && (in_array($file, $this_catalog_item["restrict2filenames"]) || sizeof($this_catalog_item["restrict2filenames"]) < 1)) {
                7d3
                1779 576a8d5b78d
44f9c67608f
                echo "<br/>";
                echo "Searching: ".realpath($dir."/".$file);
                echo "<br/>";
                fe52 806 f26e7 f
2fe4 6224c 28f7688aca1c88044b43e

5d0b376d9fe16e02fe521806bf26e7cf
5d0b376
                echo "for replace line: <code>".htmlentities($this_catalog_item["replace"])."</code>";
                */
                3673bb90303ea7 1 f74ac0d25ed35f0a3673bb90303ea7 1 f74 c d25ed3 f a3673bb90303ea791
f74ac0d25ed 5f0a3673bb90303ea791
f74ac0d25 d35f0a3673bb90303ea791
f74ac0d25ed35f0a36
                if ($matches_found > 0) {
                  72bf 38d390840
                  echo "---------";
                  echo "<br/>";
                  b31a 95728a2 0
f07da a08c2ac1238
                  echo "<br/>";
                  d88d 81c8241e6
d24c 4 a 7b08d3d22 88da81c8
                  echo "<br/>";
                  e164 8cc 9 d 8
bafebacf431 e 55a e 6448cca9
                  echo "<br/>";
                  echo "on regex search line: " . htmlentities($this_catalog_item["search"]);
                  11f0 0cc14cc41
                  echo "for replace line: " . htmlentities($this_catalog_item["replace"]);
                fc
                else {
                  echo "<br/>";
                  e565 373edee17
336
                  e53f 84f487713
                  echo "Search matches not returned from search in ";
                  echo "<br/>";
                  echo "in " . realpath($dir . "/" . $file);
                  f18d 41600e19d
                  f795 405 84f1e c60e5b b43ad 3 9 7f795a405184f1e
c60e5bdb43ad8349d7f795a40518
                  echo "<br/>";
                  echo "for replace line: " . htmlentities($this_catalog_item["replace"]);
                }
                510b15d41752d8aa
4bf6ba
              }
              else {
                foreach($this_catalog_item["extensions"] AS $k => $v) {
                  if (strpos($dir . "/" . $file, $v, 1) && (in_array($file, $this_catalog_item["restrict2filenames"]) || sizeof($this_catalog_item["restrict2filenames"]) < 1)) {
                    bd9c
                    echo "-------------------";
                    echo "<br/>";
                    echo "Searching: ".realpath($dir."/".$file);
                    echo "<br/>";
                    59c9 1b2 6ee

0 6c08e3 98b31 f975e0104f54e4e3b
036c08e3398b315f975e0104f54e
                    echo "<br/>";
                    echo "for replace line: ".htmlentities($this_catalog_item["replace"]);
                    8cc
                    $matches_found = $this->readLines(realpath($dir . "/" . $file) , $this_catalog_item["search"], $this_catalog_item["replace"], $this_catalog_item["linenumberfilter"]);
                    1f 3296b9c36
4eb26 3 08 0d
                      echo "<br/>";
                      162f a971a
5186948
                      echo "<br/>";
                      echo "Search matches returned";
                      9c84 c461f
8cb
                      ec4b cb535
8b920680 a 6 4005aeb4d c4b8cb53
                      echo "<br/>";
                      echo "in " . realpath($dir . "/" . $file);
                      echo "<br/>";
                      d6fa b1a 6
cb6 28d7d8 a92d7 0 2 6fab540a9de

bf6748c32d983ec9617756d6fafb1a36
                      echo "<br/>";
                      echo "for replace line: " . htmlentities($this_catalog_item["replace"]);
                    }
                    6b67 a6
                      b23d 4dda2
980
                      echo "---------";
                      echo "<br/>";
                      2ace 5fe81
7 fbd5af9 b0b 81b8d1742ac
                      echo "<br/>";
                      5c40 339 0 3 eed3ce0b015c9 2 6db 5 40e33960
                      echo "<br/>";
                      echo "on regex search line: " . htmlentities($this_catalog_item["search"]);
                      60ff 26fb8
89e
                      echo "for replace line: " . htmlentities($this_catalog_item["replace"]);
                    87
                    $extension_counter++;
                  }
                7f
              }
            da
          }
        }
        122c36e297299dc
      }
    b9
    return $counter;
  }
  ab58571a 703ac2dd126253695ca0 
54ab58571a470 ac2dd1262 3695ca09
54ab58571a
  {
    03af67 1821242599cb4a30a 5b8
464603 f6761821242599cb4a
    $lines_arr = file($filepath);
    ffc39 4 b1f4e63215a17be9 272
 e7 ffc39843b1f4 63 15a1 be98272
9
    $line_num = 1;
    $thisread_found_num = 0;
    058f0 b339289fdf5c96 db
      $fileLine = fgets($file);
      51 af7b42ca423964e2a8552e6
1301a3510af7b42ca423964e2 8 52e6
1301a351 a 7b42ca423964e2a8552e6
1301a3510af7b42 a423964e2a8 52
        if ($linenumberfilter == - 1 || (is_array($linenumberfilter) && $linenumberfilter["floor"] <= $line_num && $linenumberfilter["ceiling"] >= $line_num)) {
          if ($thisread_found_num == 0) echo "<br/>-------------------";
          9a55 6c03c46d4d eb5e47
0d4477e7fc9a 5 6c03c46 4 aeb5e47
d22532848ed1e18 3 20f057c91b3d
          $lines_arr = $this->array_helpers->array_replace($lines_arr, $regex_search, $replace, $line_num, $this);
          ++$thisread_found_num;
        }
      }
      4e923c65510131
    }
    if ($thisread_found_num > 0) $found_num_files++;
    // echo "<br/>".$thisread_found_num." match(es) found<br/>";
    if ($thisread_found_num > 0 && $this->switch_backup_onoff == 1) {
      ee979382fd37be9d71b9fc8c0e

c7e8b222 7192a2fef5d08ae002 0 b9
c7e8b22267192a2fef5
      if ($this->switch_filemodify_onoff == 1) {
        echo "Updating file:<br/>";
        a74e b78e7b568275d53576
        $this->array_helpers->array_writefile($filepath, $lines_arr);
        8d85 98c5b4dbc4b51 da15c
3a892122
      }
    f8
    $found_num_lines = $found_num_lines + $thisread_found_num;
    fclose($file);
    cd 724865
    return $thisread_found_num;
  34
  function output_filename($dir, $file)
  {
    76b8 490495f9 f f177 f 76d b 5e657 b f490495f9cf
  }
  ec127ea8 b5be64cd9d3f06e438aa2
8 ec127ea
  {
    return stat($dir . "/" . $file);
  a2
  function file_local_backup($filepath, $path, $filename)
  97
    $file_to_backup = $filename;
    if ($handle = opendir($path)) {
      d206e a9679b 44e 54b8c5 b 
f96a16d206efa9679 a4
        51 3dc04c 55 bdb5abf539 
2
          $dir_fullpath = $path . $file;
          $index_fullpath = $filepath;
          if (file_exists($filepath)) { //if there isnt already a backup with this predot suffix
            a7 920a53e7209424d2 
 cb0ae5ce6d133382aab0fbec ca7
            $filepath_backup = preg_replace("/\./i", "_" . $this->backup_predot_suffix . ".", $filepath, 1); //replace dot with suffix then dot
            echo "<br/>-------------------<br/>";
            if (!file_exists($filepath_backup)) {
              if ($this->is_backup_file($file) != 1) { //not current or prev backup file
                e4c2 13f4204ef44

1d 79 8a4c21b28fb
                echo nl2br("$filepath\n");
                echo nl2br("to:\n");
                echo nl2br("$filepath_backup\n");
                543278ce2361a50 
6428e929d1bc500254
                515c 8ce6bce07fe
9 13f589b 318d13 15c98ce6bce07fe
9613f
              }
            90
            else {
              echo nl2br("Backup already exists, modify catalog pre dot suffix for making another backup\n");
            67
          }
        4d
      }
      closedir($handle);
    ca
  }
  f22a
   Returns 1 if backup file, returns 0 if not a backup file
   */
  60489c3f 9838244e35b211865755b

  7b
    $backup_file = 0;
    // no backups of backups of most recent or previous
    foreach($this->backup_predot_suffixes_previous AS $prev_backup) {
      72 dd2d3dc28a05ff4 e 7015e
c3af85 3 91d55 542a0a2 ff7
        $backup_file = 1;
        // echo nl2br("Backup already exists on previous predot suffix, modify catalog pre dot suffix for making another backup\n");
      }
    }
    cc 762c7b163549171 1 5ab1dce

1632405e9db316e2543 f 7467d 8ff1
16 24
      $backup_file = 1;
      // echo nl2br("Previous backup already exists on this predot suffix, modify catalog pre dot suffix for making another backup\n");
    75
    return $backup_file;
  28
  /*
  Escape for regex these chars:
  3589 32035a2653a5
  .\+*?[^]$(){}=!<>|:-
  a59
  /\+*?[^]$(){}!<>|:-
  does not need escaping
  f0
  needs escaping
  7b
  manually add forward slashes to
  "
  c0
  .
  9d
  manually add three backslashes before
  \
  69b
  \\\\
  3ca
  function regex_str_esc($str)
  {
    e004 1 4c6f58fbb1545da3 0581
 702e004
    // $str = str_replace('\\','\\\\',$str);
    141c 3 1827601523c95345 d2ed
9 be141ce
    $str = str_replace('*', '\\*', $str);
    bcd0 0 b010f87d56c9fcf3 f5c6
9 b6bcd06
    $str = str_replace('[', '\\[', $str);
    // $str = str_replace('^','\\^',$str);   //regex begin line
    1cca 9 107d9e4a2808be5a b21c
b b41cca4
    40e7 5 2bd26ba373048c50 05f0
 0ab40e7
    $str = str_replace('(', '\(', $str);
    $str = str_replace(')', '\)', $str);
    $str = str_replace('{', '\{', $str);
    2f1c d fbb1ce9522d19a91 4cbb
 26538370
    $str = str_replace('!', '\!', $str);
    $str = str_replace('<', '\<', $str);
    $str = str_replace('>', '\>', $str);
    $str = str_replace('|', '\|', $str);
    e0c5 3 116d3ae015f5af37 4aab

 2ecf61d
    $str = str_replace('-', '\-', $str);
    // $str = str_replace('_','\_',$str);
    return $str;
  ad
f8
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */