<!DOCTYPE html>
<html lang="en">
<head>
 @include('pages.head')
</head>
<body class="bg-dark min-h-screen">
    <!-- Header/Navigation Bar -->
   <x-navbar/>

    @yield('content')

    <!-- Footer Section -->
  <x-footer/>

</body>
</html>