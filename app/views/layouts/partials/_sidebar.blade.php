<div class="sidebar-menu">


<header class="logo-env">

    <!-- logo -->
    <div class="logo">
        <a href="/home">
            <img src="{{ URL::asset('images/insight-120.png') }}" width="120" alt="" />
        </a>
    </div>

    <!-- logo collapse icon -->

    <div class="sidebar-collapse">
        <a href="#" class="sidebar-collapse-icon with-animation"><!-- add class "with-animation" if you want sidebar to have animation during expanding/collapsing transition -->
            <i class="entypo-menu"></i>
        </a>
    </div>


    <!-- open/close menu icon (do not remove if you want to enable menu on mobile devices) -->
    <div class="sidebar-mobile-menu visible-xs">
        <a href="#" class="with-animation"><!-- add class "with-animation" to support animation -->
            <i class="entypo-menu"></i>
        </a>
    </div>

</header>


<ul id="main-menu" class="multiple-expanded auto-inherit-active-class">
<!-- add class "multiple-expanded" to allow multiple submenus to open -->
<!-- class "auto-inherit-active-class" will automatically add "active" class for parent elements who are marked already with class "active" -->
<!-- Search Bar -->
<!--<li id="search">-->
<!--    <form method="get" action="">-->
<!--        <input type="text" name="q" class="search-input" placeholder="Search something..."/>-->
<!--        <button type="submit">-->
<!--            <i class="entypo-search"></i>-->
<!--        </button>-->
<!--    </form>-->
<!--</li>-->
<li id="nav-dashboards" class="auto-inherit-active-class">
    <a href="{{ route('dashboard') }}">
        <i class="entypo-gauge"></i>
        <span>Dashboards</span>
    </a>
    <ul>
        <li class="{{ isActive('dashboard', 1) }}">
            <a href="{{ route('dashboard') }}">
                <span>Dashboard</span>
            </a>
        </li>
    </ul>
</li>
<li class="auto-inherit-active-class">
    <a href="{{ route('portal.contracts') }}">
        <i class="entypo-archive"></i>
        <span>Portal Data</span>
    </a>
    <ul>
        <li class="{{ isActive('contracts', 2) }}">
            <a href="{{ route('portal.contracts') }}">
                <span>Contracts</span>
            </a>
        </li>
        <li class="{{ isActive('users', 2) }}">
            <a href="{{ route('portal.users') }}">
                <span>Portal Users</span>
            </a>
        </li>
    </ul>
</li>
<li class="auto-inherit-active-class">
    <a href="{{ route('quotations.index') }}">
        <i class="entypo-archive"></i>
        <span>Products Quotations</span>
    </a>
    <ul>
        <li class="{{ isActive('item-requests', 1) }}">
            <a href="{{ route('item-requests.index') }}">
                <span>Product Requests</span>
            </a>
        </li>
        <li class="{{ isActive('quotations', 1) }}">
            <a href="{{ route('quotations.index') }}">
                <span>Quotations</span>
            </a>
        </li>
        <li class="{{ isActive('categories', 1) }}">
            <a href="{{ route('categories.index') }}">
                <span>Categories</span>
            </a>
        </li>
    </ul>
</li>
<li class="auto-inherit-active-class">
    <a href="{{ route('customers.index') }}">
        <i class="entypo-users"></i>
        <span>Partners</span>
    </a>
    <ul>
        <li class="{{ isActive('customers', 1) }}">
            <a href="{{ route('customers.index') }}">
                <span>Customers</span>
            </a>
        </li>
        <li class="{{ isActive('suppliers', 1) }}">
            <a href="{{ route('suppliers.index') }}">
                <span>Suppliers</span>
            </a>
        </li>
    </ul>
</li>

</ul>

</div>

<script type="text/javascript">
    $(document).ready(function () {
        var menu = document.getElementById('main-menu')
        var elem = menu.getElementsByClassName('active')[0]
        if (elem){
            var parent = elem.parentNode
            if(parent.id !== 'main-menu'){
                parent.parentNode.className += " opened"
            }
        } else {
            document.getElementById('nav-dashboards').className = " active"
        }
    });
</script>