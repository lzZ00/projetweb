<?php require_once dirname(__FILE__) . '/../../models/pic_functions.php';?>

    <?php $attributes = array('class' => "form-inline");?>
    <div class="col-md-10 col-md-offset-1">
       <h4 align="center"><?php echo lang('show_products');?></h4>
        <!--处理产品的表单，如删除-->
       <?php echo form_open('products/show_products',$attributes); ?>
            <!-- 这里的表单submit功能用form="product_control_form"实现，这样可以不用包在form标签里面 因为form标签要分开 这里的form是删除产品用的-->
            <!--<button hidden id="product_control_del_button" type="submit" form="product_control_form" <?php if(!isset($_SESSION['product_delete_permission'])) echo "disabled"?>class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect">
                <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
            </button>-->

            <!--<a align="left" href="<?php echo base_url('/index.php/products/create_products')?>" class="btn btn-primary"><?php echo lang('add_new_product');?></a>-->
            <button type="button" onclick="window.location.href='<?php echo base_url('/index.php/products/create_products')?>'" <?php if($add_permission==false) echo "disabled"?> class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored">
                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> <?php echo lang('add_new_product');?>
            </button>
            &nbsp&nbsp
            <button type="button" onclick="window.location.href='<?php echo base_url('/index.php/products/create_products_mobi')?>'" <?php if($add_permission==false) echo "disabled"?> class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored">
                <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span> <?php echo lang('add_new_product');?>-MOBI
            </button>
            &nbsp&nbsp
            <button type="button" onclick="window.location.href='<?php echo base_url("/index.php/products/upload_option")?>'" <?php if($import_permission==false) echo "disabled"?> class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored">
                <span class="glyphicon glyphicon-cloud-upload" aria-hidden="true"></span> <?php echo lang('upload_excel');?>
            </button>
            &nbsp&nbsp
            <button type="button" onclick="window.location.href='<?php echo base_url("/index.php/products/batch_import_photo")?>'" <?php if($add_permission==false) echo "disabled"?> class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored">
                <span class="glyphicon glyphicon-upload" aria-hidden="true"></span> 批量导入图片
            </button>
            <!--<a align="left" href="<?php echo base_url('/index.php/products/batch_import_photo')?>" class="btn btn-success">批量导入图片</a>-->
            &nbsp&nbsp
            <!--起始时间: <input type="date" name="date_begin" />
            结束时间: <input type="date" name="date_end" />
            -->
            <button type="button" onclick="window.location.href='<?php echo base_url("/index.php/products/export_excel")?>'" <?php if($export_permission==false) echo "disabled"?> class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored">
                <span class="glyphicon glyphicon-cloud-download" aria-hidden="true"></span> <?php echo lang('export_excel');?>
            </button>
            &nbsp&nbsp


            <font size="4"><label><b><?php echo lang('search');?></b></label></font>
                <input type="input" name="ref" class="form-control"  placeholder="<?php echo lang('num_ref');?>"/>

               <!--<input type="submit" name="search" class="btn btn-primary" value="<?php echo lang('search');?>"/>-->
                <button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored">
                    <span class="glyphicon glyphicon-search" aria-hidden="true"></span> <!--<?php echo lang('search');?>-->
                </button>
            </form>
            <!--<button type="button" onclick="window.location.href='<?php echo base_url("/index.php/products/show_entrepots")?>'" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored">
                <span class="glyphicon glyphicon-briefcase" aria-hidden="true"></span> 仓库&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
            </button>
            &nbsp&nbsp-->
            <button type="button" onclick="window.location.href='<?php echo base_url("/index.php/products/show_categories")?>'" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored">
                <span class="glyphicon glyphicon-tags" aria-hidden="true"></span> 品类折扣
            </button>
            &nbsp&nbsp
            <button type="button" onclick="window.location.href='<?php echo base_url("/index.php/expedition/show_expeditions")?>'" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored">
                运输
            </button>
            &nbsp&nbsp
        <br><br>
    <?php echo $this->pagination->create_links(); ?>
        <div id="product_control_del_button" hidden>
            <a  href="#" data-toggle="modal" data-target="#supprimerm" <?php if($delete_permission==false) echo "disabled"?> class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored">
                <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                <?php echo lang('delete');?>
            </a>
        </div>
        <br>
    <div class="well well-sm" style="background-color:#FFFFFF; /*height:260px;*/ border:1px  ; overflow-x:hidden; overflow-y:scroll;">
    <table class="table table-hover table-striped">
        <thead>
            <tr>
                <th><label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="select_tout">
                        <input type="checkbox" id="select_tout" name="select_tout" class="mdl-checkbox__input">
                    </label>
                </th>
                <th><font size="4"><b><?php echo lang('photo');?></b></font></th>
                <th><font size="4"><b><?php echo lang('barcode');?></b></font></th>
                <th><font size="4"><b><?php echo lang('label');?></b></font></th>
                <th><font size="4"><b><?php echo lang('description');?></b></font></th>
                <th><font size="4"><b><?php echo lang('price');?></b></font></th>
                <th><font size="4"><b>pmp</b></font></th>
                <th><font size="4"><b><?php echo lang('categorie');?></b></font>
                    <button id="demo-menu-lower-left" class="mdl-button mdl-js-button mdl-button--icon">
                        <span class="glyphicon glyphicon-option-vertical"></span>
                    </button>
                    <ul class="mdl-menu mdl-menu--bottom-left mdl-js-menu mdl-js-ripple-effect"
                        for="demo-menu-lower-left">
                        <li class="mdl-menu__item" onclick="window.location.href='<?php echo base_url('/index.php/products/show_products');?>'">
                            全部
                        </li>
                        <?php foreach ($categ as $donnes): ?>
                            <!--<li class="mdl-menu__item" onclick="window.location.href='<?php echo base_url('/index.php/products/show_products?categ_rowid='.$donnes['rowid']);?>'">
                            <?php echo $donnes['label']?>
                        </li>-->
                            <li class="mdl-menu__item" onclick="window.location.href='<?php echo base_url('/index.php/products/show_products?categ_rowid='.$donnes['rowid']);?>'">
                                <?php echo $donnes['label']?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </th>
                <th><font size="4"><b><?php echo lang('note');?></b></font></th>
                <th></th>
            </tr>
        </thead>
            <!--<td>
                <label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="select_tout">
                <input type="checkbox" id="select_tout" name="select_tout" class="mdl-checkbox__input">
                </label>
            </td>
            <td><font size="4"><b><?php echo lang('photo');?></b></font></td>
            <td><font size="4"><b><?php echo lang('barcode');?></b></font></td>
            <td><font size="4"><b><?php echo lang('label');?></b></font></td>
            <td><font size="4"><b><?php echo lang('description');?></b></font></td>
            <td><font size="4"><b><?php echo lang('price');?></b></font></td>
            <td>
                <font size="4"><b><?php echo lang('categorie');?></b></font>
                <button id="demo-menu-lower-left" class="mdl-button mdl-js-button mdl-button--icon">
                    <span class="glyphicon glyphicon-option-vertical"></span>
                </button>
                <ul class="mdl-menu mdl-menu--bottom-left mdl-js-menu mdl-js-ripple-effect"
                    for="demo-menu-lower-left">
                    <li class="mdl-menu__item" onclick="window.location.href='<?php echo base_url('/index.php/products/show_products');?>'">
                        全部
                    </li>
                    <?php foreach ($categ as $donnes): ?>
                        <li class="mdl-menu__item" onclick="window.location.href='<?php echo base_url('/index.php/products/show_products?categ_rowid='.$donnes['rowid']);?>'">
                            <?php echo $donnes['label']?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </td>
            <td><font size="4"><b><?php echo lang('note');?></b></font></td>
            <td></td>!-->
    <?php $i=0?>
    <?php $attributes = array('class' => "form-inline",'id' => "product_control_form");?>
    <?php echo form_open('products/delete_products',$attributes); ?>
    <?php foreach ($products as $un_product): ?>
        <tr>
            <td><input type="checkbox" id="id_<?php echo $i?>" name="product_check_box[]" value="<?php echo $un_product['rowid']?>"></td>
            <?php $i=$i+1?>

            <td width="6%"><?php
                $dir="../".$_SESSION['folder']."/documents/produit/".$un_product['ref'];
                $photos=get_photo_list($dir);
                if($photos!=NULL) {
                    foreach ($photos as $value) {
                        ?>
                        <a href="<?php echo base_url('/index.php/products/edit_photo/').$un_product['rowid']?>"><img class="img-rounded" src="../../../../<?php echo $_SESSION['dir'];?>/documents/produit/<?php echo $un_product['ref']. "/" . $value; ?>"
                                                                                                     img-rounded height="40"></a>
                        <?php
                    }
                }
                else echo"<a href=".base_url('index.php/products/edit_photo/').$un_product['rowid']."><img src='".base_url('assets/img/nophoto.png')."' img-rounded height=\"40\" ></a>";
                ?></td>
            <td>
                <a id="a_<?php echo $un_product['rowid']?>" align="left" href="<?php echo base_url("/index.php/products/info_products/".$un_product['rowid'])?>" onmouseover="show_product_preview(this.id)" onmouseout="hide_product_preview(this.id)"><?php echo $un_product['ref']; ?></a>

                <div id="preview_<?php echo $un_product['rowid']?>" class="product_preview">
                    <?php
                    $dir="../".$_SESSION['folder']."/documents/produit/".$un_product['ref'];
                    $photos=get_photo_list($dir);
                    if($photos!=NULL) {
                    foreach ($photos as $value) {
                    ?>
                    <a href="<?php echo base_url('/index.php/products/edit_photo/').$un_product['rowid']?>"><img class="img-rounded" src="../../../../<?php echo $_SESSION['dir'];?>/documents/produit/<?php echo $un_product['ref']. "/" . $value; ?>"
                                                                                                                 img-rounded height="200"></a>
                    <?php
                    }
                    }
                    ?>
                </div>
            </td>
            <td><?php if($un_product['label']!=null&&$un_product['label']!="") {
                    if(mb_strlen($un_product['label'],"UTF8")>8)
                        echo mb_substr($un_product['label'], 0, 8,"UTF8") . "...";//超过15个字只显示前15个字
                    else
                        echo $un_product['label'];} ?>
            </td>
            <td>
                <?php if($un_product['description']!=null&&$un_product['description']!="") {
                            if(mb_strlen($un_product['description'],"UTF8")>15)
                                echo mb_substr($un_product['description'], 0, 15,"UTF8") . "...";//超过15个字只显示前15个字
                            else
                                echo $un_product['description'];} ?>
            </td>
            <td><?php echo number_format($un_product['price'],2);?></td>
            <td><?php echo number_format($un_product['pmp'],2);?></td>
            <td>
                <?php echo $un_product['labe_categ']?>
            </td>
            <td>
                <?php if($un_product['note']!=null&&$un_product['note']!="") {
                    if(mb_strlen($un_product['note'],"UTF8")>5)
                        echo mb_substr($un_product['note'], 0, 5,"UTF8") . "...";//超过5个字只显示前5个字
                    else
                        echo $un_product['note'];} ?>
            </td>
            <td>
                <!--
                <button type="button" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#edit_product" data-ref="<?php echo $un_product['ref'];?>"
                data-label="<?php echo $un_product['label'];?>" data-price="<?php echo number_format($un_product['price'],2);?>"
                data-description="<?php echo $un_product['description'];?>">
                    编辑产品<?php echo $un_product['rowid']; ?>
                </button>
                -->
                <!--<a  href="<?php echo base_url('/index.php/products/edit_product/').$un_product['rowid']; ?>" class="btn btn-warning"><?php echo lang('edit');?></a>-->
                <button type="button" onclick="window.location.href='<?php echo base_url('/index.php/products/edit_product/').$un_product['rowid']; ?>'" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect">
                    <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                </button>
            </td>
        </tr>
    <?php endforeach; ?>
    </form>
    <input type="hidden" id="total_product" value="<?php echo $i?>"><!-- 用于全选, 数清楚产品总数-->
    </table>
    </div>
    <?php echo $this->pagination->create_links(); ?>
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

                <button id="product_control_del_button" type="submit" form="product_control_form" <?php if(!isset($_SESSION['product_delete_permission'])) echo "disabled"?>class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored mdl-js-ripple-effect">
                    <?php echo lang ('yes')?>
                </button>
                <button type="submit" data-dismiss="modal" aria-label="Close" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect">取消</button>
                </br>
            </div>
        </div>
    </div>
</div>

<div id="preview" class="product_preview">
    <?php
    $dir="../".$_SESSION['folder']."/documents/produit/".$un_product['ref'];
    $photos=get_photo_list($dir);
    if($photos!=NULL) {
        foreach ($photos as $value):?>
            <img class="img-rounded" src="../../../../<?php echo $_SESSION['dir'];?>/documents/produit/<?php echo $un_product['ref']. "/" . $value; ?>" img-rounded height="200">
            <?php endforeach;}?>
</div>

<script>
    $( "#select_tout" ).click(function() {
        n=document.getElementById("total_product").value;
        for(i=0;i<n;i++){
            if(document.getElementById("select_tout").checked===true) {
                document.getElementById("id_" + i).checked = true;
            }
            else{
                document.getElementById("id_" + i).checked = false;
            }
        }
    });
    n=document.getElementById("total_product").value;
    for(i=0;i<n;i++){
        $( "#id_" + i+",#select_tout").click(function() {
            flag=false;
            for(i=0;i<n;i++){
                if (document.getElementById("id_"+i).checked===true) {
                    show_product_control_panel();
                    flag=true;
                }
            }
            if(flag==false){
                hide_product_control_panel();
            }
        });
    }
    function show_product_control_panel(){
        $("#product_control_del_button").removeAttr("hidden");
        $("#product_control_del_button").show();
    }
    function hide_product_control_panel(){
        $("#product_control_del_button").hide();
    }
    //show_product_control_panel();
</script>
   <!-- 编辑产品弹窗，已弃用
      <div class="modal fade" id="edit_product" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
          <div class="modal-dialog" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title" id="exampleModalLabel">编辑产品</h4>
                  </div>
                  <div class="modal-body">
                      <form>
                          <div class="modal-ref">
                              <label class="control-label">编号</label>
                              <input type="text" class="form-control" id="ref">
                          </div>
                          <div class="modal-label">
                              <label class="control-label">标签</label>
                              <input type="text" class="form-control" id="label">
                          </div>
                          <div class="modal-price">
                              <label class="control-label">价格</label>
                              <input type="text" class="form-control" id="price">
                          </div>
                          <div class="modal-description">
                              <label class="control-label">产品描述</label>
                              <textarea class="form-control" id="description"></textarea>
                          </div>
                      </form>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                      <button type="submit" name="edit" class="btn btn-primary">变更</button>
                  </div>
              </div>
          </div>
      </div>

  <script>
      $('#edit_product').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget) // Button that triggered the modal
      var ref = button.data('ref') // Extract info from data-* attributes
      var label=button.data('label')
      var price=button.data('price')
      var description=button.data('description')
      // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
      // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
      var modal = $(this)
      //modal.find('.modal-title').text('New message to ' + recipient)
      modal.find('.modal-ref input').val(ref)
      modal.find('.modal-label input').val(label)
      modal.find('.modal-price input').val(price)
      modal.find('.modal-description textarea').val(description)
      })
  </script>
-->