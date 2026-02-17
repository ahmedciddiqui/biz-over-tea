<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Business Over Tea | Nuvanta</title>
    <meta name="description" content="Business Over Tea — a private, invite-only founders circle. An initiative by Nuvanta Group." />

    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('includes/business-over-tea/images/nuvanta-fav.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('includes/business-over-tea/images/nuvanta-fav.png') }}">

    <meta property="og:title" content="Business Over Tea | Nuvanta" />
    <meta property="og:description" content="A private founders circle. Networking with rules. Quick introductions, one real discussion, and tea connections." />
    <meta property="og:type" content="website" />

    <link href="{{ asset('includes/bootstrap/bootstrap-5.1.3-dist/css/bootstrap.min.css') }}" rel="stylesheet">

    <link href="{{ asset('includes/business-over-tea/css/style.css') }}" rel="stylesheet">
    @yield('styleSheet')
  
</head>

<body>

    <div class="topbar">
        <div class="container">
            <nav class="navbar nav navbar-expand-lg sticky-top">
                <div class="brand">
                    <img src="{{ asset('includes/business-over-tea/images/logo.png') }}" alt="Business Over Tea"/>
                </div>

                <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapses">
                    <span class="navbar-toggler-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="38" height="38" x="0" y="0" viewBox="0 0 64 64" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><path d="M53 21H11c-1.7 0-3-1.3-3-3s1.3-3 3-3h42c1.7 0 3 1.3 3 3s-1.3 3-3 3zM53 35H11c-1.7 0-3-1.3-3-3s1.3-3 3-3h42c1.7 0 3 1.3 3 3s-1.3 3-3 3zM53 49H11c-1.7 0-3-1.3-3-3s1.3-3 3-3h42c1.7 0 3 1.3 3 3s-1.3 3-3 3z" fill="#fff" opacity="1" data-original="#fff" class=""></path></g></svg>
                    </span>
                </button> 

                
                <div class="collapse navbar-collapse" id="navbarCollapses">
                    <div class="navbar-nav ms-auto p-4 p-lg-0">
                        <a href="{{url('/')}}" class="brand-item">
                            <img src="{{ asset('includes/business-over-tea/images/nuvanta-fav.png') }}" alt="Nuvanta Group Ltd"/>
                            <span>Nuvanta Group Ltd</span>
                        </a>
                        <a class="nav-item nav-link" href="#about">About</a>
                        <a class="nav-item nav-link" href="#forwho">For who</a>
                        <a class="nav-item nav-link" href="#how">How it works</a>
                        <a class="nav-item nav-link" href="#request">Request</a>
                        <a class="btn" href="#request" aria-label="Jump to request form">Request an invitation</a>
                    </div>
                </div>       
            </nav>
        </div>
    </div>
    <!--page start-->
    <div class="content-wrap">        
        @yield('content')
    </div>   

    <footer>
        <div class="container">
        <div class="foot">
            <div>
            <div style="font-weight:800; color:var(--text);">Powered by Nuvanta Group Ltd</div>
            <div>Business Over Tea — a private circle for SME founders</div>
            </div>
            <div>© <span id="year"></span> Nuvanta. All rights reserved.</div>
        </div>
        </div>
    </footer>

    <div class="stickyCta">
        <div class="inner">
        <span>Invite-only • Founders-first • No selling</span>
        <a class="btn" href="#request">Request →</a>
        </div>
    </div>

    <script src="{{ asset('includes/bootstrap/bootstrap-5.1.3-dist/js/bootstrap.bundle.min.js') }}"></script>

    <script src="{{ asset('includes/jquery/js/jquery-3.4.1.min.js') }}"></script>
    
    <script src="{{ asset('includes/business-over-tea/js/style.js') }}"></script>
    @yield('scriptFile')
</body>

</html>