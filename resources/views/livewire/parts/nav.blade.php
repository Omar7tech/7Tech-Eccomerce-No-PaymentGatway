 @props(['content' => [], 'categories' => []])



 <div class="navbar bg-base-100 sticky top-0 z-50 shadow-md animate__animated animate__fadeIn">
     <div class="navbar-start">
         <div class="dropdown">
             <label tabindex="0" class="btn btn-ghost lg:hidden">
                 <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor">
                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h8m-8 6h16" />
                 </svg>
             </label>
             <ul tabindex="0"
                 class="menu menu-sm dropdown-content mt-3 z-[1] p-2 shadow bg-base-100 rounded-box w-52">
                 <li><a wire:current.exact='text-primary' wire:navigate href="{{ route('home') }}">Home</a></li>
                 <li>
                     <a>Shop</a>
                     <ul class="p-2">
                         @foreach ($categories as $category)
                             <li><a wire:current='text-primary' wire:navigate
                                     href="{{ route('category', $category) }}">{{ $category->name }}</a></li>
                         @endforeach
                     </ul>
                 </li>
                 <li><a wire:current='text-primary' wire:navigate href="{{ route('new-arrival') }}"">New Arrivals</a>
                 </li>
                 <li><a wire:current='text-primary' wire:navigate href="{{ route('sale') }}">Sale</a></li>
                 <li><a wire:current='text-primary' wire:navigate href="{{ route('about') }}">About</a></li>
             </ul>
         </div>
         <a wire:navigate href="{{ route('home') }}"
             class="btn btn-ghost normal-case text-xl hover:scale-105 transition-transform">ShopSphere</a>
     </div>
     <div class="navbar-center hidden lg:flex">
         <ul class="menu menu-horizontal px-1">
             <li><a wire:current.exact='text-primary' wire:navigate href="{{ route('home') }}"
                     class="hover:text-primary transition-colors">Home</a></li>
             <li tabindex="0">
                 <details>
                     <summary class="hover:text-primary transition-colors">Shop</summary>
                     <ul class="p-2 bg-base-100">
                         @foreach ($categories as $category)
                             <li><a wire:current='text-primary' wire:navigate
                                     href="{{ route('category', $category) }}">{{ $category->name }}</a></li>
                         @endforeach
                     </ul>
                 </details>
             </li>
             <li><a wire:current='text-primary' wire:navigate href="{{ route('new-arrival') }}"
                     class="hover:text-primary transition-colors">New Arrivals</a></li>
             <li><a wire:current='text-primary' wire:navigate href="{{ route('sale') }}"
                     class="hover:text-primary transition-colors">Sale</a></li>
            
                 <li><a wire:current='text-primary' wire:navigate href="{{ route('about') }}"
                         class="hover:text-primary transition-colors">About</a></li>
             

         </ul>
     </div>
     <div class="navbar-end gap-2">
         <div class="form-control  animate__animated animate__fadeIn">
             <input type="text" placeholder="Search..."
                 class="input input-bordered w-24 md:w-auto focus:ring-2 focus:ring-primary" />
         </div>



         @auth
             <button class="btn">
                 <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                     stroke="currentColor" class="size-6">
                     <path stroke-linecap="round" stroke-linejoin="round"
                         d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                 </svg>
                 <div class="badge badge-sm">+99</div>
             </button>
             <div class="dropdown dropdown-end">
                 <label tabindex="0" class="btn btn-ghost btn-circle avatar hover:scale-105 transition-transform">
                     <div class="w-10 rounded-full">
                         <img src="https://placehold.co/400" alt="User" />
                     </div>
                 </label>
                 <ul tabindex="0"
                     class="mt-3 z-[1] p-2 shadow menu menu-sm dropdown-content bg-base-100 rounded-box w-52">
                     <li>
                         <a class="justify-between hover:bg-base-200 transition-colors">
                             Profile
                             <span class="badge">New</span>
                         </a>
                     </li>
                     <li><a class="hover:bg-base-200 transition-colors">Settings</a></li>
                     <li><a class="hover:bg-base-200 transition-colors">Logout</a></li>
                 </ul>
             </div>
         @endauth

     </div>
 </div>
