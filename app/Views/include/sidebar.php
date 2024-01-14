<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon">
            <i class="fas fa-graduation-cap"></i>
        </div>
        <div class="sidebar-brand-text mx-3">HALODOS</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <?php
    $arraymenu = getListMenu();
    foreach ($arraymenu as $am) { ?>
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url($am['menulink']) ?>">
                <i class="<?= $am['menuicon'] ?>"></i>
                <span><?= $am['menuname'] ?></span></a>
        </li>
    <?php }
    ?>
    <!-- Divider -->

    <!-- Nav Item - Pages Collapse Menu -->

    <!-- Nav Item - Utilities Collapse Menu -->

    <!-- Divider -->

    <!-- Heading -->

    <!-- Nav Item - Pages Collapse Menu -->

    <!-- Nav Item - Charts -->
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">