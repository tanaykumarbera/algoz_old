<?php
    /* Footer Section */
?>          <div id="blnk"></div>
            <div id="push"></div>
        </div>
        <footer>
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <img class="mim" src="./resources/img/x.png"/>
                    </div>
                    <div class="col-md-4 mdFoot">
                        <p><a href="#">Home</a> | <a href="#">Who r we?</a> | <a href="#">Submit algo</a></p>
                        <p>All rights reserved.  © 2014</p>
                        <p>powered by <a href="http://getbootstrap.com">Bootstrap</a></p>
                        <p><a href="http://glyphicons.com">Glyphicon</a> | <a href="http://ace.c9.io/">ace</a> | <a href="http://ckeditor.com/">ckEditor</a></p>
                    </div>
                    <div class="col-md-4">
                        <div id="social">
                            <img src="./resources/icons/sc.png"/>
                            <p>Dear, there are folks out there, like you looking for something. Be kind and help us reach them.</p>
                            <p>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    <script src="b/js/jquery.js"></script>  
    <script src="b/js/bootstrap.min.js"></script>
    <?php
    if(!empty($FTargs)) foreach ($FTargs as $arg)   echo $arg."\n";
    ?>
    <script>
        $(document).ready( function (){
            $("#nav-btn").click(function (){
                $("#nav-icn").toggleClass("glyphicon-th glyphicon-th-large");
            });
        });
    </script>
  </body>  
</html>