<?php

    function add($a,$b){
        $c=$a+$b;
        return $c;
    }

    /**
     *
     * 获取图片名称列表
     *
     * @param str $dir 图片路径
     * @return array $photo 图片名称列表
     */
    function get_photo_list($dir)
    {
        if (file_exists($dir)) {
            //获取某目录下所有文件、目录名（不包括子目录下文件、目录名）
            $handler = opendir($dir);
            $files=array();
            while (($filename = readdir($handler))) {//务必使用!==，防止目录下出现类似文件名“0”等情况
                if ($filename != "." && $filename != "..") {
                    $files[] = $filename;
                }
            }
            closedir($handler);
            //去掉不是照片的文件的文件名,得到只有照片名字的文件名 $photo是照片文件名
            $photo=array();
            $i=0;
            if($files!=null) {
                foreach ($files as $un_file) {
                    if ($un_file != "thumbs" && $un_file != ".DS_Store") {
                        $photo[$i] = $un_file;
                        $i = $i + 1;
                    }
                }
            }
            return $photo;
        }
    }
    //显示海报
    function show_poster($rowid){
        $dir="../documents/poster/".$rowid;
        $photos=get_photo_list($dir);
        if($photos!=NULL) {
            //$dir=$dir."/";
            foreach ($photos as $value) {
                echo '<img src="'.base_url().$dir."/".$value.'"></a>';
            }
        }
        else echo"<a href=".base_url('index.php/products/edit_photo/')."><img height=\"100\" src=\"../../../assets/img/nophoto.png\"?></a>";
    }
    //显示带链接的海报
    function show_poster_with_url($rowid,$width=null){
        if($width!=null){
            $width='width="'.$width.'"';
        }
        $dir="../documents/poster/".$rowid;
        $photos=get_photo_list($dir);
        if($photos!=NULL) {
            //$dir=$dir."/";
            foreach ($photos as $value) {
                echo '<a class="image" href="'.base_url().'/index.php/Movie/info_movie/'.$rowid.'"><img src="'.base_url().$dir."/".$value.'" '.$width.' ></a>';
            }
        }
        else echo"<a href=".base_url('index.php/products/edit_photo/')."><img height=\"100\" src=\"../../../assets/img/nophoto.png\"?></a>";
    }
    //压缩图片