<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<div class="form-group">
                    <div class="input-group">
                        <div class="input-group-btn">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">Select from available categories <span class="caret"></span></button>
                            <ul id="catList" class="dropdown-menu pull-right">
                                <li><a class="disabled">Choose categories</a></li>
                                <li class="divider"></li>
                              <?php
                                  foreach ($catList as $itm)
                                      echo '<li><a href="#" onclick="addCat($(this).html())">'.$itm.'</a></li>';
                              ?>
                              <li><a href="#" onclick="addCat($(this).html())">Action</a></li>
                              <li><a href="#" onclick="addCat($(this).html())">Another action</a></li>
                              <li><a href="#" onclick="addCat($(this).html())">Something else here</a></li>
                              <li><a href="#" onclick="addCat($(this).html())">Separated link</a></li>
                            </ul>
                        </div>
                        <input type="text" id="cat" name="cat" class="form-control" placeholder="or add a new"/>
                        <div class="input-group-btn">
                            <button type="button" class="btn btn-default">&plus;</button>
                        </div>
                    </div>
                </div>
                <div id="selC"class="well">
                    <div class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <span>Divide and conquer</span>
                    </div>
                </div>
                
