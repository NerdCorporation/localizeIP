<?php /* Smarty version Smarty-3.1.18, created on 2015-02-08 11:28:25
         compiled from "Smarty_dir\templates\body_modCheck.tpl" */ ?>
<?php /*%%SmartyHeaderCode:669954b40587c43596-11789063%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '85712811b168425eb49ec11f4e012444228c1229' => 
    array (
      0 => 'Smarty_dir\\templates\\body_modCheck.tpl',
      1 => 1423311242,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '669954b40587c43596-11789063',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_54b40587c84638_93717574',
  'variables' => 
  array (
    'name' => 0,
    'surname' => 0,
    'CF' => 0,
    'check' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54b40587c84638_93717574')) {function content_54b40587c84638_93717574($_smarty_tpl) {?><div class="title">
    <p>PAZIENTE: <?php echo $_smarty_tpl->tpl_vars['name']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['surname']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['CF']->value;?>
</p>
</div>

<div class="clear"></div>


<!--<form class="button-form" method="POST" action="index.php?control=manageDB&action=modCheck&mod=completed&p=<?php echo md5($_smarty_tpl->tpl_vars['CF']->value);?>
&ch=<?php echo md5($_smarty_tpl->tpl_vars['check']->value);?>
">
    <table>
        <tr>
            <td class="field-label">Data visita:</td>
            <td> <input class="input-field" type="date" name="dateCheck" /> </td>
        </tr>
        
        <tr>
            <td class="area-label"> Anamnesi: </td>
            <td> <textarea class="input-area" rows="5" cols="60" name="medHistory"></textarea>
        </tr>
        
        <tr>
            <td class="area-label"> Esame obiettivo: </td>
            <td> <textarea class="input-area" rows="5" cols="60" name="medExam"></textarea>
        </tr>
        
        <tr>
            <td class="area-label"> Conclusioni: </td>
            <td> <textarea class="input-area" rows="5" cols="60" name="conclusions"></textarea>
        </tr>
        
        <tr>
            <td class="area-label"> Prescrizione esami: </td>
            <td> <textarea class="input-area" rows="5" cols="60" name="toDoExams"></textarea>
        </tr>
        
        <tr>
            <td class="area-label"> Terapia: </td>
            <td> <textarea class="input-area" rows="5" cols="60" name="terapy"></textarea>
        </tr>
        
        <tr>
            <td class="area-label"> Controllo: </td>
            <td> <textarea class="input-area" rows="5" cols="60" name="checkup"></textarea>
        </tr>
        
        <tr>
            <td> <button class="button" type="submit"/>invia dati</button> </td>
            <td> <button class="button" type="reset"/>reset</button> </td>
        </tr>
    </table>  
</form>-->

<form method="POST">
    <div class="row">
        <div class="row-element">
            <p class="label"><label>Data della visita</label></p>
            <p><input class="input-field" id="dateC" type="date" name="dateCheck" /></p>
        </div>
    </div>
    
    <div class="row">
        <div class="row-element">
            <p class="label"><label>Anamnesi</label></p>
            <p><textarea class="input-area" id="medH" rows="4" cols="40" name="medHistory"></textarea></p>
        </div>
    </div>
    
    <div class="row">
        <div class="row-element">
            <p class="label"><label>Esame obiettivo</label></p>
            <p><textarea class="input-area" id="medE" rows="4" cols="40" name="medExam"></textarea></p>
        </div>
    </div>
    
    <div class="row">
        <div class="row-element">
            <p class="label"><label>Conclusioni</label></p>
            <p><textarea class="input-area" id="conc" rows="4" cols="40" name="conclusions"></textarea></p>
        </div>
    </div>
    
    <div class="row">
        <div class="row-element">
            <p class="label"><label>Prescrizione esami</label></p>
            <p><textarea class="input-area" id="toDoE" rows="4" cols="40" name="toDoExams"></textarea></p>
        </div>
    </div>
    
    <div class="row">
        <div class="row-element">
            <p class="label"><label>Terapia</label></p>
            <p><textarea class="input-area" id="ter" rows="4" cols="40" name="terapy"></textarea></p>
        </div>
    </div>
    
    <div class="row">
        <div class="row-element">
            <p class="label"><label>Controllo</label></p>
            <p><textarea class="input-area" id="check" rows="4" cols="40" name="checkup"></textarea></p>
        </div>
    </div>
    
    <div class="row">
        <p> <button class="controlButton" type="submit" formaction="index.php?control=manageDB&action=modCheck&mod=completed&p=<?php echo md5($_smarty_tpl->tpl_vars['CF']->value);?>
&ch=<?php echo md5($_smarty_tpl->tpl_vars['check']->value);?>
"/>invia dati</button>
            <button class="controlButton" type="reset"/>reset</button>
            <button class="controlButton" type="submit" formaction="index.php?control=manageDB&action=getFullData&p=<?php echo md5($_smarty_tpl->tpl_vars['CF']->value);?>
&ch=<?php echo md5($_smarty_tpl->tpl_vars['check']->value);?>
"/>annulla</button>
        </p>
    </div>
</form>
    
<div class="spacing"></div><?php }} ?>
