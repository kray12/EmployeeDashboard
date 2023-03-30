<style>
#navID {
    display: flex;
    justify-content: space-between;

    font-size: 20px;

}

.sessImg {
    position: absolute;
    top: 10%;
    left: 3%;
}

#navbarNavDropdown {
    display: flex;
    justify-content: end;
}
</style>
<nav class="navbar navbar-expand-lg navbar-light bg-light" id="navID">
    <a class="navbar-brand" href="dashboard.php"><img src="https://kandid.in/public/assets/img/logo/logo2.png"
            alt="karan"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
        aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="#"> Welcome <?=$_SESSION['username'];?>!!!</a>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <img id="empImgggg" height="50" width="50" src="images/<?=$_SESSION['empImges']?>">
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="addEmployee.php?id=<?=$_SESSION['empID']?>">Edit Profile</a>
                    <a class="dropdown-item" href="logout.php">logout</a>

                </div>
            </li>
        </ul>
    </div>
</nav>