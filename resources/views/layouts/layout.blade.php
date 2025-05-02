<!DOCTYPE html>
<html lang="en">
<head>
  @vite(['resources/css/app.css', 'resources/js/app.js'])

 @include('pages.head')
 @stack('styles')
</head>
<body class="bg-dark min-h-screen">
    <!-- Header/Navigation Bar -->
   <x-navbar/>

    @yield('content')

    <!-- Footer Section -->
  <x-footer/>
  @stack('scripts')
</body>
</html>