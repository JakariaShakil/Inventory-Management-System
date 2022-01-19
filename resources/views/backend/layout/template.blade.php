<!DOCTYPE html>
<html lang="en">
  <head>
  @include('backend.includes.header')
  
  @include('backend.includes.css')
  @stack('css')
   
  </head>

  <body>

    
  @include('backend.includes.menu')
    
  @include('backend.includes.topbar')
   
  @include('backend.includes.rightPanel')
   
  <div class="br-mainpanel notifications top-right">
    @yield('body')
    
    
    @include('backend.includes.footer')

  </div>   

  @include('backend.includes.script')
  
  @stack('scripts')
 
  
  </body>
</html>
