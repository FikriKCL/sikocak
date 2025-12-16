@props(['user'])

<style>
.bronze-gradient{
    background: linear-gradient(to left, #b6511b, #ff9258, #C45013, #45220f);

}

</style>
<div class="min-h-screen w-full
            bronze-gradient
            flex flex-col items-center p-6
            overflow-hidden relative">
    @include('profile.partials.header')

    <!-- LEFT DECORATION -->
      <img src="/images/bronze.png"
         class="absolute left-[-60px] sm:left-[-40px] top-1/4 
                rotate-45 w-52 sm:w-72 md:w-96 
                pointer-events-none select-none" />

    <!-- RIGHT DECORATION -->
    <img src="/images/bronze.png"
         class="absolute right-[-60px] sm:right-[-40px] top-1/2 
                -rotate-12 w-52 sm:w-72 md:w-96 
                pointer-events-none select-none" />
       
    <!-- PROFILE CARD -->
     <div class="w-full max-w-[380px] sm:max-w-[420px] md:max-w-[480px] z-10">
        <x-profilecard :user="$user" />
    </div>
</div>


