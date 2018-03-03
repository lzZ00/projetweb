<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>GTech</title>
    <!-- jquery -->
    <script src="<?php echo base_url()?>assets/jquery-3.2.0.min.js"></script>
    <!-- 只能输入数字的插件 -->
    <script src="<?php echo base_url()?>assets/js/number_only.js"></script>
    <!-- Bootstrap -->
    <link href="<?php echo base_url()?>assets/css/bootstrap.min.css" rel="stylesheet">
    <!--<link href="<?php echo base_url()?>assets/css/bootswatch_paper.min.css" rel="stylesheet">-->
    <!--Material-->
    <link href="<?php echo base_url()?>assets/css/material.min.css" rel="stylesheet">
    <!--<link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.blue-red.min.css" /><!--谷歌的网站国内引用可能会出问题-->
    <script src="<?php echo base_url()?>assets/js/material.min.js"></script>
    <!-- select插件 -->
    <link rel="stylesheet" href="<?php echo base_url()?>assets/css/tinyselect.css">
    <script src="<?php echo base_url()?>assets/js/tinyselect.js"></script>
    <!-- select插件--chosen -->
    <link rel="stylesheet" href="<?php echo base_url()?>assets/css/chosen.css">
    <script src="<?php echo base_url()?>assets/js_plug/chosen.jquery.min.js"></script>
    <!-- 鼠标悬停显示页面插件 -->
    <!--<link rel="stylesheet" href="<?php echo base_url()?>assets/css/tooltipster.bundle.min.css">
    <script type="text/javascript" src="<?php echo base_url()?>assets/js_plug/tooltipster.bundle.min.js"></script>-->
    <!-- 鼠标悬停显示预览插件-->
    <link rel="stylesheet" href="<?php echo base_url()?>assets/css/jquery.tinypreview.css">
    <script type="text/javascript" src="<?php echo base_url()?>assets/js_plug/jquery.tinypreview.js"></script>
    <!--
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.indigo-blue.min.css" />
    <script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>
    -->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
        img.pos_abs
        {
            position:absolute;
            left:1000px;
            top:2px;
            z-index:999
        }
        body {background-color:#f1f4f4;}
        .nav_pos{
            position: fixed;
            top: 0px;
            z-index: 500;
            /*background-color: #FF6668;*/
            /*opacity: 0.68;*/
            width: 100%;
        }
        .dropdown-menu{ /*设置dropdown宽度自适应*/
            min-width: inherit;
        }

    </style>
</head>
<body>
<nav class="navbar navbar-default nav_pos">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo base_url('/index.php/login/main_page')?>">LOGO</a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <!--<li class="active"><a href="<?php echo base_url('/index.php/products/show_products')?>"><?php echo lang('product')?> <span class="sr-only">(current)</span></a></li>
                <li><a href="<?php echo base_url('/index.php/societe/show_societes')?>"><?php echo lang('supplier')?> <span class="sr-only">(current)</span></a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?php echo lang('categorie');?> <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <!--<?php foreach ($categ as $donnes): ?> 产品类别列表，已废弃
                            <li><a href="<?php echo base_url('/index.php/products/show_products?categ_rowid='.$donnes['rowid']);?>"><?php echo $donnes['label']?></a>
                            </li>
                        <?php endforeach; ?>
                        -->
                        <!--预设的菜单
                        <li><a href="#">Another action</a></li>
                        <li><a href="#">Something else here</a></li>
                        <li class="divider"></li>
                        <li><a href="#">Separated link</a></li>
                        <li class="divider"></li>
                        <li><a href="#">One more separated link</a></li>
                        -->
                    <!--</ul>
                </li>-->
            </ul>
            <!--
            <?php $attributes = array('class' => "navbar-form navbar-left", 'role'=>"search");?>
            <?php echo form_open('products/show_products',$attributes); ?>
                <div class="form-group">
                    <input type="text" name="ref" class="form-control" placeholder="<?php echo lang("num_ref");?>">
                </div>
            <button type="submit" name="search" class="btn btn-default"><?php echo lang("search");?></button>
            </form>
            -->
            <div class="navbar-form navbar-left">
                <a href="<?php echo base_url('/index.php/products/show_products')?>"><img src="<?php echo base_url()?>assets/img/product.png" height="30"></a>
                </br>
                <?php echo lang('product')?>
            </div>
            <div class="navbar-form navbar-left">
                <a href="<?php echo base_url("/index.php/products/show_entrepots")?>"><img src="<?php echo base_url()?>assets/img/supplier.png" height="30"></a>
                </br>
                仓库
            </div>
            <div class="navbar-form navbar-left">
                <a href="<?php echo base_url('/index.php/contact/contact_main_page')?>"><img src="<?php echo base_url()?>assets/img/contact.png" height="30"></a>
                </br>
                <?php echo lang('contact')?>
            </div>
            <!--
            <div class="navbar-form navbar-left">
                <a href="<?php echo base_url('/index.php/fournisseur/show_fournisseurs')?>"><img src="<?php echo base_url()?>assets/img/supplier.png" height="30"></a>
                </br>
                <?php echo lang('supplier')?>
            </div>
            <div class="navbar-form navbar-left">
                <a href="<?php echo base_url('/index.php/client/show_clients')?>"><img src="<?php echo base_url()?>assets/img/customer.png" height="30"></a>
                </br>
                <?php echo lang('customer')?>
            </div>
            <div class="navbar-form navbar-left">
                <a href="<?php echo base_url('/index.php/contact/show_contacts')?>"><img src="<?php echo base_url()?>assets/img/contact.png" height="30"></a>
                </br>
                <?php echo lang('contact')?>
            </div>-->
            <div class="navbar-form navbar-left">
                <a href="<?php echo base_url('/index.php/commande/commande_main_page')?>"><img src="<?php echo base_url()?>assets/img/commande.png" height="30"></a>
                </br>
                <?php echo lang('commande')?>
            </div>
            <div class="navbar-form navbar-left">
                <a href="<?php echo base_url('/index.php/facture/facture_main_page')?>"><img src="<?php echo base_url()?>assets/img/invoice.png" height="30"></a>
                </br>
                发票
            </div>
            <div class="navbar-form navbar-left">
                &nbsp&nbsp&nbsp<a href="<?php echo base_url('/index.php/bank/show_bank_accounts')?>"><img src="<?php echo base_url()?>assets/img/bank.png" height="30"></a>
                </br>
                现金银行
            </div>
            <div class="navbar-form navbar-left">
                <a href="#"><img src="<?php echo base_url()?>assets/img/expense.png" height="30"></a>
                </br>
                费用
            </div>
            <div class="navbar-form navbar-left">
                &nbsp&nbsp&nbsp<a href="#"><img src="<?php echo base_url()?>assets/img/human_ressource.png" height="30"></a>
                </br>
                人事管理
            </div>
            <div class="navbar-form navbar-left">
                <a href="<?php echo base_url('/index.php/pos/show_pos_status')?>"><img src="<?php echo base_url()?>assets/img/pos.ico" height="30"></a>
                </br>
                POS
            </div>
            <div class="navbar-form navbar-left">
                <a href="<?php echo base_url('/index.php/report/report_main_page')?>"><img src="<?php echo base_url()?>assets/img/report_icon.png" height="30"></a>
                </br>
                报表
            </div>
            <div class="navbar-form navbar-left">
                &nbsp&nbsp&nbsp<a href="#"><img src="<?php echo base_url()?>assets/img/ecommerce_icon.png" height="30"></a>
                </br>
                网络销售
            </div>
            <div class="navbar-form navbar-left">
                <!--<?php if($_SESSION['admin']==1){ //如果是管理员，显示后台
                    echo '<a href="'.base_url('/index.php/Background/show_users').'"<b></b>后台管理</a>';
                }?>-->
                &nbsp&nbsp
                <a href="<?php if($_SESSION['admin']==1){ //如果是管理员，显示后台
                    echo base_url('/index.php/Background/main_page');
                }
                else{
                    echo "#";
                }?>
                ">
                    <img src="<?php echo base_url()?>assets/img/backend.png" height="30"/>
                </a>
                <br>
                后台管理
            </div>
            <div class="navbar-form navbar-left">
                <a href="<?php echo base_url('/index.php/option/personal_option');?>"><img src="<?php echo base_url()?>assets/img/option_icon.png" height="30"></a>
                </br>
                设置
            </div>
            <div class="navbar-form navbar-left">
                <a href="#"><img src="<?php echo base_url()?>assets/img/log.png" height="30"></a>
                </br>
                日志
            </div>

            <div class="navbar-form navbar-left" role="search">
                <!--<a href="<?php echo base_url('/index.php/option/personal_option');?>"><?php echo $_SESSION['username'];?></a>-->
                <a  href="<?php echo base_url('/index.php/login/logout/');?>" class="btn btn-danger"><?php echo lang('logout');?></a>
                <!--<?php if($_SESSION['admin']==1){ //如果是管理员，显示后台
                    echo '<a href="'.base_url('/index.php/Background/show_users').'"<b>#后台</b></a>';
                }?>-->
            </div>
            <!--
            <div class="navbar-form navbar-left">
                <a href="<?php echo base_url('/index.php/Option/lang_chinese?url='.current_url())?>"><img src="<?php echo base_url()?>assets/img/china.svg" height="30"></a>
            </div>
            <div class="navbar-form navbar-left">
                <a href="<?php echo base_url('/index.php/Option/lang_english?url='.current_url())?>"><img src="<?php echo base_url()?>assets/img/gb.png" height="30"></a>
            </div>-->
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <img src="<?php echo base_url()?>assets/img/china.svg" height="30"><span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo base_url('/index.php/Option/lang_chinese?url='.current_url())?>"><img src="<?php echo base_url()?>assets/img/china.svg" height="30"><font size="1">&nbspCN</font></a></li>
                        <li><a href="<?php echo base_url('/index.php/Option/lang_english?url='.current_url())?>"><img src="<?php echo base_url()?>assets/img/us.svg" height="30"><font size="1">&nbspUS</font></a></li>
                        <li><a href="#"><img src="<?php echo base_url()?>assets/img/de.svg" height="30"><font size="1">&nbspDE</font></a></li>
                        <li><a href="#"><img src="<?php echo base_url()?>assets/img/es.svg" height="30"><font size="1">&nbspES</font></a></li>
                        <li><a href="#"><img src="<?php echo base_url()?>assets/img/it.svg" height="30"><font size="1">&nbspIT</font></a></li>
                        <!--<li><a href="#"><img src="<?php echo base_url()?>assets/img/fr.svg" height="30"><font size="1">&nbspFR</font></a></li>
                        <li><a href="#"><img src="<?php echo base_url()?>assets/img/pt.svg" height="30"><font size="1">&nbspPT</font></a></li>-->
                    </ul>
                </li>
            </ul>
        </div>
</nav>
<br>
<br>
<br>