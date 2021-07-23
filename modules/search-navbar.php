<div class="row" id="box-search">
    <div class="thumbnail text-center">
        <img src="images/party-image.jpeg" alt="" class="img-responsive">
        <div class="caption">
            <h1 style="font-weight:700; font-size: 60px; font-family: impact; color: #3F5EBA">
                <?php
                echo $_POST["ticketInput"];
                ?>
            </h1>
            <p>Search Results</p>
        </div>
    </div>
</div>
</div>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container" style="padding-top: 4px;">
        <a class="navbar-brand" style="font-weight:700;" href="index.php">
            Ticket<span class="blue-text">Link</span>
        </a>
       <form class="form-inline navbar-form mr-auto" role="search">
            <div class="form-search search-only">
                <input type="text" class="form-control search-query">
            </div>
        </form>
    </div>
</nav>
      