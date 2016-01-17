<nav>
  <ul>
    <li onclick="$('#master_sub').slideToggle();">
      <span class=" glyphicon glyphicon-list-alt" aria-hidden="true"></span>
      Master
    </li>
  </ul>
      <ul class="sub" id="master_sub">
        <a href="{{ action('backend\controller_member@index') }}"><li> Member </li></a>
        <a href="{{ action('backend\controller_business@index') }}"><li> Business </li></a> 
        <a href="{{ action('backend\controller_bfield@index') }}"><li> Fields </li></a> 
        <a href="{{ action('backend\controller_building@index') }}"><li> Building </li></a> 
        <a href="{{ action('backend\controller_country@index') }}"><li> Country </li></a> 
        <a href="{{ action('backend\controller_province@index') }}"><li> Province </li></a> 
        <a href="{{ action('backend\controller_city@index') }}"><li> City </li></a> 
        <a href="{{ action('backend\controller_ticket@index') }}"><li> Ticket </li></a>
      </ul>
</nav>
