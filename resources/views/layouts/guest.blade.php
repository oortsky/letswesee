<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles
    </head>
    <body>
      <div class="drawer">
        <input id="my-drawer-3" type="checkbox" class="drawer-toggle z-50" /> 
          <div class="drawer-content flex flex-col">
            <!-- Navbar -->
            <div class="w-full navbar bg-base-100 border-b fixed top-0 z-40">
              <div class="navbar-start">
                <label for="my-drawer-3" aria-label="open sidebar" class="btn btn-square btn-ghost">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block w-6 h-6 stroke-current"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                </label>
                <div class="flex-1 px-2 mx-2">
                  <a class="font-black text-2xl font-serif" href="/">Let'sWeSee</a>
                </div>
              </div> 
              @if (Route::has('login'))
              <div class="navbar-end">
                <button onclick="my_modal_2.showModal()" class="btn btn-square btn-ghost">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                </button>
              @auth
              <div class="dropdown dropdown-end hidden md:inline">
                <button class="link link-hover link-neutral py-3 mx-4">{{ Auth::user()->name }}</button>
                <ul tabindex="0" class="menu menu-sm dropdown-content mt-3 z-[1] p-2 shadow bg-base-100 rounded-box w-52">
                  <li>
                    <a class="justify-between">
                    Profile
                    <span class="badge">New</span>
                    </a>
                  </li>
                  <li><a href="{{ route('dashboard') }}">{{ __('Dashboard')}}</a></li>
                  <li><a>Settings</a></li>
                  <li>
                    <form method="POST" action="{{ route('logout') }}" x-data>
                      @csrf
                      <a href="{{ route('logout') }}" @click.prevent="$root.submit();">{{ __('Log Out') }}
                      </a>
                    </form>
                  </li>
                </ul>
              </div>
              @else
              <div class="hidden md:inline-flex">
                <a href="{{ route('login') }}" class="link link-hover link-neutral ml-4">Log In</a>
                  <div class="divider divider-horizontal"></div>
                    @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="link link-hover link-neutral mr-4">Register</a>
                  </div>
                @endif
                @endauth
              </div>
              @endif
            </div>
          <div>
            {{ $slot }}
          </div>
        </div>
        <div class="drawer-side">
          <label for="my-drawer-3" aria-label="close sidebar" class="drawer-overlay"></label> 
          <ul class="menu p-4 w-80 min-h-full bg-base-200">
            <!-- Sidebar content here -->
            <li><a href="/" class="{{ Request::is('/') ? 'active' : '' }}">Home</a></li>
            <li><a href="/insight" class="{{ Request::is('insight') ? 'active' : '' }}">Insight</a></li>
            <li><a href="/playground" class="{{ Request::is('playground') ? 'active' : '' }}">Playground</a></li>
            <li>
              <details open>
                <summary>Carrers</summary>
                <ul>
                  <li><a>Become A Writer</a></li>
                  <li><a>Job Vacancy</a></li>
                  <li><a>Community Culture</a></li>
                  <li><a>Our People</a></li>
                </ul>
              </details>
            </li>
            <li>
              <details open>
                <summary>About Us</summary>
                <ul>
                  <li><a>Our Leadership</a></li>
                  <li><a>Purpose, Mission & Values</a></li>
                  <li><a>History of Our Firm</a></li>
                  <li><a>Let'sWeSee Blog</a></li>
                </ul>
              </details>
            </li>
            <li><a>Contact Us</a></li>
            <li><a href="/policy" class="{{ Request::is('policy') ? 'active' : '' }}">Privacy Policy</a></li>
            <li><a href="/terms" class="{{ Request::is('terms') ? 'active' : '' }}">Terms of Service</a></li>
            @if (Route::has('login'))
            <div class="divider"></div>
            @auth
            <li class="inline md:hidden">
              <h2 class="menu-title">{{ Auth::user()->name }}</h2>
              <ul>
                <li><a>Profile</a></li>
                <li><a>Dashboard</a></li>
                <li><a>Setting</a></li>
                <li>
                  <form method="POST" action="{{ route('logout') }}" x-data>
                    @csrf
                    <a href="{{ route('logout') }}" @click.prevent="$root.submit();">{{ __('Log Out') }}
                    </a>
                  </form>
                </li>
              </ul>
            </li>
            @else
            <div class="inline md:hidden">
              <li><a href="{{ route('login') }}">Log In</a></li>
              @if (Route::has('register'))
              <li><a href="{{ route('register') }}">Register</a></li>
            </div>
            @endif
            @endauth
            <li><a>Email Subcriptions</a></li>
            @endif
          </ul>
        </div>
      </div>
      
      <!-- Open the modal using ID.showModal() method -->
      <dialog id="my_modal_2" class="modal modal-top">
        <div class="modal-box">
          <input type="text" placeholder="Search..." class="input input-bordered w-full" />
        </div>
        <form method="dialog" class="modal-backdrop">
          <button>close</button>
        </form>
      </dialog>

        @livewireScripts
    </body>
</html>
