<div class="col-sm-auto bg-light sticky-top">
    <div class="d-flex flex-sm-column flex-row flex-nowrap align-items-center sticky-top">
        <a href="/" class="d-block p-3 link-dark text-decoration-none" title="" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Icon-only">
            <i class="bi-bootstrap fs-1"></i>
        </a>
        <ul class="nav nav-pills nav-flush flex-sm-column flex-row flex-nowrap mb-auto mx-auto text-center align-items-center">
            <li>
                <a href="{{route('profile', Auth::id())}}" class="nav-link py-3 px-2" title="Personal account">
                    <img src="{{asset('assets/icons/person-workspace.svg')}}" alt="Personal account">
                </a>
            </li>
            <li>
                <a href="{{route('videos.index')}}" class="nav-link py-3 px-2" title="Your videos">
                    <img src="{{asset('assets/icons/play-btn.svg')}}" alt="videos">
                </a>
            </li>
            <li>
                <a href="{{route('subscriptions')}}" class="nav-link py-3 px-2" title="Subscriptions">
                    <img src="{{asset('assets/icons/postcard-heart-fill.svg')}}" alt="Subscriptions">
                </a>
            </li>
            <li>
                <a href="{{route('likedlist')}}" class="nav-link py-3 px-2" title="Liked">
                    <img src="{{asset('assets/icons/suit-heart-fill.svg')}}" alt="Liked">
                </a>
            </li>
            <li>
                <a href="{{route('settings')}}" class="nav-link py-3 px-2" title="Settings">
                    <img src="{{asset('assets/icons/tools.svg')}}" alt="Settings">
                </a>
            </li>
            <li class="nav-item">
                <form action="{{route('logout')}}" METHOD="POST">
                    @csrf
                    <button class="btn btn-light" type="submit" title="Logout">
                        <img src="{{asset('assets/icons/door-open-fill.svg')}}" alt="Logout">
                    </button>
                </form>
            </li>

        </ul>
    </div>
</div>


