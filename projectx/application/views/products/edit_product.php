<?php require_once dirname(__FILE__) . '/../../models/pic_functions.php';?>
<input type="hidden" id="base_url" value="<?php echo base_url()?>"/><!-- 用于js读取本地url -->
<?php foreach ($products as $un_product): ?>
    <?php
      $rowid=$un_product['rowid'];
      $ref=$un_product['ref'];
      $label=$un_product['label'];
      $datec=$un_product['datec'];
      $tms=$un_product['tms'];
      $author_name=$un_product['author_name'];
      $modif_name=$un_product['modif_name'];
    ?>
<?php endforeach; ?>
<?php echo validation_errors(); ?>
<input type="hidden" id="sku_flag" value="<?php echo $sku_flag?>">


<div class="col-md-6 col-md-offset-1">
    <?php
    $dir="../".$_SESSION['folder']."/documents/produit/".$ref;
    $photos=get_photo_list($dir);
    if($photos!=NULL) {
        foreach ($photos as $value) {
            ?>
            <a href="<?php echo base_url('/index.php/products/edit_photo/').$rowid?>"><img class="img-rounded" src="../../../../<?php echo $_SESSION['dir'];?>/documents/produit/<?php echo $ref . "/" . $value; ?>"
                                                                                         img-rounded height="100"></a>
            <?php
        }
    }
    else echo"<a href=".base_url('index.php/products/edit_photo/').$rowid."><img height=\"100\" src=\"../../../assets/img/nophoto.png\"?></a>";
    ?>&nbsp
    <font size="20" color="#00008b"><?php echo $ref ?></font><!-- 这里的ref只是为了激活表单验证添加-->
    &nbsp&nbsp&nbsp&nbsp
    <!--<font size="20"><?php echo $label ?></font>-->
</div>
<div class="col-md-3 col-md-offset-1">
    <div class="well well-sm" style="background-color:#FFFFFF; /*height:260px;*/ border:1px  ; overflow-x:hidden; overflow-y:scroll;">
        创建者: <?php echo $author_name?>
        <br>时间: <?php echo $datec?>
        <br>最后一次修改<?php echo $modif_name?>
        <br>时间: <?php echo $tms?>
    </div>
</div>
<div class="col-md-10 col-md-offset-1">
    </br>
    <?php $attributes = array('class' => "form-inline");?>
    <?php echo form_open('products/edit_product/'.$rowid,$attributes); ?>
    <input type="hidden" name="ref" class="form-control" value="<?php echo $ref;?>"/>
    <input type="hidden" id="rowid" name="rowid" class="form-control" value="<?php echo $rowid;?>"/>

    <?php foreach ($products as $un_product): ?>
    <input type="hidden" name="label" value="<?php echo $un_product['label']?>"/>
    <div class="well well-sm" style="background-color:#FFFFFF; /*height:260px;*/ border:1px  ; overflow-x:hidden; overflow-y:scroll;">
    <table class="table table-hover table-bordered">
        <tr>
            <td width="12%">
                <label><?php echo lang('label');?>zh_CN</label>
            </td>
            <td>
                <input type="text" name="label" value="<?php echo $un_product['label']?>" class="form-control" required/>
            </td>
        </tr>
        <tr>
            <td>
                <label><?php echo lang('description');?>zh_CN</label>
            </td>
            <td colspan="8">
                <textarea name="description" class="form-control" rows="2" cols="42"><?php echo $un_product['description']?></textarea>
            </td>
        </tr>

        <tr>
            <td>
                <label><?php echo lang('barcode');?></label>
            </td>
            <td colspan="8">
                <select class="form-control" name="barcode_type">
                    <option value="6" <?php if($un_product['fk_barcode_type']==6) echo 'selected'?>>Code 128</option>
                    <option value="2" <?php if($un_product['fk_barcode_type']==2) echo 'selected'?>>EAN13</option>
                    <option value="1" <?php if($un_product['fk_barcode_type']==1) echo 'selected'?>>EAN8</option>
                </select>
                <input type="text" name="barcode" class="form-control" value="<?php echo $un_product['barcode']?>" required/>
            </td>
        </tr>
        <tr>
            <td>
                <label>IntraStat</label>
            </td>
            <td colspan="7">
                <input type="text" name="intrastat" value="<?php echo $un_product['intrastat']?>" class="form-control"/>
            </td>
        </tr>
    </table>
    <table class="table table-hover table-bordered">
        <tr>
            <td width="10%">
                最佳买价
            </td>
            <td>
                <label id="best_buying_price"></label>
            </td>
            <td width="10%">
                PMP
            </td>
            <td>
                <?php echo number_format($un_product['pmp'],3);?>
            </td>
        </tr>
    </table>

    <!-- 供货商 -->
    <table id="fournisseur_product_table" class="table table-hover table-bordered">
        <tr id="fournisseur_product">
            <td><?php echo lang('fournisseur');?></td>
            <td><?php echo lang('suppliers_product_ref');?></td>
            <td><?php echo lang('suppliers_price');?></td>
            <td width="15%"><?php echo lang('tva_tx');?></td>
            <td width="10%"><?php echo lang('delivery_time_days');?></td>
            <td><?php echo lang('minimum_qty');?></td>
            <td><?php echo lang('discount');?>%</td>
        </tr>
        <!-- 新增供应商-->
        <tr>
            <td id="fournisseur_td">
                <div style="width: 80%; display: inline-block;">
                    <select id="fournisseur" name="fournisseur" required">
                    <option value="">-</option>
                    </select>
                    <lable id="fournisseur_label" style="width:130px;display: block;" ;></lable>
                </div>
            </td>
            <td>
                <div style="width: 80%; display: inline-block;">
                    <input type="input" name="suppliers_product_ref" id="suppliers_product_ref" class="form-control" />
                    <lable id="suppliers_product_ref_label" style="width:130px;display: block;"></lable>
                </div>
            </td>
            <td>
                <div style="width: 80%; display: inline-block;">
                    <input type="input" name="suppliers_price" id="suppliers_price" class="form-control"/>
                    <lable id="suppliers_price_label" style="width:130px;display: block;"></lable>
                </div>
            </td>
            <td>
                <input type="input" name="tva_tx_supplier" id="tva_tx_supplier" style="width:90px" class="form-control"/>
            </td>
            <td><input type="input" name="delivery_time_days" id="delivery_time_days" style="width:90px" class="form-control"/></td>
            <td>
                <div style="width: 80%; display: inline-block;">
                    <input type="input" name="minimum_qty" id="minimum_qty" class="form-control" value="1" style="width:60px;"/>
                    <lable id="minimum_qty_label" style="width:130px;display: block;"></lable>
                </div>
            </td>
            <td>
                <input type="text" id="discount_supplier" value="0" class="form-control" style="width:60px;"/>
            </td>
            <td width='5%'><input type='button' id ='add_fournisseur_product' onclick='add_fp()' class='btn btn-primary btn-sm' value='<?php echo lang('add')?>'></td>
        </tr>
    </table>

    <table class="table table-hover table-bordered">
        <tr>
            <td width="13%"><label><?php echo lang('price');?>(含增值税)</label></td>
            <td width="10%">
                <input name="price_ttc" id="price" value="<?php echo number_format($un_product['price_ttc'],3)?>" class="form-control" required/>
            </td>
            <td width="10%">
                <label><?php echo lang('tva_tx');?></label>
            </td>
            <td>
                <select class="form-control" name="tva_tx">
                    <!--<option value="0" <?php if($un_product['tva_tx']==0) echo "selected";?>>0%</option>
                    <option value="7" <?php if($un_product['tva_tx']==7) echo "selected";?>>7%</option>
                    <option value="19"<?php if($un_product['tva_tx']==19) echo "selected";?>>19%</option>-->
                    <?php foreach ($tva_available as $un_tva): ?>
                        <option value="<?php echo $un_tva['taux']?>" <?php if($un_product['tva_tx']==$un_tva['taux']) echo "selected";?>><?php echo $un_tva['taux']?>%</option>
                    <?php endforeach; ?>
                </select>
            </td>
            <td>
                <label><?php echo lang('cost_price');?></label>
            </td>
            <td colspan="2">
                <input size="5" name="cost_price" id="cost_price" value="<?php echo number_format($un_product['cost_price'],3)?>" class="form-control"/>
            </td>
            <td>
                <label><?php echo lang('price_min_ttc');?></label>
            </td>
            <td>
                <input name="price_min_ttc" id="price_min_ttc" value="<?php echo number_format($un_product['price_min_ttc'],2)?>" class="form-control"/>
            </td>
        </tr>

        <tr>
            <td>
                <label><?php echo lang('seuil_stock_alerte');?></label>
            </td>
            <td>
                <input name="seuil_stock_alerte" id="seuil_stock_alerte" value="<?php echo $un_product['seuil_stock_alerte']?>" class="form-control"/>
            </td>
            <td>
                <label><?php echo lang('desired_stock')?></label>
            </td>
            <td colspan="6">
                <input name="desired_stock" id="desired_stock" value="<?php echo $un_product['desiredstock']?>" class="form-control"/>
            </td>
        </tr>
        <tr>
            <td>
                <label><?php echo lang('source_country')?></label>
            </td>
            <td colspan="8">
                <select id="source_country" name="source_country">
                    <option value="<?php echo $un_product['fk_country']?>" selected>
                        <?php echo $un_product['source_country']?>
                    </option>
                </select>
            </td>
        </tr>
        <tr class="sku">
            <td>
                <label>包barcode</label>
            </td>
            <td>
                <input type="text" name="barcode_pack" value="<?php echo $un_product['barcode_pack']?>" class="form-control"/>
            </td>
            <td>
                <label>包规格<span id="tip_pack" class="glyphicon glyphicon-info-sign" aria-hidden="true"></span></label>
                <div class="mdl-tooltip mdl-tooltip--large" for="tip_pack">
                    包(X个)
                </div>
            </td>
            <td colspan="6">
                <input type="text" size="5" name="pack" value="<?php echo $un_product['pack']?>" class="form-control"/>
            </td>
        </tr>
        <tr class="sku">
            <td>
                <label>箱barcode</label>
            </td>
            <td>
                <input type="text" name="barcode_box" value="<?php echo $un_product['barcode_box']?>" class="form-control"/>
            </td>
            <td>
                <label>箱规格<span id="tip_box" class="glyphicon glyphicon-info-sign" aria-hidden="true"></span></label>
                <div class="mdl-tooltip mdl-tooltip--large" for="tip_box">
                    箱(X个)
                </div>
            </td>
            <td colspan="6">
                <input type="text" size="5" name="box" value="<?php echo $un_product['box']?>" class="form-control"/>
            </td>
        </tr>
        <tr class="sku">
            <td>
                <label>运输箱barcode</label>
            </td>
            <td>
                <input type="text" name="barcode_bigbox" value="<?php echo $un_product['barcode_bigbox']?>" class="form-control"/>
            </td>
            <td>
                <label>运输箱规格<span id="tip_big_box" class="glyphicon glyphicon-info-sign" aria-hidden="true"></span></label>
                <div class="mdl-tooltip mdl-tooltip--large" for="tip_big_box">
                    运输箱(X个)
                </div>
            </td>
            <td colspan="6">
                <input type="text" size="5" name="bigbox" value="<?php echo $un_product['bigbox']?>" class="form-control"/>
            </td>
        </tr>
    </table>

    <!--多语言-->
    <!--
    <label data-toggle="collapse" data-target="#lang"><font size="3"><b><?php echo lang('multilingual_label')?></b></font><span class="glyphicon glyphicon-collapse-down" aria-hidden="true"></span></label>
    </br>
    </br>
    <div id="lang" class="collapse">
        <table class="table table-hover table-bordered">
            <tr>
                <td width="13%">
                    <label><?php echo lang('label');?> ES</label>
                </td>
                <td  colspan="4">
                    <input type="text" name="label_es" value="<?php echo $un_product['label_es'];?>" class="form-control"/>
                </td>
            </tr>
            <tr>
                <td>
                    <label><?php echo lang('description');?> ES</label>
                </td>
                <td colspan="6">
                    <textarea name="description_es" class="form-control" rows="2" cols="42"><?php echo $un_product['description_es'];?></textarea>
                </td>
            </tr>
        </table>
        <table class="table table-hover table-bordered">
            <tr>
                <td width="13%">
                    <label><?php echo lang('label');?> IT</label>
                </td>
                <td  colspan="4">
                    <input type="input" name="label_it" value="<?php echo $un_product['label_it'];?>" class="form-control" />
                </td>
            </tr>

            <tr>
                <td>
                    <label><?php echo lang('description');?> IT</label>
                </td>
                <td colspan="6">
                    <textarea name="description_it" class="form-control" rows="2" cols="42"><?php echo $un_product['description_it'];?></textarea>
                </td>
            </tr>
        </table>
        <table class="table table-hover table-bordered">
            <tr>
                <td width="13%">
                    <label><?php echo lang('label');?> DE</label>
                </td>
                <td  colspan="4">
                    <input type="text" name="label_de" value="<?php echo $un_product['label_de'];?>" class="form-control"/>
                </td>
            </tr>
            <tr>
                <td>
                    <label><?php echo lang('description');?> DE</label>
                </td>
                <td colspan="6">
                    <textarea name="description_de" class="form-control" rows="2" cols="42"><?php echo $un_product['description_de'];?></textarea>
                </td>
            </tr>
        </table>

        <label data-toggle="collapse" data-target="#lang_plus"><font size="2"><b>更多语言</b></font><span class="glyphicon glyphicon-collapse-down" aria-hidden="true"></span></label>
        <div id="lang_plus" class="collapse">
            <table class="table table-hover table-bordered">
                <tr>
                    <td width="13%">
                        <label><?php echo lang('label');?> EN</label>
                    </td>
                    <td>
                        <input type="input" name="label_en" value="<?php echo $un_product['label_en'];?>" class="form-control" />
                    </td>
                    <td width="13%">
                        <label><?php echo lang('label');?> FR</label>
                    </td>
                    <td>
                        <input type="input" name="label_fr" value="<?php echo $un_product['label_fr'];?>" class="form-control" />
                    </td>
                </tr>

                <tr>
                    <td>
                        <label><?php echo lang('description');?> EN</label>
                    </td>
                    <td>
                        <textarea name="description_en" class="form-control" rows="2" cols="42"><?php echo $un_product['description_en'];?></textarea>
                    </td>
                    <td>
                        <label><?php echo lang('description');?> FR</label>
                    </td>
                    <td>
                        <textarea name="description_fr" class="form-control" rows="2" cols="42"><?php echo $un_product['description_fr'];?></textarea>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    -->


    <label><font size="5"><b><?php echo lang('extra_fileds')?></b></font></label>
    </br>
    </br>
    <div id="extrafileds" >
        <table class="table table-hover table-bordered">
            <tr>
                <td><label><?php echo lang('brand')?></label></td>
                <td width="25%">
                    <select name="brand" id="brand">
                        <option value="<?php echo $un_product['brand_rowid']?>"><?php echo $un_product['brand_label']?></option>
                    </select>
                </td>
                <td colspan="4">
                    <input type="text" id="add_brand_label" class="form-control"/>
                    &nbsp
                    <input type="button" id="add_brand_button" value="<?php echo lang('add')?>" class='btn btn-primary btn-sm'>
                    <label id="info_brand">
                        <!--添加品牌成功或失败显示在这里-->
                        此处添加新的品牌
                    </label>
                </td>
            </tr>
            <tr>
                <td><label><?php echo lang('material')?></label></td>
                <td>
                    <input type="text" name="material" value="<?php echo $un_product['material']?>" class="form-control"/>
                </td>
                <td width="10%"><label><?php echo lang('function')?></label></td>
                <td colspan="3">
                    <input type="text" name="function" value="<?php echo $un_product['function']?>" class="form-control"/>
                </td>
            </tr>
            <tr>
                <td><label><?php echo lang('color')?></label></td>
                <td>
                    <input type="text" name="color" value="<?php echo $un_product['color']?>" class="form-control"/>
                </td>
                <td width="10%"><label><?php echo lang('caution')?></label></td>
                <td>
                    <input type="text" name="caution" value="<?php echo $un_product['caution']?>" class="form-control"/>
                </td>
                <td><label><?php echo lang('ingredient')?></label></td>
                <td>
                    <input type="text" name="ingredient" value="<?php echo $un_product['ingredient']?>" class="form-control"/>
                </td>
            </tr>
        </table>
    </div>

    <!--多语言自定义属性-->
    <label data-toggle="collapse" data-target="#extra_lang"><font size="3"><b><?php echo lang('multilingual')?></b></font><span class="glyphicon glyphicon-collapse-down" aria-hidden="true"></span></label>
    </br>
    </br>
    <div id="extra_lang" class="collapse">
        <table id="es" class="table table-hover table-bordered">
            <tr>
                <td width="13%">
                    <label><?php echo lang('label');?> ES</label>
                </td>
                <td  colspan="4">
                    <input type="text" name="label_es" value="<?php echo $un_product['label_es'];?>" class="form-control"/>
                </td>
            </tr>
            <tr>
                <td>
                    <label><?php echo lang('description');?> ES</label>
                </td>
                <td colspan="6">
                    <textarea name="description_es" class="form-control" rows="2" cols="42"><?php echo $un_product['description_es'];?></textarea>
                </td>
            </tr>
            <tr>
                <td><label><?php echo lang('material')?>ES</label></td>
                <td>
                    <input type="text" name="material_es" value="<?php echo $un_product['material_es'];?>" class="form-control"/>
                </td>
                <td width="10%"><label><?php echo lang('function')?>ES</label></td>
                <td colspan="3">
                    <input type="text" name="function_es" value="<?php echo $un_product['function_es'];?>" class="form-control"/>
                </td>
            </tr>
            <tr>
                <td><label><?php echo lang('color')?>ES</label></td>
                <td>
                    <input type="text" name="color_es" value="<?php echo $un_product['color_es'];?>" class="form-control"/>
                </td>
                <td width="10%"><label><?php echo lang('caution')?>ES</label></td>
                <td>
                    <input type="text" name="caution_es" value="<?php echo $un_product['caution_es'];?>" class="form-control"/>
                </td>
                <td><label><?php echo lang('ingredient')?>ES</label></td>
                <td>
                    <input type="text" name="ingredient_es" value="<?php echo $un_product['ingredient_es'];?>" class="form-control"/>
                </td>
            </tr>
        </table>
        <table id="it" class="table table-hover table-bordered">
            <tr>
                <td width="13%">
                    <label><?php echo lang('label');?> IT</label>
                </td>
                <td  colspan="4">
                    <input type="input" name="label_it" value="<?php echo $un_product['label_it'];?>" class="form-control" />
                </td>
            </tr>

            <tr>
                <td>
                    <label><?php echo lang('description');?> IT</label>
                </td>
                <td colspan="6">
                    <textarea name="description_it" class="form-control" rows="2" cols="42"><?php echo $un_product['description_it'];?></textarea>
                </td>
            </tr>
            <tr>
                <td><label><?php echo lang('material')?>IT</label></td>
                <td>
                    <input type="text" name="material_it" value="<?php echo $un_product['material_it'];?>" class="form-control"/>
                </td>
                <td width="10%"><label><?php echo lang('function')?>IT</label></td>
                <td colspan="3">
                    <input type="text" name="function_it" value="<?php echo $un_product['function_it'];?>" class="form-control"/>
                </td>
            </tr>
            <tr>
                <td><label><?php echo lang('color')?>IT</label></td>
                <td>
                    <input type="text" name="color_it" value="<?php echo $un_product['color_it'];?>" class="form-control"/>
                </td>
                <td width="10%"><label><?php echo lang('caution')?>IT</label></td>
                <td>
                    <input type="text" name="caution_it" value="<?php echo $un_product['caution_it'];?>" class="form-control"/>
                </td>
                <td><label><?php echo lang('ingredient')?>IT</label></td>
                <td>
                    <input type="text" name="ingredient_it" value="<?php echo $un_product['ingredient_it'];?>" class="form-control"/>
                </td>
            </tr>
        </table>
        <table id="de" class="table table-hover table-bordered">
            <tr>
                <td width="13%">
                    <label><?php echo lang('label');?> DE</label>
                </td>
                <td  colspan="4">
                    <input type="text" name="label_de" value="<?php echo $un_product['label_de'];?>" class="form-control"/>
                </td>
            </tr>
            <tr>
                <td>
                    <label><?php echo lang('description');?> DE</label>
                </td>
                <td colspan="6">
                    <textarea name="description_de" class="form-control" rows="2" cols="42"><?php echo $un_product['description_de'];?></textarea>
                </td>
            </tr>
            <tr>
                <td><label><?php echo lang('material')?>DE</label></td>
                <td>
                    <input type="text" name="material_de" value="<?php echo $un_product['material_de'];?>" class="form-control"/>
                </td>
                <td width="10%"><label><?php echo lang('function')?>DE</label></td>
                <td colspan="3">
                    <input type="text" name="function_de" value="<?php echo $un_product['function_de'];?>" class="form-control"/>
                </td>
            </tr>
            <tr>
                <td><label><?php echo lang('color')?>DE</label></td>
                <td>
                    <input type="text" name="color_de" value="<?php echo $un_product['color_de'];?>" class="form-control"/>
                </td>
                <td width="10%"><label><?php echo lang('caution')?>DE</label></td>
                <td>
                    <input type="text" name="caution_de" value="<?php echo $un_product['caution_de'];?>" class="form-control"/>
                </td>
                <td><label><?php echo lang('ingredient')?>DE</label></td>
                <td>
                    <input type="text" name="ingredient_de" value="<?php echo $un_product['ingredient_de'];?>" class="form-control"/>
                </td>
            </tr>
        </table>
        <table id="en" class="table table-hover table-bordered">
            <tr>
                <td width="13%">
                    <label><?php echo lang('label');?> EN</label>
                </td>
                <td colspan="5">
                    <input type="input" name="label_en" value="<?php echo $un_product['label_en'];?>" class="form-control" />
                </td>
            </tr>
            <tr>
                <td>
                    <label><?php echo lang('description');?> EN</label>
                </td>
                <td colspan="5">
                    <textarea name="description_en" class="form-control" rows="2" cols="42"><?php echo $un_product['description_en'];?></textarea>
                </td>
            </tr>
            <tr>
                <td><label><?php echo lang('material')?>EN</label></td>
                <td>
                    <input type="text" name="material_en" value="<?php echo $un_product['material_en'];?>" class="form-control"/>
                </td>
                <td width="10%"><label><?php echo lang('function')?>EN</label></td>
                <td colspan="3">
                    <input type="text" name="function_en" value="<?php echo $un_product['function_en'];?>" class="form-control"/>
                </td>
            </tr>
            <tr>
                <td><label><?php echo lang('color')?>EN</label></td>
                <td>
                    <input type="text" name="color_en" value="<?php echo $un_product['color_en'];?>" class="form-control"/>
                </td>
                <td width="10%"><label><?php echo lang('caution')?>EN</label></td>
                <td>
                    <input type="text" name="caution_en" value="<?php echo $un_product['caution_en'];?>" class="form-control"/>
                </td>
                <td><label><?php echo lang('ingredient')?>EN</label></td>
                <td>
                    <input type="text" name="ingredient_en" value="<?php echo $un_product['ingredient_en'];?>" class="form-control"/>
                </td>
            </tr>
        </table>
        <table id="fr" class="table table-hover table-bordered">
            <tr>
                <td width="13%">
                    <label><?php echo lang('label');?> FR</label>
                </td>
                <td colspan="5">
                    <input type="input" name="label_fr" value="<?php echo $un_product['label_fr'];?>" class="form-control" />
                </td>
            </tr>
            <tr>
                <td>
                    <label><?php echo lang('description');?> FR</label>
                </td>
                <td colspan="5">
                    <textarea name="description_fr" class="form-control" rows="2" cols="42"><?php echo $un_product['description_fr'];?></textarea>
                </td>
            </tr>
            <tr>
                <td><label><?php echo lang('material')?>FR</label></td>
                <td>
                    <input type="text" name="material_fr" value="<?php echo $un_product['material_fr'];?>" class="form-control"/>
                </td>
                <td width="10%"><label><?php echo lang('function')?>FR</label></td>
                <td colspan="3">
                    <input type="text" name="function_fr" value="<?php echo $un_product['function_fr'];?>" class="form-control"/>
                </td>
            </tr>
            <tr>
                <td><label><?php echo lang('color')?>FR</label></td>
                <td>
                    <input type="text" name="color_fr" value="<?php echo $un_product['color_fr'];?>" class="form-control"/>
                </td>
                <td width="10%"><label><?php echo lang('caution')?>FR</label></td>
                <td>
                    <input type="text" name="caution_fr" value="<?php echo $un_product['caution_fr'];?>" class="form-control"/>
                </td>
                <td><label><?php echo lang('ingredient')?>FR</label></td>
                <td>
                    <input type="text" name="ingredient_fr" value="<?php echo $un_product['ingredient_fr'];?>" class="form-control"/>
                </td>
            </tr>
        </table>
    </div>


    <table class="table table-hover table-bordered">
        <tr>
            <td width="8%">
                <?php echo lang('long');?>
            </td>
            <td width="12%">
                <input id="long" name="long" value="<?php echo number_format($un_product['length'],3);?>" style="width: 50px" class="form-control"/>m
            </td>
            <td width="6%">
                <?php echo lang('wide');?>
            </td>
            <td width="13%">
                <input id="wide" name="wide" value="<?php
                        if($un_product['length']==0)
                            echo 0;
                        else
                            echo number_format($un_product['surface']/$un_product['length'],3);?>" style="width: 40px" class="form-control"/>m
            </td>
            <td width="8%">
                <?php echo lang('hight');?>
            </td>
            <td width="8%">
                <input id="hight" name="hight" value="<?php
                        if($un_product['surface']==0)
                            echo 0;
                        else
                            echo number_format($un_product['volume']/$un_product['surface'],3);?>" style="width: 40px" class="form-control"/>m
            </td>
            <td width="5%">
                <?php echo lang('weight');?>
            </td>
            <td>
                <input type="text" name="weight" id="weight" value="<?php echo number_format($un_product['weight'],3);?>" style="width: 80px" class="form-control"/>
                <select class="form-control " name="weight_units">
                    <?php $weight_units=$un_product['weight_units']?>
                    <option value="<?php echo $weight_units?>"><?php if($weight_units==-3) echo 'g';else echo 'kg' ?></option>
                    <?php
                    if($weight_units==0)
                        echo '<option value="-3">g</option>';
                    else
                        echo '<option value="0">kg</option>';
                    ?>
                </select>
            </td>
        </tr>
    </table>

    <!--标签-->
    <table class="table table-hover table-bordered">
        <tr>
            <td>
                <label><?php echo lang('categorie');?></label>
            </td>
            <td>
                <span id="categtd">
                    <select name="categ" id="categ">
                        <option value="">-</option>
                    </select>
                </span>
                    </br>
                <label id="categ_label"></label>
            </td>
            <td>
                <label><?php echo lang('sub_categorie');?></label>
            </td>
            <td>
                <span id="sous_categtd">
                    <select name="sous_categ" id="sous_categ">
                        <option value="">-</option>
                    </select>
                </span>
                    </br>
                    <label id="sub_categ_label"></label>
            </td>
        </tr>
        <tr>
            <td width="10%">
                <label><?php echo lang('categ_selected');?></label>
            </td>
            <td colspan="3">
                <div id="sous_categ_div">
                    <?php $nb_categ=0;?>
                    <?php foreach ($categ_selected as $value): ?>
                        <input id="categ[<?php echo $nb_categ?>]" value="<?php echo $value['label'] ?>" type='button' onclick='remove_sous_categ(this.id,this.value)' class='btn btn-primary'/>
                        <input id="sous_categ[<?php echo $nb_categ?>]" type="hidden" name="sous_categ[<?php echo $nb_categ?>]" value="<?php echo $value['rowid']?>"/>
                        <?php $nb_categ=$nb_categ+1;?>
                    <?php endforeach; ?>
                </div>
            </td>
        </tr>
    </table>

    <!--备注-->
    <table class="table table-hover table-bordered">
        <tr>
            <td>
                <label><?php echo lang('note')?></label>
            </td>
            <td>
                <textarea name="note" class="form-control" rows="2" cols="42"><?php echo $un_product['note'];?></textarea>
            </td>
        </tr>
    </table>
    </div>
    <?php endforeach; ?>


    <div align="right">
        <a  href="<?php echo base_url('/index.php/products/create_products') ?>" class="btn btn-default"><?php echo lang('add_new_product');?></a>
        <input type="submit" name="submit" class="btn btn-default"value="<?php echo lang('done');?>" />
        <a  href="#" data-toggle="modal" data-target="#supprimerm" class="btn btn-danger <?php if(!isset($_SESSION['product_delete_permission'])) echo "disabled"?>"><?php echo lang('delete');?></a>

    </div>
    <button type="button" onclick="window.location.href='<?php echo base_url('/index.php/products/show_products')?>'" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect">
        <span class="glyphicon glyphicon-home" aria-hidden="true"></span> <?php echo lang('back_to_home')?>
    </button>
    </form>

</div>


<!-- 删除确认的弹窗-->
<div class="modal fade" id="supprimerm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">删除确认</h4>
            </div>
            <div class="modal-body">
                <p>确定要删除吗？</p>
                <a href="<?php echo base_url('/index.php/products/delete_by_rowid/'.$rowid)?>" class="btn btn-danger"value="Supprimer" name="Supprimer" >确定</a>
                <button type="submit" class="btn btn-primary "data-dismiss="modal" aria-label="Close" >取消</button>
                </br>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo base_url()?>assets/js/number_only_setting.js"></script><!-- 对一些框只能输入数字的设置 -->
<script src="<?php echo base_url()?>assets/js/supplier_product.js"></script><!-- 添加供应商--产品价格的表单验证 -->
<script src="<?php echo base_url()?>assets/js/product/language_option.js"></script><!-- 用户选项，隐藏语言 -->
<script src="<?php echo base_url()?>assets/js/product/unit.js"></script><!-- 单位 -->


<script>
    /*select 插件函数*/
    function dataParserA(data, selected) {
        retval = [ { val: "" , text: "-" } ];

        data.forEach(function(v){
            if(selected == "-1" && v.val == 3)
                v.selected = true;
            retval.push(v);
        });

        return retval;
    }


    /* 获得categ列表*/
    $("#categ").tinyselect({ searchCaseSensitive: false, dataUrl: "../../Ajax_products/get_categ" , dataParser: dataParserA });
    $("#havoc").show()

    /*获得sous_categ列表*/
    /*没有选择categ的时候显示空*/
    $("#sous_categ").tinyselect({ searchCaseSensitive: false, dataUrl: "../../Ajax_products/get_sous_categ/-1" , dataParser: dataParserA });
    $("#havoc").show()
    /*categ选择了之后重置表格*/
    $('#categ').on('change', function() { //获得select选则元素之后的值
        //alert( this.value );
        if(fk_parent!='') {
            $("#sous_categ").empty();
            $("#sous_categtd").find("div[class='tinyselect']").remove(); //需要把之前的去掉，注意这里是td 解释：http://m.blog.csdn.net/article/details?id=53930141
            var fk_parent=this.value

            $("#sous_categ").tinyselect({searchCaseSensitive: false, dataUrl: "../../Ajax_products/get_sous_categ/" + fk_parent, dataParser: dataParserA});
            $("#havoc").show()
        }
    })

    //获得国家列表
    $("#source_country").tinyselect({ searchCaseSensitive: false, dataUrl: "../../Ajax_products/get_list_country" , dataParser: dataParserA });
    $("#havoc").show()

    //获得品牌列表
    $("#brand").tinyselect({ searchCaseSensitive: false, dataUrl: "../../Ajax_products/get_brand" , dataParser: dataParserA });
    $("#havoc").show()

    //添加品牌
    $("#add_brand_button").click(function(){
        var label=$("#add_brand_label").val();
        if(label!="") {
            $.ajax({
                url: "../../Ajax_products/add_brand/" + label,
                success: function (result) {
                    $("#add_brand_label").val("");
                    $("#info_brand").html("添加成功");
                },
                error: function (result) {
                    $("#info_brand").html("<font color='#8b0000'>该品牌已存在</font>");
                }
            });
        }

    });

    var nb_categ=0;
    var categ_array=[];
    $(document).ready(function(){
        $("#sous_categ").change(function(){
            var value=$("#sous_categ").val();
            var name=$( "#sous_categ option:selected" ).text();
            if(value!='-1') {
                if((categ_array.indexOf(name)==-1)&&name!='-') {//判断是否已经添加该标签
                    categ_array.push(name);
                    $("#sous_categ_div").append(function () {
                        nb_categ = nb_categ + 1;
                        return "<input id='categ[" + nb_categ + "]' value='" + name + "' type='button' onclick='remove_sous_categ(this.id,this.value)' class='btn btn-primary'/>&nbsp&nbsp;"
                            + "<input id='sous_categ[" + nb_categ + "]' type='hidden' name='sous_categ[" + nb_categ + "]' value='" + value + "' />";//hidden用于传值
                    });
                }
            }
        });
    });
    $(document).ready(function(){
        $("#categ").change(function(){
            var value=$("#categ").val();
            var name=$( "#categ option:selected" ).text();
            if(value!='-1'&&value!='') {
                if((categ_array.indexOf(name)==-1)) {//判断是否已经添加该标签
                    categ_array.push(name);
                    $("#sous_categ_div").append(function () {
                        nb_categ = nb_categ + 1;
                        return "<input id='categ[" + nb_categ + "]' value='" + name + "' type='button' onclick='remove_sous_categ(this.id,this.value)' class='btn btn-primary'/>&nbsp&nbsp;"
                            + "<input id='sous_categ[" + nb_categ + "]' type='hidden' name='sous_categ[" + nb_categ + "]' value='" + value + "' />";//hidden用于传值
                    });
                }
            }
        });
    });

    function remove_sous_categ(id,name){
        var parent=document.getElementById("sous_categ_div");
        var child=document.getElementById(id);
        var childh=document.getElementById('sous_'+id);//获得hidden标签的id
        parent.removeChild(child);//同时删除categ按钮
        parent.removeChild(childh);//同时删除hidden标签
        Array.prototype.remove = function() {//删除数组内指定元素函数
            var what, a = arguments, L = a.length, ax;
            while (L && this.length) {
                what = a[--L];
                while ((ax = this.indexOf(what)) !== -1) {
                    this.splice(ax, 1);
                }
            }
            return this;
        };
        categ_array.remove(name);//删除arry中的元素
    }


    /* 获得供应商列表 //json类型数据*/
    /*
     $("#fournisseur").tinyselect({ searchCaseSensitive: false, dataUrl: "../Ajax_products/get_fournisseur" , dataParser: dataParserA });
     $("#havoc").show()*/
    /*
    $("#cost_price").keyup(function(){
        var price_suggest=$("#cost_price").val()*1.19;
        price_suggest=price_suggest.toFixed(2);//保留两位小数
        $("#price_min_ttc").val(price_suggest);
    });*/




    /* 获得供应商列表 //json类型数据*/

    $("#fournisseur").tinyselect({ searchCaseSensitive: false, dataUrl: "../../Ajax_products/get_fournisseur" , dataParser: dataParserA });
    $("#havoc").show()
    var best_buying_price;
    //用ajax输出供货商信息 //好像没必要用ajax 日  //有用，如果不用这个在上面用foreach的话，会全部信息出现n次
    var json_product_fournisseur;
    var rowid;
    var ref_fourn;
    var fournisseur;
    var unitprice;
    var tva_tx_supplier;
    var delivery_time_days;
    var quantity;
    var discount_supplier;
    $(document).ready(function(){
        var id=$("#rowid").val();
        $.ajax({url: "../../Ajax_products/get_fournisseur_product/"+id,
            async:false,//设置成同步
            success: function(result){
            json_product_fournisseur=eval(result);
                best_buying_price=json_product_fournisseur[0]['unitprice']*(100-json_product_fournisseur[0]['discount'])/100;//最佳买价给数组第一个值
                $.each(json_product_fournisseur, function() {
                rowid=this.rowid;
                ref_fourn=this.ref_fourn;
                fournisseur=this.fournisseur;
                unitprice=this.unitprice;
                tva_tx_supplier=this.tva_tx;
                delivery_time_days=this.delivery_time_days;
                quantity=this.quantity;
                discount_supplier=this.discount;
                $("#fournisseur_product").after(function(){
                    return "<tr id='tr_"+rowid+"' >"+
                        "<input type='hidden' name='"+fournisseur+"' value='"+rowid+"'/>"+
                        "<td>"+fournisseur+"</td>"+
                        "<td>"+ref_fourn+"</td>"+
                        "<td>"+unitprice+"</td>"+
                        "<td>"+tva_tx_supplier+"%</td>"+
                        "<td>"+delivery_time_days+"</td>"+
                        "<td>"+quantity+"</td>"+
                        "<td>"+discount_supplier+"</td>"+
                        "<td width='5%'><input type='button' id ='"+rowid+"' onclick='del_fp(this.id)' class='btn btn-danger btn-sm' value='删除'></td>"+
                        "</tr>";
                });
                if(best_buying_price>unitprice*(100-discount_supplier)/100){
                    best_buying_price=unitprice*(100-discount_supplier)/100;
                };
            });
        }});
        $("#best_buying_price").html(best_buying_price);
    });
    //删除供应商产品价格
    function del_fp(id){
        $.ajax({url: "../../Ajax_products/delete_product_fournisseur_price/"+id, success: function(result){
            $("#tr_"+id).remove();
        }});
    }

    //动态查看新增供应商--产品价格栏是否填写
    //该方法已经写在supplier_products.js文件引入
    /*
    $('#fournisseur').change(function(){
        var fk_soc=document.getElementById("fournisseur").value;
        if(fk_soc==''){ //验证是否选择供应商
            document.getElementById("fournisseur_label").innerHTML='<font color="#8b0000">需要选择供应商</font>';
        }
        else document.getElementById("fournisseur_label").innerHTML='';
    });
    $('#suppliers_product_ref').keyup(function(){
        var suppliers_product_ref=document.getElementById("suppliers_product_ref").value;
        if(suppliers_product_ref==''){ //验证是否填写ref号
            document.getElementById("suppliers_product_ref_label").innerHTML='<font color="#8b0000">需要填写ref号</font>';
        }
        else document.getElementById("suppliers_product_ref_label").innerHTML='';
        //验证ref号是否重复
        $.ajax({url: "../../Ajax_products/check_product_fournisseur_ref/"+suppliers_product_ref, success: function(result){
            if(result==false){
                document.getElementById("suppliers_product_ref_label").innerHTML='<font color="#8b0000">ref号有重复</font>';
                flag_ref=false;
            }
            else flag_ref=true;
        }});
    });
    $('#suppliers_price').keyup(function(){
        var suppliers_price=document.getElementById("suppliers_price").value;
        if(suppliers_price==''){ //验证是否填写价格
            document.getElementById("suppliers_price_label").innerHTML='<font color="#8b0000">需要填写价格</font>';
        }
        else document.getElementById("suppliers_price_label").innerHTML='';
    });
    $('#minimum_qty').keyup(function(){
        var minimum_qty=document.getElementById("minimum_qty").value;
        if(minimum_qty==''){ //验证是否填写起订量
            document.getElementById("minimum_qty_label").innerHTML='<font color="#8b0000">需要填写起订量</font>';
        }
        else if(minimum_qty==0){
            document.getElementById("minimum_qty_label").innerHTML='<font color="#8b0000">起订量不能为0</font>';
        }
        else document.getElementById("minimum_qty_label").innerHTML='';
    });
    */

    //添加按钮的事件
    //新增供应商——产品价格 $fk_product,$fk_soc,$suppliers_product_ref,$unitprice,$tva_tx,$delivery_time_days,$quantity
    function add_fp(){
        var fk_soc=document.getElementById("fournisseur").value;
        var suppliers_product_ref=document.getElementById("suppliers_product_ref").value;
        var suppliers_price=document.getElementById("suppliers_price").value;
        var minimum_qty=document.getElementById("minimum_qty").value;
        //说明：第一次的if只是为了提示没有输入的文本，没有阻断函数，而第二次则是用于阻断函数。
        //     为什么不能放到一起？   :如果放到一起一次只能提示最早的那一个，如果下一个文本框也没填写则无法提示
        if(fk_soc==''){ //验证是否选择供应商
            document.getElementById("fournisseur_label").innerHTML='<font color="#8b0000">需要选择供应商</font>';
        }
        if(suppliers_product_ref==''){ //验证是否填写ref
            document.getElementById("suppliers_product_ref_label").innerHTML='<font color="#8b0000">需要填写ref号</font>';
        }
        if(suppliers_price==''){ //验证是否填写价格
            document.getElementById("suppliers_price_label").innerHTML='<font color="#8b0000">需要填写价格</font>';
        }
        if(minimum_qty==''){ //验证是否填写起订量
            document.getElementById("minimum_qty_label").innerHTML='<font color="#8b0000">需要填写起订量</font>';
        }
        //用于终止函数
        if(fk_soc==''){ //验证是否选择供应商
            $('#fournisseur').focus()
            return; //终止函数
        }
        if(suppliers_product_ref==''){ //验证是否填写ref
            $('#suppliers_product_ref').focus()
            return;
        }
        if(flag_ref==false){//验证ref号是否重复
            $('#suppliers_product_ref').focus()
            return;
        }
        if(suppliers_price==''){ //验证是否填写价格
            $('#suppliers_price').focus()
            return;
        }
        if(minimum_qty==''||minimum_qty==0){ //验证是否填写起税率
            $('#minimum_qty').focus()
            return;
        }
        if(minimum_qty==''||minimum_qty==0){ //验证是否填写起订量
            $('#minimum_qty').focus()
            return;
        }
        //如果以上四个方框都有填写，则执行添加
            var rowid = document.getElementById("rowid").value;
            var tva_tx = document.getElementById("tva_tx_supplier").value;
            var delivery_time_days = document.getElementById("delivery_time_days").value;
            var discount_supplier = document.getElementById("discount_supplier").value;

        if(tva_tx==''){//如果没有输入税率设为0
                tva_tx=0;
            }
            if(delivery_time_days==''){//如果没有输入超期天数设为0
                delivery_time_days=0;
            }
            $.ajax({
                url: "../../Ajax_products/add_product_fournisseur_price/" + rowid + "/" + fk_soc + "/" + suppliers_product_ref + "/" + suppliers_price + "/" + tva_tx + "/" + delivery_time_days + "/" + minimum_qty + "/" + discount_supplier + "/",
                success: function (result) {
                    document.getElementById("suppliers_product_ref").value = '';
                    document.getElementById("suppliers_price").value = '';
                    document.getElementById("tva_tx_supplier").value = '';
                    document.getElementById("delivery_time_days").value = '';
                    document.getElementById("minimum_qty").value = 1;
                    document.getElementById("discount_supplier").value = 0;
                    json_product_fournisseur = eval(result);
                    $.each(json_product_fournisseur, function () {
                        rowid = this.rowid;
                        ref_fourn = this.ref_fourn;
                        fournisseur = this.fournisseur;
                        unitprice = this.unitprice;
                        tva_tx = this.tva_tx;
                        delivery_time_days = this.delivery_time_days;
                        quantity = this.quantity;
                        //如果添加成功，则在html上增加刚刚添加的那一行信息
                        $("#fournisseur_product").after(function () {
                            return "<tr id='tr_" + rowid + "' >" +
                                "<input type='hidden' name='" + fournisseur + "' value='" + rowid + "'/>" +
                                "<td>" + fournisseur + "</td>" +
                                "<td>" + ref_fourn + "</td>" +
                                "<td>" + unitprice + "</td>" +
                                "<td>" + tva_tx + "%</td>" +
                                "<td>" + delivery_time_days + "</td>" +
                                "<td>" + quantity + "</td>" +
                                "<td>" + discount_supplier +"</td>"+
                                "<td width='5%'><input type='button' id ='" + rowid + "' onclick='del_fp(this.id)' class='btn btn-danger btn-sm' value='删除'></td>" +
                                "</tr>";
                        });
                    });

                }
            });
    }


</script>