<?php
include_once('config.php');
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>MSW Greyhounds</title>

    <!-- Bootstrap -->
    <link href="<?=$folder;?>/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?=$folder;?>/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?=$folder;?>/css/style.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
  
    <div class="desk-logo"></div>
    <header class="container-fluid header-container">
      <div class="row">
      
        <div class="col-xs-8">
          <strong class="head-title pull-left fs-14"><i class="fa fa-chevron-left fs-12"></i> Date</strong>
        </div>
        
        <div class="head-icons col-xs-4">
          <strong class="head-title pull-right fs-14">Peterborough</strong>
        </div>
        
      </div>
    </header>
    
    <div class="main-wrapper container-fluid ">
      <div class="row">
        
        <div class="head-clock-wrapper">
          
          <div id="time-carousel" class="carousel slide" data-ride="carousel">
              <!-- Indicators -->
              <ol class="carousel-indicators">
                <li data-target="#time-carousel" data-slide-to="0" class="active"></li>
                <li data-target="#time-carousel" data-slide-to="1"></li>
                <li data-target="#time-carousel" data-slide-to="2"></li>
              </ol>
              <!-- Wrapper for slides -->
              <div class="row">
                  <div class="col-xs-offset-3 col-xs-6">
                      <div class="carousel-inner">
                          <div class="item active">
                              <div class="carousel-content">
                                <span>5:38</span>
                              </div>
                          </div>
                          <div class="item">
                              <div class="carousel-content">
                                <span>6:18</span>
                              </div>
                          </div>
                          <div class="item">
                              <div class="carousel-content">
                                <span>7:28</span>
                              </div>
                          </div>
                          
                      </div>
                  </div>
              </div>
              <!-- Controls -->
            <a class="left carousel-control" href="#time-carousel" data-slide="prev">
              <span class="fa fa-chevron-left"></span>
            </a>
            <a class="right carousel-control" href="#time-carousel" data-slide="next">
              <span class="fa fa-chevron-right"></span>
            </a>

          </div>
        </div>
        
        <div class="meeting-group dog-cards col-xs-12 no-pad">
        
          <!-- Nav tabs -->
          <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Card</a></li>
            <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Form</a></li>
            <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Stats</a></li>
            <li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab" style="margin-right: 0px;">Tips</a></li>
          </ul>

          <!-- Tab panes -->
          <div class="tab-content">
            <div role="tabpanel" class="tab-pane fade in active" id="home">
            
              <a href="#" data-transition="slide">
                <div class="link-item race-meeting-2 dog-card col-xs-12">
                  <div class="pull-left">
                    <span><i class="dog-icon-28 num-1"></i>Do it Queen</span>
                  </div>
                  <div class="pull-right">
                    <span class="sp-button">SP</span>
                  </div>
                  
                </div>
              </a>
            
              <a href="#" data-transition="slide">
                <div class="link-item race-meeting-2 dog-card col-xs-12">
                  <div class="pull-left">
                    <span><i class="dog-icon-28 num-2"></i>Barbers Son</span>
                  </div>
                  <div class="pull-right">
                    <span class="sp-button">SP</span>
                  </div>
                  
                </div>
              </a>
            
              <a href="#" data-transition="slide">
                <div class="link-item race-meeting-2 dog-card col-xs-12">
                  <div class="pull-left">
                    <span><i class="dog-icon-28 num-3"></i>Matched Perfect</span>
                  </div>
                  <div class="pull-right">
                    <span class="sp-button">SP</span>
                  </div>
                  
                </div>
              </a>
            
              <a href="#" data-transition="slide">
                <div class="link-item race-meeting-2 dog-card col-xs-12">
                  <div class="pull-left">
                    <span><i class="dog-icon-28 num-4"></i>Leevalley Faye</span>
                  </div>
                  <div class="pull-right">
                    <span class="sp-button">SP</span>
                  </div>
                  
                </div>
              </a>
            
              <a href="#" data-transition="slide">
                <div class="link-item race-meeting-2 dog-card col-xs-12">
                  <div class="pull-left">
                    <span><i class="dog-icon-28 num-5"></i>Tractor Jimmy</span>
                  </div>
                  <div class="pull-right">
                    <span class="sp-button">SP</span>
                  </div>
                  
                </div>
              </a>
            
              <a href="#" data-transition="slide">
                <div class="link-item race-meeting-2 dog-card col-xs-12">
                  <div class="pull-left">
                    <span><i class="dog-icon-28 num-6"></i>Rocco Flyer</span>
                  </div>
                  <div class="pull-right">
                    <span class="sp-button">SP</span>
                  </div>
                  
                </div>
              </a>
              
            </div>
            
            
            <div role="tabpanel" class="tab-pane fade" id="profile">..22222.</div>
            <div role="tabpanel" class="tab-pane fade" id="messages">.333333..</div>
            <div role="tabpanel" class="tab-pane fade" id="settings">.44444..</div>
          </div>
          
        </div>
        
      </div>
      
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?=$folder;?>/js/bootstrap.min.js"></script>
    
    <script>
    $('.carousel').carousel({
      interval: false
    }); 
    
    $('#myTabs a').click(function (e) {
      e.preventDefault()
      $(this).tab('show')
    })  
    </script>
  </body>
</html>