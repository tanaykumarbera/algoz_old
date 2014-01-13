<?php
    /* Header Section */
    header('Content-Type: text/html;charset=UTF-8');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title><?php echo $HCargs['title'];?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">  
        <link href="b/css/bootstrap.min.css" rel="stylesheet" media="screen">  
        <!--[if lt IE 9]>  
          <script src="b/assets/js/html5shiv.js"></script>  
          <script src="b/assets/js/respond.min.js"></script>  
        <![endif]-->  
        <link href="b/css/cStyl.css" rel="stylesheet" media="screen">
        <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:300' rel='stylesheet' type='text/css'/>
        <?php
            if(!empty($HTargs)) foreach ($HTargs as $arg)   echo $arg."\n";
        ?>
    </head>
    <body>
        <div id="wrapper">
        <?php
        if(isset($HCargs['dispHeader'])&&$HCargs['dispHeader']=='0'){
        }else{
        ?>  
            <header>
                <hgroup>
                    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
                        <div class="navbar-header">
                            <button type="button" id="nav-btn" class="navbar-toggle btn-lg mTop10" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                                <i id="nav-icn" class="glyphicon glyphicon-th white fS1"></i>
                            </button>
                            <a class="navbar-brand" rel="home" href="/" title="Home"><img src="./resources/logo/logo.png"/></a>
                        </div>

                        <div class="collapse navbar-collapse navbar-ex1-collapse pTop10">
                            <?php /*
                            <ul class="nav navbar-nav">
                                <li><a href="./aboutUs.php">Who r we?</a></li>
                                <li><a href="./request.php">Make a request</a></li>
                            </ul>
                            <div class="visible-xs">
                                <p class="alert-warning">Although it seems to work fine, some features might not be available at your device.</p>
                            </div>
                             */?>
                            <div class="col-sm-3 col-md-3 pull-right">
                                <form class="navbar-form" role="search">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Search" name="srch-term" id="srch-term">
                                            <div class="input-group-btn">
                                                <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                                            </div>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </nav>
                </hgroup>
            </header>
            <div class="blnk120"></div>
        <?php
        }
        ?>