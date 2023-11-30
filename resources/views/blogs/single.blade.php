<x-blog-layout>
    <!-- 
Install the "flowbite-typography" NPM package to apply styles and format the article content: 

URL: https://flowbite.com/docs/components/typography/ 
-->

    <main class="pt-8 pb-16 lg:pt-16 lg:pb-24 bg-white dark:bg-gray-900 antialiased">
        <div class="flex justify-between px-4 mx-auto max-w-screen-xl ">
            <article class="mx-auto w-full format format-sm sm:format-base lg:format-lg format-blue dark:format-invert">
                <header class="mb-4 lg:mb-6 not-format">
                    <address class="flex items-center mb-6 not-italic">
                        <div class="inline-flex items-center mr-3 text-sm text-gray-900 dark:text-white">
                            <!-- <img class="mr-4 w-16 h-16 rounded-full" src="https://flowbite.com/docs/images/people/profile-picture-2.jpg" alt="Jese Leos"> -->
                            <div>
                                <a href="#" rel="author" class="text-xl font-bold text-gray-900 dark:text-white">{{ $blog->user->name }}</a>
                                <!-- <p class="text-base text-gray-500 dark:text-gray-400">Graphic Designer, educator & CEO Flowbite</p> -->
                                <p class="text-base text-gray-500 dark:text-gray-400"><time pubdate datetime="2022-02-08" title="February 8th, 2022">
                                        {{ \Carbon\Carbon::parse($blog->published_date)->format('M. j, Y') }}
                                    </time></p>
                            </div>
                        </div>
                    </address>
                    <h1 class="mb-4 text-3xl font-extrabold leading-tight text-gray-900 lg:mb-6 lg:text-4xl dark:text-white">{{ $blog->title }}</h1>
                    <span>{{ $blog->content }}</span>
                </header>
            </article>
        </div>
    </main>

    <aside aria-label="Related articles" class="py-8 lg:py-24 bg-gray-50 dark:bg-gray-800">
        <div class="px-4 mx-auto max-w-screen-xl">
            <h2 class="mb-8 text-2xl font-bold text-gray-900 dark:text-white">Latest articles</h2>
            <div class="grid gap-12 sm:grid-cols-2 lg:grid-cols-4">
                @if ($latestBlogs->isEmpty())
                    <p>No latest blogs available.</p>
                @else
                    @foreach ($latestBlogs as $blog)
                    <article class="max-w-xs">
                        <!-- <a href="#">
                            <img src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/article/blog-1.png" class="mb-5 rounded-lg" alt="Image 1">
                        </a> -->
                        <h2 class="mb-2 text-xl font-bold leading-tight text-gray-900 dark:text-white">
                            <a href="#">{{ $blog->title }}</a>
                        </h2>
                        <p class="mb-4 text-gray-500 dark:text-gray-400">
                            {{ strlen($blog->content) > 100 ? substr($blog->content, 0, 100) . '...' : $blog->content }}
                        </p>
                        <a href="/blog/{{ $blog->id }}" class="inline-flex items-center font-medium underline underline-offset-4 text-primary-600 dark:text-primary-500 hover:no-underline">
                            Read More
                        </a>
                    </article>
                    @endforeach
                @endif    
                <!-- <article class="max-w-xs">
                    <a href="#">
                        <img src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/article/blog-2.png" class="mb-5 rounded-lg" alt="Image 2">
                    </a>
                    <h2 class="mb-2 text-xl font-bold leading-tight text-gray-900 dark:text-white">
                        <a href="#">Enterprise design tips</a>
                    </h2>
                    <p class="mb-4  text-gray-500 dark:text-gray-400">Over the past year, Volosoft has undergone many changes! After months of preparation.</p>
                    <a href="#" class="inline-flex items-center font-medium underline underline-offset-4 text-primary-600 dark:text-primary-500 hover:no-underline">
                        Read in 12 minutes
                    </a>
                </article>
                <article class="max-w-xs">
                    <a href="#">
                        <img src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/article/blog-3.png" class="mb-5 rounded-lg" alt="Image 3">
                    </a>
                    <h2 class="mb-2 text-xl font-bold leading-tight text-gray-900 dark:text-white">
                        <a href="#">We partnered with Google</a>
                    </h2>
                    <p class="mb-4  text-gray-500 dark:text-gray-400">Over the past year, Volosoft has undergone many changes! After months of preparation.</p>
                    <a href="#" class="inline-flex items-center font-medium underline underline-offset-4 text-primary-600 dark:text-primary-500 hover:no-underline">
                        Read in 8 minutes
                    </a>
                </article>
                <article class="max-w-xs">
                    <a href="#">
                        <img src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/article/blog-4.png" class="mb-5 rounded-lg" alt="Image 4">
                    </a>
                    <h2 class="mb-2 text-xl font-bold leading-tight text-gray-900 dark:text-white">
                        <a href="#">Our first project with React</a>
                    </h2>
                    <p class="mb-4  text-gray-500 dark:text-gray-400">Over the past year, Volosoft has undergone many changes! After months of preparation.</p>
                    <a href="#" class="inline-flex items-center font-medium underline underline-offset-4 text-primary-600 dark:text-primary-500 hover:no-underline">
                        Read in 4 minutes
                    </a>
                </article> -->
            </div>
        </div>
    </aside>


</x-blog-layout>