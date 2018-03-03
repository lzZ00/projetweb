<!DOCTYPE HTML>
<html>
<head>
    <title>电影世界</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="<?php echo base_url()?>assets/css/main05.css">

    <!-- jquery -->
    <script src="<?php echo base_url()?>assets/jquery-3.2.0.min.js"></script>
    <!--Material-->
    <link href="<?php echo base_url()?>assets/css/material.min.css" rel="stylesheet">
    <!--<link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.blue-red.min.css" /><!--谷歌的网站国内引用可能会出问题-->
    <script src="<?php echo base_url()?>assets/js/material.min.js"></script>

    <!-- Bootstrap -->
    <link href="<?php echo base_url()?>assets/css/bootstrap01.min.css" rel="stylesheet">
    <!-- select插件--chosen -->
    <link rel="stylesheet" href="<?php echo base_url()?>assets/css/chosen.css">
    <script src="<?php echo base_url()?>assets/js_plug/chosen.jquery.min.js"></script>
    <style>
        .sidebar{
            position: fixed;
            top: 0px;
            /*z-index: 0;*/
            width: 100%;
        }
    </style>
</head>
<!-- Sidebar -->
<!--<div class="col-md-10 col-md-offset-1">-->

<div class=" sidebar">
    <div id="sidebar">
        <div class="inner">

            <!-- Search -->
            <section id="search" class="alt">
                <form method="post" action="#">
                    <input type="text" name="query" id="query" placeholder="番号/类型/明星" />
                </form>
            </section>

            <!-- Menu -->
            <nav id="menu">
                <header class="major">
                    <h2>Menu</h2>
                </header>
                <ul>
                    <li><a href="<?php echo base_url()?>index.php/Main/index"><font size="5">主页</font></a></li>
                    <li><a href="<?php echo base_url()?>index.php/Movie/show_movies"><font size="5">全部视频</font></a></li>
                    <li><a href="generic.html"><font size="5">明星</font></a></li>
                    <li><a href="elements.html"><font size="5">类型</font></a></li>
                </ul>
            </nav>

        </div>
    </div>
</div>
<div class="col-md-10 offset-md-2">