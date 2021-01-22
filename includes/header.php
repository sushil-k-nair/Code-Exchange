<nav class="navbar navbar-expand-lg navbar-dark bg-dark navbar-collapse navbar-expand{-sm|-md|-lg|-xl|-xxl}">
    <div class="container-fluid">
        <a class="navbar-brand" href="timeline.php">Code Exchange</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active fs-6" aria-current="page" href="profile.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active fs-6" href="timeline.php">Timeline</a>
                </li>
                <!-- popup -->
                <div class="popups">
                    <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">Post</button>

                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">POST</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="post">
                                        <div class="mb-3">
                                            <label for="recipient-name" class="col-form-label">Title:</label>
                                            <textarea type="text" class="form-control" rows="1" id="recipient-name" name="post_title" placeholder="Write you Title?"></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="message-text" class="col-form-label">description : </label>
                                            <textarea class="form-control" rows="6" id="message-text" name="post_description" placeholder="Description?"></textarea>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" value="Post" class="btn btn-primary">Post</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--  End popup -->
            </ul>

            <!--  Search -->
            <form class="d-flex" style="margin-right: 5px; " method="get" action="search.php">
                <input class="form-control me-2" name="find" type="text" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-primary" type="submit">Search</button>
            </form>
            <!--  Search -->
            <!--  Dropdown Menu -->
            <div class="dropdown" style="margin-top: 5px;">
                <button class="btn btn-secondary dropdown-toggle btn-sm" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                    More
                </button>
                <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenuButton2">
                    <li><a class="dropdown-item" href="profile.php">Profile</a></li>
                    <li><a class="dropdown-item" href="code.php">Code</a></li>
                    <li><a class="dropdown-item" href="#">Setting</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                </ul>
            </div>
            <!--  Dropdown Menu -->

        </div>
    </div>
</nav>