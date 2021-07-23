<?php 
    require_once "php-bin/SessionFunctions.php";
    require_once "php-bin/UserFunctions.php";
?>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container" style="padding-top: 4px;">
        <a class="navbar-brand" style="font-weight:700;" href="index.php">
            Ticket<span class="blue-text">Link</span>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link-active nav-link" href="ticket-search.php">Explore<span class="sr-only">(current)</span></a>
                </li>
                    <a class="nav-link" href="about.html">About</a>
                </li>
            </ul>
            <!-- lol
            <form class="form-inline navbar-form mr-auto" role="search">
                <div class="form-search search-only">
                    <input type="text" class="form-control search-query">
                </div>
            </form>
            -->

            <ul class="navbar-nav mr-right">
                <?php 
                $user_logged_in = check_user_logged_in();

                if (!$user_logged_in) {
                echo '<li class="nav-item">
                        <a class="nav-link" data-toggle="modal" data-target="#login-modal">Log In</a>
                    </li>   
                    <li class="nav-item">
                        <a class="nav-link" id="modal-button" data-toggle="modal" data-target="#user-modal" style="color: #0288D1" href="#">Sign Up</a>
                    </li>   
                    <li class="nav-item">
                        <span class="glyphicon glyphicon-search"></span>
                    </li> ';
                } else {
                    $u_d = json_decode(getUserInfo(get_session_user_id()));

                    echo '<li class="nav-item">
                        <a class="nav-link" style="color: #0288D1" href="profile.php">' .
                        $u_d->FirstName . ' ' . $u_d->Surname .'</a>
                    </li>  
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Log Out</a>
                    </li>';
                }
                ?>
            </ul>
            
        </div>
        
    </div>
</nav>

<script>
    $('#user-modal').on('shown.bs.modal', function () {
        $('#modal-button').trigger('focus')
    })
</script>