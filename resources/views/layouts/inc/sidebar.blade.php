<div class="sidebar" data-color="purple" data-background-color="white" data-image="../assets/img/sidebar-1.jpg">
      <div class="logo"><a href="#" class="simple-text logo-normal">
          E Shop
        </a></div>
      <div class="sidebar-wrapper">
        <ul class="nav">
          <li class="nav-item {{Request::is('dashboard')?'active':''}}">
            <a class="nav-link" href="{{ url('/dashboard') }}">
              <i class="material-icons">dashboard</i>
              <p>Dashboard</p>
            </a>
          </li>
          <li class="nav-item {{Request::is('categories')?'active':''}}">
            <a class="nav-link" href="{{route('categories')}}">
              <i class="material-icons">C</i>
              <p>Category</p>
            </a>
          </li>
          <li class="nav-item {{Request::is('categories/create')?'active':''}}">
            <a class="nav-link" href="/categories/create">
              <i class="material-icons">C</i>
              <p>Create Category</p>
            </a>
          </li>
          <li class="nav-item {{Request::is('products')?'active':''}}">
            <a class="nav-link" href="{{ url('/products') }}">
              <i class="material-icons">P</i>
              <p>Product</p>
            </a>
          </li>
          <li class="nav-item {{Request::is('products/create')?'active':''}}">
            <a class="nav-link" href="{{ url('/products/create') }}">
              <i class="material-icons">P</i>
              <p>Create Product</p>
            </a>
          </li>
          <li class="nav-item {{Request::is('orderlists')?'active':''}}">
            <a class="nav-link" href="{{ url('/orderlists') }}">
              <i class="material-icons">O</i>
              <p>Order Lists</p>
            </a>
          </li>
          <li class="nav-item {{Request::is('users')?'active':''}}">
            <a class="nav-link" href="{{ url('/users') }}">
              <i class="material-icons">O</i>
              <p>Users</p>
            </a>
          </li>
        </ul>
      </div>
    </div>