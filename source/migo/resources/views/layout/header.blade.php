

<div class="title-bar c-basic" data-responsive-toggle="mainNavigation" data-hide-for="medium">
    <div class="title-bar-left">
        <button class="menu-icon" type="button" data-toggle="mainNavigation"></button>
        <div class="title-bar-title" style="padding: 10px;"><a href="/" class="logo">MiGO</a></div>
    </div>
    <div class="title-bar-right">
    </div>
</div>
    
<div class="top-bar" id="mainNavigation">
    <div class="top-bar-left">
        <ul class="menu vertical medium-horizontal">
            <li class="hide-for-small-only"><a href="/" class="logo" style="padding:0px;margin: 14px 24px;">MiGO</a>
            </li>            
        </ul>
    </div>
    <div class="top-bar-right">
        <ul class="menu vertical medium-horizontal m-lg" style="padding: 0px 20px;">
            <li>
                <a href="/about"><i class="fi-comment-quotes"></i> This Project</a>
            </li>
            <li>
                <a href="https://github.com/crazykiid/migo" target="_blank" style="color:#fff;padding: 14px;"><i class="fi-social-github"></i> Source</a>
            </li>
            <li>
                <a href="/cart"><i class="fi-shopping-cart"></i> Cart
                (<span class="cart">@if(Session::has('user_cart') && empty(!Session::get('user_cart'))){{ count(json_decode(Session::get('user_cart'))) }}@else{{0}}@endif</span>)
                </a>
            </li>
            <li>
                @if(Session::has('username', 'user_email'))
                <div data-toggle="user" style="padding:11px;cursor:pointer;"><i class="fi-torso"></i> {{ Session::get('username') }}
                </div>
                <div class="dropdown-pane" id="user" data-dropdown data-hover="true" data-hover-pane="true" data-position="bottom" data-alignment="right" style="color: #44318d;">
                    <div style="padding:7px 0px;">
                        <span class="uimg">{{ strtoupper(substr(Session::get('username'), 0,1)) }}</span>
                        ({{ Session::get('user_email') }})
                        <a href="/setting" style="color:#7d7c7f;padding:8px;display: inline;float:right;"><i class="fi-widget"></i></a>
                    </div>
                    <button class="expanded button logout">Logout</button>
                </div>  
                @else
                <div data-toggle="user" style="padding:11px;cursor:pointer;"><i class="fi-torso"></i> Guest
                </div>
                <div class="dropdown-pane" id="user" data-dropdown data-hover="true" data-hover-pane="true" data-position="bottom" data-alignment="right" style="color: #44318d;">
                    <button class="expanded button s-l" data-open="login">Login</button>
                    <p style="margin-top: 10px;">
                    Don't have an account? <a href="/create" style="color: #D83F87;display: unset;margin: 0px;padding: 0px;">Create One</a>
                    </p>
                </div>
                <div class="reveal" id="login" data-reveal>
                        <h3 style="margin: 12px 0px 22px;">LOGIN</h3>
                        <form data-abide>
                        <div class="grid-x grid-margin-x">
                            <div class="cell small-12">
                                <div class="res"></div>
                            </div>
                            <div class="cell small-12">
                                <label>UserID / Email <span class="u-help"></span>
                                <input type="text" id="-user" aria-describedby="exampleHelpTextNumber" required>
                                </label>
                            </div>

                            <div class="cell small-12">
                                <label>Password <span class="p-help"></span>
                                <input type="password" id="-pass" aria-describedby="h-pass" required>
                                </label>
                            </div>
                            <div class="cell small-12" style="padding: 12px 0px;">
                                <button class="button login" type="button">Login</button>
                            </div>
                        </div>
                        </form>
                        <button class="close-button" data-close aria-label="Close modal" type="button">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                @endif
            </li>
        </ul>          
    </div>
</div>


