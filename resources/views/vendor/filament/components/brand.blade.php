@if (filled($brand = config('filament.brand')))
<div @class([ 'filament-brand text-xl font-bold tracking-tight' , 'dark:text-white'=> config('filament.dark_mode'),
    ])>
    <div class="flex items-center">
        <img src="{{ asset('/img/logo.svg') }}" alt="Logo" class="h-10 mr-4">
        Mountain-Rock
    </div>
</div>
@endif