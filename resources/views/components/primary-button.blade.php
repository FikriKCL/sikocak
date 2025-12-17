<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-10 py-4 bg-[#9DFF00] border border-black border-2 rounded-full font-semibold text-3xl text-black dark:text-gray-800 tracking-widest hover:bg-green-100 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
