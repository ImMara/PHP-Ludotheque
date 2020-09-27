<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand text-danger" href="index.php">LUDOTHEQUE</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="index.php">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-danger" href="404.php">Link Awakening?</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="admin\index.php">Admin</a>
            </li>
        </ul>
        <form class="form-inline my-2 my-lg-0" action="index.php" method="GET">
            <input class="form-control mr-sm-2" type="search"  name="search" id="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-danger my-2 my-sm-0 " type="submit">Search</button>
        </form>
    </div>
</nav>
