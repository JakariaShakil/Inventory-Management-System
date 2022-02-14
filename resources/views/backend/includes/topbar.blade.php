<div class="br-header">
    <div class="br-header-left">
      <div class="navicon-left hidden-md-down"><a id="btnLeftMenu" href=""><i class="icon ion-navicon-round"></i></a></div>
      <div class="navicon-left hidden-lg-up"><a id="btnLeftMenuMobile" href=""><i class="icon ion-navicon-round"></i></a></div>
      <div class="input-group hidden-xs-down wd-170 transition">
        <input id="searchbox" type="text" class="form-control" placeholder="Search">
        <span class="input-group-btn">
          <button class="btn btn-secondary" type="button"><i class="fas fa-search"></i></button>
        </span>
      </div><!-- input-group -->
    </div><!-- br-header-left -->
    <div class="br-header-right">
      <nav class="nav">
        <div class="dropdown">
          <a href="" class="nav-link nav-link-profile" data-toggle="dropdown">
            <span class="logged-name hidden-md-down">{{ Auth::user()->name }}</span>
            <img src="{{!(empty($user->image))?url('Backend/img/user/'.$user->image):url('Backend/img/user/default_img/avatar.png')}}" class="wd-32 rounded-circle" alt="">
            <span class="square-10 bg-success"></span>
          </a>
          <div class="dropdown-menu dropdown-menu-header wd-250">
            {{-- <div class="tx-center">
              <a href=""><img src="{{!(empty($user->image))?url('Backend/img/user/'.$user->image):url('Backend/img/user/default_img/avatar.png')}}" class="wd-80 rounded-circle" alt=""></a>
              <h6 class="logged-fullname">{{ Auth::user()->name }}</h6>
              <p>{{ Auth::user()->email }}</p>
            </div>
            <hr>
           
            <hr> --}}
            <ul class="list-unstyled user-profile-nav">
              <li><a href="{{ route('profile.view') }}"><i class="icon fa fa-user"></i>Profile</a></li>
              <li><a href="{{ route('profile.password.view') }}"><i class="icon fas fa-key"></i> Change Password</a></li>
             
              <li>{{--start logout --}}
                <a class="dropdown-item text-left" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();" style="padding:10px 15px;">
                    <i class="icon fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>               
                    {{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
                {{-- end logout --}}
</li>
            </ul>
          </div><!-- dropdown-menu -->
        </div><!-- dropdown -->
      </nav>
     
    </div><!-- br-header-right -->
  </div><!-- br-header -->