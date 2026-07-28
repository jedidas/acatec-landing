<aside
    class="main-menu  h-full lg:h-auto fixed lg:static top-0 bottom-0 lg:bottom-initial lg:top-full -left-full lg:left-0 w-full lg:w-[250px] bg-slate-300 z-49 transition-all duration-75">
    <div class="scroll-container h-full lg:h-auto overflow-hidden overflow-y-auto pb-5 lg:m-0 lg:pb-0">
        <div class="bg-slate-200 flex flex-col m-0">
            <a href="{{ route('home.index') }}" class="border-b border-b-slate-300 block px-4 py-4 h-full text-sm">
                {{ __('Inicio') }}
            </a>
            <a href="{{ route('about.index') }}" class="border-b border-b-slate-300 block px-4 py-4 h-full text-sm">
                Nosotros
            </a>
            <a href="{{ route('policies.index') }}" class="border-b border-b-slate-300 block px-4 py-4 h-full text-sm">
                {{ __('Políticas') }}
            </a>
            <a href="#contact-form" data-href="contact-form" class="wd-scroll block px-4 py-4 h-full text-sm">
                {{ __('Contacto') }}
            </a>
        </div>
        <ul>
            @foreach ($categories as $category)
                <li>
                    <a href="{{ route('category.index', ['categorySlug' => $category->slug]) }}"
                        class="flex px-4 py-4 h-auto! text-sm @if (!$loop->last) border-b border-b-slate-200 @endif">
                        {{ $category->menu }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</aside>
