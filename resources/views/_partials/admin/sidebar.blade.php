<aside class="app-sidebar">
    <div class="app-sidebar__user">
        {{-- User Photo --}}

        <img class="app-sidebar__user-avatar" src="{{auth()->user()->image? asset('storage/user/photo/'.auth()->user()->image):'https://s3.amazonaws.com/uifaces/faces/twitter/jsa/48.jpg'}}" alt="User Image" width="50px">
        <div>
            {{-- User Name --}}
            <p class="app-sidebar__user-name">{{auth()->user()->name?auth()->user()->name:'John Doe'}}</p>
            {{-- User Admin/User --}}
            <p class="app-sidebar__user-designation">{{getUserRoleName(auth()->user()->id)?getUserRoleName(auth()->user()->id):'Admin'}}</p>
        </div>
    </div>
    <ul class="app-menu">
        @if (Request::is('admin/trash*'))

            @include('_partials.admin.sidebar.trash_sidebar')

        @elseif (Request::is('admin/setting/member-setting*'))

            @include('_partials.admin.sidebar.member_sidebar')

        @else 

            @include('_partials.admin.sidebar.main_sidebar')
            
        @endif
    </ul>
</aside>