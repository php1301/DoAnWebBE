<aside id="sidebar-wrapper">
  <div class="sidebar-brand">
    <a href="{{ route('home') }}">
        <img src="{{ asset('assets/img/logobl.png') }}" alt="{{ env('APP_NAME') }}" style="border-radius: 10px;"height="35">
    </a>
  </div>
  <div class="sidebar-brand sidebar-brand-sm">
    <a href="{{ route('home') }}"><img src="{{ asset('assets/img/logobl.png') }}" alt="{{ env('APP_NAME') }}" style="border-radius: 10px;" height="25"></a>
  </div>
  <ul class="sidebar-menu">
      <li class="{{ (Request::route()->getName() == 'home' || Request::route()->getName() == NULL) ? ' active' : '' }}">
          <a class="nav-link" href="{{ route('home') }}">
              <i class="dripicons-home"></i> <span> {{ __('Dashboard') }} </span>
          </a>
      </li>
      @if(isset($currantWorkspace) && $currantWorkspace)
          <li class="{{ (Request::route()->getName() == 'projects.index') ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('projects.index',$currantWorkspace->slug) }}">
                  <i class="dripicons-briefcase"></i>
                  <span> {{ __('Projects') }} </span>
              </a>
          </li>
          <li class="{{ (Request::route()->getName() == 'users.index') ? ' active' : '' }}">
              <a href="{{ route('users.index',$currantWorkspace->slug) }}">
                  <i class="dripicons-network-3"></i>
                  <span> {{ __('Users') }} </span>
              </a>
          </li>
    
          <li class="{{ (Request::route()->getName() == 'calender.index') ? ' active' : '' }}">
              <a href="{{route('calender.index',$currantWorkspace->slug)}}">
                  <i class="dripicons-calendar"></i>
                  <span> {{ __('Calender') }} </span>
              </a>
          </li>
          <li class="{{ (Request::route()->getName() == 'notes.index') ? ' active' : '' }}">
              <a href="{{route('notes.index',$currantWorkspace->slug)}}">
                  <i class="dripicons-clipboard"></i>
                  <span> {{ __('Notes') }} </span>
              </a>
          </li>
      @endif
    </ul>
</aside>
