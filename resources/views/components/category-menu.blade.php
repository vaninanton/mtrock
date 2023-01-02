<div>
    <h3 class="font-bold text-xl mb-4">Категории</h3>
    <ul id="accordion-collapse" data-accordion="collapse">
        @foreach ($categories as $category)
        <li>
            <div class="flex justify-between items-start" id="accordion-collapse-heading-{{ $loop->index }}" data-accordion-target="#menu-collapse-subcategories-{{ $loop->index }}" aria-expanded="true" aria-controls="menu-collapse-subcategories-{{ $loop->index }}">
                <button type="button" class="text-left">{{ $category->title }}</button>
                <svg data-accordion-icon class="w-6 h-6 shrink-0" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                </svg>
            </div>

            <ul class="ml-4 mr-2 mb-8" id="menu-collapse-subcategories-{{ $loop->index }}" class="hidden" aria-labelledby="accordion-collapse-heading-{{ $loop->index }}">
                <li>
                    <div class="flex justify-between items-center">
                        <a href="{{ route('category', $category) }}" class="hover:text-blue-600">Показать все</a>
                        <div class="text-xs">{{ $category->products_count }}</div>
                    </div>
                </li>
                @foreach ($category->children as $childCategory)
                <li>
                    <div class="flex justify-between items-center">
                        <a href="{{ route('category', $childCategory) }}" class="hover:text-blue-600">{{ $childCategory->title }}</a>
                        <div class="text-xs">{{ $childCategory->products_count }}</div>
                    </div>
                </li>
                @endforeach
            </ul>
        </li>
        @endforeach
    </ul>
</div>
