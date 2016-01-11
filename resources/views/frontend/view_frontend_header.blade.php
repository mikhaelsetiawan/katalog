<header>      
  <table style="width:100%">
    <tbody>
      <tr>
        <td width='75%'>
          Hello
        </td>
        <td align="right">
          <ul id="user">
          @if (auth()->guard('member')->check())
            <li><a href="{{ url('/login') }}">
              {{ auth()->guard('member')->user()->member_name }}
            </a></li>
            <li><a href="{{ url('/register') }}">
              Logout
            </a></li>
          @else
            <li><a href="{{ url('/login') }}">Login</a></li>
            <li><a href="{{ url('/register') }}">Register</a></li>
          @endif
          </ul>
        </td>
      </tr>
    </tbody>
  </table>
</header>
