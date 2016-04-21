<?php
date_default_timezone_set("Europe/London");

require('_inc/function.php');
include_once('config.php');

$page = $_GET['page'];
$search = $_GET['search_text'];

$_dateParam = date("Y-m-d");
$_current_time = date("H:i:s");

$_next_race = json_decode(get_next_race($_dateParam, $_current_time));

$limit = 30;
$start = $page - 1;
$offset = $start * $limit;

$data = search_dog($limit, $offset, $search);

// define next page url
$next_page = $page + 1;
$next_page_url = $folder ."/search-result/". $next_page ."/". $search;

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
    <link href="<?=$folder;?>//css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="<?=$folder;?>/css/reset.css"> <!-- CSS reset -->
    
    <link rel="stylesheet" href="<?=$folder;?>/css/style-anim.css"> <!-- Resource style -->
    
    <script src="<?=$folder;?>/js/modernizr.js"></script> <!-- Modernizr -->
    
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


    <main>

      <div class="cd-main-content cd-search-result">

    <div class="desk-logo"></div>
    <header class="container-fluid header-container head-orange">
      <div class="row">
      
      <!--
        <div class="col-xs-8">
          <strong class="head-title pull-left fs-14">Date</strong>
        </div>  
       -->  
        <div class="col-xs-4">

          <a href="<?php echo $folder; ?>/" data-type="page-transition">
              
                <strong class="head-title pull-left fs-14"><i class="fa fa-chevron-left fs-12"></i> BACK </strong>    
          </a>

          
        </div>
     
      </div>
    </header>
    
    <div class="main-wrapper container-fluid ">
      <div class="row">
      
        <div class="search-cont col-xs-12 bg-1a1 pad-8">
          <div class="search-box input-group">
            
            <?php
              if (empty($search))
                $placeholder = "Dog Search...";
              else
                $placeholder = $search;
            ?>
            <input type="text" class="form-control" id="dog-search-text" placeholder="<?php echo $placeholder; ?>">
            <span class="input-group-btn">
              <button class="btn btn-default" type="button" id="dog-search-button"><i class="fa fa-search"></i></button>
            </span>
          </div>
          <div class="search-pagination col-xs-12 bg-1a1 no-pad">
            <ul class="pager">

              <?php
                $previous_page = $page - 1;

                $previous_disabled = "disabled";
                $previous_start_url = "";
                $previous_end_url = "";

                if ($previous_page >= 1)
                { 
                  $previous_disabled = "";
                  $previous_start_url = '<a href="'. $folder .'/search-result/'.$previous_page.'/'.$search .'" data-type="page-transition">';
                  $previous_end_url = '<i class="fa fa-angle-left"></i> Previous </a>';
                }
              ?>
              <li class="previous <?php echo $previous_disabled; ?>"> <?php echo $previous_start_url; ?> <?php echo $previous_end_url; ?> </li>
              
              <?php
                $end_range = $data['offset'] + $limit;
                $start_range = $data['offset'] + 1;


                if ($page == $data['pages']) $end_range = $data['total_rows'];
              ?>

              <?php
              if ($data['total_rows'] < 1)
              {
              ?>

                <li class="page-show"> No results found <?php echo $data['total_rows']; ?></li>

              <?php
              } 
              else
              {
              ?>

                <li class="page-show"> Showing results <?php echo $start_range; ?>-<?php echo $end_range; ?> of <?php echo $data['total_rows']; ?> </li>
              
              <?php
              }
              ?>

              <?php
                $next_page = $page + 1;

                $next_disabled = "disabled";
                $next_start_url = "";
                $next_end_url = "";

                if ($data['pages'] >= $next_page)
                {
                  $next_disabled = "";
                  $next_start_url = '<a href="'. $folder .'/search-result/'.$next_page.'/'.$search .'" data-type="page-transition">';
                  $next_end_url = ' Next <i class="fa fa-angle-right"></i> </a>';
                }
              ?>
              <li class="next <?php echo $next_disabled; ?>"><?php echo $next_start_url; ?> <?php echo $next_end_url; ?></li>
            </ul>
          </div>
        </div>
        

        <div class="search-result col-xs-12 no-pad">
          

          <?php
          if (count($data['rows']) >= 1) {
           
            $j = 1;
            foreach ($data['rows'] as $i) {
          ?>

            <a href="<?php echo $folder; ?>/dog-career/<?php echo $i['dog_uid']; ?>/<?php echo $page?>/<?php echo $search; ?>" data-type="page-transition">
              <div class="link-item">
                <div class="pull-left">
                 <?php //echo $j; 

                 $whelp_year = substr($i['properties']->whelp, -4);
                 ?> <strong><?php echo $i['dog_name'] . "&nbsp; &dash; &nbsp;" . $whelp_year; ?></strong>
                </div>
                <i class="fa fa-chevron-right pull-right fs-14"></i>
              </div>
            </a>

          <?php
            $j++;
            }
          
          }
          ?>


         
          
        </div>
        
      </div>
    </div>
        
        <footer class="container-fluid footer-container">

          <div class="row">

            <div class="col-xs-4">

              <a href="<?php echo $folder; ?>/" data-type="page-transition"><span class="foot-icon-cards"></span>Cards</a>

            </div>

            <div class="col-xs-4">
            
              <a href="#myModal" data-toggle="modal" data-target="#myModal"><span class="foot-icon-results"></span>Results</a>
              
            </div>

            <div class="col-xs-4">
            
              <a href="<?=$folder;?>/card/<?=$_next_race->race_group;?>/<?=$_next_race->race_uid;?>/<?=$_dateParam;?>" data-type="page-transition"><span class="foot-icon-next"></span>Next Race</a>
              
            </div>

          </div>
          
        </footer>
          
        <!-- Modal -->
        <div id="myModal" class="modal fade" role="dialog">
              
          <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
            
              <div class="modal-header">
              
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              
              <h4 class="modal-title"></h4>
              
              </div>
              
              <div class="modal-body">
              
                <div id="datetimepicker12">
                
                  <input type="text" style="display:none;" id="selectedDate"></input>
                  
                </div>
                
              </div>
              
              <div class="modal-footer">
              
                <a class="btn btn-default glyphicon glyphicon-ok" data-dismiss="modal" href="<?php echo $folder; ?>/result/" data-type="page-transition" id="selectDate"></a>
                
              </div>
              
            </div>

          </div>
          
        </div>

      </div>

    </main>


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?=$folder;?>/js/bootstrap.min.js"></script>

    <script src="<?=$folder;?>/js/moment.js"></script>
    
    <script src="<?=$folder;?>/js/bootstrap-datetimepicker.js"></script>
    
    <script src="<?=$folder;?>/js/main.js"></script> <!-- Resource jQuery -->
    <script type="text/javascript">

      function testcall()
      {

        alert('dfd');
      }


      $(function () {

        $("#dog-search-text").keyup(function(e){     
            var str = $.trim( $(this).val() );
            if( str != "" ) {
              var regx = /^[A-Za-z]+$/;
              if (!regx.test(str)) {
                alert('Dog Name consist of letters only');
              }
            }
            else {
               //empty value -- do something here
            }
        });



        $( "#dog-search-button" ).click(function() {
          //alert( $("#dog-search-text").val() );
          window.location.href = "<?php echo $folder; ?>/search-result/1/" + $("#dog-search-text").val();
        });
      });
    </script>
  </body>
</html>