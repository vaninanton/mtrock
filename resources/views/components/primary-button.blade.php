<button {{ $attributes->merge(['type' => 'submit', 'class' => 'items-center px-4 py-2 bg-primary border border-transparent rounded-md text-white hover:bg-primary-dark focus:bg-primary-dark active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
