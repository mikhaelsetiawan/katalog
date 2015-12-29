<!DOCTYPE html>
<html>
    <head>
        <title>Katalog</title>
        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                display: table;
                font-weight: 100;
                font-family: 'Arial';
            }

            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            .content {
                text-align: center;
                display: inline-block;
            }

            .title {
                font-size: 96px;
            }
            header{
              height:40px;
              background-color: skyblue;
              color: white;
              padding: 5px 50px;
            }
            a {
              text-decoration: none;
              color: inherit;
              transition: all 0.5s;
            }
            a:visited {
              color: inherit;
            }
            a:hover {
              color: blue;
            }
            
        </style>
    </head>
    <body>
      <header>
      
        <table style="width:100%">
          <tbody>
            <tr>
              <td width='75%'>
                Hello
              </td>
              <td align="right">
                <a href="register">Register</a>
                &nbsp; | &nbsp;
                <a href="login">Sign In</a>
              </td>
            </tr>
          </tbody>
        </table>
      </header>
      <main></main>
      <footer></footer>
    </body>
</html>
