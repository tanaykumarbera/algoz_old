<?php

require_once './functions.php';

if(!empty($_REQUEST['filter'])) $filter= $_REQUEST['filter'];
else $filter="category";

switch ($filter){
    case "algorithm": $tmp=1;   break;
    case "tag": $tmp=2;   break;
    default : $tmp=3;
}

printHeader(array(
    'title'=> $filter.' | AlgoZ.org'
));
?>
        <section>
            <div class="container">
                <div>
                    <ol class="breadcrumb">
                        <li class="active"><span class="glyphicon glyphicon-home"></span> Home</li>
                    </ol>
                </div>
                <div class="row">
                    <div class="btn-group m10 pull-right" data-toggle="buttons">
                        <label class="btn btn-default <?php if($filter=="algorithm") echo 'active';?>" onclick="ldList(1);"><input type="radio" name="options" id="option1"/><span class="glyphicon glyphicon-fire"></span>&nbsp;Algorithms</label>
                        <label class="btn btn-default <?php if($filter=="tag") echo 'active';?>" onclick="ldList(2);"><input type="radio" name="options" id="option1"/><span class="glyphicon glyphicon-tags"></span>&nbsp;Tags</label>
                        <label class="btn btn-default <?php if($filter=="category") echo 'active';?>" onclick="ldList(3);"><input type="radio" name="options" id="option1"/><span class="glyphicon glyphicon-bookmark"></span>&nbsp;Categories</label>
                    </div>
                </div>
                <div class="blnk50"></div>
                <div class="row">
                    <div class="bR">
                        <div class="panel-group" id="accordion">
                            <div id="waitL" class="wL z5"></div>
                        </div>
                    </div>
                </div>
                <div class="blnk50"></div>
            </div>
        </section>
<?php
printFooter(array(
    'fscript'=> '
         function ldList(a){
            $("#waitL").css("visibility","visible");
            var e, json;
            if(a==1){
                e="filter=algorithm";
                gic="th-list";
            }
            else if(a==2){
                e="filter=tag";
                gic="tag"
            }
            else{
                e="filter=category";
                gic="bookmark";
            }
            var t=$.ajax({url:"'.HOST.'/jHelper.php",type:"POST",data:e,timeout:10000});
            t.done(function(msg){
                if(msg!="error") json=$.parseJSON(msg);
                else alert("Something went wrong.. Try again");
            
                var pG= $("#accordion");
                pG.html("");
                for(i=0; i< json.length; i++){
                    var s=\'<div class="panel pbk">\';
                        s=s+\'<div class="panel-heading">\';
                                s=s+\'<a class="tdN pbH" data-toggle="collapse" data-parent="#accordion" href="#cl\'+i+\'"><span class="glyphicon glyphicon-\'+gic+\'"></span> \'+json[i].Cnam+\'<span class="badge pull-right"><span class="glyphicon glyphicon-fire"></span> \'+json[i].list.length+\'</span></a>\';
                        s=s+\'</div>\';
                        s=s+\'<div id="cl\'+i+\'" class="list-group panel-collapse collapse">\';
                                for(j=0; j< json[i].list.length; j++){
                                    s=s+\'<a class="list-group-item" href="\'+json[i].list[j].aLink+\'" target="_blank">\'+json[i].list[j].aNam+\'</a>\';
                                }
                        s=s+\'</div>\'
                    s=s+\'</div>\';
                pG.append(s);
            }
            pG.append(\'<div id="waitL" class="wL"></div>\');
        });
        t.fail(function(msg){
           alert("Unable to connect. Please retry | Check Internet connection");
           $("#waitL").fadeOut("fast");
        });
    }
    ',
    'jReady'=> 'ldList('.$tmp.');',
    'uT'=>'1'
));

/*
 
<script>
    function ldList(a){
        
        $("#waitL").css("visibility","visible");
        var e, json;
        if(a==1){
            e="filter=algorithm";
            gic="th-list";
        }
        else if(a==2){
            e="filter=tag";
            gic="tag"
        }
        else{
            e="filter=category";
            gic="bookmark";
        }
        var t=$.ajax({url:"jHelper.php",type:"POST",data:e,timeout:10000});
        t.done(function(msg){
            if(msg!="error") json=$.parseJSON(msg);
            else alert("Something went wrong.. Try again");
            
            var pG= $("#accordion");
            pG.html("");
            for(i=0; i< json.length; i++){
                var s='<div class="panel pbk">';
                        s=s+'<div class="panel-heading">';
                                s=s+'<a class="tdN pbH" data-toggle="collapse" data-parent="#accordion" href="#cl'+i+'"><span class="glyphicon glyphicon-'+gic+'"></span> '+json[i].Cnam+'<span class="badge pull-right"><span class="glyphicon glyphicon-fire"></span> '+json[i].list.length+'</span></a>';
                        s=s+'</div>';
                        s=s+'<div id="cl'+i+'" class="list-group panel-collapse collapse">';
                                for(j=0; j< json[i].list.length; j++){
                                    s=s+'<a class="list-group-item" href="'+json[i].list[j].aLink+'" target="_blank">'+json[i].list[j].aNam+'</a>';
                                }
                        s=s+'</div>'
                    s=s+'</div>';
                pG.append(s);
            }
            pG.append('<div id="waitL" class="wL"></div>');
        });
        t.fail(function(msg){
           alert("Unable to connect. Please retry | Check Internet connection");
           $("#waitL").fadeOut("fast");
        });
        
    }
 * 
 * 
 * function ldList(a){
            $("#waitL").css("visibility","visible");
            var e, json;
            if(a==1){
                e="filter=algorithm";
                gic="th-list";
            }
            else if(a==2){
                e="filter=tag";
                gic="tag"
            }
            else{
                e="filter=category";
                gic="bookmark";
            }
            var t=$.ajax({url:"jHelper.php",type:"POST",data:e,timeout:10000});
            t.done(function(msg){
                if(msg!="error") json=$.parseJSON(msg);
                else alert("Something went wrong.. Try again");
            
                var pG= $("#accordion");
                pG.html("");
                for(i=0; i< json.length; i++){
                    var s=\'<div class="panel pbk">\';
                        s=s+\'<div class="panel-heading">\';
                                s=s+\'<a class="tdN pbH" data-toggle="collapse" data-parent="#accordion" href="#cl\'+i+\'"><span class="glyphicon glyphicon-\'+gic+\'"></span> \'+json[i].Cnam+\'<span class="badge pull-right"><span class="glyphicon glyphicon-fire"></span> \'+json[i].list.length+\'</span></a>\';
                        s=s+\'</div>\';
                        s=s+\'<div id="cl\'+i+\'" class="list-group panel-collapse collapse">\';
                                for(j=0; j< json[i].list.length; j++){
                                    s=s+\'<a class="list-group-item" href="\'+json[i].list[j].aLink+\'" target="_blank">\'+json[i].list[j].aNam+\'</a>\';
                                }
                        s=s+\'</div>\'
                    s=s+\'</div>\';
                pG.append(s);
            }
            pG.append(\'<div id="waitL" class="wL"></div>\');
        });
        t.fail(function(msg){
           alert("Unable to connect. Please retry | Check Internet connection");
           $("#waitL").fadeOut("fast");
        });
        
    }
</script>

*/
?>