<html>
<nav class="navbar navbar-default navbar-static-top navbar-inverse">
  <div class="container">
      <ul class="nav navbar-nav">
          <li> <!-- class="active"> -->
              <a href="/"><span class="glyphicon glyphicon-home"></span> DASHBOARD</a>
          </li>>

          <li>
              <a href="/profile.php"><span class="glyphicon glyphicon-user"></span> PROFILE</a>
          </li>

          <li>
              <a href="/matches"><span class="glyphicon glyphicon-heart"></span> MATCHES</a>
          </li>

          <li>
              <a href="/search"><span class="glyphicon glyphicon-search"></span> SEARCH</a>
          </li>

          <li>
              <a href="/faq"><span class="glyphicon glyphicon-list"></span> FAQ</a>
          </li>
</html>
            <?php

            session_start();

            var $create =   "<li><a href=\"/create\"><span class=\"glyphicon glyphicon-log-in\"></span> CREATE</a></li>";
            var $login = "<li><a href\"/login\"><span class=\"glyphicon glyphicon-log-in\"></span> LOGIN</a></li>";
            var $logout = "<li><a href=\"/logout.php\"><span class=\"glyphicon glyphicon-log-out\"></span> LOGOUT</a></li>";
                    
            echo( (array_key_exists('id', $_SESSION)) ? "$logout" : "$create" + "$login");

        //   <li>
        //       <a href="/create"><span class="glyphicon glyphicon-log-in"></span> CREATE</a>
        //   </li>
        //   <li>
        //       <a href="/login"><span class="glyphicon glyphicon-log-in"></span> LOGIN</a>
        //   </li>
        //   <li>
        //       <a href="/logout.php"><span class="glyphicon glyphicon-log-out"></span> LOGOUT</a>
        //   </li>
        //   <li>
        //       <a href="/admin.php"><span class="glyphicon glyphicon-log-out"></span>Admin</a>
        //   </li>

            ?>
<html>
      </ul>

  </div>
</nav>
</html>