<?php /* Smarty version Smarty-3.1.18, created on 2015-04-16 01:14:40
         compiled from "Smarty_dir\templates\pictures.tpl" */ ?>
<?php /*%%SmartyHeaderCode:3378552ee8786d6393-31838647%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '49e8f10d8ab6727930592df1128a9c45baf5e498' => 
    array (
      0 => 'Smarty_dir\\templates\\pictures.tpl',
      1 => 1429139646,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3378552ee8786d6393-31838647',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_552ee87870bdd1_67044844',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_552ee87870bdd1_67044844')) {function content_552ee87870bdd1_67044844($_smarty_tpl) {?>    <div class="wrap">
    <div class="content">
    	<div class="contact">
            <div class="title">
                <h2>Pictures Trlolo</h2>
            </div>    	
    	<div class="contact-form">
            <table id="GeoResults"></table>
            
            
					
			<form method="POST" action="index.php?controllerAction=ajaxCall&task=take" id="data">
			<div>
			<span><label>Nome</label></span>
			 <span><input type="text" value="" /></span>
			</div>
			<div>
			<span><label>Email</label></span>
				<span><input type="text" value="" /></span>
				</div>
				<div>
				<span><label>Messaggio</label></span>
			 <span><textarea> </textarea></span>
			 </div>
			<div>
			<span><input type="submit" value="Invia"></span>
			</div>
            </form>
				
			</div>
			<div class="map">
				<iframe width="600" height="450" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/place?q=Ospedale%20Regionale%20San%20Salvatore%2C%20L'Aquila%2C%20AQ%2C%20Italia&key=AIzaSyD_rV1R7UI_eD4VUFG2BJP7pvZ2mOLgAG8"></iframe>  <br /><small><a href="http://maps.google.co.in/?ie=UTF8&amp;ll=14.264383,79.804688&amp;spn=153.263776,68.554688&amp;t=m&amp;z=2&amp;source=embed" style="color:#999797;font-family: 'Noto Sans', sans-serif;text-align:left">Ingrandisci</a></small>
			</div>
		<div class="clear"> </div>
<!-- DC Pagination:C9 End -->
				</div>
			</div>
	<div class="clear"> </div>
    </div>



<?php }} ?>
