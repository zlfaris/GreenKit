@props(['text', 'avatar', 'name', 'rating'])

<div class="rounded-xl overflow-hidden flex flex-col shadow-sm h-full bg-white">
    <!-- Top Section (Quote) -->
    <div class="bg-[#F3F4F6] px-6 pt-10 pb-12 relative flex-1 flex flex-col justify-center">
        <!-- Quote Icon -->
        <div class="text-[#445344] text-6xl font-serif leading-none absolute top-4 left-6 font-bold">
            &ldquo;
        </div>
        <p class="text-gray-900 text-[13px] md:text-sm leading-relaxed text-center mt-4 relative z-10">
            {{ $text }}
        </p>
    </div>

    <!-- Bottom Section (Author) -->
    <div class="bg-[#445344] px-6 pt-12 pb-8 flex flex-col items-center relative flex-none">
        <!-- Avatar on seam -->
        <div class="absolute -top-8 left-1/2 -translate-x-1/2 w-16 h-16 rounded-full overflow-hidden">
            <img src="{{ $avatar }}" alt="{{ $name }}" class="object-cover w-full h-full" />
        </div>
        
        <h4 class="text-white font-bold text-sm">{{ $name }}</h4>
        
        <div class="flex items-center text-[#F59E0B] mt-1 space-x-0.5">
            @for ($i = 0; $i < 5; $i++)
                <svg class="w-3.5 h-3.5 {{ $i < floor($rating) ? 'fill-current' : 'text-gray-500' }}" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
            @endfor
        </div>
    </div>
</div>
