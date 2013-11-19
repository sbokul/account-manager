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
            <ul class="nav pull-right navbar-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" id="projects">
                        <?php echo $data['user_info']['user_name']; ?>
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="projects">
                        <li><a tabindex="-1" href="#">Profile</a></li>
                        <li><a tabindex="-1" href="/login/logout">Logout</a></li>
                    </ul>
                </li>
            </ul>
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