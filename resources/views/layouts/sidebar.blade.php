<div class="sidebar-menu">
    <!-- BEGIN SIDEBAR MENU ITEMS-->
    <ul class="menu-items mt-3">

        <li class="navheader" >
            Menu Utama
        </li>
        <li>
            <a href="{{ route('home') }}" class="title">
                <span class="title">Utama</span>
            </a>
            <span class="icon-thumbnail"><i class="pg-icon">home</i></span>
        </li>
        @canany(['Approve Borang Bilik Mesyuarat Lili', 'Approve Borang Bilik Mesyuarat Teratai'])
        <li>
            <a href="{{ route('events.index') }}" class="title">
                <span class="title">Event</span>
            </a>
            <span class="icon-thumbnail"><i class="pg-icon">calendar</i></span>
        </li>
        @endcanany
        <li>
            <a href="{{ route('events.create') }}" class="title">
                <span class="title">Create Event</span>
            </a>
            <span class="icon-thumbnail"><i class="pg-icon">calendar</i></span>
        </li>
        <li class="">
            <a href="#" class="logoutBtn"><span class="title">Log Keluar</span></a>
            <span class="icon-thumbnail"><i class="pg-icon">card</i></span>
        </li>
    </ul>
    <div class="clearfix"></div>
</div>
