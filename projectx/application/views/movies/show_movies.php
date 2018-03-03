<?php require_once dirname(__FILE__) . '/../../models/pic_functions.php';?>

<?php $attributes = array('class' => "form-inline");?>
<div id="main">
<div class="inner">
    <h4 align="center"><?php echo lang('show_products');?></h4>
    <!--处理产品的表单，如删除-->
    <?php echo form_open('products/show_products',$attributes); ?>
    <!-- 这里的表单submit功能用form="product_control_form"实现，这样可以不用包在form标签里面 因为form标签要分开 这里的form是删除产品用的-->
    <button type="button" onclick="window.location.href='<?php echo base_url('/index.php/products/create_products')?>'" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored">
        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> 新增视频
    </button>&nbsp&nbsp
    <button type="button" onclick="window.location.href='<?php echo base_url("/index.php/products/show_categories")?>'" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored">
        编辑标签
    </button>&nbsp&nbsp
    <font size="4"><label><b><?php echo lang('search');?></b></label></font>
    <input type="text" name="ref" class="form-control"  placeholder="<?php echo lang('num_ref');?>"/>&nbsp&nbsp

    <button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored">
        搜索
    </button>
    </form>
    &nbsp&nbsp
    <br><br>
    <?php echo $this->pagination->create_links(); ?>
    <div id="product_control_del_button" hidden>
        <a  href="#" data-toggle="modal" data-target="#supprimerm" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored">
            <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
            <?php echo lang('delete');?>
        </a>
    </div>
    <br>
    <div class="well well-sm" style="background-color:#FFFFFF; /*height:260px;*/ border:1px  ; overflow-x:hidden; overflow-y:scroll;">
        <table class="table table-hover table-inverse">
            <thead>
                <tr>
                    <th width="2%">
                        <label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="select_tout">
                            <input type="checkbox" id="select_tout" name="select_tout" class="mdl-checkbox__input">
                        </label>
                    </th>
                    <th><font size="4"><b>图片</b></font></th>
                    <th width="9%"><font size="4"><b>番号</b></font></th>
                    <th width="60%"><font size="4"><b>视频标题</b></font></th>
                    <th ><font size="4"><b>上传日期</b></font></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php $i=0?>
                <?php $attributes = array('class' => "form-inline",'id' => "product_control_form");?>
                <?php echo form_open('products/delete_products',$attributes); ?>
                <?php foreach ($movies as $un_movie): ?>
                    <tr>
                        <td>
                            <input type="checkbox" id="id_<?php echo $i?>" name="product_check_box[]" value="<?php echo $un_movie['rowid']?>">
                        </td>
                        <?php $i=$i+1?>
                        <td>
                            <?php show_poster_with_url($un_movie['rowid'],60)?>
                        </td>
                        <td>
                            <?php echo $un_movie['designation']?>
                        </td>
                        <td>
                            <font size="4">
                            <?php if($un_movie['title']!=null&&$un_movie['title']!="") {
                                if(mb_strlen($un_movie['title'],"UTF8")>8)
                                    echo mb_substr($un_movie['title'], 0, 8,"UTF8") . "...";//超过15个字只显示前15个字
                                else
                                    echo $un_movie['title'];} ?>
                            </font>
                        </td>
                        <!--<td>
                            <?php if($un_movie['description']!=null&&$un_movie['description']!="") {
                                if(mb_strlen($un_movie['description'],"UTF8")>15)
                                    echo mb_substr($un_movie['description'], 0, 15,"UTF8") . "...";//超过15个字只显示前15个字
                                else
                                    echo $un_movie['description'];} ?>
                        </td>-->
                        <td><font size="1"><?php echo $un_movie['date_upload'];?></font></td>

                        <td>
                            <button type="button" onclick="window.location.href='<?php echo base_url('/index.php/products/edit_product/').$un_movie['rowid']; ?>'" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect">
                                编辑
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            </form>
            <input type="hidden" id="total_product" value="<?php echo $i?>"><!-- 用于全选, 数清楚产品总数-->
        </table>
    </div>
    <?php echo $this->pagination->create_links(); ?>
</div>
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
</script>