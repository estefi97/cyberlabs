<nav style="background-color: white; font-size: 14px;">
    <div class="top-nav f-padding-y f-shadow go-front relative">
        <div class="main-grid middle-xs">
            <div class="sidebar-toggler">
                <button class="full-height like-link text-center full-width block toggle-active" data-selector=".main-layout">
                    <div class="normal-svg transparent-56" style="max-width:90%;">
                        <svg viewBox="0 0 30 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect width="30" height="3.24507" rx="1.62254" fill="#051626"></rect>
                            <rect y="6" width="30" height="3.24507" rx="1.62254" fill="#051626"></rect>
                            <rect y="12" width="30" height="3.24507" rx="1.62254" fill="#051626"></rect>
                        </svg>
                    </div>
                </button>
            </div>
            <div class="left-section">
                <a href="/">
                    <img height="35" style="max-width: 100%; border: 0;" class="block" src="{{ asset('images/logo_cyberlabs.png') }}">
                </a>
            </div>
            <div class="right-section">
                <div class="row middle-xs full-width">
                    @include('partials.navigations.' . \App\User::navigation())
                </div>
            </div>
        </div>
    </div>
</nav>