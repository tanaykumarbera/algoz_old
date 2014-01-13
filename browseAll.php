<?php
if(!empty($_REQUEST['filter'])) $filter= $_REQUEST['filter'];
else $filter="category";


require_once './functions.php';

printHeader(array(
    'title'=> $filter.' | AlgoZ.org'
));
?>
        <section>
            <div class="container">
                <div class="row">
                    <div class="btn-group m10 pull-right" data-toggle="buttons">
                        <label class="btn btn-default <?php if($filter=="algorithm") echo 'active';?>"><input type="radio" name="options" id="option1"/><span class="glyphicon glyphicon-fire"></span>&nbsp;Algorithms</label>
                        <label class="btn btn-default <?php if($filter=="tag") echo 'active';?>"><input type="radio" name="options" id="option1"/><span class="glyphicon glyphicon-tags"></span>&nbsp;Tags</label>
                        <label class="btn btn-default <?php if($filter=="category") echo 'active';?>"><input type="radio" name="options" id="option1"/><span class="glyphicon glyphicon-bookmark"></span>&nbsp;Categories</label>
                    </div>
                </div>
                
                <div class="panel-group" id="accordion">
                    <div class="panel panel-default">
                      <div class="panel-heading">
                        <h4 class="panel-title">
                            <a class="tdN" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                            Collapsible Group Item #1
                          </a>
                        </h4>
                      </div>
                      <div id="collapseOne" class="list-group panel-collapse collapse in pull-right">
                          <a class="list-group-item">Hellow there jnkdf</a>
                          <a class="list-group-item">Hellow there jnkdf</a>
                          <a class="list-group-item">Hellow there jnkdf</a>
                          <a class="list-group-item">Hellow there jnkdf</a>
                      </div>
                    </div>
                    
                    <div class="panel panel-info">
                      <div class="panel-heading">
                        <h4 class="panel-title">
                            <a class="tdN" data-toggle="collapse" data-parent="#accordion" href="#collapseOe">
                            Collapsible Group Item #1
                          </a>
                        </h4>
                      </div>
                      <div id="collapseOe" class="list-group panel-collapse collapse">
                          <a class="list-group-item ">Divide AndConquououor (Recursive wala approach se)</a>
                          <a class="list-group-item">Hellow there jnkdf</a>
                          <a class="list-group-item">Hellow there jnkdf</a>
                          <a class="list-group-item">Hellow there jnkdf</a>
                      </div>
                    </div>
                    
                    <div class="panel panel-success">
                      <div class="panel-heading">
                        <h4 class="panel-title">
                            <a class="tdN" data-toggle="collapse" data-parent="#accordion" href="#collapsene">
                            Collapsible Group Item #1
                          </a>
                        </h4>
                      </div>
                      <div id="collapsene" class="list-group panel-collapse collapse">
                          <a class="list-group-item">Hellow there jnkdf</a>
                          <a class="list-group-item">Hellow there jnkdf</a>
                          <a class="list-group-item">Hellow there jnkdf</a>
                          <a class="list-group-item">Hellow there jnkdf</a>
                      </div>
                    </div>
                    
                    <div class="panel panel-danger">
                      <div class="panel-heading">
                        <h4 class="panel-title">
                            <a class="tdN" data-toggle="collapse" data-parent="#accordion" href="#collaseOne">
                            Collapsible Group Item #1
                          </a>
                        </h4>
                      </div>
                      <div id="collaseOne" class="list-group panel-collapse collapse in">
                          <a class="list-group-item">Hellow there jnkdf</a>
                          <a class="list-group-item">Hellow there jnkdf</a>
                          <a class="list-group-item">Hellow there jnkdf</a>
                          <a class="list-group-item">Hellow there jnkdf</a>
                      </div>
                    </div>
                    
                    <div class="panel panel-primary">
                      <div class="panel-heading">
                        <h4 class="panel-title">
                            <a class="tdN" data-toggle="collapse" data-parent="#accordion" href="#colapseOne">
                            Collapsible Group Item #1
                          </a>
                        </h4>
                      </div>
                      <div id="colapseOne" class="list-group panel-collapse collapse in">
                          <a class="list-group-item">Hellow there jnkdf</a>
                          <a class="list-group-item">Hellow there jnkdf</a>
                          <a class="list-group-item">Hellow there jnkdf</a>
                          <a class="list-group-item">Hellow there jnkdf</a>
                      </div>
                    </div>
                </div>
                
            </div>
        </section>
<script>
    function ldList(json){
        var pG= $("#accordion");
        pG.html("");
        for(i=0; i< json.length; i++){
            var s='<div class="panel panel-info">';
                    s=s+'<div class="panel-heading">';
                            s=s+'<a class="tdN" data-toggle="collapse" data-parent="#accordion" href="#cl'+i+'">'+json[i].Cnam+'</a>';
                    s=s+'</div>';
                    s=s+'<div id="cl'+i+'" class="list-group panel-collapse collapse">';
                            for(j=0; j< json[i].list.length; j++){
                                s=s+'<a class="list-group-item" href="'+json[i].list[j].aLink+'">'+json[i].list[j].aNam+'</a>';
                            }
                    s=s+'</div>'
                s=s+'</div>';
            pG.append(s);
        }
    }
</script>
<?php
printFooter();
?>