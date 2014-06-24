<nav class="navbar navbar-inverse" role="navigation">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            {{ link_to_route('home', 'Home', null, array('class'=>'navbar-brand')) }}
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="{{ isActive('customers', 1) }}">{{ link_to_route('customers.index', 'Customers') }}</li>
                <li class="{{ isActive('suppliers', 1) }}">{{ link_to_route('suppliers.index', 'Suppliers') }}</li>
                <li class="{{ isActive('categories', 1) }}">{{ link_to_route('categories.index', 'Categories') }}</li>
                <li class="{{ isActive('item-requests', 1) }}">{{ link_to_route('item-requests.index', 'Item Requests') }}</li>
                <li class="dropdown {{ isActive('quotations') }}">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Quotations <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li class="{{ isActive('quotations', 1) }}">{{ link_to_route('quotations.index', 'View all') }}</li>
                        <li class="{{ isActive('create', 2) }}">{{ link_to_route('quotations.create', 'Create New') }} </li>
                    </ul>
                </li>
            </ul>

            <ul class="nav navbar-nav navbar-right">
                @if(! Sentry::check())
                <li>{{ HTML::link('/login', 'Login') }}</li>
                @else
                <li class="navbar-text">Welcome, {{ Sentry::getUser()['first_name'] }}.</li>
                <li>{{ HTML::link('/logout', 'Logout') }}</li>
                @endif

            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>