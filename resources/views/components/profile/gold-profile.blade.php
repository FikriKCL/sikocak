@props(['user'])

<div class="min-h-screen w-full
               bg-gradient-to-l 
                from-[#997920] 
                via-[#DFB33B] 
                to-[#9C7B22] 
            flex flex-col items-center p-4 sm:p-6
            overflow-hidden relative">

    <img src="/images/goldstar.png" class ="select-none pointer-events-none absolute w-60 left-3 md:w-72 md:left-12 md:top-2"/>
    <img src="/images/goldstar.png" class="select-none pointer-events-none rotate-[40deg] absolute w-64 top-96 left-[400px] md:w-16 md:left-[300px] md:top-56"/>
    <img src="/images/goldstar.png" class="select-none pointer-events-none rotate-[20deg] absolute w-8 top-[400px] right-[120px] md:w-80 md:right-[60px] md:top-[32rem]"/>
    <img src="/images/goldstar.png" class="select-none pointer-events-none rotate-[40deg] absolute w-8 right-[1rem] top-[18rem] md:w-16 md:top-[34rem] md:right-[24rem]"/>
 

    {{-- HEADER --}}
    @include('profile.partials.header')
    
    {{-- LEFT DECORATION --}}
    <img src="/images/gold.png"
         class="absolute left-[-60px] md:left-[-120px] top-80 
                rotate-45 md:w-[36rem]  
                pointer-events-none select-none" />

    {{-- RIGHT DECORATION --}}
    <img src="/images/gold.png"
         class="absolute right-[-40px] md:right-[-120px]  
                -rotate-[120deg] w-56 md:w-[36rem] md:-top-[10rem]
                pointer-events-none select-none" />

    {{-- PROFILE CARD --}}
    <div class="w-full max-w-[380px] sm:max-w-[420px] md:max-w-[480px] z-10">
        <x-profilecard :user="$user" />
    </div>

</div>





