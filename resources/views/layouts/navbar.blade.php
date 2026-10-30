<nav>
    <ul>
        <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a></li>
        <li><a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}">About</a></li>
        <li><a href="{{ route('education') }}" class="{{ request()->routeIs('education') ? 'active' : '' }}">Education</a></li>
        <li><a href="{{ route('projects.index') }}" class="{{ request()->routeIs('projects.*') ? 'active' : '' }}">Projects</a></li>

        {{-- Bagian kanan: nama user + logout kalau sudah login, tombol login kalau belum --}}
        @auth
            <li class="nav-right">
                <a href="{{ route('profile.saya') }}" class="nav-user {{ request()->routeIs('profile.saya') ? 'active' : '' }}">
                    {{ Auth::user()->name }}
                </a>
            </li>
            <li>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="nav-button">Logout</button>
                </form>
            </li>
        @endauth

        @guest
            <li class="nav-right"><a href="{{ route('login') }}" class="nav-button">Login</a></li>
        @endguest
    </ul>
</nav>
