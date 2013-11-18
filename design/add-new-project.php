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
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" id="projects">Projects <span class="caret"></span></a>
                    <ul class="dropdown-menu" aria-labelledby="projects">
                        <li><a tabindex="-1" href="./bootstrap.min.css">View Projects</a></li>
                        <li><a tabindex="-1" href="./bootstrap.min.css">Add New Project</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" id="users">Users <span class="caret"></span></a>
                    <ul class="dropdown-menu" aria-labelledby="users">
                        <li><a tabindex="-1" href="./bootstrap.min.css">User List</a></li>
                        <li><a tabindex="-1" href="./bootstrap.min.css">Add New User</a></li>
                    </ul>
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
        <div class="col-xs-12">
            <div style="width:90%;margin: 0px auto 0;">
                <div>
                    <h1 class="text-success">Add New Projects</h1>
                </div>
                <div class="clearfix"></div>
                <div style="margin-top: 20px;">
                    <form class="form-horizontal" role="form" method="post">
                        <div class="form-group">
                            <label for="projectName" class="col-sm-2 control-label">Project Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="projectName" id="projectName" placeholder="Project Name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="workName" class="col-sm-2 control-label">Name Of Work</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="workName" id="workName" placeholder="Name Of Work">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="workOrderAmount" class="col-sm-2 control-label">Work Order Amount</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="workOrderAmount" id="workOrderAmount" placeholder="Work Order Amount">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="date" class="col-sm-2 control-label">Date</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="date" id="date" placeholder="Date">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-success">Save</button>
                                <button type="reset" class="btn btn-danger">Cancel</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <footer>
        <div style="margin-top: 100px;">
            <div class="row">
                <div class="col-xs-12" style="height: 50px;background-color: #222222;padding: 10px;color: #fff;">
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