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
            <li class="py-1 submenu-item"><a href="{{route(currentUser().'.company.index')}}">{{__('Company Details')}}</a></li>
            <li class="py-1 submenu-item"><a href="{{route(currentUser().'.users.index')}}">{{__('User')}}</a></li>
            <li class="py-1 submenu-item"><a href="{{route(currentUser().'.branch.index')}}">{{__('Branch')}}</a></li>
            <li class="py-1 submenu-item"><a href="{{route(currentUser().'.warehouse.index')}}">{{__('Warehouse')}}</a></li>
            
            <li class="submenu-item sidebar-item has-sub">
                <a href="#" class='sidebar-link'> {{__('Unit')}}</a>
                <ul class="submenu">
                    <li class="py-1 submenu-item"><a href="{{route(currentUser().'.unitstyle.index')}}">{{__('Unit Style')}}</a></li>
                    <li class="py-1 submenu-item"><a href="{{route(currentUser().'.unit.index')}}">{{__('Unit')}}</a></li>
                </ul>
            </li>
		</ul>
        
    </li>



    <li class="sidebar-item has-sub">
        <a href="#" class='sidebar-link'><i class="bi bi-box-fill"></i><span>{{__('Products')}}</span>
        </a>
        <ul class="submenu">
            <li class="py-1 submenu-item"><a href="{{route(currentUser().'.category.index')}}">{{__('Category')}}</a></li>
            <li class="py-1 submenu-item"><a href="{{route(currentUser().'.subcategory.index')}}">{{__('Sub Category')}}</a></li>
            <li class="py-1 submenu-item"><a href="{{route(currentUser().'.childcategory.index')}}">{{__('Child Category')}}</a></li>
            <li class="py-1 submenu-item"><a href="{{route(currentUser().'.brand.index')}}">{{__('Brand')}}</a></li>
            <li class="py-1 submenu-item"><a href="{{route(currentUser().'.product.index')}}">{{__('Products')}}</a></li>
            <li class="py-1 submenu-item"><a href="{{route(currentUser().'.plabel')}}" >{{__('Product Label')}}</a></li>
		</ul>
    </li>

    <li class="sidebar-item has-sub">
        <a href="#" class='sidebar-link'><i class="bi bi-cart-plus-fill"></i><span>{{__('Purchases')}}</span></a>
        <ul class="submenu">
            <li class="py-1 submenu-item"><a href="{{route(currentUser().'.purchase.index')}}">{{__('Purchase')}}</a></li>
		</ul>   
    </li>

    <li class="sidebar-item has-sub">
        <a href="#" class='sidebar-link'><i class="bi bi-cart-fill"></i><span>{{__('Sales')}}</span></a>
        <ul class="submenu">
            <li class="py-1 submenu-item"><a href="{{route(currentUser().'.sales.index')}}">{{__('Sales')}}</a></li>
		</ul>   
    </li>

    
    <li class="sidebar-item has-sub">
        <a href="#" class='sidebar-link'><i class="bi bi-sign-turn-right-fill"></i><span>{{__('Transfer')}}</span></a>
        <ul class="submenu">
            <li class="py-1 submenu-item"><a href="{{route(currentUser().'.transfer.index')}}">{{__('Transfer list')}}</a></li>
            <li class="py-1 submenu-item"><a href="{{route(currentUser().'.transfer.create')}}">{{__('Transfer')}}</a></li>
		</ul>   
    </li>

    <li class="sidebar-item has-sub">
        <a href="#" class='sidebar-link'><i class="bi bi-people-fill"></i><span>{{__('Supplier')}}</span>
        </a>
        <ul class="submenu">
            <li class="py-1 submenu-item"><a href="{{route(currentUser().'.supplier.index')}}">{{__('Supplier')}}</a></li>
		</ul>
    </li>


    <li class="sidebar-item has-sub">
        <a href="#" class='sidebar-link'><i class="bi bi-people-fill"></i><span>{{__('Customer')}}</span>
        </a>
        <ul class="submenu">
            <li class="py-1 submenu-item"><a href="{{route(currentUser().'.customer.index')}}">{{__('Customer')}}</a></li>
		</ul>
    </li>

    <li class="sidebar-item has-sub">
        <a href="#" class='sidebar-link'><i class="bi bi-calculator"></i><span>{{__('Accounts')}}</span>
        </a>
        <ul class="submenu">
            <li class="py-1 submenu-item"><a href="{{route(currentUser().'.master.index')}}" >{{__('Master Head')}}</a></li>
            <li class="py-1 submenu-item"><a href="{{route(currentUser().'.sub_head.index')}}" >{{__('Sub Head')}}</a></li>
            <li class="py-1 submenu-item"><a href="{{route(currentUser().'.child_one.index')}}" >{{__('Child One')}}</a></li>
            <li class="py-1 submenu-item"><a href="{{route(currentUser().'.child_two.index')}}" >{{__('Child Two')}}</a></li>
            <li class="py-1 submenu-item"><a href="{{route(currentUser().'.navigate.index')}}">{{__('Navigate View')}}</a></li>
            <li class="py-1 submenu-item"><a href="{{route(currentUser().'.incomeStatement')}}">{{__('Income Statement')}}</a></li>
            
            <li class="submenu-item sidebar-item has-sub"><a href="#" class='sidebar-link'>{{__('Voucher')}}</a>
                <ul class="submenu">
                    <li class="py-1 submenu-item"><a href="{{route(currentUser().'.credit.index')}}">{{__('Credit Voucher')}}</a></li>
                    <li class="py-1 submenu-item"><a href="{{route(currentUser().'.debit.index')}}">{{__('Debit Voucher')}}</a></li>
                    <li class="py-1 submenu-item"><a href="{{route(currentUser().'.journal.index')}}">{{__('Journal Voucher')}}</a></li>
                </ul>
            </li>
		</ul>
        
    </li>

    <li class="sidebar-item has-sub">
        <a href="#" class='sidebar-link'><i class="bi bi-card-checklist"></i><span>{{__('Report')}}</span>
        </a>
        <ul class="submenu">
            <li class="py-1 submenu-item"><a href="{{route(currentUser().'.preport')}}" >{{__('Purchase Report')}}</a></li>
            <li class="py-1 submenu-item"><a href="{{route(currentUser().'.sreport')}}" >{{__('Stock Report')}}</a></li>
            <li class="py-1 submenu-item"><a href="{{route(currentUser().'.salreport')}}" >{{__('Sales Report')}}</a></li>
		</ul>
        
    </li>
</ul>