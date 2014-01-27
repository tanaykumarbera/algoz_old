<?php
    /* Footer Section */
?>          <div class="blnk120"></div>
            <div id="push"></div>
        </div>
        <?php
        if(isset($FTargs['uT'])&&$FTargs['uT']=='1'){
            include_once './userTab.php';
        }
        if(isset($FTargs['dispFooter'])&&$FTargs['dispFooter']=='0'){
        }else{
        ?>
        <footer>
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <?php if(!empty($FTargs['gid'])){
                        ?>
                        <div class="bdBack">
                            <div id="gBadge" class="mim blockC">
                                <div class="g-person" data-href="https://plus.google.com/<?php echo $FTargs['gid'];?>" data-layout="portrait" data-width="200" data-showcoverphoto="true"></div>
                                <div id="g_rb"></div>
                            </div>
                        </div>
                        <?php
                        }else{
                        ?>
                        <img class="mim blockC" src="<?php echo HOST;?>/resources/img/x.png"/>
                        <?php
                        }
                        ?>
                    </div>
                    <div class="col-md-4 mdFoot">
                        <p><a href="#">Home</a> | <a href="#">Who r we?</a> | <a href="#">Submit algo</a></p>
                        <p>All rights reserved.  © 2014</p>
                        <p>powered by <a href="http://getbootstrap.com">Bootstrap</a></p>
                        <p><a href="http://glyphicons.com">Glyphicon</a> | <a href="http://ace.c9.io/">ace</a> | <a href="http://ckeditor.com/">ckEditor</a></p>
                    </div>
                    <div class="col-md-4">
                        <div id="social">
                            <img src="<?php echo HOST;?>/resources/icons/sc.png"/>
                            <p>Dear, there are folks out there, like you looking for something. Be kind and help us reach them.</p>
                            <p>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    <?php
    }
    ?>

    <script src="<?php echo HOST;?>/b/js/jquery.js"></script>
    <script src="<?php echo HOST;?>/b/js/bootstrap.min.js"></script>
    <?php if(!empty($FTargs)&&$FTargs['aceScript']==1) echo '<script src="http://ajaxorg.github.io/ace-builds/src-noconflict/ace.js" type="text/javascript" charset="utf-8"></script>';?>
    <?php if(!empty($FTargs)&&!empty($FTargs['script'])) echo $FTargs['script']."\n";?>
    <script><?php if(!empty($FTargs)&&!empty($FTargs['fscript'])) echo $FTargs['fscript'];?>$(document).ready(function(){$("#nav-btn").click(function(){$("#nav-icn").toggleClass("glyphicon-th glyphicon-th-large");});<?php if(!empty($FTargs)&&!empty($FTargs['jReady'])) echo $FTargs['jReady']; ?>});</script>
    <?php if(!empty($FTargs)&&!empty($FTargs['lscript'])) echo $FTargs['lscript'];?>
    <?php if(!empty($FTargs['gid'])) echo '<script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script>'; ?>
  </body>  
</html>