<?php require_once dirname(__FILE__) . '/../../models/pic_functions.php';?>
<!-- Wrapper -->
    <div id="wrapper">
        <!-- Main -->
        <div id="main">
            <div class="inner">
                <!-- Section -->
                <!--
                <section>
                    <header class="major">
                        <h2>最近更新</h2>
                    </header>
                    <div class="features">
                        <article>
                            <span class="icon fa-diamond"></span>
                            <div class="content">
                                <h3>Portitor ullamcorper</h3>
                                <p>Aenean ornare velit lacus, ac varius enim lorem ullamcorper dolore. Proin aliquam facilisis ante interdum. Sed nulla amet lorem feugiat tempus aliquam.</p>
                            </div>
                        </article>
                        <article>
                            <span class="icon fa-paper-plane"></span>
                            <div class="content">
                                <h3>Sapien veroeros</h3>
                                <p>Aenean ornare velit lacus, ac varius enim lorem ullamcorper dolore. Proin aliquam facilisis ante interdum. Sed nulla amet lorem feugiat tempus aliquam.</p>
                            </div>
                        </article>
                        <article>
                            <span class="icon fa-rocket"></span>
                            <div class="content">
                                <h3>Quam lorem ipsum</h3>
                                <p>Aenean ornare velit lacus, ac varius enim lorem ullamcorper dolore. Proin aliquam facilisis ante interdum. Sed nulla amet lorem feugiat tempus aliquam.</p>
                            </div>
                        </article>
                        <article>
                            <span class="icon fa-signal"></span>
                            <div class="content">
                                <h3>Sed magna finibus</h3>
                                <p>Aenean ornare velit lacus, ac varius enim lorem ullamcorper dolore. Proin aliquam facilisis ante interdum. Sed nulla amet lorem feugiat tempus aliquam.</p>
                            </div>
                        </article>
                    </div>
                </section>
                -->
                <!-- Section -->
                <section>
                    <header class="major">
                        <h2>最新视频</h2>
                    </header>
                    <div class="posts">
                    <?php foreach ($movies as $un_movie):?>
                        <article>
                            <?php show_poster_with_url($un_movie['rowid'])?>
                            <h3><?php echo $un_movie['title']?></h3>
                            <p><?php echo $un_movie['description']?></p>
                            <ul class="actions">
                                <li><a href="#" class="btn btn-lg btn-outline-info">极速下载</a></li>
                            </ul>
                        </article>
                    <? endforeach; ?>
                    </div>
                </section>
                <?php echo $this->pagination->create_links(); ?>
            </div>
        </div>
    </div>