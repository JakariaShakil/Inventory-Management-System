@php
$prefix = Request::route()->getPrefix();
$route = Route::current()->getName();
@endphp
<div class="br-logo"><a href=""><span>[</span>bracket <i>plus</i><span>]</span></a></div>
<div class="br-sideleft sideleft-scrollbar">
    <label class="sidebar-label pd-x-10 mg-t-20 op-3">Navigation</label>
    <ul class="br-sideleft-menu">
        <li class="br-menu-item">
            <a href="{{ route('home') }}" class="br-menu-link active">
                <i class="menu-item-icon icon ion-ios-home-outline tx-24"></i>
                <span class="menu-item-label">Dashboard</span>
            </a><!-- br-menu-link -->
        </li><!-- br-menu-item -->
        <label class="sidebar-label pd-x-10 mg-t-25 mg-b-20 tx-info">Inventory Functionality</label>
        

        <li class="br-menu-item ">
            <a href="#" class="br-menu-link with-sub treeview {{ ($prefix == '/users')?'show-sub':'' }}">
                <i class="fas fa-user"></i>
                <span class="menu-item-label">Manage User</span>
            </a><!-- br-menu-link -->
            <ul class="br-menu-sub" >
                <li class="sub-item " ><a href="{{ route('users.view') }}" class="sub-link {{ Route::currentRouteNamed('users.view') ? 'active' : '' }}">All User</a></li>
                <li class="sub-item" ><a href="{{ route('users.add') }}" class="sub-link {{ Route::currentRouteNamed('users.add') ? 'active' : '' }}">Add User</a></li>
            </ul>

           
        </li>

        <li class="br-menu-item">
            <a href="#" class="br-menu-link with-sub treeview {{ ($prefix == '/suppliers')?'show-sub':'' }}">

                <i class="fas fa-truck"></i>
                <span class="menu-item-label">Manage Supplier</span>
            </a><!-- br-menu-link -->
            <ul class="br-menu-sub">
                <li class="sub-item"><a href="{{ route('suppliers.view') }}" class="sub-link {{ Route::currentRouteNamed('suppliers.view') ? 'active' : '' }}">All Supplier</a></li>
                <li class="sub-item"><a href="{{ route('suppliers.add') }}" class="sub-link {{ Route::currentRouteNamed('suppliers.add') ? 'active' : '' }}">Add Supplier</a></li>

            </ul>
        </li>

        <li class="br-menu-item">
            <a href="#" class="br-menu-link with-sub {{ ($prefix == '/customers')?'show-sub':'' }}">

                <i class="fa fa-users"></i>
                <span class="menu-item-label">Manage Customer</span>
            </a><!-- br-menu-link -->
            <ul class="br-menu-sub">
                <li class="sub-item"><a href="{{ route('customers.view') }}" class="sub-link {{ Route::currentRouteNamed('customers.view') ? 'active' : '' }}">All Customer</a></li>
                <li class="sub-item"><a href="{{ route('customers.add') }}" class="sub-link {{ Route::currentRouteNamed('customers.add') ? 'active' : '' }}">Add Customer</a></li>

            </ul>
        </li>

        <li class="br-menu-item">
          <a href="#" class="br-menu-link with-sub {{ ($prefix == '/units')?'show-sub':'' }}">
              <i class="fa fa-balance-scale"></i>
              <span class="menu-item-label">Manage Unit</span>
          </a><!-- br-menu-link -->
          <ul class="br-menu-sub">
              <li class="sub-item"><a href="{{ route('units.view') }}" class="sub-link {{ Route::currentRouteNamed('units.view') ? 'active' : '' }}">All Unit</a></li>
              <li class="sub-item"><a href="{{ route('units.add') }}" class="sub-link {{ Route::currentRouteNamed('units.add') ? 'active' : '' }}">Add Unit</a></li>
          </ul>
      </li>

        <li class="br-menu-item">
            <a href="#" class="br-menu-link with-sub {{ ($prefix == '/categories')?'show-sub':'' }}">
                <i class="fas fa-list"></i>
                <span class="menu-item-label">Manage Category</span>
            </a><!-- br-menu-link -->
            <ul class="br-menu-sub">
                <li class="sub-item"><a href="{{ route('categories.view') }}" class="sub-link {{ Route::currentRouteNamed('categories.view') ? 'active' : '' }}">All Category</a></li>
                <li class="sub-item"><a href="{{ route('categories.add') }}" class="sub-link {{ Route::currentRouteNamed('categories.add') ? 'active' : '' }}">Add Category</a></li>


            </ul>
        </li>
        <li class="br-menu-item">
            <a href="#" class="br-menu-link with-sub {{ ($prefix == '/brands')?'show-sub':'' }}">
                <i class="fas fa-list"></i>
                <span class="menu-item-label">Manage Brands</span>
            </a><!-- br-menu-link -->
            <ul class="br-menu-sub">
                <li class="sub-item"><a href="{{ route('brands.view') }}" class="sub-link {{ Route::currentRouteNamed('brands.view') ? 'active' : '' }}">All Brand</a></li>
                <li class="sub-item"><a href="{{ route('brands.add') }}" class="sub-link {{ Route::currentRouteNamed('brands.add') ? 'active' : '' }}">Add Brand</a></li>


            </ul>
        </li>

 
        <li class="br-menu-item">
            <a href="#" class="br-menu-link with-sub {{ ($prefix == '/employees')?'show-sub':'' }}">
                <i class="fa fa-balance-scale"></i>
                <span class="menu-item-label">Manage HRM</span>
            </a><!-- br-menu-link -->
            <ul class="br-menu-sub">
                <li class="sub-item"><a href="{{ route('employees.view') }}" class="sub-link {{ Route::currentRouteNamed('employees.view') ? 'active' : '' }}">All Employee</a></li>
                <li class="sub-item"><a href="{{ route('employees.add') }}" class="sub-link {{ Route::currentRouteNamed('employees.add') ? 'active' : '' }}">Add Employee</a></li>
                <li class="sub-item"><a href="{{ route('employees.salary.view') }}" class="sub-link {{ Route::currentRouteNamed('employees.salary.view') ? 'active' : '' }}">Employee Salary</a></li>
                <li><a href="{{ route('employee.attendance.view') }}" class="sub-link {{ Route::currentRouteNamed('employee.attendence.view') ? 'active' : '' }}">Employee Attendance</a></li>
            </ul>
        </li>

        <li class="br-menu-item">
            <a href="#" class="br-menu-link with-sub {{ ($prefix == '/products')?'show-sub':'' }}">
                <i class="fas fa-list"></i>
                <span class="menu-item-label">Manage Products</span>
            </a><!-- br-menu-link -->
            <ul class="br-menu-sub">
                <li class="sub-item"><a href="{{ route('products.view') }}" class="sub-link {{ Route::currentRouteNamed('products.view') ? 'active' : '' }}">All Products</a></li>
                <li class="sub-item"><a href="{{ route('products.add') }}" class="sub-link {{ Route::currentRouteNamed('products.add') ? 'active' : '' }}">Add Products</a></li>
                <li class="sub-item"><a href="{{ route('products.barcode') }}" class="sub-link {{ Route::currentRouteNamed('products.barcode') ? 'active' : '' }}"> Products Barcode</a></li>
                

            </ul>
        </li>
        
        <li class="br-menu-item">
            <a href="#" class="br-menu-link with-sub {{ ($prefix == '/expenses')?'show-sub':'' }}">
                <i class="fa fa-balance-scale"></i>
                <span class="menu-item-label">Manage Expense</span>
            </a><!-- br-menu-link -->
            <ul class="br-menu-sub">
                <li class="sub-item"><a href="{{ route('expenses.view') }}" class="sub-link {{ Route::currentRouteNamed('expenses.view') ? 'active' : '' }}">All Expenses</a></li>
                <li class="sub-item"><a href="{{ route('expenses.add') }}" class="sub-link {{ Route::currentRouteNamed('expenses.add') ? 'active' : '' }}">Add Expense</a></li>
                <li class="sub-item"><a href="{{ route('expenses.today') }}" class="sub-link {{ Route::currentRouteNamed('expenses.today') ? 'active' : '' }}">Today Expense</a></li>
                <li class="sub-item"><a href="{{ route('expenses.month') }}" class="sub-link {{ Route::currentRouteNamed('expenses.month') ? 'active' : '' }}">Monthly Expense</a></li>
                <li class="sub-item"><a href="{{ route('expenses.yearly') }}" class="sub-link {{ Route::currentRouteNamed('expenses.yearly') ? 'active' : '' }}">Yearly Expense</a></li>
                
            </ul>
        </li>

        <li class="br-menu-item">
            <a href="#" class="br-menu-link with-sub {{ ($prefix == '/purchase')?'show-sub':'' }}">
                <i class="fas fa-shopping-cart"></i>
                <span class="menu-item-label">Manage Purchase</span>
            </a><!-- br-menu-link -->
            <ul class="br-menu-sub">
                <li class="sub-item"><a href="{{ route('purchase.view') }}" class="sub-link {{ Route::currentRouteNamed('purchase.view') ? 'active' : '' }}">View Purchase</a></li>
                <li class="sub-item"><a href="{{ route('purchase.add') }}" class="sub-link {{ Route::currentRouteNamed('purchase.add') ? 'active' : '' }}">Add Purchase</a></li>
                {{-- <li class="sub-item"><a href="{{ route('import.product') }}" class="sub-link {{ Route::currentRouteNamed('import.product') ? 'active' : '' }}">Import Products</a></li> --}}
                <li class="sub-item"><a href="{{ route('purchase.pending.list') }}" class="sub-link {{ Route::currentRouteNamed('purchase.pending.list') ? 'active' : '' }}">Approval Purchase</a></li>
                <li class="sub-item"><a href="{{ route('purchase.report') }}" class="sub-link {{ Route::currentRouteNamed('purchase.report') ? 'active' : '' }}">Daily Purchase Report</a></li>


            </ul>
        </li>
        <li class="br-menu-item">
            <a href="#" class="br-menu-link with-sub {{ ($prefix == '/stock')?'show-sub':'' }}">
                <i class="fas fa-shopping-cart"></i>
                <span class="menu-item-label">Manage Stock</span>
            </a><!-- br-menu-link -->
            <ul class="br-menu-sub">
                <li class="sub-item"><a href="{{ route('stock.report') }}" class="sub-link {{ Route::currentRouteNamed('stock.report') ? 'active' : '' }}">Stock Report</a></li>
                <li class="sub-item"><a href="{{ route('supplier.product.report') }}" class="sub-link {{ Route::currentRouteNamed('supplier.product.report') ? 'active' : '' }}">Supplier/Product Stock</a></li>

            </ul>
        </li>



    </ul><!-- br-sideleft-menu -->
    

    

    <br>
</div><!-- br-sideleft -->
