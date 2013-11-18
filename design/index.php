<!DOCTYPE html>
<html lang="en">
<head>
    <title>Account Manager</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
</head>
<body>
<!-- Nav Bar -->
<div class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <a href="../" class="navbar-brand">Account Manager</a>
            <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div class="navbar-collapse collapse" id="navbar-main">
            <ul class="nav navbar-nav">
                <li>
                    <a href="#">Home</a>
                </li>
                <!--<li>
                    <a href="../help/">Help</a>
                </li>
                <li>
                    <a href="http://news.bootswatch.com">Blog</a>
                </li>-->
                <!--<li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" id="download">Download <span class="caret"></span></a>
                    <ul class="dropdown-menu" aria-labelledby="download">
                        <li><a tabindex="-1" href="./bootstrap.min.css">bootstrap.min.css</a></li>
                        <li><a tabindex="-1" href="./bootstrap.css">bootstrap.css</a></li>
                        <li class="divider"></li>
                        <li><a tabindex="-1" href="./variables.less">variables.less</a></li>
                        <li><a tabindex="-1" href="./bootswatch.less">bootswatch.less</a></li>
                    </ul>
                </li>-->
            </ul>
        </div>
    </div>
</div>


<div class="container">
    <div class="page-header"></div>
    <div class="row" style="margin-top: 20px;">
        <div class="col-lg-3 col-sm-2"></div>
        <div class="col-lg-6 col-sm-4">
            <div style="width:60%;margin: 70px auto 0;">
                <form role="form" action="dashboard.php">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                    </div>
                    <button type="submit" class="btn btn-default">Login</button>
                </form>
            </div>
        </div>
        <div class="col-lg-3 col-sm-2"></div>
    </div>

    <footer>
        <div style="margin-top: 100px;">
            <div class="row">
                <div class="col-lg-12" style="height: 50px;background-color: #000;padding: 10px;color: #fff;">
                    Copyright 2014
                </div>
            </div>
        </div>
    </footer>
</div>
<script src="assets/js/jquery-1.7.1.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
</body>
</html>