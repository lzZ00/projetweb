<?php require_once dirname(__FILE__) . '/../../models/pic_functions.php';?>
<!-- Wrapper -->
<div id="wrapper">
    <!-- Main -->
    <div id="main">
        <div class="inner">
            <!-- Banner -->
            <section id="banner">
                <div class="content">
                    <header>
                        <h1>视察二院</h1>
                        <p>A free and fully responsive site template</p>
                    </header>
                    <p>Aenean ornare velit lacus, ac varius enim ullamcorper eu. Proin aliquam facilisis ante interdum congue. Integer mollis, nisl amet convallis, porttitor magna ullamcorper, amet egestas mauris. Ut magna finibus nisi nec lacinia. Nam maximus erat id euismod egestas. Pellentesque sapien ac quam. Lorem ipsum dolor sit nullam.</p>
                    <a href="#" class="btn btn-lg btn-outline-info">极速下载</a>
                </div>
                <span class="image object">
                    <!--<img src="<?php echo base_url()?>/assets/img/film11.jpg" alt="" />-->
                    <?php show_poster($rowid)?>
                </span>
            </section>
            <!-- Section -->
            <section>
                <header class="major">
                    <h2>相关视频</h2>
                </header>
                <div class="features">
                    <?php foreach ($movies as $value):?>
                        <article>
                            <?php show_poster_with_url($value['rowid'],150)?>
                            &nbsp&nbsp&nbsp&nbsp&nbsp
                            <div class="content">
                                <h3>Portitor ullamcorper</h3>
                                <p>Aenean ornare velit lacus, ac varius enim lorem ullamcorper dolore. Proin aliquam facilisis ante interdum. Sed nulla amet lorem feugiat tempus aliquam.</p>
                            </div>
                        </article>
                    <?php endforeach;?>
                    <!--<article>
                        <img width="150" src="<?php echo base_url()?>/assets/img/film11.jpg" class="rounded">
                        &nbsp&nbsp&nbsp&nbsp&nbsp
                        <div class="content">
                            <h3>Portitor ullamcorper</h3>
                            <p>Aenean ornare velit lacus, ac varius enim lorem ullamcorper dolore. Proin aliquam facilisis ante interdum. Sed nulla amet lorem feugiat tempus aliquam.</p>
                        </div>
                    </article>
                    -->
                </div>
            </section>
        </div>
    </div>
</div>