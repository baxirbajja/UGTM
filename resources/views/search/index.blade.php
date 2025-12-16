<x-layout title="نتائج البحث: {{ $query }}">
    <div class="bg-gray-50 min-h-screen py-12">
        <div class="container mx-auto px-4">
            <!-- Header -->
            <div class="mb-12 text-center">
                <span class="text-ugtm-purple font-bold tracking-wider uppercase text-sm">نتائج البحث</span>
                <h1 class="text-4xl font-bold text-navy-900 mt-2">"{{ $query }}"</h1>
                <div class="w-24 h-1 bg-ugtm-purple mx-auto mt-4 rounded-full"></div>
            </div>

            <div class="flex flex-col lg:flex-row gap-8">
                <!-- Main Content -->
                <div class="lg:w-4/5">
                    <!-- Posts Grid -->
                    <div class="grid md:grid-cols-2 gap-8">
                        @forelse($posts as $post)
                        <article class="bg-white rounded-xl shadow-sm hover:shadow-xl transition duration-300 overflow-hidden border border-gray-100">
                            <div class="h-48 bg-gray-200 relative">
                                @if($post->image)
                                @php
                                    $image = is_array($post->image) ? $post->image[0] : $post->image;
                                @endphp
                                <img src="{{ str_starts_with($image, 'http') ? $image : Storage::url($image) }}" alt="{{ $post->title }}" class="w-full h-full object-cover">
                                @else
                                <div class="w-full h-full flex items-center justify-center text-gray-400">
                                    <span class="text-4xl">📷</span>
                                </div>
                                @endif
                                <a href="{{ route('categories.show', $post->category->slug) }}" class="absolute top-4 right-4 bg-ugtm-purple text-white text-xs px-2 py-1 rounded hover:bg-navy-800 transition">
                                    {{ $post->category->name }}
                                </a>
                            </div>
                            <div class="p-5">
                                <span class="text-gray-400 text-sm flex items-center gap-1 mb-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    {{ $post->created_at->format('Y-m-d') }}
                                </span>
                                <h3 class="text-lg font-bold text-navy-800 mb-2 leading-snug hover:text-ugtm-purple transition">
                                    <a href="{{ route('posts.show', $post->slug) }}">
                                        {{ $post->title }}
                                    </a>
                                </h3>
                                <p class="text-gray-600 text-sm line-clamp-3 mb-4">
                                    {{ Str::limit($post->content, 100) }}
                                </p>
                                <a href="{{ route('posts.show', $post->slug) }}" class="text-ugtm-purple text-sm font-bold mt-2 inline-block">اقرأ التفاصيل</a>
                            </div>
                        </article>
                        @empty
                        <div class="col-span-full text-center py-12">
                            <div class="mb-4 text-6xl">🔍</div>
                            <h3 class="text-xl font-bold text-navy-800 mb-2">لم يتم العثور على نتائج</h3>
                            <p class="text-gray-500">جرب البحث بكلمات مختلفة أو تأكد من صحة الكلمات المكتوبة.</p>
                        </div>
                        @endforelse
                    </div>

                    <!-- Pagination -->
                    <div class="mt-12">
                        {{ $posts->appends(['q' => $query])->links() }}
                    </div>
                </div>

                <!-- Sidebar -->
                <x-sidebar :memos="$memos" />
            </div>
        </div>
    </div>
</x-layout>
