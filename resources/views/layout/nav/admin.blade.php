

<ul class="menu">
    <li class="sidebar-item">
        <a href="{{route(currentUser().'.dashboard')}}" class='sidebar-link'>
            <i class="bi bi-grid-fill"></i>
            <span>{{__('dashboard') }}</span>
        </a>
    </li>
    
    <li class="sidebar-item has-sub">
        <a href="#" class='sidebar-link'>
            <i class="bi bi-gear-fill"></i>
            <span>{{__('Settings')}}</span>
        </a>
        <ul class="submenu">
            <li class="py-1"><a href="{{route(currentUser().'.admincompany')}}">{{__('Company Details')}}</a></li>
            <li class="py-1"><a href="{{route(currentUser().'.currency.index')}}">{{__('Currency')}}</a></li>
            <li class="py-1"><a href="{{route(currentUser().'.admin.index')}}">{{__('User')}}</a></li>
            <li class="py-1"><a href="{{route(currentUser().'.package.index')}}">{{__('Package')}}</a></li>
            <li class="py-1"><a href="{{route(currentUser().'.business.index')}}">{{__('Business Type')}}</a></li>
            
            <li class="submenu-item sidebar-item has-sub">
                <a href="#" class='sidebar-link'> {{__('Location')}}</a>
                <ul class="submenu">
                    <li class="py-1"><a href="{{route(currentUser().'.country.index')}}">{{__('Country')}}</a></li>
                    <li class="py-1"><a href="{{route(currentUser().'.division.index')}}">{{__('Division')}}</a></li>
                    <li class="py-1"><a href="{{route(currentUser().'.district.index')}}">{{__('District')}}</a></li>
                    <li class="py-1"><a href="{{route(currentUser().'.upazila.index')}}">{{__('Upazila')}}</a></li>
                    <li class="py-1"><a href="{{route(currentUser().'.thana.index')}}">{{__('Thana')}}</a></li>
                </ul>
            </li>
            <li class="submenu-item sidebar-item has-sub">
                <a href="#" class='sidebar-link'> {{__('Unit')}}</a>
                <ul class="submenu">
                    <li class="py-1"><a href="{{route(currentUser().'.unitstyle.index')}}">{{__('Unit Style')}}</a></li>
                    <li class="py-1"><a href="{{route(currentUser().'.unit.index')}}">{{__('Unit')}}</a></li>
                </ul>
            </li>
        </ul>
    </li>
</ul>