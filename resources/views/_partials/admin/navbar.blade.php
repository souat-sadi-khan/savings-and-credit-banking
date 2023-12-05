<header class="app-header">
    <a class="app-header__logo" href="{{ route('home') }}">
        @if(get_option('logo'))
            <img class="w-50" src="{{asset('storage/logo')}}/{{get_option('logo')}}" alt="">
        @else 
            <img src="{{asset('logo.png')}}" alt="Company Logo">
        @endif
    </a>
    <a class="app-sidebar__toggle pt-2" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
    <!-- Navbar Right Menu-->
    <ul class="app-nav">
        {{-- <li class="dropdown"><a class="mt-3 app-nav__item bg-success rounded px-4 py-2" href="#" data-toggle="dropdown" aria-label="Open Profile Menu" aria-expanded="false"> Quick Link </a>
        
            <ul class="dropdown-menu settings-menu dropdown-menu-right mt-2" x-placement="bottom-end" style="position: absolute; transform: translate3d(47px, 47px, 0px); top: 0px; left: 0px; will-change: transform;">
        
                <li><a class="dropdown-item" href="http://decent.test/admin/eCommerce/feature-product"><i class="fa fa-free-code-camp fa-lg"></i> Feature Product</a></li>
        
                <li><a class="dropdown-item" href="http://decent.test/admin/eCommerce/hotsale-product"><i class="fa fa-fire fa-lg"></i> Hot Sale Product</a></li>

                <li><a class="dropdown-item" href="http://decent.test/admin/eCommerce/eCommerce-offer"><i class="fa fa-bullseye fa-lg"></i> eCommerce Offer</a></li>

                <li><a class="dropdown-item" href="http://decent.test/admin/eCommerce/orders/index"><i class="fa fa-first-order fa-lg"></i> Order</a></li>

                <li><a class="dropdown-item" href="http://decent.test/admin/client"><i class="fa fa-user fa-lg"></i> Client</a></li>
        
            </ul>
        
        </li> --}}
        {{-- Search Option --}}
        {{-- <li class="app-search">
            <input class="app-search__input" type="search" placeholder="Search">
            <button class="app-search__button"><i class="fa fa-search"></i></button>
        </li> --}}
        <li class="app-search">
            {{-- <h5  data-toggle="tooltip" data-placement="bottom" title="Software Current Active Timezone: {{date_default_timezone_get()}} " class="text-light pt-2 mr-2">{{date_default_timezone_get()}}</h5> &nbsp;
            <h5  data-toggle="tooltip" data-placement="bottom" title="System Current Date {{carbonDate(date('d-m-Y'))}}." class="text-light pt-2">{{carbonDate(date('d-m-Y'))}}</h5> &nbsp; - &nbsp;
            <h5  data-toggle="tooltip" data-placement="bottom" title="System Current Time {{carbonTime(date('h:i:s A'))}}." class="text-light pt-2">{{carbonTime(date('h:i:s A'))}}</h5> --}}
        </li>
      
        <!-- User Menu-->
        <li class="dropdown"><a class="mt-1  p-0 " href="#" data-toggle="dropdown" aria-label="Open Profile Menu">
<img style="width: 50px;" class="app-sidebar__user-avatar mt-2" src="{{auth()->user()->image? asset('storage/user/photo/'.auth()->user()->image):'https://s3.amazonaws.com/uifaces/faces/twitter/jsa/48.jpg'}}"alt="User Image">

        </a>


            <ul class="dropdown-menu settings-menu dropdown-menu-right mt-2">
                <li><a class="dropdown-item" href="{{ route('admin.profile') }}"><i class="fa fa-user fa-lg"></i> Profile</a></li>
                <li><a class="dropdown-item" href="" id="logout" data-url='{{ route('logout') }}'><i class="fa fa-sign-out fa-lg"></i> Logout</a></li>
            </ul>
        </li>
    </ul>
</header>