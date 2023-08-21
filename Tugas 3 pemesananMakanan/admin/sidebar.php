<aside class="d-flex col-2">
    <div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark" style="width: 
100%;">
        <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white textdecoration-none">
            <svg class="bi me-2" width="40" height="32">
                <use xlink:href="#bootstrap"></use>
            </svg>
            <span class="fs-4">ADMIN</span>
        </a>
        <hr>
        <ul class="nav nav-pills flex-column mb-auto">
            <?php
            if ($page == 'dashboard') {
                $dashboard = 'active';
            } else if ($page == 'history') {
                $history = 'active';
            } elseif ($page == 'konsumen') {
                $konsumen = 'active';
            } elseif ($page == 'paket') {
                $paket = 'active';
            }
            ?>
            <li class="nav-item">
                <a href="?page=dashboard" class="nav-link <?= $dashboard ?> text-white">
                    <i class="fas fa-tachometer-alt"></i>
                    <span class="ms-2">Dashboard</span>
                </a>
            </li>
            <li>
                80
                <a href="?page=history" class="nav-link <?= $history ?> text-white">
                    <i class="fas fa-box"></i>
                    <span class="ms-2">History</span>
                </a>
            </li>
            <li>
                <a href="?page=konsumen" class="nav-link <?= $konsumen ?> text-white">
                    <i class="fas fa-user-friends"></i>
                    <span class="ms-2">Konsumen</span>
                </a>
            </li>
            <li>
                <a href="?page=paket" class="nav-link <?= $paket ?> text-white">
                    <i class="fas fa-shopping-cart"></i>
                    <span class="ms-2">Pilihan Paket</span>
                </a>
            </li>
            <li>
                <a href="logout" class="nav-link text-white">
                    <i class="fas fa-sign-out-alt"></i>
                    <span class="ms-2">Log Out</span>
                </a>
            </li>
        </ul>
    </div>
</aside>