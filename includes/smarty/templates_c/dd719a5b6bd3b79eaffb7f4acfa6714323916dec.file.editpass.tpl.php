<?php /* Smarty version Smarty-3.1.7, created on 2012-04-18 21:21:55
         compiled from "/home/kalphak/public_html/sper.gs/www/templates/default/editpass.tpl" */ ?>
<?php /*%%SmartyHeaderCode:15568000234f8f76c37492a1-20898556%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'dd719a5b6bd3b79eaffb7f4acfa6714323916dec' => 
    array (
      0 => '/home/kalphak/public_html/sper.gs/www/templates/default/editpass.tpl',
      1 => 1334802058,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '15568000234f8f76c37492a1-20898556',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'sitename' => 0,
    'message' => 0,
    'msg' => 0,
    'username' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_4f8f76c37a87a',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4f8f76c37a87a')) {function content_4f8f76c37a87a($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta name="generator" content=
  "HTML Tidy for Linux/x86 (vers 11 February 2007), see www.w3.org" />

  <title><?php echo $_smarty_tpl->tpl_vars['sitename']->value;?>
 - Edit Profile</title>
  <link rel="icon" href="//static.endoftheinter.net/images/dealwithit.ico" type=
  "image/x-icon" />
  <link rel="apple-touch-icon-precomposed" href=
  "//static.endoftheinter.net/images/apple-touch-icon-ipad.png" />
  <link rel="stylesheet" type="text/css" href=
  "templates/default/css/nblue.css?18" />
  <script type="text/javascript" src="/templates/default/js/base.js?27">
</script>
</head>

<body class="regular">
  <div class="body">
	<?php echo $_smarty_tpl->getSubTemplate ("navigation.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>


    <div style=
    "position:fixed;z-index:999;background:red;width:1px;height:1px;bottom:45px!important;bottom:10000px;right:24px">
    <!--a reminder, for all that we fought against. -->
    </div>

    <h1>Edit Profile</h1>
<?php  $_smarty_tpl->tpl_vars['msg'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['msg']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['message']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['msg']->key => $_smarty_tpl->tpl_vars['msg']->value){
$_smarty_tpl->tpl_vars['msg']->_loop = true;
?>
<h2><em><?php echo $_smarty_tpl->tpl_vars['msg']->value;?>
</em></h2>
<?php } ?><br />
    <form action="editpass.php" method="post" autocomplete="off">
      <table class="grid">
        <tr>
          <th colspan="2">Change Password for <?php echo $_smarty_tpl->tpl_vars['username']->value;?>
</th>
        </tr>

        <tr>
          <td>Confirm Your Current Password</td>

          <td><input type="password" name="old" size="30" /></td>
        </tr>

        <tr>
          <td>Enter A New Password</td>

          <td><input type="password" name="new" size="30" /></td>
        </tr>

        <tr>
          <td>Confirm Your New Password</td>

          <td><input type="password" name="new2" size="30" /></td>
        </tr>

        <tr>
          <td colspan="2"><input type="submit" name="go" value="Make Changes" /></td>
        </tr>
      </table>
    </form><br />
    <br />
	<?php echo $_smarty_tpl->getSubTemplate ("footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

  </div>
</body>
</html>
<?php }} ?>