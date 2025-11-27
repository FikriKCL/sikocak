@props(['user'])
<div class="min-h-screen w-full 
            bg-[linear-gradient(to_left,#7B7B7B,#4A4A4A,#6D6D6D,#5B5B5B)]
            flex flex-col items-center p-6 
            overflow-hidden relative">

    @include('profile.partials.header')

    <!-- LEFT DECORATION -->
    <img src="/images/silver.png"
          class="absolute left-[-60px] sm:left-[-40px] top-1/4 
                rotate-45 w-52 sm:w-72 md:w-96 
                pointer-events-none select-none" />

    <!-- RIGHT DECORATION -->
    <img src="/images/silver.png"
         class="absolute right-[-60px] sm:right-[-40px] top-1/2 
                -rotate-12 w-52 sm:w-72 md:w-96 
                pointer-events-none select-none" />
       
    <!-- PROFILE CARD -->
     <div class="w-full max-w-[380px] sm:max-w-[420px] md:max-w-[480px] z-10">
        <x-profilecard :user="$user" />
    </div>

</div>


