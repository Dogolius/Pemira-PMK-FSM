<!doctype html>
<html lang="en" class="h-100">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="icon" href="/img/logo_pmk.png">
    <style>
      css-doodle {
        position: relative;
        z-index: -1;
        --color: @p(#51eaea, #fffde1, #ff9d76, #FB3569);
        --rule: (
          :doodle {
            @grid: 30x1 / 18vmin;
            --deg: @p(-180deg, 180deg);
          }
          :container {
            perspective: 30vmin;
          }
          :after, :before {
            content: '';
            background: var(--color); 
            @place-cell: @r(100%) @r(100%);
            @size: @r(6px);
            @shape: heart;
          }
        
          @place-cell: center;
          @size: 100%;
        
          box-shadow: @m2(0 0 50px var(--color));
          background: @m100(
            radial-gradient(var(--color) 50%, transparent 0) 
            @r(-20%, 120%) @r(-20%, 100%) / 1px 1px
            no-repeat
          );
        
          will-change: transform, opacity;
          animation: scale-up 12s linear infinite;
          animation-delay: calc(-12s / @I * @i);
    
          @keyframes scale-up {
            0%, 95.01%, 100% {
              transform: translateZ(0) rotate(0);
              opacity: 0;
            }
            10% { 
              opacity: 1  ;
            }
            95% {
              transform: 
                translateZ(35vmin) rotateZ(@var(--deg));
            }
          }
        )
      }
    </style>
    <css-doodle use="var(--rule)"></css-doodle>
  </head>

  <body>
    
    <div class="container mt-4 px-3">
        @yield('container')
    </div>
    <script src="https://unpkg.com/css-doodle@0.15.3/css-doodle.min.js"></script>
    <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>

</html>