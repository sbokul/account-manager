<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">



    <!-- Bootstrap core CSS -->
    <link href="/assets/dist/css/bootstrap.css" rel="stylesheet">

    <!-- Custom CSS for the 'Heroic Features' Template -->
    <link href="/assets/css/content.css" rel="stylesheet">
    <script src="/assets/js/jquery-1.7.1.js"></script>
      <script src="/assets/dist/js/bootstrap.js"></script>
	  <script type="text/javascript" src="/assets/js/jquery.validate.js"></script>
    <!--<script src="/assets/js/bootstrap.js"></script>-->
  </head>
  <title>Club Asia :: <?php echo $title; ?></title>
</head>
<body>
    <?php echo $header; ?>
    <div class="container">
        <div class="row menu">
            <div id="big-menu" class="col-xs-3">
                <?php echo $left_menu; ?>
            </div>
            <div id="mobile-view">
                <?php echo $left_menu_mobile; ?>
            </div>
            <div id="main-content" class="col-xs-9">
                <?php echo $content; ?>
            </div>
        </div>
    </div>

    <?php echo $footer; ?>
    <script>
        $(document).ready(function() {
            if(window.innerWidth <= 800 && window.innerHeight <= 600) {
                $("#main-content").attr( 'class','col-xs-12');
            } else {
                $("#main-content").attr( 'class','col-xs-9')
            }
        });
    </script>
</body>
</html>
