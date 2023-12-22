
    @if ($message = Session::get('success'))
    <html>
        <head>
          <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:400,400i,700,900&display=swap" rel="stylesheet">
        </head>
          <style>
            body {
              text-align: center;
              padding: 40px 0;
              background: #EBF0F5;
            }
              h1 {
                color: #88B04B;
                font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
                font-weight: 900;
                font-size: 40px;
                margin-bottom: 10px;
              }
              p {
                color: #404F5E;
                font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
                font-size:20px;
                margin-bottom: 15px;
              }
            i {
              color: #9ABC66;
              font-size: 100px;
              line-height: 200px;
              margin-left:-15px;
            }
            .card {
              background: white;
              padding: 60px;
              border-radius: 4px;
              box-shadow: 0 2px 3px #C8D0D8;
              display: inline-block;
              margin: 0 auto;
            }
            .btn {
            background-color: rgb(4, 32, 170);
            color: white;
            padding: 12px;
            margin: 10px 0;
            border: none;
            width: 100%;
            border-radius: 3px;
            cursor: pointer;
            font-size: 17px;
        }
          </style>
          <body>
            <div class="card">
            <div style="border-radius:200px; height:200px; width:200px; background: #F8FAF5; margin:0 auto;">
              <i class="checkmark">✓</i>
            </div>
              <h1>Success</h1> 
              <p>We received your purchase request;<br/> we'll be in touch shortly!</p>
              <a href="{{ route('home') }}" class="btn btn-info">Purchase again</a>
            </div>
          </body>
      </html>
    @endif

    @if ($message = Session::get('error'))
    <div class="container">
        <div class="ui middle aligned center aligned grid">
          <div class="ui eight wide column">
         
            <form class="ui large form">
                      
                <div class="ui icon negative message">
                  <i class="warning icon"></i>
                  <div class="content">
                    <div class="header">
                      Oops! Something went wrong.
                    </div>
                    <p>While trying to reserve money from your account</p>
                  </div>
                  
               </div>
            
                <span class="ui large teal submit fluid button"><a href="{{ route('product') }}">Try again</a></span>
            
            </form>
          </div>
        </div>
      </div>
    @endif
