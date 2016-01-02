<header>      
  <table style="width:100%">
    <tbody>
      <tr>
        <td width='75%'>
          Hello
        </td>
        <td align="right">
          <ul id="user">
          {{ $member_id = auth()->guard('member')->user()->member_id }}
          @if ($member_id != '')            
            <li><a href="{{ url('/login') }}">
              {{ "ASD" }}
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
