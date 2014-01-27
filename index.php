<?php
    /* Header Section */
    header('Content-Type: text/html;charset=UTF-8');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Home | AlgoZ.org</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">  
        <link href="b/css/bootstrap.min.css" rel="stylesheet" media="screen">  
        <!--[if lt IE 9]>  
          <script src="b/assets/js/html5shiv.js"></script>  
          <script src="b/assets/js/respond.min.js"></script>  
        <![endif]-->  
        <link href="b/css/cStyl.css" rel="stylesheet" media="screen">
        <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:300' rel='stylesheet' type='text/css'/>
    </head>
    <body>
        <div id="wrapper">
            <div class="jumbotron z0">
                <div class="blnk50"></div>
                <img src="./resources/img/algoz.png" class="img-responsive blockC z5" alt="AlgoZ.org | pseudo code | c | java | python" height="139" width="500"/>
                <div class="hSrch blockC z5">
                    <form class="form-group" role="search">
                        <div class="input-group input-group-lg">
                            <input type="text" class="form-control" placeholder="Search" name="srch-term" id="srch-term">
                                <div class="input-group-btn">
                                    <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                                </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="txtC">
                <a class="tdN" href="./algo"><span class="glyphicon glyphicon-sort-by-alphabet"></span> Browse by name</a>&nbsp;&nbsp;
                <a class="tdN" href="./tag"><span class="glyphicon glyphicon-tags"></span> Browse by tags</a>&nbsp;&nbsp;
                <a class="tdN" href="./category"><span class="glyphicon glyphicon-bookmark"></span> Browse by categories</a>&nbsp;&nbsp;
            </div>
            <div class="blnk50"></div>
            <div class="container">
                <div id="heading" >
                    <h1 class="tsan">pseudo code - c - java - python</h1>
                </div>
                <div class="row">
                    <div class="tsan txtC">
                        <p>Searching for an algorithm? We might help. Give our search a try.</p>
                        <p>This site is <strong>purely based</strong> on pseudo codes and their <strong>ready to run</strong> implementation in c, java and python.</p>
                        <p>You are good at algo? Be nice to share some snippets with us.</p>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <?php include './userTab.php';?>
        </div>
    </body>
</html>